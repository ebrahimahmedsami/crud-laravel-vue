//bootstrap
import './bootstrap';
import '../sass/app.scss'
import lodash from "lodash";
window._ = lodash
import * as Popper from '@popperjs/core'
window.Popper = Popper


//Sweet Alert
import VueSweetalert2 from "vue-sweetalert2";
import 'sweetalert2/dist/sweetalert2.min.css';


//axios
import axios from 'axios'
window.axios = axios
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.axios.defaults.baseURL = '/api';


//router
import routers from "./components/router";


//app setting
import Application from './components/app.vue';
import { createApp } from 'vue'
createApp(Application).use(routers).use(VueSweetalert2).mount('#app')

