@include('shopkeeper.sidebar')

<style>

/* =========================
   PAGE
========================= */

.content{
    margin-left:270px;
    padding:30px;
    background:#f8f9fa;
    min-height:100vh;
    transition:.3s;
}
@media (max-width:991px){

    .content{
        margin-left:0 !important;
        padding:15px;
    }

}

/* =========================
   CARD
========================= */

.invoice-card{
    background:#fff;
    border-radius:18px;
    padding:30px;
    box-shadow:0 8px 25px rgba(0,0,0,.08);
}

/* =========================
   HEADER
========================= */

.invoice-header{
    display:flex;
    justify-content:space-between;
    align-items:flex-start;
    gap:20px;
    border-bottom:2px solid #eee;
    padding-bottom:20px;
    margin-bottom:25px;
}

.invoice-title{
    font-size:30px;
    font-weight:700;
    color:#198754;
}

.invoice-id{
    color:#6c757d;
    font-size:14px;
}

/* =========================
   BUTTONS
========================= */

.print-btn{

    background:#212529;
    color:#fff;
    border:none;
    padding:10px 20px;
    border-radius:10px;
    transition:.3s;

}

.print-btn:hover{

    background:#000;

}

.back-btn{

    margin-bottom:20px;

}

/* =========================
   INFO BOX
========================= */

.info-box{

    background:#f8f9fa;
    padding:20px;
    border-radius:12px;
    height:100%;

}

.info-box h5{

    color:#198754;
    margin-bottom:15px;
    font-weight:700;

}

.info-box p{

    margin-bottom:8px;

}

/* =========================
   TABLE
========================= */

.table-responsive{

    overflow-x:auto;
    -webkit-overflow-scrolling:touch;

}

/* .table{

    min-width:650px;
    white-space:nowrap;
    margin-bottom:0;

} */

.table thead{

    background:#198754;
    color:#fff;

}

.table th{

    padding:14px;
    text-align:center;

}

.table td{

    padding:14px;
    text-align:center;
    vertical-align:middle;

}

/* =========================
   TOTAL
========================= */

.summary{

    text-align:right;
    margin-top:20px;

}

.summary h4{

    color:#198754;
    font-weight:700;

}

/* =========================
   BADGE
========================= */

.badge{

    padding:8px 14px;
    font-size:13px;
    border-radius:20px;

}

/* =========================
   MOBILE
========================= */

@media(max-width:992px){

.content{

    margin-left:0 !important;
    padding:20px;

}



.invoice-header{

    flex-direction:column;
    gap:15px;
    align-items:flex-start;

}

.print-btn{

    width:100%;

}



.info-box{

    text-align:left !important;

}

.summary{

    text-align:left;

}

}

@media(max-width:576px){

.content{

    padding:15px;

}

.invoice-card,
.card{
    width:100%;
    max-width:100%;
}

.invoice-title{

    font-size:24px;

}

.table{

    min-width:650px;

}

.summary h4{

    font-size:22px;

}

}

/* =========================
   PRINT
========================= */

@media print{

.sidebar,
.btn,
.back-btn{

    display:none !important;

}

.content{

    margin:0 !important;
    padding:0 !important;

}

.invoice-card{

    box-shadow:none;
    border:none;

}

}
@media (max-width:768px){

.invoice-card{

    padding:15px;

}

}

</style>

<div class="content">
<div class="div">
    <a href="/shopkeeper/billing" class="btn btn-success back-btn">
        ← Back to Billing
    </a>
    </div>
    <div class="text-end">
     <a href="{{ route('bill.history', $bill->customer_id) }}" class="btn btn-success btn-sm back-btn">
    Go to History >>
</a>
</div>
    <div class="invoice-card">

        <!-- HEADER -->

        <div class="invoice-header">

            <div>

                <div class="invoice-title">
                    INVOICE
                </div>

                <div class="invoice-id">
                    Bill ID : #{{ $bill->id }}
                </div>

            </div>

            <button onclick="window.print()" class="print-btn">

                🖨 Print Invoice

            </button>

        </div>

        <!-- DETAILS -->

        <div class="row g-3 mb-4">

            <div class="col-lg-6">

                <div class="info-box">

                    <h5>Customer Details</h5>

                    <p><strong>Name :</strong> {{ $bill->customer->customer_name }}</p>

                    <p><strong>Phone :</strong> {{ $bill->customer->phone }}</p>

                    <p><strong>Email :</strong> {{ $bill->customer->email }}</p>

                </div>

            </div>

            <div class="col-lg-6">

                <div class="info-box text-end">

                    <h5>Invoice Summary</h5>

                    <p><strong>Total :</strong> ₹{{ number_format($bill->total_amount,2) }}</p>

                    <p><strong>Paid :</strong> ₹{{ number_format($bill->paid_amount,2) }}</p>

                    <p><strong>Due :</strong> ₹{{ number_format($bill->due_amount,2) }}</p>

                    <span class="badge bg-success">

                        {{ ucfirst($bill->status) }}

                    </span>

                </div>

            </div>

        </div>

        <!-- TABLE -->

        <div class="table-responsive">

            <table class="table table-bordered">

                <thead>

                    <tr>

                        <th>Product</th>

                        <th>Price</th>

                        <th>Quantity</th>

                        <th>Amount</th>

                    </tr>

                </thead>

                <tbody>

                    @foreach($bill->items as $item)

                    <tr>

                        <td>

                            {{ $item->product->product_name ?? 'Product' }}

                        </td>

                        <td>

                            ₹{{ number_format($item->price,2) }}

                        </td>

                        <td>

                            {{ $item->qty }}

                        </td>

                        <td>

                            ₹{{ number_format($item->amount,2) }}

                        </td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

        <!-- TOTAL -->

        <div class="summary">

            <h4>

                Grand Total : ₹{{ number_format($bill->total_amount,2) }}

            </h4>

        </div>

    </div>

</div>