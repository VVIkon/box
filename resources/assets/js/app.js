
require('./bootstrap');

// import VueRouter from 'vue-router';
// Vue.use(VueRouter);

import router from './router.js';
import Blog from './components/Blog.vue';
import BlogFasade from './components/BlogFasade.vue';
import Layout from './components/StoreModule/Layout.vue';


const app = new Vue({
  name: "App",
  el: '#module-root',
  data(){
    return {
      currRoute: window.location.pathname
    }
  },
  router,
  store,
  computed: {
    getRender () {
      let startComponents ={
        '/admin/blogs': Blog,
        '/blog': BlogFasade,
        '/store': Layout
      };
      let pn = startComponents[this.currRoute];
      //console.log(this.currRoute);
      return pn;
    }
  },
  render (h) {
    return h(this.getRender)
  }
});