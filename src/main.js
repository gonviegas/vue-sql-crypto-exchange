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

Object.defineProperty(Vue.prototype, "$axios_url_faker", {
  value: "http://localhost/api/faker.php"
  // value: "api/faker.php"
});

Object.defineProperty(Vue.prototype, "$axios_url_news_market_api", {
  value: "http://localhost/api/news_market_api.php"
  // value: "api/news_market_api.php"
});

localStorage.setItem('admin_session', false);
localStorage.setItem('user_session', false);
localStorage.setItem('front_session', false);

Vue.config.productionTip = false;

new Vue({
  router,
  render: h => h(App)
}).$mount("#app");
