@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add Allowed Buyer</h2>

    <form method="POST" action="{{ route('allowedbuyers.store') }}">
        @csrf
       
        <label>Email:</label>
        <input type="email" name="email" required>

        <button type="submit">Submit</button>
    </form>
</div>
@endsection