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

}

@media(max-width:992px){

.table{

min-width:900px;

}

.content{

margin-left:0;
padding:20px;

}

}
</style>

<div class="content">

    <div class="container-fluid">

        <!-- Header -->
        <div class="card shadow-sm border-0 mb-4">

           <div class="card border-0 shadow-sm rounded-4 mb-4">
    <div class="card-body">

        <form id="searchForm" method="GET" action="{{ route('billing') }}">

            <div class="row align-items-center">

                <!-- Left Side -->
                <div class="col-lg-5 mb-3 mb-lg-0">

                    <h5 class="fw-bold mb-1">
                        Customer Billing
                    </h5>

                    <small class="text-muted">
                        Search customer by name or mobile number to generate bills and sort in order by clicking on Customer name.
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
                                    onchange="searchCustomer()">

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

        <!-- Customer List -->

        <div class="card border-0 shadow rounded-4">

    <div class="card-header bg-white border-0 py-3">

        <div class="d-flex justify-content-between align-items-center flex-wrap">

            <h5 class="fw-bold mb-0">

                Customer List

            </h5>

            <span class="badge bg-success fs-6">

                {{ count($customers) }} Customers

            </span>

        </div>

    </div>

    <div class="table-responsive">

        <table class="table table-hover align-middle mb-0">

            <thead>

                <tr>
                   <th>Sr. No.</th>
                   <th width:28%>
    <a href="{{ route('billing', [
        'sort' => request('sort') == 'asc' ? 'desc' : 'asc',
        'search' => request('search'),
        'show' => request('show')
    ]) }}" style="text-decoration:none;color:green">
        Customer Name
    </a>
</th>
                    <th>Gender</th>

                    <th>Phone</th>

                    <th>Email</th>

                    <th class="text-center">Generate</th>

                    <th class="text-center">History</th>

                </tr>

            </thead>

            <tbody>

                @forelse($customers as $customer)

                <tr>
                     <td>{{ $customers->firstItem() + $loop->index }}</td>


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

                        @if($customer->gender)

                        <span class="badge bg-light text-dark">

                            {{ $customer->gender }}

                        </span>

                        @else

                        -

                        @endif

                    </td>

                    <td>

                        {{ $customer->phone }}

                    </td>

                    <td>

                        {{ $customer->email ?: '-' }}

                    </td>

                    <td class="text-center">

                       <button
    class="btn btn-success btn-sm generateBillBtn"
    data-id="{{ $customer->id }}"
    data-name="{{ $customer->customer_name }}"
    data-phone="{{ $customer->phone }}"
    data-email="{{ $customer->email }}"
    data-gender="{{ $customer->gender }}"
    data-bs-toggle="modal"
    data-bs-target="#generateBillModal">

    <i class="fas fa-file-invoice"></i> Generate
</button>
                    </td>
                    

                    <td class="text-center">

                        <button
                            class="btn btn-outline-dark btn-sm px-3">

                            <i class="bi bi-clock-history me-1"></i>
<a href="{{ route('bill.history', $customer->id) }}" class="btn  btn-sm">
    History
</a>

                        </button>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="6">

                        <div class="text-center py-5">

                            <i class="bi bi-receipt-cutoff text-success"
                               style="font-size:70px;"></i>

                            <h4 class="mt-3">

                                No Customers Found

                            </h4>

                            <p class="text-muted">

                                Please add customers before generating bills.

                            </p>

                        </div>

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>
    <div class="modal fade" id="generateBillModal" tabindex="-1">

    <div class="modal-dialog modal-xl">

        <div class="modal-content">

            <form method="POST" action="{{ route('bill.store') }}" id="billForm">
                @csrf

                <!-- HEADER -->
               <!-- HEADER -->

<div class="modal-header bill-header">

    <div>

        <h4 class="mb-1">
            <i class="fas fa-file-invoice-dollar me-2"></i>
            Generate Invoice
        </h4>

        <small>
            Create a professional bill for your customer
        </small>

    </div>

    <button
        type="button"
        class="btn-close btn-close-white"
        data-bs-dismiss="modal">
    </button>

</div>

<!-- BODY -->

<div class="modal-body">

    <!-- Customer Card -->

    <div class="customer-box">

        <h5 class="section-title">
            Customer Information
        </h5>

        <div class="row">

            <div class="col-md-6 mb-3">

                <label>Customer Name</label>

                <input
                    type="text"
                    id="customerName"
                    class="form-control"
                    readonly>

            </div>

            <div class="col-md-6 mb-3">

                <label>Phone</label>

                <input
                    type="text"
                    id="customerPhone"
                    class="form-control"
                    readonly>

            </div>

            <div class="col-md-6 mb-3">

                <label>Email</label>

                <input
                    type="text"
                    id="customerEmail"
                    class="form-control"
                    readonly>

            </div>

            <div class="col-md-6 mb-3">

                <label>Gender</label>

                <input
                    type="text"
                    id="customerGender"
                    class="form-control"
                    readonly>

            </div>

        </div>

    </div>


    <!-- Product Card -->

    <div class="product-box mt-4">

        <h5 class="section-title">
            Add Product
        </h5>

        <div class="row g-3">

            <div class="col-lg-5">

                <label>Product</label>

                <select class="form-select" id="product">

                    <option value="">Select Product</option>

                    @foreach($products as $product)

                    <option
                        value="{{ $product->id }}"
                        data-name="{{ $product->product_name }}"
                        data-price="{{ $product->price }}">

                        {{ $product->product_name }}

                    </option>

                    @endforeach

                </select>

            </div>

            <div class="col-lg-2">

                <label>Price</label>

                <input
                    type="text"
                    class="form-control"
                    id="price"
                    readonly>

            </div>

            <div class="col-lg-2">

                <label>Qty</label>

                <input
                    type="number"
                    class="form-control"
                    id="qty"
                    value="1"
                    min="1">

            </div>

            <div class="col-lg-2">

                <label>Amount</label>

                <input
                    type="text"
                    class="form-control"
                    id="amount"
                    readonly>

            </div>

            <div class="col-lg-1 d-grid">

                <label>&nbsp;</label>

                <button
                    type="button"
                    class="btn btn-success"
                    id="addItemBtn">

                    <i class="fas fa-plus"></i>

                </button>

            </div>

        </div>

    </div>


    <!-- Items -->

    <div class="table-responsive mt-4">

        <table class="table table-bordered align-middle">

            <thead class="table-success">

                <tr>

                    <th>Product</th>

                    <th width="120">Price</th>

                    <th width="90">Qty</th>

                    <th width="130">Amount</th>

                    <th width="90">Remove</th>

                </tr>

            </thead>

            <tbody id="billItems">

                <tr>

                    <td colspan="5" class="text-center text-muted py-4">

                        No Products Added

                    </td>

                </tr>

            </tbody>

        </table>

    </div>


    <!-- Summary -->

    <div class="summary-card mt-4">

        <div class="row">

            <div class="col-md-4">

                <label>Grand Total</label>

                <h3 class="text-success">

                    ₹ <span id="grandTotal">0</span>

                </h3>

            </div>

            <div class="col-md-4">

                <label>Paid Amount</label>

                <input
                    type="number"
                    class="form-control"
                    id="paidAmount"
                    name="paid_amount"
                    value="0"
                    min="0">

            </div>

            <div class="col-md-4">

                <label>Due Amount</label>

                <input
                    type="text"
                    class="form-control"
                    id="dueAmount"
                    readonly>

            </div>

        </div>

    </div>

    <input type="hidden" name="customer_id" id="customer_id">

    <input type="hidden" name="cart_data" id="cartData">

</div>

<!-- FOOTER -->

<div class="modal-footer">

    <button
        type="button"
        class="btn btn-light border"
        data-bs-dismiss="modal">

        Cancel

    </button>

    <button
        type="submit"
        class="btn btn-success px-4">

        <i class="fas fa-file-invoice"></i>

        Save Bill

    </button>

</div>
</div>

<script>

let cart = [];

/* =========================
   CUSTOMER DATA FILL
========================= */
document.querySelectorAll('.generateBillBtn').forEach(button => {

    button.addEventListener('click', function () {

        document.getElementById('customerName').value = this.dataset.name;
        document.getElementById('customerPhone').value = this.dataset.phone;
        document.getElementById('customerEmail').value = this.dataset.email;
        document.getElementById('customerGender').value = this.dataset.gender;

        document.getElementById('customer_id').value = this.dataset.id;

        // reset cart for new customer
        cart = [];
        renderCart();
    });

});


/* =========================
   PRODUCT → PRICE AUTO
========================= */
document.getElementById('product').addEventListener('change', function () {

    let selected = this.options[this.selectedIndex];

    let price = selected.getAttribute('data-price') || 0;

    document.getElementById('price').value = price;
    document.getElementById('qty').value = 1;
    document.getElementById('amount').value = price;

});


/* =========================
   QTY → AMOUNT AUTO
========================= */
document.getElementById('qty').addEventListener('input', function () {

    let price = parseFloat(document.getElementById('price').value || 0);
    let qty = parseInt(this.value || 0);

    document.getElementById('amount').value = price * qty;

});


/* =========================
   ADD ITEM TO CART
========================= */
document.getElementById('addItemBtn').addEventListener('click', function () {

    let product = document.getElementById('product');
    let selected = product.options[product.selectedIndex];

    if (!selected.value) {
        alert("Please select a product");
        return;
    }

    let item = {
        product_id: selected.value,
        name: selected.dataset.name,
        price: parseFloat(document.getElementById('price').value || 0),
        qty: parseInt(document.getElementById('qty').value || 0),
        amount: parseFloat(document.getElementById('amount').value || 0)
    };

    cart.push(item);

    renderCart();

    // reset fields
    product.value = "";
    document.getElementById('price').value = "";
    document.getElementById('qty').value = 1;
    document.getElementById('amount').value = "";
});


/* =========================
   RENDER CART + TOTAL
========================= */
function renderCart() {

    let tbody = document.getElementById('billItems');
    tbody.innerHTML = "";

    let total = 0;

    if (cart.length === 0) {
        tbody.innerHTML = `
            <tr>
                <td colspan="5" class="text-center text-muted">
                    No Items Added
                </td>
            </tr>
        `;
    }

    cart.forEach((item, index) => {

        total += item.amount;

        tbody.innerHTML += `
            <tr>
                <td>${item.name}</td>
                <td>${item.price}</td>
                <td>${item.qty}</td>
                <td>${item.amount}</td>
                <td>
                    <button type="button" class="btn btn-danger btn-sm" onclick="removeItem(${index})">
                        X
                    </button>
                </td>
            </tr>
        `;
    });

    document.getElementById('grandTotal').innerText = total;

    // send cart to backend
    document.getElementById('cartData').value = JSON.stringify(cart);

    updateDue();
}


/* =========================
   PAID → DUE CALCULATION
========================= */
function updateDue() {

    let total = parseFloat(document.getElementById('grandTotal').innerText || 0);
    let paid = parseFloat(document.getElementById('paidAmount').value || 0);

    let due = total - paid;

    document.getElementById('dueAmount').value = (due < 0) ? 0 : due;
}


/* =========================
   PAID INPUT LISTENER
========================= */
document.getElementById('paidAmount').addEventListener('input', function () {
    updateDue();
});


/* =========================
   REMOVE ITEM
========================= */
function removeItem(index) {
    cart.splice(index, 1);
    renderCart();
}


/* =========================
   FORM SUBMIT HANDLER
========================= */
document.getElementById('billForm').addEventListener('submit', function () {

    // ensure latest cart is sent
    document.getElementById('cartData').value = JSON.stringify(cart);

});

</script>
<script>
function searchCustomer() {
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
</body>