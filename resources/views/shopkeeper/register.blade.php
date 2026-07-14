@extends('layouts.app')

@section('content')

<style>

body{
    background:#f5fdf8;
}

/* ================= REGISTER SECTION ================= */

.register-section{
    min-height:100vh;
    display:flex;
    align-items:center;
    padding:60px 0;
}

/* ================= LEFT ================= */

.register-left{

    background:linear-gradient(135deg,#198754,#157347);
    color:#fff;
    border-radius:25px 0 0 25px;
    padding:60px;
    height:100%;

}

.register-left h2{

    font-size:42px;
    font-weight:700;
    margin-bottom:20px;

}

.register-left p{

    line-height:1.8;
    font-size:17px;

}

.register-left ul{

    list-style:none;
    padding:0;
    margin-top:40px;

}

.register-left li{

    margin-bottom:18px;
    font-size:17px;

}

.register-left i{

    margin-right:10px;

}

/* ================= RIGHT ================= */

.register-card{

    background:#fff;
    border-radius:25px 25px 25px 25px;
    padding:50px;
    box-shadow:0 20px 50px rgba(0,0,0,.08);
    height:100%;
    

}

.logo{

    font-size:32px;
    font-weight:800;
    color:#198754;

}

.logo span{

    color:#212529;

}

.register-card h3{

    margin-top:20px;
    font-weight:700;

}

.register-card p{

    color:#6c757d;
    margin-bottom:30px;

}

/* ================= FORM ================= */

.input-group{

    position:relative;
    margin-bottom:20px;

}

.input-group i{

    position:absolute;
    top:18px;
    left:15px;
    color:#198754;
    z-index:10;

}

.form-control{

    height:55px;
    padding-left:45px;
    border-radius:12px;

}

.register-btn{

    width:100%;
    height:55px;
    border:none;
    border-radius:12px;
    background:#198754;
    color:#fff;
    font-size:18px;
    font-weight:600;
    transition:.3s;

}

.register-btn:hover{

    background:#157347;
    transform:translateY(-2px);

}

.login-link{

    margin-top:25px;
    text-align:center;

}

.login-link a{

    color:#198754;
    text-decoration:none;
    font-weight:700;

}

@media(max-width:991px){

.register-left{

    border-radius:25px 25px 0 0;
    text-align:center;

}

.register-card{

    border-radius:0 0 25px 25px;

}

}

</style>

<section class="register-section">

<div class="container">

<div class="row justify-content-center">

<!-- LEFT -->



<!-- RIGHT -->

<div class="col-lg-6">

<div class="register-card">



<h3>

Create Account 🚀

</h3>

<p>

Register your shop and start using HisabKitab today.

</p>

<form action="{{ url('/shop/register') }}" method="POST">

@csrf

<small id="shop_name_error" class="text-danger"></small>
<div class="input-group">

    <i class="fa-solid fa-shop"></i>

    <input
        type="text"
        id="shop_name"
        name="shop_name"
        class="form-control"
        placeholder="Shop Name"
        maxlength="50"
        required>

    <i class="validation-icon"></i>



</div>
<small id="owner_name_error" class="text-danger"></small>

<div class="input-group">

    <i class="fa-solid fa-user"></i>

    <input
        type="text"
        id="owner_name"
        name="owner_name"
        class="form-control"
        placeholder="Owner Name"
        maxlength="40"
        required>

    <i class="validation-icon"></i>

</div>


<small id="email_error" class="text-danger"></small>

<div class="input-group">

    <i class="fa-solid fa-envelope"></i>

    <input
        type="email"
        id="email"
        name="email"
        class="form-control"
        placeholder="Email Address"
        required>

    <i class="validation-icon"></i>

</div>

<small id="phone_error" class="text-danger"></small>

<div class="input-group">

    <i class="fa-solid fa-phone"></i>

    <input
        type="text"
        id="phone"
        name="phone"
        class="form-control"
        placeholder="Phone Number"
        maxlength="10"
        required>

    <i class="validation-icon"></i>

</div>
<div class="input-group">
<i class="fa-regular fa-address-book"></i>
<input type="text" name="address" class="form-control"   placeholder="Address">
</div>

<small id="password_error" class="text-danger"></small>
<div class="input-group">

    <i class="fa-solid fa-lock"></i>

    <input
        type="password"
        id="password"
        name="password"
        class="form-control"
        placeholder="Password"
        required>

    <i class="validation-icon"></i>

</div>

<small id="confirm_password_error" class="text-danger"></small>
<div class="input-group">

    <i class="fa-solid fa-lock"></i>

    <input
        type="password"
        id="confirm_password"
        name="password_confirmation"
        class="form-control"
        placeholder="Confirm Password"
        required>

    <i class="validation-icon"></i>

</div>


<div class="form-check mb-4">

<input
class="form-check-input"
type="checkbox"
required>

<label class="form-check-label">

I declare all the information provided by me is correct

</label>

</div>

<button type="submit" class="register-btn">

<i class="fa-solid fa-user-plus me-2"></i>

Create Account

</button>

</form>

<div class="login-link">

Already have an account?

<a href="{{ url('/shopkeeper/login') }}">

Login Here

</a>

</div>

</div>

</div>

</div>

</div>

</section>


<script>

function showError(input,message){

    input.classList.remove("is-valid");
    input.classList.add("is-invalid");

    document.getElementById(input.id+"_error").innerHTML=message;

}

function showSuccess(input){

    input.classList.remove("is-invalid");
    input.classList.add("is-valid");

    document.getElementById(input.id+"_error").innerHTML="";

}






// Shop Name

document.getElementById("shop_name").addEventListener("input",function(){

    this.value=this.value.replace(/[^A-Za-z0-9 ]/g,'');

    if(this.value.trim().length<3){

        showError(this,"Shop name must contain at least 3 characters.");

    }

    else{

        showSuccess(this);

    }

});







// Owner Name

document.getElementById("owner_name").addEventListener("input",function(){

    this.value=this.value.replace(/[^A-Za-z ]/g,'');

    if(this.value.trim().length<3){

        showError(this,"Enter a valid owner name.");

    }

    else{

        showSuccess(this);

    }

});








// Email

document.getElementById("email").addEventListener("input",function(){

    let emailPattern=/^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if(!emailPattern.test(this.value)){

        showError(this,"Enter a valid email.");

    }

    else{

        showSuccess(this);

    }

});








// Phone

document.getElementById("phone").addEventListener("input", function () {

    // Sirf digits allow karo
    this.value = this.value.replace(/\D/g, '');

    // Agar first digit 1-5 hai to remove kar do
    if (/^[1-5]/.test(this.value)) {
        this.value = this.value.substring(1);
    }

    if (this.value.length != 10) {

        showError(this, "Phone number must contain exactly 10 digits.");

    }
    else if (!/^[6-9]/.test(this.value)) {

        showError(this, "Phone number must start with 6, 7, 8 or 9.");

    }
    else {

        showSuccess(this);

    }

});







// Password

document.getElementById("password").addEventListener("input",function(){

    let password=this.value;

    let regex=/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*#?&]).{8,}$/;

    if(!regex.test(password)){

        showError(this,"Minimum 8 characters with uppercase, lowercase, number and special character.");

    }

    else{

        showSuccess(this);

    }

});









// Confirm Password

document.getElementById("confirm_password").addEventListener("input",function(){

    let password=document.getElementById("password").value;

    if(this.value!==password){

        showError(this,"Passwords do not match.");

    }

    else{

        showSuccess(this);

    }

});

</script>
</section>
@if($errors->any())
<script>
Swal.fire({
    icon: 'error',
    title: 'Registration Failed',
    html: `{!! implode('<br>', $errors->all()) !!}`,
    confirmButtonText: 'OK',
    confirmButtonColor: '#198754'
});
</script>
@endif
@endsection