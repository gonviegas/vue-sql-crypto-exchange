import Vue from "vue";
import VueRouter from "vue-router";
import Home from "../views/Home.vue";

Vue.use(VueRouter);

const routes = [
  {
    path: "/",
    name: "Home",
    component: Home
  },
  {
    path: "/news",
    name: "News",
    component: () => import("../views/News.vue")
  },
  {
    path: "/login",
    name: "News",
    component: () => import("../views/Login.vue")
  },
  {
    path: "/signup",
    name: "News",
    component: () => import("../views/SignUp.vue")
  }
];

const router = new VueRouter({
  routes
});

export default router;
