<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Admin Login | HisabKitab</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



<style>
body{
    background:#f4f9f6;
    font-family:'Poppins',sans-serif;
}

.form-control{
    height:50px;
}

.form-control:focus{
    box-shadow:none;
    border-color:#198754;
}

.input-group-text{
    background:#fff;
    border-right:none;
}

.input-group .form-control{
    border-left:none;
}

.card{
    border-radius:20px;
}

.btn-success{
    border-radius:10px;
}

@media(max-width:576px){

.card-body{
    padding:30px 20px;
}

h2{
    font-size:28px;
}

}
</style>
<body style="background:#f4f9f6;">

<div class="container">

    <div class="row justify-content-center align-items-center"
         style="min-height:100vh;">

        <div class="col-xl-4 col-lg-5 col-md-7 col-sm-10">

            <div class="card border-0 shadow-lg rounded-4">

                <div class="card-body p-5">

                    <div class="text-center mb-4">

                        <i class="fa-solid fa-book-open text-success"
                           style="font-size:55px;"></i>

                        <h2 class="fw-bold mt-3 mb-1">

                            Hisab<span class="text-success">Kitab</span>

                        </h2>

                        <p class="text-muted">

                            Administrator Login

                        </p>

                    </div>

                    <form action="{{ route('admin.login.post') }}" method="POST">

                        @csrf

                        <div class="mb-3">

                            <label class="fw-semibold mb-2">

                                Email Address

                            </label>

                            <div class="input-group">

                                <span class="input-group-text bg-white">

                                    <i class="fa-solid fa-envelope text-success"></i>

                                </span>

                                <input
                                    type="email"
                                    name="email"
                                    class="form-control"
                                    placeholder="Enter Email"
                                    required>

                            </div>

                        </div>

                        <div class="mb-3">

                            <label class="fw-semibold mb-2">

                                Password

                            </label>

                            <div class="input-group">

                                <span class="input-group-text bg-white">

                                    <i class="fa-solid fa-lock text-success"></i>

                                </span>

                                <input
                                    type="password"
                                    name="password"
                                    class="form-control"
                                    placeholder="Enter Password"
                                    required>

                            </div>

                        </div>

                        <div class="d-flex justify-content-between mb-4">

                           

                            <a href="#"
                               class="text-success text-decoration-none">

                                Forgot Password?

                            </a>

                        </div>

                        <button type="submit"
                                class="btn btn-success w-100 py-3 fw-semibold">

                            <i class="fa-solid fa-right-to-bracket me-2"></i>

                            Login

                        </button>

                    </form>

                    <hr>

                    <div class="text-center">

                        <p class="mb-3">

                            Don't have an Admin Account?

                        </p>
                          <a href="/"  class="btn btn-success">Go Back!</a>

                        <a href="{{ route('admin.register') }}"
                           class="btn btn-outline-success">

                            <i class="fa-solid fa-user-plus me-2"></i>

                            Create Account

                        </a>
                      

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>
@if(session('success'))

<script>

Swal.fire({

    icon:'success',

    title:'Success',

    text:'{{ session("success") }}',

    confirmButtonColor:'#198754',

    confirmButtonText:'OK'

});

</script>

@endif


@if($errors->any())

<script>

Swal.fire({

    icon:'error',

    title:'Oops...',

    html:`{!! implode('<br>', $errors->all()) !!}`,

    confirmButtonColor:'#dc3545',

    confirmButtonText:'OK'

});

</script>

@endif