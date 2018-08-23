@extends('layouts.app')

@section('contentheader_title')
  {{ trans('message.error500title') }}
@endsection

@section('breadcrumb_ubication')
  {{ trans('message.error500') }}
@endsection

@section('content')
  <div class="error-page">
    <h2 class="headline text-red">500</h2>

    <div class="error-content">
      <h3><i class="fa fa-warning text-red"></i> {{ trans('message.content500title') }}</h3>
      <p>
        {{ trans('message.content500text') }}<a href="home"> {{ trans('message.contentreturn') }}</a>
      </p>
    </div>
  </div>
@endsection
