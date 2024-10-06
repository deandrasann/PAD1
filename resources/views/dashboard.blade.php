<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>alamak</title>
</head>
<body>
    @auth
    @can('admin')
        <p>{{ auth()->user()->username }}</p>
    @endcan
    @endauth
    @can('dokter')
        <p>{{ auth()->user()->username }}</p>
    @endcan
    <p>tidak ada yang login</p>
</body>
</html>