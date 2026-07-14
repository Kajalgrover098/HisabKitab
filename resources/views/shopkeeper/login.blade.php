@extends('layouts.app')

@section('content')



<style>

body{
    background:#f5f7fa;
    font-family:'Poppins',sans-serif;
}

.login-section{
    min-height:85vh;
    display:flex;
    align-items:center;
    justify-content:center;
    padding:40px 15px;
}

.login-card{
    width:100%;
    max-width:430px;
    background:#fff;
    border-radius:18px;
    padding:40px;
    box-shadow:0 10px 35px rgba(0,0,0,.08);
}

.logo{
    text-align:center;
    margin-bottom:30px;
}

.logo i{
    font-size:55px;
    color:#198754;
}

.logo h2{
    margin-top:15px;
    font-weight:700;
    color:#198754;
}

.logo p{
    color:#777;
    margin-top:5px;
}

.input-box{
    position:relative;
    margin-bottom:20px;
}

.input-box i{
    position:absolute;
    left:15px;
    top:18px;
    color:#198754;
}

.form-control{
    height:52px;
    border-radius:10px;
    padding-left:45px;
    border:1px solid #ddd;
}

.form-control:focus{
    border-color:#198754;
    box-shadow:none;
}

.login-btn1{
    width:100%;
    height:52px;
    border:none;
    border-radius:10px;
    background:#198754;
    color:#fff;
    font-weight:600;
    transition:.3s;
}

.login-btn1:hover{
    background:#157347;
}

.extra{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-top:12px;
    font-size:14px;
}

.extra a{
    text-decoration:none;
    color:#198754;
}

.signup{
    margin-top:25px;
    text-align:center;
    color:#666;
}

.signup a{
    color:#198754;
    text-decoration:none;
    font-weight:600;
}

.alert{
    border-radius:10px;
    margin-bottom:20px;
}

@media(max-width:576px){

.login-card{
    padding:25px;
}

}

</style>

<section class="login-section">

<div class="login-card">

<div class="logo">

<i class="fa-solid fa-store"></i>

<h2>HisabKitab</h2>

<p>Sign in to your account</p>

</div>

@if($errors->any())

<div class="alert alert-danger">

@foreach($errors->all() as $error)

<div>{{ $error }}</div>

@endforeach

</div>

@endif

<form action="{{ route('shop.login.post') }}" method="POST">

@csrf

<div class="input-box">

<i class="fa-solid fa-envelope"></i>

<input
type="email"
name="email"
class="form-control"
placeholder="Email Address"
required>

</div>

<div class="input-box">

<i class="fa-solid fa-lock"></i>

<input
type="password"
name="password"
class="form-control"
placeholder="Password"
required>

</div>




<div class="text-end mt-2">
    <a href="{{ route('forgot.password') }}"
       class="text-success text-decoration-none fw-semibold">
        Forgot Password?
    </a>

</div>

<button class="login-btn1 mt-4">

Login

</button>

</form>

<div class="signup">

Don't have an account?

<a href="{{ url('/shop/register') }}">

Create Account

</a>

</div>

</div>

</section>



@endsection
@if(session('success'))
<script>
Swal.fire({
    icon: 'success',
    title: 'Success',
    text: "{{ session('success') }}",
    timer: 2000,
    showConfirmButton: false
});
</script>
@endif