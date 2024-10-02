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
            document.querySelectorAll('input[type="checkbox"]').forEach((checkbox) => {
            checkbox.addEventListener('change', calcTotal);
        });
    
            // Run once on page load to initialize the total price
            window.onload = calcTotal;

            
        </script>
@section('changeAble')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="{{asset('build/assets/js/mycart.js')}}"></script>

<div class="productTable">
  
    <table>
        <tr>
            <td>Checks</td>
            <th>Image</th>
            <th>Name</th>
            <th>Descriptiom</th>
            <th>Category</th>
            <th>Price</th>
            
            <th style="width:20%">Action</th>
        </tr>
      
        @if ($stocks!=null ||empty($stocks||$stocks!==''))
            
        
       @foreach ($stocks as $a)
       <tr>
        <td> <input type="checkbox" id="{{$a->product->id}}" value="{{$a->product->price}}" onclick="calcTotal()"  checked></td>
        <td> 
            <img id="product-image" src="{{asset('storage/images/products/'.$a->product->image)}}" alt="" srcset="">


        </td>
       
        <td> {{$a->product->name}} </td>
        <td> {{$a->product->description}} </td>
        <td> {{$a->product->category}} </td>
        <td> {{$a->product->price}} </td>
        
    </td>
    <td>
       <div class="buttons">
        
        <form class="dltBtn" action="{{route('deleteFromMyCart')}}" method="POST">
            @method('DELETE')
            <input type="hidden" name="id" value="{{$a->product->id}}">
            @csrf
            <button >REMOVE</button>
        </form>
        
       <form class="editBtn" action="#" method="get">
        @csrf
        
        <button id="edit" data-id="{{$a->id}}">BUY</button>
       
    </form>
       </div>


    </td>
       </tr>
      
       @endforeach
       <tfoot>
        <td colspan="5">Total</td>
        <td> <input type="text" name="totalPrice" id="totalPrice" >  </td>
        <td><button onclick="sendOrder()">Checkout</button></td>
       </tfoot>
           
       @endif
    </table>
    
</div>
    
@endsection