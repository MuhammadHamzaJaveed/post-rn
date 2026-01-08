<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Email</title>
</head>
<style>
    .email {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 20px;
    }

    .email-inner {
        background: white;
        padding: 10px;
        border-radius: 10px;
        box-shadow: 0 3px 10px rgb(0 0 0 / 0.2);
    }

    .main-heading {
        font-family: inherit;
        font-size: 40px;
        font-weight: bold;
        color: #2563eb;
        text-align: center;
    }

    .email-text {
        font-size: 25px;
        color: #1e293b;
    }

    .email-text span {
        font-weight: bold;
    }
</style>
<body>

    <div class="email">
       @yield('content')
    </div>

</body>
</html>
