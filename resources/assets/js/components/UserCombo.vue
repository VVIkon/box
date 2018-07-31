<template>
    <div id="combouser" class="col-xs-12 form-group">
        <label for="chat_autor" class="control-label">Автор</label>
        <select id="chat_autor" v-model="userid" @change="closedCombo" class="form-control short-length">
            <option v-for="user in users" v-bind:value="user.id">{{user.name}}</option>
        </select>
    </div>
</template>

<script>
  export default {
    name: "UserCombo",
    props: ['userid'],
    data() {
      return {
        currUserId:0,
        users: '',
      }
    },

    methods:{
      loadUsers: function(){

        let app = this;
        axios.get('/admin/user-list')    //@userList
          .then(function (r) {
             app.users = r.data;
             //console.log('app.users: '+JSON.stringify( app.users) );
          })
          .catch(function (r) {
            console.log('Ошибочка: ' + r)
          });
       // console.log('this.userid: '+this.userid);
        this.currUserId = this.userid;
      },
      closedCombo: function(){
        this.currUserId = this.userid;
        this.$emit('senduserid', this.currUserId);
        //console.log('-->userId: '+this.userId);
        // this.$parent.$options.methods.getUserId(this.userId);
      }
    },
    mounted(){
      this.loadUsers();
    }


  }
</script>

<style scoped>
    .short-length {
        width: 220px;
    }
</style>