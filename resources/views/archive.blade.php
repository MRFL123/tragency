@extends('layouts.app')

@section('content')
    @include('partials/archive/content-archive-' . get_post_type())
@endsection
