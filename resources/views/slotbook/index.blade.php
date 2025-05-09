@extends('layouts.app')

@section('content')
    <h1>Slot Book List</h1>

    <!-- Search Form -->
    <form method="GET" action="{{ route('slotbook.index') }}">
        <div class="row">
            <!-- <div class="col-md-4">
                <label for="name">First Name</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ request('name') }}">
            </div> -->

            <div class="col-md-4">
            <label for="email">Email</label>
            <input type="text" id="email" name="email" class="form-control" value="{{ request('email') }}">
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-6">
                <button type="submit" class="btn btn-primary">Search</button>
                <a href="{{ route('slotbook.index') }}" class="btn btn-primary">Reset</a>
            </div>
        </div>
    </form>

    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($slots as $slot)
                <tr>
                    <td>{{ $slot->id }}</td>
                    <td>{{ $slot->first_name }}</td>
                    <td>{{ $slot->last_name }}</td>
                    <td>{{ $slot->email }}</td>
                    <td>{{ $slot->phone }}</td>
                    <td>{{ $slot->createdAt }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div>
        {{ $slots->links() }}
    </div>
@endsection
