<!-- Advertising -->

@php
    $advertisingOptions = [
        "" => "--Select an option--",
        "1" => "Print Media",
        "2" => "Internet Advertising",
        "3" => "Out of Home Media",
    ];
@endphp

@php
    $periodiCity = [
        1 => "Daily",
        2 => "Weekly",
        3 => "Monthly",
        4 => "Bi-Monthly",
        5 => "Quarterly",
        6 => "Other"
    ];
@endphp

@php
    $services = [
        1 => "Display Ads",
        2 => "Video Ads",
        3 => "Social Media Ads",
        4 => "Search Ads",
        5 => "Affiliate Marketing",
        6 => "Influencer Marketing",
        7 => "Other (Specify)"
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
                <td><strong>Segment Type</strong></td>
                <td>to do</td>
            </tr>
              
        </tbody>
    </table>
</div>


<div class="table-responsive">
    <table class="table table-striped table-list-view">
        <tbody>
        <tr>
                    <th colspan="2" style=" background: #462965; color: white;">Project Information</th>
                </tr>
           
            <tr>
    <td><strong>Type of Advertising</strong></td>
    <td>
        {{ $advertisingOptions[$other_details->advertising_type ?? ''] ?? 'Unknown' }}
    </td>
</tr>

@if(isset($other_details) && !empty($other_details->advertising_type) && $other_details->advertising_type == 1)
    @if(!empty($other_details->name_of_publication))
        <tr>
            <th scope="row">Name of Publication :</th>
            <td>{{ $other_details->name_of_publication }}</td>
        </tr>
    @endif

    @if(!empty($other_details->language))
        <tr>
            <th scope="row">Language :</th>
            <td>{{ $other_details->language }}</td>
        </tr>
    @endif

    @if(!empty($other_details->country))
        <tr>
            <th scope="row">Country :</th>
            <td>To do</td>
        </tr>
    @endif

    @if(!empty($other_details->location_of_publication) && $other_details->country != 75)
        <tr>
            <th scope="row">Location of Publication :</th>
            <td>{{ $other_details->location_of_publication }}</td>
        </tr>
    @endif

    @if(!empty($other_details->city))
        <tr>
            <th scope="row">Location of Publication :</th>
            <td>To Do</td>
        </tr>
    @endif

    @if(!empty($other_details->reach))
        <tr>
            <th scope="row">Reach :</th>
            <td>{{ $other_details->reach }}</td>
        </tr>
    @endif

    @if(!empty($other_details->periodicity))
        <tr>
            <th scope="row">Periodicity :</th>
            <td>
                @if($other_details->periodicity != 6)
                    {{ $periodiCity[$other_details->periodicity] ?? 'Unknown' }}
                @else
                    Other : {{ $other_details->please_specify_periodicity ?? 'Not specified' }}
                @endif
            </td>
        </tr>
    @endif

    @if(!empty($other_details->publication_portfolio))
        <tr>
            <th scope="row">Editions :</th>
            <td>{{ $other_details->publication_portfolio }}</td>
        </tr>
    @endif

    @if(!empty($other_details->link_to_showreel))
        <tr>
            <th scope="row">Link to Showreel (if available) :</th>
            <td>{{ $other_details->link_to_showreel }}</td>
        </tr>
    @endif

    @if(!empty($other_details->other_project_link))
        <tr>
            <th scope="row">Other Project Links :</th>
            <td>{{ $other_details->other_project_link }}</td>
        </tr>
    @endif
@endif


@if(isset($other_details) && !empty($other_details->advertising_type) && $other_details->advertising_type == 2)

    @if(!empty($other_details->name_of_company))
        <tr>
            <th scope="row">Name of Company:</th>
            <td>{{ $other_details->name_of_company ?? '' }}</td>
        </tr>
    @endif

    @if(!empty($other_details->company_portfolio))
        <tr>
            <th scope="row">About The Company:</th>
            <td>{{ $other_details->company_portfolio ?? '' }}</td>
        </tr>
    @endif

    @if(!empty($other_details->campaigns_offered))
        <tr>
            <th scope="row">Types of Campaigns Offered:</th>
            <td>
                @php
                    // Define available services
                    $services = [
                        1 => "Display Ads",
                        2 => "Video Ads",
                        3 => "Social Media Ads",
                        4 => "Search Ads",
                        5 => "Affiliate Marketing",
                        6 => "Influencer Marketing",
                        7 => "Other (Specify)"
                    ];

                    // Ensure campaigns_offered is an array
                    $selectedCampaigns = is_array($other_details->campaigns_offered) 
                        ? $other_details->campaigns_offered  // If already array
                        : explode(',', (string) $other_details->campaigns_offered); // Convert string to array

                    // Remove "Other (Specify)" if present
                    $campaignNames = array_filter($selectedCampaigns, fn($id) => $id != 7);
                    $campaignNames = array_map(fn($id) => $services[$id] ?? 'Unknown', $campaignNames);

                    // Append user input if "Other (Specify)" (ID: 7) is selected
                    if (in_array(7, $selectedCampaigns)) {
                        $campaignNames[] = "Other: " . ($other_details->please_specify_campaigns_offered ?? 'Not specified');
                    }
                @endphp

                {{ implode(', ', $campaignNames) }}
            </td>
        </tr>
    @endif

@endif

@if(isset($other_details) && !empty($other_details->advertising_type) && $other_details->advertising_type == 3)

    @if(!empty($other_details->ooh_company))
        <tr>
            <th scope="row">Name of OOH Company:</th>
            <td>{{ $other_details->ooh_company ?? '' }}</td>
        </tr>
    @endif

    @if(!empty($other_details->country))
        <tr>
            <th scope="row">Country:</th>
            <td>To Do</td>
        </tr>
    @endif

    @if(!empty($other_details->service_location) && $other_details->country != 75)
        <tr>
            <th scope="row">Services Location:</th>
            <td>{{ $other_details->service_location ?? '' }}</td>
        </tr>
    @endif

    @if(!empty($other_details->city))
        <tr>
            <th scope="row">Services Location:</th>
            <td>To Do</td>
        </tr>
    @endif

    @if(!empty($other_details->type_of_services))
        @php
            $selectedServices = is_array($other_details->type_of_services) 
                ? $other_details->type_of_services 
                : explode(',', (string) $other_details->type_of_services);
            
            // Define service names
            $services = [
                1 => "Hoardings",
                2 => "Posters",
                3 => "Transit Ads",
                4 => "Street Furniture",
                5 => "Digital Displays",
                6 => "Airport Ads",
                7 => "Mall Kiosks",
                8 => "Product Stands",
                9 => "Other", // Changed from "Other(Specify)" to just "Other"
            ];

            // Remove "Other (Specify)" from the main list
            $filteredServices = array_filter($selectedServices, fn($id) => $id != 9);

            // Convert IDs to service names
            $serviceNames = array_map(fn($id) => $services[$id] ?? 'Unknown', $filteredServices);

            // If "Other" (ID 9) is selected, append user input
            if (in_array(9, $selectedServices)) {
                $serviceNames[] = "Other: " . ($other_details->please_specify_services ?? 'Not specified');
            }
        @endphp
        <tr>
            <th scope="row">Type of Services:</th>
            <td>{{ implode(', ', $serviceNames) }}</td>
        </tr>
    @endif

    @if(!empty($other_details->additional_campaign_details))
        <tr>
            <th scope="row">Additional Campaign Details:</th>
            <td>{{ $other_details->additional_campaign_details ?? '' }}</td>
        </tr>
    @endif

@endif

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
                <td><strong>Preview Link :</strong></td>
                <td>{{ $film->download_preview_link ?? ''}}</td>
            </tr>
            <tr>
                <td><strong>Other Work Links :</strong></td>
                <td>{{ $other_details->other_worke_link ?? ''}}</td>
            </tr>

        </tbody>
    </table>
</div>

<div class="table-responsive">
    <table class="table table-striped table-list-view">
        <tbody>
        <tr>
                    <th colspan="2" style=" background: #462965; color: white;">Member Associations</th>
                </tr>

           
            <tr>
                <td><strong>Member Associations :</strong></td>
                <td>{{ $other_details->member_association ?? ''}}</td>
            </tr>
           

        </tbody>
    </table>
</div>