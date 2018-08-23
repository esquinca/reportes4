<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    @yield('contentheader_title', 'Page Header here')
    <small>@yield('contentheader_description')</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="home"><i class="fa fa-dashboard"></i> @yield('breadcrumb_title', 'Inicio')</a></li>
    <li class="active">@yield('breadcrumb_ubication')</li>
  </ol>
</section>
