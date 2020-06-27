import Vue from "vue";
import VueRouter from "vue-router";
import Home from "../views/Home.vue";
import Auth from "../views/Auth.vue";
// import SignUp from "../views/SignUp.vue";

Vue.use(VueRouter);

const routes = [
  {
    path: "/",
    name: "Home",
    component: Home
  },
  {
    path: "/auth",
    name: "Auth",
    component: Auth,
    children: [
      {
        path: "/signup",
        name: "SignUp",
        component: () => import("../components/AuthSignUp.vue")
      },
      {
        path: "/login",
        name: "Login",
        component: () => import("../components/AuthLogin.vue")
      }
    ]
  }
  // {
  //   path: "/news",
  //   name: "News",
  //   component: () => import("../views/News.vue")
  // },
  // {
  //   path: "/login",
  //   name: "Login",
  //   component: () => import("../views/Login.vue")
  // },
  // {
  //   path: "/news",
  //   name: "SignUp",
  //   component: () => import("../views/SignUp.vue")
  // }
];

const router = new VueRouter({
  // mode: "history",
  // base: process.env.BASE_URL,
  routes
});

export default router;
