@extends('user.layout')
@section('css')
<meta name="csrf-token" content="{{csrf_token()}}">
<link rel="stylesheet" href="{{asset('build/assets/css/myCart.css')}}">
        @endsection
        <script>
              function calcTotal() {
        // Select all checkboxes
        let myItemPrices = document.querySelectorAll('input[type="checkbox"]');
        let valueToDisplay = document.getElementById('totalPrice');
        let total = 0;
        
        console.log("hello")

        // Iterate over each checkbox
        myItemPrices.forEach(element => {
            
            
            if (element.checked) {
                
                total += parseFloat(element.value);
            }
        });

        // Display the total
        
        valueToDisplay.value = total.toFixed(2); 
        }
            document.querySelectorAll('input[type="checkbox"]').forEach     ((checkbox) => {
                checkbox.addEventListener('change', calcTotal);
            });
         
    
            // Run once on page load to initialize the total price
            window.onload = calcTotal;

            
        </script>
@section('changeAble')
@if (session('msg'))
<div>
    <h1>{{ session('msg') }}</h1>
</div>
    

    
@endif
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="{{asset('build/assets/js/mycart.js')}}"></script>
@if (session('msg'))
<div class="alert alert-success">
    {{ session('msg') }}
</div>
@endif

<div class="productTable">
  
    <table>
        <tr>
            <td>Checks</td>
            <th>Image</th>
            <th>Name</th>
            <th>Quantity</th>
            <th>Description</th>
            <th>Category</th>
            <th>Rate</th>
            <th>Total</th>
            
            <th style="width:20%">Action</th>
        </tr>
      
        @if ($stocks!=null ||empty($stocks||$stocks!==''))
            
        
       @foreach ($stocks as $a)
       <tr>
        <td> <input type="checkbox" data-id="{{$a->product->id}}" data-price="{{$a->product->price}}" value="{{$a->product->price*$a->quantity}}" data-quantity="{{$a->quantity}}" onclick="calcTotal()" class="product-checkbox"  checked></td>
        <td> 
            <img id="product-image" src="{{asset('storage/images/products/'.$a->product->image_url)}}" alt="" srcset="">


        </td>
       
        <td> {{$a->product->name}} </td>
        <td> {{$a->quantity}} </td>

        <td> {{$a->product->description}} </td>
        <td> {{$a->product->category->name}} </td>
        <td> {{$a->product->price}} </td>
        <td > {{$a->product->price * $a->quantity}} </td>
        
        
    </td>
    <td>
       <div class="buttons">
        
        <form class="dltBtn" action="{{route('deleteFromMyCart')}}" method="POST">
            @method('DELETE')
            <input type="hidden" name="id" value="{{$a->product->id}}">
            @csrf
            <button >REMOVE</button>
        </form>
        
       <form class="editBtn" method="POST" action="{{route('addOrders')}}">
        @csrf
        <input type="hidden" name="id" value="{{$a->product->id}}">
        
        <button id="buy">BUY</button>
       
    </form>
       </div>


    </td>
       </tr>
      
       @endforeach
       <tfoot>
        <td colspan="7">Total</td>
        <td> <input type="text" name="totalPrice" id="totalPrice" readonly >  </td>
        <td><center><button class="checkout-btn" onclick="openCheckoutForm()">Checkout</button></center></td>
       </tfoot>
           
       @endif
    </table>
    <div id="checkoutForm" class="checkout-form">
        <div class="form-container">
            <span class="close-btn" onclick="closeCheckoutForm()">&times;</span>
            <h2>Checkout</h2>
            <form action="{{route('payment')}}" method="POST">
                @csrf
                <!-- Address Section -->
                <div class="form-group">
                    <label for="address">Delivery Address</label>
                    <input type="text" name="address" id="address" rows="4" placeholder="Enter your delivery address">
                    
                </div>
    
                <!-- Payment Method Section -->
                <div class="form-group">
                    <label for="payment_method">Payment Method</label>
                    <select name="payment_method" id="payment_method">
                        <option value="credit_card">Credit Card</option>
                        <option value="paypal">PayPal</option>
                        <option value="cod">Cash on Delivery</option>
                        <option value="stripe">stripe</option>
                    </select>
                </div>
                <div id="hiddenFields"></div>
    
                <!-- Submit Button -->
                <div class="form-group">
                    <button type="submit" class="submit-btn">Proceed to Payment</button>
                </div>
            </form>
    
</div>
    
@endsection