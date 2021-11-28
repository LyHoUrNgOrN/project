import { createApp } from "vue";
import { createRouter, createWebHistory } from "vue-router";
import App from "./App.vue";
import BottonWidget from "./components/button_widget/Button.vue";
import SignIn from "./components/sign_in/Sign_In.vue";

const app = createApp(App);
app.component("BottonWidget", BottonWidget);
app.component("sign-in", SignIn);


const router = createRouter({
    history: createWebHistory(),
    routes: [
      
      { path: '/signIn', component: SignIn },
   
    ]
})
app.use(router);
app.mount("#app");