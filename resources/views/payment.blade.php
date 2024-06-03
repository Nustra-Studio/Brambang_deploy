<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maintenance</title>
    <style>
        body {
            text-align: center;
            padding: 150px;
        }
        h1 {
            font-size: 50px;
        }
        body {
            font: 20px Helvetica, sans-serif;
            color: #333;
        }
        article {
            display: block;
            text-align: left;
            width: 650px;
            margin: 0 auto;
        }
        a {
            color: #dc0000;
            text-decoration: none;
        }
        a:hover {
            color: #333;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <article>
        <h1>We’ll be back soon!</h1>
        <div>
            <p>Sorry for the inconvenience but we’re performing some maintenance at the moment. If you need to, you can always <a href="{{ url('/contact') }}">contact us</a>, otherwise we’ll be back online shortly!</p>
            <p>&mdash; The Team</p>
            <p>If you need to make a payment, please click the link below:</p>
            <a href="{{ url('/payment') }}">Go to Payment Page</a>
        </div>
    </article>
</body>
</html>
