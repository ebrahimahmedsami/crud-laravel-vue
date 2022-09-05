import { createRouter, createWebHistory } from "vue-router";

const routes = [
    {
        path: "/",
        name: "home",
        component: () => import("../components/home.vue"),
    },
    {
        path: "/cars",
        name: "cars",
        component: () => import("./cars/cars.vue"),
    },
    {
        path: "/add-car/:id?",
        name: "add-car",
        component: () => import("./cars/add.vue"),
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes,
    linkActiveClass:'active-class'
});

export default router;
