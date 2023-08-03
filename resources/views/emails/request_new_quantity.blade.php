<!DOCTYPE html>
<html>
<head>
    <title>Request for New Quantity</title>
</head>
<body>
<div style="max-width: 600px; margin: 0 auto;">

    <p>{{$vendor_name}}</p>

    <p>{{$body ?? 'We would like to request a new quantity of our product.
         Kindly provide us with the updated information. Thank you.'}}</p>

    <p>Thank you for your prompt attention to this matter.</p>

    <p>Best regards,</p>

    <p>{{ config('app.name') }}</p>
</div>
</body>
</html>
