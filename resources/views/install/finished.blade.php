@extends('install.layouts.master')

@section('template_title')
    {{ trans('installer_messages.final.templateTitle') }}
@endsection

@section('title')
    <i class="fa fa-flag-checkered fa-fw" aria-hidden="true"></i>
    {{ trans('installer_messages.final.title') }}
@endsection

@section('container')

    @if(optional(session('message'))['dbOutputLog'])
        <p><strong><small>{{ trans('installer_messages.final.migration') }}</small></strong></p>
        <pre><code>{{ session('message')['dbOutputLog'] }}</code></pre>
    @endif

    <p><strong>{{ $finalStatusMessage }}</strong></p>

    <div class="buttons">
        @if(session()->has('message') && (session('message')['message'] === 'error'))
         <a href="{{ url('/install') }}" class="button">{{ trans('installer_messages.final.reinstall') }}</a>
        @else
            <a href="{{ url('/') }}" class="button">{{ trans('installer_messages.final.exit') }}</a>
        @endif
    </div>

@endsection
