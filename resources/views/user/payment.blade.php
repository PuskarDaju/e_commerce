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
        <p>Total Price: </p>
        $<input type="text" name='price' value="{{ $total_price }}">

        <div id="card-element">
        </div>
        <div>
            <label for="description">description:</label>
            <input type="text" name="description" required>
        </div>
        <!-- Used to display form errors. -->
        <div id="card-errors" role="alert"></div>

        <button type="submit">Pay Now</button>
    </form>

    <script src="https://js.stripe.com/v3/"></script>

    <script>

        var stripe = Stripe("{{ env('STRIPE_PUBLISHABLE_KEY') }}");
        var elements = stripe.elements();

        var card = elements.create('card');
        card.mount('#card-element');

        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            stripe.createPaymentMethod({
                type: 'card',
                card: card,
            }).then(function(result) {
                if (result.error) {
                    document.getElementById('card-errors').textContent = result.error.message;
                } else {
                    stripeTokenHandler(result.paymentMethod.id);
                }
            });
        });

        function stripeTokenHandler(paymentMethodId) {
            var form = document.getElementById('payment-form');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'payment_method_id');
            hiddenInput.setAttribute('value', paymentMethodId);
            form.appendChild(hiddenInput);
            form.submit();
        }
    </script>


</body>
</html>
