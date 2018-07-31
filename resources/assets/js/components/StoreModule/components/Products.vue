<template>
    <div id="product-container">
        <v-app id="store">
            <ul class="tile-items">
                <li v-for="product in products">
                    <div class="col s12 m6 l4">
                        <div class="prod-card">
                            <div class="card-image">

                                <div class="prod-complect">
                                    <h4 class="card-title">{{product.product_name}}</h4>

                                    <div :id="'complect-'+complect.id" class="panel-complect" v-for="complect in product.complect" v-show="selectedComplect[product.id] == complect.id">
                                        <div :id = "'comp-proper-'+proper.id" class="property" v-for="proper in complect.complect_property">
                                            <img v-if="proper.property_id == 5" class="prod-img" :src="'/pic/'+proper.complect_value">
                                            <div v-else>
                                                <strong>{{proper.property_name.property_name}}: </strong>{{proper.complect_value}}
                                            </div>
                                        </div>
                                    </div>


                                    <div class='prod-select-wraper'>
                                        <select v-model="selectedComplect[product.id]" :id="'prod-select-'+product.id" class="prod-dropdown" @change="selComp(product.id)">
                                            <option :value="complect.id" v-for="complect in product.complect">{{complect.complect_name}}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="card-content">

                                <basket-btn
                                    :productid="product.id"
                                    :complectid="selectedComplect[product.id]"

                                ></basket-btn>
                                <div class="prod-property">
                                    <div :id="'prod-proper-'+proper.id" class="property" v-for="proper in product.product_property">
                                        <p><strong>{{proper.property_name.property_name}}: </strong>{{proper.product_value}}</p>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </li>

            </ul>


        </v-app>
    </div>
</template>

<script>

  import {mapState} from 'vuex';
  import basketBtn from './BasketBtn.vue'

  export default {
    name: "Products",
    props:['category_id'],
    data () {
      return {
        dialog: false
      }
    },
    components:{
      'basket-btn': basketBtn
    },
    computed: mapState({
         products: state => state.products,
         selectedComplect: state =>state.selectedComplect
       }),

    methods: {

      selComp (productId){
        //console.log('productId: '+productId);
        //console.log('selectedComplect:'+JSON.stringify(this.$store.state.selectedComplect));
      },


    },
    watch: {
      category_id() {
        this.$store.dispatch("loadProducts", this.category_id);
      }
    },
    mounted(){
      this.$store.dispatch("loadProducts", this.category_id);
      this.$store.dispatch("loadProducts", this.category_id);
    }


  }
</script>

<style scoped>
    #product-container{
        position: relative;
        max-width: 1500px;
        margin: 0 auto;
        padding: 0 0;
    }

    .tile-items li {
        display: inline-block;
        vertical-align: top;
        width: 25%;
        margin-bottom: 22px;
    }

    .prod-img{
        height: 100% !important;
        width: 100% !important;
        padding: 10px;
        /*border: #eae5e5 1px solid;*/
        /*border-radius: 2px;*/

    }

    .prod-card{
        display: inline-block;
        position: relative;
        max-width: 355px;
        height: 500px;
        padding-bottom: 13px;
        border: #eae5e5 1px solid;
        border-radius: 2px;
        background: #fff;
        -webkit-box-shadow: 0 1px 4px rgba(121, 28, 26, 0.15);
        -moz-box-shadow: 0 1px 4px rgba(121, 28, 26, 0.15);
        box-shadow: 0 1px 4px rgba(121, 28, 26, 0.15);
        -webkit-transition: 0.3s;
        transition: 0.3s;
    }


    .card-image {
        display: block;
        text-align: left;
        font-style: normal;
        /*margin-top: 0;*/
        /*margin-bottom: 5px;*/
        color: #666;
        padding: 5px 5px;
    }

    .card-content{
        /*background: #eae5e5;*/
        padding: 5px 10px;
        margin: -15px 0;
    }

    .prod-dropdown{
        display: block;
        position: relative;
        /*max-width: 350px;*/
        /*padding: 10px;*/
        border: #eae5e5 1px solid;
        border-radius: 2px;
        height: 32px;
    }

    .panel-complect{
        padding: 5px;
        border: #eae5e5 1px solid;
        border-radius: 2px;
    }
    .prod-select-wraper{
        margin: 5px 0;
    }
    .property{
        font-size: 12px;
    }

</style>