<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <p>Halo : {{ (Auth::user()->level_user->username) }}</p>
    <p>{{ $cekuser }}</p>
    <p>ini tampilan bukan untuk admin</p>
</body>
</html>