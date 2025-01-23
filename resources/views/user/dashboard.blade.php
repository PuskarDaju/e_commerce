
   
        @extends('user.layout')
    
 
        @section('changeAble')
        <section class="orders">
            <h2>Recent Orders</h2>
            <div class="order">
                <p>Order #12345</p>
                <p>Status: Shipped</p>
                <p>Expected Delivery: Sept 28, 2024</p>
            </div>
            <div class="order">
                <p>Order #12344</p>
                <p>Status: Processing</p>
                <p>Expected Delivery: Sept 25, 2024</p>
            </div>
        </section>

        <!-- Wishlist Section -->
        <section class="wishlist">
            <h2>Wishlist</h2>
            <div class="wishlist-item">
                <img src="{{ asset('/storage/images/products/air-max-270.jpg') }}" alt="Product_1">
                <p>Nike Air Max</p>
                <button>View</button>
            </div>
            <div class="wishlist-item">
                <img src="{{ asset('/storage/images/products/ultraBost22.jpg') }}" alt="Product 2">
                <p>Nike Air Jordan</p>
                <button>View</button>
            </div>
        </section>

      

        
        
    @endsection

