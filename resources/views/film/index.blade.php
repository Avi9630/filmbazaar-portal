@extends('layouts.app')

@section('content')
<h1>Film Makers List</h1>

<!-- Search Form -->
<form method="GET" action="{{ route('film_makers.index') }}">
    <div class="row">
        <!-- Name Search -->
        <div class="col-md-4">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ request('name') }}">
        </div>

        <!-- Sector Search -->
        <div class="col-md-4">
            <label for="sector">Sector</label>
            <select id="sector" name="sector" class="form-control">
                <option value="">All Sectors</option>
                @foreach ($sectors as $sector)
                <option value="{{ $sector['id'] }}" {{ request('sector') == $sector['id'] ? 'selected' : '' }}>
                    {{ $sector['name'] }}
                </option>
                @endforeach
            </select>
        </div>

        <!-- Status Search -->
        <div class="col-md-4">
            <label for="status">Status</label>
            <select id="status" name="status" class="form-control">
                <option value="">All Status</option>
                <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>New</option>
                <option value="2" {{ request('status') == '2' ? 'selected' : '' }}>Active</option>
                <option value="3" {{ request('status') == '3' ? 'selected' : '' }}>Deactivated</option>
            </select>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-12">
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </div>
</form>

<!-- Film Makers Table -->
<table class="table table-bordered">
    <thead>
        <tr>
            <th>User ID</th>
            <th>Title</th>
            <th>Category</th>
            <th>Language</th>
            <th>Country</th>
            <th>Duration</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($films as $film)
        <tr>
            <td>{{ $film->id }}</td>
            <td>{{ $film->title }}</td>
            <td>{{ $film->category }}</td>
            <td>{{ $film->language }}</td>
            <td>{{ $film->country }}</td>
            <td>{{ $film->duration }}</td>
            <td>
                @if ($film->status == 1)
                New
                @elseif ($film->status == 2)
                Active
                @elseif ($film->status == 3)
                Deactivated
                @else
                New
                @endif
            </td>
            <td>
                <a href="{{ route('film.filmshow', $film->id) }}">View Details</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<!-- Pagination Links -->
<div>
    {{ $films->links() }}
</div>
@endsection