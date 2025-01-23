const stripe = Stripe('your-publishable-key'); // Replace with your Stripe publishable key
const elements = stripe.elements();
const cardElement = elements.create('card');
cardElement.mount('#card-element');

document.querySelector('#payment-form').addEventListener('submit', async (event) => {
    event.preventDefault();

    const { client_secret } = await fetch('/process-payment', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ amount: 100 }), // Replace with dynamic amount
    }).then(res => res.json());

    const { paymentIntent, error } = await stripe.confirmCardPayment(client_secret, {
        payment_method: {
            card: cardElement,
        },
    });

    if (error) {
        console.error('Payment failed:', error.message);
        alert('Payment failed! Please try again.');
    } else if (paymentIntent.status === 'succeeded') {
        console.log('Payment succeeded:', paymentIntent);
        alert('Payment successful!');
        window.location.href = '/payment-success';
    }
});