<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Shopkeeper;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // Login Page
    public function login()
{
    return view('admin.login');
}

public function loginPost(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    // Find admin
    $admin = Admin::where('email', $request->email)->first();

    // Check email
    if (!$admin) {

        return back()
            ->withInput()
            ->withErrors([
                'email' => 'Email not found.'
            ]);
    }

    // Check password
    if (!Hash::check($request->password, $admin->password)) {

        return back()
            ->withInput()
            ->withErrors([
                'password' => 'Incorrect password.'
            ]);
    }

    // Store session
    session([
        'admin_id' => $admin->id,
        'admin_name' => $admin->name,
        'admin_email' => $admin->email
    ]);

    return redirect('/admin/dashboard')
            ->with('success', 'Login Successful.');
}

    // Dashboard
    public function dashboard()
    {
        return view('admin.dashboard');
    }
public function register()
{
    return view('admin.register');
}

public function registerPost(Request $request)
{
    $request->validate([

        'name' => 'required|max:100',

        'phone' => 'required|digits:10|unique:admins,phone',

        'email' => 'required|email|unique:admins,email',

        'password' => 'required|min:8|confirmed',

    ]);

    Admin::create([

        'name' => $request->name,

        'phone' => $request->phone,

        'email' => $request->email,

        'password' => Hash::make($request->password),

    ]);

    return redirect()->route('admin.login')
            ->with('success','Admin account created successfully.');
}
public function addNew()
{
    return view('admin.addnew');
}
public function storeShopkeeper(Request $request)
{
    // Validate the form data
   $request->validate([
    'shop_name'  => 'required|max:255',
    'owner_name' => 'required|max:255',
    'phone'      => 'required|digits:10|unique:shopkeepers,phone',
    'email'      => 'required|email|unique:shopkeepers,email',
    'password'   => 'required|min:8',
    'address'    => 'required'
],[
    'shop_name.required'  => 'Shop Name is required.',
    'owner_name.required' => 'Owner Name is required.',

    'phone.required'      => 'Phone Number is required.',
    'phone.digits'        => 'Phone Number must be exactly 10 digits.',
    'phone.unique'        => 'This phone number is already registered.',

    'email.required'      => 'Email is required.',
    'email.email'         => 'Enter a valid email address.',
    'email.unique'        => 'This email is already registered.',

    'password.required'   => 'Password is required.',
    'password.min'        => 'Password must be at least 8 characters.',

    'address.required'    => 'Address is required.'
]);
    // Create a new shopkeeper
    $shopkeeper = new Shopkeeper();

    $shopkeeper->shop_name = $request->shop_name;
    $shopkeeper->owner_name = $request->owner_name;
    $shopkeeper->phone = $request->phone;
    $shopkeeper->email = $request->email;
    $shopkeeper->address = $request->address;

    // Store encrypted password
    $shopkeeper->password = Hash::make($request->password);

    // Save data
    $shopkeeper->save();

    // Redirect with success message
    return redirect()->back()->with('success', 'Shopkeeper added successfully.');
}
public function shopkeepers()
{
    $shopkeepers = Shopkeeper::orderBy('id', 'asc')->whereNull('deleted_at')->get();

    return view('admin.shopkeepers', compact('shopkeepers'));
}
public function profile()
{
    $admin = Admin::find(session('admin_id'));

    return view('admin.profile', compact('admin'));
}
public function updateProfile(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:50',
        'email' => 'required|email|unique:admins,email,' . session('admin_id'),
        'phone' => 'required|regex:/^[6-9][0-9]{9}$/',
        'address' => 'nullable|max:100',
    ],[
        'phone.regex' => 'Phone number must be 10 digits and start with 6, 7, 8, or 9.',
    ]);

    $admin = Admin::find(session('admin_id'));

    $admin->name = $request->name;
    $admin->email = $request->email;
    $admin->phone = $request->phone;
    $admin->address = $request->address;

    $admin->save();

    return redirect()->route('admin.profile')
                     ->with('success', 'Profile updated successfully.');
}
public function updatePassword(Request $request)
{
    $request->validate([

        'current_password' => 'required',

        'new_password' => 'required|min:6',

        'confirm_password' => 'required|same:new_password'

    ]);

    $admin = Admin::find(session('admin_id'));

    if(!Hash::check($request->current_password, $admin->password))
    {
        return back()->withErrors([
            'current_password' => 'Current password is incorrect.'
        ]);
    }

    $admin->password = Hash::make($request->new_password);

    $admin->save();

    return redirect()->route('admin.profile')
                     ->with('success', 'Password updated successfully.');
}
public function edit($id)
{
    $shopkeeper = Shopkeeper::find($id);
    return view('admin.edit_shopkeeper', compact('shopkeeper'));
}
public function update(Request $request, $id)
{
    $request->validate([
        'shop_name' => 'required',
        'owner_name' => ['required', 'regex:/^[A-Za-z ]+$/'],
        'phone' => 'required|digits:10',
        'email' => 'nullable|email|unique:shopkeepers,email,' . $id,
        'address' => 'required',
        'status' => 'required'
    ]);

    $shopkeeper = Shopkeeper::find($id);

    $shopkeeper->shop_name = $request->shop_name;
    $shopkeeper->owner_name = $request->owner_name;
    $shopkeeper->phone = $request->phone;
    $shopkeeper->email = $request->email;
    $shopkeeper->address = $request->address;
    $shopkeeper->status = $request->status;

    $shopkeeper->save();

    return redirect('/admin/shopkeepers')->with('success', 'Updated successfully');
}

public function delete($id)
{
    $shopkeeper = Shopkeeper::find($id);

    if ($shopkeeper) {
        $shopkeeper->delete(); // soft delete
    }

    return redirect()->back()->with('success', 'Shopkeeper moved to trash');
}

    // Logout
    public function logout(Request $request)
{
    $request->session()->flush();
    session()->invalidate();
    session()->regenerateToken();


    return redirect('/admin/login')
            ->with('success', 'Logged out successfully.');
}
}