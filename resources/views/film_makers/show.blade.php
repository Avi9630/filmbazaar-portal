@extends('layouts.app')

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('dashboard') }}">Home</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('film_makers.index') }}">Seller</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
            Detail
        </li>
    </ol>
</nav>
<div class="innerpage mt-3 p-3 card">
    <div class="page-title">
        <h2>Seller Profile Detail</h2>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-list-view">
            <tbody>
                <tr>
                    <th scope="row">Account status:</th>
                    <td>
                        @if ($filmMaker->status == 1)
                        <span class="text-info">New</span>
                        @elseif ($filmMaker->status == 2)
                        <span class="text-success">Active</span>
                        @elseif ($filmMaker->status == 3)
                        <span class="text-danger">Deactivated</span>
                        (<span class="text-info">{{ $filmMaker->reason_type }}</span>)
                        @elseif ($filmMaker->status == 4)
                        <span class="text-info">Approved</span>
                        @else
                        <span class="text-info">New</span>
                        @endif
                    </td>

                </tr>
                @if ($filmMaker->status == 3)
                <tr>
                    <th scope="row">Reason Type:</th>
                    <td>
                        <span class="text-info"> {{ $filmMaker->reason_type }}</span>
                    </td>
                </tr>
                <tr>
                    <th scope="row">Reason :</th>
                    <td>
                        <span class="text-info">{{ $filmMaker->reason }}</span>
                    </td>
                </tr>
                @endif
                <tr>
                    <th scope="row">First Name:</th>
                    <td>{{ $filmMaker->first_name }}</td>
                </tr>
                <tr>
                    <th scope="row">Last Name:</th>
                    <td>{{ $filmMaker->last_name }}</td>
                </tr>
                <tr>
                    <th scope="row">Position:</th>
                    <td>{{ $filmMaker->job_profile }}</td>
                </tr>
                <tr>
                    <th scope="row">Company:</th>
                    <td>{{ $filmMaker->company }}</td>
                </tr>
                <tr>
                    <th scope="row">Email:</th>
                    <td>{{ $filmMaker->email }}</td>
                </tr>
                <tr>
                    <th scope="row">Phone:</th>
                    <td>{{ $filmMaker->phone_number }}</td>
                </tr>

                <tr>
                    <th scope="row">About Us:</th>
                    <td>{{ $filmMaker->about_us }}</td>
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
                    <td>{{ $filmMaker->address }}</td>
                </tr>
                <tr>
                    <th scope="row">City:</th>
                    <td>{{ $filmMaker->city }}</td>
                </tr>
                <!-- <tr>
                    <th scope="row">Zip:</th>
                    <td>{{ $filmMaker->zip }}</td>
                </tr>
                <tr>
                    <th scope="row">State:</th>
                    <td>{{ $filmMaker->state }}</td>
                </tr> -->
                <tr>
                    <th scope="row">Country:</th>
                    <td>{{ $filmMaker->country ? $filmMaker->country->name : '' }}</td>

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
                    <td>{{ $filmMaker->company }}</td>
                </tr>
                <tr>
                    <th scope="row">Company Profile:</th>
                    <td>{{ $filmMaker->company_profile }}</td>
                </tr>
                <tr>
                    <th scope="row">Company Type:</th>
                    <td>
                        {{ !empty($filmMaker->company_type)  ?  $filmMaker->companyType($filmMaker->company_type) : '' }}
                    </td>
                </tr>
                <tr>
                    <th scope="row">Company Registration Number/Tax ID:</th>
                    <td>{{ $filmMaker->registration_number }}</td>
                </tr>
                <tr>
                    <th scope="row">Registered Address:</th>
                    <td>{{ $filmMaker->registered_address }}</td>
                </tr>
                <tr>
                    <th scope="row">Existing Collaborations/Partnerships:</th>
                    <td>{{ $filmMaker->collaborations }}</td>
                </tr>
                <tr>
                    <th scope="row">Initial Funding:</th>
                    <td>{{ $filmMaker->funding }}</td>
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
                        {{ !empty($filmMaker->sectors)  ?  $filmMaker->getSector($filmMaker->sectors) : '' }}
                    </td>

                </tr>
            </tbody>
        </table>
    </div>

</div>

</div>

@endsection