import { createApp } from "vue";
import { createRouter, createWebHistory } from "vue-router";
import App from "./App.vue";
import BottonWidget from "./components/button_widget/Button.vue";
import signIn from "./components/signin/Sign-In.vue";
import signUp from "./components/signUp/signUp.vue";

const app = createApp(App);
app.component("BottonWidget", BottonWidget);
app.component("signIn", signIn);
app.component("signUp", signUp);


const router = createRouter({
    history: createWebHistory(),
    routes: [
      { path: '/', component: signIn },
      { path: '/signIn', component: signIn },
      { path: '/signUp', component: signUp },
    ]
})
app.use(router);
app.mount("#app");