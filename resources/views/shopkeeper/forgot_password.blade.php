<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password | HisabKitab</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body style="min-height:100vh;">

<div class="container d-flex justify-content-center align-items-center" style="min-height:100vh;">

    <div class="card shadow-lg border-0" style="max-width:450px;width:100%;border-radius:20px;">

        <div class="card-body p-5">

            <div class="text-center mb-4">

                <i class="bi bi-key-fill text-success" style="font-size:55px;"></i>

                <h3 class="fw-bold mt-3">
                    Forgot Password
                </h3>

                <p class="text-muted">
                    Enter your registered email and create a new password.
                </p>

            </div>

            <form action="{{ route('forgot.password.update') }}" method="POST">

                @csrf

                <div class="mb-3">

                    <label class="form-label fw-semibold">
                        Email Address
                    </label>

                    <input
                        type="email"
                        name="email"
                        class="form-control"
                        placeholder="Enter your registered email"
                        required>

                </div>

                <div class="mb-3">

                    <label class="form-label fw-semibold">
                        New Password
                    </label>

                    <input
                        type="password"
                        name="password"
                        class="form-control"
                        placeholder="Enter new password"
                        required>

                </div>

                <div class="mb-4">

                    <label class="form-label fw-semibold">
                        Confirm Password
                    </label>

                    <input
                        type="password"
                        name="password_confirmation"
                        class="form-control"
                        placeholder="Confirm new password"
                        required>

                </div>

                <button class="btn btn-success w-100 py-2 fw-semibold">
                    <i class="bi bi-arrow-repeat me-2"></i>
                    Update Password
                </button>

                <div class="text-center mt-3">

                    <a href="{{ url('/') }}" class="text-decoration-none text-success fw-semibold">
                        <i class="bi bi-arrow-left"></i>
                        Back to Login
                    </a>

                </div>

            </form>

        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
@if(session('error'))
<script>
Swal.fire({
    icon: 'error',
    title: 'Error',
    text: "{{ session('error') }}"
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

</body>
</html>