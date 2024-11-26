@extends('admin.adminLayout')
@section('cssSection')
    
@endsection
@section('mainContents')
<form action="/product/{{$myItem->id}}" method="POST" enctype="multipart/form-data">
    @method('PATCH')
    @csrf
    <label for="name">Item Name: </label>
    <input type="text" id="name" name="name"
    value="{{$myItem->name}}"
    
    required>
    <label for="category">Category:  
    </label>
    <input type="text" id="category" name="category"
    value="{{$myItem->category_id}}"
    required>
    <label for="description">Description: </label>
    <input type="text" id="description" name="description"
    value="{{$myItem->description}}" required>
    <label for="price">Price: </label>
    <input type="number" id="price" name="price" 
    value="{{$myItem->price}}"
    required>
    
    <label for="image">New Image: </label>
    <input type="file" name="image" id="image"
    value="{{$myItem->image}}"
    accept="image/*">
    <button type="submit">Submit</button>
</form>

    
@endsection