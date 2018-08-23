<template>
  <li class="dropdown messages-menu" style="visibility: none;">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
      <i class="fa fa-envelope-o"></i>
      <span class="label label-success">{{statuses.length}}</span>
    </a>
    <ul class="dropdown-menu">
      <li class="header">{{statuses.length}} notificaciones de viaticos</li>
      <li>
        <!-- inner menu: contains the messages -->
        <ul class="menu">

          <!--aqui empieza el desmadre-->
          <li><!-- start message -->
            <a :href="'/view_request_via'" v-for="status in statuses">
              <div class="pull-left">
                <!-- User Image -->
                <img :src="status.avatar" class="img-circle" alt="User Image">
              </div>
              <h4>
                <span><small>Folio: {{ status.folio }}</small></span><br>
                <span><small>Prioridad: {{ status.priority }} - Estatus:{{ status.estado }}</small></span><br>
                <span><small>{{ status.nombre }}</small></span><br>
                <small><i class="fa fa-clock-o">{{ status.fecha }}</i></small>
              </h4>
              <!-- <p>Estatus: <span class="label label-default">{{ status.estado }}</span> </p> -->
            </a>

          </li>
          <!--aqui empieza el desmadre-->
        </ul>
      </li>
    </ul>
  </li>
</template>

<script>
  export  default {
    name: "StatusForm",
    data(){
      return {
        statuses: [],
         interval: null,
      }
    },
    mounted() {
      this.loadData();

       this.interval = setInterval(function () {
         this.loadData();
       }.bind(this), 30000);
    },
    methods: {
        loadData: function () {
          axios.post('/notification_s')
              .then(res => {
                this.statuses = res.data;
                // console.log(res.data)
              })
              .catch(err => {
                console.log(err.data)
              })
        }
    },
    beforeDestroy: function(){
       clearInterval(this.interval);
   }
  }
</script>

<style scoped>
</style>
