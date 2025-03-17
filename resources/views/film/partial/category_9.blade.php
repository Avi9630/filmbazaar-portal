<!-- Animation & VFX Services -->
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
            <tr>
                <td><strong>Category </strong></td>
                <td>To do</td>
            </tr>
           

        </tbody>
    </table>
</div>

<div class="table-responsive">
   
    <table class="table table-striped table-list-view">
        <tbody>
        <tr>
                    <th colspan="2" style=" background: #462965; color: white;">Service information</th>
        </tr>
           
            @if(!empty($other_details->category_type))
    @if($other_details->category_type == 1)
        @if(!empty($other_details->animation_expertise_select))
           
            <tr>
                <th scope="row">Select the expertise:</th>
                <td>
                    @php
                        $selectedExpertise = is_array($other_details->animation_expertise_select) 
                            ? $other_details->animation_expertise_select 
                            : explode(',', (string) $other_details->animation_expertise_select);

                        // Define expertise options
                        $animationExpertise = [
                            1 => "2D",
                            2 => "3D",
                            3 => "Other", // This will be handled separately
                        ];

                        // Remove "Other" temporarily
                        $filteredExpertise = array_filter($selectedExpertise, fn($id) => $id != 3);

                        // Convert IDs to names
                        $expertiseNames = array_map(fn($id) => $animationExpertise[$id] ?? 'Unknown', $filteredExpertise);
                        
                        // If "Other" is selected, add user input
                        if (in_array(3, $selectedExpertise)) {
                            $expertiseNames[] = "Other : " . ($other_details->please_specify_animation_expertise_select ?? 'Not specified');
                        }
                    @endphp
                    {{ implode(', ', $expertiseNames) }}
                </td>
            </tr>
        @endif
    @elseif($other_details->category_type == 2)
        @if(!empty($other_details->expertise_select))
           
            <tr>
                <th scope="row">Select the expertise (Select 2 Minimum):</th>
                <td>
                    @php
                        $selectedExpertise = is_array($other_details->expertise_select) 
                            ? $other_details->expertise_select 
                            : explode(',', (string) $other_details->expertise_select);

                        // Define expertise options
                        $expertiseOptions = [
                            1 => "Creature FX",
                            2 => "Crowd FX",
                            3 => "Set Extensions",
                            4 => "World Building",
                            5 => "Virtual Production",
                            6 => "Others", // This will be handled separately
                        ];

                        // Remove "Other" temporarily
                        $filteredExpertise = array_filter($selectedExpertise, fn($id) => $id != 6);

                        // Convert IDs to names
                        $expertiseNames = array_map(fn($id) => $expertiseOptions[$id] ?? 'Unknown', $filteredExpertise);

                        // If "Other" is selected, add user input
                        if (in_array(6, $selectedExpertise)) {
                            $expertiseNames[] = "Other : " . ($other_details->please_specify_expertise_select ?? 'Not specified');
                        }
                    @endphp
                    {{ implode(', ', $expertiseNames) }}
                </td>
            </tr>
        @endif
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
                <td><strong>Preview Link</strong></td>
               
                <td>{{ $other_details->download_preview_link ?? ''}}</td>
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
                <td><strong>Notes (If Any) :</strong></td>
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
            <tr>
                <td><strong>At Waves Portal You are Looking For</strong></td>
                <td>To do</td>
            </tr>
        </tbody>
    </table>
</div>