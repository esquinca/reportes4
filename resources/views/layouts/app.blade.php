<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

@include('layouts.partials.admin_htmlheader')

<body class="hold-transition skin-red sidebar-collapse sidebar-mini">
  <div class="wrapper">
    @include('layouts.partials.admin_mainheader')
    @include('layouts.partials.admin_sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      @include('layouts.partials.alert')
      @include('layouts.partials.admin_contentheader')

      <section class="content container-fluid">
        @yield('content')
      </section>

    </div>
    <!-- /.content-wrapper -->
    @include('layouts.partials.admin_footer')
    @include('layouts.partials.admin_controlsidebar')
  </div>

  @section('script')
    @include('layouts.partials.admin_scripts')
  @show
</body>
</html>
