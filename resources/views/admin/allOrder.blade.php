@extends('admin.adminLayout')
@section('cssSection')
<link rel="stylesheet" href="{{asset('build/assets/css/AdminOrders.css')}}">
@endsection

@section('mainContents')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - User Orders</title>
    <style>
        /* Global Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            display: flex;
            min-height: 100vh;
            background-color: #f4f6f9;
        }

        /* Sidebar Styles */
      

        /* Main Content */
        .main-content {
            margin-left: 250px;
            padding: 40px;
            width: 100%;
        }

        .main-content h1 {
            margin-bottom: 20px;
            color: #34495e;
        }

        .search-bar {
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .search-bar input[type="text"] {
            padding: 10px;
            width: 300px;
            border: 1px solid #bdc3c7;
            border-radius: 5px;
        }

        .search-bar button {
            padding: 10px 15px;
            background-color: #1abc9c;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .search-bar button:hover {
            background-color: #16a085;
        }

        .order-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: white;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }

        .order-table thead {
            background-color: #2980b9;
            color: white;
        }

        .order-table thead th {
            padding: 15px;
            font-size: 16px;
            text-align: left;
        }

        .order-table tbody tr {
            transition: background-color 0.3s;
        }

        .order-table tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .order-table tbody tr:hover {
            background-color: #ecf0f1;
        }

        .order-table tbody td {
            padding: 15px;
            font-size: 14px;
            color: #34495e;
        }

        /* Order Status Badge */
        .badge {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            color: white;
        }

        .badge.delivered {
            background-color: #2ecc71;
        }

        .badge.pending {
            background-color: #f1c40f;
        }

        .badge.processing {
            background-color: #e67e22;
        }

        .badge.cancelled {
            background-color: #e74c3c;
        }

    </style>
</head>
<body>

    <!-- Sidebar -->
   

    <!-- Main Content -->
    <div class="main-content">
        <h1>All User Orders</h1>

        <!-- Search Bar and Filters -->
        <div class="search-bar">
            <input type="text" id="searchOrder" placeholder="Search by Order ID or User Name">
            <button onclick="filterOrders()">Filter</button>
        </div>

        <!-- Order Table -->
        <table class="order-table">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>User Name</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody id="orderTableBody">
                <!-- Order Rows (Dynamically populated) -->
            </tbody>
        </table>
    </div>

    <!-- JavaScript -->
    <script>
        // Sample order data
        const orders = [
            { id: '12345', user: 'John Doe', date: '2024-10-18', status: 'Delivered', total: '$80' },
            { id: '12346', user: 'Jane Smith', date: '2024-10-16', status: 'Processing', total: '$120' },
            { id: '12347', user: 'Alice Johnson', date: '2024-10-15', status: 'Pending', total: '$150' },
            { id: '12348', user: 'Bob Lee', date: '2024-10-14', status: 'Cancelled', total: '$60' },
            { id: '12349', user: 'Chris King', date: '2024-10-12', status: 'Delivered', total: '$90' }
        ];

        // Function to display orders in table
        function displayOrders(orders) {
            const tableBody = document.getElementById('orderTableBody');
            tableBody.innerHTML = '';  // Clear previous content

            orders.forEach(order => {
                const row = document.createElement('tr');

                row.innerHTML = `
                    <td>${order.id}</td>
                    <td>${order.user}</td>
                    <td>${order.date}</td>
                    <td><span class="badge ${order.status.toLowerCase()}">${order.status}</span></td>
                    <td>${order.total}</td>
                `;

                tableBody.appendChild(row);
            });
        }

        // Filter orders by search input
        function filterOrders() {
            const searchValue = document.getElementById('searchOrder').value.toLowerCase();
            const filteredOrders = orders.filter(order => 
                order.id.includes(searchValue) || 
                order.user.toLowerCase().includes(searchValue)
            );
            displayOrders(filteredOrders);
        }

        // Initial load of orders
        displayOrders(orders);
    </script>

</body>
</html>


@endsection