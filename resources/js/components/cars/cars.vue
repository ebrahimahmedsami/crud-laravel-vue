<template>
    <div class="container">
        <h1 class="text-center title-h1">Cars Page</h1>
        <router-link to="add-car" class="btn btn-primary"><i class="fa fa-plus"></i></router-link>
        <div class="cars-container mt-2 mb-2">
            <div class="row">
                <div class="col-lg-4" v-for="car in carsList" :key="'car_'+car.id">
                    <div class="card mt-2 mb-2">
                        <h5 class="card-header">{{car.name}}</h5>
                        <div class="card-body">
                            <h5 class="card-title">{{car.type}}</h5>
                            <h5 class="card-title">${{car.price}}</h5>
                            <p class="card-text">{{car.description}}</p>
                           <div class="d-flex justify-content-between">
                               <button class="btn btn-danger" @click="deleteCarById(car.id)"><i class="fa fa-trash-alt"></i></button>
                                <router-link class="btn btn-warning" :to="{name:'add-car',params:{id:car.id}}"><i class="fa fa-edit"></i></router-link>
                           </div>
                        </div>
                    </div>
                </div>
                <pagination @page="pages" :links="links" :meta="meta"></pagination>
            </div>
        </div>
    </div>
</template>

<script>
import Pagination from "../pagination.vue";
export default {
    name: "cars",
    components:{
        Pagination
    },
    data(){
        return{
            carsList:[],
            meta:{},
            links:{},
            page:1
        }
    },
    methods:{
        getAllCars(){
            axios.get('/cars?page=' + this.page).then(data => {
               this.carsList = data.data.data
               this.meta = data.data.meta
               this.links = data.data.links
            })
        },
        pages(i){
            this.page = i;
            this.getAllCars()
        },
        deleteCarById(id){
            let thisRef = this
            this.$swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete(`/cars/${id}`).then(() =>{
                        this.$swal.fire('Deleted!', 'Car Deleted Successfully', 'success')
                        thisRef.getAllCars()
                    })
                }
            })
        }
    },
    created() {
        this.getAllCars();
    }
}
</script>

<style scoped>

</style>
