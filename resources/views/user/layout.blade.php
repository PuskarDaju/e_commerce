
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="/build/assets/css/layout.css">
    <title>Document</title>
</head>
<body>
    <div class="mainContaier">
        <div class="navBar">
           
<nav class="navbar">
    <div class="ecommName">
        <h1>Fashion Hub</h1>
    </div>
    
    <div class="nav-buttons">
        <button class="nav-button" onclick="location.href='index.html'">Home</button>
        <button class="nav-button" onclick="location.href='index.html'">Products</button>
        <button class="nav-button" onclick="location.href='index.html'">Cart</button>
        <button class="nav-button" onclick="location.href='index.html'">History</button>
        
        
    </div>
    <div class="nav-side-button">
        <button>search</button>
        <button>Profile</button>
        <div class="dropdown">
            <button class="dropbtn">Dropdown</button>
            <div class="dropdown-content">
                <a href="#option1">Option 1</a>
                <a href="#option2">Option 2</a>
                <a href="#option3">Option 3</a>
            </div>
        </div>
    </div>
    </nav>
            
        </div>

        <div class="mainPage">
            @yield('changeAble')
        </div>
    
    </div>
   
