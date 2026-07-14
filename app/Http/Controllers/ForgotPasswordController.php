<?php




namespace App\Http\Controllers;
use App\Models\Shopkeeper;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    public function index()
    {
        return view('shopkeeper.forgot_password');
    }

    public function updatePassword(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ], [
        'email.required' => 'Email is required.',
        'email.email' => 'Enter a valid email.',
        'password.required' => 'Password is required.',
        'password.min' => 'Password must be at least 8 characters.',
        'password.confirmed' => 'Confirm password does not match.',
    ]);

    // Check email exists
    $shopkeeper = Shopkeeper::where('email', $request->email)->first();

    if (!$shopkeeper) {
        return back()
            ->withInput()
            ->with('error', 'Email not found.');
    }

    // Update password
    $shopkeeper->password = Hash::make($request->password);
    $shopkeeper->save();

    return redirect('/')
            ->with('success', 'Password updated successfully. Please login.');
}
}