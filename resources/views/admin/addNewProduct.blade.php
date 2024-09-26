<head>
    <link rel="stylesheet" href="{{asset('build/assets/css/addNewForm.css')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>
<form id="addItemForm" action="/product" enctype="multipart/form-data" method="POST">
    @csrf
    <label for="name">Item Name: </label>
    <input type="text" id="name" name="name" required>
    <label for="category">Category: </label>
    <input type="text" id="category" name="category">
    <label for="description">Description: </label>
    <input type="text" id="description" name="description">
    <label for="price">Price: </label>
    <input type="number" id="price" name="price" required>
    <label for="quantity">Quantity: </label>
    <input type="number" name="quantity" id="quantity" required>
    <label for="image">Image: </label>
    <input type="file" name="image" id="image" accept="image/*" required>
    <button type="submit">Submit</button>
</form>

