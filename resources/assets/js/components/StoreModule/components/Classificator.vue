<template>
    <div class="nav-extended">
        <nav class="nav-content">
            <div class="category-container">
                <ul class="tabs tabs-transparent" >
                    <li class="tab" v-for="category in categories" :key="category.id">
                        <router-link :to="{name: 'st-categories', params: {category_id: category.id}}" class="tabs tabs-transparent md-menu prod-category">{{category.category_name}}</router-link>
                    </li>
                </ul>
            </div>
            <div class="basket-container pull-right">
                <div class="row basket-wraper">
                    <router-link v-if="productCnt" :to="{name: 'st-basket', params: {invoice_id: invoiceId}}" class="basket-link"><i class="material-icons">shopping_cart</i></router-link>
                </div>
                <div class="row basket-wraper basket-cnt">
                    <span v-if="productCnt">в корзине: {{this.productCnt}} шт./ {{this.productTotal}} руб.</span>
                </div>
            </div>
        </nav>
    </div>
</template>

<script>

  import axios from 'axios';

  export default {
    name: "Classificator",
    data (){
      return {
        invoiceId:0,
        productCnt:0,
        productTotal:0
      }
    },
    computed: {
      categories() {
        return this.$store.state.categories;
      },
      basket() {
        return this.$store.state.basket;
      }
    },

    watch:{
      basket(newValue){
        this.productCnt = newValue.length;
        let pr = 0;
        this.basket.map(function(itm, ind){
          pr += itm.total;
        });
        this.productTotal = pr;
        localStorage.setItem('basket', JSON.stringify(this.basket) );
      }

    },

    created() {
      this.$store.dispatch("loadCategories");
      this.$store.dispatch("loadBasket");
    },

    updated(){
      let aa = document.querySelectorAll(".prod-category")[0];
      if (aa){
        aa.click();
      }
      // this.$router.push("/store/categories/1")
    }

  }
</script>

<style scoped>
    .category-container{
        position: relative;
        display: inline-block;
    }
    .nav-content{
        height: 75px;
    }
    .basket-container{
        position: relative;
        display: inline-block;
        text-align: center;
        line-height: 0;
        height: 48px;
        padding: 0;
        text-transform: uppercase;
        margin: 0 30px;
    }
    .basket-wraper{
        position: relative;
        display: block;
        color: #000;
        margin: 1px 1px;
        padding: 1px 1px;
    }
    .basket-link{
        color: #000;
    }
    .basket-cnt{
        font-size: 11px;
    }

</style>