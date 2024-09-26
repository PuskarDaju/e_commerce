@extends('admin.adminLayout')
@section('mainContents')
@section('cssSection')
#salesChart {
    height: 400px;  /* Set a specific height */
    width: 100%;    /* Keep the full width */
    border: 2px solid #3498db; /* Add a blue border */
    border-radius: 10px;  /* Rounded corners */
    background-color: #f4f6f9; /* Light gray background */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Soft shadow */
}

@endsection
<div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <!-- Header -->
                    <div class="d-flex justify-content-between align-items-center p-3">
                        <h3>Dashboard</h3>
                        <div class="d-flex align-items-center">
                            <span>Steave Jobs</span>
                            <img src="" alt="Avatar" class="rounded-circle ml-2" style="width: 40px;">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- Sales Summary -->
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Sales Summary</div>
                        <div class="card-body">
                            
                            <div class="salesGraph">
                                Here comes graph
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Feeds -->
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">Feeds</div>
                        <div class="card-body">
                            <ul class="list-unstyled">
                                <li><i class="fas fa-tasks"></i> You have 4 pending tasks</li>
                                <li><i class="fas fa-server"></i> Server #1 overloaded</li>
                                <li><i class="fas fa-box"></i> New order received</li>
                                <li><i class="fas fa-user"></i> New user registered</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Top Selling Products -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">Top Selling Products</div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>License</th>
                                        <th>Support Agent</th>
                                        <th>Technology</th>
                                        <th>Tickets</th>
                                        <th>Sales</th>
                                        <th>Earnings</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Elite Admin</td>
                                        <td>Single Use</td>
                                        <td>John Doe</td>
                                        <td><span class="badge badge-danger">Angular</span></td>
                                        <td>46</td>
                                        <td>356</td>
                                        <td>$2850.06</td>
                                    </tr>
                                    <tr>
                                        <td>Monster Admin</td>
                                        <td>Single Use</td>
                                        <td>Venessa Fern</td>
                                        <td><span class="badge badge-primary">VueJS</span></td>
                                        <td>46</td>
                                        <td>356</td>
                                        <td>$2850.06</td>
                                    </tr>
                                    <!-- Repeat rows as needed -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection