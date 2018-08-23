@extends('layouts.app')

@section('contentheader_title')
  @if( auth()->user()->can('View individual capture') )
    {{ trans('message.title_capture_indiv') }}
  @else
    {{ trans('message.title_capture_indiv') }}
  @endif
@endsection

@section('contentheader_description')
  @if( auth()->user()->can('View individual capture') )
    {{ trans('message.subtitle_capture_indiv') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('breadcrumb_ubication')
  @if( auth()->user()->can('View individual capture') )
    {{ trans('message.breadcrumb_capture_indiv') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('content')
    @if( auth()->user()->can('View individual capture') )
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-12 col-md-6 col-lg-6">
              <div class="box box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title">{{ trans('message.clienttype')}}</h3>
                  <div class="box-tools pull-right">
                    <!-- Buttons, labels, and many other things can be placed here! -->
                    <!-- Here is a label for example -->
                    <!-- <span class="label label-primary">Label</span> -->
                  </div>
                  <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <div class="row">
                    <div class="col-sm-12">
                      <form id="form_img_upload_type" name="form_img_upload_type" class="form-horizontal" enctype="multipart/form-data"  method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                          <label for="select_one_type" class="col-md-2 control-label">{{ trans('message.hotel') }}</label>
                          <div class="col-md-10 selectContainer">
                            <select id="select_one_type" name="select_one_type" class="form-control select2">
                              <option value="" selected> Elija </option>
                              @forelse ($hotels as $data_hotel)
                                <option value="{{ $data_hotel->id }}"> {{ $data_hotel->Nombre_hotel }} </option>
                              @empty
                              @endforelse
                            </select>
                          </div>
                        </div>
                        <div class="form-group">
      										<label class="col-md-2 control-label" for="inputSupervisor">{{ trans('message.date')}} </label>
      										<div class="col-md-10">
      											<input id="month_upload_type" name="month_upload_type"  type="text"  maxlength="10" placeholder="{{ trans('message.maxcardiez')}}"
      												class="form-control input-md">
      										</div>
      									</div>
                        <div class="form-group">
        									<label class="col-md-12 control-label" for="dropzone_client">{{ trans('message.importarimg')}}  </label>
        									<div class="col-md-12">
                            <div id="dropzone_client" name="dropzone_client" class="dropzone"></div>
        									</div>
        								</div>
                        <div class="form-group">
                          <div class="col-md-12">
                            <a id="cargarimgclient" class="btn btn-success" type="submit"><i class="fa fa-bookmark-o"></i> {{ trans('message.capturar')}}</a>
                            <a id="generateimgtypeClear" class="btn btn-danger"><i class="fa fa-ban"></i> {{ trans('message.cancelar')}}</a>
                          </div>
                        </div>

                      </form>
                    </div>
                  </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                  <!-- The footer of the box -->
                </div>
              </div>
            </div>

            <div class="col-xs-12 col-md-12 col-md-6 col-lg-6">
              <div class="box box-solid">
                  <div class="box-header with-border">
                  <h3 class="box-title">{{ trans('message.contentimgband')}}</h3>
                  <div class="box-tools pull-right">
                    <!-- Buttons, labels, and many other things can be placed here! -->
                    <!-- Here is a label for example -->
                    <!-- <span class="label label-primary">Label</span> -->
                  </div>
                  <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <div class="row">
                    <div class="col-sm-12">
                      <form id="form_img_band_upload" name="form_img_band_upload" class="form-horizontal" enctype="multipart/form-data"  method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                          <label for="select_one_band" class="col-md-2 control-label">{{ trans('message.hotel') }}</label>
                          <div class="col-md-10 selectContainer">
                            <select id="select_one_band" name="select_one_band" class="form-control select2">
                              <option value="" selected> Elija </option>
                              @forelse ($hotels as $data_hotel)
                                <option value="{{ $data_hotel->id }}"> {{ $data_hotel->Nombre_hotel }} </option>
                              @empty
                              @endforelse
                            </select>
                          </div>
                        </div>
                        <div class="form-group">
      										<label class="col-md-2 control-label" for="month_upload_band">{{ trans('message.date')}} </label>
      										<div class="col-md-10">
      											<input id="month_upload_band" name="month_upload_band"  type="text"  maxlength="10" placeholder="{{ trans('message.maxcardiez')}}"
      												class="form-control input-md">
      										</div>
      									</div>
                        <div class="form-group">
        									<label class="col-md-12 control-label" for="dropzone_band">{{ trans('message.importarimg')}}  </label>
        									<div class="col-md-12">
                            <div id="dropzone_band" name="dropzone_band" class="dropzone"></div>
        									</div>
        								</div>
                        <div class="form-group">
                          <div class="col-md-12">
                            <a id="cargarimgband" class="btn btn-success" type="submit"><i class="fa fa-bookmark-o"></i> {{ trans('message.capturar')}}</a>
                            <a id="clearimgband" class="btn btn-danger"><i class="fa fa-ban"></i> {{ trans('message.cancelar')}}</a>
                          </div>
                        </div>

                      </form>
                    </div>
                  </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                  <!-- The footer of the box -->
                </div>
              </div>
            </div>

            <div class="col-xs-12 col-md-12 col-md-6 col-lg-6">
              <div class="box box-solid">
                  <div class="box-header with-border">
                  <h3 class="box-title">{{ trans('message.contentgbtrans')}}</h3>
                  <div class="box-tools pull-right">
                    <!-- Buttons, labels, and many other things can be placed here! -->
                    <!-- Here is a label for example -->
                    <!-- <span class="label label-primary">Label</span> -->
                  </div>
                  <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <div class="row">
                    <div class="col-sm-12">
                      <form id="form_gb" name="form_gb" class="form-horizontal" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                          <label for="select_onet" class="col-md-2 control-label">{{ trans('message.hotel') }}</label>
                          <div class="col-md-10 selectContainer">
                            <select id="select_onet" name="select_onet" class="form-control select2">
                              <option value="" selected> Elija </option>
                              @forelse ($hotels as $data_hotel)
                                <option value="{{ $data_hotel->id }}"> {{ $data_hotel->Nombre_hotel }} </option>
                              @empty
                              @endforelse
                            </select>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="select_two_zd" class="col-md-2 control-label">{{ trans('message.zonedirect') }}</label>
                          <div class="col-md-10 selectContainer">
                            <select id="select_two_zd" name="select_two_zd" class="form-control select2">
                              <option value="" selected> Elija </option>
                            </select>
                          </div>
                        </div>
                        <div class="form-group">
      										<label class="col-md-2 control-label" for="month_trans_zd">{{ trans('message.date')}} </label>
      										<div class="col-md-10">
      											<input id="month_trans_zd" name="month_trans_zd"  type="text"
      												class="form-control input-md datepickermonth">
      										</div>
      									</div>

                        <div class="form-group">
                          <label for="valorgb_trans"  class="col-md-2 control-label">{{ trans('message.gbtrans')}}: </label>
                          <div class="col-md-10">
                            <input type="number" class="form-control" id="valorgb_trans" name="valorgb_trans" placeholder="Máximo 5 digitos." maxlength="5" title="{{ trans('message.gbtrans')}}" class="form-control input-md">
                          </div>
                        </div>

                        <div class="form-group">
                          <div class="col-md-12">
                            <a id="generateGbInfo" class="btn btn-success"><i class="fa fa-bookmark-o"></i> {{ trans('message.capturar')}}</a>
                            <a id="generateGbClear" class="btn btn-danger"><i class="fa fa-ban"></i> {{ trans('message.cancelar')}}</a>
                          </div>
                        </div>


                      </form>
                    </div>
                  </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                  <!-- The footer of the box -->
                </div>
              </div>
            </div>

            <div class="col-xs-12 col-md-12 col-md-6 col-lg-6">
              <div class="box box-solid">
                  <div class="box-header with-border">
                  <h3 class="box-title">{{ trans('message.contentnumberdevice')}}</h3>
                  <div class="box-tools pull-right">
                    <!-- Buttons, labels, and many other things can be placed here! -->
                    <!-- Here is a label for example -->
                    <!-- <span class="label label-primary">Label</span> -->
                  </div>
                  <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <div class="row">
                    <div class="col-sm-12">
                      <form id="form_device" name="form_device" class="form-horizontal" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                          <label for="select_one_device" class="col-md-2 control-label">{{ trans('message.hotel') }}</label>
                          <div class="col-md-10 selectContainer">
                            <select id="select_one_device" name="select_one_device" class="form-control select2">
                              <option value="" selected> Elija </option>
                              @forelse ($hotels as $data_hotel)
                                <option value="{{ $data_hotel->id }}"> {{ $data_hotel->Nombre_hotel }} </option>
                              @empty
                              @endforelse
                            </select>
                          </div>
                        </div>

                        <div class="form-group">
      										<label class="col-md-2 control-label" for="month_device">{{ trans('message.date')}} </label>
      										<div class="col-md-10">
      											<input id="month_device" name="month_device" type="text"  maxlength="10"
      												class="form-control input-md datepickermonth">
      										</div>
      									</div>

                        <div class="form-group">
                          <label for="valor_users"  class="col-md-2 control-label">{{ trans('message.usersauth')}}: </label>
                          <div class="col-md-10">
                            <input type="number" class="form-control" id="valor_users" name="valor_users" placeholder="Máximo 5 digitos." maxlength="5" title="{{ trans('message.usersauth')}}" class="form-control input-md">
                          </div>
                        </div>

                        <div class="form-group">
                          <div class="col-md-12">
                            <a id="generateUserInfo" class="btn btn-success"><i class="fa fa-bookmark-o"></i> {{ trans('message.capturar')}}</a>
                            <a id="generateUserClear" class="btn btn-danger"><i class="fa fa-ban"></i> {{ trans('message.cancelar')}}</a>
                          </div>
                          </br></br></br></br>
                          <!-- </br></br></br></br> -->
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                  <!-- The footer of the box -->
                </div>
              </div>
            </div>
            <!-- Comments reportes. -->
            <div class="col-xs-2 col-md-2 col-md-2 col-lg-2"></div>
            <div class="col-xs-12 col-md-12 col-md-8 col-lg-8">
              <div class="box box-solid">
                  <div class="box-header with-border">
                  <h3 class="box-title">Añadir comentarios.</h3>
                  <div class="box-tools pull-right">
                    <!-- Buttons, labels, and many other things can be placed here! -->
                    <!-- Here is a label for example -->
                    <!-- <span class="label label-primary">Label</span> -->
                  </div>
                  <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <div class="row">
                    <div class="col-sm-12">
                      <form id="form_comments" name="form_comments" class="form-horizontal" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                          <label for="select_one_comments" class="col-md-2 control-label">{{ trans('message.hotel') }}</label>
                          <div class="col-md-10 selectContainer">
                            <select id="select_one_comments" name="select_one_comments" class="form-control select2">
                              <option value="" selected> Elija </option>
                              @forelse ($hotels as $data_hotel)
                                <option value="{{ $data_hotel->id }}"> {{ $data_hotel->Nombre_hotel }} </option>
                              @empty
                              @endforelse
                            </select>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-md-2 control-label" for="month_comments">{{ trans('message.date')}} </label>
                          <div class="col-md-10">
                            <input id="month_comments" name="month_comments" type="text"  maxlength="10"
                              class="form-control input-md">
                          </div>
                        </div>

                        <div class="form-group">
                          <label for="report_comment"  class="col-md-2 control-label">Comentario: </label>
                          <div class="col-md-10">
                            <textarea class="form-control input-md" id="report_comment" name="report_comment" placeholder="..." style="resize: vertical;"></textarea>
                          
                          </div>
                        </div>

                        <div class="form-group">
                          <div class="col-md-12">
                            <a id="generateComment" class="btn btn-success"><i class="fa fa-bookmark-o"></i> {{ trans('message.capturar')}}</a>
                            <a id="generateCommentClear" class="btn btn-danger"><i class="fa fa-ban"></i> {{ trans('message.cancelar')}}</a>
                          </div>
                          </br></br></br></br>
                          <!-- </br></br></br></br> -->
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                  <!-- The footer of the box -->
                </div>
              </div>
            </div>
            <div class="col-xs-2 col-md-2 col-md-2 col-lg-2"></div>
            <!-- End comments reportes. -->


            <div class="col-xs-12 col-md-12 col-md-6 col-lg-6">
              <div class="box box-solid">
                  <div class="box-header with-border">
                  <h3 class="box-title">{{ trans('message.contentapstop')}}</h3>
                  <div class="box-tools pull-right">
                    <!-- Buttons, labels, and many other things can be placed here! -->
                    <!-- Here is a label for example -->
                    <!-- <span class="label label-primary">Label</span> -->
                  </div>
                  <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <div class="row">
                    <div class="col-sm-12">
                      <form id="form_aps" name="form_aps" class="form-inline" action="">
                        {{ csrf_field() }}

                        <div class="form-group">
                          <label for="select_three" class="control-label">{{ trans('message.hotel') }}: </label>
                          <select id="select_three" name="select_three"  class="form-control select2" required>
                            <option value="" selected> Elija </option>
                            @forelse ($hotels as $data_hotel)
                              <option value="{{ $data_hotel->id }}"> {{ $data_hotel->Nombre_hotel }} </option>
                            @empty
                            @endforelse
                          </select>
                        </div>

                        <div class="form-group">
                          <label for="fecha_aps" class=" col-md-2 control-label">{{ trans('message.date') }}: </label>
                          <div class="col-md-10">
                            <input id="fecha_aps" name="fecha_aps" type="text"  maxlength="10"
                              class="form-control input-md datepickermonth">
                          </div>
                        </div>

                        <ul class="list-group">
                          <li class="list-group-item">
                            <div class="row">
                              <small class="col-md-12 control-label">
                                 <h4><span class="label label-primary">TOP 1</span></h4>
                              </small>
                              <div class="col-lg-4">
                                <div class="input-group">
                                  <span class="input-group-addon" ><i class="glyphicon glyphicon-asteris text-danger">*</i></span>
                                  <input name="mac1" id="mac1" type="text" class="form-control" placeholder="{{ trans('message.ingmac')}}" aria-describedby="mac1">
                                </div>
                              </div>
                              <div class="col-lg-4">
                                <div class="input-group">
                                  <span class="input-group-addon"><i class="glyphicon glyphicon-asteris text-danger">*</i></span>
                                  <input name="modelo1" id="modelo1" type="text" class="form-control" placeholder="{{ trans('message.ingmod')}}" aria-describedby="modelo1">
                                </div>
                              </div>
                              <div class="col-lg-4">
                                <div class="input-group">
                                  <span class="input-group-addon"><i class="glyphicon glyphicon-asteris text-danger">*</i></span>
                                  <input name="cliente1" id="cliente1" type="number" class="form-control" placeholder="Máximo 5 digitos." maxlength="5" aria-describedby="cliente1">
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="list-group-item">
                            <div class="row">
                              <small class="col-md-12 control-label">
                                 <h4><span class="label label-primary">TOP 2</span></h4>
                              </small>
                              <div class="col-lg-4">
                                <div class="input-group">
                                  <span class="input-group-addon"><i class="glyphicon glyphicon-asteris text-danger">*</i></span>
                                  <input name="mac2" id="mac2" type="text" class="form-control" placeholder="{{ trans('message.ingmac')}}" aria-describedby="mac2">
                                </div>
                              </div>
                              <div class="col-lg-4">
                                <div class="input-group">
                                  <span class="input-group-addon"><i class="glyphicon glyphicon-asteris text-danger">*</i></span>
                                  <input name="modelo2" id="modelo2" type="text" class="form-control" placeholder="{{ trans('message.ingmod')}}" aria-describedby="modelo2">
                                </div>
                              </div>
                              <div class="col-lg-4">
                                <div class="input-group">
                                  <span class="input-group-addon"><i class="glyphicon glyphicon-asteris text-danger">*</i></span>
                                  <input name="cliente2" id="cliente2" type="number" class="form-control" placeholder="Máximo 5 digitos." maxlength="5" aria-describedby="cliente2">
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="list-group-item">
                            <div class="row">
                              <small class="col-md-12 control-label">
                                 <h4><span class="label label-primary">TOP 3</span></h4>
                              </small>
                              <div class="col-lg-4">
                                <div class="input-group">
                                  <span class="input-group-addon"><i class="glyphicon glyphicon-asteris text-danger">*</i></span>
                                  <input name="mac3" id="mac3" type="text" class="form-control" placeholder="{{ trans('message.ingmac')}}" aria-describedby="mac3">
                                </div>
                              </div>
                              <div class="col-lg-4">
                                <div class="input-group">
                                  <span class="input-group-addon"><i class="glyphicon glyphicon-asteris text-danger">*</i></span>
                                  <input name="modelo3" id="modelo3" type="text" class="form-control" placeholder="{{ trans('message.ingmod')}}" aria-describedby="modelo3">
                                </div>
                              </div>
                              <div class="col-lg-4">
                                <div class="input-group">
                                  <span class="input-group-addon"><i class="glyphicon glyphicon-asteris text-danger">*</i></span>
                                  <input name="cliente3" id="cliente3" type="number" class="form-control" placeholder="Máximo 5 digitos." maxlength="5" aria-describedby="cliente3">
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="list-group-item">
                            <div class="row">
                              <small class="col-md-12 control-label">
                                 <h4><span class="label label-primary">TOP 4</span></h4>
                              </small>
                              <div class="col-lg-4">
                                <div class="input-group">
                                  <span class="input-group-addon"><i class="glyphicon glyphicon-asteris text-danger">*</i></span>
                                  <input name="mac4" id="mac4" type="text" class="form-control" placeholder="{{ trans('message.ingmac')}}" aria-describedby="mac4">
                                </div>
                              </div>
                              <div class="col-lg-4">
                                <div class="input-group">
                                  <span class="input-group-addon"><i class="glyphicon glyphicon-asteris text-danger">*</i></span>
                                  <input name="modelo4" id="modelo4" type="text" class="form-control" placeholder="{{ trans('message.ingmod')}}" aria-describedby="modelo4">
                                </div>
                              </div>
                              <div class="col-lg-4">
                                <div class="input-group">
                                  <span class="input-group-addon"><i class="glyphicon glyphicon-asteris text-danger">*</i></span>
                                  <input name="cliente4" id="cliente4" type="number" class="form-control" placeholder="Máximo 5 digitos." maxlength="5" aria-describedby="cliente4">
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="list-group-item">
                            <div class="row">
                              <small class="col-md-12 control-label">
                                 <h4><span class="label label-primary">TOP 5</span></h4>
                              </small>
                              <div class="col-lg-4">
                                <div class="input-group">
                                  <span class="input-group-addon"><i class="glyphicon glyphicon-asteris text-danger">*</i></span>
                                  <input name="mac5" type="text" id="mac5" class="form-control" placeholder="{{ trans('message.ingmac')}}" aria-describedby="mac5">
                                </div>
                              </div>
                              <div class="col-lg-4">
                                <div class="input-group">
                                  <span class="input-group-addon"><i class="glyphicon glyphicon-asteris text-danger">*</i></span>
                                  <input name="modelo5" id="modelo5" type="text" class="form-control" placeholder="{{ trans('message.ingmod')}}" aria-describedby="modelo5">
                                </div>
                              </div>
                              <div class="col-lg-4">
                                <div class="input-group">
                                  <span class="input-group-addon"><i class="glyphicon glyphicon-asteris text-danger">*</i></span>
                                  <input name="cliente5" id="cliente5" type="number" class="form-control" placeholder="Máximo 5 digitos." maxlength="5" aria-describedby="cliente5">
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="list-group-item">
                            <a id="generateapsInfo" class="btn btn-success"><i class="fa fa-bookmark-o"></i> {{ trans('message.capturar')}}</a>
                            <a id="generateapsClear" class="btn btn-danger"><i class="fa fa-ban"></i> {{ trans('message.cancelar')}}</a>
                          </li>
                        </ul>
                      </form>
                    </div>
                  </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                  * {{ trans('message.meansrequired')}}
                </div>
              </div>
            </div>

            <div class="col-xs-12 col-md-12 col-md-6 col-lg-6">
              <div class="box box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title">{{ trans('message.contentwlantop')}}</h3>
                  <div class="box-tools pull-right">
                    <!-- <span class="label label-primary">Label</span> -->
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <div class="row">
                    <div class="col-sm-12">
                      <form id="form_wlan" name="form_wlan" class="form-inline" action="">
                      {{ csrf_field() }}

                          <div class="form-group">
                            <label for="select_four" class="control-label">{{ trans('message.hotel') }}: </label>
                            <select id="select_four" name="select_four"  class="form-control select2" required>
                              <option value="" selected> Elija </option>
                              @forelse ($hotels as $data_hotel)
                                <option value="{{ $data_hotel->id }}"> {{ $data_hotel->Nombre_hotel }} </option>
                              @empty
                              @endforelse
                            </select>
                          </div>

                          <div class="form-group">
                            <label for="fecha_nwlan" class=" col-md-2 control-label">{{ trans('message.date') }}: </label>
                            <div class="col-md-10">
                              <input id="fecha_nwlan" name="fecha_nwlan" type="text"  maxlength="10"
                                class="form-control input-md datepickermonth">
                            </div>
                          </div>

                          <ul class="list-group">
                            <li class="list-group-item">
                              <div class="row">
                                <small class="col-md-12 control-label">
                                   <h4><span class="label label-primary">TOP 1</span></h4>
                                </small>
                                <div class="col-lg-6">
                                  <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-asteris text-danger">*</i></span>
                                    <input name="nombrew1" id="nombrew1" type="text" class="form-control" placeholder="{{ trans('message.ingnombw')}}" aria-describedby="nombrew1">
                                  </div>
                                </div>
                                <div class="col-lg-6">
                                  <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-asteris text-danger">*</i></span>
                                    <input name="clientew1" id="clientew1" type="number" class="form-control" placeholder="{{ trans('message.ingnumcw')}}" aria-describedby="clientew1">
                                  </div>
                                </div>
                              </div>
                            </li>
                            <li class="list-group-item">
                              <div class="row">
                                <small class="col-md-12 control-label">
                                   <h4><span class="label label-primary">TOP 2</span></h4>
                                </small>
                                <div class="col-lg-6">
                                  <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-minus"></i></span>
                                    <input name="nombrew2" id="nombrew2" type="text" class="form-control" placeholder="{{ trans('message.ingnombw')}}" aria-describedby="nombrew2">
                                  </div>
                                </div>
                                <div class="col-lg-6">
                                  <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-minus"></i></span>
                                    <input name="clientew2" id="clientew2" type="number" class="form-control" placeholder="{{ trans('message.ingnumcw')}}" aria-describedby="clientew2">
                                  </div>
                                </div>
                              </div>
                            </li>
                            <li class="list-group-item">
                              <div class="row">
                                <small class="col-md-12 control-label">
                                   <h4><span class="label label-primary">TOP 3</span></h4>
                                </small>
                                <div class="col-lg-6">
                                  <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-minus"></i></span>
                                    <input name="nombrew3" id="nombrew3" type="text" class="form-control" placeholder="{{ trans('message.ingnombw')}}" aria-describedby="nombrew3">
                                  </div>
                                </div>
                                <div class="col-lg-6">
                                  <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-minus"></i></span>
                                    <input name="clientew3" id="clientew3" type="number" class="form-control" placeholder="{{ trans('message.ingnumcw')}}" aria-describedby="clientew3">
                                  </div>
                                </div>
                              </div>
                            </li>
                            <li class="list-group-item">
                              <div class="row">
                                <small class="col-md-12 control-label">
                                   <h4><span class="label label-primary">TOP 4</span></h4>
                                </small>
                                <div class="col-lg-6">
                                  <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-minus"></i></span>
                                    <input name="nombrew4" id="nombrew4" type="text" class="form-control" placeholder="{{ trans('message.ingnombw')}}" aria-describedby="nombrew4">
                                  </div>
                                </div>
                                <div class="col-lg-6">
                                  <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-minus"></i></span>
                                    <input name="clientew4" id="clientew4" type="number" class="form-control" placeholder="{{ trans('message.ingnumcw')}}" aria-describedby="clientew4">
                                  </div>
                                </div>
                              </div>
                            </li>
                            <li class="list-group-item">
                              <div class="row">
                                <small class="col-md-12 control-label">
                                   <h4><span class="label label-primary">TOP 5</span></h4>
                                </small>
                                <div class="col-lg-6">
                                  <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-minus"></i></span>
                                    <input name="nombrew5" id="nombrew5" type="text" class="form-control" placeholder="{{ trans('message.ingnombw')}}" aria-describedby="nombrew5">
                                  </div>
                                </div>
                                <div class="col-lg-6">
                                  <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-minus"></i></span>
                                    <input name="clientew5" id="clientew5" type="number" class="form-control" placeholder="{{ trans('message.ingnumcw')}}" aria-describedby="clientew5">
                                  </div>
                                </div>
                              </div>
                            </li>
                            <li class="list-group-item">
                              <a id="generatewlanInfo" class="btn btn-success"><i class="fa fa-bookmark-o"></i> {{ trans('message.capturar')}}</a>
                              <a id="generatewlanClear" class="btn btn-danger"><i class="fa fa-ban"></i> {{ trans('message.cancelar')}}</a>
                            </li>
                          </ul>
                      </form>
                    </div>
                  </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                  * {{ trans('message.meansrequired')}}.
                  - {{ trans('message.meansnotrequired')}}.
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
@if( auth()->user()->can('View individual capture') )
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.2.0/min/dropzone.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.2.0/min/dropzone.min.js"></script>
<script src="{{ asset('js/admin/report/individual.js')}}"></script>
<style media="screen">
  .list-group-item{
    border: 0;
  }
</style>

@else
<!--NO VER-->
@endif
@endpush
