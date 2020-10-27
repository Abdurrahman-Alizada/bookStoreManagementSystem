<template>
    <div class="container">
      <div class="row  justify-content-center ">
       <div>   
            <button class="btn btn-success"><i class="fas fa-hourglass-start fa-lg"></i> Add discount</button>
            <button class="btn btn-primary"><i class="fas fa-sort-amount-up-alt fa-lg"></i> Queue discount</button>
            <button class="btn btn-info">   <i class="fas fa-edit fa-lg"></i>Edit discount</button>
            <button class="btn btn-danger"> <i class="fas fa-hourglass-end fa-lg"></i> End discount</button>
      </div>
      </div>
        <div class="row mt-5">
            <div class="col-md-6">
                 <div class="card">
              <div class="card-header">
                <h1 class="card-title d-sm-inline">Current Discount</h1>

                <div class="card-tools">
                 
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>Serial #</th>
                      <th>Discount on</th>
                      <th>Discount %</th>
                      <th>Expiry Date</th>
                      <th>Details</th>

                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>183</td>
                      <td>John Doe</td>
                      <td>John Doe</td>
                      <td>11-7-2014</td>
                      <td><i type="button" class="far fa-arrow-alt-circle-right fa-2x text-info"></i></td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            </div>
            <div class="col-md-6">
                <div class="card">
              <div class="card-header">
                <h1 class="card-title d-sm-inline">Qeueud Discount</h1>

                <div class="card-tools">
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>Serial #</th>
                      <th>Discount on</th>
                      <th>Discount %</th>
                      <th>Start from</th>
                      <th>Start</th>

                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>183</td>
                      <td>John Doe</td>
                      <td>John Doe</td>
                      <td>11-7-2014</td>
                      <td><i type="button" class="far fa-arrow-alt-circle-right fa-2x text-info"></i></td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
             </div>



        </div>
    </div>
</template>

<script>

export default {
  name : 'users',

    data(){
        return{
          form :new Form({
              name : '',
              email : '',
              password : '',
              type : '',
              status : '',
              isActive : ''
            }),

         modal : ''
        
        }
    },
  methods : {

    newcategory(){
        this.modal = 'new';
       $('#categoryModal').modal('show');    
    },
     addcategory(){

    },
      
    editcategory(){
        this.modal = 'edit';
        $('#categoryModal').modal('show');
    },

    deletecategory(){
        
    }


},




mounted() {
            console.log('Component mounted.')
        }
    }
</script>
