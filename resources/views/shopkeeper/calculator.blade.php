@include('shopkeeper.sidebar')
<style>
    /* ==========================================
   QUICK CALCULATOR
========================================== */

body{
    background:#f4f7fb;
}
.content{
    margin-left:270px;
    padding:30px;
    transition:.3s;

  
  
    background:#f8f9fa;


}

/* Card */

.calc-card{
    background:#fff;
    border-radius:18px;
    padding:28px;
    box-shadow:0 10px 30px rgba(0,0,0,.08);
    margin-bottom:25px;
}

/* Heading */

.calc-title{
    font-size:28px;
    font-weight:700;
    color:#198754;
}

.calc-subtitle{
    color:#6c757d;
    font-size:15px;
}

/* Labels */

label{
    font-weight:600;
    margin-bottom:6px;
}

/* Inputs */

.form-control,
.form-select{
    border-radius:10px;
    min-height:45px;
}

.form-control:focus,
.form-select:focus{
    box-shadow:none;
    border-color:#198754;
}

/* Buttons */

.btn-add{
    height:45px;
    width:45px;
    border-radius:10px;
    font-size:22px;
    font-weight:bold;
}

.btn-clear{
    border-radius:10px;
    padding:10px 22px;
}

.btn-remove{
    border-radius:8px;
}

/* Table */

.table{
    vertical-align:middle;
}

.table thead{
    background:#198754;
    color:#fff;
}

.table th{
    padding:14px;
}

.table td{
    padding:12px;
}

/* Empty Row */

.empty-row{
    color:#999;
    font-style:italic;
}

/* Grand Total */

.total-card{
    background:#198754;
    color:white;
    border-radius:15px;
    padding:20px;
    text-align:center;
}

.total-card h6{
    margin:0;
    font-size:15px;
}

.total-card h2{
    margin-top:8px;
    font-weight:bold;
}

/* Responsive */
/* ===========================
   Tablet
=========================== */

@media(max-width:992px){

    .container{
        margin-top:75px;
        padding:15px;
    }

    .calc-card{
        padding:20px;
    }

    .calc-title{
        font-size:24px;
    }

    .calc-subtitle{
        font-size:14px;
    }

    .table{
        min-width:650px;
    }

}

/* ===========================
   Mobile
=========================== */

@media(max-width:768px){

    .container{
        margin-top:75px;
        padding:12px;
    }

    .calc-card{
        padding:15px;
        border-radius:12px;
    }

    .d-flex{
        flex-direction:column;
        align-items:flex-start !important;
        gap:12px;
    }

    .btn-clear{
        width:100%;
    }

    .calc-title{
        font-size:22px;
    }

    .calc-subtitle{
        font-size:13px;
        margin-bottom:0;
    }

    label{
        font-size:13px;
    }

    .form-control,
    .form-select{
        height:42px;
        font-size:13px;
    }

    .btn-add{
        width:100%;
        height:42px;
        font-size:18px;
    }

    .table{
        min-width:600px;
    }

    .table th,
    .table td{
        padding:8px;
        font-size:12px;
        white-space:nowrap;
    }

    .total-card{
        margin-top:15px;
        padding:15px;
    }

    .total-card h6{
        font-size:13px;
    }

    .total-card h2{
        font-size:24px;
    }

}

/* ===========================
   Small Mobile
=========================== */

@media(max-width:480px){

    .container{
        margin-top:70px;
        padding:10px;
    }

    .calc-card{
        padding:12px;
    }

    .calc-title{
        font-size:20px;
    }

    .calc-subtitle{
        font-size:12px;
    }

    label{
        font-size:12px;
    }

    .form-control,
    .form-select{
        font-size:12px;
    }

    .table{
        min-width:550px;
    }

    .table th,
    .table td{
        padding:7px;
        font-size:11px;
    }

    .btn-clear,
    .btn-add{
        font-size:13px;
    }

    .total-card h2{
        font-size:22px;
    }

}
</style>
<body>
    <div class="content">


    <!-- Header -->
    <div class="calc-card">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>
                <h2 class="calc-title">
                    <i class="bi bi-calculator"></i>
                    Quick Calculator
                </h2>

                <p class="calc-subtitle">
                    Calculate bill instantly without saving any data.
                </p>
            </div>

            <button class="btn btn-danger btn-clear" id="clearCalculator">
                <i class="bi bi-arrow-clockwise"></i>
                Clear
            </button>

        </div>

        <hr>

        <!-- Add Product -->

        <h5 class="mb-3">
            <i class="bi bi-cart-plus"></i>
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

                <label>Quantity</label>

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

            <div class="col-lg-1 d-flex align-items-end">

                <button
                    type="button"
                    class="btn btn-success btn-add"
                    id="addItemBtn">

                    +

                </button>

            </div>

        </div>

        <hr class="my-4">

        <!-- Items Table -->

        <div class="table-responsive">

            <table class="table table-bordered table-hover">

                <thead>

                    <tr>

                        <th>Product</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Amount</th>
                        <th>Action</th>

                    </tr>

                </thead>

                <tbody id="billItems">

                    <tr class="empty-row">

                        <td colspan="5" class="text-center">

                            No Products Added

                        </td>

                    </tr>

                </tbody>

            </table>

        </div>

        <!-- Grand Total -->

        <div class="row mt-4">

            <div class="col-md-8"></div>

            <div class="col-md-4">

                <div class="total-card">

                    <h6>Grand Total</h6>

                    <h2>

                        ₹ <span id="grandTotal">0.00</span>

                    </h2>

                </div>

            </div>

        </div>

    </div>


</div>
<script>

let grandTotal = 0;

// Elements

const product = document.getElementById("product");
const price = document.getElementById("price");
const qty = document.getElementById("qty");
const amount = document.getElementById("amount");
const billItems = document.getElementById("billItems");
const grandTotalSpan = document.getElementById("grandTotal");


// ============================
// Product Change
// ============================

product.addEventListener("change", function () {

    let selected = this.options[this.selectedIndex];

    if(this.value=="")
    {
        price.value="";
        qty.value=1;
        amount.value="";
        return;
    }

    let p = parseFloat(selected.dataset.price);

    price.value = p.toFixed(2);

    amount.value = (p * qty.value).toFixed(2);

});


// ============================
// Qty Change
// ============================

qty.addEventListener("input", function(){

    if(price.value=="")
    {
        amount.value="";
        return;
    }

    amount.value = (parseFloat(price.value) * this.value).toFixed(2);

});


// ============================
// Add Item
// ============================

document.getElementById("addItemBtn").addEventListener("click",function(){

    if(product.value=="")
    {
        alert("Please select a product.");
        return;
    }

    let productName = product.options[product.selectedIndex].dataset.name;

    let productPrice = parseFloat(price.value);

    let quantity = parseInt(qty.value);

    let total = parseFloat(amount.value);



    // Remove Empty Row

    if(document.querySelector(".empty-row"))
    {
        document.querySelector(".empty-row").remove();
    }



    let row =

    `<tr>

        <td>${productName}</td>

        <td>₹ ${productPrice.toFixed(2)}</td>

        <td>${quantity}</td>

        <td>₹ ${total.toFixed(2)}</td>

        <td>

            <button
            class="btn btn-danger btn-sm removeBtn">

            Remove

            </button>

        </td>

    </tr>`;


    billItems.insertAdjacentHTML("beforeend",row);



    grandTotal += total;

    grandTotalSpan.innerHTML = grandTotal.toFixed(2);



    // Reset

    product.selectedIndex=0;
    price.value="";
    qty.value=1;
    amount.value="";

});



// ============================
// Remove Item
// ============================

billItems.addEventListener("click",function(e){

if(e.target.classList.contains("removeBtn"))
{

    let row = e.target.closest("tr");

    let value = row.cells[3].innerText.replace("₹","");

    grandTotal -= parseFloat(value);

    grandTotalSpan.innerHTML = grandTotal.toFixed(2);

    row.remove();



    if(billItems.rows.length==0)
    {

        billItems.innerHTML=

        `<tr class="empty-row">

            <td colspan="5" class="text-center">

                No Products Added

            </td>

        </tr>`;

    }

}

});



// ============================
// Clear Calculator
// ============================

document.getElementById("clearCalculator").addEventListener("click",function(){

    if(!confirm("Clear complete calculator?"))
    return;

    grandTotal=0;

    grandTotalSpan.innerHTML="0.00";

    product.selectedIndex=0;

    price.value="";

    qty.value=1;

    amount.value="";

    billItems.innerHTML=

    `<tr class="empty-row">

        <td colspan="5" class="text-center">

            No Products Added

        </td>

    </tr>`;

});

</script>
</body>