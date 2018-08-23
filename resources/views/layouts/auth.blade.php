<!DOCTYPE html>
<html>

@include('layouts.partials.htmlheader')

@yield('content')

@include('layouts.partials.scripts_auth')
@include('layouts.partials.alert_auth')
</html>
