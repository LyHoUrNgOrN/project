import { createApp } from "vue";
import { createRouter, createWebHistory } from "vue-router";
import App from "./App.vue";
import BottonWidget from "./components/button_widget/Button.vue";
import SignIn from "./components/sign_in/Sign_In.vue";
import SignUp from './components/signUp/SignUp.vue';
// import 'bootstrap/dist/css/bootstrap.min.css'

const app = createApp(App);
app.component("BottonWidget", BottonWidget);
app.component("sign-in", SignIn);
app.component('sign-up', SignUp);


const router = createRouter({
    history: createWebHistory(),
    routes: [
      
      { path: '/signIn', component: SignIn },
      { path: '/signUn', component: SignUp },
   
    ]
})
app.use(router);
const app = createApp(App);
app.mount('#app');
