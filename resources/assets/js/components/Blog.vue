<template>
    <div>


        <router-view></router-view>

        <div id="main-page" v-if="visiblePage">
            <div class="form-group">
                <router-link :to="{name: 'blog-lst-new'}" class="btn btn-success btn-add pull-right" title = 'Новый блог'>+</router-link>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">Список блогов</div>
                <div class="panel-body">
                    <table class="table table-bordered table-striped table-blog">
                        <thead>
                        <tr>
                            <th>Заголовок</th>
                            <th>Аватар</th>
                            <!--<th>Содержание</th>-->
                            <th>ХешТеги</th>
                            <th width="100">&nbsp;</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="blog in blogList">
                            <td>{{ blog.blog_header }}</td>
                            <td>{{ blog.blog_img }}</td>
                            <td>{{ blog.blog_hashtags }}</td>
                            <td>
                                <router-link :to="{name: 'blog-cht', params: {blog_id: blog.id} }" class="btn btn-xs btn-social-icon btn bg-olive" title = 'Операции с чатом'><i class="fa fa-wechat"></i></router-link>
                                <router-link :to="{name: 'blog-lst-edit', params: {id: blog.id} }" class="btn btn btn-xs btn-social-icon btn-facebook" title = 'Изменить блог'><i class="fa fa-edit"></i></router-link>
                                <router-link :to="{name: 'blog-lst-delete', params: {id: blog.id*-1} }" class="btn btn-xs btn-social-icon btn-google" title = 'Удалить блог'><i class="fa fa-trash"></i></router-link>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    export default {
      name: "Blog",
      data: function(){
        return {
          blogList:[],
          visiblePage: true
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
        this.loadBlogList();
        this.$on('visiblePage', function (mode) {this.visiblePage = mode})
      }
    }
</script>

<style>

    .td-content{
        width:500px;
    }
    .td-content>p{
        width:500px;
    }

</style>


