<template>
    <v-layout row justify-center>
        <v-dialog v-model="dialog" persistent max-width="490">
            <v-btn fab dark color="red" class="btn-basket" slot="activator" color="primary" dark><i class="material-icons">add_shopping_cart</i></v-btn>
            <v-card>
                <v-card-title class="headline grey lighten-2">{{this.product.product_name}}</v-card-title>
                <v-list class="px-2 prod-property">
                    <template v-for="(property, index) in properties">
                        <v-list-tile-content>
                            <v-list-tile-title><strong>{{ property.name }}</strong>: {{ property.val }}</v-list-tile-title>
                            <!--<v-list-tile-sub-title class="text&#45;&#45;primary">{{ property.val }}</v-list-tile-sub-title>-->
                        </v-list-tile-content>

                    </template>
                </v-list>

                <v-list class="px-2 prod-property">
                    <template v-for="(item, index) in complectDetails">
                        <v-list-tile-content>
                            <v-list-tile-title><strong>{{ item.name }}</strong>: {{ item.val }}</v-list-tile-title>
                        </v-list-tile-content>

                    </template>
                </v-list>
                <v-container fluid grid-list-xl>
                    <v-layout wrap align-center>
                        <v-flex xs12 sm12>
                            <v-select
                                class="prod-kolvo"
                                :items=kolvolist
                                label="Количество"
                                outline
                                auto
                                autofocus
                                full-width
                                max-height="203px"
                                max-width="258x"
                                nudge-top="200px"
                                v-model="kolvo"
                                :error-messages="errorMessages"
                            ></v-select>
                        </v-flex>
                    </v-layout>
                </v-container>

                <v-divider class="my-1 "></v-divider>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="green darken-1" flat @click.native="dialog = false">Отмена</v-btn>
                    <v-btn color="green darken-1" flat @click.native="toBasket">Добавить</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-layout>
</template>

<script>

  // import {mapState, mapGetters} from 'vuex';
  export default {
    name: "BasketBtn",
    props:['productid', 'complectid'],
    data () {
      return {
        dialog: false,
        properties: [],
        complectDetails: [],
        kolvolist: _.range(10),
        kolvo:0,
        errorMessages:[]
      }
    },

    computed: {
      // products() {
      //   return this.$store.state.products;
      // },

      product() {
        return this.$store.getters.product(this.productid);
      },
      complect() {
        return this.$store.getters.complect(this.productid, this.complectid);
      }

    },


    methods:{
      decodeProductProperty(){

        let property = this.product.product_property;
        this.properties = property.map(function(val,ind,arr){
          let retArr = {};
          retArr['productid']= val.product_id;
          retArr['name']= val.property_name.property_name;
          retArr['val']= val.product_value;
          return retArr;
        });


        let ss = [];
        this.complect.forEach(function(itm, ind1, arr1){
          if (itm){
            let complect = itm.complect_property;
            if (complect){
                //console.log('complect: '+JSON.stringify(complect,'',4));
                ss = complect.map(function(val,ind2,arr2){
                  let retArr2 = {};
                  retArr2['propertyid']= val.property_id;
                  retArr2['name']= val.property_name.property_name;
                  retArr2['val']= val.complect_value;
                  return retArr2;
                })
            }
          }
        });
        this.complectDetails = ss;

        // console.log('ss: '+JSON.stringify(ss,'',4));
        // console.log('complectDetails: '+JSON.stringify(this.complectDetails,'',4));
      } ,

      toBasket (){
        if (!this.kolvo){
            this.errorMessages.push('введите количество');
            return;
        }

        let price = 0;
        this.complectDetails.forEach(function(itm){
          if (itm.propertyid == 2){
            price = Number(itm.val);
          }
        });

        this.dialog = false;

        let outProduct={
          productId: this.productid,
          productName: this.product.product_name+'('+this.complect[0].complect_name+')',
          complectId: this.complectid,
          kolvo: this.kolvo,
          price: price,
          total: Number(price * this.kolvo)
        };

        this.$store.dispatch("putProductToBasket", outProduct );

        // this.$store.dispatch("putProductToBasket", JSON.stringify(this.outProduct) );
           //console.log('product: '+JSON.stringify(this.product,'',4) );
          // console.log('property: '+JSON.stringify(this.properties, '', 4));

          //console.log('complectid: '+JSON.stringify(this.complectid,'',4) );
          //console.log('complect: '+JSON.stringify(this.complect,'',4));

           //console.log('complectDetails: '+JSON.stringify(this.complectDetails, '', 4))
          // console.log('outProduct: '+JSON.stringify(outProduct, '', 4))
      }
    },

    watch:{
      productid(){
        this.decodeProductProperty();
      },
      complectid(){
        this.decodeProductProperty();
      }

    },

    mounted(){
      this.decodeProductProperty();
       //console.log('complect: '+JSON.stringify(this.complect, '', 4))
       // console.log('Product: '+JSON.stringify(this.product, '', 4))
    }
  }
</script>

<style scoped>

    .btn-basket {
        position: absolute;
        right: 24px;
        top: 65px;
    }

    .menuable__content__active{
        max-height: 203px;
        min-width: 258px;
        top: 82px;
        left: 644px;
    }

    /*hr {*/
        /*margin-top: 0;*/
        /*margin-bottom: 0;*/
    /*}*/

</style>