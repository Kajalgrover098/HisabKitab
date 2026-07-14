<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Validation\Rule;
class CustomerController extends Controller
{

    public function index()
    {

        $customers = Customer::where('shopkeeper_id', session('shop_id'))
                        ->latest()
                        ->get();

        return view('shopkeeper.customers', compact('customers'));

    }
    public function store(Request $request)
{

    $validator = Validator::make($request->all(), [

        'customer_name' => 'required|regex:/^[A-Za-z ]+$/|min:3|max:100',

        'phone' => 'required|digits:10|regex:/^[6-9][0-9]{9}$/|unique:customers,phone,NULL,id,shopkeeper_id,'.session('shop_id'),

        'email' => 'nullable|email|max:100|unique:customers,email,NULL,id,shopkeeper_id,'.session('shop_id'),

        'gender' => 'nullable|in:Male,Female,Other',

        'address' => 'nullable|max:255',

    ], [

        'customer_name.required' => 'Customer name is required.',

        'customer_name.regex' => 'Customer name must contain only letters.',

        'phone.required' => 'Phone number is required.',

        'phone.digits' => 'Phone number must be exactly 10 digits.',

        'phone.regex' => 'Phone number must start with 6,7,8 or 9.',

        'email.email' => 'Enter a valid email address.',
        'phone.unique' => 'This phone number is already registered.',
        'email.unique' => 'This email is already registered.',

    ]);

    if($validator->fails()){

        return redirect()->back()
                ->withErrors($validator)
                ->withInput();

    }

    Customer::create([

        'shopkeeper_id' => session('shop_id'),

        'customer_name' => $request->customer_name,

        'phone' => $request->phone,

        'email' => $request->email,

        'gender' => $request->gender,

        'address' => $request->address,

    ]);

    return redirect()->route('customers.index')
            ->with('success','Customer added successfully.');

}
public function update(Request $request, $id)
{

    $request->validate([

        'customer_name' => 'required|regex:/^[A-Za-z ]+$/|min:3|max:100',

        'phone' => [
    'required',
    'digits:10',
    'regex:/^[6-9][0-9]{9}$/',
    Rule::unique('customers', 'phone')
        ->where(function ($query) {
            return $query->where('shopkeeper_id', session('shop_id'));
        })
        ->ignore($id),
],
       'email' => [
    'nullable',
    'email',
    'max:100',
    Rule::unique('customers', 'email')
        ->where(function ($query) {
            return $query->where('shopkeeper_id', session('shop_id'));
        })
        ->ignore($id),
],
        'gender' => 'nullable|in:Male,Female,Other',

        'address' => 'nullable|max:255',

    ], [

        'customer_name.required' => 'Customer name is required.',

        'customer_name.regex' => 'Only alphabets are allowed.',

        'phone.required' => 'Phone number is required.',

        'phone.digits' => 'Phone number must be exactly 10 digits.',

        'phone.regex' => 'Phone number must start with 6, 7, 8 or 9.',

        'email.email' => 'Enter a valid email address.',
        'phone.unique' => 'This phone number is already registered.',
        'email.unique' => 'This email is already registered.',

    ]);

    $customer = Customer::where('shopkeeper_id', session('shop_id'))
                    ->findOrFail($id);

    $customer->update([

        'customer_name' => $request->customer_name,

        'phone' => $request->phone,

        'email' => $request->email,

        'gender' => $request->gender,

        'address' => $request->address,

    ]);

    return redirect()->route('customers.index')
                     ->with('success','Customer updated successfully.');

}

public function delete($id)
{

    $customer=Customer::where('shopkeeper_id',session('shop_id'))
                    ->findOrFail($id);

    $customer->delete();

    return redirect()->back()
            ->with('success','Customer deleted successfully.');

}

}