export default {

  loadCategories({ commit }) {
    axios.get("/molehole/store/category")
      .then(r => {
       // console.log('category: '+JSON.stringify(r.data, '', 4) );
        commit("setCategoryList", r.data);
      })
      .catch(function(r){
        console.log('ERROR: '+r)
      });
  },

  loadProducts({ commit }, categoryId) {
    if (categoryId) {
      axios.get('/molehole/store/product/' + categoryId)
        .then(r => {
        // console.log('Products: ' + JSON.stringify(r.data, '', 4));
          commit("setProductsList", r.data);
          commit("setSelectedComplect", r.data);

        })
        .catch(function(r){
          console.log('ERROR: '+r)
        });
    }
  },

  putProductToBasket({commit}, outProduct){
    commit('putProductToBasket', outProduct)
  },

  clearProductBasket({commit}){
    commit('clearProductBasket')
  },

  loadBasket({commit}){
    let bsk = JSON.parse(localStorage.getItem("basket"));
    if (bsk) {
      //console.log('bsk:' + bsk);
      bsk.forEach(function (itm) {
        //console.log('itm:' + itm);
        commit('putProductToBasket', itm);
      });
    }
  },

  /**
   *
   * @param commit
   * @param newInvoice
   * returning:
   data: {
    "result": true,
    "invoice_id": 5,
    "client_id": 33,
    "nick_name": 749091,
    "psw": 6184
}
   */
  saveInvoice({commit}, newInvoice){
    axios.post("/molehole/store/saveInvoice", newInvoice)
      .then(function(r){
        commit('putSaveResult', r.data);
        // console.log('data: '+JSON.stringify(r.data, '', 4) );
      })
      .catch(function(r){
        console.log('ERROR: '+r)
      });
  }

};