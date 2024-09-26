<head>
    <link rel="stylesheet" href="{{asset('build/assets/css/addNewForm.css')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>
<form id="addItemForm" enctype="multipart/form-data">
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

<script>
    jq(document).ready(function(){
        jq('#addItemForm').submit(function(event){
            event.preventDefault();

            // Create FormData object
            var formData = new FormData();
            formData.append('name', jq('#name').val());
            formData.append('category', jq('#category').val());
            formData.append('description', jq('#description').val());
            formData.append('price', jq('#price').val());
            formData.append('quantity', jq('#quantity').val());
            formData.append('image', jq('#image').prop('files')[0]);

            // Perform AJAX request
            jq.ajax({
                headers: {
                    'X-CSRF-TOKEN': jq('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                url: '/product',
                data: formData,
                processData: false,  // Prevent jQuery from processing the data
                contentType: false,  // Prevent jQuery from setting the content type
                success: function(data){
                    console.log(data.message);
                    console.log(data.name);
                },
                error: function(){
                    console.log('error');
                }
            });
        });
    });
</script>

