<template>
    <div id="comment-list-container" class="comment-list">
        <div class="comment" v-bind:class="{'comment-replied': chatItem.parent_id > 0}" :id="'comment-'+chatItem.id" v-for="chatItem in blogChatList">
            <div class="row">
                <div class="col m12 s12">
                    <div class="comment-header ">
                        <a href="#" class="comment-user-name">
                            <span class="small material-icons">accessibility</span>
                            {{chatItem.user.name}}
                        </a>
                        <a href="#" class="comment-create-at">
                            <span class="small material-icons">access_time</span>
                            {{chatItem.created_at}}
                        </a>
                        <a :id="'id-'+chatItem.id" :href="'#comment-'+chatItem.id" class="comment-ansver pull-right" v-if="!chatItem.parent_id" @click="chatEnterCall">
                            <span class="small material-icons">input</span>
                            Ответить
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col m12 s12">
                    <div class="comment-text panel panel-shadow">
                        <img :src="'/upload/'+chatItem.user.imgPath" alt="" class="comment-user">
                        <div class="comment-txt">{{chatItem.chat_comment}}</div>
                        <span class="label parent-label pull-right">id: {{chatItem.id}} parent_id: {{chatItem.parent_id}}</span>
                    </div>
                </div>
            </div>


        </div>
        <chat-enter
                :parentid=this.parentId
                :blogid=this.blogId
                :containershow=this.editContainerShow
        ></chat-enter>
    </div>
</template>

<script>

  import axios from 'axios';
  import BlogPageChatEnter from './BlogPageChatEnter.vue';

  export default {
    name: "BlogPageChat",
    props:['blogid'],
    data (){
      return {
        blogId:null,
        blogChatList:[],
        parentId: null,
        editContainerShow:true
      }
    },
    components:{
      'chat-enter': BlogPageChatEnter
    },
    methods: {

      chatEnterCall (){
        let Id = event.target.id;
        if (Id){
          this.editContainerShow = false;
          this.parentId = Number(Id.split('-').pop());

          let editEl = document.getElementById('blog-chat-edit');
          let parentEl = document.querySelector('#comment-'+this.parentId);
          parentEl.appendChild(editEl);

          let editMessageEl = document.getElementById('chat-message');
          editMessageEl.focus();
          this.editContainerShow = true;

          //console.log(editMessageEl);
        }
      },

      chatSetDefault (){
          this.editContainerShow = false;
          let editEl = document.querySelector('#blog-chat-edit');
          let parentEl = document.querySelector('#comment-list-container');
          parentEl.appendChild(editEl);
          this.parentId = null;
          this.editContainerShow = true;
          //console.log(parentEl);
      },

      loadChatList (blogid = null){
        let currBlogId;
        let app = this;
        if (blogid){
          currBlogId = blogid;
        }else{
          currBlogId = this.blogid;
        }
        this.blogId = currBlogId;

        //console.log('blogid: '+this.blogid);

        if (currBlogId > 0) {
          let operPath = '/admin/blog-chats-load/' + currBlogId;
          axios.get(operPath)
            .then(function (resp) {
              //console.log('RespData: '+JSON.stringify(resp.data));
              app.blogChatList = resp.data
            })
            .catch(function (resp) {
              console.log('ERROR: ' + resp)
            })
        }
      }
    },

    watch:{
      blogid (newBlogId) {
        if(newBlogId > 0){
          this.loadChatList(newBlogId);
        }
      }
    },
    // beforeRouteUpdate (to, from, next){
    //   console.log('1. to.params: '+to.params.blogid);
    //   this.loadChatList(to.params.blogid);
    //   next();
    // },
    mounted(){
      this.loadChatList();
      this.$on('reloadPage', function (blogId) {
        this.loadChatList(blogId);
        this.chatSetDefault();
      })
    }
  }
</script>



<style scoped>
    .row{
        margin-bottom:0;
    }
    .panel {
        -webkit-transition: -webkit-box-shadow .25s;
        transition: -webkit-box-shadow .25s;
        transition: box-shadow .25s;
        transition: box-shadow .25s, -webkit-box-shadow .25s;
        padding: 24px;
        /*margin: 0.5rem 0 1rem 0;*/
        border-radius: 2px;
        background-color: #fff;
    }
    .panel-shadow{
        -webkit-box-shadow: 0 4px 2px 0 rgba(0, 0, 0, 0.14), 0 3px 1px -2px rgba(0, 0, 0, 0.12), 0 1px 5px 0 rgba(0, 0, 0, 0.2);
        box-shadow: 0 4px 4px 0 rgba(0, 0, 0, 0.14), 0 3px 1px -2px rgba(0, 0, 0, 0.12), 0 1px 5px 0 rgba(0, 0, 0, 0.2);
    }

    .comment-header {
        margin-left: 85px;
        /*margin-bottom: -5px;*/
        margin-top: 15px;
    }

    .comment-user-name {
        -webkit-transition: all 250ms linear;
        transition: all 250ms linear;
        color: #7f8c8c;
        font-size: 16px;
        font-weight: 700;
        margin-right: 15px;
    }
    .comment-ansver{
        -webkit-transition: all 250ms linear;
        transition: all 250ms linear;
        color: #e36b2c;
    }
    .pull-right {
        float: right!important;
    }

    .comment-user {
        background: 0 0;
        color: #333;
        font-size: 14px;
        padding: 0;
        height: 100px;
        width: 85px;
        background-color: #b1b7b7;
        border-radius: 5px;
        color: #fff;
        font-size: 52px;
        padding: 2px;
        position: relative;
        left: -35px;
        top: -45px;
    }

    .comment-txt {
        margin-left: 65px;
        margin-top: -75px;
        /*padding: 19px 10px 19px 50px;*/
        position: relative;
        line-height: 1.6;
    }
    .comment-replied {
        margin-left: 35px;
    }
    .parent-label{
        color: #fff;
        background-color: #337ab7;
    }
</style>