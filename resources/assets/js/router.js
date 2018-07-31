
import VueRouter from 'vue-router';
//Блог
import Blog from './components/Blog.vue';
import BlogEdit from './components/BlogEdit.vue';
import BlogChat from './components/BlogChat.vue';
import ChatEdit from './components/ChatEdit.vue';
import BlogFasade from './components/BlogFasade.vue';
import BlogPage from './components/BlogPage.vue';
// магазин
import Products from './components/StoreModule/components/Products.vue';
import Basket from './components/StoreModule/components/Basket.vue';


const routes =[
// {path: '/admin/blogs',          redirect:'/blog-list' },
  {path: '/blog-list',            name: 'blog-lst',        component: Blog },
  {path: '/blog-list/new',        name: 'blog-lst-new',    component: BlogEdit },
  {path: '/blog-list/edit/:id',   name: 'blog-lst-edit',   component: BlogEdit, props:true },
  {path: '/blog-list/delete/:id', name: 'blog-lst-delete', component: BlogEdit, props:true },

  {path: '/blog-list/chat/:blog_id',              name: 'blog-cht',        component: BlogChat, props:true},
  {path: '/blog-list/chat/new/:blogid',           name: 'blog-cht-new',    component: ChatEdit, props:true},
  {path: '/blog-list/chat/edit/:id/:currchat',    name: 'blog-cht-edit',   component: ChatEdit, props:true},
  {path: '/blog-list/chat/delete/:id/:currchat',  name: 'blog-cht-delete', component: ChatEdit, props:true},

// {path: '/blog',          redirect:'/blog-fasade' },
  {path: '/blog-fasade',  name: 'blog-fasade', component: BlogFasade },
  {path: '/blog-page/:blog_id',name: 'blog-page',   component: BlogPage, props:true},

// Пицерия
  {path: '/store/categories/:category_id', name: 'st-categories', component: Products, props:true},
  {path: '/store/basket/:invoice_id', name: 'st-basket', component: Basket, props:true}
// {path: '/store',name: 'st', component: Layout,
//   children: [
//     {path: 'categories/:category_id', name: 'st-categories', component: Products},
//     {path: 'basket', name: 'st-basket',component: Basket}
//   ]

];

export default new VueRouter({
  mode: 'history',
  routes: routes
});