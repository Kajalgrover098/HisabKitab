@include('shopkeeper.sidebar')

<style>
   .content{
    margin-left:270px;
    padding:30px;
    transition:.3s;

  
  
    background:#f8f9fa;

}

.customer-card{

    border:none;
    box-shadow:0 .125rem .25rem rgba(0,0,0,.075);

}

.table td,
.table th{

    vertical-align:middle;

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

.table thead{

    background:#f8f9fa;

}

.table th{

    font-weight:600;
    color:#495057;
    white-space:nowrap;
    padding:16px;

}

.table td{

    padding:16px;
    vertical-align:middle;

}

.card{

    border-radius:18px;

}

.input-group{

    border-radius:12px;
    overflow:hidden;

}

.form-control:focus{

    box-shadow:none;
    border-color:#198754;

}

.input-group-text{

    border-color:#dee2e6;

}

.badge{

    font-size:13px;

}

.btn{

    border-radius:8px;
    margin:auto;

}


/* ===================================
   RESPONSIVE DESIGN
=================================== */

@media (max-width:992px){

.content{
    margin-left:0 !important;
    padding:20px 15px;
}

.card-header{
    flex-direction:column;
    align-items:flex-start !important;
    gap:15px;
}

.card-header h4{
    font-size:22px;
}

.card-header .btn{
    width:100%;
}

.row.mb-3{
    flex-direction:column;
}

.row.mb-3 .col-md-4{
    width:100%;
}

.input-group{
    width:100%;
}

.table-responsive{
    overflow-x:auto;
}

.table{
    min-width:850px;
}

.pagination{
    justify-content:center;
    flex-wrap:wrap;
}

.d-flex.justify-content-between.align-items-center.mt-4{
    flex-direction:column;
    gap:15px;
    text-align:center;
}

.modal-dialog{
    margin:15px;
}

.modal-body{
    padding:20px !important;
}

.modal-footer{
    flex-direction:column;
}

.modal-footer .btn{
    width:100%;
}

}


/* Small Phones */

@media (max-width:576px){

.content{
    padding:15px 10px;
}

.card-header h4{
    font-size:20px;
}

.form-control,
.form-select{
    height:44px !important;
}

.modal-title{
    font-size:18px;
}

.table{
    font-size:14px;
}

.btn{
    font-size:14px;
}

.pagination .page-link{
    min-width:36px;
    height:36px;
    margin:2px;
}

}
.action-buttons{
    display:flex;
    justify-content:center;
    align-items:center;
    gap:8px;
    flex-wrap:wrap;
}

@media(max-width:768px){

    .action-buttons{
        flex-direction:column;
        width:100%;
    }

    .action-buttons .btn{
        width:100%;
    }

}
</style>

<div class="content">

    <div class="container-fluid">

        <!-- Header -->

        <div class="card border-0 shadow-sm rounded-4 mb-4">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center flex-wrap">

                    <div>

                        <h3 class="fw-bold text-green mb-1">

                            <i class="bi bi-bell-fill me-2"></i>

                            Payment Reminders

                        </h3>

                        <p class="text-muted mb-0">

                            View customers with pending payments and manage reminders.

                        </p>

                    </div>

                </div>

            </div>

        </div>

        <!-- Search -->
<!-- Search & Show Entries -->

<div class="card border-0 shadow-sm rounded-4 mb-4">
    <div class="card-body">

        <form id="searchForm" method="GET" action="{{ route('payment.reminder') }}">

            <div class="row align-items-center">

                <!-- Left Side -->
                <div class="col-lg-5 mb-3 mb-lg-0">

                    <h5 class="fw-bold mb-1">
                        Reminder List
                    </h5>

                    <small class="text-muted">
                        Search customer by name or mobile number.
                    </small>

                </div>

                <!-- Right Side -->
                <div class="col-lg-7">

                    <div class="row g-2 align-items-center">

                        <!-- Search -->
                        <div class="col-md-8">

                            <div class="input-group shadow-sm">

                                <span class="input-group-text bg-white border-end-0">
                                    <i class="bi bi-search text-warning"></i>
                                </span>

                                <input
                                    type="text"
                                    name="search"
                                    class="form-control border-start-0"
                                    placeholder="Search by customer name or mobile number..."
                                    value="{{ request('search') }}"
                                    onkeyup="debounceSearch()">

                            </div>

                        </div>

                        <!-- Show Entries -->
                        <div class="col-md-4">

                            <div class="d-flex align-items-center justify-content-md-end gap-2">

                                <label class="fw-semibold mb-0">
                                    Show
                                </label>

                                <select
                                    name="show"
                                    class="form-select form-select-sm"
                                    style="width:90px;"
                                    onchange="debounceSearch()">

                                    <option value="10" {{ request('show',10)==10 ? 'selected' : '' }}>10</option>
                                    <option value="25" {{ request('show')==25 ? 'selected' : '' }}>25</option>
                                    <option value="50" {{ request('show')==50 ? 'selected' : '' }}>50</option>
                                    <option value="100" {{ request('show')==100 ? 'selected' : '' }}>100</option>

                                </select>

                                <span class="fw-semibold">
                                    Entries
                                </span>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </form>

    </div>
</div>
        <!-- Table -->

        <div class="card border-0 shadow rounded-4">

            <div class="card-header bg-white border-0 py-3">

                <div class="d-flex justify-content-between align-items-center">

                    <h5 class="fw-bold mb-0">

                        Due Payment List

                    </h5>

                    <span class="badge  text-white" style="background:green">

                        {{ count($customers) }} Customers

                    </span>

                </div>

            </div>

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead class="table-light">

                        <tr>

                            <th>Customer</th>

                            <th>Gender</th>

                            <th>Phone</th>

<th>Current Due</th>

                            <th>Previous Due</th>

                            <th>Total Due</th>

                            <th>Pending Bills</th>

                            <th>Latest Due</th>

                            <th class="text-center">Actions</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($customers as $customer)

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

                                       

                                    </div>

                                </div>

                            </td>

                            <td>

                                {{ $customer->gender ?: '-' }}

                            </td>

                            <td>

                                {{ $customer->phone }}

                            </td>
                            <td>
    ₹{{ number_format($customer->current_due,2) }}
</td>
                            
                            <td>
    ₹{{ number_format($customer->previous_due,2) }}
</td>

                            <td>

                             ₹{{ number_format($customer->total_due,2) }}

                            </td>

                            <td>

                          {{ $customer->pending_bills }}

                            </td>

                            <td>

                          @if($customer->latest_due)
                            {{ \Carbon\Carbon::parse($customer->latest_due)->format('d-m-Y') }}
                        @else
                            -
                        @endif

                            </td>

                            <td class="text-center">

    <div class="action-buttons">

        <a href="{{ route('bill.history', $customer->id) }}"
           class="btn btn-outline-primary btn-sm">
            <i class="bi bi-eye"></i>
            <span class="d-none d-md-inline"> View</span>
        </a>

        <a href="{{ route('send.reminder',$customer->id) }}"
           class="btn btn-success btn-sm">
            <i class="bi bi-whatsapp"></i>
            <span class="d-none d-md-inline"> Send</span>
        </a>

    </div>

</td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="7">

                                <div class="text-center py-5">

                                    <i class="bi bi-bell-slash text-warning"
                                       style="font-size:70px;"></i>

                                    <h4 class="mt-3">

                                        No Due Payments

                                    </h4>

                                    <p class="text-muted">

                                        All customer payments are up to date.

                                    </p>

                                </div>

                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>
    <script>
function searchReminder() {
    document.getElementById('searchForm').submit();
}
</script>
<script>
let timer;

function debounceSearch() {
    clearTimeout(timer);

    timer = setTimeout(function () {
        document.getElementById('searchForm').submit();
    }, 500); // 500 ms delay
}
</script>