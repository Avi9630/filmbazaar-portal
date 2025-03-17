<!-- Radio and Podcasts -->
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
                <td>To do</td>
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
        @php
    // Define stage types
    $stageTypes = [
        1 => "Work In Progress",
        2 => "Completed",
    ];

    // Fetch the selected type_stage value from the database
    $selectedStage = $other_details->type_stage ?? null;

    // Get the corresponding label
    $stageLabel = $stageTypes[$selectedStage] ?? "Not Specified";

    // Fetch expected date if stage is "Work In Progress"
    $expectedDate = ($selectedStage == 1 && isset($other_details->expected_date)) ? $other_details->expected_date : null;
@endphp

<tr>
    <td><strong>Select Stage</strong></td>
    <td>{{ $stageLabel }}</td>
</tr>

@if($selectedStage == 1 && $expectedDate)
<tr>
    <td><strong>Expected Date</strong></td>
    <td>{{ $expectedDate }}</td>
</tr>
@endif

           
            <tr>
                <td><strong>Countries of Production</strong></td>
                <td>To do</td>
            </tr>
            <tr>
                <td><strong>Original Language</strong></td>
                <td>To do</td>
            </tr>
            <tr>
                <td><strong>Type of Content </strong></td>
                <td>{{$other_details->type_of_content ?? ''}}</td>
            </tr>
            <tr>
                <td><strong>Any Work Remaining? </strong></td>
                <td>{{$other_details->work_remaining ?? ''}}</td>
            </tr>

            @php
    // Define content original types
    $contentOriginalTypes = [
        1 => "Original Content",
        2 => "Adapted Content",
        3 => "Public Domain",
    ];

    // Fetch the selected content_original value from the database
    $selectedContentOriginal = $other_details->content_original ?? null;

    // Get the corresponding label
    $contentOriginalLabel = $contentOriginalTypes[$selectedContentOriginal] ?? "Not Specified";

    // Fetch specify_rights if "Adapted Content" is selected
    $specifyRights = ($selectedContentOriginal == 2) ? ($other_details->specify_rights ?? null) : null;

    // Define Specify Rights Options
    $specifyRightsOptions = [
        1 => "Yes",
        2 => "No",
    ];

    // Get the corresponding label for specify_rights
    $specifyRightsLabel = $specifyRightsOptions[$specifyRights] ?? null;
@endphp

<tr>
    <td><strong>Content Original</strong></td>
    <td>{{ $contentOriginalLabel }}</td>
</tr>

@if($selectedContentOriginal == 2 && $specifyRights)
<tr>
    <td><strong>Rights to adaptation of the original work?</strong></td>
    <td>{{ $specifyRightsLabel }}</td>
</tr>
@endif


        </tbody>
    </table>
</div>

<div class="table-responsive">
    <table class="table table-striped table-list-view">
        <tbody>
        <tr>
                    <th colspan="2" style=" background: #462965; color: white;">Other Project Details</th>
        </tr>
            <tr>
                <td><strong>Synopsis of Content</strong></td>
                <td>{{ $other_details->synopsis_of_content ?? '' }}</td>
            </tr>
            <tr>
                <td><strong>Creator's Note</strong></td>
                <td>{{ $other_details->creator_notes ?? '' }}</td>
            </tr>
        </tbody>
    </table>
</div>

<div class="table-responsive">
    <table class="table table-striped table-list-view">
        <tbody>
        <tr>
                    <th colspan="2" style=" background: #462965; color: white;">Preview Link    </th>
        </tr>
            <tr>
                <td><strong>Preview Link</strong></td>
                <td>{{ $other_details->preview_link ?? '' }}</td>
            </tr>
            <tr>
                <td><strong>Other Work Link:</strong></td>
                <td>{{ $other_details->other_worke_link ?? '' }}</td>
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
                <td><strong>Notes (if any) :</strong></td>
                <td>{{ $film->note ?? '' }}</td>
            </tr>
        </tbody>
    </table>
</div>


<div class="table-responsive">
    <table class="table table-striped table-list-view">
        <tbody>
        <tr>
                    <th colspan="2" style=" background: #462965; color: white;">At Waves Portal You are Looking For</th>
        </tr>
        @php
    // Define looking_for options
    $lookingForOptions = [
        1 => "Publishing Opportunity",
        2 => "Licensing",
        3 => "IP Sale",
    ];

    // Fetch the selected values from the database (assuming it's stored as JSON, array, or comma-separated string)
    $selectedLookingFor = $film->looking_for ?? [];

    // Convert JSON string or comma-separated string to array
    if (is_string($selectedLookingFor)) {
        $selectedLookingFor = json_decode($selectedLookingFor, true) ?? explode(',', $selectedLookingFor);
    }

    // Ensure it's an array
    $selectedLookingFor = (array) $selectedLookingFor;

    // Get selected options' names
    $lookingForLabels = array_map(function ($id) use ($lookingForOptions) {
        return $lookingForOptions[$id] ?? null;
    }, $selectedLookingFor);

    // Filter out null values
    $lookingForLabels = array_filter($lookingForLabels);

    // Display text
    $lookingForText = !empty($lookingForLabels) ? implode(', ', $lookingForLabels) : "Not Specified";
@endphp

<tr>
    <td><strong>At Waves Portal You are Looking For</strong></td>
    <td>{{ $lookingForText }}</td> 
</tr>



          
        </tbody>
    </table>
</div>