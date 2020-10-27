<template>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
            <!--sales card -->
             <div class="card">
              <div class="card-header">
                <h2 class="card-title d-sm-inline">Sales Table</h2>

                <div class="card-tools">
                  <div class="input-group input-group" style="width: 150px;">
                    <button type="button" @click="newsales" class="btn btn-primary btn-sm ml-auto d-sm-inline"><i class="fas fa-plus-circle mr-1 fa-xl"></i>New Sale</button>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <thead>

                    <tr>
                      <th>Serial #</th>
                      <th>Made by</th>
                      <th>Discount</th>
                      <!-- <th>Date</th> -->
                      <th>Details</th>

                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(sale , i) in sales" v-bind:key="i">
                      <td>{{sale.id}}</td>
                      <td>{{sale.user_id}}</td>
                      <td>{{sale.discount}}</td>    
                      <td>
                        <i type="button" @click="editsale(sale)" class="far fa-edit fa-lg text-primary"></i> 
                        <i type="button" @click="deletesale(sale.id)" class="far fa-trash-alt fa-lg text-danger"></i> 
                        <i type="button" @click="detailsale" class="far fa-arrow-alt-circle-right fa-lg text-info"></i>
                      </td>
                 </tr>

                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- end sales card -->
          </div> <!-- endl col-->
        
        <!-- purchase card -->
          <div class="col-md-6">
              <div class="card">
              <div class="card-header">
                <h2 class="card-title d-sm-inline">Purchase Table</h2>

                <div class="card-tools">
                  <div class="input-group input-group" style="width: 150px;">
                    <button type="button" @click="newPurchase" class="btn btn-primary btn-sm ml-auto d-sm-inline"><i class="fas fa-plus-circle mr-1 fa-xl"></i>New Purchase</button>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <thead>

                    <tr>
                      <th>Order #</th>
                      <th>Purchased By</th>
                      <th>Purchased from</th>
                      <!-- <th>Date</th> -->
                      <th>Details</th>

                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(purchase,i) in purchases" v-bind:key="i">
                      <td>{{purchase.id}}</td>
                      <td>{{purchase.purchaseBy}}</td>
                      <td>{{purchase.purchaseFrom}}</td>
                      <!-- <td>11-7-2014</td> -->
                     
                      <td>
                        <i type="button" @click="editpurchase(purchase)" class="far fa-edit fa-lg text-primary"></i>
                        <i type="button" @click="deletepurchase(purchase.id)  " class="far fa-trash-alt fa-lg text-danger"></i>  
                        <i type="button" @click="detailpurchase" class="far fa-arrow-alt-circle-right fa-lg text-info"></i>
                      </td>
                    </tr>


                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            </div>         
<!-- end purchase card -->

        </div>

                <!-- Modal -->
                <div class="modal fade" id="salesModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel" v-if="modal == 'new' && salesModal== true">Add sale</h5>
                        <h5 class="modal-title" id="exampleModalLabel" v-if="modal == 'edit' && salesModal==true">Edit sale</h5>
                        <h5 class="modal-title" id="exampleModalLabel" v-if="modal == 'new' && salesModal== false">Add purchase</h5>
                        <h5 class="modal-title" id="exampleModalLabel" v-if="modal == 'edit' && salesModal==false">Edit purchase</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                  <form @submit.prevent="addsale">
                        <!-- sales field start-->
                    <div v-if="salesModal == true">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                         <div class="form-group col-md-6">
                            <div class="form-group">
                            <input v-model="sale.user_id" type="text" placeholder="User id : *" name="user_id"
                                class="form-control" :class="{ 'is-invalid': sale.errors.has('user_id') }">
                            <has-error :form="sale" field="user_id"></has-error>
                            </div>
                          </div>
                         </div> 
                        <!-- <div class="form-group col-md-6">
                        <div class="form-group">
                            <input v-model="sale.buyer" placeholder="Buyer : *" type="text" name="buyer"
                                class="form-control" :class="{ 'is-invalid': sale.errors.has('buyer') }">
                            <has-error :form="sale" field="buyer"></has-error>
                            </div>
                        </div>  -->
                     </div> 

                    <div class="form-row">
                     <div class="form-group col-md-6">
                            <div class="form-group">
                            <input v-model="sale.discount" type="text" placeholder="Discount : *" name="discount"
                                class="form-control" :class="{ 'is-invalid': sale.errors.has('discount') }">
                            <has-error :form="sale" field="discount"></has-error>
                            </div>
                        </div> 

                        
                        <!-- <div class="form-group col-md-2">
                            <div class="form-group">
                            <input v-model="sale.totalItems" type="text" placeholder="totalItems : *" name="totalItems"
                                class="form-control" :class="{ 'is-invalid': sale.errors.has('totalItems') }">
                            <has-error :form="sale" field="totalItems"></has-error>
                            </div>
                        </div>  -->
                     
                    </div>
                    </div> 
                   <!--end sales field  -->

                  <!-- purchase fields start -->
                    <div v-if="salesModal == false">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                          <div class="form-group">
                            <input placeholder="purchased By : *" v-model="purchase.purchaseBy" type="text" name="purchaseBy"
                                class="form-control" :class="{ 'is-invalid': purchase.errors.has('purchaseBy') }">
                            <has-error :form="purchase" field="purchaseBy"></has-error>
                            </div>
                        </div>

                          <div class="form-group">
                            <input placeholder="purchased From : *" v-model="purchase.purchaseFrom" type="text" name="purchaseFrom"
                                class="form-control" :class="{ 'is-invalid': purchase.errors.has('purchaseFrom') }">
                            <has-error :form="purchase" field="purchaseFrom"></has-error>
                            </div>
                        </div>
                      </div> 
                    <!-- purchase fields end -->
                  </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="button" @click="addsale" v-if="modal == 'new' && salesModal== true" class="btn btn-primary">Save sale</button>
                        <button type="button" @click="addpurchase" v-if="modal == 'new' && salesModal== false" class="btn btn-info">Save purchase</button>
                        <button type="button" @click="updatesale" v-if="modal == 'edit' && salesModal== true" class="btn btn-success">update sale</button>
                        <button type="button" @click="updatepurchase" v-if="modal == 'edit' && salesModal== false" class="btn btn-success">update purchase</button>
                        
                    </div>
                    </div>
                </div>


                </div>
                <!-- end Modal -->
   
    </div>
</template>

<script>

export default {
  name : 'users',

    data(){
        return{
          salesModal :true,
         sales : [],
         purchases :[],
          sale :new Form({
              id :'',
              user_id : '', //made by
              buyer : '',
              discount : '',
              totalItems : '',
              items : [],
            }),

          purchase :new Form({
              id :'',
              purchaseBy : '', //made by
              purchaseFrom : '',
            }),

         modal : ''
        
        }
    },
  methods : {
//purchse methods
        newPurchase(){
          this.salesModal = false;
          this.modal = 'new';
          this.purchase.reset();
        $('#salesModal').modal('show');    
        },
        addpurchase(){
          this.$Progress.start();

        this.purchase.post('api/purchase')
        .then(()=>{
              Fire.$emit('updateTable');
          $('#salesModal').modal('hide')
          Swal.fire({
            timerProgressBar: true,
            showConfirmButton: false,
            timer: 1500,
            toast : true,
            icon : 'success',
            position:'top-right',
            title: 'Purchase Added successfully'
          })
          this.$Progress.finish();

      })
      .catch(()=>{

      })       
      
        },
        editpurchase(purchase){
        this.modal = 'edit';
        this.salesModal = false;
        this.purchase.reset();
        $('#salesModal').modal('show');
        this.purchase.fill(purchase);
        
        },
        deletepurchase(id){
          Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {

          // Send request to the server
            if (result.value) {
            this.purchase.delete('api/purchase/'+id).then(()=>{
              Swal.fire(
              'Deleted!',
              'Your file has been deleted.',
              'success'
              )
                Fire.$emit('updateTable');
            }).catch(()=> {
                Swal.fire("Failed!", "There was something wronge.", "warning");
            });
            }
          })
      
        },
        updatepurchase(){
            this.$Progress.start();
          this.purchase.put('api/purchase/'+this.purchase.id)
          .then(() => {
          // succes
          $('#salesModal').modal('hide');
           Swal.fire({
               timerProgressBar: true,
               showConfirmButton: false,
               timer: 1500,
               toast : true,
               icon : 'success',
               position:'top-right',
               title: 'Information updated successfully'
              })
              this.$Progress.finish();
              Fire.$emit('updateTable');
          })
          .catch(() => {
              this.$Progress.fail();
          });

        },
        detailpurchase(){},
// end purchase methods

        //sales methods
        newsales(){
          this.modal = 'new';
          this.salesModal = true;
          this.sale.reset();
        $('#salesModal').modal('show');    
        },

        addsale(){
         this.$Progress.start();

        this.sale.post('api/sales')
        .then(()=>{
          Fire.$emit('updateTable');
          $('#salesModal').modal('hide')
          Swal.fire({
            timerProgressBar: true,
            showConfirmButton: false,
            timer: 1500,
            toast : true,
            icon : 'success',
            position:'top-right',
            title: 'Sale Added successfully'
          })
          this.$Progress.finish();

      })
      .catch(()=>{

      })       
      

        },
      
    editsale(sale){
        this.modal = 'edit';
        this.salesModal = true;
        this.sale.reset();
        $('#salesModal').modal('show');
        this.sale.fill(sale);
        },
    updatesale(){
        this.$Progress.start();
          this.sale.put('api/sales/'+this.sale.id)
          .then(() => {
          // succes
          $('#salesModal').modal('hide');
           Swal.fire({
               timerProgressBar: true,
               showConfirmButton: false,
               timer: 1500,
               toast : true,
               icon : 'success',
               position:'top-right',
               title: 'Information updated successfully'
              })
              this.$Progress.finish();
              Fire.$emit('updateTable');
          })
          .catch(() => {
              this.$Progress.fail();
          });

    },

    deletesale(id){
          Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {

          // Send request to the server
            if (result.value) {
            this.sale.delete('api/sales/'+id).then(()=>{
              Swal.fire(
              'Deleted!',
              'Your file has been deleted.',
              'success'
              )
                Fire.$emit('updateTable');
            }).catch(()=> {
                Swal.fire("Failed!", "There was something wronge.", "warning");
            });
            }
          })
              
    },
    detailsale(){},
// end sales methods


    load(){
         axios.get("api/sales").then(({ data }) => (this.sales = data.data));
         axios.get("api/purchase").then(({ data }) => (this.purchases = data.data));
     }
},


    mounted() {
        Fire.$on('updateTable', ()=>{
        this.load();
      })

        this.load();
        }
    }
</script>
