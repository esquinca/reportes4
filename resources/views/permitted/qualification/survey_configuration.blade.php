@extends('layouts.app')

@section('contentheader_title')
  @if( auth()->user()->can('View survey configuration') )
    {{ trans('message.title_survey') }}
  @else
    {{ trans('message.title_survey') }}
  @endif
@endsection

@section('contentheader_description')
  @if( auth()->user()->can('View survey configuration') )
    {{ trans('message.subtitle_configuration_survey') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('breadcrumb_ubication')
  @if( auth()->user()->can('View survey configuration') )
    {{ trans('message.breadcrumb_configuration_survey') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('content')
    @if( auth()->user()->can('View survey configuration') )
    <div class="container">
        <div class="row">

            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
              <div class="box box-solid">
                <div class="box-body">
                  <div class="media">
                    <h4 style="background-color:#f7f7f7; font-size: 18px; text-align: center; padding: 7px 10px; margin-top: 0;">
                        Asignación de encuesta a usuario.
                    </h4>
                    <div class="media">
                        <div class="media-body">
                            <div class="clearfix">

                              <form id="form_reg_survey" name="form_reg_survey" class="form-horizontal" method="POST">
                                {{ csrf_field() }}
                                <div class="form-group">
                                  <label for="select_one" class="col-md-2 control-label">{{ trans('message.hotel') }}</label>
                                  <div class="col-md-10 selectContainer">
                                    <select id="select_one" name="select_one[]" multiple="multiple" class="form-control">
                                      <!-- <option value="" selected> Elija </option> -->
                                      @forelse ($hotels as $data_hotel)
                                        <option value="{{ $data_hotel->id }}"> {{ $data_hotel->Nombre_hotel }} </option>
                                      @empty
                                      @endforelse
                                    </select>
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label for="select_two" class="col-md-2 control-label">{{ trans('message.encuestado') }}</label>
                                  <div class="col-md-10 selectContainer">
                                    <!-- <select id="example-collapseOptGroupsByDefault" multiple="multiple">
                                        <optgroup label="Group 1">
                                            <option value="1-1" disabled>Option 1.1</option>
                                            <option value="1-2" selected="selected">Option 1.2</option>
                                            <option value="1-3" selected="selected">Option 1.3</option>
                                        </optgroup>
                                        <optgroup label="Group 2">
                                            <option value="2-1">Option 2.1</option>
                                            <option value="2-2">Option 2.2</option>
                                            <option value="2-3">Option 2.3</option>
                                        </optgroup>
                                        <optgroup label="Group 3">
                                            <option value="3-1">Option 2.1</option>
                                            <option value="3-2">Option 2.2</option>
                                            <option value="3-3">Option 2.3</option>
                                        </optgroup>
                                        <optgroup label="Group 4">
                                            <option value="4-1">Option 2.1</option>
                                            <option value="4-2">Option 2.2</option>
                                            <option value="4-3">Option 2.3</option>
                                        </optgroup>
                                        <optgroup label="Group 5">
                                            <option value="5-1">Option 2.1</option>
                                            <option value="5-2">Option 2.2</option>
                                            <option value="5-3">Option 2.3</option>
                                        </optgroup>
                                        <optgroup label="Group 6">
                                            <option value="6-1">Option 2.1</option>
                                            <option value="6-2">Option 2.2</option>
                                            <option value="6-3">Option 2.3</option>
                                        </optgroup>
                                        <optgroup label="Group 7">
                                            <option value="7-1">Option 2.1</option>
                                            <option value="7-2">Option 2.2</option>
                                            <option value="7-3">Option 2.3</option>
                                        </optgroup>
                                        <optgroup label="Group 8">
                                            <option value="8-1">Option 2.1</option>
                                            <option value="8-2">Option 2.2</option>
                                            <option value="8-3">Option 2.3</option>
                                        </optgroup>
                                        <optgroup label="Group 9">
                                            <option value="9-1">Option 2.1</option>
                                            <option value="9-2">Option 2.2</option>
                                            <option value="9-3">Option 2.3</option>
                                        </optgroup>
                                        <optgroup label="Group 10">
                                            <option value="10-1">Option 2.1</option>
                                            <option value="10-2">Option 2.2</option>
                                            <option value="10-3">Option 2.3</option>
                                        </optgroup>
                                    </select> -->

                                    <select id="select_two" name="select_two[]" multiple="multiple" class="form-control">
                                      @foreach (  App\Vertical::select('id', 'name')->get(); as $verticals)
                                        @php
                                          $d= $verticals->id;
                                        @endphp
                                        @if (count( App\User_vertical::where('verticals_id', $d )->get() ) > 0)
                                          <optgroup label="{{ $verticals->name }}">
                                            @foreach (  App\User_vertical::where('verticals_id', $d )->get() as $opciones)
                                            <option value="{{ $opciones->users_id }}"> {{ App\User::find($opciones->users_id)->name}} </option>
                                            @endforeach
                                          </optgroup>
                                        @endif
                                      @endforeach
                                    </select>
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label for="select_three" class="col-md-2 control-label">{{ trans('message.survey') }}</label>
                                  <div class="col-md-10 selectContainer">
                                    <select id="select_three" name="select_three" class="form-control select2">
                                      <option value="" selected> Elija </option>
                                      @forelse ($surveys as $data_survey)
                                        <option value="{{ $data_survey->id }}"> {{ $data_survey->name }} </option>
                                      @empty
                                      @endforelse
                                    </select>
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label class="col-md-2 control-label" for="month_upload_band">{{ trans('message.periodactive')}} </label>
                                  <div class="col-md-10">
                                    <div class="input-group input-daterange">
                                        <input name="date_start"  type="text" class="form-control" value="">
                                        <div class="input-group-addon">to</div>
                                        <input name="date_end"  type="text" class="form-control" value="">
                                    </div>
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label class="col-md-2 control-label" for="month_evaluate">{{ trans('message.monthtoevaluate')}} </label>
                                  <div class="col-md-10">
                                    <input id="month_evaluate" name="month_evaluate"  type="text"  maxlength="10" placeholder="{{ trans('message.maxcardiez')}}"
                                      class="form-control input-md">
                                  </div>
                                </div>

                                <div class="form-group">
                                  <div class="col-md-12">
                                    <a id="capture" class="btn btn-success capture" type="submit"><i class="fa fa-bookmark-o"></i> {{ trans('message.capturar')}}</a>
                                    <a id="clear" class="btn btn-danger"><i class="fa fa-ban"></i> {{ trans('message.cancelar')}}</a>
                                  </div>
                                </div>
                              </form>

                            </div>
                        </div>
                    </div>
                  </div>
                 </div>
              </div>
            </div>

            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
              <div class="box box-solid">
                <div class="box-body">
                  <div class="media">
                    <h4 style="background-color:#f7f7f7; font-size: 18px; text-align: center; padding: 7px 10px; margin-top: 0;">
                      Ver usuarios encuestados
                    </h4>
                    <div class="media">
                        <div class="media-body">
                            <div class="clearfix">
                                {{ csrf_field() }}
                                <div class="table-responsive">
                                  <table id="example_survey" name='example_survey' class="display nowrap table table-bordered table-hover" width="100%" cellspacing="0">
                                    <input type='hidden' id='_tokenb' name='_tokenb' value='{!! csrf_token() !!}'>
                                    <thead>
                                        <tr class="bg-primary" style="background: #789F8A; font-size: 11.5px; ">
                                            <th> <small>Hotel</small> </th>
                                            <th> <small>Email</small> </th>
                                            <th> <small>Estatus</small> </th>
                                            <th> <small>Operación A</small> </th>
                                            <th> <small>Operación B</small> </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                  </table>
                                </div>

                            </div>
                        </div>
                    </div>
                  </div>
                 </div>
              </div>
            </div>

        </div>
    </div>
    @else
      @include('default.denied')
    @endif
@endsection

@push('scripts')
  @if( auth()->user()->can('View survey configuration') )
    <script src="{{ asset('js/admin/qualification/configurationsurvey.js')}}"></script>

    <link rel="stylesheet" href="{{ asset('bower_components/bootstrap-multiselect-master/dist/css/bootstrap-multiselect.css') }}" type="text/css" />
    <script src="{{ asset('../bower_components/bootstrap-multiselect-master/dist/js/bootstrap-multiselect.js') }}"></script>

  @else
    <!--NO VER-->
  @endif
@endpush
