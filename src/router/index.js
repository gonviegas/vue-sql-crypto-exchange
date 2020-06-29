import Vue from "vue";
import VueRouter from "vue-router";
import Home from "../views/Home.vue";
import UserAuth from "../views/UserAuth.vue";
import AdminAuth from "../views/AdminAuth.vue";
import AdminDashboard from "../views/AdminDashboard.vue";
import UserDashboard from "../views/UserDashboard.vue";

Vue.use(VueRouter);

const routes = [
  {
    path: "/",
    name: "Home",
    component: Home
  },
  {
    path: "/user",
    name: "User",
    redirect: "user/dashboard",
    component: UserAuth,
    children: [
      {
        path: "/user/signup",
        name: "UserAuthSignUp",
        component: () => import("../components/user/auth/UserAuthSignUp.vue")
      },
      {
        path: "/user/login",
        name: "UserAuthLogin",
        component: () => import("../components/user/auth/UserAuthLogin.vue")
      },
      {
        path: "/user/reset",
        name: "UserAuthPassReset",
        component: () => import("../components/user/auth/UserAuthPassReset.vue")
      },
      {
        path: "/user/dashboard",
        name: "UserDashboard",
        component: UserDashboard
      }
    ]
  },
  {
    path: "/admin",
    name: "Admin",
    redirect: "admin/dashboard",
    component: AdminAuth,
    children: [
      {
        path: "/admin/login",
        name: "AdminAuthLogin",
        component: () => import("../components/admin/auth/AdminAuthLogin.vue")
      },
      {
        path: "/admin/dashboard",
        name: "AdminDashboard",
        component: AdminDashboard
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
