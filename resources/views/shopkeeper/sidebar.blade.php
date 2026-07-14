<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>HisabKitab Dashboard</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins',sans-serif;
}

body{
    background:#f5fdf8;
}

/* Sidebar */

.sidebar{

    width:270px;
    height:100vh;
    position:fixed;
    left:0;
    top:0;
    background:rgba(54, 107, 76, 0.68);
    color:#fff;
    overflow-y:auto;
    box-shadow:8px 0 25px rgba(0,0,0,.08);

}

/* Logo */

.logo{

    text-align:center;
    padding:30px 20px;
    border-bottom:1px solid rgba(255,255,255,.15);

}

.logo i{

    font-size:42px;
    margin-bottom:10px;

}

.logo h3{

    font-weight:700;
    margin:0;

}

.logo small{

    color:#d7f5e4;

}

/* Profile */

.profile{

    text-align:center;
    padding:25px 20px;
    border-bottom:1px solid rgba(255,255,255,.12);

}

.profile img{

    width:75px;
    height:75px;
    border-radius:50%;
    border:3px solid #fff;
    object-fit:cover;

}

.profile h6{

    margin-top:15px;
    margin-bottom:4px;
    font-weight:600;

}

.profile small{

    color:#d7f5e4;

}

/* Menu */

.sidebar-menu{

    padding:20px 15px;

}

.sidebar-menu a{

    display:flex;
    align-items:center;
    text-decoration:none;
    color:#fff;
    padding:14px 18px;
    margin-bottom:10px;
    border-radius:12px;
    transition:.3s;

}

.sidebar-menu a i{

    width:28px;
    font-size:18px;

}

.sidebar-menu a:hover{

    background:#fff;
    color:#198754;
    transform:translateX(5px);

}

.sidebar-menu .active{

    background:#fff;
    color:#198754;
    font-weight:600;

}

/* Logout */

.logout{

    background:#dc3545 !important;
    color:#fff !important;

}

.logout:hover{

    background:#bb2d3b !important;
    color:#fff !important;
    transform:none !important;

}

/* Footer */

.sidebar-footer{

    position:absolute;
    bottom:20px;
    width:100%;
    text-align:center;
    font-size:13px;
    color:#d7f5e4;

}

/* Main */

.main-content{

    margin-left:270px;
    padding:35px;

}

::-webkit-scrollbar{

    width:5px;

}

::-webkit-scrollbar-thumb{

    background:#198754;

}
/* ===========================
   RESPONSIVE SIDEBAR
=========================== */

/* ===========================
   RESPONSIVE SIDEBAR
=========================== */

.mobile-header{
    display:none;
}

@media (max-width:992px){

.sidebar{

    left:-270px;
    transition:.35s;
    z-index:1055;

}

.sidebar.show{

    left:0;

}

.main-content,
.content{

    margin-left:0 !important;
    padding:20px;

}

.mobile-header{

    display:flex;
    align-items:center;
    justify-content:space-between;
    background:#fff;
    padding:15px 20px;
    box-shadow:0 2px 10px rgba(0,0,0,.08);
    position:sticky;
    top:0;
    z-index:1040;

}

.mobile-header h4{

    margin:0;
    font-weight:700;
    color:#198754;

}

.menu-btn{

    border:none;
    background:#198754;
    color:#fff;
    width:45px;
    height:45px;
    border-radius:10px;
    font-size:20px;

}

.sidebar-overlay{

    position:fixed;
    inset:0;
    background:rgba(0,0,0,.4);
    display:none;
    z-index:1050;

}

.sidebar-overlay.show{

    display:block;

}

.sidebar-footer{

    position:relative;
    bottom:0;
    margin-top:20px;

}

}

@media (min-width:993px){

.sidebar{

    left:0 !important;

}

.sidebar-overlay{

    display:none !important;

}

}

</style>

</head>

<body>
   <div class="mobile-header">

    <button class="menu-btn" id="openSidebar">
        <i class="fa-solid fa-bars"></i>
    </button>

    <h4>HisabKitab</h4>

</div>

<div class="sidebar-overlay" id="overlay"></div>


@if(session('success'))
<script>
Swal.fire({
    icon: 'success',
    title: 'Success',
    text: '{{ session('success') }}',
    timer: 2000,
    showConfirmButton: false
});
</script>
@endif
<div class="sidebar">

    <div class="logo" >

        

       
    <h3><span style="color:rgb(17, 74, 36);">Hisab</span>Kitab</h3>
    </div>

    <div class="profile">

        <img src="https://ui-avatars.com/api/?name={{ session('shop_name') }}&background=ffffff&color=198754&bold=true">

        <h6>{{ session('shop_name') }}</h6>

        <small>Shopkeeper</small>

    </div>

   <div class="sidebar-menu">

    <a href="/shopkeeper/dashboard" class="active">
        <i class="fa-solid fa-house"></i>
        Dashboard
    </a>
   <a href="/shopkeeper/profile">
        <i class="fa-solid fa-store"></i>
        Shop Profile
    </a>
    <a href="{{ route('customers.index') }}">
    <i class="bi bi-people"></i>
    Customers
</a>

    <a href="{{ route('shopkeeper.products') }}">
        <i class="fas fa-box"></i>
        <span>Products</span>
    </a>
    <a href="{{ route('shopkeeper.calculator') }}">
    <i class="bi bi-calculator"></i>
    Calculator
</a>

 <a href="/shopkeeper/billing">
        <i class="fa-solid fa-file-invoice-dollar"></i>
        Billing
    </a>
    <a href="/shopkeeper/reminders">
        <i class="fa-regular fa-alarm-clock"></i>
        Reminders
    </a>

    

    <!-- <a href="#">
        <i class="fa-solid fa-truck"></i>
        Purchases
    </a>

    <a href="#">
        <i class="fa-solid fa-money-bill-wave"></i>
        Expenses
    </a> -->

   

<a href="/shopkeeper/previous-records">

<i class="fa-solid fa-book"></i>

Previous Records

</a>


    

    <a href="#" onclick="logoutConfirm(event)">
        <i class="fa-solid fa-right-from-bracket"></i>
        Logout
    </a>

</div>
<script>
function logoutConfirm(e)
{
    e.preventDefault();

    Swal.fire({
        title: 'Logout?',
        text: 'Are you sure you want to logout?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#198754',
        cancelButtonColor: '#dc3545',
        confirmButtonText: 'Yes, Logout'
    }).then((result) => {

        if(result.isConfirmed){
            window.location.href = "{{ route('shop.logout') }}";
        }

    });
}
</script>
    </div>

    <div class="sidebar-footer">

        © 2026 HisabKitab

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
<script>

const menuToggle = document.getElementById('menuToggle');


const sidebar = document.querySelector(".sidebar");
const overlay = document.getElementById("overlay");
const openBtn = document.getElementById("openSidebar");

if(openBtn){

openBtn.addEventListener("click",()=>{

    sidebar.classList.add("show");
    overlay.classList.add("show");

});

}

overlay.addEventListener("click",()=>{

    sidebar.classList.remove("show");
    overlay.classList.remove("show");

});

document.querySelectorAll('.sidebar-menu a').forEach(link=>{

    link.addEventListener('click',function(){

        if(window.innerWidth<992){

            sidebar.classList.remove('show');
            overlay.classList.remove('show');

        }

    });

});

</script>

</body>

</html>