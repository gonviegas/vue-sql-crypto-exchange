import Vue from "vue";
import VueRouter from "vue-router";
import Home from "../views/Home.vue";
import Auth from "../views/Auth.vue";

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
        path: "/auth/signup",
        name: "SignUp",
        component: () => import("../components/auth/AuthSignUp.vue")
      },
      {
        path: "/auth/login",
        name: "Login",
        component: () => import("../components/auth/AuthLogin.vue")
      },
      {
        path: "/auth/reset",
        name: "Reset",
        component: () => import("../components/auth/AuthPassReset.vue")
      }
    ]
  }
];

const router = new VueRouter({
  // mode: "history",
  // base: process.env.BASE_URL,
  routes
});

export default router;
