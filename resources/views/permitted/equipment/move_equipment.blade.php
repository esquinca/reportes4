@extends('layouts.app')

@section('contentheader_title')
  @if( auth()->user()->can('View move equipment') )
    {{ trans('message.title_equipment') }}
  @else
    {{ trans('message.title_equipment') }}
  @endif
@endsection

@section('contentheader_description')
  @if( auth()->user()->can('View move equipment') )
    {{ trans('message.subtitle_move_equipment') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('breadcrumb_ubication')
  @if( auth()->user()->can('View move equipment') )
    {{ trans('message.breadcrumb_move_equipment') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('content')
    @if( auth()->user()->can('View move equipment') )
      <div class="container">
        <div class="row">
          <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
            <div class="box box-solid">
              <div class="box-body">
                <div class="form-inline">
                    {{ csrf_field() }}
                    <div class="form-group">
                      <label for="select_one" class="control-label">{{ trans('message.hotel') }}: </label>
                      <select id="select_one" name="select_one"  class="form-control select2" required>
                        <option value="" selected> Elija </option>
                        @forelse ($hotels as $data_hotel)
                          <option value="{{ $data_hotel->id }}"> {{ $data_hotel->Nombre_hotel }} </option>
                        @empty
                        @endforelse
                      </select>

                      <label class="control-label" for="mac_input1">Mac o serie: </label>
                      <div class="input-group ">
                        <input name="mac_input1" id="mac_input1" placeholder="Minimo 4 digitos." minlength="4" type="text" class="form-control" value="">
                      </div>
                      <button type="button" id="btn_search_mac1" class="btn btn-info">Buscar M/S</button>
                    </div>

                </div>
                </div>
            </div>
          </div>

          <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 pt-10">
            <div class="hojitha" style="background-color: #fff; border:1px solid #ccc; border-bottom-style:hidden; padding:10px; width: 100%">
             <div class="row">
               <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                 <h4 style="background-color:#f7f7f7; font-size: 18px; text-align: center; padding: 7px 10px; margin-top: 0;">
                   Equipamiento - Actual
                 </h4>
               </div>
               <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                 <div class="table-responsive">
                   <form id="table_check" method="POST">
                      <table id="table_move" cellspacing="0" class="table table-striped table-bordered table-hover">
                        <thead>
                          <tr class="bg-primary" style="background: #088A68;">
                            <th> <small>0</small> </th>
                            <th> <small>Cliente.</small> </th>
                            <th> <small>Equipo.</small> </th>
                            <th> <small>Marca.</small> </th>
                            <th> <small>Mac.</small> </th>
                            <th> <small>Serie.</small> </th>
                            <th> <small>Modelo.</small> </th>
                            <th> <small>Estado.</small> </th>
                            <th> <small>Fecha Alta.</small> </th>
                            <th> <small>Acción</small> </th>
                          </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot id='tfoot_average'>
                          <tr>
                          </tr>
                        </tfoot>
                      </table>
                      <div class="form-inline">
                        <div class="form-group">
                          <label for="select_two" class="control-label">{{ trans('general.hotel') }} Destino: </label>
                          <select id="select_two" name="select_two"  class="form-control select2" required>
                             <option value="" selected> Elija </option>
                             @forelse ($hotels as $data_hotel_two)
                               <option value="{{ $data_hotel_two->id }}"> {{ $data_hotel_two->Nombre_hotel }} </option>
                             @empty
                             @endforelse
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="select_three" class="control-label">Estatus: </label>
                          <select id="select_three" name="select_three"  class="form-control select2" required>
                             <option value=""> Elija </option>
                             <option value="999" selected> Conservar estados </option>
                             @forelse ($estados as $data_estados)
                               <option value="{{ $data_estados->id }}"> {{ $data_estados->Nombre_estado }} </option>
                             @empty
                             @endforelse
                          </select>
                        </div>
                        <div class="form-group">
                           <button type="button" class="btn btn-info btnconf">Mover</button>
                        </div>
                      </div>
                      <!-- <p><b>Selected rows data:</b></p>
                      <pre id="example-console-rows"></pre> -->
                   </form>
                 </div>
               </div>
             </div>
           </div>
           <!--Modal confirmación-->
           <div class="modal modal-default fade" id="modal-confirmation" data-backdrop="static">
             <div class="modal-dialog" >
               <div class="modal-content">
                 <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                   <h4 class="modal-title"><i class="fa fa-bookmark" style="margin-right: 4px;"></i>Confirmación</h4>
                 </div>
                 <div class="modal-body">
                   <div class="box-body">
                     <div class="row">
                       <div class="col-xs-12">
                         <h4 style="font-weight: bold;">¿Are you sure you want to continue?</h4>
                       </div>
                     </div>
                   </div>
                 </div>
                 <div class="modal-footer">
                   <button type="button" class="btn btn-danger btn-conf-action"><i class="fa fa-trash" style="margin-right: 4px;"></i>Confirmar</button>
                   <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times" style="margin-right: 4px;"></i>{{ trans('message.ccmodal') }}</button>
                 </div>
               </div>
             </div>
           </div>
         <!--Modal confirmación-->

         <!--Modal Descripción-->
         <div class="modal modal-default fade" id="modal-comments" data-backdrop="static">
           <div class="modal-dialog" >
             <div class="modal-content">
               <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h4 class="modal-title"><i class="fa fa-id-card-o" style="margin-right: 4px;"></i>Descripción</h4>
               </div>
               <div class="modal-body">
                 <div class="box-body table-responsive">
                   <div class="box-body">
                     <div class="row">
                       <div class="col-xs-12">
                         <div class="form-group">
                           <div class="col-sm-12">
                             <input id="token_min" name="token_min" type="hidden" class="form-control" placeholder="">
                             <textarea id="comment_a" name="comment_a"  class="form-control" style="min-width: 100%" maxlength="150"></textarea>
                           </div>
                         </div>
                       </div>
                     </div>
                   </div>
                 </div>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-success btn-update-descrip">Actualizar</button>
                 <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times" style="margin-right: 4px;"></i>{{ trans('message.ccmodal') }}</button>
               </div>
             </div>
           </div>
         </div>
         <!--Modal Descripción-->


        </div>


        </div>
        </br>

          <div class="row" style="display: none;">
            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
              <div class="box box-solid">
                <div class="box-body">
                  <div class="form-horizontal">
                      {{ csrf_field() }}
                     <div class="form-group">
                         <label class="col-md-2 control-label" for="mac_input">Mac o serie: </label>
                         <div class="col-md-10">
                          <div class="input-group ">
                            <input name="mac_input" id="mac_input_blocked" placeholder="Minimo 4 digitos." minlength="4" type="text" class="form-control" value="">
                          </div>
                         </div>
                    </div>
                    <div class="form-group">
                      <div class="col-md-2 text-right">
                        <button type="button" id="btn_search_mac_blocked" class="btn btn-info">Buscar Mac</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
              <div class="table-responsive">
                   <table id="table_buscador_blocked" cellspacing="0" class="table table-striped table-bordered table-hover">
                     <thead>
                       <tr class="bg-primary" style="background: #088A68;">
                         <th> <small>Cliente.</small> </th>
                         <th> <small>Equipo.</small> </th>
                         <th> <small>Marca.</small> </th>
                         <th> <small>Mac.</small> </th>
                         <th> <small>Serie.</small> </th>
                         <th> <small>Modelo.</small> </th>
                         <th> <small>Estado.</small> </th>
                         <th> <small>Fecha Registro.</small> </th>
                       </tr>
                     </thead>
                     <tbody>
                     </tbody>
                   </table>
              </div>
            </div>

          </div>
      </div>

    @else
      @include('default.denied')
    @endif
@endsection

@push('scripts')
  @if( auth()->user()->can('View move equipment') )
  <!--Extra Datatable--->
    <link type="text/css" href="//gyrocode.github.io/jquery-datatables-checkboxes/1.2.10/css/dataTables.checkboxes.css" rel="stylesheet" />
    <script type="text/javascript" src="//gyrocode.github.io/jquery-datatables-checkboxes/1.2.10/js/dataTables.checkboxes.min.js"></script>
    <script src="{{ asset('js/admin/equipment/move_equipment.js')}}"></script>
  @else
    <!--NO VER-->
  @endif
@endpush
