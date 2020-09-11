import Vue from 'vue'
import App from './App.vue'
import vuetify from './vuetify/vuetify' // path to vuetify export

new Vue({
  vuetify,
  render: (h) => h(App),
}).$mount('#app')
