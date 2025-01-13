@extends('layouts.app')

@section('content')
<div class="innerpage mt-3">
    <div class="page-title"><h2>Seller Profile Detail</h2></div>
    <div class="row card">
       
       

            <div class="tab-content1">
                <div>
                    <div class="shadow-sm white-bg mb-3">
                        <div>
                            <div class="row g-0 overflow-hidden flex-md-row mb-4 h-md-250 position-relative">
                           
                                <div class="col p-4 d-flex flex-column position-static pt-0">
                                    <h3 class="d-inline-block mb-2 text-primary-emphasis font-18">{{ $filmMaker->first_name }}</h3>
                                    <div class="mb-1 text-body-secondary">
                                        <strong>First Name:</strong> {{ $filmMaker->first_name }}
                                    </div>
                                    <div class="mb-1 text-body-secondary">
                                        <strong>Last Name:</strong> {{ $filmMaker->last_name }}
                                    </div>
                                    <div class="mb-1 text-body-secondary">
                                        <strong>Position:</strong> {{ $filmMaker->job_profile }}
                                    </div>
                                    <div class="mb-1 text-body-secondary">
                                        <strong>Company:</strong> {{ $filmMaker->company }}
                                    </div>
                                </div>

                                <div class="list-group-item active header-title-bg mt-4 mb-4">
                                    <div class="d-flex align-items-center justify-content-start w-100">
                                        <h6 class="buyer-heading">About Us</h6>
                                    </div>
                                </div>

                              
                                    <div class="table-responsive">
                                        <table class="table table-striped table-list-view">
                                            <tbody>
                                                <tr>
                                                    <td>{{ $filmMaker->about_us }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                               
                                    <div class="showblurbox">
                                        <div class="showblur"></div>
                                        <p class="showblurtext">This section will be available once the Interest Approved.</p>
                                    </div>
                               

                                <div class="list-group-item active header-title-bg mt-4 mb-4">
                                    <div class="d-flex align-items-center justify-content-start w-100">
                                        <h6 class="buyer-heading">Contact Information</h6>
                                    </div>
                                </div>

                               
                                    <div class="table-responsive">
                                        <table class="table table-striped table-list-view">
                                            <tbody>
                                              
                                                    <tr>
                                                        <th scope="row">Email:</th>
                                                        <td>{{ $filmMaker->email }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Phone:</th>
                                                        <td>{{ $filmMaker->phone_number }}</td>
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
                                                <tr>
                                                    <th scope="row">Zip:</th>
                                                    <td>{{ $filmMaker->zip }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">State:</th>
                                                    <td>{{ $filmMaker->state }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Country:</th>
                                                    <td>{{ $filmMaker->country->name }}</td>
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
                                                    {{-- <td>{{ getCompanyTypeNames($filmMaker->company_type) }}</td> --}}
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
                                                <tr>
                                                    <th scope="row">Current Geographies:</th>
                                                    <td>{{ $filmMaker->geographies }}</td>
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
                                                    {{-- <td>{{ getSegmentTypeNames($filmMaker->sectors) }}</td> --}}
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
      
    </div>
</div>

@endsection
