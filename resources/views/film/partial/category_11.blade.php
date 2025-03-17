<!-- Live Event -->
@php
    $selectExpertise = [
        1 => "Healthcare (Medical training and patient education)",
        2 => "Retail (Product visualization)",
        3 => "Education (immersive learning experiences)",
        4 => "Manufacturing (design and training)",
        5 => "Real estate (virtual property tours)",
        6 => "Entertainment (Gaming)",
        7 => "Tourism (Virtual Tour, Temple, Museum)"
    ];
@endphp

@php
    $selectCategory = [
        1 => "AR",
        2 => "VR",
        3 => "XR",
        4 => "MR",
        5 => "VFX",
    ];
@endphp


<div class="table-responsive">
    {{ $film->category}}
    <table class="table table-striped table-list-view">
        <tbody>
        <tr>
                    <th colspan="2" style=" background: #462965; color: white;">Basic Information</th>
        </tr>
            <tr>
                <td><strong>Film Maker ID</strong></td>
                <td>{{ $film->film_maker_id }}</td>
            </tr>
            <tr>
                <td><strong>Title</strong></td>
                <td>{{ $film->title }}</td>
            </tr>
            <tr>
                <td><strong>Segment</strong></td>
                <td>to do</td>
            </tr>
              
        </tbody>
    </table>
</div>

<div class="table-responsive">
    <table class="table table-striped table-list-view">
        <tbody>
        <tr>
                    <th colspan="2" style=" background: #462965; color: white;">Event Information</th>
                </tr>
            <tr>
               
                <tr>
    <td><strong>Company / Individual Name </strong></td>
   
    <td>

    {{$other_details->company ?? ''}}
    </td>
</tr>
            </tr>
            @if(!empty($other_details->designation_role))
    @php
        // Define the designation roles
        $designationRoles = [
            1 => "Event Organizer",
            2 => "Planner",
        ];

        // Get the role name based on the stored value
        $roleName = $designationRoles[$other_details->designation_role] ?? 'Unknown';
    @endphp

    <tr>
        <th scope="row">Designation/Role :</th>
        <td>{{ $roleName }}</td>
    </tr>
@endif

<tr>
        <th scope="row">Website :</th>
        <td>{{ $other_details->website ?? '' }}</td>
    </tr>
    <tr>
        <th scope="row">Facebook :</th>
        <td>{{ $other_details->facebook ?? '' }}</td>
    </tr>
    <tr>
        <th scope="row">Instagram :</th>
        <td>{{ $other_details->instagram  ?? ''}}</td>
    </tr>
    <tr>
        <th scope="row">Twitter :</th>
        <td>{{ $other_details->twitter ??'' }}</td>
    </tr>
    <tr>
        <th scope="row">Linkedin :</th>
        <td>{{ $other_details->linkedin ??''}}</td>
    </tr>
    <tr>
        <th scope="row">Other Social media profiles  :</th>
        <td>{{ $other_details->social_media ?? ''}}</td>
    </tr>

    @if(!empty($other_details->event_type))
    @php
        // Define event types
        $eventTypes = [
            1 => "Concert",
            2 => "Conference",
            3 => "Fashion show",
            4 => "Sports",
            5 => "Product launch",
            6 => "Other",
        ];

        // Convert stored values into an array (if stored as a comma-separated string)
        $selectedEventTypes = is_array($other_details->event_type) 
            ? $other_details->event_type 
            : explode(',', (string) $other_details->event_type);

        // Get event type names based on selected values
        $eventNames = array_map(fn($id) => $eventTypes[$id] ?? 'Unknown', $selectedEventTypes);

        // Check if "Other" is selected and append the specified value
        if (in_array(6, $selectedEventTypes) && !empty($other_details->please_specify_event_type)) {
            $eventNames[] = "Other: " . $other_details->please_specify_event_type;
        }
    @endphp

    <tr>
        <th scope="row">Event Type</th>
        <td>{{ implode(', ', $eventNames) }}</td>
    </tr>
@endif

@if(!empty($other_details->venue_arrangement))
    @php
        // Define venue arrangement types
        $venueArrangements = [
            1 => "Indoor",
            2 => "Outdoor",
            3 => "Hybrid",
            4 => "Virtual",
        ];

        // Convert stored values into an array (if stored as a comma-separated string)
        $selectedVenues = is_array($other_details->venue_arrangement) 
            ? $other_details->venue_arrangement 
            : explode(',', (string) $other_details->venue_arrangement);

        // Get venue names based on selected values
        $venueNames = array_map(fn($id) => $venueArrangements[$id] ?? 'Unknown', $selectedVenues);
    @endphp

    <tr>
        <th scope="row">Venue Arrangement</th>
        <td>{{ implode(', ', $venueNames) }}</td>
    </tr>
@endif

@if(!empty($other_details->production_services))
    @php
        // Define production service types
        $productionServices = [
            1 => "Stage",
            2 => "Sound",
            3 => "Lighting",
            4 => "AV Setup",
            5 => "Fireworks",
            6 => "LED Screen",
            7 => "Others (Specify)",
        ];

        // Convert stored values into an array (if stored as a comma-separated string)
        $selectedServices = is_array($other_details->production_services) 
            ? $other_details->production_services 
            : explode(',', (string) $other_details->production_services);

        // Get production service names based on selected values
        $serviceNames = array_map(fn($id) => $productionServices[$id] ?? 'Unknown', $selectedServices);

        // If "Others (Specify)" (ID 7) is selected, add user-specified input
        if (in_array(7, $selectedServices) && !empty($other_details->please_specify_production_services)) {
            $serviceNames[] = "Others: " . $other_details->please_specify_production_services;
        }
    @endphp

    <tr>
        <th scope="row">Production Services</th>
        <td>{{ implode(', ', $serviceNames) }}</td>
    </tr>
@endif

@if(!empty($other_details->catering_services))
    @php
        // Define catering service options
        $cateringServices = [
            1 => "Yes",
            2 => "No",
        ];

        // Get the catering service name based on the stored value
        $cateringServiceName = $cateringServices[$other_details->catering_services] ?? 'Unknown';
    @endphp

    <tr>
        <th scope="row">Catering Services</th>
        <td>{{ $cateringServiceName }}</td>
    </tr>
@endif

@if(!empty($other_details->hospitality_management))
    @php
        // Define hospitality management options
        $hospitalityManagement = [
            1 => "Yes",
            2 => "No",
        ];

        // Get the hospitality management name based on the stored value
        $hospitalityManagementName = $hospitalityManagement[$other_details->hospitality_management] ?? 'Unknown';
    @endphp

    <tr>
        <th scope="row">Hospitality Management</th>
        <td>{{ $hospitalityManagementName }}</td>
    </tr>
@endif

@if(!empty($other_details->security_management))
    @php
        // Define security management options
        $securityManagement = [
            1 => "Yes",
            2 => "No",
        ];

        // Get the security management name based on the stored value
        $securityManagementName = $securityManagement[$other_details->security_management] ?? 'Unknown';
    @endphp

    <tr>
        <th scope="row">Security & Crowd Management</th>
        <td>{{ $securityManagementName }}</td>
    </tr>
@endif

@if(!empty($other_details->brandingsupport))
    @php
        // Define branding & sponsorship support options
        $brandingSupport = [
            1 => "Yes",
            2 => "No",
        ];

        // Get the branding support name based on the stored value
        $brandingSupportName = $brandingSupport[$other_details->brandingsupport] ?? 'Unknown';
    @endphp

    <tr>
        <th scope="row">Branding & Sponsorship Support</th>
        <td>{{ $brandingSupportName }}</td>
    </tr>
@endif

<tr>
        <th scope="row">Preferred Country </th>
        <td>To do</td>
    </tr>

    <tr>
        <th scope="row">Preffered State </th>
        <td>{{$other_details->preffered_state ?? ''}}</td>
    </tr>
    <tr>
        <th scope="row">Preffered City </th>
        <td>{{$other_details->preffered_city ?? ''}}</td>
    </tr>







           
           

        </tbody>
    </table>
</div>

<div class="table-responsive">
    <table class="table table-striped table-list-view">
        <tbody>
        <tr>
                    <th colspan="2" style=" background: #462965; color: white;">Post Experience & Portfolio</th>
                </tr>

            <tr>
                <td><strong>Number of Events managed</strong></td>
                <td>{{ $other_details->number_of_event_manage ?? ''}}</td>
            </tr>
            <tr>
                <td><strong>Brands work with</strong></td>
                <td>{{ $other_details->brands_work_with ?? ''}}</td>
            </tr>

        </tbody>
    </table>
</div>

<div class="table-responsive">
    <table class="table table-striped table-list-view">
        <tbody>
        <tr>
                    <th colspan="2" style=" background: #462965; color: white;">Pricing & Packages</th>
                </tr>

            <tr>
                <td><strong>Unique Selling Point/Why anyone hire you </strong></td>
                <td>{{ $other_details->unique_selling_point ?? ''}}</td>
            </tr>
           

        </tbody>
    </table>
</div>

<div class="table-responsive">
    <table class="table table-striped table-list-view">
        <tbody>
        <tr>
                    <th colspan="2" style=" background: #462965; color: white;">Preview Link</th>
                </tr>
            <tr>
                <td><strong>Preview Link</strong></td>
                <td>{{ $other_details->preview_link ?? ''}}</td>
            </tr>
            <tr>
                <td><strong>Other Work Links</strong></td>
                <td>{{ $other_details->other_worke_link ?? ''}}</td>
            </tr>

        </tbody>
    </table>
</div>

<div class="table-responsive">
    <table class="table table-striped table-list-view">
        <tbody>
        <tr>
                    <th colspan="2" style=" background: #462965; color: white;">Notes</th>
                </tr>
            <tr>
                <td><strong>Notes (If any) </strong></td>
                <td>{{ $other_details->note ?? ''}}</td>
            </tr>
            <tr>
                <td><strong>Looking For</strong></td>
                <td>{{ $other_details->text_looking_for ?? ''}}</td>
            </tr>

        </tbody>
    </table>
</div>