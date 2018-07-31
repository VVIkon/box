<template>
    <div>
        <div class="form-group">
            <router-link :to="{name: 'blog-lst'}" class="btn btn-default btn-add pull-left" title = 'к списку'><i class="fa fa-list-alt"></i></router-link>
        </div>

        <div class="form-group">
            <router-link :to="{name: 'blog-cht-new', params: {blogid: this.blogId}}" class="btn btn-success btn-add pull-right" title = 'Новая заметка'>+</router-link>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">{{blogHeader}}</div>
            <div class="panel-body">
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>ParentId</th>
                        <th>Автор</th>
                        <th>Содержание</th>
                        <th width="65">&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="chat in blogChatList">
                        <td>{{ chat.id}}</td>
                        <td>{{ chat.parent_id}}</td>
                        <td>{{ chat.user.name}}</td>
                        <td>{{ chat.chat_comment}}</td>
                        <td>
                            <router-link :to="{name: 'blog-cht-edit', params: {id: chat.id, currchat: chat} }" class="btn btn btn-xs btn-social-icon btn-facebook" title = 'Изменить заметку'><i class="fa fa-edit"></i></router-link>
                            <router-link :to="{name: 'blog-cht-delete', params: {id: chat.id*-1, currchat: chat} }" class="btn btn-xs btn-social-icon btn-google" title = 'Удалить заметку'><i class="fa fa-trash"></i></router-link>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
  export default {
    name: "BlogChat",
    props: ['blog_id'],
    data () {
      return {
        blogId:0,
        blogHeader:'',
        blogChatList:[]
      }
    },
    methods:{

        loadBlogChat: function(){
          let app = this;
          this.blogId = this.blog_id; //app.$route.params.id;
          let operPath = '/admin/blog-chats/' + app.blogId;
          //console.log('operPath: '+operPath);

          axios.get(operPath)    //@loadBlogChat
          .then(function (r) {
            app.blogChatList = r.data.blog_chat;
            app.blogHeader   = r.data.blog_header;
            //console.log('app.blogChatList: '+JSON.stringify(app.blogChatList) );
          })
          .catch(function (r) {
            console.log('Ошибочка: ' + r)
          });
        }
    },

    mounted(){
      this.$parent.$emit('visiblePage', false);
      this.loadBlogChat();
    }
  }



</script>

