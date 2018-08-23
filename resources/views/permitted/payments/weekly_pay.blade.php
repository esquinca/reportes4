@extends('layouts.app')

@section('contentheader_title')
  @if( auth()->user()->can('View weekly pay') )
    {{ trans('message.payments') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('contentheader_description')
  @if( auth()->user()->can('View weekly pay') )
    {{ trans('message.report_weekly') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('breadcrumb_ubication')
  @if( auth()->user()->can('View weekly pay') )
    {{ trans('message.breadcrumb_weekly_pay') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('content')
    @if( auth()->user()->can('View weekly pay') )

    @else
      @include('default.denied')
    @endif
@endsection

@push('scripts')
  @if( auth()->user()->can('View weekly pay') )

  @else
    <!--NO VER-->
  @endif
@endpush
