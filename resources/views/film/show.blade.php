@extends('layouts.app')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('dashboard') }}">Home</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('film.fimindex') }}">Project</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
            Detail
        </li>
    </ol>
</nav>

<div class="innerpage mt-3 card p-3">

    <div class="page-title">
        <h2>Project Detail</h2>
    </div>
 

    @if ($film->category == 1 || $film->category == 2)
    @if ($film->stage_type == 1)
        @include('film.partial.script_view', compact('film', 'FilmMaker', 'other_details'))
    @elseif ($film->format_type == 4)
        @if ($film->stage_type == 4)
            @include('film.partial.cpm_feature_view', compact('film', 'FilmMaker', 'other_details'))
        @else
            @include('film.partial.cpm_web_series_view', compact('film', 'FilmMaker', 'other_details'))
        @endif
    @else
        @if ($film->stage_type == 4)
            @include('film.partial.film_view', compact('film', 'FilmMaker', 'other_details'))
        @else
            @include('film.partial.film_not_completed_view', compact('film', 'FilmMaker', 'other_details'))
        @endif
    @endif



 
    @elseif ($film->category == 3)
    @include('film.partial.category_3',compact('film', 'FilmMaker', 'other_details'))
    @elseif ($film->category == 4)
    @include('film.partial.category_4',compact('film', 'FilmMaker', 'other_details'))
    @elseif ($film->category == 5)
    @include('film.partial.category_5',compact('film', 'FilmMaker', 'other_details'))
    @elseif ($film->category == 6)
    @include('film.partial.category_6',compact('film', 'FilmMaker', 'other_details'))
    @elseif ($film->category == 7)
    @include('film.partial.category_7',compact('film', 'FilmMaker', 'other_details'))
    @elseif ($film->category == 8)
    @include('film.partial.category_8',compact('film', 'FilmMaker', 'other_details'))
    @elseif ($film->category == 9)
    @include('film.partial.category_9',compact('film', 'FilmMaker', 'other_details'))
    @elseif ($film->category == 10)
    @include('film.partial.category_10',compact('film', 'FilmMaker', 'other_details'))
    @elseif ($film->category == 11)
    @include('film.partial.category_11',compact('film', 'FilmMaker', 'other_details'))
    @elseif ($film->category == 13)
    @include('film.partial.category_13',compact('film', 'FilmMaker', 'other_details'))

    @else
    
    @include('film.partial.default',compact('film', 'FilmMaker', 'other_details'))
    @endif
    <table class="table">
    <tr>
                    <th colspan="2" style=" background: #462965; color: white;">Contact</th>
                </tr>
    @foreach ($contactDetails as $key => $contact)
       
        @include('film._contact_details', ['contact' => $contact, 'key' => $key])
    @endforeach
</table>
 @if (! ($film->category == 1 || $film->category == 2))
<table class="table">
           
            <tr>
                    <th colspan="2" style=" background: #462965; color: white;">Attachment</th>
                </tr>
            @foreach ($documentsArray as $key=>$document)
           
                    @if ($document['type'] == 8)
                        <tr>
                            <td><strong>Project Image :</strong></td>
                            <td><a target="_blank" href="{{'https://wavesbazaar.com/api/project/file/read/'.$document['url']}}">{{ $document['name']}}</a></td>
                        </tr>
                    @elseif ($document['type'] == 131)
                        <tr>
                            <td><strong>Pitch Deck : </strong></td>
                            <td><a target="_blank" href="{{'https://wavesbazaar.com/api/project/file/read/'.$document['url']}}">{{  $document['name']}}</a></td>
                        </tr>
                        @elseif ($document['type'] == 81)
                        <tr>
                            <td><strong>Pages/Panels (3 to 10 pages) : </strong></td>
                            <td><a target="_blank" href="{{'https://wavesbazaar.com/api/project/file/read/'.$document['url']}}">{{  $document['name']}}</a></td>
                        </tr>
                       
                        @elseif ($document['type'] == 83)
                        <tr>
                            <td><strong>Co-Creator Photo : </strong></td>
                            <td><a target="_blank" href="{{'https://wavesbazaar.com/api/project/file/read/'.$document['url']}}">{{  $document['name']}}</a></td>
                        </tr>
                        @elseif ($document['type'] == 71)
                        <tr>
                            <td><strong>Government ID Verification : </strong></td>
                            <td><a target="_blank" href="{{'https://wavesbazaar.com/api/project/file/read/'.$document['url']}}">{{  $document['name']}}</a></td>
                        </tr>
                        @elseif ($document['type'] == 72)
                        <tr>
                            <td><strong>Promotional Video Introduction (Optional) : </strong></td>
                            <td><a target="_blank" href="{{'https://wavesbazaar.com/api/project/file/read/'.$document['url']}}">{{  $document['name']}}</a></td>
                        </tr>
                        @elseif ($document['type'] == 73)
                        <tr>
                            <td><strong>Company Logo : </strong></td>
                            <td><a target="_blank" href="{{'https://wavesbazaar.com/api/project/file/read/'.$document['url']}}">{{  $document['name']}}</a></td>
                        </tr>
                        @elseif ($document['type'] == 61)
                        <tr>
                            <td><strong>Rate and Packages : </strong></td>
                            <td><a target="_blank" href="{{'https://wavesbazaar.com/api/project/file/read/'.$document['url']}}">{{  $document['name']}}</a></td>
                        </tr>
                        @elseif ($document['type'] == 62)
                        <tr>
                            <td><strong>Game Images of Campaigns (if any) : </strong></td>
                            <td><a target="_blank" href="{{'https://wavesbazaar.com/api/project/file/read/'.$document['url']}}">{{  $document['name']}}</a></td>
                        </tr>
                        @elseif ($document['type'] == 63)
                        <tr>
                            <td><strong>Brand Document : </strong></td>
                            <td><a target="_blank" href="{{'https://wavesbazaar.com/api/project/file/read/'.$document['url']}}">{{  $document['name']}}</a></td>
                        </tr>
                        @elseif ($document['type'] == 51)
                        <tr>
                            <td><strong>Creator Photo : </strong></td>
                            <td><a target="_blank" href="{{'https://wavesbazaar.com/api/project/file/read/'.$document['url']}}">{{  $document['name']}}</a></td>
                        </tr>
                        @elseif ($document['type'] == 52)
                        <tr>
                            <td><strong>Other Document : </strong></td>
                            <td><a target="_blank" href="{{'https://wavesbazaar.com/api/project/file/read/'.$document['url']}}">{{  $document['name']}}</a></td>
                        </tr>
                        @elseif ($document['type'] == 41)
                        <tr>
                            <td><strong>Project Documents : </strong></td>
                            <td><a target="_blank" href="{{'https://wavesbazaar.com/api/project/file/read/'.$document['url']}}">{{  $document['name']}}</a></td>
                        </tr>
                        @elseif ($document['type'] == 42)
                        <tr>
                            <td><strong>Documents : </strong></td>
                            <td><a target="_blank" href="{{'https://wavesbazaar.com/api/project/file/read/'.$document['url']}}">{{  $document['name']}}</a></td>
                        </tr>
                        @elseif ($document['type'] == 31)
                        <tr>
                            <td><strong>Pitch Deck/ Game Bible : </strong></td>
                            <td><a target="_blank" href="{{'https://wavesbazaar.com/api/project/file/read/'.$document['url']}}">{{  $document['name']}}</a></td>
                        </tr>
                        @elseif ($document['type'] == 32)
                        <tr>
                            <td><strong>Game Stills : </strong></td>
                            <td><a target="_blank" href="{{'https://wavesbazaar.com/api/project/file/read/'.$document['url']}}">{{  $document['name']}}</a></td>
                        </tr>
                        @elseif ($document['type'] == 33)
                        <tr>
                            <td><strong>Poster : </strong></td>
                            <td><a target="_blank" href="{{'https://wavesbazaar.com/api/project/file/read/'.$document['url']}}">{{  $document['name']}}</a></td>
                        </tr>
                        @elseif ($document['type'] == 34)
                        <tr>
                            <td><strong>Additional Document : </strong></td>
                            <td><a target="_blank" href="{{'https://wavesbazaar.com/api/project/file/read/'.$document['url']}}">{{  $document['name']}}</a></td>
                        </tr>
                        @elseif ($document['type'] == 111)
                        <tr>
                            <td><strong>Attach Rate Card : </strong></td>
                            <td><a target="_blank" href="{{'https://wavesbazaar.com/api/project/file/read/'.$document['url']}}">{{  $document['name']}}</a></td>
                        </tr>
                        @elseif ($document['type'] == 112)
                        <tr>
                            <td><strong>Testimonials or case Studies : </strong></td>
                            <td><a target="_blank" href="{{'https://wavesbazaar.com/api/project/file/read/'.$document['url']}}">{{  $document['name']}}</a></td>
                        </tr>
                        @elseif ($document['type'] == 113)
                        <tr>
                            <td><strong>Photo/Video Gallery of Past Events : </strong></td>
                            <td><a target="_blank" href="{{'https://wavesbazaar.com/api/project/file/read/'.$document['url']}}">{{  $document['name']}}</a></td>
                        </tr>                                                                  
                        

                    @endif
               
            @endforeach
        </table>
</div>

@endif
    <!-- @foreach ($contactDetails as $key=>$contact)
         @include('film._contact_details', ['contact' => $contact,$key=>$key])
    @endforeach -->
</div>
@endsection

