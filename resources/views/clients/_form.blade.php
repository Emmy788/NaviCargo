@extends('layouts.app')

@section('content')

@csrf
<div>
    <label>First Name:</label>
    <input type="text" name="first_name" value="{{ old('first_name', $client->first_name ?? '') }}" required>
</div>
<div>
    <label>Last Name:</label>
    <input type="text" name="last_name" value="{{ old('last_name', $client->last_name ?? '') }}" required>
</div>
<div>
    <label>Email:</label>
    <input type="email" name="email_address" value="{{ old('email_address', $client->email_address ?? '') }}">
</div>
<div>
    <label>Phone:</label>
    <input type="text" name="phone_number" value="{{ old('phone_number', $client->phone_number ?? '') }}">
</div>
<div>
    <label>Address:</label>
    <textarea name="address">{{ old('address', $client->address ?? '') }}</textarea>
</div>
@endsection
