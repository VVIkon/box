<template>
    <transition name="edit-chat">
        <div id="blog-chat-edit" class="container panel panel-shadow" v-show="showContainer">
            <form>
                <div class="row">
                    <div class="input-field col s12">
                        <textarea id="chat-message" class="materialize-textarea" v-model="blogMessage.chat_comment"></textarea>
                        <label for="chat-message" class="">Сообщение</label>
                        <a class="waves-effect waves-light btn-small" @click="saveNewMessage">
                            Отправить
                            <i class="material-icons right">send</i>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </transition>
</template>

<script>
  import axios from 'axios';

  let elem = document.getElementById('currentuserid');
  let userId=0;
  if (elem){
    userId = elem.getAttribute('data-userid')
  }

  export default {
    name: "BlogPageChatEnter",
    props:['parentid','blogid', 'containershow'],
    data () {
      return {
          blogMessage: {
            parent_id: null,
            blog_id: null,
            user_id: userId,
            chat_comment: null
          },
          showContainer: true
      }
    },
    methods:{

      saveNewMessage () {
        event.preventDefault();
        let app = this;
        let operPath = '/admin/blog-chat-save';
        let retPath = '/blog-page/'+app.blogMessage.blog_id;

        //console.log('saveNewMessage: '+JSON.stringify(app.blogMessage));

        axios.post(operPath, app.blogMessage)
          .then(function(resp){
            if (resp.data.result==true){
               //console.log(resp.data);
              app.blogMessage.chat_comment = '';
              app.$parent.$emit('reloadPage', app.blogMessage.blog_id);
            }
          })
          .catch(function(resp){
            console.log('Ошибочка: '+resp)
          })
      },

      loadBlogMessage () {
        this.blogMessage.parent_id = this.parentid;
        this.blogMessage.blog_id = this.blogid;
        // console.log("blogMessage: "+ JSON.stringify(this.blogMessage) );
      }
    },

    watch:{
      blogid () {
        this.loadBlogMessage();
      },
      parentid () {
        this.loadBlogMessage();
      },
      containershow (newMode){
        this.showContainer = newMode;
      }
    }
    // mounted(){
    //
    //   this.loadBlogMessage();
    // }

  }

</script>

<style scoped>
    .edit-chat-enter-active, .edit-chat-leave-active {
        transition: opacity 3s;
    }
    .edit-chat-enter, .edit-chat-leave-to{
        opacity: 0;
    }

</style>