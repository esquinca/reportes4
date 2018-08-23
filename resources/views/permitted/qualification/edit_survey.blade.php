@extends('layouts.app')

@section('contentheader_title')
  @if( auth()->user()->can('View edit survey') )
    {{ trans('message.title_survey') }}
  @else
    {{ trans('message.title_survey') }}
  @endif
@endsection

@section('contentheader_description')
  @if( auth()->user()->can('View edit survey') )
    {{ trans('message.subtitle_edit_survey') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('breadcrumb_ubication')
  @if( auth()->user()->can('View edit survey') )
    {{ trans('message.breadcrumb_edit_survey') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('content')
    @if( auth()->user()->can('View edit survey') )
      Content edit survey
    @else
      @include('default.denied')
    @endif
@endsection

@push('scripts')
  @if( auth()->user()->can('View edit survey') )
    <script src="{{ asset('js/admin/qualification/editsurvey.js')}}"></script>
  @else
    <!--NO VER-->
  @endif
@endpush
