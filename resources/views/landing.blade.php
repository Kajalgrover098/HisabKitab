@extends('layouts.app')

@section('content')

<style>
/* ===========================
   GOOGLE FONT (Optional)
=========================== */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap');

body{
    font-family:'Poppins',sans-serif;
    background:#fff;
    overflow-x:hidden;
    color:#2d3748;
}

/* ===========================
        HERO SECTION
=========================== */

.hero-section{
    position:relative;
    padding:90px 0;
    overflow:hidden;
    background:
    radial-gradient(circle at top right,#dff7ea 0%,transparent 35%),
    linear-gradient(to bottom,#ffffff,#f8fffb);
}

.min-vh-75{
    min-height:75vh;
}

.hero-badge{
    display:inline-block;
    background:#d8f5e5;
    color:#198754;
    padding:10px 20px;
    border-radius:40px;
    font-weight:600;
    font-size:14px;
    letter-spacing:.5px;
}

.hero-section h1{
    font-size:55px;
    font-weight:800;
    line-height:1.2;
    margin-top:20px;
    margin-bottom:25px;
}

.hero-section p{
    color:#6c757d;
    font-size:18px;
    line-height:1.8;
}

/* ===========================
        BUTTONS
=========================== */

.btn-success{

    padding:14px 32px;
    border-radius:50px;
    font-weight:600;
    transition:.35s;

}

.btn-success:hover{

    transform:translateY(-4px);
    box-shadow:0 15px 35px rgba(25,135,84,.25);

}

.btn-outline-success{

    padding:14px 32px;
    border-radius:50px;
    font-weight:600;
    transition:.35s;

}

.btn-outline-success:hover{

    transform:translateY(-4px);

}

/* ===========================
        HERO IMAGE
=========================== */

.hero-image{

    border-radius:20px;
    padding:10px;
    background:#fff;
    box-shadow:0 25px 60px rgba(0,0,0,.12);
    animation:floatImage 4s ease-in-out infinite;

}

@keyframes floatImage{

    0%{
        transform:translateY(0);
    }

    50%{
        transform:translateY(-15px);
    }

    100%{
        transform:translateY(0);
    }

}

/* ===========================
     SECTION TITLES
=========================== */

.section-title{

    text-align:center;
    margin-bottom:60px;

}

.section-title h2{

    font-size:40px;
    font-weight:700;
    margin-top:15px;

}

.section-title p{

    color:#6c757d;
    max-width:650px;
    margin:auto;
    margin-top:15px;
    line-height:1.8;

}

/* ===========================
      FEATURE CARDS
=========================== */

.feature-card{

    background:#fff;
    border-radius:18px;
    padding:35px 28px;
    text-align:center;
    border:1px solid #eef2f4;
    box-shadow:0 10px 30px rgba(0,0,0,.06);
    transition:.35s;
    height:100%;

}

.feature-card:hover{

    transform:translateY(-10px);
    border-color:#198754;
    box-shadow:0 20px 45px rgba(25,135,84,.18);

}

.icon-box{

    width:75px;
    height:75px;
    border-radius:18px;
    margin:auto;
    margin-bottom:25px;
    background:#198754;
    color:#fff;
    display:flex;
    justify-content:center;
    align-items:center;
    font-size:30px;
    transition:.35s;

}

.feature-card:hover .icon-box{

    transform:rotate(8deg) scale(1.1);

}

.feature-card h5{

    font-weight:700;
    margin-bottom:15px;

}

.feature-card p{

    color:#6c757d;
    line-height:1.7;
    margin-bottom:0;

}

/* ===========================
      WHY CHOOSE US
=========================== */

.why-section{

    padding:90px 0;
    background:#fcfcfc;

}

.choose-point{

    display:flex;
    align-items:flex-start;
    gap:15px;
    margin-bottom:22px;
    font-size:17px;
    line-height:1.7;

}

.choose-point i{

    color:#198754;
    margin-top:5px;
    font-size:22px;

}

/* ===========================
      BENEFIT CARDS
=========================== */

.benefit-card{

    background:#fff;
    border-radius:18px;
    padding:30px 20px;
    text-align:center;
    border:1px solid #eef2f4;
    box-shadow:0 10px 30px rgba(0,0,0,.06);
    transition:.35s;
    height:100%;

}

.benefit-card:hover{

    transform:translateY(-8px);
    border-color:#198754;
    box-shadow:0 20px 40px rgba(25,135,84,.18);

}

.benefit-card i{

    width:70px;
    height:70px;
    border-radius:50%;
    background:#198754;
    color:#fff;
    display:flex;
    justify-content:center;
    align-items:center;
    margin:auto;
    margin-bottom:18px;
    font-size:28px;
    transition:.35s;

}

.benefit-card:hover i{

    transform:scale(1.1) rotate(8deg);

}

.benefit-card h5{

    font-weight:700;
    margin-bottom:10px;

}

.benefit-card small{

    color:#6c757d;
    line-height:1.6;
    display:block;

}

/* ===========================
      DIVIDER
=========================== */

.section-divider{

    width:80px;
    height:4px;
    background:#198754;
    border-radius:20px;
    margin:50px auto;

}

/* ===========================
      RESPONSIVE
=========================== */

@media(max-width:991px){

.hero-section{

    text-align:center;
    padding:70px 0;

}

.hero-section h1{

    font-size:40px;

}

.hero-image{

    margin-top:50px;

}

.section-title h2{

    font-size:32px;

}

.why-section{

    text-align:center;

}

.choose-point{

    justify-content:center;
    text-align:left;

}

}

@media(max-width:576px){

.hero-section h1{

    font-size:32px;

}

.hero-section p{

    font-size:16px;

}

.btn-success,
.btn-outline-success{

    width:100%;

}

.feature-card,
.benefit-card{

    padding:25px 20px;

}

}
</style>




<!-- ========================= HERO SECTION ========================= -->

<section class="hero-section">

    <div class="container">

        <div class="row align-items-center min-vh-75">

            <!-- Left Content -->

            <div class="col-lg-6">

                <span class="hero-badge">
                    <i class="fa-solid fa-shield-halved me-2"></i>
                    Smart Accounting Solution
                </span>

                <h1>
                    Run Your Business Smarter with
                    <span class="text-success">HisabKitab</span>
                </h1>

                <p class="mb-4">
                    Manage customers, products, inventory, sales, purchases,
                    expenses and reports from one simple dashboard.
                    Built especially for shopkeepers and small businesses.
                </p>

                <div class="d-flex flex-wrap gap-3">

                    <a href="#" class="btn btn-success">

                        <i class="fa-solid fa-arrow-right me-2"></i>

                        Get Started

                    </a>

                    <a href="#" class="btn btn-outline-success">

                        <i class="fa-solid fa-circle-info me-2"></i>

                        Learn More

                    </a>

                </div>

            </div>

            <!-- Right Image -->

            <div class="col-lg-6 text-center">

                <img src="{{ asset('images/main.jpg') }}"
                     class="img-fluid hero-image"
                     alt="HisabKitab">

            </div>

        </div>

    </div>

</section>


<div class="section-divider"></div>


<!-- ========================= FEATURES ========================= -->

<section class="py-5">

    <div class="container">

        <div class="section-title">

            <span class="hero-badge">
                Powerful Features
            </span>

            <h2>

                Everything You Need To
                <span class="text-success">
                    Manage Your Business
                </span>

            </h2>

            <p>

                HisabKitab combines all essential business tools into one
                platform so you can manage your shop efficiently without
                maintaining multiple registers.

            </p>

        </div>


        <div class="row g-4">

            <!-- Card 1 -->

            <div class="col-md-6 col-lg-3">

                <div class="feature-card">

                    <div class="icon-box">

                        <i class="fa-solid fa-users"></i>

                    </div>

                    <h5>Customer Management</h5>

                    <p>

                        Store customer information, manage credit balances
                        and maintain complete customer history.

                    </p>

                </div>

            </div>


            <!-- Card 2 -->

            <div class="col-md-6 col-lg-3">

                <div class="feature-card">

                    <div class="icon-box">

                        <i class="fa-solid fa-box-open"></i>

                    </div>

                    <h5>Inventory Tracking</h5>

                    <p>

                        Monitor stock levels, product availability and pricing
                        without any manual calculations.

                    </p>

                </div>

            </div>


            <!-- Card 3 -->

            <div class="col-md-6 col-lg-3">

                <div class="feature-card">

                    <div class="icon-box">

                        <i class="fa-solid fa-chart-line"></i>

                    </div>

                    <h5>Sales Analytics</h5>

                    <p>

                        Track daily sales, compare performance and make
                        better business decisions using reports.

                    </p>

                </div>

            </div>


            <!-- Card 4 -->

            <div class="col-md-6 col-lg-3">

                <div class="feature-card">

                    <div class="icon-box">

                        <i class="fa-solid fa-wallet"></i>

                    </div>

                    <h5>Expense Management</h5>

                    <p>

                        Record every expense and understand your
                        actual business profit with ease.

                    </p>

                </div>

            </div>

        </div>

    </div>

</section>
<!-- ========================= WHY CHOOSE US ========================= -->

<section class="why-section">

    <div class="container">

        <div class="row align-items-center g-5">

            <!-- Left Side -->

            <div class="col-lg-6">

                <span class="hero-badge">
                    Why Choose HisabKitab
                </span>

                <h2 class="mt-4 fw-bold">

                    Spend Less Time On Records,
                    <span class="text-success">
                        More Time Growing Your Business.
                    </span>

                </h2>

                <p class="mt-4 text-muted">

                    Running a business should be simple. HisabKitab helps you
                    organize every transaction digitally, reduce paperwork,
                    monitor business performance and make smarter decisions —
                    all from one easy-to-use platform.

                </p>

                <div class="mt-4">

                    <div class="choose-point">

                        <i class="fa-solid fa-circle-check"></i>

                        <div>

                            <strong>Simple & Easy Interface</strong><br>

                            Anyone can use HisabKitab without technical knowledge.

                        </div>

                    </div>

                    <div class="choose-point">

                        <i class="fa-solid fa-circle-check"></i>

                        <div>

                            <strong>Everything In One Place</strong><br>

                            Customers, inventory, expenses and reports are managed together.

                        </div>

                    </div>

                    <div class="choose-point">

                        <i class="fa-solid fa-circle-check"></i>

                        <div>

                            <strong>Save Valuable Time</strong><br>

                            Reduce manual calculations and paperwork every day.

                        </div>

                    </div>

                    <div class="choose-point">

                        <i class="fa-solid fa-circle-check"></i>

                        <div>

                            <strong>Made For Small Businesses</strong><br>

                            Designed especially for shopkeepers and local businesses.

                        </div>

                    </div>

                </div>

                <div class="mt-5">

                    <a href="#" class="btn btn-success">

                        <i class="fa-solid fa-phone me-2"></i>

                        Contact Us

                    </a>

                </div>

            </div>


            <!-- Right Side -->

            <div class="col-lg-6">

                <div class="row g-4">

                    <div class="col-6">

                        <div class="benefit-card">

                            <i class="fa-solid fa-book"></i>

                            <h5>Digital Ledger</h5>

                            <small>

                                Maintain customer accounts digitally without using notebooks.

                            </small>

                        </div>

                    </div>

                    <div class="col-6">

                        <div class="benefit-card">

                            <i class="fa-solid fa-boxes-stacked"></i>

                            <h5>Smart Inventory</h5>

                            <small>

                                Easily track available stock and product movements.

                            </small>

                        </div>

                    </div>

                    <div class="col-6">

                        <div class="benefit-card">

                            <i class="fa-solid fa-chart-pie"></i>

                            <h5>Business Insights</h5>

                            <small>

                                View reports that help you understand your business growth.

                            </small>

                        </div>

                    </div>

                    <div class="col-6">

                        <div class="benefit-card">

                            <i class="fa-solid fa-indian-rupee-sign"></i>

                            <h5>Profit Tracking</h5>

                            <small>

                                Know your income, expenses and profit at any time.

                            </small>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>


<!-- ========================= CALL TO ACTION ========================= -->

<section class="py-5">

    <div class="container">

        <div class="bg-success text-white rounded-4 p-5 text-center shadow">

            <h2 class="fw-bold">

                Ready To Simplify Your Business?

            </h2>

            <p class="mt-3 mb-4">

                Join HisabKitab and manage your customers, inventory,
                expenses and reports from one powerful dashboard.

            </p>

            <a href="#" class="btn btn-light btn-lg px-4">

                <i class="fa-solid fa-arrow-right me-2"></i>

                Get Started Today

            </a>

        </div>

    </div>

</section>

@endsection