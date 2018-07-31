<template>
    <div>
        <div class="form-group">
            <router-link :to="{name: 'blog-cht', params: {blog_id: this.chatItem.blog_id} }" class="btn btn-default btn-add-e pull-left" title = 'к списку...'><i class="fa fa-list-alt"></i></router-link>
        </div>

        <div class="form-group">
            <h3>{{deleteMode==2?'Удаление чата': deleteMode==1?'Изменение чата':'Новый чат' }}</h3>
        </div>

        <div class="panel panel-default">
            <div class="panel-body">
                <form v-on:submit="saveMethod()">
                    <div class="row">
                        <usercombo v-bind:userid="chatItem.user_id" v-on:senduserid="getUserId"></usercombo>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label for="chat_comment" class="control-label">сообщение</label>
                            <textarea id='chat_comment' placeholder="Your Message" v-model="chatItem.chat_comment" class="form-control blog-textarea"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <button class="btn btn-success" @click = "saveMethod">{{deleteMode==2?'Удалить':'Сохранить'}}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</template>

<script>
  import userCombo from './UserCombo.vue';

  let elem = document.getElementById('currentuserid');
  let userId=0;
  if (elem){
    userId = elem.getAttribute('data-userid')
  }

  export default {
    name: "ChatEdit",
    props:['id','currchat', 'blogid'],
    data () {
      return {
        chatItem:{
          id:'',
          parent_id:'',
          blog_id:'',
          user_id: userId,
          user: {},
          chat_comment:'',
          created_at:null
        },
        deleteMode:0 // 0 - new; 1-edit; 2-delete
      }
    },
    components:{
      'usercombo': userCombo
    },
    // render(h) {
    //   return h(userCombo);
    // },
    methods:{
       saveMethod: function(){
        event.preventDefault();
        let app = this;
        let operPath = '/admin/blog-chat-save';
        let retPath = '/blog-list/chat/'+this.chatItem.blog_id;

        if(this.deleteMode ===2){
           operPath = '/admin/blog-chat-delete'
        }

        //console.log('this.chatItem: '+JSON.stringify(this.chatItem) );
        axios.post(operPath, this.chatItem)
          .then(function(resp){
            if (resp.data.result==true){
              app.$router.replace(retPath)
            }
          })
          .catch(function(resp){
            console.log('ERROR: '+resp)
          })

       },

      loadBlogItem: function(){
        let app = this;
        if (this.currchat) {
          this.chatItem = this.currchat;
        }else{
          this.chatItem.blog_id = this.blogid;
        }
        //console.log('this.chatItem: '+JSON.stringify(this.chatItem));

        this.deleteMode=0;
        if (this.chatItem.id) {
          this.deleteMode=1;
          if (this.id < 0) {
            this.deleteMode=2;
          }
        }
      },

      getUserId: function(value){
       // console.log('<---- value: '+value);
        this.chatItem.user_id = value;
      }
    },
    mounted(){
      console.log('BChatEdit: '+window.location.pathname);
      this.loadBlogItem()
    }
  }
</script>

<style>
    #chat_comment{
        height: 200px;
    }
    .short-length{
        width: 120px
    }

    .btn-add-e {
        margin: -7px 17px;
        line-height: 34px;
        padding: 0 30px;
    }

</style>
