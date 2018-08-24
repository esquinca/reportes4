@extends('layouts.app')

@section('contentheader_title')
  @if( auth()->user()->can('View add request of payment') )
    {{ trans('message.pay_add_request') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('contentheader_description')
  @if( auth()->user()->can('View add request of payment') )
    {{ trans('message.subtitle_pay_add') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('breadcrumb_ubication')
  @if( auth()->user()->can('View add request of payment') )
    {{ trans('message.breadcrumb_pay_add') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('content')
    @if( auth()->user()->can('View add request of payment') )
    @if (session('status'))
    <div class="alert alert-success">
      {{ session('status') }}
    </div>
    @endif
    @if (session('abort'))
    <div class="alert alert-danger">
      {{ session('abort') }}
    </div>
    @endif

    <div class="modal modal-default fade" id="modal_bank" data-backdrop="static">
        <div class="modal-dialog" >
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title"><i class="fa fa-bank" style="margin-right: 4px;"></i>{{ trans('pay.data_bakl') }}</h4>
            </div>
            <div class="modal-body">
              <div class="box-body table-responsive">
                <div class="box-body">
                  <div class="row">
                  @if( auth()->user()->can('Create data bank') )
                    <div class="col-xs-12">
                      <form class="form-horizontal" id="data_account_bank" name="data_account_bank">
                        {{ csrf_field() }}
                        <div class="form-group">
                          <label for="reg_provider" class="col-xs-2 control-label">{{ trans('pay.proveedor') }}</label>
                          <div class="col-xs-10">
                            <input class="form-control" type="text" name="reg_provider" id="reg_provider" value="" readonly>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="reg_bancos" class="col-xs-2 control-label">{{ trans('pay.bank') }}</label>
                          <div class="col-xs-10">
                            <select id="reg_bancos" name="reg_bancos" class="form-control select2" style="width:100%;">
                              <option value="" selected>{{ trans('pay.select_op') }}</option>
                              @forelse ($banquitos as $data_banquitos)
                                <option value="{{ $data_banquitos->id }}"> {{ $data_banquitos->nombre }} </option>
                              @empty
                              @endforelse
                            </select>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="reg_coins" class="col-xs-2 control-label">{{ trans('pay.type_coins') }}</label>
                          <div class="col-xs-10">
                            <select id="reg_coins" name="reg_coins" class="form-control select2" style="width:100%;">
                              <option value="" selected>{{ trans('pay.select_op') }}</option>
                              @forelse ($currency as $data_currency)
                                <option value="{{ $data_currency->id }}"> {{ $data_currency->name }} </option>
                              @empty
                              @endforelse
                            </select>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="reg_cuenta" class="col-md-2 control-label">{{ trans('pay.cuenta') }}</label>
                          <div class="col-md-10">
                            <input class="form-control" type="text" name="reg_cuenta" id="reg_cuenta" value="">
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="reg_clabe" class="col-md-2 control-label">{{ trans('pay.clabe') }}</label>
                          <div class="col-md-10">
                            <input class="form-control" type="text" name="reg_clabe" id="reg_clabe" value="">
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="reg_reference" class="col-md-2 control-label">{{ trans('pay.reference') }}</label>
                          <div class="col-md-10">
                            <input class="form-control" type="text" name="reg_reference" id="reg_reference" value="">
                          </div>
                        </div>
                        @if( auth()->user()->can('Create data bank provider') )
                          <button type="submit" class="btn bg-navy"><i class="fa fa-plus-square-o" style="margin-right: 4px;"></i>{{ trans('message.create') }}</button>
                          <!-- <button type="button" class="btn bg-navy create_provider"><i class="fa fa-plus-square-o" style="margin-right: 4px;"></i>{{ trans('message.create') }}</button> -->
                        @endif
                        <button type="button" class="btn btn-danger delete_provider" data-dismiss="modal"><i class="fa fa-times" style="margin-right: 4px;"></i>{{ trans('message.cancelar') }} & {{ trans('message.ccmodal') }}</button>

                      </form>
                    </div>
                  @else
                    <div class="col-xs-12">
                      @include('default.deniedmodule')
                    </div>
                  @endif
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
            </div>
          </div>
        </div>
    </div>

    <form id="validation" name="validation" action="{{ url('create_one_payment') }}" method="POST" enctype="multipart/form-data">
      <div class="container">
        <div class="row">
          <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
              {{ csrf_field() }}
              <div class="box">
                <div class="box-body box-solid">
                    <div id="captura_pdf_general" style="margin-left:4em;font-size:1.1em;" class="">
                      <div class="hojitha">
                        <div class="header-pays">
                          <div class="row">
                            <div class="col-md-2">
                              <img class="logo-sit" src="{{ asset('/images/users/logo.svg') }}" style="padding-bottom:20px;width:100px" />
                            </div>
                            <div class="col-md-3 col-md-offset-2">
                              <h3>{{ trans('pay.title') }}</h3>
                            </div>
                            <div style="padding-top:1.1em;" class="col-md-4 col-md-offset-1">
                              <p class="text-left">
                                <strong>{{ trans('pay.date_solicitude') }}:
                                    @php
                                     $mytime = Carbon\Carbon::now();
                                     echo $mytime->toDateTimeString();
                                    @endphp
                                </strong>
                              </p>
                              <p class="text-left">
                                <strong>{{ trans('pay.date_pay') }}: {{ trans('pay.no_data') }}
                                </strong>
                              </p>
                            </div>
                          </div>

                          <!---------------------------------------------------------------------------->
                          <div class="row">
                            <div class="form-group">
                              <label for="priority_viat" class="col-md-2 control-label">{{ trans('pay.prioridad') }}: </label>
                              <div class="col-md-2">
                                <select id="priority_viat" name="priority_viat" class="form-control">
                                  <!-- <option value="" selected>{{ trans('pay.select_op') }}</option> -->
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
                              <!-- <div class="col-md-2 col-md-offset-1">
                                <input class="form-control" type="text" id="idProject" name="idProject" value="" disabled="true">
                              </div> -->
                            </div>
                          </div>

                          <!---------------------------------------------------------------------------->




                          <div class="row">
                            <div class="form-group">
                              <label for="project" class="col-md-2 control-label">{{ trans('pay.project') }}: </label>
                              <div class="col-md-6">
                                <select id="project" name="project" class="form-control">
                                  <option value="" selected>{{ trans('pay.elije_proy') }}</option>
                                  @forelse ($cadena as $data_cadena)
                                    <option value="{{ $data_cadena->id }}"> {{ $data_cadena->name }} </option>
                                  @empty
                                  @endforelse
                                </select>
                              </div>
                              <div class="col-md-2 col-md-offset-1">
                                <input class="form-control" type="text" id="idProject" name="idProject" value="" disabled="true">
                              </div>
                            </div>
                          </div>
                          <div class="row margin-top-short">
                            <div class="form-group">
                              <label for="customer" class="col-md-2 control-label">{{ trans('pay.sitio') }}</label>
                                <div class="col-md-6">
                                  <select id="customer" name="customer" class="form-control">
                                    <option value="" selected>{{ trans('pay.select_op') }}</option>
                                  </select>
                                </div>
                            </div>
                         </div>
                        <div class="row margin-top-short">
                          <div class="form-group">
                            <label for="provider" class="col-md-2 control-label">{{ trans('pay.proveedor') }}</label>
                            <div class="col-md-4">
                              <select id="provider" name="provider" class="form-control select2">
                                <option value="" selected>{{ trans('pay.select_op') }}</option>
                                @forelse ($proveedor as $data_proveedor)
                                  <option value="{{ $data_proveedor->id }}"> {{ $data_proveedor->nombre }} </option>
                                @empty
                                @endforelse
                              </select>
                            </div>
                            <label for="amount" class="col-md-1 control-label">{{ trans('pay.amount') }}</label>
                            <div class="col-md-2">
                              <input class="form-control" type="text" name="amount" id="amount" value="">
                            </div>
                            <div class="col-md-2">
                              <select id="coin" name="coin" class="form-control">
                                <option value="" selected>{{ trans('pay.select_op') }}</option>
                                @forelse ($currency as $data_currency)
                                  <option value="{{ $data_currency->id }}"> {{ $data_currency->name }} </option>
                                @empty
                                @endforelse
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="row margin-top-short">
                          <div class="col-md-9 col-md-offset-2">
                            <input class="form-control" type="text" disabled="true" name="amountText" id="amountText" value="">
                          </div>
                        </div>
                        <hr>
                      <!--  Fin del header de pago -->
                        <div class="row">
                          <div class="form-group">
                            <label for="factura" class="col-md-2 control-label">{{ trans('pay.factura') }}</label>
                            <div class="col-md-9">
                              <input class="form-control" type="text" name="factura" id="factura" value="">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="form-group">
                            <label for="description" class="col-md-2 control-label">{{ trans('pay.concept_pay') }}</label>
                            <div class="col-md-9">
                              <textarea style="resize:none;" class="form-control" id="description" name="description" rows="2" cols="40"></textarea>
                            </div>
                          </div>
                        </div>
                        <div class="row margin-top-short">
                          <!-- <div class="form-group col-md-6">
                            <label for="method-pay" class="col-md-4 control-label">{{ trans('pay.way_pay') }}</label>
                            <div class="col-md-8">
                              <select class="form-control" name="methodPay" id="methodPay">
                                <option value="" selected>{{ trans('pay.select_op') }}</option>
                                @forelse ($way as $data_way)
                                  <option value="{{ $data_way->id }}"> {{ $data_way->name }} </option>
                                @empty
                                @endforelse
                              </select>
                            </div>
                          </div> -->

                          <div class="col-md-6">
                              <div class="form-horizontal">
                                <div class="form-group">
                                  <label for="method-pay" class="text-right col-md-4 control-label">{{ trans('pay.way_pay') }}</label>
                                  <div class="col-md-8">
                                    <select class="form-control" name="methodPay" id="methodPay">
                                      <option value="" selected>{{ trans('pay.select_op') }}</option>
                                      @forelse ($way as $data_way)
                                        <option value="{{ $data_way->id }}"> {{ $data_way->name }} </option>
                                      @empty
                                      @endforelse
                                    </select>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <!-- <label for="reference_banc" class="text-left col-md-4 control-label">{{ trans('pay.file_input') }}</label>
                                  <div class="col-md-6">
                                    <span class="btn btn-default btn-file">
                                        {{ trans('pay.file_input') }} <input type="file">
                                    </span>
                                    <input type="file" name="archivo" class="form-control" />
                                  </div> -->
                                  <!-- <label for="file" class="text-left col-md-4 control-label">{{ trans('pay.file_input') }}</label>
                                  <div class="col-md-8">
                                    <span class="btn btn-warning btn-file">
                                        <input type="file" name="archivo" class="form-control" />
                                    </span>
                                  </div> -->

                                  <div class="col-md-12">
                                    <div class="input-group">
                                        <label class="input-group-btn">
                                            <span class="btn btn-primary">
                                                {{ trans('pay.file_input') }} <input id="fileInput" name="fileInput" type="file" style="display: none;">
                                            </span>
                                        </label>
                                        <input type="text" class="form-control" readonly>
                                    </div>
                                  </div>

                                </div>
                              </div>
                           </div>

                          <div class="col-md-6">
                            <label for="" class="col-md-12 control-label">{{ trans('pay.data_bank') }}</label>
                              <div class="form-horizontal">
                                <div class="form-group text-left">
                                  <label for="bank" class="text-left col-md-4 control-label">{{ trans('pay.bank') }}</label>
                                  <div class="col-md-6">
                                    <select class="form-control" id="bank" name="bank">
                                      <option value="" selected>{{ trans('pay.select_op') }}</option>
                                    </select>
                                  </div>
                                </div>
                                <div class="form-group text-left">
                                  <label for="account" class="text-left col-md-4 control-label">{{ trans('pay.cuenta') }}</label>
                                    <div class="col-md-6">
                                      <select id="account" name="account" class="form-control">
                                        <option value="" selected>{{ trans('pay.select_op') }}</option>
                                      </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                  <label for="clabe" class="text-left col-md-4 control-label">{{ trans('pay.clabe') }}</label>
                                  <div class="col-md-6">
                                    <input type="text" class="form-control" id="clabe" name="clabe" placeholder="{{ trans('pay.clabe_int') }}" disabled>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label for="reference_banc" class="text-left col-md-4 control-label">{{ trans('pay.reference') }}</label>
                                  <div class="col-md-6">
                                    <input type="text" class="form-control" id="reference_banc" name="reference_banc" placeholder="{{ trans('pay.reference_bank') }}" disabled>
                                  </div>
                                </div>

                                <div class="form-group">
                                  <div class="col-md-6 col-md-offset-4">
                                    <a class="btn btn-block btn-social btn-google databank"><i class="fa fa-plus-square"></i> Añadir datos bancarios</a>
                                    <!-- <a class="btn btn-block btn-social btn-google" data-toggle="modal" data-target="#modal_bank"><i class="fa fa-plus-square"></i> Añadir datos bancarios</a> -->
                                  </div>
                                </div>

                              </div>
                           </div>
                        </div>
                        <hr>

                        <div class="row">
                          <div class="form-group col-md-4 col-md-offset-2">
                            <p><strong>{{ trans('pay.area') }}</strong></p>
                            @forelse ($area as $id => $name)
                            <div class="checkbox">
                              <label>
                                <input id="{{$id}}" name="areas[]" type="checkbox" value="{{$id}}"> {{ $name }}
                              </label>
                            </div>
                            @empty
                            @endforelse
                          </div>
                          <div class="form-group col-md-4 col-md-offset-2">
                            <p><strong>{{ trans('pay.application') }}</strong></p>
                            @forelse ($application as $id => $name)
                            <div class="radio">
                              <label>
                                <input type="radio" name="opt_application" value="{{$id}}" > {{ $name }}
                              </label>
                            </div>
                            @empty
                            @endforelse
                          </div>
                        </div>
                        <div class="row margin-top-short">
                          <div class="form-group">
                            <label for="project-name" class="col-md-2 control-label">{{ trans('pay.name_project') }}</label>
                              <div class="col-md-9">
                                <input class="form-control" type="text" id="projectName" name="projectName" value="">
                              </div>
                          </div>
                       </div>
                       <div class="row margin-top-short">
                         <div class="form-group">
                           @forelse ($options as $id => $name)
                           <div class="col-md-4 col-md-offset-2">
                             <div class="radio">
                               <label>
                                 <input type="radio" name="installation" value="{{$id}}" > {{ $name }}
                               </label>
                             </div>
                           </div>
                           @empty
                           @endforelse
                         </div>
                      </div>
                      <hr>

                      <div class="row">

                        <div class="form-group col-md-3 col-md-offset-1">
                          <p><strong>{{ trans('pay.type_project') }}</strong></p>
                          @forelse ($vertical as $id => $name)
                            <div class="checkbox">
                              <label>
                                <input id="{{$id}}" name="verticals[]" type="checkbox" value="{{$id}}"> {{ $name }}
                              </label>
                            </div>
                          @empty
                          @endforelse
                        </div>
                        <!-- -->
                        <div class="form-group col-md-4 col-md-offset-2">
                          <p><strong>{{ trans('pay.class_cost') }}</strong></p>
                          <select class="form-control" id="classification_pay" name="classification_pay">
                            <option value="" selected>{{ trans('pay.select_op') }}</option>
                            @forelse ($classification as $data_classification)
                              <option value="{{ $data_classification->id }}"> {{ $data_classification->name }} </option>
                            @empty
                            @endforelse
                          </select>
                          <p class="margin-top-large"><strong>{{ trans('pay.financing') }}</strong></p>
                          @forelse ($financing as $id => $name)
                          <div class="checkbox">
                            <label>
                              <input id="{{$id}}" name="financings[]" type="checkbox" value="{{$id}}"> {{ $name }}
                            </label>
                          </div>
                          @empty
                          @endforelse
                        </div>
                      </div>

                      <div class="row">
                        <div class="form-group">
                          <label for="observaciones" class="col-md-2 control-label">{{ trans('pay.observation') }}</label>
                          <div class="col-md-9">
                            <textarea style="resize:none;" class="form-control" id="observaciones" name="observaciones" rows="3" cols="40"></textarea>
                          </div>
                        </div>
                      </div>
                      <br><br><br>
                      <div class="row">
                        <div class="col-sm-12">
                          <p><strong>{{ trans('pay.email_conf') }}</strong></p>
                          <p>{{ Auth::user()->email}}</p>
                        </div>
                      </div>
                      <div class="row margin-top-large text-center">
                        <div class="col-sm-offset-2">
                          <div class="col-xs-3 border-top margin-left-short"><p>{{ Auth::user()->name}}</p><p>{{ trans('pay.elaboro') }}</p></div>
                          <div class="col-xs-3 border-top margin-left-short"><p>René Gonzalez Sánchez</p><p>{{ trans('pay.reviso') }}</p></div>
                          <div class="col-xs-3 border-top margin-left-short"><p>Alejandro Espejo Sokol</p><p>{{ trans('pay.autorizo') }}</p></div>
                        </div>
                      </div>
                    </div>


                </div>
              </div>
          </div>
        </div>
        <!-- Fin box form-->

        <div class="form-group">
          <input type="submit" class="btn btn-info" value="Guardar">
        </div>



      </div>
    </form>
    @else
      @include('default.denied')
    @endif
@endsection

@push('scripts')
  @if( auth()->user()->can('View add request of payment') )
    <script src="{{ asset('bower_components/jsPDF/dist/jspdf.min.js')}}"></script>
    <script src="{{ asset('bower_components/html2canvas/html2canvas.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/pdf.css')}}" >

    <!-- FormValidation -->
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/jquery-wizard-master/libs/formvalidation/formValidation.min.css')}}" >
    <!-- FormValidation plugin and the class supports validating Bootstrap form -->
    <script src="{{ asset('plugins/jquery-wizard-master/libs/formvalidation/formValidation.min.js')}}"></script>
    <script src="{{ asset('plugins/jquery-wizard-master/libs/formvalidation/bootstrap.min.js')}}"></script>

    <link href="/plugins/sweetalert-master/dist/sweetalert.css" rel="stylesheet" type="text/css" />
    <script src="/plugins/sweetalert-master/dist/sweetalert-dev.js"></script>

    <script src="{{ asset('js/admin/payments/request_payment.js')}}"></script>

    <script src="{{ asset('js/admin/payments/modal_bank.js')}}"></script>

    <script type="text/javascript">
      (function() {
        $('#validation').formValidation({
          framework: 'bootstrap',
          excluded: ':disabled',
          fields: {
            fileInput: {
              validators: {
                    notEmpty: {
                        message: 'The PDF file is required'
                    },
                    file: {
                        extension: 'pdf',
                        type: 'application/pdf',
                        message: 'Please choose a PDF file'
                    }
                }
            },
            priority_viat: {
                validators: {
                    notEmpty: {
                        message: 'Please select a priority.'
                    }
                }
            },
            project: {
                validators: {
                    notEmpty: {
                        message: 'Please select a project.'
                    }
                }
            },
            customer: {
                validators: {
                    notEmpty: {
                        message: 'Please select a venue.'
                    }
                }
            },
            provider: {
                validators: {
                    notEmpty: {
                        message: 'Please select a Provider.'
                    }
                }
            },
            coin: {
                validators: {
                    notEmpty: {
                        message: 'Please select a currency denomination.'
                    }
                }
            },
            classification_pay : {
              validators: {
                  notEmpty: {
                      message: 'Please select a classification.'
                  }
              }
            },
            amount: {
              validators: {
                 notEmpty: {
                     message: 'The price is required'
                 },
                 numeric: {
                     message: 'The price must be a numeric number'
                 }
              }
            },
            factura: {
              validators: {
                  notEmpty: {
                      message: 'The invoice number is required.'
                  }
              }
            },
            description: {
               validators: {
                   notEmpty: {
                       message: 'The payment concept is required'
                   },
                   stringLength: {
                       max: 700,
                       message: 'The payment concept must be less than 700 characters long'
                   }
               }
            },
            methodPay: {
                validators: {
                    notEmpty: {
                        message: 'Please select a payment method.'
                    }
                }
            },
            bank: {
                validators: {
                    notEmpty: {
                        message: 'Please select a bank.'
                    }
                }
            },
            account: {
                validators: {
                    notEmpty: {
                        message: 'Please select a account.'
                    }
                }
            },
            'areas[]': {
                validators: {
                    choice: {
                        min: 1,
                        max: 3,
                        message: 'Please choose 1 - 3 areas'
                    }
                }
            },
            opt_application: {
              validators: {
                  notEmpty: {
                      message: 'Please select a application.'
                  }
              }
            },
            projectName: {
              validators: {
                  notEmpty: {
                      message: 'The name of the project is required.'
                  }
              }
            },
            installation: {
              validators: {
                  notEmpty: {
                      message: 'Please select a application.'
                  }
              }
            },
            'verticals[]': {
                validators: {
                    choice: {
                        min: 1,
                        max: 3,
                        message: 'Please choose 1 - 3 type of project.'
                    }
                }
            },
            'financings[]': {
                validators: {
                    choice: {
                        min: 1,
                        max: 2,
                        message: 'Please choose 1 - 2 financings'
                    }
                }
            },
            observaciones: {
               validators: {
                   notEmpty: {
                       message: 'The description is required'
                   },
                   stringLength: {
                       max: 700,
                       message: 'The observations must be less than 700 characters long'
                   }
               }
            },
          }
        })
      })();
    </script>
    <script type="text/javascript">
    (function() {
      $('#data_account_bank').formValidation({
        framework: 'bootstrap',
        excluded: ':disabled',
        fields: {
          reg_bancos: {
              validators: {
                  notEmpty: {
                      message: 'Please select a bank.'
                  }
              }
          },
          reg_coins: {
              validators: {
                  notEmpty: {
                      message: 'Please select a type of currency.'
                  }
              }
          },
          // reg_cuenta: {
          //   validators: {
          //     notEmpty: {
          //       message: 'The account number is required.'
          //     },
          //     stringLength: {
          //       min: 4,
          //       message: 'The account number must have at least 4 characters',
          //     },
          //   }
          // },
          reg_clabe: {
            validators: {
              notEmpty: {
                message: 'The  bank code is required.'
              },
              stringLength: {
                min: 4,
                message: 'The bank code must have at least 4 characters',
              },
            }
          },
          // reg_reference: {
          //   validators: {
          //     notEmpty: {
          //       message: 'The reference number is required.'
          //     },
          //     stringLength: {
          //       min: 4,
          //       message: 'The reference number must have at least 4 characters',
          //     },
          //   }
          // },
        }
      })
      .on('success.form.fv', function(e) {
        e.preventDefault();

        var id = $('#provider').val();
        var objData = $('#data_account_bank').find("select,textarea, input").serialize();
        $.ajax({
          type: "POST",
          url: "/setdata_bank",
          data: objData+ "&identificador=" + id,
          success: function (data){
            if (data == '1') {
              $('#modal_bank').modal('toggle');
              swal("Operación Completada!", ":)", "success");
              $('#bank').empty();
              $('#bank').append('<option value="">Elegir...</option>');
              getBank(); //Esta en el otro js
            }
            else {
              $('#modal_bank').modal('toggle');
              swal("Operación abortada", "Error al registrar intente otra vez :(", "error");
              $('#bank').empty();
              $('#bank').append('<option value="">Elegir...</option>');
              getBank(); //Esta en el otro js

            }
          },
          error: function (data) {
            console.log('Error:', data);
          }
        });
      });

    })();
    </script>
    <script>
    $(function() {
      // We can attach the `fileselect` event to all file inputs on the page
      $(document).on('change', ':file', function() {
        var input = $(this),
            numFiles = input.get(0).files ? input.get(0).files.length : 1,
            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        input.trigger('fileselect', [numFiles, label]);
      });

      // We can watch for our custom `fileselect` event like this
      $(document).ready( function() {
          $(':file').on('fileselect', function(event, numFiles, label) {

              var input = $(this).parents('.input-group').find(':text'),
                  log = numFiles > 1 ? numFiles + ' files selected' : label;

              if( input.length ) {
                  input.val(log);
              } else {
                  if( log ) alert(log);
              }

          });
      });
    });
    </script>
  @else
    <!--NO VER-->
  @endif
@endpush
<style>
  .logo-sit{
    margin-left: 0px;
  }

</style>
