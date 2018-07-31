<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Example Component</div>

                    <div class="panel-body">
                        <p>{{this.msg}}</p>
                        <p>{{this.cod}}</p>
                        <p>{{this.dy}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
      props:[
        'urlmessage'
      ],
      data () {
        return {
          msg:'',
          cod:0,
          dy: 0
        }
      },
      methods:{
        update: function(){
          this.msg = this.urlmessage.msg;
          this.cod = this.urlmessage.cod;
          this.dy = this.urlmessage.day;
          //console.log(this.urlmessage)
        }
      },
      mounted(){
        this.update()
      }
    }
</script>
