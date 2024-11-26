<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div>
        @foreach ($msges as $msg)
        <center><h1>message: {{ $msg->msg }}</h1></center>            
        @endforeach
    </div>
</body>
</html>