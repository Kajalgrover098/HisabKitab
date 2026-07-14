<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shopkeeper;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Billing;
use Illuminate\Support\Facades\Session;

class ShopController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Page
    |--------------------------------------------------------------------------
    */

    public function login()
    {
        return view('shopkeeper.login');
    }

    /*
    |--------------------------------------------------------------------------
    | Login Process
    |--------------------------------------------------------------------------
    */

    public function loginPost(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    // Find shopkeeper by email
    $shop = DB::table('shopkeepers')
                ->where('email', $request->email)
                ->first();

    // Check if email exists
    if (!$shop) {
        return back()
            ->withInput()
            ->withErrors([
                'email' => 'Email not found.'
            ]);
    }

    // Verify password
    if (!Hash::check($request->password, $shop->password)) {
        return back()
            ->withInput()
            ->withErrors([
                'password' => 'Incorrect password.'
            ]);
    }

    // Store session
    session([
        'shop_id' => $shop->id,
        'shop_name' => $shop->shop_name,
        'owner_name' => $shop->owner_name,
        'shop_email' => $shop->email
    ]);

    return redirect('/shopkeeper/dashboard')
            ->with('success', 'Login Successful.');
}
    /*
    |--------------------------------------------------------------------------
    | Register Page
    |--------------------------------------------------------------------------
    */

    public function register()
    {
        return view('shopkeeper.register');
    }

    /*
    |--------------------------------------------------------------------------
    | Register Process
    |--------------------------------------------------------------------------
    */
public function registerPost(Request $request)
{
   $request->validate(
    [
        'shop_name' => 'required|max:100',
        'owner_name' => 'required|max:100',
        'email' => 'required|email|unique:shopkeepers,email',
        'phone' => 'required|digits_between:10,15|unique:shopkeepers,phone',
        'password' => 'required|min:6|confirmed',
        'address'    => 'required|max:255',
        
    ],
    [
        'email.unique' => 'This email is already registered.',
        'phone.unique' => 'This phone number is already registered.',
    ]
);

    Shopkeeper::create([

        'shop_name' => $request->shop_name,

        'owner_name' => $request->owner_name,

        'email' => $request->email,

        'phone' => $request->phone,
        'address'    => $request->address,

        'password' => Hash::make($request->password),

    ]);

    return redirect('/shopkeeper/login')
            ->with('success','Registration completed successfully. Please login.');
}
    /*
    |--------------------------------------------------------------------------
    | Shop Dashboard
    |--------------------------------------------------------------------------
    */

   

public function dashboard()
{
    $shopId = session('shop_id');

    $totalCustomers = Customer::where('shopkeeper_id', $shopId)->count();

    $totalProducts = Product::where('shopkeeper_id', $shopId)->count();

    $totalBills = Billing::where('shopkeeper_id', $shopId)->count();

    $totalSales = Billing::where('shopkeeper_id', $shopId)->sum('total_amount');

    $totalReceived = Billing::where('shopkeeper_id', $shopId)->sum('paid_amount');

    $totalDue = Billing::where('shopkeeper_id', $shopId)->sum('due_amount');

    $todayBills = Billing::where('shopkeeper_id', $shopId)
        ->whereDate('created_at', today())
        ->count();

    $todaySales = Billing::where('shopkeeper_id', $shopId)
        ->whereDate('created_at', today())
        ->sum('total_amount');

    $recentBills = Billing::with('customer')
        ->where('shopkeeper_id', $shopId)
        ->latest()
        ->take(5)
        ->get();

    $dueCustomers = Billing::with('customer')
        ->where('shopkeeper_id', $shopId)
        ->where('due_amount', '>', 0)
        ->latest()
        ->take(5)
        ->get();

    return view('shopkeeper.dashboard', compact(
        'totalCustomers',
        'totalProducts',
        'totalBills',
        'totalSales',
        'totalReceived',
        'totalDue',
        'todayBills',
        'todaySales',
        'recentBills',
        'dueCustomers'
    ));
}
public function profile()
{
    $shop = Shopkeeper::find(session('shop_id'));

    return view('shopkeeper.profile', compact('shop'));
}
public function updateProfile(Request $request)
{

    $request->validate([

    'shop_name'=>'required|min:3|max:100',

    'owner_name'=>[
        'required',
        'min:3',
        'max:50',
        'regex:/^[A-Za-z ]+$/'
    ],

    'email'=>'required|email',

    'phone'=>[
        'required',
        'digits:10',
        'regex:/^[6-9][0-9]{9}$/'
    ],

    'address'=>'min:5|max:255'

],[

    'shop_name.required'=>'Shop name is required.',

    'owner_name.regex'=>'Owner name can contain only letters and spaces.',

    'phone.regex'=>'Phone number must start with 6, 7, 8 or 9.',

    'phone.digits'=>'Phone number must be exactly 10 digits.'

]);
    $shop=Shopkeeper::findOrFail(session('shop_id'));

    $shop->update([

        'shop_name'=>$request->shop_name,

        'owner_name'=>$request->owner_name,

        'email'=>$request->email,

        'phone'=>$request->phone,

        'address'=>$request->address,

    ]);

    return redirect()->back()->with('success','Profile updated successfully.');

}
public function updatePassword(Request $request)
{

    $request->validate([

        'current_password' => 'required',

        'new_password' => 'required|min:8|confirmed',

    ]);

    $shop = Shopkeeper::findOrFail(session('shop_id'));

    if (!Hash::check($request->current_password, $shop->password)) {

        return back()
            ->withErrors([
                'current_password' => 'Current password is incorrect.'
            ])
            ->with('open_modal', 'changePasswordModal');
    }

    $shop->password = Hash::make($request->new_password);

    $shop->save();

    return back()->with('success', 'Password changed successfully.');

}
public function billing(Request $request)
{
    $shopkeeperId = Session::get('shop_id');

    $search = $request->search;
    $show = $request->show ?? 10;

    // Customers with Search + Pagination
    $sort = $request->sort ?? 'asc';

$customers = Customer::where('shopkeeper_id', $shopkeeperId)
    ->when($search, function ($query) use ($search) {
        $query->where(function ($q) use ($search) {
            $q->where('customer_name', 'like', "%{$search}%")
              ->orWhere('phone', 'like', "%{$search}%");
        });
    })
    ->orderBy('customer_name', $sort)
    ->paginate($show)
    ->withQueryString();

    // Products
    $products = Product::where('shopkeeper_id', $shopkeeperId)->get();

    return view('shopkeeper.billing', compact('customers', 'products', 'search', 'show'));
}


public function reminders()
{
    $customers = Customer::where('shopkeeper_id', session('shop_id'))
                    ->latest()
                    ->paginate(10);

    return view('shopkeeper.reminders', compact('customers'));
}


public function calculator()
{
    $products = Product::where('shopkeeper_id', session('shop_id'))
                ->orderBy('product_name', 'asc')
                ->get();

    return view('shopkeeper.calculator', compact('products'));
}

   /*
    |--------------------------------------------------------------------------
    | Logout
    |--------------------------------------------------------------------------
    */

    public function logout(Request $request)
{
    $request->session()->flush();
    session()->invalidate();
    session()->regenerateToken();

    return redirect('/shopkeeper/login')
            ->with('success', 'Logged out successfully.');
}
}