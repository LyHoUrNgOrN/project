import { createApp } from "vue";
import { createRouter, createWebHistory } from "vue-router";
import App from "./App.vue";
import SignIn from "./components/pages/sign_in/Sign_In.vue";
import SignUp from './components/pages/signUp/SignUp.vue';
import MenuBar from './components/nav/Navigation.vue'
import Event from './components/pages/event/Event.vue'
import MyEvent from './components/pages/myEvent/MyEvent.vue'
import DialogBox from './components/UI/DialogBox.vue'
import EventCard from './components/pages/EventCard.vue'
import EventHeader from './components/nav/EventHeader.vue'
import BottonWidget from "./components/UI/Button.vue";
import CategoryCards from './components/pages/CategoryCards.vue';
import CategoryView from './components/pages/categories/category.vue';
import EventForm from './components/pages/EventForm.vue';
// import BaseDialog from './components/UI/EventBaseDialog.vue';
// import EventCard from './components/nav/EventCard.vue'
// import CreateEvent from './components/nav/myEvent/EventForm.vue'
// import 'bootstrap/dist/css/bootstrap.min.css'
import EventDetail from './components/pages/eventDetail/EventDetail.vue';

const app = createApp(App);
app.component("sign-in", SignIn);
app.component('sign-up', SignUp);
app.component('menu-bar', MenuBar);
app.component('dialog-box', DialogBox);
app.component('event-card', EventCard);
app.component('event-header', EventHeader);
app.component('botton-widget', BottonWidget);
app.component('category-cards', CategoryCards);
app.component('event-form', EventForm);
app.component('event-detail', EventDetail);



const router = createRouter({
    history: createWebHistory(),
    routes: [
      { path: '/',
        component: SignIn 
      },
      { path: '/signIn', 
        component: SignIn 
      },
      { path: '/signUp', 
        component: SignUp 
      },
      { path: '/category', 
        component: CategoryView 
      },
      { path: '/myEvent',
        component: MyEvent,
        props: true
      },
      { path: '/event', 
        component: Event 
      },
      { path: '/event/:eventTitle', 
        component: EventDetail,
        props: true
      },
      { path: '/myEvent/:eventTitle', 
        component: EventDetail ,
        props: true
      },
    ]
})
app.use(router);
app.mount('#app');
