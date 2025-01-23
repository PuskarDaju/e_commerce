

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
  
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>OTP Verification</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(to right, #6a11cb, #2575fc);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            color: #fff;
        }

        .container {
            background: #fff;
            color: #333;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            text-align: center;
        }

        .container h1 {
            font-size: 1.8rem;
            margin-bottom: 1rem;
        }

        .container p {
            font-size: 1rem;
            margin-bottom: 1.5rem;
        }

        .otp-input {
            display: flex;
            justify-content: space-between;
            margin-bottom: 1.5rem;
        }

        .otp-input input {
            width: 3rem;
            height: 3rem;
            font-size: 1.5rem;
            text-align: center;
            border: 2px solid #ddd;
            border-radius: 6px;
            outline: none;
            transition: border-color 0.3s;
        }

        .otp-input input:focus {
            border-color: #2575fc;
        }

        .submit-btn {
            background: #2575fc;
            color: #fff;
            border: none;
            padding: 0.8rem 2rem;
            font-size: 1rem;
            border-radius: 6px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .submit-btn:hover {
            background: #6a11cb;
        }

        .error-message {
            color: #e74c3c;
            font-size: 0.9rem;
            margin-top: 1rem;
            display: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>OTP Verification</h1>
        <p>Please enter the OTP sent to the recipient to confirm delivery.</p>
      <form action="{{ route('confirmDelivery') }}" method="post">  <div class="otp-input" id="otp-input">
        <input type="text" maxlength="1" id="digit-1">
        <input type="text" maxlength="1" id="digit-2">
        <input type="text" maxlength="1" id="digit-3">
        <input type="text" maxlength="1" id="digit-4">
        <input type="text" maxlength="1" id="digit-5">
        <input type="text" maxlength="1" id="digit-6">
    </div>
</form>
        <button class="submit-btn" id="submit-btn">Verify OTP</button>
        <div class="error-message" id="error-message">Invalid OTP. Please try again.</div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


    <script>
        const inputs = document.querySelectorAll('.otp-input input');
        const submitBtn=document.getElementById('submit-btn');
       
        const errorMessage = document.getElementById('error-message');

        inputs.forEach((input, index) => {
            input.addEventListener('input', () => {
                if (input.value.length === 1 && index < inputs.length - 1) {
                    inputs[index + 1].focus();
                }
            });

            input.addEventListener('keydown', (e) => {
                if (e.key === 'Backspace' && input.value === '' && index > 0) {
                    inputs[index - 1].focus();
                }
            });
        });
            submitBtn.addEventListener('click',()=>{

                if (inputs.length === 6) {
    const otp = Array.from(inputs).map(input => input.value).join(''); // Convert inputs to a single string
    $.ajax({
        url: "checkIfCorrect", // Backend endpoint
        type: "POST",
       
        data: { otp: otp,
            _token: $('meta[name="csrf-token"]').attr('content')

         }, // Send OTP as key-value
        success: function(data) {
            alert(data.msg); // Alert the server's response
        },
        error: function(xhr, status, error) {
            console.error("Error:", error); // Log error
        }
    });
}

            });
        
        
        

    
    </script>
</body>
</html>
