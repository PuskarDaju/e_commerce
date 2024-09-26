@extends('user.layout')
@section('changeAble')
my Product 


 <div class="product-card">
  
    <img src="{{asset('storage/images/products/'.$items->image)}}" alt="product">
    <div class="product-info">
        <h3>{{$items->name}}</h3>
        <p>Rs.{{$items->price}}</p>
        {{-- <form action="{{route('addToCart',['proId'=>$items->id])}}" method="POST">
            @csrf
            <button>Add to Cart</button>
        </form> --}}
    </div>
 
  
</div>
    
@endsection