@include('admin.sidebar')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopkeepers</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <style>

body{
    background:#f4f6f9;
    font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.content{

    margin-left:280px;
    padding:30px;

}

.page-header{

    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:25px;

}

.page-header h2{

    font-size:30px;
    font-weight:700;
    color:#212529;
    margin-bottom:3px;

}

.page-header p{

    color:#6c757d;
    font-size:15px;
    margin-bottom:0;

}

/* Card */

.card{

    border:none;
    border-radius:12px;
    box-shadow:0 5px 15px rgba(0,0,0,0.08);

}

/* Search */

#search{

    height:45px;
    border-radius:8px;
    border:1px solid #ced4da;
    padding-right:45px;
    transition:0.3s;

}

#search:focus{

    border-color:#198754;
    box-shadow:0 0 8px rgba(25,135,84,.25);

}

/* Table */

.table{

    margin-bottom:0;

}

.table th{

    background:#f8f9fa;
    color:#495057;
    font-weight:600;
    text-align:center;
    border-bottom:2px solid #dee2e6;
    padding:14px;

}

.table td{

    text-align:center;
    vertical-align:middle;
    padding:14px;

}

.table tbody tr{

    transition:.3s;

}

.table tbody tr:hover{

    background:#f8f9fa;

}

/* Add Button */

.btn-success{

    border-radius:8px;
    padding:10px 18px;
    font-weight:600;

}

/* Action Icons */

.action-icon{

    text-decoration:none;
    margin:0 8px;
    font-size:20px;
    transition:.3s;

}

.action-icon:hover{

    transform:scale(1.2);

}

.view{

    color:#0d6efd;

}

.edit{

    color:#198754;

}

.delete{

    color:#dc3545;

}

/* Empty Record */

.no-data{

    color:#6c757d;
    font-size:17px;
    font-weight:500;
    padding:25px;

}

</style>
</head>
<body>

<div class="content">

    <div class="page-header">

        <div>

            <h2>Shopkeepers</h2>

            <p class="text-muted">
                Manage all registered shopkeepers
            </p>

        </div>

        <a href="{{ route('admin.addnew') }}" class="btn btn-success">

            <i class="bi bi-plus-circle"></i>
            Add Shopkeeper

        </a>

    </div>
    <div class="card shadow">

    <div class="card-body">

        <div class="d-flex justify-content-between align-items-center mb-3">

      

    <div class="row mb-2">

    <div class="col-md-12">

        <div style="position:relative;">

            <input type="text"
                   id="search"
                   class="form-control"
                   placeholder="Search Shopkeeper...">

            <i class="bi bi-search"
               style="position:absolute;
                      right:15px;
                      top:50%;
                      transform:translateY(-50%);
                      color:#6c757d;">
            </i>

        </div>

    </div>

</div>

</div>
    

</div>

        

        <div class="table-responsive">

            <table class="table table-bordered table-hover align-middle" id="shopkeeperTable">

                <thead>

                    <tr>

                        <th>Sr. No.</th>
                        <th>Shop Name</th>
                        <th>Owner Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Action</th>

                    </tr>

                </thead>

              <tbody>

@forelse($shopkeepers as $shopkeeper)

<tr>

    <td>{{ $loop->iteration }}</td>

    <td>{{ $shopkeeper->shop_name }}</td>

    <td>{{ $shopkeeper->owner_name }}</td>

    <td>{{ $shopkeeper->phone }}</td>

    <td>{{ $shopkeeper->email }}</td>

   <td>

    @if($shopkeeper->status == 'active')
        <span class="badge bg-success">Active</span>

    @elseif($shopkeeper->status == 'inactive')
        <span class="badge bg-danger">Inactive</span>

    @else
        <span class="badge bg-secondary">
            {{ ucfirst($shopkeeper->status) }}
        </span>
    @endif

</td>
    <td>

       

    <a href="#" 
   class="action-icon view"
   data-bs-toggle="modal"
   data-bs-target="#viewShopkeeperModal"
   onclick="openViewModal(
    {{ json_encode($shopkeeper->shop_name) }},
    {{ json_encode($shopkeeper->owner_name) }},
    {{ json_encode($shopkeeper->phone) }},
    {{ json_encode($shopkeeper->email) }},
    {{ json_encode($shopkeeper->address) }},
    {{ json_encode($shopkeeper->status ?? 'active') }},
    {{ json_encode($shopkeeper->id) }}
)">


    <i class="bi bi-eye-fill"></i>

</a>
    <a href="{{ route('shopkeepers.edit', $shopkeeper->id) }}" class="action-icon edit" title="Edit">

        <i class="bi bi-pencil-square"></i>

    </a>

    <a href="javascript:void(0);" 
   class="action-icon delete"
   onclick="confirmDelete('{{ $shopkeeper->id }}')">

    <i class="bi bi-trash-fill"></i>

</a>


    </td>

</tr>

@empty

<tr>

    <td colspan="7" class="text-center text-danger">

        No Shopkeepers Found

    </td>

</tr>

@endforelse

</tbody>

            </table>

        </div>

    </div>
    <div class="modal fade" id="viewShopkeeperModal" tabindex="-1" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-lg">

        <div class="modal-content" style="border-radius:12px; overflow:hidden;">

            <!-- Header -->
            <div class="modal-header" style="background:#198754; color:#fff;">
                <h5 class="modal-title">Shopkeeper Details</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <!-- Body -->
            <div class="modal-body p-4">

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <strong>Shop Name:</strong>
                        <div id="v_shop"></div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <strong>Owner Name:</strong>
                        <div id="v_owner"></div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <strong>Phone:</strong>
                        <div id="v_phone"></div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <strong>Email:</strong>
                        <div id="v_email"></div>
                    </div>

                    <div class="col-12 mb-3">
                        <strong>Address:</strong>
                        <div id="v_address"></div>
                    </div>

                    <!-- STATUS -->
                    <div class="col-md-6 mb-3">
                        <strong>Status:</strong>
                        <span id="v_status_badge" class="badge bg-success">Active</span>
                    </div>

                    <!-- Toggle -->
                    

                </div>

            </div>

        </div>

    </div>

</div>


</div>


<script>

document.getElementById("search").addEventListener("keyup", function(){

    let search = this.value.toLowerCase();

    let rows = document.querySelectorAll("#shopkeeperTable tbody tr");

    rows.forEach(function(row){

        let text = row.innerText.toLowerCase();

        if(text.includes(search))
        {
            row.style.display = "";
        }
        else
        {
            row.style.display = "none";
        }

    });

});

</script>
<script>

let currentShopkeeperId = null;

function openViewModal(shop, owner, phone, email, address, status, id)
{
    currentShopkeeperId = id;

    document.getElementById("v_shop").innerText = shop;
    document.getElementById("v_owner").innerText = owner;
    document.getElementById("v_phone").innerText = phone;
    document.getElementById("v_email").innerText = email;
    document.getElementById("v_address").innerText = address;

    // status badge
    let badge = document.getElementById("v_status_badge");
    let toggle = document.getElementById("statusToggle");

    if(status == "active"){
        badge.innerText = "Active";
        badge.className = "badge bg-success";
        toggle.checked = true;
    } else {
        badge.innerText = "Inactive";
        badge.className = "badge bg-danger";
        toggle.checked = false;
    }
}


</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

function confirmDelete(id)
{
    Swal.fire({
        title: "Are you sure?",
        text: "This shopkeeper will be permanently deleted!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#dc3545",
        cancelButtonColor: "#6c757d",
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {
        if (result.isConfirmed) {

            window.location.href = "/admin/delete/" + id;

        }
    });
}

</script>

</body>
</html>