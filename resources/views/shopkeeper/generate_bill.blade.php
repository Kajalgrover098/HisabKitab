@include('shopkeeper.sidebar')

<div class="content">

    <div class="card p-4">

        <h3 class="text-success mb-4">
            Generate Bill
        </h3>

        <table class="table table-bordered">

            <tr>
                <th width="200">Customer Name</th>
                <td>{{ $customer->customer_name }}</td>
            </tr>

            <tr>
                <th>Phone</th>
                <td>{{ $customer->phone }}</td>
            </tr>

            <tr>
                <th>Email</th>
                <td>{{ $customer->email }}</td>
            </tr>

            <tr>
                <th>Gender</th>
                <td>{{ $customer->gender }}</td>
            </tr>

        </table>

    </div>

</div>