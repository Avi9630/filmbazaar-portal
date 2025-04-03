<!-- CPM Feature View -->

<!-- Basic Information -->
<div class="table-responsive">
    {{ $film->category}}
    <table class="table table-striped table-list-view">
        <tbody>
        <tr>
                    <th colspan="2" style=" background: #462965; color: white;">Basic Information</th>
        </tr>
            <tr>
                <td><strong>Select type :</strong></td>
                <td>{{ !empty($film->videography_type)  ?  $film->videographyType($film->videography_type) : '' }}</td>
            </tr>
            <tr>
                <td><strong> Select format :</strong></td>
                <td>{{ !empty($film->format_type)  ?  $film->formatType($film->format_type) : '' }}</td>
            </tr>
            <tr>
                <td><strong> Select stage :</strong></td>
                <td>{{ !empty($film->stage_type)  ?  $film->stageType($film->stage_type) : '' }}</td>
            </tr>
            <tr>
                <td><strong> Origin of Country :</strong></td>
                <td>{{ implode(', ', $film::countries($film->country)) }}</td>
            </tr>
            @php
    // Define the target audience options
    $targetAudienceOptions = ["Kids", "Teens", "Adults", "Family", "General", "Niche", "Other"];

    // Default values
    $targetAudience = 'NA';
    $targetAudienceOther = 'NA';

    // Check if target_audience exists and is valid
    if (!empty($film->target_audience) && in_array($film->target_audience, $targetAudienceOptions)) {
        $targetAudience = $film->target_audience;
        
        // If 'Other' is selected, show the specified value
        if ($film->target_audience == "Other" && !empty($film->target_audience_other)) {
            $targetAudienceOther = $film->target_audience_other;
        }
    }
@endphp

<tr>
    <td><strong>Target Audience :</strong></td>
    <td>{{ $targetAudience }}</td>
</tr>

@if($film->target_audience == "Other")
<tr>
    <td><strong>Please Specify Other :</strong></td>
    <td>{{ $targetAudienceOther }}</td>
</tr>
@endif



@php
    // Define the film certification options
    $filmCertificationOptions = ["U", "PG-13", "A", "Other"];

    // Default values
    $filmCertification = 'NA';
    $filmCertificationOther = 'NA';

    // Check if film_certification exists and is valid
    if (!empty($film->film_certification) && in_array($film->film_certification, $filmCertificationOptions)) {
        $filmCertification = $film->film_certification;
        
        // If 'Other' is selected, show the specified value
        if ($film->film_certification == "Other" && !empty($film->film_certification_other)) {
            $filmCertificationOther = $film->film_certification_other;
        }
    }
@endphp

<tr>
    <td><strong>Intended Film Certification :</strong></td>
    <td>{{ $filmCertification }}</td>
</tr>

@if($film->film_certification == "Other")
<tr>
    <td><strong>Please Specify Certification :</strong></td>
    <td>{{ $filmCertificationOther }}</td>
</tr>
@endif

              
        </tbody>
    </table>
</div>

<!-- Project Information -->
<div class="table-responsive">
    <table class="table table-striped table-list-view">
        <tbody>
        <tr>
                    <th colspan="2" style=" background: #462965; color: white;">Project Information</th>
        </tr>
            <tr>
                <td><strong>English Title :</strong></td>
                <td>{{ $film->english_title ?? '' }}</td>
            </tr>
            <tr>
                <td><strong>Countries :</strong></td>
                <td>{{ implode(', ', $film::countries($film->country)) }}</td>
            </tr>
            <tr>
                <td><strong>Original Language :</strong></td>
                <td>{{ implode(', ', $film::languages($film->language)) }}</td>
            </tr>
            <tr>
    <td><strong>Anticipated Duration (Mins) :</strong></td>
    <td>{{ $film->anticipated_duration_per_episode ? $film->anticipated_duration_per_episode . ' Mins' : 'NA' }}</td>
</tr>

@if ($film->screenplay == "1" || $film->screenplay == "2")
    <tr>
        <td><strong>Screenplay :</strong></td>
        <td>{{ $film->screenplay == "1" ? "Original" : "Adapted" }}</td>
    </tr>
@else
    <tr>
        <td><strong>Screenplay :</strong></td>
        <td>NA</td>
    </tr>
@endif

<tr>
                <td><strong>Logline :</strong></td>
                <td>{{$film->series_logline ?? ''}}</td>
            </tr>
            <tr>
                <td><strong>Target Audience :</strong></td>
                <td>{{$film->target_audience ?? ''}}</td>
            </tr>
            <tr>
                <td><strong> Distribution & Marketing Strategies :</strong></td>
                <td>{{$film->duration_and_market_strategy ?? ''}}</td>
            </tr>
            <tr>
                <td><strong> Synopsis :</strong></td>
                <td>{{$film->synopsis ?? ''}}</td>
            </tr>
            <tr>
                <td><strong> Director`s Statement :</strong></td>
                <td>{{$film->director_comment ?? ''}}</td>
            </tr>
            <tr>
                <td><strong> Producer`s Statement :</strong></td>
                <td>{{$film->producer_note ?? ''}}</td>
            </tr>
            @php
    // Define the options
    $isPartOfOptions = [
        1 => "Film Market",
        2 => "Film Festival",
        3 => "Distribution"
    ];

    // Check if is_part_of exists and is valid
    $isPartOf = $isPartOfOptions[$film->is_part_of] ?? 'NA';
@endphp

<tr>
    <td><strong>Please mention if your project has been a part of :</strong></td>
    <td>{{ $isPartOf }}</td>
</tr>

            <tr>
                <td><strong>Please Specify Details :</strong></td>
                <td>{{$film->is_part_of_details ?? ''}}</td>
            </tr>



        </tbody>
    </table>
</div>

<!-- Genre -->
<div class="table-responsive">
    <table class="table table-striped table-list-view">
        <tbody>
        <tr>
                    <th colspan="2" style=" background: #462965; color: white;">Genre</th>
        </tr>
            <tr>
                <td><strong>Select Genres :</strong></td>
                <td>{{ $film->genre($film->genre) }}</td>
            </tr>              
        </tbody>
    </table>
</div>


<!-- Financial Information -->
<div class="table-responsive">
    <table class="table table-striped table-list-view">
        <tbody>
        <tr>
                    <th colspan="2" style=" background: #462965; color: white;">Financial Information</th>
        </tr>
            <tr>
                <td><strong>Total Budget</strong></td>
                <td>{{ $film->total_budget ?? "" }}</td>
            </tr>
            <tr>
                <td><strong>Financial Already Secured :</strong></td>
                <td>{{ $film->finacial_already_secured ?? "" }}</td>
            </tr>           
        </tbody>
    </table>
</div>


<!-- Attachments -->
<div class="table-responsive">
    <table class="table table-striped table-list-view">
        <tbody>
        <tr>
                    <th colspan="2" style=" background: #462965; color: white;">Attachment</th>
                </tr>
            @foreach ($documentsArray as $key=>$document)
                    @if ($document['type'] == 4)
                        <tr>
                            <td><strong>Production Plan :</strong></td>
                            <td><a target="_blank" href="{{'https://wavesbazaar.com/api/project/file/read/'.$document['url']}}">{{ $document['name']}}</a></td>
                        </tr>
                    @elseif ($document['type'] == 5)
                        <tr>
                            <td><strong>Story Outline (max 12 Pages) :</strong></td>
                            <td><a target="_blank" href="{{'https://wavesbazaar.com/api/project/file/read/'.$document['url']}}">{{  $document['name']}}</a></td>
                        </tr>
                        @elseif ($document['type'] == 6)
                        <tr>
                            <td><strong>Tentative Timeline :</strong></td>
                            <td><a target="_blank" href="{{'https://wavesbazaar.com/api/project/file/read/'.$document['url']}}">{{  $document['name']}}</a></td>
                        </tr>
                        @elseif ($document['type'] == 8)
                        <tr>
                            <td><strong>Project Image  :</strong></td>
                            <td><a target="_blank" href="{{'https://wavesbazaar.com/api/project/file/read/'.$document['url']}}">{{  $document['name']}}</a></td>
                        </tr>
                    @endif
               
            @endforeach
        </tbody>
    </table>
</div>



<!--  At Waves You are Looking For -->
<div class="table-responsive">
    <table class="table table-striped table-list-view">
        <tbody>
            <tr>
                <th colspan="2" style="background: #462965; color: white;">
                    At Waves You are Looking For
                </th>
            </tr>
            @if(!empty($film->looking_for))
                @php
                    // Define the looking for options
                    $lookingForOptions = [
                        1 => "Gap Financing/Finishing Funds/P&A Funds",
                        2 => "Sales and Distribution",
                        3 => "Film Festival",
                        4 => "Sales Agent",
                        5 => "Distributors",
                    ];

                    // Convert the stored values into an array (handle JSON or comma-separated string)
                    $lookingForArray = is_array($film->looking_for) 
                        ? $film->looking_for 
                        : json_decode($film->looking_for, true);

                    // If decoding fails, try treating it as a comma-separated string
                    if (!is_array($lookingForArray)) {
                        $lookingForArray = explode(',', $film->looking_for);
                    }

                    // Get the selected names
                    $selectedLookingFor = array_map(fn($id) => $lookingForOptions[$id] ?? 'Unknown', $lookingForArray);
                @endphp

                <tr>
                    <td><strong>At Waves Portal You are Looking For :</strong></td>
                    <td>{{ implode(', ', $selectedLookingFor) }}</td>
                </tr>
            @else
                <tr>
                    <td><strong>At Waves Portal You are Looking For :</strong></td>
                    <td>No options selected</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>



