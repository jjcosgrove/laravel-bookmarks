@extends('layouts.master')
@section('content')
<div class="container main-container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default animated fadeIn">
                <div class="panel-heading"><strong>Welcome to Bookmarks</strong></div>
                <div class="panel-body">
                    <p>This is a simple Laravel-based bookmarks application.</p>
                    <p><strong>Current features include:</strong></p>
                    <ul>
                        <li>Basic accounts</li>
                        <li>Public/private bookmarks</li>
                        <li>Filter by visibility & tags</li>
                        <li>Search</li>
                    </ul>
                    <p><strong>Future features may include:</strong></p>
                    <ul>
                        <li>Tidy up/refactor</li>
                        <li>API</li>
                        <li>Favourites</li>
                        <li>Profiles
                            <ul>
                                <li>Scope settings</li>
                                <li>Themes</li>
                                <li>View settings</li>
                            </ul>
                        </li>
                        <li>Lots more</li>
                    </ul>
                    <p>You can grab the latest version from <a target="_blank" href="https://github.com/jjcosgrove/laravel-bookmarks">GitHub <i class="fa fa-github"></i></a></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
