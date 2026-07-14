@include('shopkeeper.sidebar')
@if ($errors->any())
<script>
Swal.fire({
    icon: 'error',
    title: 'Validation Error',
    html: `{!! implode('<br>', $errors->all()) !!}`,
    confirmButtonColor: '#d33'
});
</script>
@endif

<style>

.content{
    margin-left:270px;
    padding:30px;
    transition:.3s;

  
  
    background:#f8f9fa;


}

.page-header{

    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:25px;

}

.page-title h2{

    font-size:30px;
    font-weight:700;
    color:#198754;
    margin-bottom:5px;

}

.page-title p{

    color:#6c757d;
    margin:0;

}

.add-btn{

    border-radius:10px;
    padding:10px 22px;
    font-weight:600;
    transition:.3s;

}

.add-btn:hover{

    transform:translateY(-2px);

}

.customer-card{

    background:#fff;
    border:none;
    border-radius:18px;
    box-shadow:0 5px 18px rgba(0,0,0,.08);
    overflow:hidden;

}

.table{

    margin-bottom:0;

}

.table thead{

    background:#eaf7f1;

}

.table thead th{

    color:#198754;
    font-weight:700;
    border:none;
    padding:16px;

}

.table tbody td{

    vertical-align:middle;
    padding:16px;

}

.table tbody tr{

    transition:.3s;

}

.table tbody tr:hover{

    background:#f8fbf9;

}

.action-btn{

    width:38px;
    height:38px;
    border-radius:50%;
    display:inline-flex;
    align-items:center;
    justify-content:center;
    margin-right:6px;

}

.empty-state{

    padding:50px 20px;
    text-align:center;

}

.empty-state i{

    font-size:55px;
    color:#198754;
    margin-bottom:15px;

}

.empty-state h5{

    font-weight:700;
    color:#198754;

}

.empty-state p{

    color:#6c757d;
    margin-bottom:0;

}
.modal-content{

    border-radius:20px;

}

.modal-header{

    border-bottom:none;

    padding:20px 30px;

}

.modal-body{

    background:#fafafa;

}

.modal-footer{

    border-top:none;

    background:#fff;

}

.form-label{

    font-weight:600;

    color:#2d3436;

}

.form-control,
.form-select{

    border-radius:10px;

    padding:10px 14px;

    border:1px solid #dcdfe4;

    transition:.3s;

}

.form-control:focus,
.form-select:focus{

    border-color:#4CAF72;

    box-shadow:0 0 0 .15rem rgba(76,175,114,.20);

}

.btn{

    border-radius:10px;

    font-weight:500;

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

<div class="alert alert-success alert-dismissible fade show">

    {{ session('success') }}

    <button
        class="btn-close"
        data-bs-dismiss="alert">
    </button>

</div>

@endif

    <div class="page-header">

        <div class="page-title">

            <h2>Customers</h2>

            <p>Manage all your customers from one place.</p>

        </div>

        <button
            class="btn btn-success add-btn"
            data-bs-toggle="modal"
            data-bs-target="#addCustomerModal">

            <i class="bi bi-plus-circle"></i>

            Add Customer

        </button>

    </div>

    <div class="card customer-card">

        <div class="table-responsive">

            <table class="table align-middle">

                <thead>

                    <tr>

                        <th>Customer Name</th>

                        <th>Phone</th>

                        <th>Email</th>

                        <th>Gender</th>

                        <th>Address</th>

                        <th width="140">Actions</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($customers as $customer)

                    <tr>

                        <td>{{ $customer->customer_name }}</td>

                        <td>{{ $customer->phone }}</td>

                        <td>{{ $customer->email ?: '-' }}</td>

                        <td>{{ $customer->gender ?: '-' }}</td>

                        <td>{{ $customer->address ?: '-' }}</td>

                        <td>
<button
class="btn btn-outline-success action-btn"
data-bs-toggle="modal"
data-bs-target="#editCustomerModal{{ $customer->id }}">

<i class="bi bi-pencil-square"></i>

</button>

                           <button
class="btn btn-outline-danger action-btn"
data-bs-toggle="modal"
data-bs-target="#deleteCustomer{{ $customer->id }}">

<i class="bi bi-trash"></i>

</button>

                        </td>

                    </tr>
                  <!-- Edit Customer Modal -->
<div class="modal fade" id="editCustomerModal{{ $customer->id }}" tabindex="-1">

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content border-0 shadow-lg rounded-4">

            <form action="{{ route('customers.update',$customer->id) }}" method="POST">

                @csrf

                <div class="modal-header bg-success bg-gradient text-white">

                    <div>

                        <h4 class="mb-1 fw-bold">
                            <i class="bi bi-pencil-square me-2"></i>
                            Edit Customer
                        </h4>

                        <small class="opacity-75">
                            Update customer information
                        </small>

                    </div>

                    <button
                        type="button"
                        class="btn-close btn-close-white"
                        data-bs-dismiss="modal">
                    </button>

                </div>

                <div class="modal-body p-4">

                    <div class="row g-3">

                        <!-- Customer Name -->

                        <div class="col-md-6">

                            <label class="form-label fw-semibold">

                                Customer Name
                                <span class="text-danger">*</span>

                            </label>

                            <input
                                type="text"
                                name="customer_name"
                                class="form-control edit-name"
                                value="{{ old('customer_name',$customer->customer_name) }}"
                                placeholder="Enter customer name">

                            
<small class="text-danger edit-name-error"></small>
                            

                        </div>

                        <!-- Phone -->

                        <div class="col-md-6">

                            <label class="form-label fw-semibold">

                                Phone Number
                                <span class="text-danger">*</span>

                            </label>

                            <input
                                type="text"
                                name="phone"
                                maxlength="10"
                                class="form-control edit-phone"
                                value="{{ old('phone',$customer->phone) }}"
                                placeholder="Enter phone number">

                           <small class="text-danger edit-phone-error"></small>
                        </div>

                        <!-- Email -->

                        <div class="col-md-6">

                            <label class="form-label fw-semibold">

                                Email

                            </label>

                            <input
                                type="email"
                                name="email"
                                class="form-control edit-email"
                                value="{{ old('email',$customer->email) }}"
                                placeholder="Enter email address">

                            <small class="text-danger edit-email-error"></small>

                        </div>

                        <!-- Gender -->

                        <div class="col-md-6">

                            <label class="form-label fw-semibold">

                                Gender

                            </label>

                            <select
                                name="gender"
                                class="form-select edit-gender">

                                <option value="">Select Gender</option>

                                <option value="Male"
                                    {{ $customer->gender=='Male' ? 'selected' : '' }}>
                                    Male
                                </option>

                                <option value="Female"
                                    {{ $customer->gender=='Female' ? 'selected' : '' }}>
                                    Female
                                </option>

                                <option value="Other"
                                    {{ $customer->gender=='Other' ? 'selected' : '' }}>
                                    Other
                                </option>

                            </select>

                        </div>

                        <!-- Address -->

                        <div class="col-12">

                            <label class="form-label fw-semibold">

                                Address

                            </label>

                            <textarea
                                name="address"
                                rows="4"
                                class="form-control edit-address"
                                placeholder="Enter complete address">{{ old('address',$customer->address) }}</textarea>

                        </div>

                    </div>

                </div>

                <div class="modal-footer px-4 py-3">

                    <button
                        type="button"
                        class="btn btn-light border"
                        data-bs-dismiss="modal">

                        Cancel

                    </button>

                    <button
                        type="submit"
                        class="btn btn-success px-4">

                        <i class="bi bi-check-circle me-1"></i>

                        Update Customer

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>
<div class="modal fade" id="deleteCustomer{{ $customer->id }}">

<div class="modal-dialog">

<div class="modal-content">

<div class="modal-header">

<h5>Delete Customer</h5>

<button
class="btn-close"
data-bs-dismiss="modal"></button>

</div>

<div class="modal-body">

Are you sure you want to delete

<strong>

{{ $customer->customer_name }}

</strong>?

</div>

<div class="modal-footer">

<button
class="btn btn-secondary"
data-bs-dismiss="modal">

Cancel

</button>

<a
href="{{ route('customers.delete',$customer->id) }}"
class="btn btn-danger">

Delete

</a>

</div>

</div>

</div>

</div>

                    @empty

                    <tr>

                        <td colspan="6">

                            <div class="empty-state">

                                <i class="bi bi-people"></i>

                                <h5>No Customers Found</h5>

                                <p>Click the <strong>Add Customer</strong> button to create your first customer.</p>

                            </div>

                        </td>

                    </tr>
                    

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

{{-- Add Customer Modal --}}
<div class="modal fade" id="addCustomerModal">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">Add Customer</h5>

                <button class="btn-close" data-bs-dismiss="modal"></button>

            </div>

            <form action="{{ route('customers.store') }}" method="POST" id="customerForm">

    @csrf

    <div class="modal-body">

        <div class="row">

            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Customer Name <span class="text-danger">*</span>
                </label>

                <input
                    type="text"
                    name="customer_name"
                    id="customer_name"
                    class="form-control"
                    value="{{ old('customer_name') }}"
                    placeholder="Enter customer name">

                <small class="text-danger" id="customer_name_error"></small>

            </div>

            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Phone Number <span class="text-danger">*</span>
                </label>

                <input
                    type="text"
                    name="phone"
                    id="phone"
                    maxlength="10"
                    class="form-control"
                    value="{{ old('phone') }}"
                    placeholder="Enter phone number">

                <small class="text-danger" id="phone_error"></small>

            </div>

            <div class="col-md-6 mb-3">

                <label class="form-label">

                    Email

                </label>

                <input
                    type="email"
                    name="email"
                    id="email"
                    class="form-control"
                    value="{{ old('email') }}"
                    placeholder="Enter email">

                <small class="text-danger" id="email_error"></small>

            </div>

            <div class="col-md-6 mb-3">

                <label class="form-label">

                    Gender

                </label>

                <select
                    name="gender"
                    id="gender"
                    class="form-select">

                    <option value="">Select Gender</option>

                    <option value="Male">Male</option>

                    <option value="Female">Female</option>

                    <option value="Other">Other</option>

                </select>

                <small class="text-danger" id="gender_error"></small>

            </div>

            <div class="col-12 mb-3">

                <label class="form-label">

                    Address

                </label>

                <textarea
                    name="address"
                    id="address"
                    rows="3"
                    class="form-control"
                    placeholder="Enter address">{{ old('address') }}</textarea>

                <small class="text-danger" id="address_error"></small>

            </div>

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
            type="submit"
            class="btn btn-success">

            Save Customer

        </button>

    </div>

</form>

        </div>

    </div>
    @if ($errors->any())

<script>

document.addEventListener('DOMContentLoaded',function(){

    var modal=new bootstrap.Modal(document.getElementById('addCustomerModal'));

    modal.show();

});

</script>

@endif

</div>
<script>

document.getElementById('customer_name').addEventListener('keypress',function(e){

    if(/[0-9]/.test(e.key)){

        e.preventDefault();

    }

});

document.getElementById('phone').addEventListener('input',function(){

    this.value=this.value.replace(/\D/g,'');

    if(this.value.length>0){

        let first=this.value.charAt(0);

        if(first<'6'){

            this.value='';

        }

    }

});

</script>
<script>

// ===============================
// Customer Name
// ===============================

document.querySelectorAll('.edit-name').forEach(function(input){

    input.addEventListener('keypress',function(e){

        if(/[0-9]/.test(e.key)){

            e.preventDefault();

        }

    });

});

// ===============================
// Phone Number
// ===============================

document.querySelectorAll('.edit-phone').forEach(function(input){

    input.addEventListener('input',function(){

        this.value=this.value.replace(/\D/g,'');

        if(this.value.length>0){

            let first=this.value.charAt(0);

            if(first<'6'){

                this.value='';

            }

        }

    });

});

// ===============================
// Edit Form Validation
// ===============================

document.querySelectorAll('form[action*="customers/update"]').forEach(function(form){

    form.addEventListener('submit',function(e){

        let valid=true;

        let name=form.querySelector('.edit-name');
        let phone=form.querySelector('.edit-phone');
        let email=form.querySelector('.edit-email');

        let nameError=form.querySelector('.edit-name-error');
        let phoneError=form.querySelector('.edit-phone-error');
        let emailError=form.querySelector('.edit-email-error');

        // Clear old errors

        nameError.innerHTML='';
        phoneError.innerHTML='';
        emailError.innerHTML='';

        // Customer Name

        if(name.value.trim()===''){

            nameError.innerHTML='Customer Name is required';

            valid=false;

        }

        // Phone

        if(phone.value.trim()===''){

            phoneError.innerHTML='Phone Number is required';

            valid=false;

        }
        else if(phone.value.length!=10){

            phoneError.innerHTML='Phone Number must be exactly 10 digits';

            valid=false;

        }

        // Email

        if(email.value.trim()!=''){

            let pattern=/^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if(!pattern.test(email.value)){

                emailError.innerHTML='Please enter a valid email';

                valid=false;

            }

        }

        if(!valid){

            e.preventDefault();

        }

    });

});

</script>
</body>