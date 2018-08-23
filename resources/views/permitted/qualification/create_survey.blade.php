@extends('layouts.app')

@section('contentheader_title')
  @if( auth()->user()->can('View create survey') )
    {{ trans('message.title_survey') }}
  @else
    {{ trans('message.title_survey') }}
  @endif
@endsection

@section('contentheader_description')
  @if( auth()->user()->can('View create survey') )
    {{ trans('message.subtitle_create_survey') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('breadcrumb_ubication')
  @if( auth()->user()->can('View create survey') )
    {{ trans('message.breadcrumb_create_survey') }}
  @else
    {{ trans('message.denied') }}
  @endif
@endsection

@section('content')
    @if( auth()->user()->can('View create survey') )
    <!--  Content create survey -->
    <div class="container">
      <div class="row">
          <div class="col-sm-12">
              <div style="background-color: #fff; border:1px solid #ccc; border-bottom-style:hidden; padding:10px; width: 100%">
                  <h3 class="box-title m-b-0">Generador</h3>
                  <p class="text-muted m-b-30 font-13"> Este apartado nos permite crear, paso por paso una encuesta.</p>
                  @if (session('status'))
                  <div class="alert alert-success">
                    {{ session('status') }}
                  </div>
                  @endif
                  <div id="exampleValidator" class="wizard">
                      <ul class="wizard-steps" role="tablist">
                          <li class="active" role="tab">
                              <h4><span><i class="fa fa-file-o"></i></span>Titulo</h4> </li>
                          <li role="tab">
                              <h4><span><i class="fa fa-list-ol"></i></span>Preguntas</h4> </li>
                          <!-- <li role="tab">
                              <h4><span><i class="fa fa-save"></i></span>Password</h4> </li> -->
                      </ul>
                      <form id="validation" name="validation" class="form-horizontal" action="{{ url('create_survey_record') }}" method="POST" >
                        {{ csrf_field() }}
                          <div class="wizard-content">
                              <div class="wizard-pane active" role="tabpanel">
                                  <div class="form-group">
                                      <label class="col-xs-3 control-label">Titulo</label>
                                      <div class="col-xs-5">
                                          <input type="text" class="form-control" name="title" /> </div>
                                  </div>
                              </div>
                              <div class="wizard-pane" role="tabpanel">
                                <div class="form-group">
                                    <label class="col-xs-3 control-label">Preguntas</label>
                                    <div class="col-xs-5">
                                        <input type="text" class="form-control" name="option[]" />
                                    </div>
                                    <div class="col-xs-4">
                                        <button type="button" class="btn btn-default addButton"><i class="fa fa-plus"></i></button>
                                    </div>
                                </div>
                                  <div class="form-group hide" id="optionTemplate">
                                      <div class="col-xs-offset-3 col-xs-5">
                                          <input class="form-control" type="text" name="option[]" />
                                      </div>
                                      <div class="col-xs-4">
                                          <button type="button" class="btn btn-default removeButton"><i class="fa fa-minus"></i></button>
                                      </div>
                                  </div>
                              </div>
                              <!-- <div class="wizard-pane" role="tabpanel">
                                  <div class="form-group">
                                      <label class="col-xs-3 control-label">Password</label>
                                      <div class="col-xs-5">
                                          <input type="password" class="form-control" name="password" /> </div>
                                  </div>
                              </div> -->
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
  @if( auth()->user()->can('View create survey') )
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/jquery-wizard-master/css/wizard.css')}}" >
    <script src="{{ asset('js/admin/qualification/createsurvey.js')}}"></script>
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
      (function() {
        // The maximum number of options
       var MAX_OPTIONS = 3;
                      //  $('#exampleValidator').find('li.done').removeClass( "done" );

        $('#exampleValidator').wizard({
            onInit: function() {
                $('#validation').formValidation({
                    framework: 'bootstrap',
                    fields: {
                        title: {
                            validators: {
                                notEmpty: {
                                    message: 'The title is required'
                                },
                                stringLength: {
                                    min: 6,
                                    max: 30,
                                    message: 'The title must be more than 6 and less than 30 characters long'
                                },
                                regexp: {
                                    regexp: /^[ña-zÑA-Z0-9_\.]+$/,
                                    message: 'The title can only consist of alphabetical, number, dot and underscore'
                                }
                            }
                        },
                        email: {
                            validators: {
                                notEmpty: {
                                    message: 'The email address is required'
                                },
                                emailAddress: {
                                    message: 'The input is not a valid email address'
                                }
                            }
                        },
                        password: {
                            validators: {
                                notEmpty: {
                                    message: 'The password is required'
                                },
                                different: {
                                    field: 'username',
                                    message: 'The password cannot be the same as username'
                                }
                            }
                        },
                        'option[]': {
                            validators: {
                                notEmpty: {
                                    message: 'The option required and cannot be empty'
                                },
                                stringLength: {
                                    max: 100,
                                    message: 'The option must be less than 100 characters long'
                                }
                            }
                        }
                    }
                })
                // Add button click handler
               .on('click', '.addButton', function() {
                   var $template = $('#optionTemplate'),
                       $clone    = $template
                                       .clone()
                                       .removeClass('hide')
                                       .removeAttr('id')
                                       .insertBefore($template),
                       $option   = $clone.find('[name="option[]"]');

                   // Add new field
                  //  alert('d');
                   $('#validation').formValidation('addField', $option);
               })
               // Remove button click handler
               .on('click', '.removeButton', function() {
                   var $row    = $(this).parents('.form-group'),
                       $option = $row.find('[name="option[]"]');

                   // Remove element containing the option
                   $row.remove();

                   // Remove field
                   $('#validation').formValidation('removeField', $option);
               })

               // Called after adding new field
               .on('added.field.fv', function(e, data) {
                   // data.field   --> The field name
                   // data.element --> The new field element
                   // data.options --> The new field options

                   if (data.field === 'option[]') {
                       if ($('#validation').find(':visible[name="option[]"]').length >= MAX_OPTIONS) {
                           $('#validation').find('.addButton').attr('disabled', 'disabled');
                       }
                   }
               })

               // Called after removing the field
               .on('removed.field.fv', function(e, data) {
                  if (data.field === 'option[]') {
                       if ($('#validation').find(':visible[name="option[]"]').length < MAX_OPTIONS) {
                           $('#validation').find('.addButton').removeAttr('disabled');
                       }
                   }
               });
            },
            validator: function() {
                var fv = $('#validation').data('formValidation');
                var $this = $(this);
                // Validate the container
                fv.validateContainer($this);
                var isValidStep = fv.isValidContainer($this);
                if (isValidStep === false || isValidStep === null) {
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


                //alert('Finalizado');
                //swal("Message Finish!", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lorem erat eleifend ex semper, lobortis purus sed.");
            },
            onSuccess: function(e) {
              // menssage_toast('Mensaje', '4', 'Operation complete!' , '3000');
              // $(".wizard-steps>li.done").removeClass( "done" );
            }
        })

      })();
    </script>

  @else
    <!--NO VER-->
  @endif
@endpush
