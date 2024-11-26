@extends('admin.adminLayout')
@section('mainContents')
<head>
    
    <style>
        /* Style for the div containing the table */
     .productTable {
        margin: 20px auto;
        padding: 20px;
        background-color: #f9f9f9;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        max-width: 80%;
     }

/* Style for the table */
.productTable table {
    width: 100%;
    border-collapse: collapse;
    font-family: Arial, sans-serif;
    text-align: left;
    background-color: white;
    border-radius: 10px;
    overflow: hidden;
}

/* Header styling */
.productTable th {
    background-color: #3498db;
    color: white;
    padding: 12px 15px;
    text-transform: uppercase;
    letter-spacing: 1px;
    font-size: 14px;
    border-bottom: 2px solid #ddd;
}

/* Body cell styling */
.productTable td {
    padding: 10px 15px;
    border-bottom: 1px solid #ddd;
    font-size: 14px;
}

/* Hover effect for rows */
.productTable tr:hover {
    background-color: #f1f1f1;
}

/* Responsive table on small screens */
@media (max-width: 768px) {
    .productTable table, .productTable th, .productTable td {
        display: block;
        width: 100%;
    }
    .productTable tr {
        margin-bottom: 10px;
    }
    .productTable th, .productTable td {
        text-align: right;
        padding-left: 50%;
        position: relative;
    }
    .productTable th::before, .productTable td::before {
        content: attr(data-label);
        position: absolute;
        left: 15px;
        text-align: left;
        font-weight: bold;
    }
   
}
#btn{
        background-color:rgb(95, 208, 95);
        width: 100%; 
        height: 30px;
    }
form{
    width: 100%;
}
#product-image{
    width: 100px;
    height: 128px;
}
.buttons{
    display: flex;
    gap: 20px;
}

    </style>
</head>
<div class="productTable">
  
    <table>
        <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Descriptiom</th>
            <th>Category</th>
            <th>Price</th>
            <th>Stock</th>
            <th>Status</th>
            <th style="width:20%">Action</th>
        </tr>
        <tr>
           <td colspan="8">
            
                <form action="/product/create" method="get">
                @csrf
                <button id="btn" >Add New</button>
                </form>
            
           </td>
        </tr>
        @if ($stocks!=null ||empty($stocks||$stocks!==''))
            
        
       @foreach ($stocks as $a)
       <tr>
        <td> 
            <img id="product-image" src="{{asset('storage/images/products/'.$a->image_url)}}" alt="" srcset="">


        </td>
        <td> {{$a->name}} </td>
        <td> {{$a->description}} </td>
        <td> {{$a->category->name}} </td>
        <td> {{$a->price}} </td>
        <td> {{$a->stock}} </td>
        <td> @if (empty($a->status))
            Normal
            
        @else
            {{$a->status}}
    @endif
    </td>
    <td>
       <div class="buttons">
        
        <form class="dltBtn" action="/product/{{$a->id}}" method="POST">
            @method('DELETE')
            @csrf
            <button >Delete</button>
        </form>
        
       <form class="editBtn" action="/product/{{$a->id}}/edit" method="get">
        @csrf
        
        <button id="edit" data-id="{{$a->id}}">Edit</button>
       
    </form>
       </div>


    </td>
       </tr>
           
       @endforeach
       @endif
    </table>
    
</div>
@endsection