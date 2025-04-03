<!-- Film View -->

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

<!-- Film information -->
<div class="table-responsive">
    <table class="table table-striped table-list-view">
        <tbody>
        <tr>
                    <th colspan="2" style=" background: #462965; color: white;">Film information</th>
        </tr>
            <tr>
                <td><strong>English Title :</strong></td>
                <td>{{ $film->english_title }}</td>
            </tr>
            <tr>
                <td><strong>Countries of production :</strong></td>
                <td>{{ implode(', ', $film::countries($film->country)) }}</td>
            </tr>
            <tr>
                <td><strong>Original Language :</strong></td>
                <td>{{ implode(', ', $film::languages($film->language)) }}</td>
            </tr>
            @php
    // Define film types
    $filmTypes = [
        1 => "Documentary Mid-length",
        2 => "Documentary Short",
        3 => "Fiction Mid-length",
        4 => "Fiction Short",
        5 => "Hybrid Feature",
        6 => "Fiction Feature",
        7 => "Documentary Feature",
        8 => "Animation Feature",
    ];

    // Get the film type based on $film->type
    $filmType = isset($film->type) && isset($filmTypes[$film->type]) 
        ? $filmTypes[$film->type] 
        : 'NA';
@endphp

<tr>
    <td><strong>Film Type</strong></td>
    <td>{{ $filmType }}</td>
</tr>
            <tr>
                <td><strong>Final Duration(Mins) :</strong></td>
                <td>{{$film->duration ?? ''}}</td>
            </tr>
            <tr>
           @php
    // Define month names
    $monthNames = [
        1 => "January",
        2 => "February",
        3 => "March",
        4 => "April",
        5 => "May",
        6 => "June",
        7 => "July",
        8 => "August",
        9 => "September",
        10 => "October",
        11 => "November",
        12 => "December",
    ];

    // Get the month name based on film->month_of_completion
    $monthName = $film->month_of_completion && isset($monthNames[$film->month_of_completion])
        ? $monthNames[$film->month_of_completion]
        : 'NA';
       @endphp

           </tr>
           

<tr>
    <td><strong>Month of Completion :</strong></td>
    <td>{{ $monthName }}</td>
</tr>
            <tr>
                <td><strong>Year of Completion :</strong></td>
                <td>{{$film->year_of_completion ?? ''}}</td>
            </tr>
              
        </tbody>
    </table>
</div>

<!-- Other Project Details -->
<div class="table-responsive">
    <table class="table table-striped table-list-view">
        <tbody>
        <tr>
                    <th colspan="2" style=" background: #462965; color: white;">Other Project Details</th>
        </tr>
            <tr>
                <td><strong>Synopsis of Film :</strong></td>
                <td>{{ $film->synopsis ?? '' }}</td>
            </tr>
            <tr>
                <td><strong>Director's Note :</strong></td>
                <td>{{ $film->director_comment ?? '' }}</td>
            </tr>
           
            
            @if($film->screenplay == "1" || $film->screenplay == "2")
    <tr>
        <td><strong>Screenplay Based on :</strong></td>
        <td>{{ $film->screenplay == "1" ? "Original" : "Adapted" }}</td>
    </tr>

    @if($film->screenplay == "2" && !empty($film->screenplay_description))
        <tr>
            <td><strong>Screenplay Description :</strong></td>
            <td>{{ $film->screenplay_description }}</td>
        </tr>
    @endif
@endif

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
            <tr>
                <td><strong>Print Format :</strong></td>
                <td>{{ !empty($film->print_format)  ?  $film->printFormat($film->print_format) : '' }}</td>
            </tr>
            <tr>
                <td><strong>Aspect ratio :</strong></td>
                <td>{{ !empty($film->aspect_ratio)  ?  $film->aspectRatio($film->aspect_ratio) : '' }}</td>
            </tr>
            <tr>
                <td><strong>Sound Format :</strong></td>
                <td>{{ !empty($film->sound_format)  ?  $film->soundFormat($film->sound_format) : '' }}</td>
            </tr>
              
        </tbody>
    </table>
</div>


</div>

<!-- Crew Information -->
<div class="table-responsive">
    <table class="table table-striped table-list-view">
        <tbody>
        <tr>
                    <th colspan="2" style=" background: #462965; color: white;">Crew Information</th>
        </tr>
            <tr>
                <td><strong>Lead Cast :</strong></td>
                <td>{{$film->lead_cast ?? ''}}</td>
            </tr>
            <tr>
                <td><strong>Writer:</strong></td>
                <td>{{$film->writer ?? ''}}</td>
            </tr>
            <tr>
                <td><strong>Director of Photography :</strong></td>
                <td>{{$film->director_of_photography ?? ''}}</td>
            </tr>
            <tr>
                <td><strong>Editor :</strong></td>
                <td>{{$film->editor ?? ''}}</td>
            </tr>
            <tr>
                <td><strong>Editor’s Filmography :</strong></td>
                <td>{{$film->editor_filmography ?? ''}}</td>
            </tr>
            <tr>
                <td><strong>Sound :</strong></td>
                <td>{{$film->sound ?? ''}}</td>
            </tr>
            <tr>
                <td><strong>Music :</strong></td>
                <td>{{$film->music ?? ''}}</td>
            </tr>
            <tr>
                <td><strong>Production Designer :</strong></td>
                <td>{{$film->production_design ?? ''}}</td>
            </tr>
            <tr>
                <td><strong>Costume :</strong></td>
                <td>{{$film->costume ?? ''}}</td>
            </tr>
            <tr>
                <td><strong>Additional Crew :</strong></td>
                <td>{{$film->additional_crew ?? ''}}</td>
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
                    @if ($document['type'] == 1)
                        <tr>
                            <td><strong>Film Stills :</strong></td>
                            <td><a target="_blank" href="{{'https://wavesbazaar.com/api/project/file/read/'.$document['url']}}">{{ $document['name']}}</a></td>
                        </tr>
                    @elseif ($document['type'] == 2)
                        <tr>
                            <td><strong>Poster of the Film  :</strong></td>
                            <td><a target="_blank" href="{{'https://wavesbazaar.com/api/project/file/read/'.$document['url']}}">{{  $document['name']}}</a></td>
                        </tr>
                        @elseif ($document['type'] == 3)
                        <tr>
                            <td><strong>Director Photo  :</strong></td>
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


<!-- Trailer Link -->
<div class="table-responsive">
    <table class="table table-striped table-list-view">
        <tbody>
        <tr>
                    <th colspan="2" style=" background: #462965; color: white;">Trailer Link</th>
        </tr>
            <tr>
                <td><strong> Downloadable Preview Link :</strong></td>
                <td>{{ $film->download_preview_link ?? '' }}</td>
            </tr>
            <tr>
                <td><strong> Preview Link Password :</strong></td>
                <td>{{ $film->preview_link_password ?? '' }}</td>
            </tr>              
        </tbody>
    </table>
</div>

<!-- Notes -->
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