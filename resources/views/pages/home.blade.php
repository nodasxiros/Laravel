@extends('layouts.master')
@section('title', 'Home')

@section('content')
@if (Auth::guest())
@section('content')
<div class="container">
  <div class="content">
      <div class="title">Home Page</div>
      <hr>
      <div class="quote">Our Home page! Please Log in.</div>
      <div
        class="fb-like"
        data-share="true"
        data-width="450"
        data-show-faces="true">
      </div>
  </div>
</div>
@endsection
@else
@section('content')
  <div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                  You are logged in!
                </div>
            </div>
        </div>
    </div>
  </div>
@endsection
@endif
