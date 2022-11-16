<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <title></title> --}}
</head>
<body style="background-color: #fff">
    <div style="padding: 15px; border:none; border-radius:15px; color:black">
        <h4>Hello {{ $details['firstname'] }} {{ $details['lastname'] }}, </h4>
        <p>{{ $details['body'] }}</p>
        <br>
        <p>www.countdownafrica.com</p>
        <p>hello@countdownafrica.com</p>
        <p>
            Yours Truly,
        </p>
        <p>
            GooPaperless Team
        </p>
    </div>

</body>
</html>
