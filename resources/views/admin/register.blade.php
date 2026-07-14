<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Admin Register | HisabKitab</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

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

/* ================= LEFT SIDE ================= */

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
    margin-bottom:15px;

}

.register-left h4{

    font-weight:600;
    margin-bottom:20px;

}

.register-left p{

    line-height:1.8;
    font-size:17px;
    opacity:.95;

}

.register-left ul{

    list-style:none;
    padding:0;
    margin-top:40px;

}

.register-left ul li{

    margin-bottom:18px;
    font-size:17px;

}

.register-left ul li i{

    margin-right:10px;

}

/* ================= RIGHT SIDE ================= */

.register-card{

    background:#fff;
    border-radius:0 25px 25px 0;
    padding:60px;
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

    font-weight:700;
    margin-bottom:10px;

}

.register-card p{

    color:#6c757d;
    margin-bottom:30px;

}

/* ================= FORM ================= */

.form-control{

    height:55px;
    border-radius:12px;
    padding-left:45px;

}

.input-group{

    position:relative;
    margin-bottom:20px;

}

.input-group i{

    position:absolute;
    top:18px;
    left:15px;
    color:#198754;
    z-index:5;

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

    margin-top:30px;
    text-align:center;

}

.login-link a{

    text-decoration:none;
    color:#198754;
    font-weight:700;

}

/* ================= VALIDATION ================= */

.text-danger{

    font-size:14px;

}

.is-valid{

    border-color:#198754 !important;

}

.is-invalid{

    border-color:#dc3545 !important;

}

/* ================= RESPONSIVE ================= */

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

</head>

<body>

<div class="register-section">

<div class="container">

<div class="row g-0 shadow-lg">

<!-- LEFT -->

<div class="col-lg-6">

<div class="register-left">

<h2>HisabKitab</h2>

<h4>Create Admin Account</h4>

<p>

Create an administrator account to manage the complete HisabKitab system.

</p>

<ul>

<li>

<i class="fa-solid fa-circle-check"></i>

Manage Shopkeepers

</li>

<li>

<i class="fa-solid fa-circle-check"></i>

Monitor Registered Shops

</li>

<li>

<i class="fa-solid fa-circle-check"></i>

System Reports

</li>

<li>

<i class="fa-solid fa-circle-check"></i>

Secure Access

</li>

</ul>

</div>

</div>

<!-- RIGHT -->

<div class="col-lg-6">

<div class="register-card">

<h3>Create Account 🚀</h3>

<p>

Fill in your details to create an Admin account.

</p>

<form action="{{ route('admin.register.post') }}" method="POST">

@csrf

<!-- Name -->

<div class="mb-3">
<small id="name_error" class="text-danger"></small>

<div class="input-group">

    <i class="fa-solid fa-user"></i>
<input
type="text"
name="name"
id="name"
class="form-control"
placeholder="Full Name">

</div>
</div>
<!-- Phone -->

<div class="mb-3">
    <small id="phone_error" class="text-danger"></small>

<div class="input-group">

    <i class="fa-solid fa-phone"></i>

<input
type="text"
name="phone"
id="phone"
class="form-control"
placeholder="Phone Number"
maxlength="10"
autocomplete="off">

</div>
</div>
<!-- Email -->

<div class="mb-3">
<small id="email_error" class="text-danger"></small>

<div class="input-group">

    <i class="fa-solid fa-envelope"></i>
<input
type="email"
name="email"
id="email"
class="form-control"
placeholder="Email Address">

</div>
</div>

<!-- Password -->

<div class="mb-3">
    <small id="password_error" class="text-danger"></small>

<div class="input-group">

    <i class="fa-solid fa-lock"></i>

<input
type="password"
name="password"
id="password"
class="form-control"
placeholder="Password">

</div>
</div>

<!-- Confirm Password -->

<div class="mb-3">
    <small id="confirm_password_error" class="text-danger"></small>

<div class="input-group">

    <i class="fa-solid fa-lock"></i>

<input
type="password"
name="password_confirmation"
class="form-control"
placeholder="Confirm Password" id="confirm_password">

</div>
</div>
<div class="form-check mb-4">

<input
class="form-check-input"
type="checkbox"
required>

<label class="form-check-label">

I agree to the Terms & Conditions

</label>

</div>

<button type="submit" class="register-btn">

    <i class="fa-solid fa-user-plus me-2"></i>

    Create Account

</button>

</form>

<div class="login-link">

Already have an account?

<a href="{{ route('admin.login') }}">

Login Here

</a>

</div>

</div>

</div>

</div>
</div>

</div>
<script>
    function showError(input, message){

    input.classList.remove("is-valid");
    input.classList.add("is-invalid");

    document.getElementById(input.id + "_error").innerHTML = message;

}

function showSuccess(input){

    input.classList.remove("is-invalid");
    input.classList.add("is-valid");

    document.getElementById(input.id + "_error").innerHTML = "";

}
document.getElementById("name").addEventListener("input", function(){

    this.value = this.value.replace(/[^A-Za-z ]/g,'');

    if(this.value.trim().length < 3){

        showError(this, "Name must contain at least 3 characters.");

    }
    else{

        showSuccess(this);

    }

});
document.getElementById("phone").addEventListener("input", function(){

    this.value = this.value.replace(/\D/g,'');

    if(/^[1-5]/.test(this.value)){
        this.value = this.value.substring(1);
    }

    // Maximum 10 digits
    this.value = this.value.slice(0,10);

    if(this.value.length != 10){

        showError(this,"Phone number must contain exactly 10 digits.");

    }
    else if(!/^[6-9]/.test(this.value)){

        showError(this,"Phone number must start with 6, 7, 8 or 9.");

    }
    else{

        showSuccess(this);

    }

});
document.getElementById("email").addEventListener("input", function(){

    let pattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if(!pattern.test(this.value)){

        showError(this,"Enter a valid email address.");

    }
    else{

        showSuccess(this);

    }

});
document.getElementById("password").addEventListener("input", function(){

    let regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*#?&]).{8,}$/;

    if(!regex.test(this.value)){

        showError(this,"Minimum 8 characters with uppercase, lowercase, number and special character.");

    }
    else{

        showSuccess(this);

    }

});
document.getElementById("confirm_password").addEventListener("input", function(){

    let password = document.getElementById("password").value;

    if(this.value != password){

        showError(this,"Passwords do not match.");

    }
    else{

        showSuccess(this);

    }

});
</script>


</body>

</html>