import Vue from 'vue'
import Vuex from 'vuex'
Vue.use(Vuex)

let cart = window.localStorage.getItem('cart');

export default new Vuex.Store({
   
    state: {
      cart: cart ? JSON.parse(cart) : [],
      toast : true,
      totalQuantity : 0,   
      totalPrice : 0,
      payble : '',
      discount : '',
    },
    mutations: {
      
      addToCart(state , item){
      
      let found = state.cart.find(book => book.book_Name == item.book_Name);
       if(found){
           found.book_quantity++;
        }
        else{
            state.cart.push(item);
       } 
     
       this.commit('saveData')
       Fire.$emit('loadTranscript')
    
    },
     
        saveData(state){
            window.localStorage.setItem('cart' , JSON.stringify(state.cart))
        },

        removeFromCart(state , item){
          let i = state.cart.indexOf(item);
          this.state.toast = true;
          state.cart.splice(item,1);    
           $('#t').toast('show');
           this.commit('saveData');
           Fire.$emit('loadTranscript')
        },

       
    
    }


  })