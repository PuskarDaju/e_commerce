@extends("user.layout")
@section('css')
    <style>
     
        /* .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        } */
        .notification {
            display: flex;
            align-items: center;
            padding: 15px;
            margin-bottom: 10px;
            border-radius: 5px;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
            animation: slideIn 0.5s ease-in-out;
        }
        .notification.success {
            background-color: #d4edda;
            color: #155724;
            border-left: 5px solid #28a745;
        }
        .notification.error {
            background-color: #f8d7da;
            color: #721c24;
            border-left: 5px solid #dc3545;
        }
        .notification.info {
            background-color: #d1ecf1;
            color: #0c5460;
            border-left: 5px solid #17a2b8;
        }
        .notification .icon {
            margin-right: 15px;
            font-size: 20px;
        }
        .notification .text {
            flex: 1;
        }
        @keyframes slideIn {
            from {
                transform: translateY(20px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
    </style>

@endsection

@section("changeAble")
    <div class="container99">
        <h2 style="text-align: center;">Your Notifications</h2>
        @foreach ($msges as $msg)
        <div class="notification info">
            <div class="icon">ℹ️</div>
            <div class="text">Message: {{ $msg->msg }}</div>
        </div>
        @endforeach
        </div>
    
 @endsection