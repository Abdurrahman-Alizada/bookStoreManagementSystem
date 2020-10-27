<template>
    <div class="addToCart">
         
         <i class="fas fa-cart-plus" @click="addToCart"></i>
        
    </div>
</template>

<script>

export default {
  name : 'addToCart',
  
  props : {
      name:String,
      price : Number,
  },
  
  data(){
      return {
          b : '',
          book :{
            book_Name : this.name,
            book_price : this.price,
            book_quantity : 1,
           }
          }
  },

  methods :{
      addToCart(){
          this.b = this.$store.commit('addToCart' , this.book);
         if(this.b){
             console.log('added');
         }
         else{
             console.log('not');
         }
      }
  },

  mounted() {
        }
    }
</script>
