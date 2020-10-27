<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
          
           <div class="card">
              <div class="card-header text-white bg-secondary">
                <h2 class="card-title">Client Bag</h2>

                   <div class="card-tools">
                    <router-link to="/books" class="btn btn-success" > Continue Shopping  </router-link>
                    <div class="btn btn-primary">Submit</div>
                   </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <tbody>
                    <tr>

                        <th>Name</th>
                        <th>Price</th>
                        <th>Total Price</th>
                        <th>Discounted price</th>
                        <th> Quantity</th>
                        <th>Made by</th>
                        <th>Actions</th>
                  </tr>
                  <tr v-for="(book , i) in this.$store.state.cart" v-bind:key="i">
                    <td>{{book.book_Name}}</td>
                    <td>{{book.book_price}}</td>
                    <td>500</td>
                    <td>400</td>
                    <td>
                      <i type="button" @click="increment(book)" class="fas fa-plus-circle fa-lg text-success"></i>
                       {{book.book_quantity}}   
                      <i type="button" @click="decrement(book)" class="fas fa-minus-circle fa-lg text-danger"></i>
                    </td>
                    <td>ALi</td>
                    <td> 
                        <i type="button" class="fas fa-trash-alt fa-lg text-danger" @click="$store.commit('removeFromCart' , book)"></i>
                    </td>
                   </tr>
                  </tbody>
                  
                  <tfoot >
                      <th colspan="7">Transcript</th>
                     <tr>
                      <td colspan="2">Payble   : {{this.$store.state.totalPrice}} </td>
                      <td>Total    : Rs.{{this.$store.state.totalPrice}}</td>
                      <td>Discount : 0%</td>
                      <td >Total books  : {{this.$store.state.totalQuantity}}</td>
                     </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
        </div>
          
             <div id="t" class="toast m-5" role="alert"  data-delay="4000" aria-live="assertive" aria-atomic="true" style="position: absolute; top: 0; right: 0;">
            <div class="toast-header">
                
                <strong v-if="!$store.state.toast" class="mr-auto">Can not decrement</strong>
                <strong v-if="$store.state.toast" class="mr-auto">Deleted</strong>
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div v-if="!$store.state.toast" class="toast-body">
                There will be atleast one item.
            </div>
               <div v-if="$store.state.toast" class="toast-body">
                Book deleted from cart Successfully.
               </div>
               </div>
    </div>
      
</template>

<script>
export default {
  name : 'miniCart',
  
  data(){
      return{
        totalQuantity : 0,
        totalPrice : '',
        discount : '',
        discountPrice : '',
        payblePrice : ''
      }
  },

   methods : {
       increment(b){
          b.book_quantity++;
          Fire.$emit('loadTranscript')
       },
       decrement(b){
           if(b.book_quantity<2){
             this.$store.state.toast = false;  
             $('#t').toast('show')             
            
            }
            else{
              b.book_quantity--;
              this.totalQuantity --
              Fire.$emit('loadTranscript')
            }
       },
      
       transcript(){
                this.$store.state.cart.forEach((book)=>{
                    this.$store.state.totalQuantity += book.book_quantity 
              this.$store.state.totalPrice += (book.book_price * book.book_quantity)
              })
           
             this.$store.state.payble = this.$store.state.cart.totalPrice - this.$store.state.discount
          // this.$store.state.cart.forEach(
            //     (book=> this.$store.state.totalPrice += book.book_price,   
            //      book=>this.$store.state.totalQuantity += book.book_quantity)
            //     )
          
            console.log(this.$store.state.totalPrice)

         }

},

  mounted() {
     Fire.$on('loadTranscript' , ()=>{
     this.$store.state.totalPrice =0             
     this.$store.state.totalQuantity = 0
     this.transcript();    
     })
     Fire.$emit('loadTranscript')
//  this.transcript();
   }
  }
</script>
