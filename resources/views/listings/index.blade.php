@extends('layout')
@section('content')

@include('partials/_hero')
@include('partials/_search')

    <div
    class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4"
    >

    @if(count($listings) == 0) 
        <h3>No listing</h3>
    @endif
    @foreach($listings as $listing)
        <x-card-listing :listing="$listing" />
    @endforeach
    </div>
@endsection