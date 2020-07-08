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

Object.defineProperty(Vue.prototype, "$axios_url_news_market_api", {
  value: "http://localhost/api/news_market_api.php"
  // value: "api/news_market_api.php"
});

Vue.config.productionTip = false;

new Vue({
  router,
  render: h => h(App)
}).$mount("#app");
