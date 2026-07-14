@include('shopkeeper.sidebar')

<style>

.content{

    margin-left:270px;
    padding:30px;
    min-height:100vh;
    background:#f8f9fa;

}

.customer-card{

    border:none;
    border-radius:18px;
    box-shadow:0 .125rem .25rem rgba(0,0,0,.08);

}

.avatar-circle{

    width:45px;
    height:45px;
    border-radius:50%;
    background:#198754;
    color:#fff;
    display:flex;
    align-items:center;
    justify-content:center;
    font-weight:700;
    font-size:18px;

}

.table td,
.table th{

    vertical-align:middle;
    padding:15px;

}

.table thead{

    background:#f8f9fa;

}

.form-control:focus{

    box-shadow:none;
    border-color:#198754;

}

.badge{

    font-size:13px;

}

.modal-header{

    background:#198754;
    color:#fff;

}

.readonly-box{

    background:#f8f9fa;

}

@media(max-width:992px){

.content{

margin-left:0;
padding:20px;

}

.table{

min-width:950px;

}


}
/* Pagination */
.pagination .page-link{
    color: #198754;
    border-radius: 6px;
    margin: 0 2px;
}

.pagination .page-link:hover{
    color: #fff;
    background: #198754;
    border-color: #198754;
}

.pagination .page-item.active .page-link{
    background: #198754;
    border-color: #198754;
    color: #fff;
}

.pagination .page-item.disabled .page-link{
    color: #6c757d;
}

</style>

<div class="content">

<div class="container-fluid">

<div class="card customer-card mb-4">

<div class="card-body">

<div class="d-flex justify-content-between align-items-center">

<div>

<h3 class="fw-bold text-success">

<i class="fa-solid fa-book me-2"></i>

Previous Records

</h3>

<p class="text-muted mb-0">

Manage customer opening balances and previous dues.

</p>

</div>

</div>

</div>

</div>

<div class="card customer-card">

<div class="card-header bg-white border-0 py-3">

<div class="row align-items-center">

<div class="col-md-6">

<h5 class="fw-bold mb-2">

Customer List

</h5>

</div>
<form id="searchForm" method="GET" action="{{ route('previous.records') }}">

    <div class="col-md-6">

        <div class="input-group shadow-sm">

            <span class="input-group-text bg-white border-end-0"
                  style="border-radius:12px 0 0 12px; border:1px solid #dee2e6;">

                <i class="bi bi-search text-success"></i>

            </span>

            <input
                type="text"
                name="search"
                class="form-control border-start-0"
                placeholder="Search customer by name or phone..."
                value="{{ request('search') }}"
                onkeyup="searchCustomer()"
                style="height:45px;
                       border-radius:0 12px 12px 0;
                       border:1px solid #dee2e6;
                       box-shadow:none;
                       font-size:15px;">

        </div>

    </div>

</form>

</div>

</div>

<div class="table-responsive">

<table class="table table-hover mb-0">

<thead>

<tr>

<th>Customer</th>

<th>Phone</th>

<th>Email</th>

<th>Previous Due</th>

<th>Status</th>

<th class="text-center">Action</th>

</tr>

</thead>

<tbody>

@forelse($customers as $customer)

@php

$record = $customer->previousRecords->first();

@endphp

<tr>

<td>

<div class="d-flex align-items-center">

<div class="avatar-circle">

{{ strtoupper(substr($customer->customer_name,0,1)) }}

</div>

<div class="ms-3">

<div class="fw-semibold">

{{ $customer->customer_name }}

</div>

<small class="text-muted">

Customer ID :
{{ $customer->id }}

</small>

</div>

</div>

</td>

<td>

{{ $customer->phone }}

</td>

<td>

{{ $customer->email }}

</td>

<td>

@if($record)

<span class="fw-bold text-danger">

₹{{ number_format($record->due_amount,2) }}

</span>

@else

<span class="text-success">

No Record

</span>

@endif

</td>

<td>

@if($record)

@if($record->status=='paid')

<span class="badge bg-success">

Paid

</span>

@elseif($record->status=='partial')

<span class="badge bg-warning text-dark">

Partial

</span>

@else

<span class="badge bg-danger">

Due

</span>

@endif

@else

-

@endif

</td>

<td class="text-center">

<button
type="button"
class="btn btn-success btn-sm manageBtn"

data-bs-toggle="modal"
data-bs-target="#manageModal"

data-record="{{ $record->id ?? '' }}"
data-id="{{ $customer->id }}"
data-name="{{ $customer->customer_name }}"
data-phone="{{ $customer->phone }}"
data-email="{{ $customer->email }}"

data-total="{{ $record->total_amount ?? '' }}"
data-paid="{{ $record->paid_amount ?? '' }}"
data-description="{{ $record->description ?? '' }}">

<i class="fa-solid fa-gear"></i>

Manage

</button>

</td>

</tr>

@empty

<tr>

<td colspan="6" class="text-center text-muted py-5">

No Customers Found

</td>

</tr>

@endforelse

</tbody>

</table>

</div>

<div class="card-footer bg-white">

{{ $customers->links() }}

</div>

</div>

</div>

</div>


<!-- ===========================
Manage Modal
=========================== -->

<div class="modal fade"
id="manageModal"
tabindex="-1">

<div class="modal-dialog modal-lg">

<div class="modal-content">

<form id="manageForm" action="{{ url('/shopkeeper/previous-records/store') }}" method="POST">
    @csrf

<div class="modal-header">

<h5 class="modal-title">

Manage Previous Record

</h5>

<button
type="button"
class="btn-close btn-close-white"
data-bs-dismiss="modal">

</button>

</div>

<div class="modal-body">

<div class="row">



<input
type="hidden"
name="customer_id"
id="customer_id">
<input type="hidden" name="record_id" id="record_id">



<div class="col-md-6 mb-3">

<label>

Customer Name

</label>

<input
type="text"
id="customer_name"
class="form-control readonly-box"
readonly>

</div>

<div class="col-md-6 mb-3">

<label>

Phone

</label>

<input
type="text"
id="customer_phone"
class="form-control readonly-box"
readonly>

</div>

<div class="col-md-6 mb-3">

<label>

Email

</label>

<input
type="text"
id="customer_email"
class="form-control readonly-box"
readonly>

</div>

<hr>

<div class="col-md-6 mb-3">

<label>

Opening Balance

</label>

<input
type="number"
name="total_amount"
id="total_amount"
class="form-control">

</div>

<div class="col-md-6 mb-3">

<label>

Already Paid

</label>

<input
type="number"
name="paid_amount"
id="paid_amount"
class="form-control">

</div>

<div class="col-md-6 mb-3">

    <label class="fw-semibold">
        Current Due
    </label>

    <input
        type="text"
        id="due_amount"
        class="form-control readonly-box"
        readonly>

</div>

</div>

</div>

<div class="modal-footer">

<button
class="btn btn-success">

Save Record

</button>

</div>

</form>

</div>

</div>

</div>
<script>

document.querySelectorAll('.manageBtn').forEach(function(btn){

    btn.addEventListener('click',function(){

        document.getElementById('record_id').value=this.dataset.record;

        document.getElementById('customer_id').value=this.dataset.id;
    
        document.getElementById('customer_name').value=this.dataset.name;

        document.getElementById('customer_phone').value=this.dataset.phone;

        document.getElementById('customer_email').value=this.dataset.email;

        document.getElementById('total_amount').value=this.dataset.total;

        document.getElementById('paid_amount').value=this.dataset.paid;


    });

});
function calculateDue() {

    let total = parseFloat(document.getElementById('total_amount').value) || 0;

    let paid = parseFloat(document.getElementById('paid_amount').value) || 0;

    let due = total - paid;

    if (due < 0) {
        due = 0;
    }

    document.getElementById('due_amount').value = "₹ " + due.toFixed(2);

}
document.getElementById('total_amount').addEventListener('keyup', calculateDue);

document.getElementById('paid_amount').addEventListener('keyup', calculateDue);

document.getElementById('total_amount').addEventListener('change', calculateDue);

document.getElementById('paid_amount').addEventListener('change', calculateDue);

</script>
<script>
let timer;

function searchCustomer() {
    clearTimeout(timer);

    timer = setTimeout(function () {
        document.getElementById('searchForm').submit();
    }, 500);
}
</script>