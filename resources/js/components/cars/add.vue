<template>
    <div class="container">
        <h1 class="text-center title-h1">{{pageTitle}}</h1>
        <form @submit.prevent="Store">
            <div class="form-group">
                <label>Name</label>
                <input v-model="carData.name" type="text" class="form-control" placeholder="Enter Name">
                <span class="text-danger" v-if="errors.name">{{errors.name[0]}}</span>
            </div>
            <div class="form-group">
                <label>Type</label>
                <input v-model="carData.type" type="text" class="form-control" placeholder="Enter Type">
                <span class="text-danger" v-if="errors.type">{{errors.type[0]}}</span>
            </div>
            <div class="form-group">
                <label>Price</label>
                <input v-model="carData.price" type="number" class="form-control" placeholder="Enter price">
                <span class="text-danger" v-if="errors.price">{{errors.price[0]}}</span>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Description</label>
                <textarea v-model="carData.description" class="form-control"></textarea>
                <span class="text-danger" v-if="errors.description">{{errors.description[0]}}</span>
            </div>
            <button type="submit" :class="`btn btn-${buttonSaveColor} mt-2`">{{buttonSaveTitle}}</button>
        </form>
    </div>
</template>

<script>
export default {
    name: "add",
    data(){
        return{
            carData:{
                name:null,
                type:null,
                description:null,
                price:null,
            },
            errors:{},
            pageTitle:'Add Car Page',
            buttonSaveTitle:'Add',
            buttonSaveColor:'primary',
            id:this.$route.params.id
        }
    },
    methods:{
        Store(){
          if (this.id)
              this.editCar()
            else
                this.addCar()
        },
        addCar(){
            this.errors = {}
            axios.post('/cars',this.carData).then(data => {
                this.$router.push({'name':'cars'});
            }).catch(err => {
                if(err.response.status === 422) {
                    this.errors = err.response.data
                }
            })
        },
        editCar(){
            this.errors = {}
            axios.patch(`/cars/${this.id}`,this.carData,).then(data => {
                this.$router.push({'name':'cars'});
            }).catch(err => {
                if(err.response.status === 422) {
                    this.errors = err.response.data
                }
            })
        },
        getCarById(id){
            axios.get(`/cars/${id}`).then(data => {
                this.carData = data.data.data
            })
        }
    },
    created() {
        if(this.id){
            this.pageTitle = 'Edit Car Page'
            this.buttonSaveTitle = 'Edit'
            this.buttonSaveColor = 'warning'
            this.getCarById(this.id)
        }
    }
}
</script>

<style scoped>

</style>
