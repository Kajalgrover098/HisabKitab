@include('admin.sidebar')
<style>
    .main-content{
    margin-left:260px;
    padding:30px;
    background:#f5fdf8;
    min-height:100vh;
    transition:.3s;
}

.welcome-card{
    background:rgba(54,107,76,.68);
    color:#fff;
    padding:35px;
    border-radius:20px;
    box-shadow:0 15px 35px rgba(25,135,84,.20);
}

.welcome-card h2{
    font-size:32px;
    font-weight:700;
}

.welcome-card p{
    font-size:16px;
    line-height:1.8;
}

.date-box{

    background:rgba(255,255,255,.18);
    padding:18px;
    border-radius:15px;
    display:inline-block;
    min-width:180px;
    text-align:center;

}

.date-box h5{

    margin-bottom:8px;
    font-weight:700;

}

.date-box span{

    font-size:15px;

}
.stats-card{
    background:#fff;
    border-radius:18px;
    padding:25px;
    display:flex;
    align-items:center;
    gap:20px;
    box-shadow:0 10px 25px rgba(0,0,0,.06);
    transition:.3s;
    border:1px solid #eef2f7;
    height:100%;
}



.stats-info h3{
    font-size:30px;
}

.stats-card:hover{

    transform:translateY(-8px);
    box-shadow:0 18px 40px rgba(25,135,84,.18);

}

.stats-icon{

    width:70px;
    height:70px;
    border-radius:18px;
    background:#198754;
    color:#fff;
    display:flex;
    justify-content:center;
    align-items:center;
    font-size:28px;
    flex-shrink:0;

}

.stats-info h3{

    margin:0;
    font-size:32px;
    font-weight:700;
    color:#198754;

}

.stats-info h5{

    margin:6px 0;
    font-weight:600;
    color:#212529;

}

.stats-info p{

    margin:0;
    color:#6c757d;
    font-size:14px;

}
.section-title{

    font-size:24px;
    font-weight:700;
    color:#212529;

}

.action-card{

    background:#fff;
    border-radius:18px;
    padding:30px;
    text-align:center;
    box-shadow:0 10px 25px rgba(0,0,0,.06);
    transition:.35s;
    border:1px solid #eef2f7;
    height:100%;

}

.action-card:hover{

    transform:translateY(-8px);
    box-shadow:0 18px 40px rgba(25,135,84,.18);

}

.action-icon{

    width:70px;
    height:70px;
    margin:auto;
    border-radius:50%;
    background:#198754;
    color:#fff;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:28px;
    margin-bottom:20px;

}

.action-card h5{

    font-weight:700;
    margin-bottom:10px;

}

.action-card p{

    color:#6c757d;
    line-height:1.7;
    min-height:55px;

}

.action-btn{

    display:inline-block;
    text-decoration:none;
    color:#198754;
    font-weight:700;
    transition:.3s;

}

.action-btn:hover{

    color:#157347;

}
/*==============================
        LARGE TABLET
==============================*/

@media(max-width:991px){

    .main-content{
        margin-left:0;
        padding:80px 20px 20px;
    }

    .welcome-card{
        padding:25px;
    }

    .welcome-card h2{
        font-size:28px;
    }

    .date-box{
        margin-top:20px;
    }

}

/*==============================
          TABLET
==============================*/

@media(max-width:768px){

    .main-content{
        padding:75px 15px 20px;
    }

    .welcome-card{
        text-align:center;
        padding:22px;
    }

    .welcome-card h2{
        font-size:24px;
    }

    .welcome-card p{
        font-size:15px;
    }

    .date-box{
        width:100%;
        margin-top:20px;
    }

    .section-title{
        font-size:22px;
        text-align:center;
    }

    .stats-card{
        padding:20px;
    }

    .stats-icon{
        width:60px;
        height:60px;
        font-size:24px;
    }

    .stats-info h3{
        font-size:26px;
    }

    .stats-info h5{
        font-size:18px;
    }

    .action-card{
        padding:25px;
    }

}

/*==============================
        MOBILE
==============================*/

@media(max-width:576px){

    .main-content{
        padding:70px 12px 15px;
    }

    .welcome-card{
        padding:18px;
    }

    .welcome-card h2{
        font-size:21px;
        line-height:1.4;
    }

    .welcome-card p{
        font-size:14px;
        line-height:1.6;
    }

    .date-box{
        width:100%;
        padding:15px;
    }

    .date-box h5{
        font-size:18px;
    }

    .date-box span{
        font-size:14px;
    }

    .stats-card{
        flex-direction:column;
        text-align:center;
        gap:15px;
        padding:22px;
    }

    .stats-icon{
        width:55px;
        height:55px;
        font-size:22px;
    }

    .stats-info h3{
        font-size:24px;
    }

    .stats-info h5{
        font-size:17px;
    }

    .action-card{
        padding:22px;
    }

    .action-icon{
        width:60px;
        height:60px;
        font-size:22px;
    }

    .action-card h5{
        font-size:18px;
    }

    .action-card p{
        min-height:auto;
        font-size:14px;
    }

}
</style>
<div class="main-content">
    <div class="welcome-card mb-5">

    <div class="row align-items-center">

        <div class="col-lg-8">

            <h2>
                Welcome Back, {{ session('admin_name') }} 👋
            </h2>

            <p>
                Manage your shopkeepers, monitor activities and control your
                <strong>HisabKitab Administration Panel</strong> from one place.
            </p>

        </div>

        <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">

            <div class="date-box">

                <h5>{{ now()->format('l') }}</h5>

                <span>{{ now()->format('d F Y') }}</span>

            </div>

        </div>

    </div>

</div>
<div class="row g-4 mb-5">

    <div class="col-md-6 col-xl-3">

        <div class="stats-card">

            <div class="stats-icon">
                <i class="fa-solid fa-store"></i>
            </div>

            <div class="stats-info">

                <h3>0</h3>

                <h5>Total Shopkeepers</h5>

                <p>Registered Shops</p>

            </div>

        </div>

    </div>

    <div class="col-md-6 col-xl-3">

        <div class="stats-card">

            <div class="stats-icon">
                <i class="fa-solid fa-circle-check"></i>
            </div>

            <div class="stats-info">

                <h3>0</h3>

                <h5>Active Shops</h5>

                <p>Currently Active</p>

            </div>

        </div>

    </div>

    <div class="col-md-6 col-xl-3">

        <div class="stats-card">

            <div class="stats-icon">
                <i class="fa-solid fa-ban"></i>
            </div>

            <div class="stats-info">

                <h3>0</h3>

                <h5>Inactive Shops</h5>

                <p>Currently Inactive</p>

            </div>

        </div>

    </div>

    <div class="col-md-6 col-xl-3">

        <div class="stats-card">

            <div class="stats-icon">
                <i class="fa-solid fa-chart-line"></i>
            </div>

            <div class="stats-info">

                <h3>0</h3>

                <h5>Reports</h5>

                <p>Generated Reports</p>

            </div>

        </div>

    </div>

</div>
<div class="mb-4">

    <h4 class="section-title">
        Quick Actions
    </h4>

</div>

<div class="row g-4 mb-5">

    <div class="col-md-4">

        <div class="action-card">

            <div class="action-icon">
                <i class="fa-solid fa-user-plus"></i>
            </div>

            <h5>Add Shopkeeper</h5>

            <p>
                Register a new shopkeeper into the system.
            </p>

            <a href="#" class="action-btn">
                Open
                <i class="fa-solid fa-arrow-right ms-2"></i>
            </a>

        </div>

    </div>

    <div class="col-md-4">

        <div class="action-card">

            <div class="action-icon">
                <i class="fa-solid fa-store"></i>
            </div>

            <h5>View Shopkeepers</h5>

            <p>
                Manage all registered shopkeepers.
            </p>

            <a href="#" class="action-btn">
                Open
                <i class="fa-solid fa-arrow-right ms-2"></i>
            </a>

        </div>

    </div>

    <div class="col-md-4">

        <div class="action-card">

            <div class="action-icon">
                <i class="fa-solid fa-user-gear"></i>
            </div>

            <h5>My Profile</h5>

            <p>
                Update your profile information.
            </p>

            <a href="#" class="action-btn">
                Open
                <i class="fa-solid fa-arrow-right ms-2"></i>
            </a>

        </div>

    </div>

</div>
</div>