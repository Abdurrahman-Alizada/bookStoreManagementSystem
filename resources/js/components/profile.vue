<template>
    <div class="container">
        <div class="row">
         <div class="col-md-5">
            <!-- Widget: user widget style 2 -->
            <div class="card card-widget widget-user-2">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-warning">
                  <div class="widget-user-image ">
                    <img class="mt-3 img-circle col-12  mx-auto d-flex-block" :src="getProfilePhoto()" alt="User">
                  </div>
                    <!-- /.widget-user-image -->
                    <p class="widget-user-username">{{this.form.name}}</p>
                    <p class="widget-user-desc">Lead Developer</p>
                </div>
                <div class="card-footer p-0">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                Projects <span class="float-right badge bg-primary">31</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                Tasks <span class="float-right badge bg-info">5</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                Completed Projects <span class="float-right badge bg-success">12</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                Followers <span class="float-right badge bg-danger">842</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- /.widget-user -->
        </div>
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Activity</a></li>
                            <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li>
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="activity">

                            </div>


                            <div class="tab-pane" id="settings">
                                <form class="form-horizontal">
                                    <div class="form-group row">
                                        <label for="inputname" class="col-sm-2 col-form-label">Name</label>
                                        <div class="col-sm-10">
                                            <input type="text"  class="form-control" id="inputName" v-model="form.name" placeholder="Name">
                                        
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="inputemail" class="col-sm-2 col-form-label">Email</label>
                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" id="inputEmail" v-model="form.email" >
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label for="inputpassword"  class="col-sm-2 col-form-label">Password</label>
                                        <div class="col-sm-10">
                                            <input type="password" class="form-control" v-model="form.password" id="inputpassword" placeholder="password">
                                        </div>
                                    </div>
             
                                    <div class="form-group row">
                                        <label for="inputfile"  class="col-sm-2 col-form-label">Photo</label>
                                        <div class="col-sm-10">
                                            <input type="file" @change="updateFile" class="form-control" id="inputfile" placeholder="chose file">
                                        </div>
                                        <div class="col-sm-2">
                                            <img :src="form.image" class="img-responsive">
                                        </div>
             
                                    </div>
             
                                    <div class="form-group row">
                                        <label for="inputpassport" class="col-sm-2 col-form-label">Passport</label>
                                        <div class="col-sm-10">
                                            <input type="passport" class="form-control" id="inputpassport" placeholder="Passport">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="offset-sm-2 col-sm-10">
                                            <button type="submit" @click.prevent="updateProfile" class="btn btn-success">Update</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Swal from 'sweetalert2';
    export default {

        data(){
         return{
            
            form: {
                id:'',
                name : '',
                email: '',
                password: '',
                type: '',
                bio: '',
                image: ''
            }
    }
      },

        methods: {

          getProfilePhoto(){
                // let photo = (this.form.image.length > 200) ? this.form.image : "img/profile/"+ this.form.image ;
                // return photo;
          },

            loadUsers() {
                axios.get("api/profile")
                .then(({data}) => this.form = data);
            },
          
          updateFile(e){
                  let file = e.target.files[0];
//                  console.log(file);
                let reader = new FileReader();
     
                // let limit = 1024 * 1024 * 2;
                if(file['size'] > 2111775){
                    Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong!',
                    footer: '<a href>Why do I have this issue?</a>',              
                    timer: 5000
                 })
                }
                  else{
                  reader.onloadend = (file) => {
                    this.form.image = reader.result;
                   console.log(reader.result);
                }
                reader.readAsDataURL(file);
                  }
          },

          updateProfile(){
              this.$Progress.start();
              axios.put('api/profile',this.form)
              .then(()=>{
                 Fire.$emit('AfterCreate');
                 this.$Progress.finish();  
                  Swal.fire({
                    position :'top-end',
                    toast : true,
                    icon: 'success',
                    showConfirmButton: false,
                    title: 'Profile updated successfully',
                    footer: '<a href>Have a Question?</a>',              
                    timer: 5000
                 })
                 
              })
              .catch(()=>{
                this.$Progress.fail();
              })
          },
          
       },

        created() {
         this.loadUsers();
        }
    }
</script>
<style scoped>
  img{
        max-height: 36px;
    }
</style>