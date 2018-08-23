<template>
  <li class="dropdown messages-menu" style="visibility: none;">
    <!-- Menu toggle button -->
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
      <i class="fa fa-envelope-o"></i>
      <span class="label label-success">4</span>
    </a>
    <ul class="dropdown-menu">
      <li class="header">You have 4 notifications</li>
      <li>
        <!-- inner menu: contains the messages -->
        <ul class="menu">
          <li><!-- start message -->
            <a href="#">
              <div class="pull-left">
                <!-- User Image -->
                @if (Auth::user()->avatar == null)
                <img src="dist/img/user.jpg" class="img-circle" alt="User Image">
                @else
                <img src="{{Auth::user()->avatar}}" class="img-circle" alt="User Image">
                @endif
              </div>
              <h4>
                <span><small>{{Auth::user()->name}}</small></span><br>
                <span><small>Nueva Solicitud</small></span>
                <small><i class="fa fa-clock-o"></i></small>
              </h4>
              <p>Estatus: <span class="label label-default">Pendiente</span> </p>
            </a>
          </li>
        </ul>
      </li>
      <li class="footer"><a href="#">See All Notification</a></li>
    </ul>
  </li>

    <!-- <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Example Component</div>

                    <div class="panel-body">
                        I'm an example component!
                    </div>
                </div>
            </div>
        </div>
    </div> -->
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
