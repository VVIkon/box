export default {

  setCategoryList(state, payload){
    state.categories = payload;
  },

  setProductsList(state, payload){
    state.products = payload;
  },

  /**
   * Вычисление начальных значение выбранного сомплекта
   * @param state
   * @param payload
   */
  setSelectedComplect(state, payload){
    let arr=[];
    if (payload) {
      payload.forEach(function (item, index, Arr) {
        arr.push('"' + item.id + '": ' + item.complect[0].id);
      });
      state.selectedComplect = JSON.parse('{' + arr.join(',') + '}');
    }
  },

  putProductToBasket(state, payload){
      state.basket.push(payload);
  },

  putNewClient(state, payload){
    state.clients = payload;
  },



  // Login(state) {
  //   state.Auth.user_id = localStorage.getItem("user_id");
  //   state.Auth.api_token = localStorage.getItem("api_token");
  //   state.Auth.name = localStorage.getItem("name");
  //   state.Auth.photo = localStorage.getItem("photo");
  //   state.Auth.login =
  //     state.Auth.user_id !== null &&
  //     state.Auth.api_token !== null &&
  //     state.Auth.name !== null;
  // }
};