<template>
    <v-app id="basket">
        <v-layout row justify-center>
            <v-card>
                <v-card-title class="headline grey lighten-2">Корзина покупок</v-card-title>
                <v-container fluid grid-list-xl>
                    <v-data-table
                            :headers="headers"
                            :items="basket"
                            hide-actions
                            class="elevation-1"
                    >
                        <template slot="items" slot-scope="props">
                            <td>{{ props.item.productName }}</td>
                            <td class="text-xs-right">{{ props.item.kolvo }}</td>
                            <td class="text-xs-right">{{ props.item.price }}</td>
                            <td class="text-xs-right">{{ props.item.total }}</td>
                        </template>
                    </v-data-table>
                    <h5 class="headline mb-0 pull-right">Итого: {{totalPrice}} руб.</h5>
                </v-container>

                <v-divider class="my-1 "></v-divider>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <!--<v-btn color="green darken-1" flat @click.native="toBuy">Оформить</v-btn>-->
                    <buy-btn></buy-btn>
                </v-card-actions>
            </v-card>
        </v-layout>
    </v-app>
</template>

<script>
  import buyBtn from './BuyBtn.vue'
  export default {
    name: "Basket",
    props:['invoice_id'],

    data (){
      return{
        headers: [
          { text: 'Товар',      value: 'productName' },
          { text: 'Количество', value: 'kolvo' },
          { text: 'Цена',       value: 'price' },
          { text: 'Сумма',      value: 'total' }
        ]
      }
    },
    components:{
        'buy-btn': buyBtn
    },
    computed: {
      // [
      //   {"productId":2,"productName":"Римская (Маленькая)","complectId":3,"kolvo":3,"price":530,"total":1590},
      //   {"productId":3,"productName":"Палермо(Большая)","complectId":6,"kolvo":2,"price":980,"total":1960}
      // ]
      basket() {
        return this.$store.state.basket;
      },

      totalPrice(){
        let pr = 0;
        this.basket.map(function(itm, ind){
          pr += itm.total;
        });
        return pr;
      }
    }
    // methods:{
    //   toBuy(){
    //     console.log('basket: '+JSON.stringify(this.basket) );
    //   }
    // }

  }
</script>

<style scoped>

</style>