<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Page</title>
    <link rel="stylesheet" href="{{asset('build/assets/css/login.css')}}">
    <script src="{{asset('build/assets/js/login.js')}}"></script>
    <style>
        #showPassword{
            bottom: 53%;   
        
        }
        .input-container {
            position: relative; /* Needed for absolute positioning of the button */
             margin-bottom: 20px; /* Space between input fields */
        }   


        .show-password {
            position: absolute; /* Position the button inside the input field */
            right: 10px; /* Position it to the right */
            top: 50%; /* Center vertically */
            transform: translateY(-50%); /* Adjust for vertical centering */
            cursor: pointer; /* Pointer cursor on hover */
            background-color: #f0f0f0; /* Background color */
            padding: 5px; /* Padding around the button */
            border: 1px solid #ccc; /* Border */
            border-radius: 3px; /* Rounded corners */
            transition: background-color 0.3s; /* Transition effect */
        }

        .show-password:hover {
            background-color: #e0e0e0; /* Change background on hover */
        }

        #confirmPassword,#email{
            background:rgb(213, 227, 232);
            color: black;
        }
        #error{
            height: 10px;
            display: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Circle background elements -->
        <div class="circle circle1"></div>
        <div class="circle circle2"></div>

      
        
        <!-- Login form -->
        <div class="login-box">
            <h2>Registration Form</h2>
            <div class="errorContainer">
                @if(session('error'))
                <p id="backendError">{{session('error')->first()}}</p>
            @endif
            
            </div>
            <form id="registrationForm" action="{{route('registerMe')}}" method="POST">
                @csrf
                <div id="error" style="color:red">password and confirm password donot matched</div>
                <label for="username">Username</label>
                <input type="text" id="username" placeholder="Username" name="username" autocomplete="username" required>

                <label for="email">Email</label>
                <input type="text" id="email" placeholder="email" name="email" autocomplete="email" value="puskar@gmail.com" required>
                
                <label for="password">Password</label>
                <input type="password" id="password" placeholder="Password" name="password" required>
                <div id="showPassword" onclick="showMe('password','showPassword')">show</div>

                <label for="confirmPassword"> Confirm Password</label>
                <input type="password" id="confirmPassword" onkeyup="checkConfirmPassword()" name="confirmPassword" placeholder="Password" required>
                <div id="showConfirmPassword" onclick="showMe('confirmPassword','showConfirmPassword')">show</div>
                
                <button type="submit" id="submit">Register</button>    
            </form>

            <p>Already have a account</p>
            <a href="/login">login</a>
        </div>
       
        
    </div>
</body>
</html>
