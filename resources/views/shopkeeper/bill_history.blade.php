@include('shopkeeper.sidebar')

<style>
.content{
    margin-left:270px;
    padding:30px;
    transition:.3s;

  
  
    background:#f8f9fa;

}

.card-box{
    background:#fff;
    padding:25px;
    border-radius:16px;
    box-shadow:0 8px 20px rgba(0,0,0,.08);
    overflow:hidden;
}

.table thead{
    background:#198754;
    color:#fff;
}

.title{
    font-size:24px;
    font-weight:700;
    color:#198754;
    margin-bottom:20px;
}
.summary-row{
    display:flex;
    gap:20px;
    margin-bottom:25px;
    flex-wrap:wrap;
}

.summary-card{
    background:#fff;
    border-radius:16px;
    padding:22px;
    box-shadow:0 8px 20px rgba(0,0,0,.08);
    border:none;
    position:relative;
}

.summary-card i{
    position:absolute;
    right:18px;
    top:18px;
    font-size:28px;
    color:#198754;
    opacity:.2;
}

.summary-card h6{
    color:#6c757d;
    font-size:15px;
    margin-bottom:10px;
}

.summary-card h3{
    color:#198754;
    font-weight:700;
    margin:0;
}
.table-responsive{
    width:100%;
    overflow-x:auto;
}

.table{
    min-width:900px;
}
@media(max-width:992px){

    .content{
        margin-left:0;
        padding:75px 15px 20px;
    }

    .summary-row{
        gap:15px;
    }

    .summary-card{
        min-width:200px;
    }

}

/* ===========================
   MOBILE
=========================== */

@media(max-width:768px){

    .content{
        margin-left:0;
        padding:75px 15px 20px;
    }

    .title{
        font-size:22px;
    }

    .summary-row{
        flex-direction:column;
    }

    .summary-card{
        width:100%;
        min-width:100%;
    }

    .text-end{
        text-align:left !important;
        margin-top:10px;
    }

    .btn{
        margin-bottom:8px;
    }

}

/* ===========================
   SMALL MOBILE
=========================== */

@media(max-width:480px){

    .content{
        margin-left:0;
        padding:75px 10px 15px;
    }

    .card-box{
        padding:15px;
    }

    .title{
        font-size:20px;
    }

}
</style>

<div class="content">

<div class="card-box">

    <div class="title">
        📜 Customer Invoice History
    </div>
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">

    <a href="/shopkeeper/billing" class="btn btn-outline-success">
        <i class="fas fa-arrow-left me-2"></i>Back
    </a>

    <a href="/shopkeeper/reminders" class="btn btn-success">
        <i class="fas fa-bell me-2"></i>Send Reminder
    </a>

</div>
<div class="summary-row mt-2">

    <div class="summary-card">
        <h6>Total Billing</h6>
        <h3>₹{{ number_format($totalAmount,2) }}</h3>
    </div>

    <div class="summary-card">
        <h6>Total Received</h6>
        <h3>₹{{ number_format($totalPaid,2) }}</h3>
    </div>

    <div class="summary-card">
        <h6>Total Due</h6>
        <h3>₹{{ number_format($totalDue,2) }}</h3>
    </div>

</div>
  <div class="table-responsive">
  <table class="table table-hover align-middle">

        <thead>
<tr>
    <th>Customer</th>
    <th>Date</th>
    <th>Total</th>
    <th>Paid</th>
    <th>Due</th>
    <th>Status</th>
    <th>Invoice</th>
    <th>Update</th>
</tr>
</thead>

        <tbody>

            @forelse($bills as $bill)

            <tr>
                <td>{{ $bill->customer->customer_name ?? '-' }}</td>

                <td>{{ $bill->created_at->format('d M Y') }}</td>

                <td>₹{{ $bill->total_amount }}</td>
                <td>₹{{ $bill->paid_amount }}</td>
                <td>₹{{ $bill->due_amount }}</td>

                <td>
                    @if($bill->status == 'paid')
                        <span class="badge " style="color:darkgreen;">Paid</span>
                    @elseif($bill->status == 'partial')
                        <span class="badge " style="color:blue;">Partial</span>
                    @else
                        <span class="badge " style="color:red">Due</span>
                    @endif
                </td>

                <td>
                    <a href="{{ route('bill.invoice', $bill->id) }}"
                       class="btn btn-sm" style="color:blue;">
                       <i class="fas fa-eye"></i>
                    </a>
                </td>
           <td>

@if($bill->status == 'paid')

    <button class="btn  btn-sm" disabled style="border:none;font-weight:bold; color:red">
        <i class="fas fa-check"></i>
    </button>

@else

    <button
        class="btn  btn-sm updateBtn"
        data-id="{{ $bill->id }}"
        data-total="{{ $bill->total_amount }}"
        data-paid="{{ $bill->paid_amount }}"
        data-due="{{ $bill->due_amount }}"
        data-bs-toggle="modal"
        data-bs-target="#paymentModal">

        <i class="fas fa-edit"></i>

    </button>

@endif

</td>
            </tr>

            @empty

            <tr>
                <td colspan="7" class="text-center text-muted">
                    No invoices found for this customer
                </td>
            </tr>

            @endforelse
           

        </tbody>

    </table>

</div>
<div class="modal fade" id="paymentModal" tabindex="-1">

<div class="modal-dialog">

<div class="modal-content">

<form method="POST" id="paymentForm">

    @csrf

<div class="modal-header">

<h5 class="modal-title">
Update Payment
</h5>

<button type="button"
class="btn-close"
data-bs-dismiss="modal">
</button>

</div>

<div class="modal-body">

<div class="mb-3">

<label>Total Amount</label>

<input
type="text"
id="modalTotal"
class="form-control"
readonly>

</div>

<div class="mb-3">

<label>Paid Amount</label>

<input
type="text"
id="modalPaid"
class="form-control"
readonly>

</div>

<div class="mb-3">

<label>Due Amount</label>

<input
type="text"
id="modalDue"
class="form-control"
readonly>

</div>

<div class="mb-3">

<label>Receive Payment</label>

<input
type="number"
name="payment"
class="form-control"
required>

</div>

</div>

<div class="modal-footer">

<button
type="button"
class="btn btn-secondary"
data-bs-dismiss="modal">

Cancel

</button>

<button
class="btn btn-success">

Update Payment

</button>

</div>

</form>

</div>

</div>

</div>
</div>
</div>
<script>

document.querySelectorAll('.updateBtn').forEach(button=>{

button.addEventListener('click',function(){

document.getElementById('modalTotal').value=this.dataset.total;

document.getElementById('modalPaid').value=this.dataset.paid;

document.getElementById('modalDue').value=this.dataset.due;

document.getElementById('paymentForm').action =
"{{ url('/shopkeeper/bill') }}/"+this.dataset.id+"/update";

});

});

</script>