import { createRouter, createWebHistory } from "vue-router";

import SignIn from "./../components/pages/sign_in/Sign_In.vue";
import SignUp from './../components/pages/signUp/SignUp.vue';
import Event from './../components/pages/event/Event.vue'
import MyEvent from './../components/pages/myEvent/MyEvent.vue'
import EventDetail from './../components/pages/eventDetail/EventDetail.vue';
import CategoryView from './../components/pages/categories/category.vue';

const routes = [
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
  ];

const router = createRouter({
    history: createWebHistory(),
    routes
});

export default router;