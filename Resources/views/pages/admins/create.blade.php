@php
    $breadcrumb = [
        ['title' => __('core::menu.system'), 'url' => '#'], 
        ['title' => __('core::menu.system.administrators'), 'url' => __('admin.system.administrators.index')],
        ['title' => __('core::menu.create'), 'url' => '#', 'active' => true],
    ];
@endphp
@extends('core::layouts.master')

@section('title', __('core::menu.create').' | '.__('core::menu.system.administrators'))
@section('content')
<x-breadcrumb :items="$breadcrumb"></x-breadcrumb>
<div id="ocms-app">
    <x-forms::base-form :action="route('admin.system.administrators.store')">
        <div class="row mb-5">
            <div class="col-12 col-xl-9 col-lg-9">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">@lang('core::messages.admin.new_administrator')</h5>
                        <div class="row">
                            <div class="col-12 col-xl-6 col-lg-6">
                                <x-forms::group
                                    mode="input"
                                    :label="__('core::messages.admin.username')"
                                    :placeholder="__('core::messages.admin.username_placeholder')"
                                    name="username"
                                    :value="old('username', '')"
                                    required
                                />
                            </div>
                            <div class="col-12 col-xl-6 col-lg-6">
                                <x-forms::group
                                    mode="input"
                                    type="email"
                                    :label="__('core::messages.admin.email')"
                                    :placeholder="__('core::messages.admin.email_placeholder')"
                                    name="email"
                                    :value="old('email', '')"
                                    required
                                />
                            </div>
                            <div class="col-12 col-xl-6 col-lg-6">
                                <x-forms::group
                                    mode="input"
                                    :label="__('core::messages.admin.name')"
                                    :placeholder="__('core::messages.admin.name_placeholder')"
                                    name="name"
                                    :value="old('name', '')"
                                    required
                                />
                            </div>
                            <div class="col-12 col-xl-6 col-lg-6">
                                <x-forms::group
                                    mode="select"
                                    type="role"
                                    :label="__('core::messages.admin.role')"
                                    :placeholder="__('core::messages.admin.role_placeholder')"
                                    name="role"
                                    :value="old('role', '')"
                                    required
                                >
                                    @foreach($roles as $role)
                                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                                    @endforeach
                                </x-forms::group>
                            </div>
                            <div class="col-12 col-xl-6 col-lg-6">
                                <x-forms::group
                                    mode="input"
                                    type="password"
                                    :label="__('core::messages.admin.password')"
                                    :placeholder="__('core::messages.admin.password_placeholder')"
                                    name="password"
                                    :value="old('password', '')"
                                    required
                                />
                            </div>
                            <div class="col-12 col-xl-6 col-lg-6">
                                <x-forms::group
                                    mode="input"
                                    type="password"
                                    :label="__('core::messages.admin.password_confirm')"
                                    :placeholder="__('core::messages.admin.password_confirm_placeholder')"
                                    name="password_confirmation"
                                    :value="old('password_confirmation', '')"
                                    required
                                />
                            </div>      
                            <div class="col-12">
                                <ul class="ps-3">
                                    <li class="text-muted small">@lang('core::messages.admin.username_help')</li>
                                    <li class="text-muted small">@lang('core::messages.admin.password_help')</li>
                                </ul>    
                            </div>                                  
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-xl-3 col-lg-3">
                <div class="card">
                    <div class="card-header">
                        <div class="fw-bold">@lang('core::messages.publish')</div>
                    </div>
                    <div class="card-body d-flex align-items-center">
                        <button type="submit" name="submit" value="save" class="btn btn-success text-white me-2">
                            <span class="icon icon-xs me-1">
                                <i class="fas fa-save"></i>
                            </span>
                            <span>@lang('core::messages.save')</span>
                        </button>
                        <button type="submit" name="submit" value="keep_editing" class="btn btn-info">
                            <span class="icon icon-xs me-1">
                                <i class="fas fa-edit"></i>
                            </span>
                            <span>@lang('core::messages.save_and_edit')</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </x-forms::base-form>
</div>
@endsection