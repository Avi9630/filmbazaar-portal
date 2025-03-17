<!-- Newspaper -->
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
                @if(!empty($other_details->printing_service_type))
    @php
        // Define the printing service types
        $printingServiceTypes = [
            1 => "Newspaper",
            2 => "Magazines",
            3 => "Flyers",
            4 => "Books",
            5 => "Others",
        ];

        // Get the printing service name based on the stored value
        $printingServiceName = $printingServiceTypes[$other_details->printing_service_type] ?? 'Unknown';
    @endphp

    <tr>
        <th scope="row">Type of Printing Services</th>
        <td>{{ $printingServiceName }}</td>
    </tr>

    @if($other_details->printing_service_type == 5 && !empty($other_details->printing_service_other_reason))
        <tr>
            <th scope="row">If Others, please specify</th>
            <td>{{ $other_details->printing_service_other_reason }}</td>
        </tr>
    @endif
@endif


@if(!empty($other_details->printing_capability_type))
    @php
        // Define the printing capability types
        $printingCapabilityTypes = [
            1 => "Offset",
            2 => "Digital",
            3 => "Flexographics",
            4 => "Screen Printing",
            5 => "Others",
        ];

        // Get the printing capability name based on the stored value
        $printingCapabilityName = $printingCapabilityTypes[$other_details->printing_capability_type] ?? 'Unknown';
    @endphp

    <tr>
        <th scope="row">Printing Capabilities</th>
        <td>{{ $printingCapabilityName }}</td>
    </tr>

    @if($other_details->printing_capability_type == 5 && !empty($other_details->printing_capability_other_reason))
        <tr>
            <th scope="row">If Others, please specify</th>
            <td>{{ $other_details->printing_capability_other_reason }}</td>
        </tr>
    @endif
@endif


@if(!empty($other_details->production_support_type))
    @php
        // Define the production support types
        $productionSupportTypes = [
            1 => "Yes",
            2 => "No",
        ];

        // Get the production support name based on the stored value
        $productionSupportName = $productionSupportTypes[$other_details->production_support_type] ?? 'Unknown';
    @endphp

    <tr>
        <th scope="row">Editing & Post- Production Support </th>
        <td>{{ $productionSupportName }}</td>
    </tr>
@endif

        </tbody>
    </table>
</div>

<div class="table-responsive">
    <table class="table table-striped table-list-view">
        <tbody>
        <tr>
                    <th colspan="2" style=" background: #462965; color: white;">Manpower Support</th>
                </tr>
           

        </tbody>
        <tbody>
    {{-- Editors & Designers --}}
    @if(!empty($other_details->editors_designers))
        @php
            $experienceOptions = [
                1 => "Freshers",
                2 => "Experience",
                3 => "Both",
                4 => "Not Available"
            ];
            $editorsDesigners = $experienceOptions[$other_details->editors_designers] ?? 'Unknown';
        @endphp

        <tr>
            <th scope="row">Editors & Designers :</th>
            <td>{{ $editorsDesigners }}</td>
        </tr>

        @if(in_array($other_details->editors_designers, [1, 2, 3]) && !empty($other_details->editors_designers_skills))
            <tr>
                <th scope="row">Specify Skills :</th>
                <td>{{ $other_details->editors_designers_skills }}</td>
            </tr>
        @endif
    @endif

    {{-- Printing Machine Operators --}}
    @if(!empty($other_details->machine_operators))
        @php
            $machineOperators = $experienceOptions[$other_details->machine_operators] ?? 'Unknown';
        @endphp

        <tr>
            <th scope="row">Printing Machine Operators :</th>
            <td>{{ $machineOperators }}</td>
        </tr>

        @if(in_array($other_details->machine_operators, [1, 2, 3]) && !empty($other_details->machine_operators_skills))
            <tr>
                <th scope="row">Specify Skills :</th>
                <td>{{ $other_details->machine_operators_skills }}</td>
            </tr>
        @endif
    @endif

    {{-- Camera Crew & Technicians --}}
    @if(!empty($other_details->camera_crew))
        @php
            $cameraCrew = $experienceOptions[$other_details->camera_crew] ?? 'Unknown';
        @endphp

        <tr>
            <th scope="row">Camera Crew & Technicians :</th>
            <td>{{ $cameraCrew }}</td>
        </tr>

        @if(in_array($other_details->camera_crew, [1, 2, 3]) && !empty($other_details->camera_crew_skills))
            <tr>
                <th scope="row">Specify Skills :</th>
                <td>{{ $other_details->camera_crew_skills }}</td>
            </tr>
        @endif
    @endif

    {{-- Anchors & Presenters --}}
    @if(!empty($other_details->anchors_presenters))
        @php
            $anchorsPresenters = $experienceOptions[$other_details->anchors_presenters] ?? 'Unknown';
        @endphp

        <tr>
            <th scope="row">Anchors & Presenters :</th>
            <td>{{ $anchorsPresenters }}</td>
        </tr>

        @if(in_array($other_details->anchors_presenters, [1, 2, 3]) && !empty($other_details->anchors_presenters_skills))
            <tr>
                <th scope="row">Specify Skills :</th>
                <td>{{ $other_details->anchors_presenters_skills }}</td>
            </tr>
        @endif
    @endif

    {{-- Scriptwriters & Content Creators --}}
    @if(!empty($other_details->scriptwriters))
        @php
            $scriptwriters = $experienceOptions[$other_details->scriptwriters] ?? 'Unknown';
        @endphp

        <tr>
            <th scope="row">Scriptwriters & Content Creators :</th>
            <td>{{ $scriptwriters }}</td>
        </tr>

        @if(in_array($other_details->scriptwriters, [1, 2, 3]) && !empty($other_details->scriptwriters_skills))
            <tr>
                <th scope="row">Specify Skills :</th>
                <td>{{ $other_details->scriptwriters_skills }}</td>
            </tr>
        @endif
    @endif

    {{-- Technical Support & Engineers --}}
    @if(!empty($other_details->technical_support))
        @php
            $technicalSupport = $experienceOptions[$other_details->technical_support] ?? 'Unknown';
        @endphp

        <tr>
            <th scope="row">Technical Support & Engineers :</th>
            <td>{{ $technicalSupport }}</td>
        </tr>

        @if(in_array($other_details->technical_support, [1, 2, 3]) && !empty($other_details->tech_skills))
            <tr>
                <th scope="row">Specify Skills :</th>
                <td>{{ $other_details->tech_skills }}</td>
            </tr>
        @endif
    @endif

    {{-- Any Other Support --}}
    @if(!empty($other_details->other_support))
        <tr>
            <th scope="row">Any Other Support you may have?</th>
            <td>{{ $other_details->other_support }}</td>
        </tr>
    @endif
</tbody>

    </table>
</div>

<div class="table-responsive">
    <table class="table table-striped table-list-view">
        <tbody>
        <tr>
                    <th colspan="2" style=" background: #462965; color: white;">Experience & Portfolio</th>
                </tr>
            <tr>
                <td><strong>Years of Experience in Print/Broadcasting</strong></td>
                <td>{{ $other_details->years_experience ?? ''}}</td>
            </tr>
            <tr>
                <td><strong>Brands Worked With</strong></td>
                <td>{{ $other_details->brands_worked ?? ''}}</td>
            </tr>
            <tr>
                <td><strong>Unique Selling Point / Why anyone should hire you? </strong></td>
                <td>{{ $other_details->unique_selling_point ?? ''}}</td>
            </tr>
            <tr>
                <td><strong>Testimonials </strong></td>
                <td>{{ $other_details->testimonials ?? ''}}</td>
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
                <td><strong>Synopsis</strong></td>
                <td>{{ $film->synopsis ?? ''}}</td>
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
                <td>{{ $film->download_preview_link ?? ''}}</td>
            </tr>
            <tr>
                <td><strong>Other Work Links</strong></td>
                <td>{{ $other_details->other_worke_link ?? ''}}</td>
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
                <td>{{ $film->note ?? ''}}</td>
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
                <td>{{ $other_details->looking_for_text ?? ''}}</td>
            </tr>
           

        </tbody>
    </table>
</div>
