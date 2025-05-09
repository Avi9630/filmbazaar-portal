@extends('layouts.app')

@section('content')
<h1>Buyer List</h1>
<!-- Search Form -->
<form method="GET" action="{{ route('film_buyer.index') }}">
    <div class="row">
        <!-- Name Search -->
        <div class="col-md-4">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ request('name') }}">
        </div>
        <div class="col-md-4">
            <label for="company">Company</label>
            <input type="text" id="company" name="company" class="form-control" value="{{ request('company') }}">
        </div>

        <!-- Email Search -->
        <div class="col-md-4">
            <label for="email">Email</label>
            <input type="text" id="email" name="email" class="form-control" value="{{ request('email') }}">
        </div>

        <!-- Sector Search -->
        <div class="col-md-4">
            <label for="sector">Sector</label>
            <select id="sector" name="sector" class="form-select">
                <option value="">All Sectors</option>
                @foreach ($sectors as $sector)
                <option value="{{ $sector['id'] }}" {{ request('sector') == $sector['id'] ? 'selected' : '' }}>
                    {{ $sector['name'] }}
                </option>
                @endforeach
            </select>
        </div>
    </div>

    <!-- Status Search -->
    <div class="col-md-4">
        <label for="statusdata">Status</label>
        <select id="statusdata" name="status" class="form-control">
            <option value="">All Status</option>
            <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>New</option>
            <option value="2" {{ request('status') == '2' ? 'selected' : '' }}>Active</option>
            <option value="3" {{ request('status') == '3' ? 'selected' : '' }}>Deactivated</option>
            <option value="4" {{ request('status') == '3' ? 'selected' : '' }}>Approved</option>
        </select>
    </div>


    <!-- Submit Button -->
    <div class="col-md-12 mt-3">
        <button type="submit" class="btn btn-primary">Search</button>&nbsp;
        <a href="{{ route('film_buyer.index') }}" class="btn btn-primary">Reset</a>
        <button type="submit" name="download" value="csv" class="btn btn-primary">Download CSV</button>
    </div>

    <!-- Hidden Inputs to Retain Pagination -->
    {{-- <input type="hidden" name="page" value="{{ request('page') }}"> --}}
</form>


<table class="table table-bordered mt-4">
    <thead>
        <tr>
            <th>User Id</th>
            <th>Name</th>
            <th>Email</th>
            <th>Sector</th>
            <th>Company</th>
            <th>Job Profile</th>
            <th>Phone Number</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($FilmBuyers as $FilmBuyer)
        <tr>
            <td>{{ $FilmBuyer->id }}</td>
            <td>{{ $FilmBuyer->first_name }} {{ $FilmBuyer->last_name }}</td>
            <td>{{ $FilmBuyer->email }}</td>
            <td>{{ $FilmBuyer->segments }}</td>
            <td>{{ $FilmBuyer->company }}</td>
            <td>{{ $FilmBuyer->job_title }}</td>
            <td>{{ $FilmBuyer->phone_number }}</td>
            <td>
                @if ($FilmBuyer->status == 1)
                <span class="text-info">New</span>
                @elseif ($FilmBuyer->status == 2)
                <span class="text-success">Active</span>
                @elseif ($FilmBuyer->status == 3)
                <span class="text-danger">Deactivated</span>
                (<span class="text-info">{{ $FilmBuyer->reason_type }}</span>)
                @elseif ($FilmBuyer->status == 4)
                <span class="text-warning">Approved</span>
                @else
                <span class="text-info">New</span>
                @endif
            </td>
            <td>
                <div class="dropdown">
                    <a class="btn  dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="ri-more-fill"></i>
                    </a>

                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('film_buyer.show', $FilmBuyer->id) }}">View Details</a></li>
                        <!-- <li><button class="dropdown-item activate" data-id="{{ $FilmBuyer->id }}">Convert into Film Maker</button></li> -->
                        @if ($FilmBuyer->status == 2)
                        <li><button class="dropdown-item approved" data-id="{{ $FilmBuyer->id }}">Approved</button></li>
                        @endif
                        @if ($FilmBuyer->status == 3)
                        <li><button class="dropdown-item activate" data-id="{{ $FilmBuyer->id }}">Activate</button></li>
                        @else
                        <li><button id="modelopen" type="button" class="dropdown-item modelopen" data-bs-toggle="modal" data-bs-target="#deactivatereason" data-id="{{ $FilmBuyer->id }}">Deactivate</button></li>
                        @endif

                        @if (!empty($allowedBuyer[$FilmBuyer->email]))

                        @if ( $FilmBuyer->asigned_b2b==0)
                        <li><button class="dropdown-item sendRequestForBuyer" data-id="{{ $FilmBuyer->id }}">Send to
                                B2B</button></li>
                        @elseif($FilmBuyer->asigned_b2b==1)
                        <li><button class="dropdown-item sendRequestForBuyer" data-id="{{ $FilmBuyer->id }}">Re-send to B2B</button></li>
                        @endif
                        @endif

                    </ul>
                </div>

            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<!-- Pagination Links -->
<div class="mt-4">
    {{ $FilmBuyers->appends(request()->query())->links() }}

</div>


<div id="deactivatereason" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Reason</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <input type="hidden" id="buyer_id" name="buyer_id">
                        <label>Reason type
                            <select name="reason_type" id="reason_type" class="form-control">
                                <option value="User Request">User Request</option>
                                <option value="Inactive Account">Inactive Account</option>
                                <option value="Policy Violation">Policy Violation</option>
                                <option value="Duplicate Account">Duplicate Account</option>
                                <option value="Fraudulent Activity">Fraudulent Activity</option>
                                <option value="Requested for Deletion">Requested for Deletion</option>
                                <option value="Security Concern">Security Concern</option>
                                <option value="Temporary Suspension">Temporary Suspension</option>
                                <option value="Unverified Information">Unverified Information</option>
                                <option value="Service Discontinuation">Service Discontinuation</option>
                                <option value="Other">Other</option>
                            </select>
                        </label>
                    </div>
                    <div class="col-md-12">
                        <label>Details </label>
                        <textarea type="text" id="reason" class="form-control"></textarea>

                    </div>
                    <div class="col-md-3 mt-3">
                        <input type="button" id="sumbmitwithreason" class="btn btn-primary btn-xs deactivate" value="submit">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script>
        $(document).ready(function() {
            // Handle deactivate button click
            $(".modelopen").click(function(e) {
                $("#buyer_id").val($(this).attr("data-id"));
            })
            $(".deactivate").click(function(e) {
                e.preventDefault();
                const id = $("#buyer_id").val(); // Fetch the ID
                console.log({
                    id
                })


                const reason = $("#reason").val();
                const reason_type = $("#reason_type").val(); // Fetch the ID
                const status = 3; // Set status for deactivation

                $.ajax({
                    url: '{{ route("film_buyer.update.status") }}', // Set the correct route
                    type: 'POST', // Use POST for updating data
                    data: {
                        id,
                        status,
                        reason,
                        reason_type,
                        _token: $('meta[name="csrf-token"]').attr('content') // Add CSRF token
                    },
                    success: function(response) {
                        alert('Status updated successfully!');
                        window.location.reload();

                    },
                    error: function(xhr) {
                        alert('An error occurred. Please try again.');
                    }
                });
            });

            // Handle activate button click
            $(".activate").click(function(e) {
                e.preventDefault();
                const id = $(this).data("id"); // Fetch the ID
                const status = 2; // Set status for activation

                $.ajax({
                    url: '{{ route("film_buyer.update.status") }}', // Set the correct route
                    type: 'POST', // Use POST for updating data
                    data: {
                        id: id,
                        status: status,
                        _token: $('meta[name="csrf-token"]').attr('content') // Add CSRF token
                    },
                    success: function(response) {
                        alert('Status updated successfully!');
                        window.location.reload();

                    },
                    error: function(xhr) {
                        alert('An error occurred. Please try again.');
                    }
                });
            });
            $(".approved").click(function(e) {
                e.preventDefault();
                const id = $(this).data("id"); // Fetch the ID
                const status = 4; // Set status for activation

                $.ajax({
                    url: '{{ route("film_buyer.update.status") }}', // Set the correct route
                    type: 'POST', // Use POST for updating data
                    data: {
                        id: id,
                        status: status,
                        _token: $('meta[name="csrf-token"]').attr('content') // Add CSRF token
                    },
                    success: function(response) {
                        alert('Status updated successfully!');
                        window.location.reload();

                    },
                    error: function(xhr) {
                        alert('An error occurred. Please try again.');
                    }
                });
            });
        });
        $(document).ready(function() {
            $('.sendRequestForBuyer').click(function() {
                let filmMakerId = $(this).data('id');
                $.ajax({
                    url: @json(route('send.sendRequestForBuyer')), // Ensures proper formatting

                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: filmMakerId
                    },
                    success: function(response) {
                        console.log(response);
                        if (response.status)
                            alert("Request Sent Successfully!");
                        else
                            alert(response.data.msg);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                        alert("Error sending request!");
                    }
                });
            });
        });
    </script>

    @endsection