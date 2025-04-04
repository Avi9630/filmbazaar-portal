@extends('layouts.app')

@section('content')
    <h1>Seller List</h1>

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
                    <option value="4" {{ request('status') == '3' ? 'selected' : '' }}>Approved</option>
                </select>
            </div>

            <!-- Status Search -->
            <div class="col-md-4">
                <label for="statusdata">Payment Status</label>
                <select id="paymentStatus" name="paymentStatus" class="form-select" style="width: 100%">
                    <option value="">All Status</option>
                    <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Paid</option>
                    <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Unpaid</option>
                </select>
            </div>
        </div>


        <!-- Submit Button -->
        <div class="col-md-12 mt-3">
            <button type="submit" class="btn btn-primary">Search</button>
            <a href="{{ route('film_makers.index') }}" class="btn btn-primary">Reset</a>
        </div>

        <!-- Hidden Inputs to Retain Pagination -->
        <input type="hidden" name="page" value="{{ request('page') }}">
    </form>


    <!-- Film Makers Table -->
    <table class="table table-bordered mt-4">
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
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($filmMakers as $filmMaker)
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
                            <span class="text-info">New</span>
                        @elseif ($filmMaker->status == 2)
                            <span class="text-success">Active</span>
                        @elseif ($filmMaker->status == 3)
                            <span class="text-danger">Deactivated</span>
                            (<span class="text-info">{{ $filmMaker->reason_type }}</span>)
                        @elseif ($filmMaker->status == 4)
                            <span class="text-warning">Approved</span>
                        @elseif ($filmMaker->status == 4)
                            <span class="text-warning">Approved</span>
                        @else
                            <span class="text-info">New</span>
                        @endif
                    </td>
                    <td>
                        <div class="dropdown">
                            <a class="btn  dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="ri-more-fill"></i>
                            </a>

                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('film_makers.show', $filmMaker->id) }}">View
                                        Details</a></li>
                                @if ($filmMaker->status == 2)
                                    <li><button class="dropdown-item approved"
                                            data-id="{{ $filmMaker->id }}">Approved</button></li>
                                @endif

                                @if ($filmMaker->status == 3)
                                    <li><button class="dropdown-item activate"
                                            data-id="{{ $filmMaker->id }}">Activate</button></li>
                                @else
                                    <li><button id="modelopen" type="button" class="dropdown-item modelopen"
                                            data-bs-toggle="modal" data-bs-target="#deactivatereason"
                                            data-id="{{ $filmMaker->id }}">Deactivate</button></li>
                                @endif

                                {{-- @if ($filmMaker->payed === 1)
                                    <li><button class="dropdown-item" data-id="{{ $filmMaker->id }}">Send to
                                            B2B</button></li>
                                @elseif($filmMaker->payed === null)
                                    <li><button class="dropdown-item" id="sendB2b" data-id="{{ $filmMaker->id }}">
                                            Already Sent</button></li>
                                @endif --}}

                                @if ($filmMaker->payed === 1)
                                    <li><button class="dropdown-item sendB2b" data-id="{{ $filmMaker->id }}">Send to
                                            B2B</button></li>
                                @elseif($filmMaker->payed === null)
                                    <li><button class="dropdown-item" disabled>Already Sent</button></li>
                                @endif
                            </ul>
                        </div>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination Links -->
    <div>
        {{ $filmMakers->links() }}
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
                            <input type="button" id="sumbmitwithreason" class="btn btn-primary btn-xs deactivate"
                                value="submit">
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
                        url: '{{ route('film_makers.update.status') }}', // Set the correct route
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
                        url: '{{ route('film_makers.update.status') }}', // Set the correct route
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
                        url: '{{ route('film_makers.update.status') }}', // Set the correct route
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
        </script>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                $('.sendB2b').click(function() {
                    let filmMakerId = $(this).data('id');
                    $.ajax({
                        url: '{{ route('send.b2b') }}',
                        type: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            id: filmMakerId
                        },
                        success: function(response) {
                            console.log(response);
                            alert("Request Sent Successfully!");
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
