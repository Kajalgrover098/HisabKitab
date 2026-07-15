@include('admin.sidebar')

<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Contact Queries</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    background:#f4f6f9;
    font-family:'Segoe UI',Tahoma,Geneva,Verdana,sans-serif;
}

.content{
    margin-left:280px;
    padding:35px;
}

/* Header */

.page-title{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:25px;
    flex-wrap:wrap;
    gap:10px;
}

.page-title h2{
    margin:0;
    font-size:30px;
    font-weight:700;
    color:#198754;
}

.page-title p{
    margin:5px 0 0;
    color:#6c757d;
    font-size:15px;
}

/* Card */

.card{
    border:none;
    border-radius:15px;
    overflow:hidden;
    box-shadow:0 8px 25px rgba(0,0,0,.08);
}

/* Table */

.table{
    margin-bottom:0;
}

.table thead th{
    background:#198754;
    color:#fff;
    font-weight:600;
    text-align:center;
    padding:15px;
    border:none;
    white-space:nowrap;
}

.table tbody td{
    text-align:center;
    vertical-align:middle;
    padding:15px;
    color:#495057;
}

.table tbody tr{
    transition:.3s;
}

.table tbody tr:hover{
    background:#f8f9fa;
}

/* Message */

.message{
    max-width:280px;
    white-space:normal;
    word-break:break-word;
    text-align:left;
}

/* Empty Record */

.table tbody tr td[colspan]{
    padding:35px;
    font-size:17px;
    color:#6c757d;
    font-weight:500;
}

/* Pagination */

.pagination{
    justify-content:center;
}

.page-link{
    color:#198754;
}

.page-item.active .page-link{
    background:#198754;
    border-color:#198754;
}

/* Responsive */

@media(max-width:991px){

    .content{
        margin-left:0;
        padding:20px;
        padding-top:75px;
    }

    .page-title{
        flex-direction:column;
        align-items:flex-start;
    }

}

@media(max-width:768px){

    .page-title h2{
        font-size:24px;
    }

    .page-title p{
        font-size:14px;
    }

    .table{
        min-width:850px;
    }

    .table th,
    .table td{
        padding:12px;
        font-size:14px;
    }

}

@media(max-width:576px){

    .content{
        padding:12px;
        padding-top:70px;
    }

    .page-title h2{
        font-size:21px;
    }

    .page-title p{
        font-size:13px;
    }

    .card{
        border-radius:10px;
    }

}

</style>

</head>

<body>

<div class="content">

<div class="page-title">

<h2>Contact Queries</h2>

<p>All contact form submissions.</p>

</div>

<div class="card">

<div class="table-responsive">

<table class="table table-bordered table-hover mb-0">

<thead>

<tr>

<th>#</th>
<th>Name</th>
<th>Email</th>
<th>Subject</th>
<th>Message</th>
<th>Date</th>

</tr>

</thead>

<tbody>

@forelse($contacts as $contact)

<tr>

<td>{{ $loop->iteration }}</td>

<td>{{ $contact->name }}</td>

<td>{{ $contact->email }}</td>

<td>{{ $contact->subject }}</td>

<td class="message">
    {{ $contact->message }}
</td>

<td>
    {{ \Carbon\Carbon::parse($contact->created_at)->format('d M Y') }}
</td>

</tr>

@empty

<tr>

<td colspan="6">

No Contact Queries Found

</td>

</tr>

@endforelse

</tbody>

</table>

</div>

</div>

<div class="mt-3">

{{ $contacts->links() }}

</div>

</div>

</body>

</html>