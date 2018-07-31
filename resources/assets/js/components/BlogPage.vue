<template>

   <div class="page-container">
       <div class="row">
           <div class="col s12 m12">
               <div class="card">
               <!--<div class="card horizontal">-->
                   <div class="card-image">
                       <img :src="'/img/'+blogItem.blog_img" class="blog-image">
                       <span class="card-title">{{blogItem.blog_header}}</span>
                   </div>
                   <div class="card-content blog-text">
                       <p v-html="blogItem.bolg_content"></p>
                       <div class="card-panel teal">
                            <span class="white-text">{{blogItem.blog_hashtags}}</span>
                       </div>
                   </div>

               </div>
               <div class="card-panel light-blue lighten-5">
                   <h3 class="card-title">Комментарии</h3>
                   <blogchat
                        :blogid=blogItem.id
                   ></blogchat>
               </div>
           </div>
       </div>
   </div>

</template>

<script>
  import blogPageChat from './BlogPageChat.vue'


  export default {
    name: "BlogPage",
    inheritAttrs: false,
    props: ['blog_id','currblog'],
    data () {
      return {
        blogItem: {
          id: -1,
          blog_header: null,
          blog_img: null,
          file_content: null,
          bolg_content: null,
          blog_hashtags: null
        }
      }
    },
    components:{
      'blogchat': blogPageChat
    },

    methods:{
      loadBlogItem: function(nextCurrBlog = null) {
        if (nextCurrBlog){
          this.blogItem = nextCurrBlog;
        } else{
            this.blogItem = this.currblog;
        }
        // console.log('2. this.currblog: '+this.currblog.blog_header);
        if (this.blogItem){
          let img =  this.blogItem.blog_img;
          let ind = img.indexOf('_s.');
          let newImg;
          //console.log ('ind: '+ind)
          if(ind >=0){
            newImg = img.substr(0,ind+1)+'b'+img.substr(ind+2,img.length-ind+2);
          }else{
            newImg = img;
          }
          this.blogItem.blog_img = newImg;
          // if (this.blogItem.blog_chat.lenght > 0){
          //   this.blogChatList = this.loadBlogChat(this.blogItem.id);
          // }
          //
          // console.log('3. blogChatList: '+this.blogChatList);
        }
      },
      loadBlogChat: function(blogId){

      }
    },

    beforeRouteUpdate (to, from, next){
      // console.log('1. to.params: '+to.params.currblog.blog_header);
      this.loadBlogItem(to.params.currblog);
      next();
    },
    mounted(){
      //console.log('BlogPage: '+window.location.pathname);
      this.loadBlogItem();
    }
  }
</script>

<style scoped>

    .blog-text{
        white-space: pre-wrap;
    }

</style>