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

  addClient({commit}, newClient){
    let clnt = newClient
    axios.post("/molehole/store/addclient", newClient)
      .then(function(r){
        clnt.id = r.data.id;
        // console.log('data: '+JSON.stringify(r.data, '', 4) );
        // console.log('clnt: '+JSON.stringify(clnt, '', 4) );
        commit('putNewClient', newClient)
      })
      .catch(function(r){
        console.log('ERROR: '+r)
      });
  }

};