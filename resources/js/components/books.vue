<template>
  <b-container fluid>

    <div v-if="$gate.isAdmin()">
    <!-- book Interface controls -->
    <b-row>
      <b-col lg="6" class="my-1">
        <b-form-group
          label="Sort"
          label-cols-sm="3"
          label-align-sm="right"
          label-size="sm"
          label-for="sortBySelect"
          class="mb-0"
        >
          <b-input-group size="sm">
            <b-form-select v-model="sortBy" id="sortBySelect" :options="sortOptions" class="w-75">
              <template v-slot:first>
                <option value="">-- none --</option>
              </template>
            </b-form-select>
            <b-form-select v-model="sortDesc" size="sm" :disabled="!sortBy" class="w-25">
              <option :value="false">Asc</option>
              <option :value="true">Desc</option>
            </b-form-select>
          </b-input-group>
        </b-form-group>
      </b-col>

      <b-col lg="6" class="my-1">
        <b-form-group
          label="Initial sort"
          label-cols-sm="3"
          label-align-sm="right"
          label-size="sm"
          label-for="initialSortSelect"
          class="mb-0"
        >
          <b-form-select
            v-model="sortDirection"
            id="initialSortSelect"
            size="sm"
            :options="['asc', 'desc', 'last']"
          ></b-form-select>
        </b-form-group>
      </b-col>

      <b-col lg="6" class="my-1">
        <b-form-group
          label="Filter"
          label-cols-sm="3"
          label-align-sm="right"
          label-size="sm"
          label-for="filterInput"
          class="mb-0"
        >
          <b-input-group size="sm">
            <b-form-input
              v-model="filter"
              type="search"
              id="filterInput"
              placeholder="Type to Search"
            ></b-form-input>
            <b-input-group-append>
              <b-button :disabled="!filter" @click="filter = ''">Clear</b-button>
            </b-input-group-append>
          </b-input-group>
        </b-form-group>
      </b-col>

      <b-col lg="6" class="my-1">
        <b-form-group
          label="Filter On"
          label-cols-sm="3"
          label-align-sm="right"
          label-size="sm"
          description="Leave all unchecked to filter on all data"
          class="mb-0">
          <b-form-checkbox-group v-model="filterOn" class="mt-1">
            <b-form-checkbox value="title">title</b-form-checkbox>
            <b-form-checkbox value="author">author</b-form-checkbox>
            <b-form-checkbox value="ISBN">ISBN</b-form-checkbox>
          </b-form-checkbox-group>
        </b-form-group>
      </b-col>

      <b-col sm="5" md="6" class="my-1">
        <b-form-group
          label="Per page"
          label-cols-sm="6"
          label-cols-md="4"
          label-cols-lg="3"
          label-align-sm="right"
          label-size="sm"
          label-for="perPageSelect"
          class="mb-0"
        >
          <b-form-select
            v-model="perPage"
            id="perPageSelect"
            size="sm"
            :options="pageOptions"
          ></b-form-select>
        </b-form-group>
      </b-col>

      <b-col sm="5" md="6" class="my-1">
         <b-button variant="primary" @click="newbook" v-b-modal.bookModal-center class="btn-sm float-right"><i class="fas fa-plus-circle"></i> Add book</b-button>
      </b-col>

    </b-row>

    <!-- Main table element -->
    <b-table
      show-empty
      medium
      stacked="md"
      striped hover
      :items="items"
      :fields="fields"
      :current-page="currentPage"
      :per-page="perPage"
      :filter="filter"
      :filter-included-fields="filterOn"
      :sort-by.sync="sortBy"
      :sort-desc.sync="sortDesc"
      :sort-direction="sortDirection"
      @filtered="onFiltered"
    >
      <template v-slot:cell(id)="row">
        {{ row.item.id }}
      </template>
      <template v-slot:cell(author)="row">
        {{ row.item.author }}
      </template>
      
      <template v-slot:cell(title)="row">
        {{ row.item.title }}
      </template>

      <template v-slot:cell(price)="row">
        {{ row.item.price }} 
      </template>

      <template v-slot:cell(ISBN)="row">
        {{ row.item.ISBN }} 
      </template>

      <template v-slot:cell(actions)="row">
          <b-button variant="outline-success" v-b-tooltip.hover title="Add to Cart" size="sm" class="mr-1">
         <addToCart
           :name = "row.item.title"
           :price = "row.item.price"
         ></addToCart> 
          </b-button>
          
        <b-button variant="outline-primary" size="sm" @click="info(row.item, row.index, $event.target)" class="mr-1">
         <i class="fas fa-edit"></i>
        </b-button>

        <b-button size="sm" @click="deletebook(row.item.id ,row.item.title)" variant="outline-danger">
          <i class="fas fa-trash"></i>
          </b-button>
        
        <b-button size="sm" @click="row.toggleDetails">
          {{ row.detailsShowing ? 'Hide' : 'Show' }} 
        </b-button>
      </template>

      <template v-slot:row-details="row">
        <b-card>
          <ul>
            <li v-for="(value, key) in row.item" :key="key">{{ key }}: {{ value }}</li>
          </ul>
        </b-card>
      </template>
 
 
    </b-table>
 <hr>
    <b-col class="d-flex">
   <b-col sm="5" md="6" class="my-1 d-inline">
        <b-pagination
          v-model="currentPage"
          :total-rows="totalRows"
          :per-page="perPage"
          align="fill"
          size="sm"
          class="my-0"
        ></b-pagination>
      </b-col>
   
      <b-col sm="6" md="6" class="d-inline ">
            <b-button @click='exportbook' size="sm" variant="success" class="float-right"><i class="fas fa-print mr-1"></i>Export</b-button>
      </b-col>
    </b-col>

    <!-- Info modal -->
    <b-modal id="bookModal-center" ref="modal"  :title='infoModal.title' 
      @ok="handleOk"  
      @hide="resetInfoModal">
     
     
      <form ref="form" @submit.prevent="addNewbook()">
     <b-row>
       <b-col sm="7" md="7">  
        <b-form-group label="title" label-for="title-input" >
          <b-form-input id="title-input" placeholder="title : *" v-model="book.title"></b-form-input>
        </b-form-group>


        <b-form-group label="author" label-for="author-input">
          <b-form-input id="author-input" v-model="book.author" placeholder="Author : * " ></b-form-input>
        </b-form-group>

        <b-form-group label="totalPages" label-for="totalPages-input" >
          <b-form-input id="totalPages-input" v-model="book.totalPages" placeholder="Total Pages : *"></b-form-input>
        </b-form-group>

        <b-form-group label="ISBN" label-for="ISBN-input" >
          <b-form-input id="ISBN-input" v-model="book.ISBN" placeholder="ISBN : *"></b-form-input>
        </b-form-group>

       </b-col>


       <b-col sm="5" md="5">

        <b-form-group label="price" label-for="price" >
          <b-form-input id="price-input" v-model="book.price" placeholder="price"></b-form-input>
        </b-form-group>

        <b-form-group label="category" label-for="category" >
          <b-form-input id="category-input" v-model="book.category" placeholder="category"></b-form-input>
        </b-form-group>

        <b-form-group label="publish_date" label-for="publish_date" >
          <b-form-input id="publish_date-input" v-model="book.publish_date" placeholder="publish_date"></b-form-input>
        </b-form-group>

        <b-form-group label="publisher_id" label-for="publisher_id" >
          <b-form-input id="publisher_id-input" v-model="book.publisher_id" placeholder="publisher_id"></b-form-input>
        </b-form-group>

       
       </b-col>
      </b-row>

      </form>

      <!-- <pre>{{ infoModal.content.id }}</pre> -->
    </b-modal>
    </div>

    <div v-if="!$gate.isAdmin()">
        <notFound></notFound>        
    </div>
  </b-container>
</template>

<script>
import addToCart from './addToCart';
  export default {
    components:{
      addToCart
    },
    data() {
      return {
        items: [],

        fields: [
          { key: 'id', label: 'Serial #', sortable: true, sortDirection: 'desc' ,  _cellVariants: { id: 'info'}},
         { key: 'title', label: 'Title', sortable: true, class: 'text-center' },
         { key: 'Author', label: 'Author', sortable: true, class: 'text-center' },
          { key: 'price', label: 'Price', sortable: true, sortDirection: 'desc' },
          { key: 'ISBN', label: 'ISBN', sortable: true, sortDirection: 'desc' },
         
         // {
          //   key: 'status',
          //   label: 'Status',
          //   // formatter: (value, key, item) => {
          //   //   return value ? 'Yes' : 'No'
          //   // },
          //   sortable: true,
          //   sortByFormatted: true,
          //   filterByFormatted: true
          // },
          { key: 'actions', label: 'Actions' }
        ],
        totalRows: 1,
        currentPage: 1,
        perPage: 5,
        pageOptions: [5, 10, 15],
        sortBy: '',
        sortDesc: false,
        sortDirection: 'asc',
        filter: null,
        filterOn: [],

        editMode : false,
        book : new Form([{
            author : '',
            totalPages: '',
            title : '',
            price :'',
            ISBN :'',
            category : '',
            publisher_id : '',
            publish_date : '',
        }]),
        infoModal: {
          id: 'info-modal',
          title: '',
          content: ''
        }
      }
    },
    computed: {
        sortOptions() {
        // Create an options list from our fields
        return this.fields
          .filter(f => f.sortable)
          .map(f => {
            return { text: f.label, value: f.key }
          })
      }
    },
    mounted() {
       //event: update table after updating or adding book
        Fire.$on('updateTable',()=>{
            this.loadbooks();
        })
       //end event

         this.loadbooks();
    },
    methods: {
             //load all book on mounting of components
             loadbooks() {
               if(this.$gate.isAdmin()){
            axios.get('api/books?page=' + this.currentPage + '&size=' + this.perPage)
              .then(({ data }) => {
                  this.items = data.data
                  this.totalRows = this.items.length;
                  })
               }
              },

             //open modal and manage variables for adding new book 
            newbook(){
               this.infoModal.title = `Add New book`         
                this.editMode = false;
                  this.book= new Form({});
          },
             //add new book to server
            addNewbook(){   
                this.$Progress.start();
             this.book.post('api/books').then(()=>{
                 Fire.$emit('updateTable');
                this.book.reset();
                Swal.fire({
                  toast: true,
                  background : 'white',
                  color : 'white',
                  position: 'top-end',
                  icon: 'success',
                  timerProgressBar: true,
                  title: 'book Added successfully',
                  showConfirmButton: false,
                  timer: 1500
                })
               })
               .catch(()=>{
                   Swal.fire({
                      icon: 'error',
                      title: 'Oops...',
                      text: 'Something went wrong!',
                      footer: '<a href>Why do I have this issue?</a>'
                    })
               });
            },
            updatebook(){
                this.$Progress.start();
                this.book.put('api/books/'+this.book.id)
              .then(() => {
                Swal.fire({
                  toast: true,
                  background : 'white',
                  color : 'white',
                  position: 'top-end',
                  icon: 'success',
                  timerProgressBar: true,
                  title: 'information updated successfully',
                  showConfirmButton: false,
                  timer: 1500
                })
                this.$Progress.finish();
                    Fire.$emit('updateTable');
                })
                .catch(() => {
                    this.$Progress.fail();
                });

            },
           
                deletebook(id,title){
                   Swal.fire({
                    title: 'Are you sure?',
                    html: "You won't be able to revert <b>"+ title  +'</b> information',
                    
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {

                        // Send request to the server
                         if (result.value) {
                        this.book.delete('api/books/'+id).then(()=>{
                          Swal.fire({
                            toast: true,
                            background : 'white',
                            color : 'white',
                            position: 'top-end',
                            icon: 'success',
                            timerProgressBar: true,
                            title: 'book Deleted successfully',
                            showConfirmButton: false,
                            timer: 1500            
                           })
                        Fire.$emit('updateTable');
                         }).catch(()=> {
                        Swal.fire("Failed!", "There was something wronge.", "warning");
                        });
                      }
                    })
                  },
           exportbook(){
               window.print()
           },
           
           //form
             
      checkFormValidity() {
        const valid = this.$refs.form.checkValidity()
        this.titleState = valid
        return valid
      },
      
      handleOk(bvModalEvt) {
        // Prevent modal from closing
        bvModalEvt.preventDefault()
        // Trigger submit handler
        this.handleSubmit()
      },
      handleSubmit() {
        // Exit when the form isn't valid
        if (!this.checkFormValidity()) {
          return
        }
        // Push the title to submitted titles
        if(this.editMode){
            this.updatebook();
        }else{
            this.addNewbook();
        }
        // Hide the modal manually
        this.$nextTick(() => {
          this.$bvModal.hide('bookModal-center');
        })
      },

            // end form

      info(item, index, button) {
        //   this.infoModal.id = `${index}
        this.editMode = true;
        this.infoModal.title = `Edit information of Index No. ${index}`
        console.log(typeof item)
         this.book =new Form(item); 
        this.$root.$emit('bv::show::modal', 'bookModal-center', button)
      },

      resetInfoModal() {
        this.infoModal.title = ''
        this.infoModal.content = ''
      },
      onFiltered(filteredItems) {
        // Trigger pagination to update the number of buttons/pages due to filtering
        this.totalRows = filteredItems.length
        this.currentPage = 1
      }
    }
  }
</script>