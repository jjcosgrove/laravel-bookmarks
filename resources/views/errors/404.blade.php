@extends('layouts.master')
@section('content')
<div class="container main-container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default animated fadeIn">
                <div class="panel-heading"><strong>You made a 404</strong></div>
                <div class="panel-body">
                    <p>Please go <a href="{{ route('homepage') }}">Home</a>.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
