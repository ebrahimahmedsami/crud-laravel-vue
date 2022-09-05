<template>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-2">
                <Navbar></Navbar>
            </div>
            <div class="col-md-10">
                <router-view></router-view>
            </div>
        </div>
    </div>
</template>

<script>
import Navbar from "./navbar.vue";
    export default {
        components:{
            Navbar
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
