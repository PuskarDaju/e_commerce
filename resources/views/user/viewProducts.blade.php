@extends('user.layout')
@section('css')
<link rel="stylesheet" href="{{asset('build/assets/css/viewProducts.css')}}">
<style>
        .product-card {
    perspective: 1000px; /* Provides depth for 3D effect */
    width: 250px; /* Adjust width for consistency */
    height: 350px; /* Set a fixed height for the card */
    margin: 20px;
    background: linear-gradient(145deg, #f0f0f0, #d9d9d9);
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    overflow: visible;
    transition: transform 0.3s, box-shadow 0.3s;
}

.product-card:hover {
    transform: scale(1.05); /* Slightly enlarge on hover */
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
}

/* Inner part of the card which will be flipped */
.card-inner {
    width: 100%;
    height: 100%;
    position: relative;
    transform-style: preserve-3d; /* Enable 3D space */
    transition: transform 0.6s;
}

/* Flip the card when hovered */
.product-card:hover .card-inner {
    transform: rotateY(180deg); /* Flip the card on hover */
}

/* Front and back of the card */
.card-front, .card-back {
    position: absolute;
    width: 100%;
    height: 100%;
    backface-visibility: hidden; /* Hide the back when flipped */
    border-radius: 10px;
    overflow: hidden;
}

.card-front {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: space-around;
    background: #fff;
    border: 1px solid #e0e0e0;
    padding: 20px;
    box-sizing: border-box;
    text-align: center;
}

.card-front img {
    height: 140px; /* Resize image for consistency */
    border-radius: 8px;
    object-fit: cover;
    margin-bottom: 15px;
}

.card-back {
    background: #fafafa;
    padding: 20px;
    transform: rotateY(180deg);
    box-sizing: border-box;
    text-align: center;
}

/* Description section on the back */
.product-description {
    padding: 10px;
}

.product-description h3 {
    font-size: 18px;
    font-weight: bold;
    margin-bottom: 10px;
    color: #333;
}

.product-description p {
    font-size: 15px;
    color: #666;
    line-height: 1.5;
}

.product-info h3 {
    font-size: 20px;
    color: #333;
    margin: 10px 0;
}

.product-info p {
    font-size: 18px;
    color: #007bff;
    font-weight: bold;
}

/* Styling for the form and button */
form {
    margin-top: 15px;
    text-align: center;
}

form input[type="number"] {
    width: 50px;
    padding: 5px;
    border: 1px solid #ddd;
    border-radius: 5px;
    margin-right: 10px;
}

form button {
    background: #007bff;
    color: #fff;
    padding: 8px 12px;
    border: none;
    border-radius: 5px;
    font-size: 14px;
    cursor: pointer;
    transition: background 0.3s;
}

form button:hover {
    background: #0056b3;
}

/* Product grid styling */
.product-grid {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 32px;
    padding: 20px;
}



</style>
    
@endsection
@section('changeAble')
@if (session('msg'))
<div>
    <p style="color:red">{{ session('msg') }}</p>
</div>
    

    
@endif
<div class="product-grid">
    @foreach ($products as $item)
    @if($item->stock_quantity>0)
    <div class="product-card">
        <div class="card-inner">
            <!-- Front of the card -->
            <div class="card-front">
                <img src="{{asset('storage/images/products/'.$item->image_url)}}" alt="product">
                <div class="product-info">
                    <h3>{{$item->name}}</h3>
                    <p>Rs.{{$item->price}}</p>
                    
                </div>
                
            </div>
            
    
            <!-- Back of the card (hidden initially) -->
            <div class="card-back">
                <div class="product-description">
                    <h3>Description</h3>
                    <p>{{$item->description}}</p>
                  
                </div>
            </div>
        </div>
        <div>
            <form action="{{route('addToCart')}}" method="post">
              
                @csrf
                <input type="hidden" name="id" value="{{ $item->id }}">
                <label for="quantity">Quantity</label>
                <input type="number" name="quantity" id="quantity" value=1 />
                <button>Add to Cart</button>
            </form>
         </div>
 
    </div>

  
    @endif
    
        
    @endforeach
   

    

   

    
</div>

@endsection