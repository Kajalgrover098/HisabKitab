<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Customer;
use App\Models\Shopkeeper;
use App\Models\Billing;
use App\Models\BillItem;
use App\Models\Product;
use App\Models\PreviousRecord;

class BillingController extends Controller
{
    
   public function generateBill($id)
{
    $customer = Customer::where('id', $id)
                        ->where('shopkeeper_id', session('shop_id'))
                        ->firstOrFail();

    return view('shopkeeper.generate_bill', compact('customer'));
}
public function storeBill(Request $request)
{
    
    $cart = json_decode($request->cart_data, true);

    if (empty($cart)) {
        return back()->with('error', 'Cart is empty');
    }

    $total = collect($cart)->sum('amount');

    $paid = (float) $request->paid_amount;

    $due = $total - $paid;

    if ($due <= 0) {
        $status = 'paid';
        $due = 0;
    } elseif ($paid > 0) {
        $status = 'partial';
    } else {
        $status = 'due';
    }
    $shopId = session()->get('shop_id');

    $bill = Billing::create([
    'customer_id' => $request->customer_id,
    'shopkeeper_id' => session('shop_id'),
    'total_amount' => $total,
    'paid_amount' => $paid,
    'due_amount' => $due,
    'status' => $status

]);

    foreach ($cart as $item) {
    BillItem::create([
        'billing_id' => $bill->id,
        'product_id' => $item['product_id'],
        'qty' => $item['qty'],
        'price' => $item['price'],
        'amount' => $item['amount']
    ]);

    }

    return redirect()->route('bill.invoice', $bill->id);
}
public function invoice($id)
{
    $bill = Billing::with('items', 'customer')->findOrFail($id);

    return view('shopkeeper.invoice', compact('bill'));
}
public function history($customer_id)
{
    $bills = Billing::with('items', 'customer')
        ->where('customer_id', $customer_id)
        ->orderBy('created_at', 'desc')
        ->get();

    // Grand Totals
    $totalAmount = $bills->sum('total_amount');
    $totalPaid   = $bills->sum('paid_amount');
    $totalDue    = $bills->sum('due_amount');

    return view('shopkeeper.bill_history', compact(
        'bills',
        'totalAmount',
        'totalPaid',
        'totalDue'
    ));
}
public function update(Request $request, $id)
{
    $request->validate([
        'payment' => 'required|numeric|min:1',
    ]);

    $bill = Billing::findOrFail($id);

    // Extra payment allow nahi hogi
    if ($request->payment > $bill->due_amount) {

        return back()->with('error', 'Payment cannot be greater than due amount.');
    }

    // Paid amount update
    $bill->paid_amount += $request->payment;

    // Due amount recalculate
    $bill->due_amount = $bill->total_amount - $bill->paid_amount;

    // Status update
    if ($bill->due_amount == 0) {
        $bill->status = 'paid';
    } else {
        $bill->status = 'partial';
    }

    $bill->save();

    return back()->with('success', 'Payment updated successfully.');
}
public function paymentReminder(Request $request)
{
    $shopkeeperId = session('shop_id');

    $search = $request->search;
    $show = $request->show ?? 10;

    $customers = Customer::where('shopkeeper_id', $shopkeeperId)
        ->when($search, function ($query) use ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('customer_name', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        })
        ->orderBy('customer_name', 'asc')
        ->get();

    $reminderCustomers = collect();

    foreach ($customers as $customer) {

        $currentDue = Billing::where('customer_id', $customer->id)
            ->where('shopkeeper_id', $shopkeeperId)
            ->sum('due_amount');

        $previousDue = PreviousRecord::where('customer_id', $customer->id)
            ->where('shopkeeper_id', $shopkeeperId)
            ->sum('due_amount');

        $customer->current_due = $currentDue;
        $customer->previous_due = $previousDue;
        $customer->total_due = $currentDue + $previousDue;

        if ($customer->total_due > 0) {

            $pendingBills = Billing::where('customer_id', $customer->id)
                ->where('shopkeeper_id', $shopkeeperId)
                ->where('due_amount', '>', 0)
                ->count();

            if ($pendingBills > 0 && $previousDue > 0) {
                $customer->pending_bills = $pendingBills . " + Pending";
            } elseif ($pendingBills > 0) {
                $customer->pending_bills = $pendingBills;
            } elseif ($previousDue > 0) {
                $customer->pending_bills = "Pending";
            } else {
                $customer->pending_bills = 0;
            }

            $latestBill = Billing::where('customer_id', $customer->id)
                ->where('shopkeeper_id', $shopkeeperId)
                ->where('due_amount', '>', 0)
                ->latest()
                ->first();

            $latestPrevious = PreviousRecord::where('customer_id', $customer->id)
                ->where('shopkeeper_id', $shopkeeperId)
                ->where('due_amount', '>', 0)
                ->latest()
                ->first();

            $customer->latest_due = $latestBill
                ? $latestBill->created_at
                : ($latestPrevious ? $latestPrevious->created_at : null);

            $reminderCustomers->push($customer);
        }
    }

    // Pagination
    $page = LengthAwarePaginator::resolveCurrentPage();

    $customers = new LengthAwarePaginator(
        $reminderCustomers->forPage($page, $show),
        $reminderCustomers->count(),
        $show,
        $page,
        [
            'path' => request()->url(),
            'query' => request()->query(),
        ]
    );

    return view('shopkeeper.reminders', compact('customers'));
}public function sendReminder($id)
{
    $customer = Customer::findOrFail($id);

    // Current Due
    $currentDue = Billing::where('customer_id', $id)
        ->where('shopkeeper_id', session('shop_id'))
        ->sum('due_amount');

    // Previous Due
    $previousDue = PreviousRecord::where('customer_id', $id)
        ->where('shopkeeper_id', session('shop_id'))
        ->sum('due_amount');

    // Total Due
    $totalDue = $currentDue + $previousDue;

    // Pending Bills
    $pendingBills = Billing::where('customer_id', $id)
        ->where('shopkeeper_id', session('shop_id'))
        ->where('due_amount', '>', 0)
        ->count();

    if ($pendingBills > 0 && $previousDue > 0) {

    $pendingBills = $pendingBills . " + Pending";

} elseif ($pendingBills > 0) {

    // Sirf billing pending

} elseif ($previousDue > 0) {

    $pendingBills = "Pending";

} else {

    $pendingBills = 0;

}
    // Latest Bill
    $latestBill = Billing::where('customer_id', $id)
        ->where('shopkeeper_id', session('shop_id'))
        ->where('due_amount', '>', 0)
        ->latest()
        ->first();

    // Latest Previous Record
    $latestPrevious = PreviousRecord::where('customer_id', $id)
        ->where('shopkeeper_id', session('shop_id'))
        ->where('due_amount', '>', 0)
        ->latest()
        ->first();

    if ($latestBill) {
        $latestDate = $latestBill->created_at->format('d-m-Y');
    } elseif ($latestPrevious) {
        $latestDate = $latestPrevious->created_at->format('d-m-Y');
    } else {
        $latestDate = '-';
    }

    $shopkeeper = Shopkeeper::find(session('shop_id'));

$shopName = $shopkeeper->shop_name;
$ownerName = $shopkeeper->owner_name;
$phonenumber=$shopkeeper->phone;

   $message =
"

Dear {$customer->customer_name},

Hope you are doing well.

This is a friendly reminder regarding your pending payment.

* Current Due : ₹{$currentDue}
* Previous Due : ₹{$previousDue}
* Pending Bills : {$pendingBills}
* Total Due : ₹{$totalDue}
* Latest Due Date : {$latestDate}

Kindly clear your pending amount at your earliest convenience.
if you want to pay online then make payment to {$phonenumber} and send screenshot of payment.

Thank you for your continued support.

Regards,
{$ownerName}
{$shopName}";

    $phone = preg_replace('/[^0-9]/', '', $customer->phone);

    if (strlen($phone) == 10) {
        $phone = "91".$phone;
    }

    return redirect()->away(
        "https://wa.me/".$phone."?text=".urlencode($message)
    );
}
}