<template>
    <div>
        <div class="row">
            <div class="col l12">
                <div class="col l2 panel-header">
                    <p id="nameField"><strong>Есть чем поделиться...</strong></p>
                </div>
                <!--<div class="col l10 panel-search">-->
                    <!--<input type="text" id="panel-input" value="", placeholder="Искать ...">-->
                    <!--<a id="btn-send" class="waves-effect waves-light btn">Искать</a>-->
                <!--</div>-->
            </div>
        </div>
        <div class="row">

            <div id= 'site-layout-left' class="col s12 m4 l3 site-layout">
                <div class="site-panels">
                    <div class="collection" v-for="blog in blogList">
                        <router-link :to="{name: 'blog-page', params: {blog_id: blog.id, currblog: blog} }" class="collection-item" title = 'Темы блога'>{{blog.blog_header}}</router-link>
                    </div>
                </div>
            </div>
            <div id="site-layout-right" class="col s12 m8 l9 site-layout" >
                <div id="show-code" class="card-panel blue-grey lighten-5 site-panels">
                    <router-view></router-view>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
  import axios from 'axios';

  export default {
    name: "BlogFasade",
    data () {
      return {
        blogList: []
      }
    },
    methods:{
      loadBlogList: function(){
        let app = this;
        axios.get('/admin/bloglst')
          .then(function(r){
            app.blogList=r.data;
            //console.log(r.data)
          })
          .catch(function(r){
            console.log('ERROR: '+r)
          })
      }
    },
    mounted(){
      this.loadBlogList()
    }
  }
</script>

<style scoped>

</style>