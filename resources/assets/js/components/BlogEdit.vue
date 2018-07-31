<template>
    <div>
        <div class="form-group">
            <router-link :to="{name: 'blog-lst'}" class="btn btn-default btn-add-e pull-left" title = 'к списку'><i class="fa fa-list-alt"></i></router-link>
        </div>

        <div class="form-group">
            <h3>{{deleteMode==2?'Удаление блога': deleteMode==1?'Изменение блога':'Новый блог' }}</h3>
        </div>

        <div class="panel panel-default">
            <div class="panel-body">
                <form v-on:submit="saveMethod()">
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label for="blog_header" class="control-label">Заголовок</label>
                            <input type="text" v-model="blogItem.blog_header" id="blog_header" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-2 form-group">
                            <image-loader
                                    id='blog_img'
                                    v-bind:blog-img="blogItem.blog_img"
                                    v-on:sendimage="loadPicture"
                            ></image-loader>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <vue-editor id='bolg_content' v-model="blogItem.bolg_content"></vue-editor>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <hashtag-generator
                                id='hashtag-group-control'
                                :hash-tag="blogItem.blog_hashtags"
                                :blog-header="blogItem.blog_header"
                                v-on:sendhashtag="loadHashTags"
                            ></hashtag-generator>

                            <!--<label for="blog_hashtags" class="control-label">Хеш теги</label>-->
                            <!--<input type="text" v-model="blogItem.blog_hashtags" id="blog_hashtags" class="form-control">-->
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

  import { VueEditor } from 'vue2-editor';
  import imageLoader from './ImageLoader/ImageLoader.vue'
  import hashtagGenerator from './HashTagGenerator/HashTagGenerator.vue'

  export default {
    name: "BlogEdit",
    props:['id'],
    data () {
      return {
        blogItem:{
          id:0,
          blog_header:null,
          blog_img:null,
          file_content: null,
          bolg_content:null,
          blog_hashtags:null
        },
        deleteMode:0, // 0 - new; 1-edit; 2-delete
        image:''
      }
    },
    components:{
      'vue-editor': VueEditor,
      'image-loader': imageLoader,
      'hashtag-generator': hashtagGenerator
    },
    methods:{
      saveMethod: function(){
        event.preventDefault();
        let app = this;
        let operPath = '/admin/blog';
        if(this.deleteMode ===2){
          operPath = '/admin/blog-delete'
        }

        //console.log('this.blogItem: '+JSON.stringify(this.blogItem.blog_img));

        axios.post(operPath, this.blogItem)
          .then(function(resp){
            //console.log(resp.data)
            if (resp.data.result==true){
              app.$router.replace('/blog-list')
            }
          })
          .catch(function(resp){
            console.log('ERROR: '+resp)
          })

      },

      loadBlogItem: function(){
        let app = this;
        this.deleteMode=0;
        this.blogItem.id = this.id;

        console.log('bcEdit:'+this.blogItem.id);

        if (this.blogItem.id) {
          this.deleteMode=1;
          if (this.blogItem.id < 0) {
            this.blogItem.id *= -1;
            this.deleteMode=2;
          }
          axios.get('/admin/blog/' + this.blogItem.id)
            .then(function (r) {
              app.blogItem = r.data;
              //console.log(r.data)
            })
            .catch(function (r) {
              console.log('ERROR: ' + r)
            })
        }
      },
      loadPicture: function(value){
        this.blogItem.blog_img = value.name;
        this.blogItem.file_content = value.file;
      },
      loadHashTags (value) {
        console.log('===>>blog_hashtags'+value);
        this.blogItem.blog_hashtags = value;
      }
    },
    mounted(){
      //console.log('BlogEdit: '+window.location.pathnamed);
      // this.$data.visiblePage = false;
      this.$parent.$emit('visiblePage', false);
      this.loadBlogItem()
    }
  }
</script>

<style>
    #bolg_content{
        /*height: 200px;*/
        width: 1500px;
    }
    .btn-add-e {
        margin: -7px 17px;
        line-height: 34px;
        padding: 0 30px;
    }
</style>
