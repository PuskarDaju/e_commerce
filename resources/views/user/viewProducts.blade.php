@extends('user.layout')
@section('css')
<link rel="stylesheet" href="{{asset('build/assets/css/viewProducts.css')}}">
    
@endsection
@section('changeAble')
<div class="product-grid">
    @foreach ($products as $item)
    <div class="product-card">
        <img src="{{asset('storage/images/products/'.$item->image)}}" alt="product">
        <div class="product-info">
            <h3>{{$item->name}}</h3>
            <p>Rs.{{$item->price}}</p>
            <form action="{{route('addToCart')}}" method="POST">

                @csrf
                <input type="hidden" name="id" value="{{ $item->id }}">
                <button>Add to Cart</button>
            </form>
        </div>
    </div>
        
    @endforeach
   

    

   

    
</div>

@endsection