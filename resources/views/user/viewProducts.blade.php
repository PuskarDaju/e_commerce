@extends('user.layout')
@section('css')
<link rel="stylesheet" href="{{asset('build/assets/css/viewProducts.css')}}">
<style>
    /* Container for the entire card */
/* Container for the entire card */
.product-card {
    perspective: 1000px; /* Provides depth for 3D effect */
    width: 250px; /* You can adjust the width */
    height: 350px; /* Set a fixed height for the card */
    margin: 20px;
}

/* Inner part of the card which will be flipped */
.card-inner {
    width: 100%;
    height: 100%;
    position: relative;
    transform-style: preserve-3d; /* Enable 3D space */
    transition: transform 0.6s; /* Smooth transition for the flip */
}

/* Flip the card when hovered */
.product-card:hover .card-inner {
    transform: rotateY(180deg); /* Flip the card on hover */
}

/* Front of the card (Image and product info) */
.card-front, .card-back {
    position: absolute;
    width: 100%;
    height: 100%;
    backface-visibility: hidden; /* Hide the back when flipped */
}

.card-front {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: space-around; /* Space out the content */
    background: #fff;
    border: 1px solid #ddd;
    padding: 20px;
    box-sizing: border-box;
}

.card-back {
    background: #f5f5f5;
    padding: 20px;
    transform: rotateY(180deg); /* Initially hide the back */
    box-sizing: border-box;
}

/* Description section on the back */
.product-description {
    padding: 10px;
}

.product-description h3 {
    font-size: 18px;
    font-weight: bold;
}

.product-description p {
    font-size: 16px;
    color: #666;
}
.card-front img{
    height: 164px;
}


</style>
    
@endsection
@section('changeAble')
@if (session('msg'))
<div>
    <h1>{{ session('msg') }}</h1>
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
                    <form action="{{route('addToCart')}}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $item->id }}">
                        <label for="quantity">Quantity</label>
                        <input type="number" name="quantity" id="quantity"/>
                        <button>Add to Cart</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif
    
        
    @endforeach
   

    

   

    
</div>

@endsection