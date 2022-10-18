@php
    $breadcrumb = [['title' => __('core::menu.system'), 'url' => '#'], ['title' => __('core::menu.system.administrators'), 'url' => '#', 'active' => true]];
@endphp
@extends('core::layouts.master')

@section('title', __('core::menu.system.administrators'));
@section('content')
<x-breadcrumb :items="$breadcrumb"></x-breadcrumb>
<div class="row mb-5">
    <div class="col-12">
        {!! $table !!}
    </div>
</div>
@endsection