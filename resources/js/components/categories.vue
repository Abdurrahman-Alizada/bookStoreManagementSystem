<template>
    <div class="container">
       <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h2 class="card-title d-sm-inline">categorys Table</h2>

                <div class="card-tools">
                  <div class="input-group input-group" style="width: 150px;">
                    <button type="button" @click="newcategory" class="btn btn-primary d-sm-inline"><i class="fas fa-plus-circle mr-1 fa-xl"></i> Add category</button>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>Serial #</th>
                      <th>Name</th>
                      <th>Description</th>
                      <!-- <th>Added At</th>
                      <th>Added By</th> -->
                      <th>Modify</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(category,i) in categories" v-bind:key="i">
                       <td>{{category.id}}</td>
                       <td>{{category.name}}</td>
                       <td>{{category.description}}</td>
                       <td>
                          <button type="button" @click="editModal(category)" class="btn btn-sm btn-outline-info d-sm-inline">Edit</button>
                          <button type="button" @click="deletecategory(category.id)" class="btn btn-sm btn-outline-danger d-sm-inline">Delete</button>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>

                <!-- Modal -->
                <div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel" v-if="modal == 'new'">Add category</h5>
                        <h5 class="modal-title" id="exampleModalLabel" v-if="modal == 'edit'">Edit category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                  <form @submit.prevent="modal == 'new' ? addcategory() : updateCategory()">              
                    <div class="form-row">
                         <div class="col-md-12"> 

                          <div class="form-group">
                            <input placeholder="Name : *" v-model="form.name" type="text" name="name"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                            <has-error :form="form" field="name"></has-error>
                        </div> 

                        <div class="form-group">
                            <input placeholder="Description : *" v-model="form.description" type="text" name="description"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('description') }">
                            <has-error :form="form" field="description"></has-error>
                        </div> 

                        <!-- <div class="form-group">
                            <input v-model="form.Generes" placeholder="Generes : *" type="Generes" name="Generes"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('Generes') }">
                            <has-error :form="form" field="Generes"></has-error>
                            </div>
                         
                            <div class="form-group">
                            <input v-model="form.addBy" type="addBy" placeholder="Add By : *" name="addBy"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('addBy') }">
                            <has-error :form="form" field="addBy"></has-error>
                            </div>
                         
                           <div class="form-group">
                            <input v-model="form.addAt" type="addBy" placeholder="Add At : *" name="addAt"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('addAt') }">
                            <has-error :form="form" field="addAt"></has-error>
                            </div> -->
                        </div>                      
                    </div>
                  </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="button" v-show="modal == 'new'"  @click="addcategory"   class="btn btn-primary">Save changes</button>
                        <button type="button" v-show="modal == 'edit'" @click="updateCategory"  class="btn btn-success">Update changes</button>
       
                    </div>
                    </div>
                </div>
                </div>


       </div>
</template>

<script>

export default {
  name : 'categorys',

    data(){
        return{
          categories :{},
          form :new Form({
              id : '',
              name : '',
              Generes : '',
              description : '',
              addBy : '',
              addAt : '',
            }),

         modal : ''
        
        }
    },
  methods : {

    newcategory(){
        this.modal = 'new';
        this.form.reset();
       $('#categoryModal').modal('show');    
       
    },
     addcategory(){
      this.$Progress.start();

      this.form.post('api/categories')
      .then(()=>{
              Fire.$emit('updateTable');
          $('#categoryModal').modal('hide')
              Swal.fire({
               timerProgressBar: true,
               showConfirmButton: false,
               timer: 1500,
               toast : true,
               icon : 'success',
               position:'top-right',
               title: 'Category Added successfully'
              })
          this.$Progress.finish();

      })
      .catch(()=>{

      })       
    },
        editModal(category){
        this.modal = 'edit';
        this.form.reset();
        $('#categoryModal').modal('show');
        this.form.fill(category);
        },

      updateCategory(id){
          this.$Progress.start();
          this.form.put('api/categories/'+this.form.id)
          .then(() => {
          // succes
          $('#categoryModal').modal('hide');
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

    deletecategory(id){
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
            this.form.delete('api/categories/'+id).then(()=>{
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

    loadCategories(){
        if(this.$gate.isAdminOrAuthor()){
            axios.get("api/categories").then(({ data }) => (this.categories = data.data));
        }
    },

},

  mounted() {

      Fire.$on('updateTable', ()=>{
        this.loadCategories();
      })
       
               this.loadCategories();
       }
    }
</script>
