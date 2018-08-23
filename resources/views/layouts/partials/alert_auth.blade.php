<!--Toast. -->
<link rel="stylesheet" href="{{ asset('bower_components/toast-master/css/jquery.toast.css') }}"/>
<!-- jQuery 3 -->
<script src="{{ asset('/bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- Jquery Toast-->
<script src="{{ asset('bower_components/toast-master/js/jquery.toast.js')}}"></script>
@if ($message = Session::get('success'))
<script type="text/javascript">
  $.toast({
      heading: 'Mensaje',
      text: '<?php echo $message; ?>',
      position: 'top-right',
      loaderBg: '#DFBE47',
      icon:'success',
      textColor: 'white',
      hideAfter: '3000',
      stack: 6
  });
</script>
<?php Session::forget('success'); ?>
@endif

@if ($message = Session::get('warning'))
<script type="text/javascript">;
	//toastr.error('<?php echo $message; ?>', 'Peligro', {timeOut: 5000})
  $.toast({
      heading: 'Mensaje',
      text: '<?php echo $message; ?>',
      position: 'top-right',
      loaderBg: '#DFBE47',
      icon:'warning',
      textColor: 'white',
      hideAfter: '3000',
      stack: 6
  });
</script>
<?php Session::forget('warning'); ?>
@endif

@if ($message = Session::get('danger'))
<script type="text/javascript">
  $.toast({
      heading: 'Mensaje',
      text: '<?php echo $message; ?>',
      position: 'top-right',
      loaderBg: '#DFBE47',
      icon:'error',
      textColor: 'white',
      bgColor: 'rgba(169, 67, 66, 0.7)',
      hideAfter: '3000',
      stack: 6
  });
</script>
<?php Session::forget('danger'); ?>
@endif
