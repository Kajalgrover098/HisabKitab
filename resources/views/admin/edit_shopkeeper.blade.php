@include('admin.sidebar')

<style>
body{
    background:#f4f6f9;
    font-family:Segoe UI, sans-serif;
}

.content{
    margin-left:280px;
    padding:35px;
}

.edit-card{
    border:none;
    border-radius:15px;
    box-shadow:0 10px 30px rgba(0,0,0,.08);
}

.card-header-custom{
    background:#198754;
    color:#fff;
    padding:18px 25px;
    border-radius:15px 15px 0 0;
}

.card-header-custom h3{
    margin:0;
    font-size:24px;
    font-weight:600;
}

.form-label{
    font-weight:600;
    margin-bottom:6px;
}

.required{
    color:red;
}

.form-control,
.form-select{
    border-radius:10px;
    height:48px;
}

textarea.form-control{
    height:auto;
}

.form-control:focus,
.form-select:focus{
    border-color:#198754;
    box-shadow:0 0 0 .15rem rgba(25,135,84,.25);
}

.char-count{
    text-align:right;
    font-size:13px;
    color:#6c757d;
}

.btn{
    border-radius:10px;
    padding:10px 22px;
}

.error-text{
    color:red;
    font-size:14px;
}
</style>

<div class="content">

<div class="card edit-card">

<div class="card-header-custom">
    <h3>
        <i class="fas fa-user-edit me-2"></i>
        Edit Shopkeeper
    </h3>
</div>

<div class="card-body p-4">

<form method="POST" action="{{ route('shopkeepers.update',$shopkeeper->id) }}">

@csrf

<div class="row">

<!-- Shop Name -->
<div class="col-md-6 mb-3">

<label class="form-label">
Shop Name <span class="required">*</span>
</label>

<input
type="text"
name="shop_name"
id="shop_name"
class="form-control @error('shop_name') is-invalid @enderror"
value="{{ old('shop_name',$shopkeeper->shop_name) }}"
maxlength="50">

@error('shop_name')
<div class="error-text">{{ $message }}</div>
@enderror

</div>


<!-- Owner Name -->
<div class="col-md-6 mb-3">

<label class="form-label">
Owner Name <span class="required">*</span>
</label>

<input
type="text"
name="owner_name"
id="owner_name"
class="form-control @error('owner_name') is-invalid @enderror"
value="{{ old('owner_name',$shopkeeper->owner_name) }}"
maxlength="50">

@error('owner_name')
<div class="error-text">{{ $message }}</div>
@enderror

</div>


<!-- Phone -->
<div class="col-md-6 mb-3">

<label class="form-label">
Phone <span class="required">*</span>
</label>

<input
type="text"
name="phone"
id="phone"
class="form-control @error('phone') is-invalid @enderror"
value="{{ old('phone',$shopkeeper->phone) }}"
maxlength="10">

@error('phone')
<div class="error-text">{{ $message }}</div>
@enderror

</div>


<!-- Email -->
<div class="col-md-6 mb-3">

<label class="form-label">
Email <span class="required">*</span>
</label>

<input
type="email"
name="email"
class="form-control @error('email') is-invalid @enderror"
value="{{ old('email',$shopkeeper->email) }}">

@error('email')
<div class="error-text">{{ $message }}</div>
@enderror

</div>


<!-- Address -->
<div class="col-12 mb-3">

<label class="form-label">
Address
</label>

<textarea
name="address"
id="address"
rows="4"
maxlength="100"
class="form-control @error('address') is-invalid @enderror">{{ old('address',$shopkeeper->address) }}</textarea>

<div class="char-count">
<span id="addressCount">0</span>/100
</div>

@error('address')
<div class="error-text">{{ $message }}</div>
@enderror

</div>


<!-- Status -->
<div class="col-md-6 mb-4">

<label class="form-label">
Status
</label>

<select
name="status"
class="form-select">

<option value="active"
{{ old('status',$shopkeeper->status)=='active' ? 'selected':'' }}>
Active
</option>

<option value="inactive"
{{ old('status',$shopkeeper->status)=='inactive' ? 'selected':'' }}>
Inactive
</option>

</select>

</div>

</div>

<hr>

<div class="d-flex justify-content-end">

<a href="{{ url('/admin/shopkeepers') }}"
class="btn btn-secondary me-2">

<i class="fas fa-arrow-left"></i>
Cancel

</a>

<button
class="btn btn-success">

<i class="fas fa-save"></i>
Update Shopkeeper

</button>

</div>

</form>

</div>

</div>

</div>

<script>

const shopName=document.getElementById("shop_name");
const ownerName=document.getElementById("owner_name");
const phone=document.getElementById("phone");
const address=document.getElementById("address");
const addressCount=document.getElementById("addressCount");


// Shop Name & Owner Name

function onlyLetters(input){

input.addEventListener("input",function(){

this.value=this.value.replace(/[^a-zA-Z\s]/g,'');

});

}

onlyLetters(shopName);
onlyLetters(ownerName);


// Phone

phone.addEventListener("input",function(){

this.value=this.value.replace(/\D/g,'');

if(this.value.length>10){

this.value=this.value.slice(0,10);

}

if(this.value.length==1){

if(!/[6-9]/.test(this.value)){

this.value='';

}

}

});


// Address Counter

function updateCounter(){

addressCount.innerHTML=address.value.length;

}

updateCounter();

address.addEventListener("input",updateCounter);

</script>