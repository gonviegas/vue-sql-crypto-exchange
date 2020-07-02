import Vue from "vue";
import VueRouter from "vue-router";
import Home from "../views/Home.vue";
import UserAuth from "../views/UserAuth.vue";
import UserDashboard from "../views/UserDashboard.vue";
import Admin from "../views/Admin.vue";
import AdminDashboard from "../views/AdminDashboard.vue";

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
    component: UserAuth,
    children: [
      {
        path: "signup",
        name: "UserAuthSignUp",
        component: () => import("../components/user/auth/UserAuthSignUp.vue")
      },
      {
        path: "login",
        name: "UserAuthLogin",
        component: () => import("../components/user/auth/UserAuthLogin.vue")
      },
      {
        path: "reset",
        name: "UserAuthReset",
        component: () => import("../components/user/auth/UserAuthReset.vue")
      }
    ]
  },
  {
    path: "/user/dashboard",
    name: "UserDashboard",
    component: UserDashboard
  },

  {
    path: "/admin",
    name: "Admin",
    component: Admin,
    children: [
      {
        path: "login",
        name: "AdminAuthLogin",
        component: () => import("../components/admin/auth/AdminAuthLogin.vue")
      }
    ]
  },
  {
    path: "/admin/dashboard",
    name: "AdminDashboard",
    component: AdminDashboard,
    children: [
      {
        path: "users",
        name: "AdminUsersTable",
        component: () => import("../components/admin/AdminUsersTable.vue")
      },
      {
        path: "crypto-api",
        name: "CryptoApi",
        component: () => import("../components/CryptoApi.vue")
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
