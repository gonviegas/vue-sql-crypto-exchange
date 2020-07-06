import Vue from "vue";
import App from "./App.vue";
import router from "./router";

import "bootstrap";
import "bootstrap/dist/css/bootstrap.min.css";

//axios_url var - prod or deploy
Object.defineProperty(Vue.prototype, "$axios_url", {
  value: "http://localhost/api/api.php"
  // value: "api/api.php"
});

Vue.config.productionTip = false;

new Vue({
  router,
  render: h => h(App)
}).$mount("#app");
