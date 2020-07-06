import Vue from "vue";
import VueRouter from "vue-router";
import Home from "../views/Home.vue";
import UserAuth from "../views/UserAuth.vue";
import StaffAuth from "../views/StaffAuth.vue";
import AdminDashboard from "../views/AdminDashboard.vue";
import FrontDashboard from "../views/FrontDashboard.vue";
import UserDashboard from "../views/UserDashboard.vue";

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
    path: "/staff",
    name: "staff",
    redirect: "/staff/login",
    component: StaffAuth,
    children: [
      {
        path: "login",
        name: "StaffAuthLogin",
        component: () => import("../components/staff/StaffAuthLogin.vue")
      }
    ]
  },
  {
    path: "/admin/dashboard",
    name: "AdminDashboard",
    alias: "/admin",
    component: AdminDashboard,
    children: [
      {
        path: "/admin/customers",
        name: "AdminCustomers",
        component: () =>
          import("../components/staff/backoffice/AdminCustomers.vue")
      },
      {
        path: "/admin/wallets",
        name: "AdminWallets",
        component: () =>
          import("../components/staff/backoffice/AdminWallets.vue")
      },
      {
        path: "/admin/news",
        name: "AdminNews",
        component: () => import("../components/staff/backoffice/AdminNews.vue")
      },
      {
        path: "/admin/staff",
        name: "AdminStaff",
        component: () => import("../components/staff/backoffice/AdminStaff.vue")
      },
      {
        path: "/admin/store-wallet",
        name: "AdminStoreWallet",
        component: () =>
          import("../components/staff/backoffice/AdminStoreWallet.vue")
      },
      {
        path: "/admin/transfers",
        name: "AdminTransfers",
        component: () =>
          import("../components/staff/backoffice/AdminTransfers.vue")
      }
    ]
  },
  {
    path: "/front/dashboard",
    name: "FrontDashboard",
    alias: "/front/",
    component: FrontDashboard,
    children: [
      {
        path: "/front/customers",
        name: "FrontCustomers",
        component: () =>
          import("../components/staff/frontoffice/FrontCustomers.vue")
      },
      {
        path: "/front/wallets",
        name: "FrontWallets",
        component: () =>
          import("../components/staff/frontoffice/FrontWallets.vue")
      },
      {
        path: "/front/staff",
        name: "FrontStaff",
        component: () =>
          import("../components/staff/frontoffice/FrontStaff.vue")
      },
      {
        path: "/front/store-wallet",
        name: "FrontStoreWallet",
        component: () =>
          import("../components/staff/frontoffice/FrontStoreWallet.vue")
      },
      {
        path: "/front/transfers",
        name: "FrontTransfers",
        component: () =>
          import("../components/staff/frontoffice/FrontTransfers.vue")
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
