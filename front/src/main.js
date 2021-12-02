import { createApp } from "vue";
import { createRouter, createWebHistory } from "vue-router";
import App from "./App.vue";
// import 'bootstrap/dist/css/bootstrap.min.css'

import SignIn from "./components/sign_in/Sign_In.vue";
import SignUp from './components/signUp/SignUp.vue';

import MenuBar from './components/nav/Navigation.vue'
import Home from './components/nav/home/HomeView.vue'
import Event from './components/nav/event/Event.vue'
import MyEvent from './components/nav/myEvent/MyEvent.vue'
// import CreateEvent from './components/nav/myEvent/EventForm.vue'
// import 'bootstrap/dist/css/bootstrap.min.css'

import { library } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

const app = createApp(App);
app.component("sign-in", SignIn);
app.component('sign-up', SignUp);
app.component('menu-bar', MenuBar);
app.use(FontAwesomeIcon);
app.use(library);


const router = createRouter({
    history: createWebHistory(),
    routes: [
      { path: '/', component: SignIn },
      { path: '/signIn', component: SignIn },
      { path: '/signUp', component: SignUp },
      { path: '/home', component: Home },
      { path: '/event', component: Event },
      { path: '/myEvent', component: MyEvent },
      // { path: '/createEvent', component: CreateEvent },
      // { path: '/menu', component: MenuBar },
       //   { path: '/students/:studentId', component: StudentDetails, props: true },
      //   { path: '/:notFound(.*)', component: StudentNotFound },
   
    ]
})

app.use(router);
app.mount('#app');
