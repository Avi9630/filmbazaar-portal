@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Allowed Buyers</h2>
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif
    <form method="GET" action="{{ route('allowedbuyers.index') }}">
        <input type="text" name="search" placeholder="Search by email" value="{{ request('search') }}">
        <button type="submit">Search</button>
    </form>

    <a href="{{ route('allowedbuyers.create') }}" class="btn btn-primary">Add New</a>

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($allowedBuyers as $buyer)
            <tr>
                <td>{{ $buyer->id }}</td>
                <td>{{ $buyer->email }}</td>
                <td>
                    <a href="{{ route('allowedbuyers.show', $buyer->id) }}" class="btn btn-info">View</a>
                    <a href="{{ route('allowedbuyers.edit', $buyer->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('allowedbuyers.destroy', $buyer->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"
                            onclick="return confirm('Are you sure you want to delete this buyer?');">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $allowedBuyers->links() }}
</div>
@endsection