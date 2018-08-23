@extends('layouts.app')

@section('contentheader_title')
  @if( auth()->user()->can('View dashboard pral') )
    {{ trans('message.dashboard') }}
  @else
    {{ trans('message.bienvenido') }}
  @endif
@endsection

@section('contentheader_description')
  @if( auth()->user()->can('View dashboard pral') )
    {{ trans('message.principal') }}
  @else
    {{ trans('message.user') }}
  @endif
@endsection

@section('breadcrumb_ubication')
  @if( auth()->user()->can('View dashboard pral') )
    {{ trans('message.dashboard') }}
  @else
    {{ trans('message.bienvenido') }}
  @endif
@endsection

@section('content')
    @if( auth()->user()->can('View dashboard pral') )
      No definido aun
    @else
      <!--NO VER-->
      @include('default.session')
    @endif
@endsection

@push('scripts')
  @if( auth()->user()->can('View dashboard pral') )
    <script src="{{ asset('js/admin/dashboard.js')}}"></script>
  @else
    <!--NO VER-->
  @endif
@endpush
