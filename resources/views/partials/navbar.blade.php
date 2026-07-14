<style>
    .navbar-custom{
        background:#fff;
        box-shadow:0 8px 25px rgba(0,0,0,.05);
        padding:15px 0;
        transition:.3s;
    }

    .navbar-brand{
        font-size:28px;
        font-weight:800;
        color:#198754 !important;
        letter-spacing:.5px;
    }

    .navbar-brand span{
        color:#212529;
    }

    .navbar-nav .nav-link{
        color:#495057;
        font-weight:600;
        margin:0 12px;
        position:relative;
        transition:.3s;
    }

    .navbar-nav .nav-link::after{
        content:'';
        position:absolute;
        left:0;
        bottom:-5px;
        width:0%;
        height:3px;
        background:#198754;
        border-radius:10px;
        transition:.3s;
    }

    .navbar-nav .nav-link:hover{
        color:#198754;
    }

    .navbar-nav .nav-link:hover::after{
        width:100%;
    }

    .login-btn{
        background:#198754;
        color:#fff;
        padding:10px 22px;
        border-radius:30px;
        font-weight:600;
        transition:.3s;
        border:2px solid #198754;
    }

    .login-btn:hover{
        background:#157347;
        border-color:#157347;
        color:#fff;
        transform:translateY(-2px);
        box-shadow:0 10px 20px rgba(25,135,84,.25);
    }

    .navbar-toggler{
        border:none;
    }

    .navbar-toggler:focus{
        box-shadow:none;
    }
</style>


<nav class="navbar navbar-expand-lg navbar-custom sticky-top">

    <div class="container">

        <a class="navbar-brand d-flex align-items-center" href="/">
    <img src="{{ asset('images/logo.png') }}" alt="Logo" width="45" class="me-2">
    Hisab<span>Kitab</span>
</a>

        <button class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbar">

            <span class="navbar-toggler-icon"></span>

        </button>

        <div class="collapse navbar-collapse" id="navbar">

            <ul class="navbar-nav ms-auto align-items-lg-center">

                <li class="nav-item">
                    <a href="/" class="nav-link">Home</a>
                </li>

                <li class="nav-item">
                    <a href="/about" class="nav-link">About</a>
                </li>

                

                <li class="nav-item">
                    <a href="/contact" class="nav-link">Contact</a>
                </li>

                <li class="nav-item ms-lg-3 mt-3 mt-lg-0">
                    <a href="/shopkeeper/login" class="btn login-btn">
                        Login
                    </a>
                </li>

            </ul>

        </div>

    </div>

</nav>

</nav>