@extends('layouts.app')

@section('content')
<section class="page_404">
  <div class="spacer-50"></div>
  <div class="flex-container">
    <div class="text-center">
      <h1 class="font-120">
        <span class="fade-in" id="digit1">4</span>
        <span class="fade-in" id="digit2">0</span>
        <span class="fade-in" id="digit3">4</span>
      </h1>
      <p>{{ __('ERROR, sorry something went wrong. this page is not found Please go back.', 'tragency') }}</p>
      <div class="spacer-30"></div>
      <a href="{{ home_url('/') }}" class="main-btn">{{ __('Go Back To Home Page', 'tragency') }}</a>
    </div>
  </div>
</section>
@endsection
