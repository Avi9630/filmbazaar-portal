<!-- Gaming & E-sports -->
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
           
            @if(!empty($other_details->type_stage))
    @php
        // Define the stage types
        $stageTypes = [
            1 => "Development",
            2 => "Work In Progress",
            3 => "Ready for Release",
        ];

        // Get the stage name based on the stored value
        $stageName = $stageTypes[$other_details->type_stage] ?? 'Unknown';
    @endphp

    <tr>
        <th scope="row">Stage</th>
        <td>{{ $stageName }}</td>
    </tr>
@endif

@if(!empty($other_details->type_format))
    @php
        // Define the format types
        $formatTypes = [
            1 => "Single Player",
            2 => "Multiplayer",
            3 => "Educational",
            4 => "Real-time Strategy",
        ];

        // Get the format name based on the stored value
        $formatName = $formatTypes[$other_details->type_format] ?? 'Unknown';
    @endphp

    <tr>
        <th scope="row">Format</th>
        <td>{{ $formatName }}</td>
    </tr>
@endif


@if(!empty($other_details->type_platform))
    @php
        // Define the platform types
        $platformTypes = [
            1 => "PC",
            2 => "Console",
            3 => "Mobile",
            4 => "AR / VR",
        ];

        // Get the platform name based on the stored value
        $platformName = $platformTypes[$other_details->type_platform] ?? 'Unknown';
    @endphp

    <tr>
        <th scope="row">Platform</th>
        <td>{{ $platformName }}</td>
    </tr>
@endif

@if(!empty($other_details->targetGroup))
    @php
        // Define the target group types
        $targetGroups = [
            1 => "PreSchool",
            2 => "Kids",
            3 => "PreTeen",
            4 => "Young Adults",
            5 => "Adults",
        ];

        // Get the target group name based on the stored value
        $targetGroupName = $targetGroups[$other_details->targetGroup] ?? 'Unknown';
    @endphp

    <tr>
        <th scope="row">Target Group</th>
        <td>{{ $targetGroupName }}</td>
    </tr>
@endif

<tr>
                <td><strong>English</strong></td>
                <td>{{$film->english_title ?? ''}}</td>
            </tr>

            <tr>
                <td><strong>Countries of production</strong></td>
                <td>to do</td>
            </tr>
            <tr>
                <td><strong>Original Language</strong></td>
                <td>to do</td>
            </tr>
            <tr>
                <td><strong>Dubbed or subtitles languages, If available :</strong></td>
                <td>{{$other_details->dubbed_language ?? ''}}</td>
            </tr>
            <tr>
                <td><strong>Rights & territory Available :</strong></td>
                <td>{{ $other_details->rights_territory ?? ''}}</td>
            </tr>
            <tr>
                <td><strong>Date of Completion:</strong></td>
                <td>{{ $other_details->completion_date ?? ''}}</td>
            </tr>
              
        </tbody>
    </table>
</div>

<div class="table-responsive">
 
    <table class="table table-striped table-list-view">
        <tbody>
        <tr>
                    <th colspan="2" style=" background: #462965; color: white;">Game Genre</th>
        </tr>


        @if(!empty($other_details->genre))
    @php
        // Define genre options
        $genreOptions = [
            1 => "Action",
            2 => "Adventure",
            3 => "Racing",
            4 => "Strategy",
            5 => "Simulation",
            6 => "RPG",
            7 => "FPS",
            8 => "Arcade",
            9 => "Survival",
            10 => "Sports",
            11 => "Other"
        ];

        // Convert genre field into an array (handle both array and comma-separated string cases)
        $selectedGenres = is_array($other_details->genre) 
            ? $other_details->genre 
            : explode(',', (string) $other_details->genre);

        // Get genre names, excluding "Other"
        $genreNames = array_map(fn($id) => $genreOptions[$id] ?? 'Unknown', array_filter($selectedGenres, fn($id) => $id != 11));

        // If "Other" is selected, append the custom input
        if (in_array(11, $selectedGenres)) {
            $genreNames[] = "Other: " . ($other_details->please_specify_genre ?? 'Not specified');
        }
    @endphp
    <tr>
        <td><strong>Game Genre:</strong></td>
        <td>{{ implode(', ', $genreNames) }}</td>
    </tr>
@endif        
        </tbody>
    </table> 
</div>

<div class="table-responsive">
 
    <table class="table table-striped table-list-view">
        <tbody>
        <tr>
                    <th colspan="2" style=" background: #462965; color: white;">Other Project Details
                    </th>
        </tr>
            <tr>
                <td><strong>Synopsis of Content :</strong></td>
                <td>{{ $film->synopsis ?? ''}}</td>
            </tr>  
            <tr>
                <td><strong>Creator's Note :</strong></td>
                <td>{{ $film->director_comment ?? ''}}</td>
            </tr>
            @if(!empty($other_details->concept))
    @php
        // Define the concept types
        $concepts = [ 
            1 => "Original",
            2 => "Adapted",
        ];

        // Get the concept name based on the stored value
        $conceptName = $concepts[$other_details->concept] ?? 'Unknown';
    @endphp

    <tr>
        <th scope="row">Concept :</th>
        <td>{{ $conceptName }}</td>
    </tr>
@endif

@if(!empty($other_details->concept) && $other_details->concept == 2)
    <tr>
        <th scope="row">Rights to Adaptation :</th>
        <td>
            @php
                $rightsToAdaptation = [
                    1 => "Yes",
                    2 => "No",
                ];
            @endphp
            {{ $rightsToAdaptation[$other_details->specify_rights] ?? 'Not specified' }}
        </td>
    </tr>
@endif


                       
        </tbody>
    </table>
</div>

<div class="table-responsive">
 
    <table class="table table-striped table-list-view">
        <tbody>
        <tr>
                    <th colspan="2" style=" background: #462965; color: white;">Preview Link
                    </th>
        </tr>
            <tr>
                <td><strong>Preview Link :</strong></td>
                <td>{{ $film->download_preview_link ??''}}</td>
            </tr>  
        </tbody>
    </table>
</div>



@if(!empty($film->note))
<div class="table-responsive">
    <table class="table table-striped table-list-view">
        <tbody>
            <tr>
                <th colspan="2" style="background: #462965; color: white;">Notes</th>
            </tr>
            <tr>
                <td><strong>Notes (if any) :</strong></td>
                <td>{{ $film->note }}</td>
            </tr>  
        </tbody>
    </table>
</div>
@endif


<div class="table-responsive">
 
    <table class="table table-striped table-list-view">
        <tbody>
        <tr>
                    <th colspan="2" style=" background: #462965; color: white;">At Waves Portal You are Looking For
                    </th>
        </tr>
            <tr>
                <td><strong>At Waves Portal You are Looking For</strong></td>
                <td>To do</td>
            </tr>  
        </tbody>
    </table>
</div>