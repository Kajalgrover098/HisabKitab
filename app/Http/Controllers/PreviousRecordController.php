<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PreviousRecord;
use App\Models\Customer;

class PreviousRecordController extends Controller
{
   public function index(Request $request)
{
    $shopId = session('shop_id');

    $search = $request->search;
    $show = $request->show ?? 10;

    // Customers (Search + Pagination)
$customers = Customer::with('previousRecords')
    ->leftJoin('previous_records', function ($join) {
        $join->on('customers.id', '=', 'previous_records.customer_id')
             ->on('customers.shopkeeper_id', '=', 'previous_records.shopkeeper_id');
    })
    ->where('customers.shopkeeper_id', $shopId)
    ->when($search, function ($query) use ($search) {
        $query->where(function ($q) use ($search) {
            $q->where('customers.customer_name', 'like', "%{$search}%")
              ->orWhere('customers.phone', 'like', "%{$search}%");
        });
    })
    ->select('customers.*')
    ->orderByRaw("
        CASE
            WHEN previous_records.status = 'due' THEN 1
            WHEN previous_records.status = 'partial' THEN 2
            WHEN previous_records.status = 'paid' THEN 3
            WHEN previous_records.status IS NULL THEN 4
            ELSE 5
        END
    ")
    ->orderBy('customers.customer_name')
    ->paginate($show)
    ->withQueryString();

    // Previous Records
    $records = PreviousRecord::with('customer')
        ->where('shopkeeper_id', $shopId)
        ->latest()
        ->paginate($show)
        ->withQueryString();

    return view('shopkeeper.previous_records', compact('customers', 'records'));
}
    public function store(Request $request)
{
    $request->validate([
        'customer_id' => 'required',
        'total_amount' => 'required|numeric|min:1',
        'paid_amount' => 'nullable|numeric|min:0',
        'description' => 'nullable',
    ]);

    $paid = $request->paid_amount ?? 0;

    $due = $request->total_amount - $paid;

    if ($due <= 0) {
        $status = 'paid';
        $due = 0;
    } elseif ($paid > 0) {
        $status = 'partial';
    } else {
        $status = 'due';
    }

    // Record already exists?
    $record = PreviousRecord::find($request->record_id);

    if ($record) {

        // UPDATE
        $record->update([

            'total_amount' => $request->total_amount,

            'paid_amount' => $paid,

            'due_amount' => $due,

            'description' => $request->description,

            'status' => $status,

        ]);

        return back()->with('success', 'Previous record updated successfully.');

    }

    // CREATE
    PreviousRecord::create([

        'shopkeeper_id' => session('shop_id'),

        'customer_id' => $request->customer_id,

        'total_amount' => $request->total_amount,

        'paid_amount' => $paid,

        'due_amount' => $due,

        'description' => $request->description,

        'status' => $status,

        'type' => 'Opening Balance',

    ]);

    return back()->with('success', 'Previous record added successfully.');
}
}