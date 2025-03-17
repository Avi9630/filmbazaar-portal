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
    @if ($film->category == 1)
    @include('film.partial.category_1',compact('film', 'FilmMaker', 'other_details'))
    @elseif ($film->category == 2)
    @include('film.partial.category_2',compact('film', 'FilmMaker', 'other_details'))
    @elseif ($film->category == 13)
    @include('film.partial.category_13',compact('film', 'FilmMaker', 'other_details'))
    @elseif ($film->category == 9)
    @include('film.partial.category_9',compact('film', 'FilmMaker', 'other_details'))
    @elseif ($film->category == 6)
    @include('film.partial.category_6',compact('film', 'FilmMaker', 'other_details'))
    @elseif ($film->category == 11)
    @include('film.partial.category_11',compact('film', 'FilmMaker', 'other_details'))
    @elseif ($film->category == 10)
    @include('film.partial.category_10',compact('film', 'FilmMaker', 'other_details'))
    @elseif ($film->category == 8)
    @include('film.partial.category_8',compact('film', 'FilmMaker', 'other_details'))
    @elseif ($film->category == 7)
    @include('film.partial.category_7',compact('film', 'FilmMaker', 'other_details'))
    @elseif ($film->category == 5)
    @include('film.partial.category_5',compact('film', 'FilmMaker', 'other_details'))
    @elseif ($film->category == 4)
    @include('film.partial.category_4',compact('film', 'FilmMaker', 'other_details'))
 
 
 
    @elseif ($film->category == 3)
    @include('film.partial.category_3',compact('film', 'FilmMaker', 'other_details'))
    @else
    
    @include('film.partial.default',compact('film', 'FilmMaker', 'other_details'))
    @endif
    

</div>
@endsection