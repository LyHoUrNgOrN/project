import { createApp } from 'vue'
import App from './App.vue'
import { createRouter, createWebHistory } from 'vue-router';
import MenuBar from './components/nav/Navigation.vue'
import Home from './components/nav/home/HomeView.vue'
import Event from './components/nav/event/Event.vue'
import MyEvent from './components/nav/myEvent/MyEvent.vue'
import CreateEvent from './components/nav/myEvent/EventForm.vue'

const router = createRouter({
    history: createWebHistory(),
    routes: [
      { path: '/home', component: Home },
      { path: '/event', component: Event },
      { path: '/myEvent', component: MyEvent },
      { path: '/createEvent', component: CreateEvent },
    //   { path: '/students/:studentId', component: StudentDetails, props: true },
    //   { path: '/:notFound(.*)', component: StudentNotFound },
    ],
  });

const app = createApp(App)
app.component('menu-bar', MenuBar);

app.use(router);
app.mount('#app')
