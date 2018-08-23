<template>
  <li class="dropdown messages-menu" style="visibility: none;">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
      <i class="fa fa-bell-o"></i>
      <span class="label label-warning">{{payments.length}}</span>
    </a>
    <ul class="dropdown-menu">
      <li class="header">{{payments.length}} notificaciones de pago</li>
      <li>
        <!-- inner menu: contains the messages -->
        <ul class="menu">

          <!--aqui empieza el desmadre-->
          <li><!-- start message -->
            <a :href="'/view_history_req_pay'" v-for="status in payments">
              <div class="pull-left">
                <!-- User Image -->
                <img :src="status.avatar" class="img-circle" alt="User Image">
              </div>
              <h4>
                <span><small>Folio: {{ status.Folio }}</small></span><br>
                <span><small>Estatus: {{ status.status_id	 }}</small></span><br>
                <span><small>Ult. Mov. por: {{ status.user_id }}</small></span>
                <!-- <span><small>{{ status.user_id }}</small></span><br> -->
                <small><i class="fa fa-clock-o"> {{ status.last_created }} </i></small>
              </h4>
            </a>

          </li>
          <!--aqui empieza el desmadre-->
        </ul>
      </li>
      <li class="footer"><a :href="'/view_history_all_req_pay'">See all payment notifications</a></li>
    </ul>
  </li>
</template>

<script>
  export  default {
    name: "StatusPay",
    data(){
      return {
        payments: [],
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
          axios.post('/notification_p')
              .then(res => {
                this.payments = res.data;
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
