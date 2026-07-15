@include('admin.sidebar')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

<style>

body{
    background:#f5f7f6;
    font-family:'Segoe UI',sans-serif;
}

.content{
    margin-left:280px;
    padding:35px;
}

.profile-card{
    max-width:700px;
    margin:auto;
    border:none;
    border-radius:12px;
    overflow:hidden;
    background:#fff;
    box-shadow:0 5px 18px rgba(0,0,0,.08);
}

.profile-header{
   background:rgba(54,107,76,.68);
    padding:25px;
    text-align:center;
}

.profile-avatar{
    width:90px;
    height:90px;
    border-radius:50%;
    background:#fff;
    color:#198754;
    display:flex;
    justify-content:center;
    align-items:center;
    font-size:38px;
    margin:auto;
    margin-bottom:12px;
}

.profile-header h3{
    color:#fff;
    margin:0;
    font-size:24px;
    font-weight:600;
}

.badge-role{
    margin-top:8px;
    display:inline-block;
    background:#fff;
    color:#198754;
    padding:5px 15px;
    border-radius:20px;
    font-size:13px;
    font-weight:600;
}

.profile-body{
    padding:25px;
}

.profile-body .card{
    border:none !important;
    box-shadow:none !important;
}

.row.mb-4{
    border-bottom:1px solid #eee;
    padding:12px 0;
    margin-bottom:0 !important;
}

.row:last-child{
    border-bottom:none;
}

.col-md-4{
    font-weight:600;
    color:#666;
}

.col-md-8{
    color:#222;
}

.profile-footer{
    padding:20px;
    border-top:1px solid #eee;
    display:flex;
    justify-content:center;
    gap:12px;
}

.btn{
    border-radius:8px;
    padding:9px 22px;
}

.modal-content{
    border-radius:12px;
}

.form-control{
    border-radius:8px;
}
/* ================= Responsive ================= */

@media (max-width: 991px){

    .content{
        margin-left:0;
        padding:20px;
    }

    .profile-card{
        max-width:100%;
    }

    .profile-body{
        padding:20px;
    }

    .profile-footer{
        flex-direction:column;
        gap:10px;
    }

    .profile-footer .btn{
        width:100%;
    }

}

@media (max-width: 767px){

    .content{
        padding:15px;
    }

    .profile-header{
        padding:20px 15px;
    }

    .profile-avatar{
        width:75px;
        height:75px;
        font-size:30px;
    }

    .profile-header h3{
        font-size:20px;
    }

    .badge-role{
        font-size:12px;
        padding:4px 12px;
    }

    .profile-body{
        padding:15px;
    }

    .row.mb-4{
        display:block;
        padding:10px 0;
    }

    .col-md-4{
        margin-bottom:5px;
        font-size:14px;
    }

    .col-md-8{
        font-size:14px;
        word-break:break-word;
    }

    .modal-dialog{
        margin:10px;
    }

    .modal-body{
        padding:20px;
    }

    .modal-footer{
        flex-direction:column;
    }

    .modal-footer .btn{
        width:100%;
    }

}

@media (max-width: 480px){

    .content{
        padding:10px;
    }

    .profile-card{
        border-radius:10px;
    }

    .profile-header{
        padding:18px 12px;
    }

    .profile-avatar{
        width:65px;
        height:65px;
        font-size:26px;
    }

    .profile-header h3{
        font-size:18px;
    }

    .btn{
        width:100%;
        padding:10px;
        font-size:14px;
    }

    .form-control{
        font-size:14px;
    }

    textarea.form-control{
        min-height:90px;
    }

}
</style>


<div class="content">

<div class="card profile-card">

<div class="profile-header">

<div class="profile-avatar">

<i class="fas fa-user"></i>

</div>

<h3>{{ $admin->name }}</h3>

<span class="badge-role">

Administrator

</span>

</div>


<div class="profile-body">

   <div class="profile-body">

    <div class="mx-auto" style="max-width:600px;">

            <div class="row mb-4 align-items-center">

                <div class="col-md-4 fw-bold text-secondary">
                    <i class="fas fa-user text-success me-2"></i>Name 
                </div>

                <div class="col-md-8">
                    {{ $admin->name }}
                </div>

            </div>

            <div class="row mb-4 align-items-center">

                <div class="col-md-4 fw-bold text-secondary">
                    <i class="fas fa-envelope text-success me-2"></i>Email
                </div>

                <div class="col-md-8">
                    {{ $admin->email }}
                </div>

            </div>

            <div class="row mb-4 align-items-center">

                <div class="col-md-4 fw-bold text-secondary">
                    <i class="fas fa-phone text-success me-2"></i>Phone
                </div>

                <div class="col-md-8">
                    {{ $admin->phone }}
                </div>

            </div>

            <div class="row mb-4 align-items-center">

                <div class="col-md-4 fw-bold text-secondary">
                    <i class="fas fa-map-marker-alt text-success me-2"></i>Address
                </div>

                <div class="col-md-8">
                    {{ $admin->address ?? 'Not Available' }}
                </div>

            </div>

            <div class="row mb-4 align-items-center">

                <div class="col-md-4 fw-bold text-secondary">
                    <i class="fas fa-user-shield text-success me-2"></i>Role
                </div>

                <div class="col-md-8">
                    <span class="badge bg-success px-3 py-2">
                        Administrator
                    </span>
                </div>

            </div>

            <div class="row align-items-center">

                <div class="col-md-4 fw-bold text-secondary">
                    <i class="fas fa-calendar text-success me-2"></i>Joined
                </div>

                <div class="col-md-8">
                    {{ \Carbon\Carbon::parse($admin->created_at)->format('d M Y') }}
                </div>

            </div>

        </div>

    </div>

</div>
<div class="profile-footer">

<button
class="btn btn-success"
data-bs-toggle="modal"
data-bs-target="#editProfileModal">

<i class="fas fa-edit me-2"></i>

Edit Profile

</button>


<button
class="btn btn-dark"
data-bs-toggle="modal"
data-bs-target="#changePasswordModal">

<i class="fas fa-lock me-2"></i>

Change Password

</button>

</div>

</div>

</div>



{{-- Edit Profile Modal --}}
<div class="modal fade" id="editProfileModal" tabindex="-1">

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header bg-success text-white">

                <h5 class="modal-title">
                    <i class="fas fa-user-edit me-2"></i>
                    Edit Profile
                </h5>

                <button
                    type="button"
                    class="btn-close btn-close-white"
                    data-bs-dismiss="modal">
                </button>

            </div>

            <form method="POST" action="{{ route('admin.profile.update') }}">

                @csrf

                <div class="modal-body">

                    <div class="row">

                        <!-- Name -->
                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Name <span class="text-danger">*</span>
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                id="name"
                                name="name"
                                value="{{ old('name',$admin->name) }}"
                                maxlength="50">

                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror

                        </div>

                        <!-- Email -->
                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Email <span class="text-danger">*</span>
                            </label>

                            <input
                                type="email"
                                class="form-control"
                                name="email"
                                value="{{ old('email',$admin->email) }}">

                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror

                        </div>

                        <!-- Phone -->
                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Phone <span class="text-danger">*</span>
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                id="phone"
                                name="phone"
                                value="{{ old('phone',$admin->phone) }}"
                                maxlength="10">

                            @error('phone')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror

                        </div>

                        <!-- Address -->
                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Address
                            </label>

                            <textarea
                                class="form-control"
                                rows="3"
                                id="address"
                                name="address"
                                maxlength="100">{{ old('address',$admin->address) }}</textarea>

                            <div class="text-end">
                                <small id="count">0/100</small>
                            </div>

                            @error('address')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror

                        </div>

                    </div>

                </div>

             <div class="modal-footer">

    <button
        type="button"
        class="btn btn-secondary"
        data-bs-dismiss="modal">

        <i class="fas fa-times me-2"></i>
        Cancel

    </button>

    <button
        type="submit"
        class="btn btn-success">

        <i class="fas fa-save me-2"></i>
        Update Profile

    </button>

</div>
            </form>

        </div>

    </div>

</div>




<div class="modal fade" id="changePasswordModal" tabindex="-1">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header  text-white" style="background-color: rgb(71, 136, 71);">

                <h5 class="modal-title">
                    <i class="fas fa-lock me-2"></i>
                    Change Password
                </h5>

                <button type="button"
                        class="btn-close btn-close-white"
                        data-bs-dismiss="modal"></button>

            </div>

            <form method="POST" action="{{ route('admin.password.update') }}">

                @csrf

                <div class="modal-body">

                    <!-- Current Password -->
                    <div class="mb-3">

                        <label class="form-label">
                            Current Password
                        </label>

                        <div class="input-group">

                            <input
                                type="password"
                                class="form-control"
                                id="current_password"
                                name="current_password">

                            <button
                                class="btn btn-outline-secondary"
                                type="button"
                                onclick="togglePassword('current_password',this)">

                                <i class="fas fa-eye"></i>

                            </button>

                        </div>

                        @error('current_password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                    </div>

                    <!-- New Password -->

                    <div class="mb-3">

                        <label class="form-label">
                            New Password
                        </label>

                        <div class="input-group">

                            <input
                                type="password"
                                class="form-control"
                                id="new_password"
                                name="new_password">

                            <button
                                class="btn btn-outline-secondary"
                                type="button"
                                onclick="togglePassword('new_password',this)">

                                <i class="fas fa-eye"></i>

                            </button>

                        </div>

                        @error('new_password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                    </div>

                    <!-- Confirm Password -->

                    <div class="mb-3">

                        <label class="form-label">
                            Confirm Password
                        </label>

                        <div class="input-group">

                            <input
                                type="password"
                                class="form-control"
                                id="confirm_password"
                                name="confirm_password">

                            <button
                                class="btn btn-outline-secondary"
                                type="button"
                                onclick="togglePassword('confirm_password',this)">

                                <i class="fas fa-eye"></i>

                            </button>

                        </div>

                        @error('confirm_password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

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
                        class="btn btn-dark">

                        <i class="fas fa-save me-2"></i>

                        Update Password

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>
<script>

const nameField=document.getElementById('name');
const phoneField=document.getElementById('phone');
const addressField=document.getElementById('address');
const count=document.getElementById('count');


// Name

nameField.addEventListener('input',function(){

    this.value=this.value.replace(/[^a-zA-Z\s]/g,'');

});


// Phone

phoneField.addEventListener('input',function(){

    this.value=this.value.replace(/\D/g,'');

    if(this.value.length>10){

        this.value=this.value.slice(0,10);

    }

    if(this.value.length==1){

        if(!/[6-9]/.test(this.value)){

            this.value='';

        }

    }

});


// Address Counter

function updateCounter(){

    count.innerHTML=addressField.value.length+"/100";

}

updateCounter();

addressField.addEventListener('input',updateCounter);

</script>
@if ($errors->any())
<script>
document.addEventListener('DOMContentLoaded', function () {
    var editModal = new bootstrap.Modal(document.getElementById('editProfileModal'));
    editModal.show();
});
</script>
@endif
<script>

function togglePassword(id, button)
{
    let input = document.getElementById(id);

    let icon = button.querySelector("i");

    if(input.type==="password")
    {
        input.type="text";

        icon.classList.remove("fa-eye");

        icon.classList.add("fa-eye-slash");
    }
    else
    {
        input.type="password";

        icon.classList.remove("fa-eye-slash");

        icon.classList.add("fa-eye");
    }
}

</script>
<script>

const newPassword = document.getElementById("new_password");
const confirmPassword = document.getElementById("confirm_password");
const passwordError = document.getElementById("passwordError");

function checkPassword()
{
    if(confirmPassword.value=="")
    {
        passwordError.innerHTML="";
        return;
    }

    if(newPassword.value !== confirmPassword.value)
    {
        passwordError.innerHTML="Passwords do not match.";
        confirmPassword.classList.add("is-invalid");
        confirmPassword.classList.remove("is-valid");
    }
    else
    {
        passwordError.innerHTML="";
        confirmPassword.classList.remove("is-invalid");
        confirmPassword.classList.add("is-valid");
    }
}

newPassword.addEventListener("keyup", checkPassword);
confirmPassword.addEventListener("keyup", checkPassword);

</script>