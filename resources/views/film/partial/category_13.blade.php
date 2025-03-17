<!-- AR VR -->
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
                    <th colspan="2" style=" background: #462965; color: white;">Service Information</th>
                </tr>
            <tr>
               
                <tr>
    <td><strong>Select Category</strong></td>
   
    <td>
        {{ $selectCategory[$other_details->select_category ?? null] ?? 'Unknown' }}
    </td>
</tr>
            </tr>
            <tr>
                <td><strong>Select your expertise</strong></td>
                <td>      {{ $selectExpertise[$other_details->select_expertise ?? null] ?? 'Unknown' }}</td>
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
                <td>{{ $other_details->download_preview_link ?? ''}}</td>
            </tr>

        </tbody>
    </table>
</div>