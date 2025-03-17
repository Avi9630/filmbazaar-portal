@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Allowed Buyer</h2>

    <form method="POST" action="{{ route('allowedbuyers.update', $allowedBuyer->id) }}">
        @csrf
        @method('PUT')

       
        <label>Email:</label>
        <input type="email" name="email" value="{{ $allowedBuyer->email }}" required>

        <button type="submit">Update</button>
    </form>
</div>
@endsection