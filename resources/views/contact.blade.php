@extends('layouts.app')

@section('content')

@if(session('success'))
<script>
Swal.fire({
    icon: 'success',
    title: 'Success',
    text: '{{ session("success") }}',
    timer: 2000,
    showConfirmButton: false
});
</script>
@endif

@if($errors->any())
<script>
Swal.fire({
    icon: 'error',
    title: 'Validation Error',
    html: `{!! implode('<br>', $errors->all()) !!}`
});
</script>
@endif

<div class="container py-5">

    <!-- Heading -->
    <div class="text-center mb-5">
        <h2 class="fw-bold text-success">Contact Us</h2>
        <p class="text-muted">
            We'd love to hear from you. Feel free to reach out with any questions,
            suggestions, or support requests.
        </p>
    </div>

    <div class="row g-4">

        <!-- Contact Information -->
        <div class="col-lg-5">

            <div class="card border-0 shadow-sm rounded-4 h-100">

                <div class="card-body p-4">

                    <h4 class="fw-bold text-success mb-4">
                        Get In Touch
                    </h4>

                    <div class="mb-4 d-flex">

                        <i class="bi bi-envelope-fill text-success fs-3 me-3"></i>

                        <div>

                            <h6 class="fw-bold mb-1">Email</h6>

                            <p class="text-muted mb-0">
                                support@hisabkitab.com
                            </p>

                        </div>

                    </div>

                    <div class="mb-4 d-flex">

                        <i class="bi bi-telephone-fill text-success fs-3 me-3"></i>

                        <div>

                            <h6 class="fw-bold mb-1">Phone</h6>

                            <p class="text-muted mb-0">
                                +91 98765 43210
                            </p>

                        </div>

                    </div>

                    <div class="d-flex">

                        <i class="bi bi-clock-fill text-success fs-3 me-3"></i>

                        <div>

                            <h6 class="fw-bold mb-1">
                                Business Hours
                            </h6>

                            <p class="text-muted mb-0">
                                Monday - Saturday
                                <br>
                                9:00 AM - 6:00 PM
                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <!-- Contact Form -->
        <div class="col-lg-7">

            <div class="card border-0 shadow-sm rounded-4">

                <div class="card-body p-4">

                    <h4 class="fw-bold text-success mb-4">
                        Send Us a Message
                    </h4>

                    <form action="{{ route('contact.store') }}" method="POST">

                        @csrf

                        <div class="row">

                            <!-- Name -->
                            <div class="col-md-6 mb-3">

                                <label class="form-label fw-semibold">
                                    Full Name
                                </label>

                                <input
                                    type="text"
                                    name="name"
                                    class="form-control"
                                    placeholder="Enter your full name"
                                    value="{{ old('name') }}">

                            </div>

                            <!-- Email -->
                            <div class="col-md-6 mb-3">

                                <label class="form-label fw-semibold">
                                    Email Address
                                </label>

                                <input
                                    type="email"
                                    name="email"
                                    class="form-control"
                                    placeholder="Enter your email"
                                    value="{{ old('email') }}">

                            </div>

                        </div>

                        <!-- Subject -->
                        <div class="mb-3">

                            <label class="form-label fw-semibold">
                                Subject
                            </label>

                            <input
                                type="text"
                                name="subject"
                                class="form-control"
                                placeholder="Enter subject"
                                value="{{ old('subject') }}">

                        </div>

                        <!-- Message -->
                        <div class="mb-4">

                            <label class="form-label fw-semibold">
                                Message
                            </label>

                            <textarea
                                name="message"
                                class="form-control"
                                rows="6"
                                placeholder="Write your message here...">{{ old('message') }}</textarea>

                        </div>

                        <button type="submit" class="btn btn-success px-4">

                            <i class="bi bi-send-fill me-2"></i>

                            Send Message

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection