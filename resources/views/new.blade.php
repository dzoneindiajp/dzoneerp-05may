<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>


    <img src="{{ url('/') }}/storage/app/staff/1652085598.png" alt="1">
    <br>
    <img src="{{ url('storage/app/staff') }}/1652085598.png" alt="url">
    <br>
    <img src="{{ asset('storage/app/staff/1652085598.png') }}" alt="asset">
    <br>
    <img src="{{ storage_path('app/staff/1652085598.png') }}" alt="storage_path">
    <br>
    <img src="{{ public_path('public/staff/1652085598.png') }}" alt="public_path">
    <br>
    <img src="{{ asset('public/staff/1652085598.png') }}" alt="public_path">
    <br>
    <img src="{{ URL::asset('storage/app/staff/1652085598.png') }}" alt="url:asset">
    <br>
    <img src="{{ URL::asset('storage/app/staff/1652085598.png') }}" alt="url:asset">


    <img class="img-profile rounded-circle" src="{{ asset('app/staff/1652085598.png') }}">

</body>
</html>
