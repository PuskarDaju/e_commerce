@extends('user.layout')
@section('css')
<meta name="csrf-token" content="{{csrf_token()}}">
<link rel="stylesheet" href="{{asset('build/assets/css/UserOrder.css')}}">
 
    @endsection
    @section('changeAble')
<h2>Your Orders</h2>

<div class="order-tabs">
  <button class="active" onclick="showOrders('previous')">Previous Orders</button>
  <button onclick="showOrders('new')">New Orders</button>
  <button onclick="showOrders('in-process')">Orders In Process</button>
</div>

<!-- Previous Orders Section -->
<div id="previous" class="orders-container active">
  @foreach($previous as $order)
  <div class="order-card">
      <h4>Order ID: {{ $order->oid }}</h4>
      <p><span>Date:</span> {{ $order->created_at->format('d/m/Y') }}</p>
      <p><span>Status:</span> {{ $order->order_status }}</p>
      <p><span>Price:</span> ${{ $order->total_amount }}</p>
  </div>
  @endforeach
</div>

<!-- New Orders Section -->
<div id="new" class="orders-container">
  @foreach($active as $order)
  <div class="order-card">
      <h4>Order ID: {{ $order->oid }}</h4>
      <p><span>Date:</span> {{ $order->created_at->format('d/m/Y') }}</p>
      <p><span>Status:</span> {{ $order->order_status }}</p>
      <p><span>Price:</span> ${{ $order->total_amount }}</p>
      <p><span>OTP:{{ $order->otp }}</span></p>
  </div>
  @endforeach
</div>

<!-- Orders In Process Section -->
<div id="in-process" class="orders-container">
  @foreach($pending as $order)
  <div class="order-card">
      <h4>Order ID: {{ $order->oid }}</h4>
      <p><span>Date:</span> {{ $order->created_at->format('d/m/Y') }}</p>
      <p><span>Status:</span> {{ $order->order_status }}</p>
      <p><span>Price:</span> ${{ $order->total_amount }}</p>
  </div>
  @endforeach
</div>

<!-- JavaScript -->
<script>
  function showOrders(sectionId) {
      // Remove "active" class from all containers
      const containers = document.querySelectorAll('.orders-container');
      containers.forEach(container => container.classList.remove('active'));

      // Remove "active" class from all buttons
      const buttons = document.querySelectorAll('.order-tabs button');
      buttons.forEach(button => button.classList.remove('active'));

      // Add "active" class to the clicked tab and corresponding section
      document.getElementById(sectionId).classList.add('active');
      event.target.classList.add('active');
  }
</script>
@endsection

