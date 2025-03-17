<!-- Music and Sound -->
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
    // Define the options for stage types
    $stageTypes = [
        1 => "Work In Progress",
        2 => "Completed",
    ];

    // Get the selected value from the database
    $selectedStage = $other_details->type_stage ?? null;

    // Display the corresponding text or "Not Specified"
    $stageText = $stageTypes[$selectedStage] ?? "Not Specified";
@endphp

<tr>
    <td><strong>Stage Type</strong></td>
    <td>{{ $stageText }}</td>
</tr>

            <tr>
                <td><strong>Countries of production:</strong></td>
                <td>To Do</td>
            </tr>
            <tr>
                <td><strong>Original Language</strong></td>
                <td>To Do</td>
            </tr>
            <tr>
                <td><strong>Type Of Content</strong></td>
                <td>{{$film->type_of_content ?? ''}}</td>
            </tr>
            <tr>
                <td><strong>Expected date of completion </strong></td>
                <td>{{$other_details->expected_date ?? ''}}</td>
            </tr>
            <tr>
                <td><strong>Any work Remaining </strong></td>
                <td>{{$other_details->work_remaining ?? ''}}</td>
            </tr>

            @php
    // Define content original options
    $contentOriginal = [
        1 => "Original Content",
        2 => "Adapted Content",
        3 => "Public Domain",
    ];

    // Define specify rights options
    $specifyRights = [
        1 => "Yes",
        2 => "No",
    ];

    // Fetch values from database
    $selectedContentOriginal = $other_details->content_original ?? null;
    $selectedSpecifyRights = $other_details->specify_rights ?? null;

    // Get display text
    $contentOriginalText = $contentOriginal[$selectedContentOriginal] ?? "Not Specified";
    $specifyRightsText = $specifyRights[$selectedSpecifyRights] ?? null;
@endphp

<tr>
    <td><strong>Content Original</strong></td>
    <td>{{ $contentOriginalText }}</td>
</tr>

@if($selectedContentOriginal == 2 && $selectedSpecifyRights)
<tr>
    <td><strong>Specify Rights to Adaptation</strong></td>
    <td>{{ $specifyRightsText }}</td>
</tr>
@endif

@php
    // Define portfolio options
    $portfolioTypes = [
        1 => "Spotify",
        2 => "Youtube",
        3 => "Soundcloud",
        4 => "Bandcamp",
        5 => "Others",
    ];

    // Fetch values from database
    $selectedPortfolio = $other_details->portfolio ?? null;
    $specifiedPortfolio = $other_details->please_specify ?? null;

    // Get display text
    $portfolioText = $portfolioTypes[$selectedPortfolio] ?? "Not Specified";
@endphp

<tr>
    <td><strong>Portfolio</strong></td>
    <td>{{ $portfolioText }}</td>
</tr>

@if($selectedPortfolio == 5 && $specifiedPortfolio)
<tr>
    <td><strong>Specify Portfolio</strong></td>
    <td>{{ $specifiedPortfolio }}</td>
</tr>
@endif


            <tr>
                <td><strong>Portfolio Link </strong></td>
                <td>{{$other_details->please_specify_portfolio_link ?? ''}}</td>
            </tr>
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
                <td>{{ $film->synopsis ?? '' }}</td>
            </tr>
            <tr>
                <td><strong>Creator's Note</strong></td>
                <td>{{ $film->director_comment ?? '' }}</td>
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
                <td>{{ $other_details->download_preview_link ?? '' }}</td>
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

    // Fetch the selected values from the database (assuming it's stored as an array or comma-separated string)
    $selectedLookingFor = $other_details->looking_for ?? [];

    // Convert string to array if needed
    if (is_string($selectedLookingFor)) {
        $selectedLookingFor = explode(',', $selectedLookingFor);
    }

    // Get selected options' names
    $lookingForLabels = array_intersect_key($lookingForOptions, array_flip($selectedLookingFor));

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