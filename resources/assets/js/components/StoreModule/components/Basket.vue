<template>
    <v-app id="basket">
        <v-layout row justify-center>
            <v-alert
                    v-show="showAlertPanel"
                    :value="true"
                    type="success"
                    class="save-result-alert"
            >
                <h4>Заказ № {{saveResult.invoice_number}} создан</h4>
                <span>
                    Для отслеживания состояния заказа воспользуйтесь личным кабинетом.
                </span>
                <p>
                    Логин: {{saveResult.nick_name}} пароль:{{saveResult.psw}}
                </p>

                <v-btn color="success" @click="clearBasket">Ok</v-btn>
            </v-alert>

            <v-card v-show="!showAlertPanel">
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
                    <buy-btn
                      :total="totalPrice"
                      :basket="basket"
                    ></buy-btn>
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
        ],
        showAlertPanel:false
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

      saveResult() {
        return this.$store.state.saveResult;
      },

      totalPrice(){
        let pr = 0;
        this.basket.map(function(itm, ind){
          pr += itm.total;
        });
        return pr;
      }
    },
    methods:{
      clearBasket(){
        localStorage.removeItem("basket");
        this.$store.dispatch("clearProductBasket");
      }
    },

    watch:{
      saveResult(newState){
        //console.log('state: '+JSON.stringify(newState,'',4));
        if (newState.result){
          this.showAlertPanel = true;
          // console.log('showAlertPanel: '+this.showAlertPanel);

        }
      }

    }

  }
</script>

<style scoped>
    .save-result-alert{
        height: 200px;
    }

</style>