<template>
    <div id="container layout-container" >

        <div class="row">
            <div class="col s12 m10 offset-m1">
                <classificator></classificator>
            </div>
        </div>
        <!--<div class="main-wrapper">-->
            <router-view></router-view>
        <!--</div>-->
    </div>
</template>

<script>

  // import Store from '../vuex/index.js';
  import Classificator from './components/Classificator.vue';

  export default {
    name: "Layout",
    // store: Store,
    components: {
      'classificator':Classificator
    }
  }
</script>

<style scoped>
    /*@import '/node_modules/vuesax/dist/vuesax.css';*/
    /*@import '/node_modules/material-icons/iconfont/material-icons.css';*/
    /*@import '/node_modules/vue-material/dist/vue-material.min.css';*/
    /*@import 'node_modules/vuetify/dist/vuetify.css';*/






</style>
