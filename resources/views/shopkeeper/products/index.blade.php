@include('shopkeeper.sidebar')
<style>

.content{
    margin-left:270px;
    padding:30px;
    transition:.3s;

    background:#f8f9fa;

}

.card{
    border:none;
    border-radius:15px;
    overflow:hidden;
    box-shadow:0 5px 15px rgba(0,0,0,.08);
}

.card-header{
    background:#fff;
    border-bottom:1px solid #eee;
    padding:18px 25px;
}

.card-header h4{
    font-weight:700;
    color:#198754;
}

.btn-success{
    border-radius:8px;
    padding:8px 18px;
    font-weight:600;
}

.form-control{
    border-radius:8px;
    height:45px;
}

.table{
    margin-top:10px;
}

.table thead{
    background:#198754;
    color:#fff;
}

.table thead th{
    text-align:center;
    vertical-align:middle;
}

.table tbody td{
    vertical-align:middle;
}

.table tbody tr:hover{
    background:#f8f9fa;
    transition:.3s;
}

.badge{
    padding:8px 12px;
    border-radius:20px;
    font-size:13px;
}

.btn-info,
.btn-warning,
.btn-danger{

    width:38px;
    height:38px;
    border-radius:8px;
    color:#fff;
}

.pagination{
    justify-content: end;
    margin-top: 20px;
}

.pagination .page-link{
    color:#198754;
    border:1px solid #dcdcdc;
    border-radius:10px;
    margin:0 4px;
    min-width:42px;
    height:42px;
    display:flex;
    align-items:center;
    justify-content:center;
    font-weight:600;
    transition:.3s;
    box-shadow:none;
}

.pagination .page-link:hover{
    background:#198754;
    color:#fff;
    border-color:#198754;
}

.pagination .page-item.active .page-link{
    background:#198754;
    border-color:#198754;
    color:#fff;
}

.pagination .page-item.disabled .page-link{
    color:#aaa;
    background:#f8f9fa;
    border-color:#eee;
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

</style>

<div class="content">
   @if(session('success'))

<script>

Swal.fire({

    icon:'success',
    title:'Success',
    text:'{{ session("success") }}',
    timer:2000,
    showConfirmButton:false

});

</script>

@endif
    <div class="card shadow-sm">

        <div class="card-header d-flex justify-content-between align-items-center">

            <h4 class="mb-0">
                <i class="fas fa-box"></i> Products
            </h4>

           <button class="btn btn-success"
        data-bs-toggle="modal"
        data-bs-target="#addProductModal">

    <i class="fas fa-plus"></i> Add Product

</button>

        </div>

        <div class="card-body">

            <div class="row mb-3 justify-content-end">

    <div class="col-lg-4 col-md-6 col-12">

                    <form method="GET" action="{{ route('shopkeeper.products') }}">
    <div class="input-group shadow-sm">

       

        <input
            type="text"
            name="search"
            class="form-control border-start-0"
            placeholder="Search Product..."
            value="{{ request('search') }}">

        <button class="btn btn-success" type="submit"> <i class="bi bi-search "></i>
            
        </button>

    </div>
</form>

                </div>

            </div>
            <div class="table-responsive">



            <table class="table table-bordered table-hover text-center">

                <thead class="table-success">

                    <tr>

                        <th>#</th>
                        <th>Product Code</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Status</th>
                        <th width="180">Action</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($products as $product)

                        <tr>

                            <td>{{ $loop->iteration }}</td>

                            <td>{{ $product->product_code }}</td>

                            <td>{{ $product->product_name }}</td>

                            <td>₹ {{ number_format($product->price,2) }}</td>

                            <td>{{ $product->stock }}</td>

                            <td>

                                @if($product->status=='Active')

                                    <span class="badge bg-success">
                                        Active
                                    </span>

                                @else

                                    <span class="badge bg-danger">
                                        Inactive
                                    </span>

                                @endif

                            </td>

                           <td>

   <a href="#"
   class="text-primary me-3 editProductBtn"

   data-id="{{ $product->id }}"
   data-name="{{ $product->product_name }}"
   data-price="{{ $product->price }}"
   data-unit="{{ $product->unit }}"
   data-stock="{{ $product->stock }}"
   data-status="{{ $product->status }}"

   data-bs-toggle="modal"
   data-bs-target="#editProductModal">

    <i class="fas fa-edit"></i>

</a>

    <a href="{{ route('shopkeeper.products.delete',$product->id) }}"
   class="text-danger deleteProduct"
   title="Delete">

    <i class="fas fa-trash-alt"></i>

</a>

</td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="7" class="text-center text-danger">
                               <i class="fas fa-box-open fa-2x text-secondary mb-2"></i>

<br>

No Products Found
                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>
            </div>

          <div class="d-flex justify-content-between align-items-center mt-4">

    <div class="text-muted small">
        Showing
        {{ $products->firstItem() }}
        to
        {{ $products->lastItem() }}
        of
        {{ $products->total() }}
        Products
    </div>

    <div>
        {{ $products->links() }}
    </div>

</div>

        </div>

    </div>
    
    <!-- Add Product Modal -->

<!-- Add Product Modal -->
<div class="modal fade" id="addProductModal" tabindex="-1" aria-hidden="true">

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content"
             style="border:none;border-radius:18px;overflow:hidden;box-shadow:0 15px 40px rgba(0,0,0,.15);">

            <!-- Header -->
            <div class="modal-header"
                 style="background:#198754;padding:18px 25px;">

                <h5 class="modal-title text-white fw-bold">
                    <i class="fas fa-plus-circle me-2"></i>Add Product
                </h5>

                <button type="button"
                        class="btn-close btn-close-white"
                        data-bs-dismiss="modal">
                </button>

            </div>

            <form action="{{ route('shopkeeper.products.store') }}" method="POST">

                @csrf

                <div class="modal-body"
                     style="padding:30px;background:#fafafa;">

                    <div class="row">

                        <!-- Product Name -->
                        <div class="col-md-6 mb-4">

                            <label class="form-label fw-semibold">
                                <i class="fas fa-box text-success me-1"></i>
                                Product Name
                            </label>

                            <input type="text"
                                   name="product_name"
                                   class="form-control"
                                   placeholder="Enter Product Name"
                                   style="height:48px;border-radius:10px;"
                                   required>

                        </div>

                        <!-- Unit -->
                        <div class="col-md-6 mb-4">

                            <label class="form-label fw-semibold">
                                <i class="fas fa-balance-scale text-success me-1"></i>
                                Unit
                            </label>

                            <select name="unit"
                                    class="form-select"
                                    style="height:48px;border-radius:10px;"
                                    required>

                                <option value="">Select Unit</option>
                                <option value="Piece">Piece</option>
                                <option value="Kg">Kg</option>
                                <option value="Gram">Gram</option>
                                <option value="Litre">Litre</option>
                                <option value="Ml">Ml</option>
                                <option value="Packet">Packet</option>
                                <option value="Bottle">Bottle</option>
                                <option value="Box">Box</option>
                                <option value="Dozen">Dozen</option>

                            </select>

                        </div>

                        <!-- Selling Price -->
                        <div class="col-md-6 mb-4">

                            <label class="form-label fw-semibold">
                                <i class="fas fa-indian-rupee-sign text-success me-1"></i>
                                Selling Price
                            </label>

                            <input type="number"
                                   step="0.01"
                                   min="0"
                                   name="price"
                                   class="form-control"
                                   placeholder="Enter Selling Price"
                                   style="height:48px;border-radius:10px;"
                                   required>

                        </div>

                        <!-- Stock -->
                        <div class="col-md-6 mb-4">

                            <label class="form-label fw-semibold">
                                <i class="fas fa-cubes text-success me-1"></i>
                                Stock Quantity
                            </label>

                            <input type="number"
                                   min="0"
                                   name="stock"
                                   class="form-control"
                                   placeholder="Enter Stock Quantity"
                                   style="height:48px;border-radius:10px;"
                                   required>

                        </div>

                        <!-- Status -->
                        <div class="col-md-6 mb-2">

                            <label class="form-label fw-semibold">
                                <i class="fas fa-toggle-on text-success me-1"></i>
                                Status
                            </label>

                            <select name="status"
                                    class="form-select"
                                    style="height:48px;border-radius:10px;">

                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>

                            </select>

                        </div>

                    </div>

                </div>

                <!-- Footer -->
                <div class="modal-footer"
                     style="padding:18px 25px;background:#fff;border-top:1px solid #eee;">

                    <button type="button"
                            class="btn btn-light"
                            data-bs-dismiss="modal"
                            style="padding:10px 25px;border-radius:8px;">

                        Cancel

                    </button>

                    <button type="submit"
                            class="btn btn-success"
                            style="padding:10px 30px;border-radius:8px;">

                        <i class="fas fa-save me-1"></i>
                        Save Product

                    </button>

                </div>

            </form>

        </div>

    </div>


</div>
<!-- Edit Product Modal -->

<!-- Edit Product Modal -->
<div class="modal fade" id="editProductModal" tabindex="-1" aria-hidden="true">

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content"
             style="border:none;border-radius:18px;overflow:hidden;box-shadow:0 15px 40px rgba(0,0,0,.15);">

            <!-- Header -->
            <div class="modal-header"
                 style="background:#198754;padding:18px 25px;">

                <h5 class="modal-title text-white fw-bold">
                    <i class="fas fa-edit me-2"></i>Edit Product
                </h5>

                <button type="button"
                        class="btn-close btn-close-white"
                        data-bs-dismiss="modal">
                </button>

            </div>

            <form id="editProductForm" method="POST">

                @csrf

                <div class="modal-body" style="padding:30px; background:#fafafa;">

                    <div class="row">

                        <!-- Product Name -->
                        <div class="col-md-6 mb-4">

                            <label class="form-label fw-semibold">
                                <i class="fas fa-box text-success me-1"></i>
                                Product Name
                            </label>

                            <input type="text"
                                   name="product_name"
                                   id="edit_product_name"
                                   class="form-control"
                                   style="height:48px;border-radius:10px;">

                        </div>

                        <!-- Price -->
                        <div class="col-md-6 mb-4">

                            <label class="form-label fw-semibold">
                                <i class="fas fa-indian-rupee-sign text-success me-1"></i>
                                Selling Price
                            </label>

                            <input type="number"
                                   step="0.01"
                                   name="price"
                                   id="edit_price"
                                   class="form-control"
                                   style="height:48px;border-radius:10px;">

                        </div>

                        <!-- Unit -->
                        <div class="col-md-6 mb-4">

                            <label class="form-label fw-semibold">
                                <i class="fas fa-balance-scale text-success me-1"></i>
                                Unit
                            </label>

                            <select name="unit"
                                    id="edit_unit"
                                    class="form-select"
                                    style="height:48px;border-radius:10px;">

                                <option value="Piece">Piece</option>
                                <option value="Kg">Kg</option>
                                <option value="Gram">Gram</option>
                                <option value="Litre">Litre</option>
                                <option value="Ml">Ml</option>
                                <option value="Packet">Packet</option>
                                <option value="Dozen">Dozen</option>

                            </select>

                        </div>

                        <!-- Stock -->
                        <div class="col-md-6 mb-4">

                            <label class="form-label fw-semibold">
                                <i class="fas fa-cubes text-success me-1"></i>
                                Stock Quantity
                            </label>

                            <input type="number"
                                   name="stock"
                                   id="edit_stock"
                                   class="form-control"
                                   style="height:48px;border-radius:10px;">

                        </div>

                        <!-- Status -->
                        <div class="col-md-6 mb-2">

                            <label class="form-label fw-semibold">
                                <i class="fas fa-toggle-on text-success me-1"></i>
                                Status
                            </label>

                            <select name="status"
                                    id="edit_status"
                                    class="form-select"
                                    style="height:48px;border-radius:10px;">

                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>

                            </select>

                        </div>

                    </div>

                </div>

                <!-- Footer -->
                <div class="modal-footer"
                     style="padding:18px 25px;background:#fff;border-top:1px solid #eee;">

                    <button type="button"
                            class="btn btn-light"
                            data-bs-dismiss="modal"
                            style="padding:10px 25px;border-radius:8px;">

                        Cancel

                    </button>

                    <button type="submit"
                            class="btn btn-success"
                            style="padding:10px 30px;border-radius:8px;">

                        <i class="fas fa-save me-1"></i>
                        Update Product

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

</div>

    <script>

document.querySelectorAll('.editProductBtn').forEach(function(button){

    button.addEventListener('click',function(){

        document.getElementById('edit_product_name').value=this.dataset.name;

        document.getElementById('edit_price').value=this.dataset.price;

        document.getElementById('edit_unit').value=this.dataset.unit;

        document.getElementById('edit_stock').value=this.dataset.stock;

        document.getElementById('edit_status').value=this.dataset.status;

        document.getElementById('editProductForm').action="/shopkeeper/products/update/"+this.dataset.id;

    });

});


</script>
<script>

document.querySelectorAll('.deleteProduct').forEach(function(button){

    button.addEventListener('click', function(e){

        e.preventDefault();

        let url = this.href;

        Swal.fire({

            title: 'Delete Product?',
            text: 'You can restore this product later.',
            icon: 'warning',

            showCancelButton: true,

            confirmButtonColor: '#198754',
            cancelButtonColor: '#dc3545',

            confirmButtonText: 'Yes, Delete',
            cancelButtonText: 'Cancel'

        }).then((result)=>{

            if(result.isConfirmed){

                window.location.href = url;

            }

        });

    });

});

</script>
@if ($errors->any())
<script>
document.addEventListener("DOMContentLoaded", function () {

    var modal = new bootstrap.Modal(document.getElementById('addProductModal'));
    modal.show();

    Swal.fire({
        icon: 'error',
        title: 'Validation Error',
        html: `{!! implode('<br>', $errors->all()) !!}`,
        confirmButtonText: 'OK',
        confirmButtonColor: '#d33'
    });

});
</script>
@endif