@include('shopkeeper.sidebar')
<style>
 .content{
    margin-left:270px;
    padding:30px;
    transition:.3s;

  
  
    background:#f8f9fa;

}

.profile-card{
    border:none;
    border-radius:18px;
    overflow:hidden;
    background:#fff;
    box-shadow:0 8px 25px rgba(0,0,0,.08);
}

/* Cover Section */

.profile-cover{
    height:180px;
   background:rgba(54, 107, 76, 0.68);
    position:relative;
}

/* Avatar */

.avatar{
    width:120px;
    height:120px;
    border-radius:50%;
    background:#fff;
    border:5px solid #fff;
    color:#22a06b;
    font-size:46px;
    font-weight:700;
    display:flex;
    align-items:center;
    justify-content:center;
    position:absolute;
    left:40px;
    bottom:-60px;
    box-shadow:0 8px 20px rgba(0,0,0,.15);
}

/* Body */

.profile-body{
    padding:80px 35px 35px;
}

.profile-name{
    font-size:30px;
    font-weight:700;
    color:#222;
    margin-bottom:4px;
}

.owner-text{
    color:#6c757d;
    font-size:16px;
    margin-bottom:15px;
}

/* Badge */

.status-badge{
    display:inline-block;
    background:#e8f8ef;
    color:#22a06b;
    border:1px solid #cdebdc;
    padding:6px 18px;
    border-radius:30px;
    font-size:14px;
    font-weight:600;
}

/* Buttons */

.profile-actions{
    margin-top:25px;
}

.profile-actions .btn{
    border-radius:30px;
    padding:10px 24px;
    font-weight:600;
    margin-right:10px;
}

/* Section */

.section-title{
    font-size:22px;
    font-weight:700;
    color:#222;
    margin:35px 0 20px;
}

/* Info Cards */

.info-box{
    background:#fff;
    border:1px solid #e8ecef;
    border-radius:14px;
    padding:18px;
    transition:.3s;
    height:100%;
}

.info-box:hover{
    transform:translateY(-4px);
    box-shadow:0 10px 25px rgba(0,0,0,.08);
}

.info-label{
    color:#22a06b;
    font-size:13px;
    font-weight:600;
    text-transform:uppercase;
    letter-spacing:.5px;
    margin-bottom:8px;
}

.info-value{
    font-size:17px;
    color:#222;
    font-weight:500;
    word-break:break-word;
}

.info-icon{
    font-size:22px;
    color:#22a06b;
    margin-bottom:12px;
}

/* Responsive */

@media(max-width:768px){

.content{
    margin-left:0;
    padding:20px;
}

.avatar{
    left:50%;
    transform:translateX(-50%);
}

.profile-body{
    padding-top:90px;
    text-align:center;
}

.profile-actions .btn{
    width:100%;
    margin-bottom:12px;
}
/* Modal */

.modal-content{
    border:none;
    border-radius:18px;
    overflow:hidden;
}

.modal-header{
    background:#22a06b;
    color:#fff;
    padding:18px 25px;
}

.modal-title{
    font-weight:600;
}

.btn-close{
    filter:invert(1);
}

.form-label{
    font-weight:600;
    color:#444;
}

.form-control{

    border-radius:10px;

    border:1px solid #d9d9d9;

    padding:12px;

    transition:.3s;

}

.form-control:focus{

    border-color:#22a06b;

    box-shadow:0 0 0 .18rem rgba(34,160,107,.18);

}

.modal-footer{

    border-top:1px solid #eee;

    padding:18px 25px;

}

.btn-success{

    background:#22a06b;

    border:none;

}

.btn-success:hover{

    background:#1c8a5b;

}

.text-danger{

    font-size:13px;

}

}
</style>

<div class="content">

    <div class="card profile-card">

        <!-- Cover -->
        <div class="profile-cover">

            <div class="avatar">
                {{ strtoupper(substr($shop->shop_name,0,1)) }}
            </div>

        </div>

        <!-- Profile Body -->
        <div class="profile-body">

            <div class="d-flex justify-content-between align-items-start flex-wrap">

                <div>

                    <h2 class="profile-name">{{ $shop->shop_name }}</h2>

                    <p class="owner-text">
                        Owner : <strong>{{ $shop->owner_name }}</strong>
                    </p>

                    @if($shop->status == 'active')

                        <span class="status-badge">
                            <i class="bi bi-check-circle-fill"></i> Active
                        </span>

                    @elseif($shop->status == 'inactive')

                        <span class="badge bg-danger rounded-pill">
                            <i class="bi bi-x-circle-fill"></i> Inactive
                        </span>

                    @endif

                </div>

                <div class="profile-actions">

                    <button class="btn btn-success"
                        data-bs-toggle="modal"
                        data-bs-target="#editProfileModal">

                        <i class="bi bi-pencil-square"></i>

                        Edit Profile

                    </button>

                    <button class="btn btn-outline-success"
                        data-bs-toggle="modal"
                        data-bs-target="#changePasswordModal">

                        <i class="bi bi-shield-lock"></i>

                        Change Password

                    </button>

                </div>

            </div>

            <hr class="my-4">

            <h4 class="section-title">

                <i class="bi bi-building"></i>

                Business Information

            </h4>

            <div class="row g-4">

                <div class="col-md-6">

                    <div class="info-box">

                        <div class="info-icon">

                            <i class="bi bi-shop"></i>

                        </div>

                        <div class="info-label">

                            Shop Name

                        </div>

                        <div class="info-value">

                            {{ $shop->shop_name }}

                        </div>

                    </div>

                </div>

                <div class="col-md-6">

                    <div class="info-box">

                        <div class="info-icon">

                            <i class="bi bi-person"></i>

                        </div>

                        <div class="info-label">

                            Owner Name

                        </div>

                        <div class="info-value">

                            {{ $shop->owner_name }}

                        </div>

                    </div>

                </div>

                <div class="col-md-6">

                    <div class="info-box">

                        <div class="info-icon">

                            <i class="bi bi-envelope"></i>

                        </div>

                        <div class="info-label">

                            Email Address

                        </div>

                        <div class="info-value">

                            {{ $shop->email }}

                        </div>

                    </div>

                </div>

                <div class="col-md-6">

                    <div class="info-box">

                        <div class="info-icon">

                            <i class="bi bi-telephone"></i>

                        </div>

                        <div class="info-label">

                            Mobile Number

                        </div>

                        <div class="info-value">

                            {{ $shop->phone }}

                        </div>

                    </div>

                </div>

                <div class="col-md-6">

                    <div class="info-box">

                        <div class="info-icon">

                            <i class="bi bi-geo-alt"></i>

                        </div>

                        <div class="info-label">

                            Shop Address

                        </div>

                        <div class="info-value">

                            {{ $shop->address }}

                        </div>

                    </div>

                </div>

                <div class="col-md-6">

                    <div class="info-box">

                        <div class="info-icon">

                            <i class="bi bi-calendar-check"></i>

                        </div>

                        <div class="info-label">

                            Member Since

                        </div>

                        <div class="info-value">

                            {{ $shop->created_at->format('d M Y') }}

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>
    <div class="modal fade" id="editProfileModal"> 
        <div class="modal-dialog modal-lg"> 
            <div class="modal-content"> 
                <div class="modal-header">
                     <h5>Edit Profile</h5> 
                     <button class="btn-close" data-bs-dismiss="modal"></button> </div>
    <form action="{{ route('shop.profile.update') }}" method="POST" id="editProfileForm">

    @csrf

    <div class="modal-body">

        <div class="row">

            <div class="col-md-6 mb-3">

                <label class="form-label">Shop Name</label>

                <input
                    type="text"
                    class="form-control"
                    name="shop_name"
                    id="shop_name"
                    value="{{ old('shop_name',$shop->shop_name) }}"
                >
                @error('shop_name')

<div class="text-danger mt-1">

    {{ $message }}

</div>

@enderror

                <small class="text-danger" id="shop_name_error"></small>

            </div>

            <div class="col-md-6 mb-3">

                <label class="form-label">Owner Name</label>

                <input
                    type="text"
                    class="form-control"
                    name="owner_name"
                    id="owner_name"
                    value="{{ old('owner_name',$shop->owner_name) }}"
                >
                @error('owner_name')

<div class="text-danger mt-1">

    {{ $message }}

</div>

@enderror

                <small class="text-danger" id="owner_name_error"></small>

            </div>

            <div class="col-md-6 mb-3">

                <label class="form-label">Email</label>

                <input
                    type="email"
                    class="form-control"
                    name="email"
                    id="email"
                    value="{{ old('email',$shop->email) }}"
                >
                @error('email')

<div class="text-danger mt-1">

    {{ $message }}

</div>

@enderror

                <small class="text-danger" id="email_error"></small>

            </div>

            <div class="col-md-6 mb-3">

                <label class="form-label">Phone Number</label>

                <input
                    type="text"
                    class="form-control"
                    name="phone"
                    id="phone"
                    maxlength="10"
                    value="{{ old('phone',$shop->phone) }}"
                >
                @error('phone')

<div class="text-danger mt-1">

    {{ $message }}

</div>

@enderror

                <small class="text-danger" id="phone_error"></small>

            </div>

            <div class="col-12 mb-3">

                <label class="form-label">Address</label>

                <textarea
                    class="form-control"
                    rows="3"
                    name="address"
                    id="address"
                >{{ old('address',$shop->address) }}</textarea>
                @error('address')

<div class="text-danger mt-1">

    {{ $message }}

</div>

@enderror

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
class="btn btn-success"
id="updateBtn">

Update Profile

</button>
    </div>

</form>
</div>
</div>
</div>
{{-- Change Password Modal --}} <div class="modal fade" id="changePasswordModal" tabindex="-1">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header bg-success text-white">

                <h5 class="modal-title">

                    <i class="bi bi-shield-lock"></i>

                    Change Password

                </h5>

                <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>

            </div>

            <form action="{{ route('shop.password.update') }}" method="POST" id="passwordForm">

                @csrf

                <div class="modal-body">

                    <div class="mb-3">

                        <label class="form-label">

                            Current Password

                        </label>

                        <input
                            type="password"
                            class="form-control @error('current_password') is-invalid @enderror"
                            name="current_password"
                            id="current_password"
                        >

                        @error('current_password')

                            <div class="text-danger mt-1">

                                {{ $message }}

                            </div>

                        @enderror

                    </div>

                    <div class="mb-3">

                        <label class="form-label">

                            New Password

                        </label>

                        <input
                            type="password"
                            class="form-control @error('new_password') is-invalid @enderror"
                            name="new_password"
                            id="new_password"
                        >

                        @error('new_password')

                            <div class="text-danger mt-1">

                                {{ $message }}

                            </div>

                        @enderror

                    </div>

                    <div class="mb-3">

                        <label class="form-label">

                            Confirm Password

                        </label>

                        <input
                            type="password"
                            class="form-control"
                            name="new_password_confirmation"
                            id="confirm_password"
                        >

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
                        class="btn btn-success"
                        id="passwordBtn">

                        Update Password

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>
</div>

<script>

document.getElementById('owner_name').addEventListener('keypress',function(e){

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
document.getElementById('editProfileForm').addEventListener('submit',function(){

document.getElementById('updateBtn').innerHTML='Updating...';

document.getElementById('updateBtn').disabled=true;
document.getElementById('passwordForm').addEventListener('submit',function(){

document.getElementById('passwordBtn').innerHTML='Updating...';

document.getElementById('passwordBtn').disabled=true;

});

});
</script>
@if ($errors->any())
<script>
document.addEventListener('DOMContentLoaded', function () {
    var modal = new bootstrap.Modal(document.getElementById('editProfileModal'));
    modal.show();
});
</script>
@endif
@if(session('open_modal')=='changePasswordModal')

<script>

document.addEventListener('DOMContentLoaded',function(){

new bootstrap.Modal(document.getElementById('changePasswordModal')).show();

});

</script>

@endif
</body>