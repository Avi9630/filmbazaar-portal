@extends('layouts.app')

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('dashboard') }}">Home</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('film_buyer.index') }}">Buyer</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
            Detail
        </li>
    </ol>
</nav>

<div class="innerpage mt-3 p-3 card">


    <div class="page-title">
        <h2>Buyer Profile Detail</h2>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-list-view">
            <tbody>
                <tr>
                    <th scope="row">Account status:</th>
                    <td>
                        @if ($FilmBuyer->status == 1)
                        <span class="text-info">New</span>
                        @elseif ($FilmBuyer->status == 2)
                        <span class="text-success">Active</span>
                        @elseif ($FilmBuyer->status == 3)
                        <span class="text-danger">Deactivated</span>
                        (<span class="text-info">{{ $FilmBuyer->reason_type }}</span>)
                        @elseif ($FilmBuyer->status == 4)
                        <span class="text-info">Approved</span>
                        @else
                        <span class="text-info">New</span>
                        @endif
                    </td>

                </tr>
                @if ($FilmBuyer->status == 3)
                <tr>
                    <th scope="row">Reason Type:</th>
                    <td>
                        <span class="text-info"> {{ $FilmBuyer->reason_type }}</span>
                    </td>
                </tr>
                <tr>
                    <th scope="row">Reason :</th>
                    <td>
                        <span class="text-info">{{ $FilmBuyer->reason }}</span>
                    </td>
                </tr>
                @endif
                <tr>
                    <th scope="row">First Name:</th>
                    <td>{{ $FilmBuyer->first_name }}</td>
                </tr>
                <tr>
                    <th scope="row">Last Name:</th>
                    <td>{{ $FilmBuyer->last_name }}</td>
                </tr>
                <tr>
                    <th scope="row">Position:</th>
                    <td>{{ $FilmBuyer->job_title }}</td>
                </tr>
                <tr>
                    <th scope="row">Company:</th>
                    <td>{{ $FilmBuyer->company }}</td>
                </tr>
                <tr>
                    <th scope="row">Email:</th>
                    <td>{{ $FilmBuyer->email }}</td>
                </tr>
                <tr>
                    <th scope="row">Phone:</th>
                    <td>{{ $FilmBuyer->phone }}</td>
                </tr>
                <tr>
                    <th scope="row">Mobile:</th>
                    <td>{{ $FilmBuyer->mobile }}</td>
                </tr>
                <tr>
                    <th scope="row">About Us:</th>
                    <td>{{ $FilmBuyer->about_us }}</td>
                </tr>

            </tbody>
        </table>
    </div>


    <div class="list-group-item active header-title-bg mt-4 mb-4">
        <div class="d-flex align-items-center justify-content-start w-100">
            <h6 class="buyer-heading">Address</h6>
        </div>
    </div>


    <div class="table-responsive">
        <table class="table table-striped table-list-view">
            <tbody>
                <tr>
                    <th scope="row">Address:</th>
                    <td>{{ $FilmBuyer->address }}</td>
                </tr>
                <tr>
                    <th scope="row">City:</th>
                    <td>{{ $FilmBuyer->city }}</td>
                </tr>
                <tr>
                    <th scope="row">Zip:</th>
                    <td>{{ $FilmBuyer->zip }}</td>
                </tr>
                <tr>
                    <th scope="row">State:</th>
                    <td>{{ $FilmBuyer->state }}</td>
                </tr>
                <tr>
                    <th scope="row">Country:</th>
                    <td>{{ $FilmBuyer->country ? $FilmBuyer->country->name : '' }}</td>
                </tr>
            </tbody>
        </table>
    </div>


    <div class="list-group-item active header-title-bg mt-4 mb-4">
        <div class="d-flex align-items-center justify-content-start w-100">
            <h6 class="buyer-heading">Company Information</h6>
        </div>
    </div>


    <div class="table-responsive">
        <table class="table table-striped table-list-view">
            <tbody>
                <tr>
                    <th scope="row">Company Name:</th>
                    <td>{{ $FilmBuyer->company }}</td>
                </tr>
                <tr>
                    <th scope="row">Company Profile:</th>
                    <td>{{ $FilmBuyer->company_profile }}</td>
                </tr>
                <tr>
                    <th scope="row">Company Type:</th>
                    <td>
                        {{ !empty($FilmBuyer->company_type)  ?  $FilmBuyer->companyType($FilmBuyer->company_type) : '' }}
                    </td>
                </tr>
                <tr>
                    <th scope="row">Company Registration Number/Tax ID:</th>
                    <td>{{ $FilmBuyer->registration_number }}</td>
                </tr>
                <tr>
                    <th scope="row">Registered Address:</th>
                    <td>{{ $FilmBuyer->registered_address }}</td>
                </tr>
                <tr>
                    <th scope="row">Existing Collaborations/Partnerships:</th>
                    <td>{{ $FilmBuyer->collaborations }}</td>
                </tr>
                <tr>
                    <th scope="row">Initial Funding:</th>
                    <td>{{ $FilmBuyer->funding }}</td>
                </tr>
                <tr>
                    <th scope="row">Current Geographies:</th>
                    <td>{{ json_decode($FilmBuyer->geographies) }}</td>
                </tr>
            </tbody>
        </table>
    </div>


    <div class="list-group-item active header-title-bg mt-4 mb-4">
        <div class="d-flex align-items-center justify-content-start w-100">
            <h6 class="buyer-heading">Sector</h6>
        </div>
    </div>


    <div class="table-responsive">
        <table class="table table-striped table-list-view">
            <tbody>
                <tr>
                    <th scope="row">Selected Sector:</th>
                    <td>
                        {{ !empty($FilmBuyer->segments)  ?  $FilmBuyer->getSector($FilmBuyer->segments) : '' }}
                    </td>

                </tr>
            </tbody>
        </table>
    </div>

</div>

</div>

@endsection