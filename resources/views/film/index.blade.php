@extends('layouts.app')

@section('content')
<h1>Project List</h1>

<!-- Search Form -->
<form method="GET" action="{{ route('film.fimindex') }}">
    <div class="row">
        <!-- Name Search -->
        <div class="col-md-4">
            <label for="name">Title</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ request('name') }}">
        </div>

        <!-- Sector Search -->
        <div class="col-md-4">
            <label for="sector">Segment</label>
            <select id="sector" name="sector" class="form-select">
                <option value="">Please Select</option>
                @foreach ($sectors as $sector)
                <option value="{{ $sector['id'] }}" {{ request('sector') == $sector['id'] ? 'selected' : '' }}>
                    {{ $sector['name'] }}
                </option>
                @endforeach
            </select>
        </div>

        <!-- Status Search -->
        <div class="col-md-4">
            <label for="statusdata">Status</label>
            <select id="statusdata" name="status" class="form-select">
                <option value="">All Status</option>
                <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>New ( InComplete )</option>
                <option value="2" {{ request('status') == '2' ? 'selected' : '' }}>Active</option>
                <option value="3" {{ request('status') == '3' ? 'selected' : '' }}>Inactive</option>
                <option value="3" {{ request('status') == '4' ? 'selected' : '' }}>Deactivated</option>
            </select>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-6">
            <button type="submit" class="btn btn-primary">Search</button>&nbsp;
            <a href="{{ route('film.fimindex') }}" class="btn btn-primary">Reset</a>
        </div>

    </div>
</form>

<!-- Film Makers Table -->
<table class="table table-bordered mt-4">
    <thead>
        <tr>
            <th>User ID</th>
            <th>Title</th>
            <th>Category</th>
            <th>Language</th>
            <th>Country</th>
            <th>Duration</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($films as $film)

        <tr>
            <td>{{ $film->id }}</td>
            <td>{{ $film->title }}</td>
            <td>{{ $film->category }}</td>

            <td>{{ implode(', ', $film::languages($film->language)) }}</td>

            <td>{{ implode(', ', $film::countries($film->country)) }}</td>

            {{-- <td>{{ $film->country->name }}</td> --}}

            <td>{{ !empty($film->duration) ? $film->duration . ' min': '' }} </td>

            <td>
                @if ($film->status == 1)
                New
                @elseif ($film->status == 2)
                Active
                @elseif ($film->status == 3)
                Inactive
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