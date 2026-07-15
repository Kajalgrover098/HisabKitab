@include('admin.sidebar')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Shopkeeper</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
       @if(session('success'))

<script>

Swal.fire({
    icon: 'success',
    title: 'Success!',
    text: '{{ session("success") }}',
    showConfirmButton: false,
    timer: 2000
});

</script>

@endif
<style>

body{
    background:#eef2f7;
    font-family:'Segoe UI',Tahoma,Geneva,Verdana,sans-serif;
}

.form-card{
    max-width:850px;
    margin:40px auto;
    border:none;
    border-radius:18px;
    overflow:hidden;
    box-shadow:0 12px 30px rgba(0,0,0,.12);
    background:#fff;
}

.card-header{
    background:linear-gradient(90deg,#198754,#157347);
    color:#fff;
    padding:20px 25px;
}

.card-body{
    padding:35px;
}

.form-label{
    font-weight:600;
    margin-bottom:8px;
    color:#333;
}

.form-control{
    border-radius:10px;
    padding:10px 15px;
    border:1px solid #ced4da;
}

.form-control:focus{
    border-color:#198754;
    box-shadow:0 0 8px rgba(25,135,84,.25);
}

.required{
    color:red;
}

.btn-success{
    padding:10px 28px;
    border-radius:10px;
    font-weight:600;
}

.btn-secondary{
    padding:10px 25px;
    border-radius:10px;
    font-weight:600;
}

.error{
    color:red;
    font-size:14px;
    margin-top:4px;
}

.page-title{
    text-align:center;
    margin-top:25px;
    margin-bottom:20px;
}

.page-title h2{
    font-weight:700;
    color:#212529;
}

.page-title p{
    color:#6c757d;
}

/* ===========================
        Responsive CSS
=========================== */

@media (max-width:991px){

     .content{
        margin-left:0;
        margin-top:65px;   /* Toggle ke niche content aa jayega */
        padding:20px;
    }

    .form-card{
        max-width:95%;
        margin:25px auto;
    }

    .card-body{
        padding:25px;
    }

}

@media (max-width:768px){
 .content{
        margin-left:0;
        margin-top:65px;   /* Toggle ke niche content aa jayega */
        padding:20px;
    }
    .page-title{
        margin-top:15px;
        margin-bottom:15px;
        padding:0 10px;
    }

    .page-title h2{
        font-size:24px;
    }

    .page-title p{
        font-size:14px;
    }

    .form-card{
        max-width:100%;
        margin:20px 10px;
        border-radius:14px;
    }

    .card-header{
        padding:16px 20px;
        text-align:center;
    }

    .card-header h4,
    .card-header h5{
        font-size:20px;
        margin:0;
    }

    .card-body{
        padding:20px;
    }

    .form-label{
        font-size:14px;
    }

    .form-control{
        font-size:14px;
        padding:10px 12px;
    }

    .btn-success,
    .btn-secondary{
        width:100%;
        margin-bottom:10px;
    }

}

@media (max-width:576px){
     .content{
        margin-left:0;
        margin-top:65px;   /* Toggle ke niche content aa jayega */
        padding:20px;
    }

    body{
        padding:8px;
    }

    .page-title h2{
        font-size:20px;
    }

    .page-title p{
        font-size:13px;
    }

    .form-card{
        margin:10px 0;
        border-radius:12px;
    }

    .card-header{
        padding:15px;
    }

    .card-header h4,
    .card-header h5{
        font-size:18px;
    }

    .card-body{
        padding:15px;
    }

    .form-label{
        font-size:13px;
    }

    .form-control{
        font-size:13px;
        padding:9px 10px;
    }

    textarea.form-control{
        min-height:100px;
    }

    .btn-success,
    .btn-secondary{
        width:100%;
        font-size:14px;
        padding:10px;
    }

    .error{
        font-size:13px;
    }

}

</style>
</head>
<body>

<div class="container">

    <div class="card shadow form-card">

        <div class="page-title">
    <h2><i class="bi bi-shop"></i> Add New Shopkeeper</h2>
    <p>Fill in the details to register a new shopkeeper.</p>
</div>


        <div class="card-body">

            <form action="{{ route('admin.storeShopkeeper') }}" method="POST">
    

                @csrf
                @error('email')
<div class="text-danger mt-1">
    {{ $message }}
</div>
@enderror
  @error('phone')
<div class="text-danger mt-1">
    {{ $message }}
</div>
@enderror

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                           <i class="bi bi-shop"></i>
                           Shop Name <span class="required">*</span>
                       </label>
                         <div id="shop_error" class="error"></div>

                        <input type="text"
                               name="shop_name"
                               id="shop_name"
                               class="form-control"
                               placeholder="Enter Shop Name">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            <i class="bi bi-person-fill"></i>
                            Owner Name <span class="required">*</span>
                        </label>
                      <div id="owner_error" class="error"></div>
                        <input type="text"
                               name="owner_name"
                               id="owner_name"
                               class="form-control"
                               placeholder="Enter Owner Name"
                                onkeypress="return onlyLetters(event)">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label"><i class="bi bi-telephone-fill"></i>
                            Phone Number <span class="required">*</span>
                        </label>
                          <div id="phone_error" class="error"></div>
                        <input type="text"
                               name="phone"
                               id="phone"
                               class="form-control"
                                maxlength="10"
                               placeholder="Enter Phone Number"
                               onkeypress="return onlyNumbers(event)">
                    </div>
                  

                    <div class="col-md-6 mb-3"><i class="bi bi-envelope-fill"></i>
                        <label class="form-label">
                            Email Address
                        </label>
                        <div id="email_error" class="error"></div>

                        <input type="email"
                               name="email"
                               id="email"
                               class="form-control"
                               placeholder="Enter Email">
                    </div>
                    
                    <div class="col-md-6 mb-3">
    <label class="form-label">
        <i class="bi bi-lock-fill"></i>
        Password <span class="required">*</span>
    </label>

    <input type="password"
           id="password"
           name="password"
           class="form-control"
           placeholder="Enter Password">

    <div id="password_error" class="error"></div>
</div>

<div class="col-md-6 mb-3">
    <label class="form-label">
        <i class="bi bi-shield-lock-fill"></i>
        Confirm Password <span class="required">*</span>
    </label>

    <input type="password"
           id="confirm_password"
           class="form-control"
           placeholder="Confirm Password">

    <div id="confirm_error" class="error"></div>
</div>

                    <div class="col-12 mb-3">
                        <label class="form-label"><i class="bi bi-geo-alt-fill"></i>
                            Address <span class="required">*</span>
                        </label>
                     <div id="address_error" class="error"></div>
                        <textarea
                            name="address"
                            rows="4"
                            id="address"
                            class="form-control"
                            placeholder="Enter Complete Address"></textarea>
                    </div>

                </div>

                <div class="d-flex justify-content-end">

                    <a href="#" class="btn btn-secondary me-2">
                        Cancel
                    </a>

                    <button type="submit" class="btn btn-success">
                        Save Shopkeeper
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>
<script>

// Form Validation
document.querySelector("form").addEventListener("submit", function(e){

    let valid = true;

    // Remove old error messages
    document.getElementById("shop_error").innerHTML = "";
    document.getElementById("owner_name").addEventListener("input", function(){
    document.getElementById("owner_error").innerHTML = "";
});;
   document.getElementById("phone").addEventListener("input", function(){
    document.getElementById("phone_error").innerHTML = "";
});
    document.getElementById("email_error").innerHTML = "";
    document.getElementById("password_error").innerHTML = "";
    document.getElementById("confirm_error").innerHTML = "";
    document.getElementById("address_error").innerHTML = "";

    // Get values
    let shop = document.getElementById("shop_name").value.trim();
    let owner = document.getElementById("owner_name").value.trim();
    let phone = document.getElementById("phone").value.trim();
    let email = document.getElementById("email").value.trim();
    let password = document.getElementById("password").value;
    let confirm = document.getElementById("confirm_password").value;
    let address = document.getElementById("address").value.trim();

    // Shop Name
    if(shop == ""){
        document.getElementById("shop_error").innerHTML = "Shop Name is required";
        valid = false;
    }

    // Owner Name
    if(owner == ""){
        document.getElementById("owner_error").innerHTML = "Owner Name is required";
        valid = false;
    }

    // Phone
    if(phone == ""){
        document.getElementById("phone_error").innerHTML = "Phone Number is required";
        valid = false;
    }
    else if(phone.length != 10){
        document.getElementById("phone_error").innerHTML = "Phone Number must be 10 digits";
        valid = false;
    }
    else if(phone[0] < '6'){
        document.getElementById("phone_error").innerHTML = "Phone Number must start with 6, 7, 8 or 9";
        valid = false;
    }

    // Email
    let pattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if(email == ""){
        document.getElementById("email_error").innerHTML = "Email is required";
        valid = false;
    }
    else if(!pattern.test(email)){
        document.getElementById("email_error").innerHTML = "Enter a valid Email";
        valid = false;
    }

    // Password
    if(password == ""){
        document.getElementById("password_error").innerHTML = "Password is required";
        valid = false;
    }
    else if(password.length < 8){
        document.getElementById("password_error").innerHTML = "Password must be at least 8 characters";
        valid = false;
    }

    // Confirm Password
    if(confirm == ""){
        document.getElementById("confirm_error").innerHTML = "Confirm Password is required";
        valid = false;
    }
    else if(password != confirm){
        document.getElementById("confirm_error").innerHTML = "Passwords do not match";
        valid = false;
    }

    // Address
    if(address == ""){
        document.getElementById("address_error").innerHTML = "Address is required";
        valid = false;
    }

    if(valid == false){
        e.preventDefault();
    }

});


// Allow only letters
function onlyLetters(event){

    let key = event.key;

    if(!/^[A-Za-z ]$/.test(key)){
        event.preventDefault();
    }

}


function onlyNumbers(event)
{
    let phone = document.getElementById("phone");
    let key = event.key;

    // Allow Backspace, Delete, Tab and Arrow keys
    if (key == "Backspace" || key == "Delete" || key == "Tab" ||
        key == "ArrowLeft" || key == "ArrowRight") {
        return true;
    }

    // Allow only numbers
    if (!/^[0-9]$/.test(key)) {
        event.preventDefault();
        return false;
    }

    // First digit must be 6, 7, 8 or 9
    if (phone.value.length == 0 && !/^[6-9]$/.test(key)) {
        event.preventDefault();
        document.getElementById("phone_error").innerHTML =
        "Phone number must start with 6, 7, 8 or 9";
        return false;
    }

    // Don't allow more than 10 digits
    if (phone.value.length >= 10) {
        event.preventDefault();
        return false;
    }

    document.getElementById("phone_error").innerHTML = "";
}

</script>
</body>
</html>