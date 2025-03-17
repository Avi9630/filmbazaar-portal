<!-- Comics Or Graphics -->
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
        @if(!empty($other_details->type_stage))
    @php
        // Define the segment types
        $selectSegmentTypes = [
            1 => "Work In Progress",
            2 => "Completed",
        ];

        // Get the stage name based on the stored value
        $stageName = $selectSegmentTypes[$other_details->type_stage] ?? 'Unknown';
    @endphp

    <tr>
        <td><strong>Select Stage</strong></td>
        <td>{{ $stageName }}</td>
    </tr>
@endif

           
            <tr>
                <td><strong>Countries of Production</strong></td>
                <td>To Do</td>
            </tr>
            <tr>
                <td><strong>Original Language</strong></td>
                <td>To do</td>
            </tr>
            <tr>
                <td><strong>Type of Content </strong></td>
                <td>{{$film->type_of_content ?? ''}}</td>
            </tr>
            <tr>
                <td><strong>Expected Date of Completion </strong></td>
                <td>{{$other_details->expected_date ??''}}</td>
            </tr>
            <tr>
                <td><strong>No. of Pages Ready </strong></td>
                <td>{{$other_details->page_ready ??''}}</td>
            </tr>
            <tr>
                <td><strong>Any Work Remaining ? </strong></td>
                <td>{{$other_details->work_remaining ??''}}</td>
            </tr>
            <tr>
                <td><strong>Final Page Length </strong></td>
                <td>{{$other_details->page_length ??''}}</td>
            </tr>
            @if(!empty($other_details->content_original))
    @php
        // Define content originality types
        $contentOriginalTypes = [
            1 => "Original Content",
            2 => "Adapted Content",
            3 => "Public Domain",
        ];

        // Get the content original name based on the stored value
        $contentOriginalName = $contentOriginalTypes[$other_details->content_original] ?? 'Unknown';
    @endphp

    <tr>
        <td><strong>Content Original</strong></td>
        <td>{{ $contentOriginalName }}</td>
    </tr>
@endif

@if(!empty($other_details->content_original) && $other_details->content_original == 2)
    @if(isset($other_details->specify_rights))
        <tr>
            <th scope="row">Specify if you have the rights to adaptation to the original work?</th>
            <td>{{ $other_details->specify_rights ? "Original" : "Adapted" }}</td>
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
                    <th colspan="2" style=" background: #462965; color: white;">Other Project Details</th>
        </tr>
            <tr>
                <td><strong>Synopsis of Content</strong></td>
                <td>{{ $film->synopsis ??'' }}</td>
            </tr>
            <tr>
                <td><strong>Creator's Notes</strong></td>
                <td>{{ $film->director_comment ??'' }}</td>
            </tr>
            <tr>
                <td><strong>Unique Selling Point of the project</strong></td>
                <td>{{$other_details ->unique_selling ??''}}</td>
            </tr>
           
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
                <td><strong>Downloadable Preview Link :</strong></td>
                <td>{{ $film->download_preview_link ??''}}</td>
            </tr>
            <tr>
                <td><strong>Other Work Links :</strong></td>
                <td>{{ $other_details->other_worke_link ??''}}</td>
            </tr>    
        </tbody>
    </table>
</div>

<div class="table-responsive">
    <table class="table table-striped table-list-view">
        <tbody>
        <tr>
                    <th colspan="2" style=" background: #462965; color: white;">Notes
                    </th>
        </tr>
            <tr>
                <td><strong>Notes (If Any) :</strong></td>
                <td>{{ $film->note ??''}}</td>
            </tr>
           
        </tbody>
    </table>
</div>

<div class="table-responsive">
    <table class="table table-striped table-list-view">
        <tbody>
        <tr>
                    <th colspan="2" style=" background: #462965; color: white;">At Waves Portal You are Looking For
                    </th>
        </tr>
        @if(!empty($other_details->looking_for))
    @php
        // Define the looking for options
        $lookingForOptions = [
            1 => "Publishing Opportunity",
            2 => "Licensing",
            3 => "IP Sale",
        ];

        // Convert the stored values into an array
        $lookingForArray = is_array($other_details->looking_for) 
                            ? $other_details->looking_for 
                            : explode(',', $other_details->looking_for);

        // Get the selected names
        $selectedLookingFor = array_map(fn($id) => $lookingForOptions[$id] ?? 'Unknown', $lookingForArray);
    @endphp

    <tr>
        <td><strong>At Waves Portal You are Looking For :</strong></td>
        <td>{{ implode(', ', $selectedLookingFor) }}</td>
    </tr>
@endif

            
        </tbody>
    </table>
</div>