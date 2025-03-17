<div class="table-responsive">
    
    <table class="table table-striped table-list-view">
        <tbody>
            <tr>
                <td><strong>Film Maker ID</strong></td>
                <td>{{ $film->film_maker_id }}</td>
            </tr>
            <tr>
                <td><strong>Title</strong></td>
                <td>{{ $film->title }}</td>
            </tr>
            <tr>
                <td><strong>English Title</strong></td>
                <td>{{ $film->english_title ?? '' }}</td>
            </tr>
            <tr>
                <td><strong>Language ID</strong></td>
                <td>{{ $film->language_id ?? '' }}</td>
            </tr>
            <tr>
                <td><strong>Type</strong></td>
                <td>{{ !empty($film->type)  ?  $film->type($film->type) : '' }}</td>
            </tr>
            <tr>
                <td><strong>Is Film Complete</strong></td>
                <td>{{ $film->is_film_complete ?? '' }}</td>
            </tr>
            <tr>
                <td><strong>Duration</strong></td>
                <td>{{ $film->duration ?? '' }}</td>
            </tr>
            <tr>
                <td><strong>Month of Completion</strong></td>
                {{-- <td>{{ $film->month_of_completion ?? '' }}</td> --}}
                <td>{{ !empty($film->month_of_completion)  ?  $film->monthName($film->month_of_completion) : '' }}</td>
            </tr>
            <tr>
                <td><strong>Year of Completion</strong></td>
                <td>{{ $film->year_of_completion ?? '' }}</td>
            </tr>
            <tr>
                <td><strong>Synopsis</strong></td>
                <td>{{ $film->synopsis ?? '' }}</td>
            </tr>
            <tr>
                <td><strong>Director Comment</strong></td>
                <td>{{ $film->director_comment ?? '' }}</td>
            </tr>
            <tr>
                <td><strong>Screenplay</strong></td>
                {{-- <td>{{ $film->screenplay ?? '' }}</td> --}}
                <td>{{ isset($film->screenplay) && !empty($film->screenplay) && $film->screenplay == 1 ? 'Original' :($film->screenplay == 2 ? 'Adopted' : '') }}</td>
            </tr>
            <tr>
                <td><strong>Print Format</strong></td>

                <td>{{ !empty($film->print_format)  ?  $film->printFormat($film->print_format) : '' }}</td>
            </tr>
            <tr>
                <td><strong>Aspect Ratio</strong></td>
                {{-- <td>{{ $film->aspect_ratio ?? '' }}</td> --}}
                <td>{{ !empty($film->aspect_ratio)  ?  $film->aspectRatio($film->aspect_ratio) : '' }}</td>
            </tr>
            <tr>
                <td><strong>Sound Format</strong></td>
                {{-- <td>{{ $film->sound_format ?? '' }}</td> --}}
                <td>{{ !empty($film->sound_format)  ?  $film->soundFormat($film->sound_format) : '' }}</td>
            </tr>
            <tr>
                <td><strong>Lead Cast</strong></td>
                <td>{{ $film->lead_cast ?? '' }}</td>
            </tr>
            <tr>
                <td><strong>Writer</strong></td>
                <td>{{ $film->writer ?? '' }}</td>
            </tr>
            <tr>
                <td><strong>Director of Photography</strong></td>
                <td>{{ $film->director_of_photography ?? '' }}</td>
            </tr>
            <tr>
                <td><strong>Editor</strong></td>
                <td>{{ $film->editor ?? '' }}</td>
            </tr>
            <tr>
                <td><strong>Editor Filmography</strong></td>
                <td>{{ $film->editor_filmography ?? '' }}</td>
            </tr>
            <tr>
                <td><strong>Sound</strong></td>
                <td>{{ $film->sound ?? '' }}</td>
            </tr>
            <tr>
                <td><strong>Music</strong></td>
                <td>{{ $film->music ?? '' }}</td>
            </tr>
            <tr>
                <td><strong>Production Design</strong></td>
                <td>{{ $film->production_design ?? '' }}</td>
            </tr>
            <tr>
                <td><strong>Costume</strong></td>
                <td>{{ $film->costume ?? '' }}</td>
            </tr>
            <tr>
                <td><strong>Additional Crew</strong></td>
                <td>{{ $film->additional_crew ?? '' }}</td>
            </tr>
            <tr>
                <td><strong>Download Preview Link</strong></td>
                <td>{{ $film->download_preview_link ?? '' }}</td>
            </tr>
            <tr>
                <td><strong>Preview Link Password</strong></td>
                <td>{{ $film->preview_link_password ?? '' }}</td>
            </tr>
            <tr>
                <td><strong>Note</strong></td>
                <td>{{ $film->note ?? '' }}</td>
            </tr>
            <tr>
                <td><strong>Created At</strong></td>
                <td>{{ $film->createdAt }}</td>
            </tr>
            <tr>
                <td><strong>Updated At</strong></td>
                <td>{{ $film->updatedAt }}</td>
            </tr>
            <tr>
                <td><strong>Genre</strong></td>
                {{-- <td>{{ $film->genre ?? '' }}</td> --}}
                <td>{{ $film->genre($film->genre) }}</td>
            </tr>
            <tr>
                <td><strong>Film Festival Travel</strong></td>
                <td>{{ $film->film_festival_travel ?? '' }}</td>
            </tr>
            <tr>
                <td><strong>Film Festival Details</strong></td>
                <td>{{ $film->film_festival_details ?? '' }}</td>
            </tr>
            <tr>
                <td><strong>Awards Won</strong></td>
                <td>{{ $film->awards_won ?? '' }}</td>
            </tr>
            <tr>
                <td><strong>Theatrical Release</strong></td>
                <td>{{ $film->theatrical_release ?? '' }}</td>
            </tr>
            <tr>
                <td><strong>Release Regions & Dates</strong></td>
                <td>{{ $film->release_regions_dates ?? '' }}</td>
            </tr>
            <tr>
                <td><strong>Telecast on TV</strong></td>
                <td>{{ $film->telecast_on_tv ?? '' }}</td>
            </tr>
            <tr>
                <td><strong>Available on Internet</strong></td>
                <td>{{ $film->available_on_internet ?? '' }}</td>
            </tr>
            <tr>
                <td><strong>DVD Release</strong></td>
                <td>{{ $film->dvd_release ?? '' }}</td>
            </tr>
            <tr>
                <td><strong>Available for Public Viewing</strong></td>
                <td>{{ $film->available_for_public_viewing ?? '' }}</td>
            </tr>
            <tr>
                <td><strong>Country</strong></td>
                <td>{{ implode(', ', $film::countries($film->country)) }}</td>
            </tr>
            <tr>
                <td><strong>Language</strong></td>
                <td>{{ implode(', ', $film::languages($film->language)) }}</td>
            </tr>
            <tr>
                <td><strong>Has Rough Cut</strong></td>
                <td>{{ $film->has_rough_cut ?? '' }}</td>
            </tr>
            <tr>
                <td><strong>Expected Rough Cut Date</strong></td>
                <td>{{ $film->expected_rough_cut_date ?? '' }}</td>
            </tr>
            <tr>
                <td><strong>Post Production Work</strong></td>
                <td>{{ $film->post_production_work ?? '' }}</td>
            </tr>
            <tr>
                <td><strong>Will Be Complete By</strong></td>
                <td>{{ $film->will_be_complete_by ?? '' }}</td>
            </tr>
            <tr>
                <td><strong>Rough Cut Duration</strong></td>
                <td>{{ $film->rough_cut_duration ?? '' }}</td>
            </tr>
            <tr>
                <td><strong>Category</strong></td>
                {{-- <td>{{ $film->category ?? '' }}</td> --}}
                <td>{{ !empty($film->category)  ?  $film->category($film->category) : '' }}</td>
            </tr>
            <tr>
                <td><strong>Videography Type</strong></td>
                {{-- <td>{{ $film->videography_type ?? '' }}</td> --}}
                <td>{{ !empty($film->videography_type)  ?  $film->videographyType($film->videography_type) : '' }}</td>
            </tr>
            <tr>
                <td><strong>Format Type</strong></td>
                {{-- <td>{{ $film->format_type ?? '' }}</td> --}}
                <td>{{ !empty($film->format_type)  ?  $film->formatType($film->format_type) : '' }}</td>
            </tr>
            <tr>
                <td><strong>Stage Type</strong></td>
                {{-- <td>{{ $film->stage_type ?? '' }}</td> --}}
                <td>{{ !empty($film->stage_type)  ?  $film->stageType($film->stage_type) : '' }}</td>
            </tr>
            <tr>
                <td><strong>Series Logline</strong></td>
                <td>{{ $film->series_logline ?? '' }}</td>
            </tr>
            <tr>
                <td><strong>Writer Statement</strong></td>
                <td>{{ $film->writer_statement ?? '' }}</td>
            </tr>
            <tr>
                <td><strong>Is Direct Your Script</strong></td>
                <td>{{ $film->is_direct_your_script ?? '' }}</td>
            </tr>

            <tr>
                <td><strong>Looking For</strong></td>
                <td>{{ $film->lookingFor($film->looking_for) }}</td>
            </tr>
            <tr>
                <td><strong>Anticipated Duration Per Episode</strong></td>
                <td>{{ $film->anticipated_duration_per_episode ?? '' }}</td>
            </tr>
            <tr>
                <td><strong>Number of Episodes</strong></td>
                <td>{{ $film->number_of_episode ?? '' }}</td>
            </tr>
            <tr>
                <td><strong>Series Based On</strong></td>
                <td>{{ $film->series_based_on ?? '' }}</td>
            </tr>
            <tr>
                <td><strong>Shooting Format</strong></td>
                <td>{{ $film->shooting_format ?? '' }}</td>
            </tr>
            <tr>
                <td><strong>Shooting Location</strong></td>
                <td>{{ $film->shoot_location ?? '' }}</td>
            </tr>
            <tr>
                <td><strong>Target Audience</strong></td>
                <td>{{ $film->target_audience ?? '' }}</td>
            </tr>
            <tr>
                <td><strong>Duration and Market Strategy</strong></td>
                <td>{{ $film->duration_and_market_strategy ?? '' }}</td>
            </tr>
            <tr>
                <td><strong>Short Synopsis</strong></td>
                <td>{{ $film->short_synopsis ?? '' }}</td>
            </tr>
            <tr>
                <td><strong>Producer Note</strong></td>
                <td>{{ $film->producer_note ?? '' }}</td>
            </tr>
            <tr>
                <td><strong>Is Part of</strong></td>
                <td>{{ $film->is_part_of ?? '' }}</td>
            </tr>
            <tr>
                <td><strong>Is Part of Details</strong></td>
                <td>{{ $film->is_part_of_details ?? '' }}</td>
            </tr>
            <tr>
                <td><strong>Total Budget</strong></td>
                <td>{{ $film->total_budget ?? '' }}</td>
            </tr>
            <tr>
                <td><strong>Financial Already Secured</strong></td>
                <td>{{ $film->finacial_already_secured ?? '' }}</td>
            </tr>
            <tr>
                <td><strong>Status</strong></td>
                <td>{{ $film->status ?? '' }}</td>
            </tr>
            <tr>
                <td><strong>Type of Content</strong></td>
                <td>{{ $film->type_of_content ?? '' }}</td>
            </tr>

        </tbody>
    </table>
</div>