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
    component: Home,
    children: [
      {
        path: "news",
        name: "News",
        component: () => import("../components/News.vue")
      },
      {
        path: "market",
        name: "Market",
        component: () => import("../components/Market.vue")
      }
    ]
  },
  {
    path: "/user",
    name: "User",
    component: UserAuth,
    children: [
      {
        path: "signup",
        name: "UserAuthSignUp",
        component: () => import("../components/user/UserAuthSignUp.vue")
      },
      {
        path: "login",
        name: "UserAuthLogin",
        component: () => import("../components/user/UserAuthLogin.vue")
      },
      {
        path: "reset",
        name: "UserAuthReset",
        component: () => import("../components/user/UserAuthReset.vue")
      }
    ]
  },
  {
    path: "/user/dashboard",
    name: "UserDashboard",
    component: UserDashboard,
    children: [
      {
        path: "/user/trade",
        name: "UserTrade",
        component: () => import("../components/user/UserTrade.vue")
      },
      {
        path: "/user/trade-history",
        name: "UserTradeHistory",
        component: () => import("../components/user/UserTradeHistory.vue")
      },
      {
        path: "/user/wallet",
        name: "UserWallet",
        component: () => import("../components/user/UserWallet.vue")
      },
      {
        path: "/user/account",
        name: "UserAccount",
        component: () => import("../components/user/UserAccount.vue")
      }
    ]
  },

  {
    path: "/admin",
    name: "Admin",
    redirect: "/admin/login",
    component: Admin,
    children: [
      {
        path: "login",
        name: "AdminAuthLogin",
        component: () => import("../components/admin/AdminAuthLogin.vue")
      }
    ]
  },
  {
    path: "/admin/dashboard",
    name: "AdminDashboard",
    component: AdminDashboard,
    children: [
      {
        path: "/admin/customers",
        name: "AdminCustomersTable",
        component: () => import("../components/admin/AdminCustomersTable.vue")
      },
      {
        path: "/admin/crypto-api",
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
