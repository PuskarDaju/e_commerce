
@extends('user.layout')
@section('css')
<meta name="csrf-token" content="{{csrf_token()}}">
<link rel="stylesheet" href="{{asset('build/assets/css/UserOrder.css')}}">
 
    @endsection
    @section('changeAble')
        
    

  <h2>Your Orders</h2>

  <!-- Order Tabs for navigation -->
  <div class="order-tabs">
    <button class="active" onclick="showOrders('previous')">Previous Orders</button>
    <button onclick="showOrders('new')">New Orders</button>
    <button onclick="showOrders('in-process')">Orders In Process</button>
  </div>

  <!-- Previous Orders Section -->
  <div id="previous" class="orders-container active">
    <div class="order-card">
      <h4>Order ID: 12345</h4>
      <p><span>Date:</span> 12/09/2024</p>
      <p><span>Status:</span> Delivered</p>
      <p><span>Price:</span> $80</p>
    </div>

    <div class="order-card">
      <h4>Order ID: 12346</h4>
      <p><span>Date:</span> 08/09/2024</p>
      <p><span>Status:</span> Delivered</p>
      <p><span>Price:</span> $120</p>
    </div>
  </div>

  <!-- New Orders Section -->
  <div id="new" class="orders-container">
    <div class="order-card">
      <h4>Order ID: 12347</h4>
      <p><span>Date:</span> 19/10/2024</p>
      <p><span>Status:</span> Awaiting Confirmation</p>
      <p><span>Price:</span> $150</p>
    </div>
  </div>

  <!-- Orders In Process Section -->
  <div id="in-process" class="orders-container">
    <div class="order-card">
      <h4>Order ID: 12348</h4>
      <p><span>Date:</span> 17/10/2024</p>
      <p><span>Status:</span> Being Shipped</p>
      <p><span>Price:</span> $60</p>
    </div>
  </div>

  <script>
    function showOrders(category) {
      const categories = document.querySelectorAll('.orders-container');
      const buttons = document.querySelectorAll('.order-tabs button');

      // Hide all order containers
      categories.forEach(container => container.classList.remove('active'));
      // Remove 'active' class from all buttons
      buttons.forEach(button => button.classList.remove('active'));

      // Show the clicked category's orders
      document.getElementById(category).classList.add('active');
      event.target.classList.add('active');
    }
  </script>
@endsection

