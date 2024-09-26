
   
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
                <img src="product1.jpg" alt="Product 1">
                <p>Nike Air Max</p>
                <button>View</button>
            </div>
            <div class="wishlist-item">
                <img src="product2.jpg" alt="Product 2">
                <p>Nike Air Jordan</p>
                <button>View</button>
            </div>
        </section>

        <!-- Loyalty Points Section -->
        <section class="loyalty">
            <h2>Loyalty Points</h2>
            <p>You have <strong>1500</strong> points.</p>
        </section>

        <!-- Recommended Products Section -->
        <section class="recommendations">
            <h2>Recommended for You</h2>
            <div class="recommendation-item">
                <img src="recommended1.jpg" alt="Product 1">
                <p>Nike Free Run</p>
            </div>
            <div class="recommendation-item">
                <img src="recommended2.jpg" alt="Product 2">
                <p>Nike Metcon</p>
            </div>
        </section>
        
    @endsection

