@extends('layouts.app')

@section('contentheader_title')
  @if( auth()->user()->can('View capture survey') )
    {{ trans('message.title_survey') }}
  @else
    {{ trans('message.title_survey') }}
  @endif
@endsection

@section('contentheader_description')
  @if( auth()->user()->can('View capture survey') )
    {{ trans('message.subtitle_capture_survey') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('breadcrumb_ubication')
  @if( auth()->user()->can('View capture survey') )
    {{ trans('message.breadcrumb_capture_survey') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('content')
    @if( auth()->user()->can('View capture survey') )
      Content capture survey
    @else
      @include('default.denied')
    @endif
@endsection

@push('scripts')
  @if( auth()->user()->can('View capture survey') )
    <script src="{{ asset('js/admin/qualification/capturesurvey.js')}}"></script>
  @else
    <!--NO VER-->
  @endif
@endpush
