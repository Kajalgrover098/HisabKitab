<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>HisabKitab Admin</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins',sans-serif;
}

body{
    background:#f5fdf8;
    overflow-x:hidden;
}

/*========================
      SIDEBAR
========================*/

.sidebar{
    position:fixed;
    top:0;
    left:0;
    width:260px;
    height:100vh;
    background:rgba(54,107,76,.68);
    color:#fff;
    padding:25px 18px;
    box-shadow:4px 0 15px rgba(0,0,0,.12);
    transition:.3s ease;
    z-index:999;
    display:flex;
    flex-direction:column;
}

/*========================
        LOGO
========================*/

.logo{
    text-align:center;
    margin-bottom:35px;
    padding-bottom:20px;
    border-bottom:1px solid rgba(255,255,255,.15);
}

.logo-circle{
    width:70px;
    height:70px;
    margin:auto;
    border-radius:50%;
    background:rgba(255,255,255,.18);
    display:flex;
    justify-content:center;
    align-items:center;
    font-size:30px;
    margin-bottom:15px;
}

.logo h3{
    font-size:24px;
    font-weight:700;
    margin-bottom:4px;
}

.logo p{
    font-size:14px;
    opacity:.9;
}

/*========================
        MENU
========================*/

.sidebar-menu{
    flex:1;
}

.sidebar-menu a{
    display:flex;
    align-items:center;
    gap:14px;
    text-decoration:none;
    color:#fff;
    padding:14px 16px;
    margin-bottom:10px;
    border-radius:12px;
    transition:.3s;
    font-size:15px;
    font-weight:500;
}

.sidebar-menu a i{
    width:22px;
    text-align:center;
    font-size:17px;
}

.sidebar-menu a:hover{
    background:rgba(255,255,255,.18);
    padding-left:22px;
}

.sidebar-menu a.active{
    background:#fff;
    color:#198754;
    font-weight:600;
}

/*========================
        LOGOUT
========================*/

.logout{
    margin-top:auto;
    padding-top:18px;
    border-top:1px solid rgba(255,255,255,.15);
}

.logout a{
    display:flex;
    align-items:center;
    gap:14px;
    text-decoration:none;
    color:#fff;
    padding:14px 16px;
    border-radius:12px;
    transition:.3s;
    font-weight:600;
}

.logout a:hover{
    background:rgba(255,255,255,.18);
}

/*========================
     MENU BUTTON
========================*/

.menu-toggle{
    display:none;
    position:fixed;
    top:15px;
    left:15px;
    width:45px;
    height:45px;
    border:none;
    border-radius:10px;
    background:rgba(54,107,76,.95);
    color:#fff;
    font-size:20px;
    cursor:pointer;
    z-index:1001;
}

/*========================
        OVERLAY
========================*/

.overlay{
    position:fixed;
    inset:0;
    background:rgba(0,0,0,.4);
    display:none;
    z-index:998;
}

.overlay.show{
    display:block;
}

/*========================
      RESPONSIVE
========================*/

@media(max-width:991px){

    .sidebar{
        left:-270px;
    }

    .sidebar.show{
        left:0;
    }

    .menu-toggle{
        display:block;
    }

}

@media(max-width:768px){

    .sidebar{
        width:245px;
        padding:20px 15px;
    }

    .logo-circle{
        width:60px;
        height:60px;
        font-size:26px;
    }

    .logo h3{
        font-size:22px;
    }

    .sidebar-menu a{
        font-size:14px;
        padding:13px;
    }

}

@media(max-width:480px){

    .sidebar{
        width:230px;
    }

    .logo h3{
        font-size:20px;
    }

    .logo p{
        font-size:12px;
    }

}

    </style>

</head>
<body>

    <!-- HTML -->

<!-- ================= MENU BUTTON ================= -->

<button class="menu-toggle" onclick="toggleSidebar()">
    <i class="fa-solid fa-bars"></i>
</button>

<!-- ================= OVERLAY ================= -->

<div class="overlay" id="overlay"></div>

<!-- ================= SIDEBAR ================= -->

<div class="sidebar" id="sidebar">

    <!-- Logo -->

    <div class="logo">

        <div class="logo-circle">
            <i class="fa-solid fa-user-shield"></i>
        </div>

        <h3>HisabKitab</h3>

        <p>Admin Panel</p>

    </div>

    <!-- Menu -->

    <div class="sidebar-menu">

        <a href="/admin/dashboard" class="active">
            <i class="fa-solid fa-house"></i>
            <span>Dashboard</span>
        </a>

        <a href="{{ route('admin.profile') }}">
            <i class="fa-solid fa-user"></i>
            <span>My Profile</span>
        </a>

        <a href="/admin/addnew">
            <i class="fa-solid fa-user-plus"></i>
            <span>Add Shopkeeper</span>
        </a>

        <a href="/admin/shopkeepers">
            <i class="fa-solid fa-store"></i>
            <span>View Shopkeepers</span>
        </a>

        <a href="#">
            <i class="fa-solid fa-chart-column"></i>
            <span>Queries</span>
        </a>

    </div>

    <!-- Logout -->

    <div class="logout">

        <a href="{{ route('admin.logout') }}">
            <i class="fa-solid fa-right-from-bracket"></i>
            <span>Logout</span>
        </a>

    </div>

</div>

    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Sidebar Toggle Script -->
    <script>

        function toggleSidebar() {

            document.getElementById("sidebar").classList.toggle("show");
            document.getElementById("overlay").classList.toggle("show");

        }

        document.addEventListener("click", function(e) {

            const sidebar = document.getElementById("sidebar");
            const toggle = document.querySelector(".menu-toggle");

            if (
                window.innerWidth <= 991 &&
                !sidebar.contains(e.target) &&
                !toggle.contains(e.target)
            ) {
                sidebar.classList.remove("show");
                document.getElementById("overlay").classList.remove("show");
            }

        });

        window.addEventListener("resize", function() {

            if (window.innerWidth > 991) {

                document.getElementById("sidebar").classList.remove("show");
                document.getElementById("overlay").classList.remove("show");

            }

        });

    </script>

</body>
</html>