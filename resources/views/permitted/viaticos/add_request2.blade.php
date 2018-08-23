@extends('layouts.app')

@section('contentheader_title')
  @if( auth()->user()->can('View add request of travel expenses') )
    {{ trans('message.viaticos_add_request') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('contentheader_description')
  @if( auth()->user()->can('View add request of travel expenses') )
    {{ trans('message.viaticos') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('breadcrumb_ubication')
  @if( auth()->user()->can('View add request of travel expenses') )
    {{ trans('message.breadcrumb_viaticos_add') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('content')
    @if( auth()->user()->can('View add request of travel expenses') )
    <!--  Content create survey -->
    <div class="container">
      <div class="row">
          <div class="col-sm-12">
              <div style="padding:10px; width: 100%">
                  @if (session('status'))
                  <div class="alert alert-success">
                    {{ session('status') }}
                  </div>
                  @endif
                  <div id="exampleValidator" class="wizard">
                      <ul class="wizard-steps" role="tablist">
                          <li class="active" role="tab">
                              <h4><span><i class="fa fa-address-card"></i></span>Requerimientos</h4>
                          </li>
                          <li role="tab">
                              <h4><span><i class="fa fa-list-ol"></i></span>Conceptos</h4>
                          </li>
                          <!-- <li role="tab">
                              <h4><span><i class="fa fa-save"></i></span>Password</h4> </li> -->
                      </ul>
                      <form id="validation" name="validation" class="form-horizontal" action="{{ url('create_viatic_new') }}" method="POST" >
                        {{ csrf_field() }}
                          <div class="wizard-content">
                              <div class="wizard-pane active" role="tabpanel">
                                <div class="row">
                                  <div class="col-xs-6"></div>
                                  <div class="col-xs-6">
                                    <div class="form-group">
                                      <label class="col-xs-2 control-label">Prioridad</label>
                                      <div class="col-xs-10 selectContainer">
                                          <select name="priority_id" class="form-control">
                                              @forelse ($priority as $data_priority)
                                                @if ($data_priority->id === 2)
                                                  <option value="{{ $data_priority->id }}" selected> {{ $data_priority->name }} </option>
                                                @else
                                                  <option value="{{ $data_priority->id }}"> {{ $data_priority->name }} </option>
                                                @endif
                                              @empty
                                              @endforelse
                                          </select>
                                      </div>
                                    </div>

                                  </div>
                                </div>


                                  <div class="row">
                                    <div class="col-lg-6">
                                      <div class="form-group">
                                        <label class="col-xs-2 control-label">Servicio</label>
                                        <div class="col-xs-10 selectContainer">
                                            <select name="service_id" class="form-control">
                                                <option value="" selected></option>
                                                @forelse ($service as $data_service)
                                                  <option value="{{ $data_service->id }}"> {{ $data_service->name }} </option>
                                                @empty
                                                @endforelse
                                            </select>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-lg-6">
                                      <div class="form-group">
                                        <label class="col-xs-2 control-label">Gerente</label>
                                        <div class="col-xs-10 selectContainer">
                                            <select name="gerente_id" class="form-control">
                                                <option value="" selected></option>
                                                @forelse ($jefe as $data_jefe)
                                                  <option value="{{ $data_jefe->id }}"> {{ $data_jefe->Nombre }} </option>
                                                @empty
                                                @endforelse
                                            </select>
                                        </div>
                                      </div>
                                    </div>
                                  </div>

                                  <div class="row">
                                    <div class="col-lg-6">
                                      <div class="form-group">
                                        <label class="col-xs-2 control-label">Beneficiario</label>
                                        <div class="col-xs-10 selectContainer">
                                            <select name="beneficiario_id" class="form-control benef">
                                              <option value="" selected></option>
                                              @forelse ($beneficiary as $data_beneficiary)
                                                <option value="{{ $data_beneficiary->id }}"> {{ $data_beneficiary->name }} </option>
                                              @empty
                                              @endforelse
                                            </select>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-lg-6">
                                      <div class="form-group">
                                        <label class="col-xs-2 control-label">Solicitante</label>
                                        <div class="col-xs-10 selectContainer">
                                            <select name="user_id" class="form-control">
                                              <option value="" selected></option>
                                            </select>
                                        </div>
                                      </div>
                                    </div>
                                  </div>

                                  <div class="row">
                                    <div class="col-lg-6">
                                      <div class="form-group">
                                         <label class="col-xs-3 control-label">Fecha Inicio</label>
                                         <div class="col-xs-9 dateContainer">
                                             <div class="input-group input-append date" id="startDatePicker" name="startDatePicker">
                                                 <input type="text" class="form-control" name="startDate" />
                                                 <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                             </div>
                                         </div>
                                      </div>
                                    </div>
                                    <div class="col-lg-6">
                                      <div class="form-group">
                                        <label class="col-xs-3 control-label">Fecha Fin</label>
                                        <div class="col-xs-9 dateContainer">
                                            <div class="input-group input-append date" id="endDatePicker" name="endDatePicker">
                                                <input type="text" class="form-control" name="endDate" />
                                                <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                            </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>

                                  <div class="row">
                                    <div class="col-lg-6">
                                      <div class="form-group">
                                         <label class="col-xs-3 control-label">Lugar Origen</label>
                                         <div class="col-xs-9">
                                             <input type="text" class="form-control" name="place_o" />
                                         </div>
                                      </div>
                                    </div>
                                    <div class="col-lg-6">
                                      <div class="form-group">
                                         <label class="col-xs-3 control-label">Lugar Destino</label>
                                         <div class="col-xs-9">
                                             <input type="text" class="form-control" name="place_d" />
                                         </div>
                                      </div>
                                    </div>
                                  </div>

                                  <div class="row">
                                    <div class="col-lg-12">
                                      <div class="form-group">
                                        <label class="col-xs-1 control-label">Descripción</label>
                                        <div class="col-xs-11">
                                            <textarea class="form-control" name="descripcion" rows="3"></textarea>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <!--..........................................................................-->
                              </div>
                              <div class="wizard-pane" role="tabpanel">
                                  <div class="form-group">
                                    <div class="col-xs-2">
                                      <label for="ejemplo_email_3" class="control-label">{{ trans('general.cadena') }}</label>
                                        <select name="c_venue[0].venue" class="form-control info-cadena"  data_row="0">
                                            <option value="" selected>Elige {{ trans('general.cadena') }}</option>
                                            @forelse ($cadena as $data_cadena)
                                              <option value="{{ $data_cadena->id }}"> {{ $data_cadena->name }} </option>
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>
                                    <div class="col-xs-2">
                                      <label for="ejemplo_email_3" class="col-xs-12">{{ trans('general.hotel') }}</label>
                                      <select name="c_hotel[0].hotel" class="form-control">
                                          <option value="" selected>Elige {{ trans('general.hotel') }}</option>
                                      </select>
                                    </div>
                                    <div class="col-xs-2">
                                        <label for="ejemplo_email_3" class="col-xs-12">Concepto</label>
                                        <select name="c_concept[0].concept" class="form-control">
                                            <option value="" selected>Elige concepto</option>
                                            @forelse ($concept as $data_concept)
                                              <option value="{{ $data_concept->id }}"> {{ $data_concept->name }} </option>
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>

                                    <div class="col-xs-1" style="width: 12.499999995%">
                                        <label for="ejemplo_email_3" class="col-xs-12">Cantidad</label>
                                        <select name="c_cant[0].cant" class="form-control">
                                            <option value="" selected>Elige</option>
                                            @for ($i = 1; $i <= 10; $i++)
                                                <option value="{{ $i }}"> {{ $i }} </option>
                                            @endfor
                                        </select>
                                    </div>

                                    <div class="col-xs-1" style="width: 12.499999995%">
                                        <label for="ejemplo_email_3" class="col-xs-12">Costo</label>
                                        <input type="text" class="form-control" name="c_priceuni[0].priceuni" placeholder="Costo" />
                                    </div>
                                    <div class="col-xs-1">
                                        <label for="ejemplo_email_3" class="col-xs-12">Subtotal</label>
                                        <input type="text" class="form-control subtotal" name="c_price[0].price" placeholder="Price" readonly/>
                                    </div>
                                    <div class="col-xs-1">
                                        <button type="button" class="btn btn-default addButton"><i class="fa fa-plus"></i></button>
                                    </div>
                                  </div>
                                  <div class="form-group hide" id="optionTemplate">
                                      <div class="col-xs-2 info-cadena">
                                        <select name="venue" class="form-control info-cadena" data_row="">
                                            <option value="" selected>Elige cadena</option>
                                            @forelse ($cadena as $data_cadena)
                                              <option value="{{ $data_cadena->id }}"> {{ $data_cadena->name }} </option>
                                            @empty
                                            @endforelse
                                        </select>
                                      </div>
                                      <div class="col-xs-2">
                                        <select name="hotel" class="form-control">
                                            <option value="" selected>Elige hotel</option>
                                        </select>
                                      </div>
                                      <div class="col-xs-2">
                                        <select name="concept" class="form-control">
                                            <option value="" selected>Elige Concepto</option>
                                            @forelse ($concept as $data_concept)
                                              <option value="{{ $data_concept->id }}"> {{ $data_concept->name }} </option>
                                            @empty
                                            @endforelse
                                        </select>
                                      </div>
                                      <div class="col-xs-1" style="width: 12.499999995%">
                                        <select name="cant" class="form-control">
                                          <option value="" selected>Elige cantidad</option>
                                          @for ($i = 1; $i <= 10; $i++)
                                              <option value="{{ $i }}"> {{ $i }} </option>
                                          @endfor
                                        </select>
                                      </div>
                                      <div class="col-xs-1" style="width: 12.499999995%">
                                        <input type="text" class="form-control" name="priceuni" placeholder="Costo" />
                                      </div>
                                      <div class="col-xs-1">
                                        <input type="text" class="form-control subtotal" name="price" placeholder="Price" readonly/>
                                      </div>
                                      <div class="col-xs-1">
                                          <button type="button" class="btn btn-default removeButton"><i class="fa fa-minus"></i></button>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                    <div class="col-lg-6 pull-right">
                                      <div class="form-group pull-right">
                                         <label class="col-xs-2 control-label">Total</label>
                                         <div class="col-xs-10">
                                             <input type="text" class="form-control" name="totales" readonly/>
                                         </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-md-offset-8">
                                      <span class="text-danger">Nota: Cantidades en MXN</span>
                                    </div>
                                  </div>
                              </div>

                          </div>
                      </form>
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
  @if( auth()->user()->can('View add request of travel expenses') )

    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/jquery-wizard-master/css/wizard.css')}}" >

    <!-- Form Wizard JavaScript -->
    <script src="{{ asset('plugins/jquery-wizard-master/dist/jquery-wizard.js')}}"></script>
    <!-- FormValidation -->
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/jquery-wizard-master/libs/formvalidation/formValidation.min.css')}}" >
    <!-- FormValidation plugin and the class supports validating Bootstrap form -->
    <script src="{{ asset('plugins/jquery-wizard-master/libs/formvalidation/formValidation.min.js')}}"></script>
    <script src="{{ asset('plugins/jquery-wizard-master/libs/formvalidation/bootstrap.min.js')}}"></script>
    <style media="screen">
      .wizard-steps{display:table;width:100%}
      .wizard-steps>li{
        display:table-cell;
        padding:10px 20px;
        background:#f7fafc
      }
      .wizard-steps>li span{
        border-radius:100%;
        border:1px solid rgba(120,130,140,.13);
        width:40px;
        height:40px;
        display:inline-block;
        vertical-align:middle;
        padding-top:9px;
        margin-right:8px;
        text-align:center
      }
      .wizard-content{
        padding:25px;
        border-color:rgba(120,130,140,.13);
        margin-bottom:30px
      }
      .wizard-steps>li.current,.wizard-steps>li.done{
        background:#228AE6;
        color:#fff
       }
       .wizard-steps>li.current span,.wizard-steps>li.done span{
         border-color:#fff;color:#fff
       }
       .wizard-steps>li.current h4,.wizard-steps>li.done h4{
         color:#fff
       }
       .wizard-steps>li.done{
         background:#1ED760
       }
       .wizard-steps>li.error{
         background:#E73431
       }
    </style>
    <script type="text/javascript">
      function eventListenerSubtotal(){
        var elemento = $('.subtotal');
        var elementos = $('.subtotal').length;
        var arrayID = [];
        var arraytotal = [];
        var total = 0;
        $.each( elemento, function(i, val){
            arrayID.push(  $(val).prop('name'));
            arraytotal.push(  isNaN( $(val).prop('value') ) ? 0 : $(val).prop('value'));
        });
        arraytotal.pop();
        for (var i = 0; i < arraytotal.length; i++) {
            total += arraytotal[i] << 0;
        }
        // remover último elemento
        arrayID.pop();
        // console.log(arrayID.length);
        // console.log(arrayID);
        // console.log(arraytotal);
        // console.log(total);
        $('[name="totales"]').val(total);
      }
      function createEventListener (id) {
        const element = document.querySelector('[name="c_venue['+id+'].venue"]')
        element.addEventListener('change', function() {
          // var name = this.name;
          // console.log(name);
          var _token = $('input[name="_token"]').val();
          $.ajax({
            type: "POST",
            url: "./viat_find_hotel",
            data: { numero : this.value , _token : _token },
            success: function (data){
              if (data === '[]') {
                // $('[name="book['+id+'].hotel"]').empty();
                $('[name="c_hotel['+id+'].hotel"] option[value!=""]').remove();
                // $('[name="book['+id+'].hotel"]').append('<option value="" selected>Elige hotel</option>');
              }
              else{
                $('[name="c_hotel['+id+'].hotel"] option[value!=""]').remove();
                // $('[name="book['+id+'].hotel"]').empty();
                // $('[name="book['+id+'].hotel"]').append('<option value="" selected>Elige hotel</option>');
                $.each(JSON.parse(data),function(index, objdata){
                  $('[name="c_hotel['+id+'].hotel"]').append('<option value="'+objdata.id+'">'+ objdata.Nombre_hotel +'</option>');
                });
              }
            },
            error: function (data) {
              console.log('Error:', data);
            }
          });
          $('#validation').data('formValidation').resetField($('[name="c_hotel['+id+'].hotel"]'));
        });
      }
      function createEventListenerConcept (id) {
        const element = document.querySelector('[name="c_concept['+id+'].concept"]')
        element.addEventListener('change', function() {
          var _token = $('input[name="_token"]').val();
          $.ajax({
            type: "POST",
            url: "./viat_find_concept",
            data: { numero : this.value , _token : _token },
            success: function (data){
              var dato_p = data;
              if (dato_p === '0' || dato_p === '') {
                $('#validation').formValidation('enableFieldValidators', 'c_priceuni[' + id + '].priceuni', false);
                $('#validation').data('formValidation').resetField($('[name="c_priceuni['+id+'].priceuni"]'));

                $('#validation').formValidation('enableFieldValidators', 'c_cant[' + id + '].cant', false);
                $('#validation').data('formValidation').resetField($('[name="c_cant['+id+'].cant"]'));

                $('[name="c_priceuni[' + id + '].priceuni"]').val('');
                $("[name='c_cant[" + id + "].cant'] option[value='']").prop('selected', true);

                $("[name='c_priceuni[" + id + "].priceuni']").prop('disabled', 'disabled');
                $("[name='c_cant[" + id + "].cant']").prop('disabled', 'disabled');
                $('[name="c_price['+id+'].price"]').val('0');
                eventListenerSubtotal();
                // console.log('C0');
              }
              if (dato_p === '1') {
                $('#validation').formValidation('enableFieldValidators', 'c_priceuni[' + id + '].priceuni', true);
                $('#validation').data('formValidation').resetField($('[name="c_priceuni['+id+'].priceuni"]'));

                $('#validation').formValidation('enableFieldValidators', 'c_cant[' + id + '].cant', true);
                $('#validation').data('formValidation').resetField($('[name="c_cant['+id+'].cant"]'));

                $('[name="c_priceuni[' + id + '].priceuni"]').val('');
                $("[name='c_cant[" + id + "].cant'] option[value='']").prop('selected', true);

                $("[name='c_priceuni[" + id + "].priceuni']").prop('disabled', false);
                $("[name='c_cant[" + id + "].cant']").prop('disabled', false);
                eventListenerSubtotal();
                // console.log('C1');
              }

            },
            error: function (data) {
              console.log('Error:', data);
            }
          });
        });
      }
      function createEventListener_amount (id) {
        const element = document.querySelector('[name="c_cant['+id+'].cant"]')
        element.addEventListener('change', function() {
          var total = 0,
              valor = this.value;
              valor = parseInt(valor); // Convertir el valor a un entero (número).

              total = document.getElementsByName('c_priceuni['+id+'].priceuni')[0].value;
              // console.log(total);

              // Aquí valido si hay un valor previo, si no hay datos, le pongo un cero "0".
              total = (total == null || total == undefined || total == "") ? 0 : total;
              // console.log(total);

              /* Esta es la suma.*/
              var total2 = (parseInt(total) * parseInt(valor));
              // console.log(total2);

              /* Cambiamos el valor del Subtotal*/
              $('[name="c_price['+id+'].price"]').val(total2);
              eventListenerSubtotal();
        });
      }
      function createEventListener_priceuni (id) {
        const element = document.querySelector('[name="c_priceuni['+id+'].priceuni"]')
        element.addEventListener('keyup', function() {
          var total = 0,
              valor = this.value;
              valor = parseInt(valor); // Convertir el valor a un entero (número).

              total = document.getElementsByName('c_cant['+id+'].cant')[0].value;
              // console.log(total);

              // Aquí valido si hay un valor previo, si no hay datos, le pongo un cero "0".
              total = (total == null || total == undefined || total == "") ? 0 : total;
              // console.log(total);

              /* Esta es la suma.*/
              var total2 = (parseInt(total) * parseInt(valor));
              // console.log(total2);

              /* Cambiamos el valor del Subtotal*/
              $('[name="c_price['+id+'].price"]').val(total2);
              eventListenerSubtotal();
        });
      }
      $('.benef').on('change', function(e){
        var id= $(this).val();
        var _token = $('input[name="_token"]').val();
        if (id != ''){
          $.ajax({
            type: "POST",
            url: "./search_beneficiary",
            data: { numero : id , _token : _token },
            success: function (data){
              if (data === '[]') {
                $('[name="user_id"] option[value!=""]').remove();
              }
              else{
                $('[name="user_id"] option[value!=""]').remove();
                $.each(JSON.parse(data),function(index, objdata){
                  $('[name="user_id"]').append('<option value="'+objdata.id+'">'+ objdata.nombre +'</option>');
                });
              }
            },
            error: function (data) {
              console.log('Error:', data);
            }
          });
        }
        else {
            $('[name="user_id"] option[value!=""]').remove();
        }
      });
      (function() {
       createEventListener (0);
       createEventListenerConcept (0);
       $("[name='c_priceuni[" + 0 + "].priceuni']").prop('disabled', 'disabled');
       $("[name='c_cant[" + 0 + "].cant']").prop('disabled', 'disabled');

       createEventListener_amount(0);
       createEventListener_priceuni(0);

       // The maximum number of options
       var conceptIndex = 0,
       venue= {
         row: '.col-xs-2',   // The title is placed inside a <div class="col-xs-2"> element
         validators: {
             notEmpty: {
                 message: 'Please select a venue.'
             }
         }
       },
       hotel= {
         row: '.col-xs-2',   // The title is placed inside a <div class="col-xs-2"> element
         validators: {
             notEmpty: {
                 message: 'Please select a hotel.'
             }
         }
       },
       concept= {
         row: '.col-xs-2',   // The title is placed inside a <div class="col-xs-2"> element
         validators: {
             notEmpty: {
                 message: 'Please select a concept.'
             }
         }
       },
       cant= {
         row: '.col-xs-1',   // The title is placed inside a <div class="col-xs-2"> element
         enabled: false,
         validators: {
             notEmpty: {
                 message: 'Please select a amount.'
             }
         }
       },
       priceuni= {
         row: '.col-xs-1',   // The title is placed inside a <div class="col-xs-2"> element
         enabled: false,
         validators: {
            notEmpty: {
                message: 'The price is required'
            },
            numeric: {
                message: 'The price must be a numeric number'
            }
         }
       },
       price= {
         row: '.col-xs-1',   // The title is placed inside a <div class="col-xs-2"> element
         validators: {
            notEmpty: {
                message: 'The price is required'
            },
            numeric: {
                message: 'The price must be a numeric number'
            }
         }
       };
       $('#exampleValidator').wizard({
         onInit: function() {
             $('#validation')
             .find('[name="priority_id"]')
                .select2()
                .change(function(e) {
                    $('#validation').formValidation('revalidateField', 'priority_id');
                })
                .end()
             .find('[name="service_id"]')
                .select2()
                .change(function(e) {
                    $('#validation').formValidation('revalidateField', 'service_id');
                })
                .end()
             .find('[name="beneficiario_id"]')
                 .select2()
                 .change(function(e) {
                     $('#validation').formValidation('revalidateField', 'beneficiario_id');
                 })
                 .end()
             .find('[name="cadena_id"]')
                 .select2()
                 .change(function(e) {
                     $('#validation').formValidation('revalidateField', 'cadena_id');
                 })
                 .end()
             .find('[name="user_id"]')
                 .select2()
                 .change(function(e) {
                     $('#validation').formValidation('revalidateField', 'user_id');
                 })
                 .end()
             .find('[name="gerente_id"]')
                 .select2()
                 .change(function(e) {
                     $('#validation').formValidation('revalidateField', 'gerente_id');
                 })
                 .end()
             .find('[name="startDate"]')
                 .datepicker({
                     format: 'dd/mm/yyyy'
                 })
                 .on('changeDate', function(e) {
                     $('#validation').formValidation('revalidateField', 'startDate');
                 })
                 .end()
             .find('[name="endDate"]')
                 .datepicker({
                     format: 'dd/mm/yyyy'
                 })
                 .on('changeDate', function(e) {
                     $('#validation').formValidation('revalidateField', 'endDate');
                 })
                 .end()
             .formValidation({
               framework: 'bootstrap',
               excluded: ':disabled',
               icon: {
                   valid: 'glyphicon glyphicon-ok',
                   invalid: 'glyphicon glyphicon-remove',
                   validating: 'glyphicon glyphicon-refresh'
               },
               fields: {
                 priority_id: {
                     validators: {
                         notEmpty: {
                             message: 'Please select a service.'
                         }
                     }
                 },
                 service_id: {
                     validators: {
                         notEmpty: {
                             message: 'Please select a service.'
                         }
                     }
                 },
                 beneficiario_id: {
                     validators: {
                         notEmpty: {
                             message: 'Please select a beneficiary.'
                         }
                     }
                 },
                 cadena_id: {
                     validators: {
                         notEmpty: {
                             message: 'Please select a proyect.'
                         }
                     }
                 },
                 user_id: {
                     validators: {
                         notEmpty: {
                             message: 'Please select a user.'
                         }
                     }
                 },
                 gerente_id: {
                     validators: {
                         notEmpty: {
                             message: 'Please select a manager.'
                         }
                     }
                 },
                 startDate: {
                    validators: {
                        notEmpty: {
                            message: 'The start date is required'
                        },
                        date: {
                            format: 'DD/MM/YYYY',
                            max: 'endDate',
                            message: 'The start date is not a valid'
                        }
                    }
                 },
                 endDate: {
                    validators: {
                        notEmpty: {
                            message: 'The end date is required'
                        },
                        date: {
                            format: 'DD/MM/YYYY',
                            min: 'startDate',
                            message: 'The end date is not a valid'
                        }
                    }
                 },
                 place_o: {
                    validators: {
                        notEmpty: {
                            message: 'The origin place  is required'
                        }
                    }
                 },
                 place_d: {
                    validators: {
                        notEmpty: {
                            message: 'The destination place is required'
                        }
                    }
                 },
                 descripcion: {
                    validators: {
                        notEmpty: {
                            message: 'The description is required'
                        },
                        stringLength: {
                            max: 700,
                            message: 'The description must be less than 700 characters long'
                        }
                    }
                 },
                 'c_venue[0].venue': venue,
                 'c_hotel[0].hotel': hotel,
                 'c_concept[0].concept': concept,
                 'c_cant[0].cant': cant,
                 'c_priceuni[0].priceuni': priceuni,
               }
             })
              // Add button click handler
              .on('click', '.addButton', function() {
                  conceptIndex++;
                  var $template = $('#optionTemplate'),
                      $clone    = $template
                                      .clone()
                                      .removeClass('hide')
                                      .removeAttr('id')
                                      .attr('data-book-index', conceptIndex)
                                      .insertBefore($template);
                  // Update the name attributes
                  $clone
                      .find('[name="venue"]').attr('name', 'c_venue[' + conceptIndex + '].venue').attr('data_row', conceptIndex).end()
                      .find('[name="hotel"]').attr('name', 'c_hotel[' + conceptIndex + '].hotel').end()
                      .find('[name="concept"]').attr('name', 'c_concept[' + conceptIndex + '].concept').end()
                      .find('[name="cant"]').attr('name', 'c_cant[' + conceptIndex + '].cant').end()
                      .find('[name="priceuni"]').attr('name', 'c_priceuni[' + conceptIndex + '].priceuni').end()
                      .find('[name="price"]').attr('name', 'c_price[' + conceptIndex + '].price').end();
                  createEventListener (conceptIndex);
                  createEventListenerConcept (conceptIndex);
                  createEventListener_amount (conceptIndex);
                  createEventListener_priceuni(conceptIndex);

                  // Add new fields
                  // Note that we also pass the validator rules for new field as the third parameter
                  $('#validation')
                      .formValidation('addField', 'c_venue[' + conceptIndex + '].venue', venue)
                      .formValidation('addField', 'c_hotel[' + conceptIndex + '].hotel', hotel)
                      .formValidation('addField', 'c_concept[' + conceptIndex + '].concept', concept)
                      .formValidation('addField', 'c_cant[' + conceptIndex + '].cant', cant)
                      .formValidation('addField', 'c_priceuni[' + conceptIndex + '].priceuni', priceuni);
              })
              // Remove button click handler
              .on('click', '.removeButton', function() {
                  var $row  = $(this).parents('.form-group'),
                      index = $row.attr('data-book-index');
                  // Remove field
                  $('#validation')
                      .formValidation('removeField', $row.find('[name="c_venue[' + index + '].venue"]'))
                      .formValidation('removeField', $row.find('[name="c_hotel[' + index + '].hotel"]'))
                      .formValidation('removeField', $row.find('[name="c_concept[' + index + '].concept"]'))
                      .formValidation('removeField', $row.find('[name="c_cant[' + index + '].cant"]'))
                      .formValidation('removeField', $row.find('[name="c_priceuni[' + index + '].priceuni"]'))
                  // Remove element containing the option
                  $row.remove();
                  eventListenerSubtotal();
              })
             .on('success.field.fv', function(e, data) {
                if (data.field === 'startDate' && !data.fv.isValidField('endDate')) {
                    // We need to revalidate the end date
                    data.fv.revalidateField('endDate');
                }
                if (data.field === 'endDate' && !data.fv.isValidField('startDate')) {
                    // We need to revalidate the start date
                    data.fv.revalidateField('startDate');
                }
            })
         },
         validator: function() {
             var fv = $('#validation').data('formValidation');
             var $this = $(this);
             // Validate the container
             fv.validateContainer($this);
             var isValidStep = fv.isValidContainer($this);
             if (isValidStep === false || isValidStep === null  || isValidStep === '') {
               console.log($this);
               console.log(isValidStep);
               //alert('false');
                 return false;
             }
             return true;
         },
         onFinish: function() {
             document.getElementById("validation").submit();
             $('#validation')[0].reset();
             $('#exampleValidator').wizard('first');
             $('#exampleValidator').wizard('reset');
             // menssage_toast('Mensaje', '4', 'Operation complete!' , '3000');
             $('#validation').data('formValidation').resetForm('true');
             $('#exampleValidator').find('li.done').removeClass( "done" );
         },
         onSuccess: function(e) {
         }

        })
      })();
    </script>

  @else
    <!--NO VER-->
  @endif
@endpush
