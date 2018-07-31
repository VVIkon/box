export default {

  product: (state, getters) => (id) => {
      return state.products.find(product => product.id === id)
  },

  complect: (state, getters) => (productId, complectId) => {
    let product = state.products.find(product => product.id === productId);
    let compl=[];
    product.complect.forEach(function(itm){
      if (itm.id === complectId){
        compl.push(itm);
      }
    });
    return compl;
  },

  client: (state, getters) => (email) => {
    return state.clients.find(client => client.email === email)
  },

}