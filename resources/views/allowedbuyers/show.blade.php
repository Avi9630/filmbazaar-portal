@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Allowed Buyer Details</h2>
    
    <p><strong>Email:</strong> {{ $allowedBuyer->email }}</p>

    <a href="{{ route('allowedbuyers.index') }}" class="btn btn-primary">Back</a>
</div>

@endsection