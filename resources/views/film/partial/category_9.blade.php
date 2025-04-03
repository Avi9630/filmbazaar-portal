<!-- Animation & VFX Services -->
<div class="table-responsive">
    {{ $film->category}}
    <table class="table table-striped table-list-view">
        <tbody>
        <tr>
                    <th colspan="2" style=" background: #462965; color: white;">Basic Information</th>
        </tr>
            <!-- <tr>
                <td><strong>Film Maker ID</strong></td>
                <td>{{ $film->film_maker_id }}</td>
            </tr> -->
            <tr>
                <td><strong>Title</strong></td>
                <td>{{ $film->title }}</td>
            </tr>
            @php
    // Define category segments
    $categories = [
        1 => "Film",
        2 => "TV/Webseries",
        3 => "Gaming and Esports",
        4 => "Radio and Podcasts",
        5 => "Music and Sound",
        6 => "Advertising",
        7 => "Influencer Marketing",
        8 => "Comics Or Graphics",
        9 => "Animation & VFX Services",
        10 => "Print (Newspapers, Magazine)",
        11 => "Live Event",
        13 => "AR/VR",
    ];

    // Get the category name based on $film->category
    $segment = isset($film->category) && isset($categories[$film->category]) 
        ? $categories[$film->category] 
        : 'NA';
@endphp

<tr>
    <td><strong>Segment</strong></td>
    <td>{{ $segment }}</td>
</tr>
           

            @php
    // Define category types
    $categoryTypes = [
        1 => "Animation",
        2 => "VFX",
    ];

    // Get the category type based on $film->category_type
    $category = isset($other_details->category_type) && isset($categoryTypes[$other_details->category_type]) 
        ? $categoryTypes[$other_details->category_type] 
        : 'NA';
@endphp

<tr>
    <td><strong>Category</strong></td>
    <td>{{ $category }}</td>
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

            @php
    // Define options for "Looking For"
    $lookingForOptions = [
        1 => "Gaming companies",
        2 => "Ad agencies",
        3 => "Film Production companies",
        4 => "International studios",
        5 => "Others",
    ];

    // Convert looking_for to an array (handles cases where it's stored as a string)
    $lookingFor = isset($other_details->looking_for) ? (is_array($other_details->looking_for) ? $other_details->looking_for : explode(',', $other_details->looking_for)) : [];

    // Get selected options
    $selectedOptions = [];
    foreach ($lookingFor as $key) {
        $key = (int) $key; // Ensure it's an integer
        if (isset($lookingForOptions[$key])) {
            $selectedOptions[] = $lookingForOptions[$key];
        }
    }

    // If "Others" is selected, append the "please_specify_looking_for" value
    if (in_array(5, $lookingFor) && !empty($other_details->please_specify_looking_for)) {
        $selectedOptions[] = $other_details->please_specify_looking_for;
    }

    // Final output
    $lookingForText = !empty($selectedOptions) ? implode(', ', $selectedOptions) : 'NA';
@endphp

<tr>
    <td><strong>At Waves Portal You are Looking For</strong></td>
    <td>{{ $lookingForText }}</td>
</tr>

        </tbody>
    </table>
</div>