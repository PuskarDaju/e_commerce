<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('build/assets/css/payment.css') }}">
    <title>Stripe Checkout</title>
   
</head>
<body>
    <div class="head">
        <center><h2>Complete your Payment</h2></center>

    </div>
    <script src="https://js.stripe.com/v3/"></script>


    <form action="{{route('checkout.process')}}" method="POST" id="payment-form">
        @csrf
        <label for="order_id"></label>
        <input type="text" name="order_id" id="order_id" value={{ $order_id }}>
        <!-- Display the total price dynamically -->
        <p>Total Price: </p>
        $<input type="text" name='price' value="{{ $total_price }}">
        
        <div id="card-element">
            <!-- A Stripe Element will be inserted here. -->
        </div>
        <div>
            <label for="description">description:</label>
            <input type="text" name="description" required>
        </div>
        <!-- Used to display form errors. -->
        <div id="card-errors" role="alert"></div>
        
        <button type="submit">Pay Now</button>
    </form>

   
<script>
    // Initialize Stripe with your publishable key
    var stripe = Stripe("pk_test_51QOf1G2exCUWf2NA3Kw88PDlgo3XLGZXushA2bCGUzvz7tXpeeVGjWRj6c8luCfAg11zDbAz9jlSVc63lcum1JeX00apKdU13p");

    // Create an instance of the Elements class
    var elements = stripe.elements();

    // Create a card Element and mount it to the DOM
    var card = elements.create('card');
    card.mount('#card-element');

    // Handle form submission
    var form = document.getElementById('payment-form');
    form.addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent form from submitting the default way

        // Create a payment method (Card) using the card element
        stripe.createPaymentMethod({
            type: 'card',
            card: card,
        }).then(function(result) {
            if (result.error) {
                // Show error to the user
                var errorElement = document.getElementById('card-errors');
                errorElement.textContent = result.error.message;
            } else {
                // Send the payment method ID to your backend to complete the payment
                stripeTokenHandler(result.paymentMethod.id);
            }
        });
    });

    // Function to submit the payment method ID to your backend
    function stripeTokenHandler(paymentMethodId) {
        var form = document.getElementById('payment-form');
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'payment_method_id');
        hiddenInput.setAttribute('value', paymentMethodId);
        form.appendChild(hiddenInput);

        // Submit the form to your server
        form.submit();
    }
</script>


</body>
</html>
