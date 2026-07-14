@include('shopkeeper.sidebar')

<style>

body{
    background:#f8f9fa;
}

.main-content{

    margin-left:270px;
    padding:30px;
    min-height:100vh;
    background:#f8f9fa;

}

.welcome-card{

    background:rgba(54, 107, 76, 0.68);
    color:#fff;
    border-radius:20px;
    padding:35px;
    margin-bottom:30px;
    box-shadow:0 12px 30px rgba(25,135,84,.20);

}

.stat-card{

    background:#fff;
    border-radius:18px;
    padding:25px;
    box-shadow:0 6px 20px rgba(0,0,0,.08);
    transition:.3s;
    height:100%;

}

.stat-card:hover{

    transform:translateY(-5px);

}

.stat-icon{

    width:60px;
    height:60px;
    border-radius:50%;
   background:rgba(54, 107, 76, 0.68);
    color:#fff;
    display:flex;
    justify-content:center;
    align-items:center;
    font-size:24px;
    margin-bottom:15px;

}

.stat-title{

    color:#6c757d;
    font-size:15px;

}

.stat-value{

    font-size:28px;
    font-weight:700;
    color:#198754;

}

.dashboard-box{

    background:#fff;
    border-radius:18px;
    box-shadow:0 6px 20px rgba(0,0,0,.08);
    margin-top:30px;

}

.dashboard-box .card-header{

    background:#fff;
    border-bottom:1px solid #eee;
    font-weight:700;
    color:#198754;

}

.quick-btn{

    background:#fff;
    border-radius:15px;
    padding:20px;
    text-align:center;
    text-decoration:none;
    color:#198754;
    font-weight:600;
    box-shadow:0 5px 15px rgba(0,0,0,.08);
    transition:.3s;
    display:block;

}

.quick-btn:hover{

    background:#198754;
    color:#fff;
    transform:translateY(-4px);

}

.quick-btn i{

    font-size:30px;
    margin-bottom:10px;
    display:block;

}

@media(max-width:992px){

.main-content{

margin-left:0;
padding:20px;

}

}

</style>

<div class="main-content">

<div class="welcome-card">

<h2>Welcome, {{ session('shop_name') }} 👋</h2>

<p class="mb-0">
Manage your customers, products, billing and reports from one place.
</p>

</div>

<div class="row g-4">

<!-- Customers -->

<div class="col-lg-3 col-md-6">

<div class="stat-card">

<div class="stat-icon">

<i class="fa-solid fa-users"></i>

</div>

<div class="stat-title">Total Customers</div>

<div class="stat-value">{{ $totalCustomers }}</div>

</div>

</div>

<!-- Products -->

<div class="col-lg-3 col-md-6">

<div class="stat-card">

<div class="stat-icon">

<i class="fa-solid fa-box"></i>

</div>

<div class="stat-title">Total Products</div>

<div class="stat-value">{{ $totalProducts }}</div>

</div>

</div>

<!-- Bills -->

<div class="col-lg-3 col-md-6">

<div class="stat-card">

<div class="stat-icon">

<i class="fa-solid fa-file-invoice"></i>

</div>

<div class="stat-title">Total Bills</div>

<div class="stat-value">{{ $totalBills }}</div>

</div>

</div>

<!-- Sales -->

<div class="col-lg-3 col-md-6">

<div class="stat-card">

<div class="stat-icon">

<i class="fa-solid fa-indian-rupee-sign"></i>

</div>

<div class="stat-title">Total Sales</div>

<div class="stat-value">₹{{ number_format($totalSales,2) }}</div>

</div>

</div>

<!-- Received -->

<div class="col-lg-3 col-md-6">

<div class="stat-card">

<div class="stat-icon">

<i class="fa-solid fa-wallet"></i>

</div>

<div class="stat-title">Received</div>

<div class="stat-value">₹{{ number_format($totalReceived,2) }}</div>

</div>

</div>

<!-- Due -->

<div class="col-lg-3 col-md-6">

<div class="stat-card">

<div class="stat-icon">

<i class="fa-solid fa-clock"></i>

</div>

<div class="stat-title">Total Due</div>

<div class="stat-value">₹{{ number_format($totalDue,2) }}</div>

</div>

</div>

<!-- Today's Bills -->

<div class="col-lg-3 col-md-6">

<div class="stat-card">

<div class="stat-icon">

<i class="fa-solid fa-calendar-day"></i>

</div>

<div class="stat-title">Today's Bills</div>

<div class="stat-value">{{ $todayBills }}</div>

</div>

</div>

<!-- Today's Sales -->

<div class="col-lg-3 col-md-6">

<div class="stat-card">

<div class="stat-icon">

<i class="fa-solid fa-chart-line"></i>

</div>

<div class="stat-title">Today's Sales</div>

<div class="stat-value">₹{{ number_format($todaySales,2) }}</div>

</div>

</div>

</div>

<div class="row mt-4">

<div class="col-lg-8">

<div class="dashboard-box card">

<div class="card-header">

Recent Bills

</div>

<div class="card-body">

<div class="card-body p-0">

    <div class="table-responsive">

        <table class="table table-hover mb-0">

            <thead class="table-light">

                <tr>
                    <th>Invoice</th>
                    <th>Customer</th>
                    <th>Date</th>
                    <th>Total</th>
                    <th>Status</th>
                </tr>

            </thead>

            <tbody>

                @forelse($recentBills as $bill)

                <tr>

                    <td>
                        INV-{{ str_pad($bill->id, 4, '0', STR_PAD_LEFT) }}
                    </td>

                    <td>
                        {{ $bill->customer->customer_name ?? '-' }}
                    </td>

                    <td>
                        {{ $bill->created_at->format('d-m-Y') }}
                    </td>

                    <td>
                        ₹{{ number_format($bill->total_amount,2) }}
                    </td>

                    <td>

                        @if($bill->status=='paid')

                            <span class="badge bg-success">Paid</span>

                        @elseif($bill->status=='partial')

                            <span class="badge bg-warning text-dark">
                                Partial
                            </span>

                        @else

                            <span class="badge bg-danger">
                                Due
                            </span>

                        @endif

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="5" class="text-center py-4 text-muted">

                        No Bills Found

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

</div>

</div>

</div>

<div class="col-lg-4">

<div class="dashboard-box card">

<div class="card-header">

Payment Reminder

</div>

<div class="card-body">

<div class="card-body p-0">

<div class="table-responsive">

<table class="table table-hover mb-0">

    <thead class="table-light">

        <tr>

            <th>Customer</th>
            <th>Due</th>
            <th>Action</th>

        </tr>

    </thead>

    <tbody>

        @forelse($dueCustomers as $bill)

        <tr>

            <td>

                {{ $bill->customer->customer_name ?? '-' }}

            </td>

            <td>

                <span class="text-danger fw-bold">

                    ₹{{ number_format($bill->due_amount,2) }}

                </span>

            </td>

            <td>

                <a href="{{ route('send.reminder',$bill->customer_id) }}"
                   class="btn btn-success btn-sm">

                    <i class="fa-brands fa-whatsapp"></i>

                </a>

            </td>

        </tr>

        @empty

        <tr>

            <td colspan="3" class="text-center text-muted py-4">

                🎉 No Pending Payments

            </td>

        </tr>

        @endforelse

    </tbody>

</table>

</div>

<div class="text-center p-3">

    <a href="{{ route('payment.reminder') }}"
       class="btn btn-outline-success btn-sm">

        View All

    </a>

</div>

</div>

</div>

</div>

</div>

</div>

<div class="dashboard-box card">

<div class="card-header">

Quick Actions

</div>

<div class="card-body">

<div class="row g-3">

<div class="col-md-2">
<a href="/shopkeeper/customers" class="quick-btn">
<i class="fa-solid fa-user-plus"></i>
Customer
</a>
</div>

<div class="col-md-2">
<a href="/shopkeeper/products" class="quick-btn">
<i class="fa-solid fa-box"></i>
Product
</a>
</div>

<div class="col-md-2">
<a href="/shopkeeper/billing" class="quick-btn">
<i class="fa-solid fa-file-invoice"></i>
Billing
</a>
</div>

<div class="col-md-2">
<a href="/shopkeeper/reminders" class="quick-btn">
<i class="fa-brands fa-whatsapp"></i>
Reminder
</a>
</div>

<div class="col-md-2">
<a href="/shopkeeper/previous_records" class="quick-btn">
<i class="fa-solid fa-chart-column"></i>
Previous Record
</a>
</div>
<div class="col-md-2">
<a href="/shopkeeper/calculator" class="quick-btn">
 <i class="fas fa-calculator"></i>
Calculator
</a>
</div>

</div>

</div>

</div>

</div>