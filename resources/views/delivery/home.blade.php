<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{ route('confirmDelivery') }}" method="post">
        @csrf
        <label for="otp">
            OTP:
        </label>
        <input type="text" name='otp' id="otp" required>
        <button type="submit">submit</button>


    </form>


    

</body>
</html>