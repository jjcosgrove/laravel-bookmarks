@extends('layouts.master')
@section('content')
<div class="container-fluid main-container dashboard">
    <div id="wrapper" class="">
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-section-title">
                    <p class="text-uppercase">Actions</p>
                </li>
                <li>
                    <a class="action new-bookmark" href="#">
                        <i class="fa fa-file-text-o"></i>New
                    </a>
                </li>
            </ul>
            <ul class="sidebar-nav">
                <li class="sidebar-section-title">
                    <p class="text-uppercase">Visibility</p>
                <li>
                    <a class="visibility-filter all-bookmarks selected" href="#">
                        <i class="fa fa-file-text-o"></i>
                        <span class="filter-name">All</span>
                        <span class="filter-count">{{ $stats['all_bm_count'] }}</span>
                    </a>
                </li>
                <li>
                    <a class="visibility-filter public-bookmarks" href="#">
                        <i class="fa fa-file-text-o"></i>
                        <span class="filter-name">Public</span>
                        <span class="filter-count">{{ $stats['public_bm_count'] }}</span>
                    </a>
                </li>
                <li>
                    <a class="visibility-filter my-bookmarks" href="#">
                        <i class="fa fa-file-text-o"></i>
                        <span class="filter-name">Private</span>
                        <span class="filter-count">{{ $stats['private_bm_count'] }}</span>
                    </a>
                </li>
            </ul>
            <ul class="sidebar-nav">
                <li class="sidebar-section-title">
                    <p class="text-uppercase">Tags</p>
                </li>
                <div class="tag-list">
                    <li>
                        <a class="tag-filter" href="#">
                            <i class="fa fa-tag"></i>
                            <span class="tag-name">Untagged</span>
                            <span class="tag-count">{{ $stats['untagged_count'] }}</span>
                        </a>
                    </li>
                    @foreach ( $tags as $tag )
                    <li>
                        <a class="tag-filter" href="#">
                            <i class="fa fa-tag"></i>
                            <span class="tag-name">{{ $tag->name }}</span>
                            <span class="tag-count">{{ $tag->visible_bookmarks_count() }}</span>
                        </a>
                    </li>
                    @endforeach
                </div>
            </ul>
        </div>
        <div id="page-content-wrapper">
            <div class="container-fluid">
                @if(!empty($message))
                <div class="row">
                    <div class="col-md-12">
                        <p class="user-message {{ $message['status'] == 'OK' ? 'bg-success' : 'bg-danger' }} ">
                            {{ $message['message'] }}
                        </p>
                    </div>  
                </div>
                @endif
                @if( Request::is('dashboard') )
                <div class="row">
                    <div class="col-md-12">
                        <ul class="search">
                            <li>
                                <input class="form-control search-filter" type="search" placeholder="Search Everything..." autocomplete="off">
                            </li>
                        </ul>
                    </div>
                </div>
                @endif
                <div class="row">
                    <div class="col-md-12">
                        <div class="list-group bookmark-list">
                            @foreach ( $bookmarks as $bookmark )
                            <a bookmark-id="{{ $bookmark->id }}" class="list-group-item bookmark-item" private="{{ $bookmark->private == 1 ? 'true' : 'false' }}" target="_blank" href="{{ $bookmark->url }}">
                                <h4 class="list-group-item-heading name">{{ $bookmark->name }}</h4>
                                <p class="created-by">
                                    Created by <span class="username">{{ $bookmark->user->username }}</span> on {{ date('d-m-Y \a\t h:m:s', strtotime($bookmark->created_at)) }}
                                </p>
                                <p class="url">
                                    <strong>URL:</strong> {{ $bookmark->url }}
                                </p>
                                <ul class="list-inline">
                                    <i class="fa fa-tag"></i>
                                    @if ( count($bookmark->tags) )
                                        @foreach ( $bookmark->tags as $tag )
                                            <li class="tag">{{ $tag->name }}</li>
                                        @endforeach
                                    @else
                                    <li class="tag">Untagged</li>
                                    @endif
                                </ul>
                                <form class="pull-right delete-form" action="{{ route('delete') }}" method="POST" role="form" autocomplete="off">
                                    {!! csrf_field() !!}
                                    <input class="hidden" type="text" id="bm_id" name="bm_id" value="{{ $bookmark->id }}">
                                    <button class="delete-button" type="submit"><i class="fa fa-2x action fa-trash delete-bookmark"></i></button>
                                </form>
                                <i class="fa fa-2x {{ $bookmark->private == 1 ? 'fa-lock' : 'fa-unlock' }} private-status pull-right"></i>
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('layouts.new-bookmark')
@endsection