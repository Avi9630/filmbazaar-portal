<!-- Influencer Marketing -->

@php
    // Define the compliance agreement options
    $complianceAgreements = [
        1 => "Brand Safety",
        2 => "ASCI Compliance",
        3 => "Exclusive Deals",
    ];

    // Check which options are selected
    $selectedAgreements = [];
    if (!empty($other_details->brand_safety)) {
        $selectedAgreements[] = $complianceAgreements[1];
    }
    if (!empty($other_details->asci_compliance)) {
        $selectedAgreements[] = $complianceAgreements[2];
    }
    if (!empty($other_details->exclusive_deals)) {
        $selectedAgreements[] = $complianceAgreements[3];
    }

    // Convert selected options to a comma-separated string
    $complianceText = !empty($selectedAgreements) ? implode(", ", $selectedAgreements) : "No options selected";
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
        @if(!empty($other_details->language_content))
    @php
        // Define the language options
        $selectLanguage = [
            1 => "English",
            2 => "Hindi",
            3 => "Regional (Specify)",
        ];

        // Convert stored values into an array (handles both comma-separated and array formats)
        $languageArray = is_array($other_details->language_content) 
                        ? $other_details->language_content 
                        : explode(',', $other_details->language_content);

        // Get the selected language names
        $selectedLanguages = array_map(fn($id) => $selectLanguage[$id] ?? 'Unknown', $languageArray);
    @endphp

    <tr>
        <td><strong>Language(s) Used in Content</strong></td>
        <td>{{ implode(', ', $selectedLanguages) }}</td>
    </tr>

    @if(in_array(3, $languageArray) && !empty($other_details->please_specify_lang))
        <tr>
            <td><strong>Please Specify Language(s):</strong></td>
            <td>{{ $other_details->please_specify_lang }}</td>
        </tr>
    @endif
@endif

@if(!empty($other_details->primary_industry))
    @php
        // Define the industry options
        $selectIndustry = [
            1 => "Film & Entertainment",
            2 => "OTT & Digital Content",
            3 => "Gaming & Esports",
            4 => "Music & Podcasts",
            5 => "Travel & Lifestyle",
            6 => "Fashion & Beauty",
            7 => "Tech & Gadgets",
            8 => "Political Analyst",
            9 => "Other (Specify)",
        ];

        // Convert stored values into an array (handles both comma-separated and array formats)
        $industryArray = is_array($other_details->primary_industry) 
                        ? $other_details->primary_industry 
                        : explode(',', $other_details->primary_industry);

        // Get the selected industry names
        $selectedIndustries = array_map(fn($id) => $selectIndustry[$id] ?? 'Unknown', $industryArray);
    @endphp

    <tr>
        <td><strong>Primary Industry / Niche :</strong></td>
        <td>{{ implode(', ', $selectedIndustries) }}</td>
    </tr>

    @if(in_array(9, $industryArray) && !empty($other_details->please_specify_primary_industry))
        <tr>
            <td><strong>Please Specify Industry:</strong></td>
            <td>{{ $other_details->please_specify_primary_industry }}</td>
        </tr>
    @endif
@endif

@if(!empty($other_details->primary_platform))
    @php
        // Define the platform options
        $selectPlatform = [
            1 => "YouTube",
            2 => "Instagram",
            3 => "Twitter",
            4 => "Facebook",
            5 => "TikTok",
            6 => "LinkedIn",
            7 => "Blogs",
            8 => "Podcasts",
            9 => "Other (Specify)",
        ];

        // Convert stored values into an array (handles both array and comma-separated formats)
        $platformArray = is_array($other_details->primary_platform) 
                        ? $other_details->primary_platform 
                        : explode(',', $other_details->primary_platform);

        // Get the selected platform names
        $selectedPlatforms = array_map(fn($id) => $selectPlatform[$id] ?? 'Unknown', $platformArray);
    @endphp

    <tr>
        <td><strong>Primary Platform :</strong></td>
        <td>{{ implode(', ', $selectedPlatforms) }}</td>
    </tr>

    @if(in_array(9, $platformArray) && !empty($other_details->please_specify_primary_platform))
        <tr>
            <td><strong>Please Specify Platform:</strong></td>
            <td>{{ $other_details->please_specify_primary_platform }}</td>
        </tr>
    @endif
@endif

@if(!empty($other_details->subscriber_count))
    @php
        // Define the subscriber count options
        $subscriberCount = [
            1 => "Nano (1K - 10K)",
            2 => "Micro (10K - 100K)",
            3 => "Macro (100K - 1M)",
            4 => "Mega (1M+)",
        ];

        // Get the selected subscriber count name
        $subscriberCountName = $subscriberCount[$other_details->subscriber_count] ?? 'Unknown';
    @endphp

    <tr>
        <td><strong>Follower/Subscriber Count :</strong></td>
        <td>{{ $subscriberCountName }}</td>
    </tr>
@endif




@if(!empty($other_details->target_audience))
    @php
        // Define the target audience options
        $targetAudienceOptions = [
            1 => "Teens",
            2 => "Young Adults",
            3 => "Adults",
            4 => "Industry Professionals",
            5 => "Global Audience",
            6 => "Other (Specify)",
        ];

        // Convert stored values to an array (assuming it's stored as JSON or comma-separated string)
        $selectedAudiences = is_array($other_details->target_audience) 
            ? $other_details->target_audience 
            : explode(',', $other_details->target_audience);

        // Get the names of the selected target audiences
        $targetAudienceNames = array_map(function ($id) use ($targetAudienceOptions) {
            return $targetAudienceOptions[$id] ?? 'Unknown';
        }, $selectedAudiences);

        // Convert array to comma-separated string
        $targetAudienceText = implode(', ', $targetAudienceNames);
    @endphp

    <tr>
        <td><strong>Your Target Audience :</strong></td>
        <td>{{ $targetAudienceText }}</td>
    </tr>

    @if(in_array(6, $selectedAudiences) && !empty($other_details->please_specify_target_audience))
        <tr>
            <td><strong>Please Specify Target Audience :</strong></td>
            <td>{{ $other_details->please_specify_target_audience }}</td>
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
                    <th colspan="2" style=" background: #462965; color: white;">Services Offered as Seller</th>
        </tr>


        @if(!empty($other_details->service_offer))
    @php
        // Define the available services
        $serviceOfferOptions = [
            1 => "Sponsored Posts",
            2 => "Product Reviews",
            3 => "Brand Collaborations",
            4 => "Film & OTT Promotions",
            5 => "Event Coverage",
            6 => "Interviews & Talk Shows",
            7 => "Podcast Features",
            8 => "Cross-Promotions",
            9 => "Merchandise Sales",
            10 => "Affiliate Marketing",
            11 => "Digital Consulting",
        ];

        // Convert stored values to an array (assuming it's stored as JSON or comma-separated string)
        $selectedServices = is_array($other_details->service_offer) 
            ? $other_details->service_offer 
            : explode(',', $other_details->service_offer);

        // Get the names of the selected services
        $serviceOfferNames = array_map(function ($id) use ($serviceOfferOptions) {
            return $serviceOfferOptions[$id] ?? 'Unknown';
        }, $selectedServices);

        // Convert array to comma-separated string
        $serviceOfferText = implode(', ', $serviceOfferNames);
    @endphp

    <tr>
        <td><strong>Select Services You Offer</strong></td>
        <td>{{ $serviceOfferText }}</td>
    </tr>
@endif

@if(!empty($other_details->pricing_model))
    @php
        // Define the pricing model options
        $pricingModelOptions = [
            1 => "Fixed Fee",
            2 => "Performance-Based",
            3 => "Barter Collaboration",
            4 => "Revenue Share",
            5 => "Other (Specify)",
        ];

        // Get the selected pricing model name
        $pricingModelName = $pricingModelOptions[$other_details->pricing_model] ?? 'Unknown';
    @endphp

    <tr>
        <td><strong>Pricing Model</strong></td>
        <td>{{ $pricingModelName }}</td>
    </tr>

    @if($other_details->pricing_model == 5 && !empty($other_details->please_specify_pricing))
        <tr>
            <td><strong>Please Specify Pricing</strong></td>
            <td>{{ $other_details->please_specify_pricing }}</td>
        </tr>
    @endif
@endif


@if(!empty($other_details->content_format))
    @php
        // Define the content format options
        $contentFormatOptions = [
            1 => "Short Videos / Reels",
            2 => "Stories / Snippets",
            3 => "Long-Form Videos",
            4 => "Live Streaming",
            5 => "Blog / Written",
            6 => "Content",
            7 => "Podcasts / Audio Content",
            8 => "Other (Specify)",
        ];

        // Ensure $content_format is an array
        $selectedFormats = is_array($other_details->content_format) 
            ? $other_details->content_format 
            : explode(',', $other_details->content_format);

        // Get selected content format names
        $selectedFormatNames = array_map(fn($id) => $contentFormatOptions[$id] ?? 'Unknown', $selectedFormats);
    @endphp

    <tr>
        <td><strong>Content Format Specialization</strong></td>
        <td>{{ implode(', ', $selectedFormatNames) }}</td>
    </tr>

    @if(in_array(8, $selectedFormats) && !empty($other_details->please_specify_content_format))
        <tr>
            <td><strong>Please Specify Content Format</strong></td>
            <td>{{ $other_details->please_specify_content_format }}</td>
        </tr>
    @endif
@endif


@if(!empty($other_details->brand_collaborations))
    @php
        // Define the brand collaboration options
        $brandCollaborationOptions = [
            1 => "GOI (Specify)",
            2 => "Netflix",
            3 => "Google",
            4 => "Amazon",
            5 => "Other (Specify)",
        ];

        // Ensure brand_collaborations is an array
        $selectedBrands = is_array($other_details->brand_collaborations) 
            ? $other_details->brand_collaborations 
            : explode(',', $other_details->brand_collaborations);

        // Get selected brand names
        $selectedBrandNames = array_map(fn($id) => $brandCollaborationOptions[$id] ?? 'Unknown', $selectedBrands);
    @endphp

    <tr>
        <td><strong>Past Brand Collaborations</strong></td>
        <td>{{ implode(', ', $selectedBrandNames) }}</td>
    </tr>

    @if(in_array(1, $selectedBrands) && !empty($other_details->please_specify_brand_collaborations))
        <tr>
            <td><strong>Please Specify GOI Collaboration</strong></td>
            <td>{{ $other_details->please_specify_brand_collaborations }}</td>
        </tr>
    @endif

    @if(in_array(5, $selectedBrands) && !empty($other_details->please_specify_brand_collaborations))
        <tr>
            <td><strong>Please Specify Other Brand Collaboration</strong></td>
            <td>{{ $other_details->please_specify_brand_collaborations }}</td>
        </tr>
    @endif
@endif

@if(!empty($other_details->content_ownership))
    @php
        // Define the content ownership options
        $contentOwnershipOptions = [
            1 => "Full Rights to Buyer",
            2 => "Shared Rights",
            3 => "Limited Usage Rights",
        ];

        // Get the selected ownership name or set a default "Unknown" text
        $selectedOwnership = $contentOwnershipOptions[$other_details->content_ownership] ?? "Unknown";
    @endphp

    <tr>
        <td><strong>Content Ownership Rights</strong></td>
        <td>{{ $selectedOwnership }}</td>
    </tr>
@endif


           
        </tbody>
    </table>
</div>

<div class="table-responsive">
    
    <table class="table table-striped table-list-view">
        <tbody>
        <tr>
                    <th colspan="2" style=" background: #462965; color: white;">Compliance & Agreements</th>
        </tr>



<tr>
    <td><strong>Compliance & Agreements</strong></td>
    <td>{{ $complianceText }}</td>
</tr>
           
        </tbody>
    </table>
</div>


<div class="table-responsive">
    
    <table class="table table-striped table-list-view">
        <tbody>
        <tr>
                    <th colspan="2" style=" background: #462965; color: white;">Additional Information & Customisation</th>
        </tr>

        @php
    // Define the options for special events
    $specialEvents = [
        1 => "Yes",
        2 => "No",
    ];

    // Get the selected value from the database
    $selectedEvent = $other_details->special_events ?? null;

    // Display the corresponding text or "Not Specified"
    $specialEventText = $specialEvents[$selectedEvent] ?? "Not Specified";
@endphp

<tr>
    <td><strong>Availability for Special Events / Film Festivals :</strong></td>
    <td>{{ $specialEventText }}</td>
</tr>

           
            <tr>
                <td><strong>Comments or Additional Requests</strong></td>
                <td>{{ $other_details->additional_requests ?? '' }}</td>
            </tr>
        </tbody>
    </table>
</div>