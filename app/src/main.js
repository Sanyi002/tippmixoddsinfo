import Vue from 'vue'
import axios from 'axios'
import VueAxios from 'vue-axios'
import 'bootstrap'
import 'bootstrap/dist/css/bootstrap.min.css'
import App from './App.vue'
import router from './router'

Vue.config.productionTip = false

Vue.use(VueAxios, axios)
Vue.prototype.$ApiHostname = 'http://localhost:9090/';

new Vue({
  router,
  render: h => h(App)
}).$mount('#app')