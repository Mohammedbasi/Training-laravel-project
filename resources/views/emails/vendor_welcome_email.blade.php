<!DOCTYPE html>
<html>
<head>
    <title>Welcome to {{config('app.name')}}</title>
    <style>
        /* Reset default margin and padding */
        body, div, p {
            margin: 0;
            padding: 0;
        }

        /* Set a background color and text color */
        body {
            background-color: #f4f4f4;
            color: #333333;
            font-family: Arial, sans-serif;
        }

        /* Container */
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        /* Header */
        .header {
            background-color: #3498db;
            color: #ffffff;
            text-align: center;
            padding: 20px 0;
        }

        /* Content */
        .content {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        /* Button */
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #3498db;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
        }

        /* Footer */
        .footer {
            text-align: center;
            margin-top: 20px;
            color: #777777;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h1>Welcome to {{config('app.name')}}e</h1>
    </div>
    <div class="content">
        <p>Hello {{$vendor->first_name . ' ' . $vendor->last_name}},</p>
        <p>Thank you for joining our website. We're excited to have you on board.</p>
        <p>Explore our features and start your journey with us!</p>
        <a href="{{route('dashboard')}}" class="btn">Get Started</a>
    </div>
    <div class="footer">
        <p>If you have any questions, please contact us at {{config('app.email')}}.</p>
    </div>
</div>
</body>
</html>
