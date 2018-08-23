@extends('layouts.app')

@section('contentheader_title')
  {{ trans('message.error404title') }}
@endsection

@section('breadcrumb_ubication')
  {{ trans('message.error404') }}
@endsection

@section('content')
  <div class="error-page">
    <h2 class="headline text-yellow"> 404</h2>

    <div class="error-content">
      <h3><i class="fa fa-warning text-yellow"></i> {{ trans('message.contenttitle') }}</h3>
      <p>
        {{ trans('message.contenttext') }}<a href="home"> {{ trans('message.contentreturn') }}</a>
      </p>
    </div>
    <!-- /.error-content -->
  </div>
@endsection
