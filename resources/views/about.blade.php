@extends('layouts.app')

@section('content')

<div class="container py-5">

    <!-- Hero Section -->
    <div class="text-center mb-5">

        <h1 class="fw-bold text-success">
            About HisabKitab
        </h1>

        <p class="lead text-muted mt-3">
            A simple, secure and efficient billing & account management system
            designed for grocery shopkeepers to manage customers, products,
            billing and payment records digitally.
        </p>

    </div>


        

    <!-- Features -->

    <div class="mt-5">

        <h2 class="text-center fw-bold text-success mb-5">
            Key Features
        </h2>

        <div class="row g-4">

            <div class="col-md-4">

                <div class="card border-0 shadow-sm rounded-4 h-100">

                    <div class="card-body text-center p-4">

                        <i class="bi bi-people-fill text-success"
                           style="font-size:55px;"></i>

                        <h5 class="fw-bold mt-3">
                            Customer Management
                        </h5>

                        <p class="text-muted">

                            Add, update and manage customer information with ease.

                        </p>

                    </div>

                </div>

            </div>

            <div class="col-md-4">

                <div class="card border-0 shadow-sm rounded-4 h-100">

                    <div class="card-body text-center p-4">

                        <i class="bi bi-box-seam text-success"
                           style="font-size:55px;"></i>

                        <h5 class="fw-bold mt-3">
                            Product Management
                        </h5>

                        <p class="text-muted">

                            Maintain products, prices, stock and availability.

                        </p>

                    </div>

                </div>

            </div>

            <div class="col-md-4">

                <div class="card border-0 shadow-sm rounded-4 h-100">

                    <div class="card-body text-center p-4">

                        <i class="bi bi-receipt-cutoff text-success"
                           style="font-size:55px;"></i>

                        <h5 class="fw-bold mt-3">
                            Smart Billing
                        </h5>

                        <p class="text-muted">

                            Generate invoices and automatically calculate due amounts.

                        </p>

                    </div>

                </div>

            </div>

            <div class="col-md-4">

                <div class="card border-0 shadow-sm rounded-4 h-100">

                    <div class="card-body text-center p-4">

                        <i class="bi bi-clock-history text-success"
                           style="font-size:55px;"></i>

                        <h5 class="fw-bold mt-3">
                            Previous Records
                        </h5>

                        <p class="text-muted">

                            Keep track of old balances and payment history.

                        </p>

                    </div>

                </div>

            </div>

            <div class="col-md-4">

                <div class="card border-0 shadow-sm rounded-4 h-100">

                    <div class="card-body text-center p-4">

                        <i class="bi bi-bell-fill text-success"
                           style="font-size:55px;"></i>

                        <h5 class="fw-bold mt-3">
                            Payment Reminders
                        </h5>

                        <p class="text-muted">

                            View pending payments and send reminders to customers.

                        </p>

                    </div>

                </div>

            </div>

            <div class="col-md-4">

                <div class="card border-0 shadow-sm rounded-4 h-100">

                    <div class="card-body text-center p-4">

                        <i class="bi bi-shield-lock-fill text-success"
                           style="font-size:55px;"></i>

                        <h5 class="fw-bold mt-3">
                            Secure System
                        </h5>

                        <p class="text-muted">

                            Session-based authentication keeps shop data secure.

                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- Why Choose -->

    <div class="mt-5">

        <div class="card border-0 shadow rounded-4">

            <div class="card-body p-5">

                <h2 class="fw-bold text-success mb-4 text-center">

                    Why Choose HisabKitab?

                </h2>

                <div class="row">

                    <div class="col-md-6">

                        <ul class="list-group list-group-flush">

                            <li class="list-group-item">
                                ✔ Easy to Use Interface
                            </li>

                            <li class="list-group-item">
                                ✔ Fast Billing Process
                            </li>

                            <li class="list-group-item">
                                ✔ Customer History Tracking
                            </li>

                            <li class="list-group-item">
                                ✔ Previous Balance Management
                            </li>

                        </ul>

                    </div>

                    <div class="col-md-6">

                        <ul class="list-group list-group-flush">

                            <li class="list-group-item">
                                ✔ Accurate Due Calculations
                            </li>

                            <li class="list-group-item">
                                ✔ Secure Login System
                            </li>

                            <li class="list-group-item">
                                ✔ Professional Dashboard
                            </li>

                            <li class="list-group-item">
                                ✔ Responsive Design
                            </li>

                        </ul>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection