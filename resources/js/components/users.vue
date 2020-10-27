<template>
    <div class="container">
        <div class="row mt-5" v-if="$gate.isAdminOrAuthor()">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Users Table</h3>

                <div class="card-tools">
                    <button class="btn btn-success" @click="newModal">Add New <i class="fas fa-user-plus fa-fw"></i></button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <tbody>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Type</th>
                        <th>Registered At</th>
                        <th>Modify</th>
                  </tr>


                  <tr v-for="user in users.data" :key="user.id">

                    <td>{{user.id}}</td>
                    <td> <img src="/img/profile/2.png" alt="Product 1" class="img-circle img-size-32 mr-2"> {{user.name}}</td>
                    <td>{{user.email}}</td>
                    <td>{{user.type | upText}}</td>
                    <td>{{user.created_at | myDate}}</td>

                    <td>
                        <button  class="btn btn-outline-info btn-sm" @click="editModal(user)">
                            <i class="fa fa-edit"> </i>
                        </button>
                        
                        <button class="btn btn-outline-danger btn-sm" @click="deleteUser(user.id)">
                            <i class="fa fa-trash"></i>
                        </button>

                    </td>
                  </tr>
                </tbody></table>
              </div>
              <!-- /.card-body -->
              <!-- card footer -->
                <div class="card-footer">

                 <div class="d-inline">

                  <div class="d-flex-block mr-4 float-left">
                    <pagination :data="users" @pagination-change-page="getResults"></pagination>
                  </div>

                  <div class="d-inline">
                      <div class="card-tools" >
                      <button type="button" @click.prevent="printUsers"  class="btn btn-primary d-flex-block mr-4 float-right"><i class="fas fa-print"></i> 
                      Print Users</button>                  
                    </div>
                  </div>

                 </div>

                         
              </div>
              <!--end card footer -->
            </div>
            <!-- /.card -->
          </div>
        </div>

        <div v-if="!$gate.isAdminOrAuthor()">
            <not-found></not-found>
        </div>

    <!-- Modal -->
            <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" v-show="!editmode" id="addNewLabel">Add New</h5>
                    <h5 class="modal-title" v-show="editmode" id="addNewLabel">Update User's Info</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
               
                     <!-- <form ref="form" @submit.prevent="addNewbook()">
     <b-row>
       <b-col sm="7" md="7">  
        <b-form-group label="Name" label-for="name-input" >
          <b-form-input id="name-input" placeholder="Name : *" v-model="book.name"></b-form-input>
        </b-form-group>


        <b-form-group label="Email" label-for="email-input">
          <b-form-input id="email-input" v-model="book.email" placeholder="Email : * " ></b-form-input>
        </b-form-group>

        <b-form-group label="password" label-for="password-input" >
          <b-form-input id="password-input" v-model="book.password" placeholder="password"></b-form-input>
        </b-form-group>
       </b-col>
       <b-col sm="5" md="5">
        <b-form-group label="Type" label-for="type-input" >
            <b-form-select v-model="book.type" class="mb-3">
            <b-form-select-option value="admin">Admin</b-form-select-option>
            <b-form-select-option value="author">Author</b-form-select-option>
            <b-form-select-option value="book">book</b-form-select-option>        
            </b-form-select>
        </b-form-group>
       
        <b-form-group label="Status" label-for="status-input" >
            <b-form-select v-model="book.status" class="mb-3">
            <b-form-select-option value="approve">Approve</b-form-select-option>
            <b-form-select-option value="suspend">Suspend</b-form-select-option>        
            <b-form-select-option value="pending">Pending</b-form-select-option>
            <b-form-select-option value="cancel">Cancel</b-form-select-option>        
            </b-form-select>
        </b-form-group>
       
       </b-col>
      </b-row>

                       </form> -->


               
                <form @submit.prevent="editmode ? updateUser() : createUser()">
                <div class="modal-body">
                     <div class="form-group">
                        <input v-model="form.name" type="text" name="name"
                            placeholder="Name"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                        <has-error :form="form" field="name"></has-error>
                    </div>

                     <div class="form-group">
                        <input v-model="form.email" type="email" name="email"
                            placeholder="Email Address"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                        <has-error :form="form" field="email"></has-error>
                    </div>

                    <div class="form-group">
                        <select name="type" v-model="form.status" id="status" class="form-control" :class="{ 'is-invalid': form.errors.has('status') }">
                            <option value="">Select User status</option>
                            <option value="suspend">suspend</option>
                            <option value="appprove">approve</option>
                            <option value="pending">pending</option>
                            <option value="cancel">cancel</option>
                        </select>
                        <has-error :form="form" field="status"></has-error>
                    </div>


                    <div class="form-group">
                        <select name="type" v-model="form.type" id="type" class="form-control" :class="{ 'is-invalid': form.errors.has('type') }">
                            <option value="">Select User Role</option>
                            <option value="admin">Admin</option>
                            <option value="user">Standard User</option>
                            <option value="author">Author</option>
                        </select>
                        <has-error :form="form" field="type"></has-error>
                    </div>

                    <div class="form-group">
                        <input v-model="form.password" type="password" name="password" id="password"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('password') }">
                        <has-error :form="form" field="password"></has-error>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button v-show="editmode" type="submit" class="btn btn-success">Update</button>
                    <button v-show="!editmode" type="submit" class="btn btn-primary">Create</button>
                </div>

                </form>

                </div>
            </div>
            </div>
    </div>



</template>

<script>
    export default {
        data() {
            return {
                editmode: false,
                users : {},
                form: new Form({
                    id:'',
                    name : '',
                    email: '',
                    password: '',
                    type: '',
                    status: '',
                    photo: ''
                })
            }
        },
        methods: {
             printUsers(){
                window.print();
         },
            getResults(page = 1) {
                        axios.get('api/user?page=' + page)
                            .then(response => {
                                this.users = response.data;
                            });
                },
            updateUser(){
                this.$Progress.start();
                // console.log('Editing data');
                this.form.put('api/user/'+this.form.id)
                .then(() => {
                    // success
                    $('#addNew').modal('hide');
                     Swal.fire(
                        'Updated!',
                        'Information has been updated.',
                        'success'
                        )
                        this.$Progress.finish();
                         Fire.$emit('AfterCreate');
                })
                .catch(() => {
                    this.$Progress.fail();
                });

            },
            editModal(user){
                this.editmode = true;
                this.form.reset();
                $('#addNew').modal('show');
                this.form.fill(user);
            },
            newModal(){
                this.editmode = false;
                this.form.reset();
                $('#addNew').modal('show');
            },
            deleteUser(id){
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
                                this.form.delete('api/user/'+id).then(()=>{
                                        Swal.fire(
                                        'Deleted!',
                                        'Your file has been deleted.',
                                        'success'
                                        )
                                    Fire.$emit('AfterCreate');
                                }).catch(()=> {
                                    Swal.fire("Failed!", "There was something wronge.", "warning");
                                });
                         }
                    })
            },
            loadUsers(){
                if(this.$gate.isAdminOrAuthor()){
                    axios.get("api/user").then(({ data }) => (this.users = data));
                }
            },

            createUser(){
                this.$Progress.start();

                this.form.post('api/user')
                .then(()=>{
                    Fire.$emit('AfterCreate');
                    $('#addNew').modal('hide')

                  Swal.fire({
                    timerProgressBar: true,
                    showConfirmButton: false,
                    timer: 1500,
                    toast : true,
                    icon : 'success',
                    position:'top-right',
                    title: 'User added successfully'
                    })
              this.$Progress.finish();

                })
                .catch(()=>{

                })
            }
        },
        created() {
            Fire.$on('searching',() => {
                let query = this.$parent.search;
                axios.get('api/findUser?q=' + query)
                .then((data) => {
                    this.users = data.data
                })
                .catch(() => {

                })
            })
           this.loadUsers();
           Fire.$on('AfterCreate',() => {
               this.loadUsers();
           });
        //    setInterval(() => this.loadUsers(), 3000);
        }

    }
</script>
