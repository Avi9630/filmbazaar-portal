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
    
            <!-- Email Search -->
            <div class="col-md-4">
                <label for="email">Email</label>
                <input type="text" id="email" name="email" class="form-control" value="{{ request('email') }}">
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
        </div>
    
        <div class="row mt-3">
            <!-- Status Search -->
            <div class="col-md-4">
                <label for="statusdata">Status</label>
                <select id="statusdata" name="status" class="form-select" style="width: 100%">
                    <option value="">All Status</option>
                    <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>New</option>
                    <option value="2" {{ request('status') == '2' ? 'selected' : '' }}>Active</option>
                    <option value="3" {{ request('status') == '3' ? 'selected' : '' }}>Deactivated</option>
                </select>
            </div>
        </div>
    
        <!-- Submit Button -->
        <div class="col-md-12 mt-3">
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    
        <!-- Hidden Inputs to Retain Pagination -->
        <input type="hidden" name="page" value="{{ request('page') }}">
    </form>
    

    <!-- Film Makers Table -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>user id</th>
                <th>Name</th>
                <th>email</th>
                <th>sector</th>
                <th>company</th>
                <th>Job Profile</th>
                <th>Phone Number</th>
                <th>status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($filmMakers as $filmMaker)
                <tr>
                    <td>{{ $filmMaker->id }}</td>
                    <td>{{ $filmMaker->first_name }} {{ $filmMaker->last_name }}</td>
                    <td>{{ $filmMaker->email }}</td>
                    <td>{{ $filmMaker->sectors }}</td>
                    <td>{{ $filmMaker->company }}</td>
                    <td>{{ $filmMaker->job_profile }}</td>
                    <td>{{ $filmMaker->phone_number }}</td>
                    <td>
                        @if ($filmMaker->status == 1)
                            New
                        @elseif ($filmMaker->status == 2)
                            Active
                        @elseif ($filmMaker->status == 3)
                            Deactivated
                        @else
                            New
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('film_makers.show', $filmMaker->id) }}">View Details</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination Links -->
    <div>
        {{ $filmMakers->links() }}
    </div>
@endsection
