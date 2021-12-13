import { createApp } from "vue";
import route from "./route/route.js"
import App from "./App.vue";

import MenuBar from './components/nav/Navigation.vue'
import DialogBox from './components/UI/DialogBox.vue'
import EventCard from './components/pages/EventCard.vue'
import BottonWidget from "./components/UI/Button.vue";
import CategoryCard from './components/pages/CategoryCards.vue'

const app = createApp(App);

app.component('menu-bar', MenuBar);
app.component('dialog-box', DialogBox);
app.component('event-card', EventCard);
app.component('botton-widget', BottonWidget);
app.component('category-cards', CategoryCard);


app.use(route);
app.mount('#app');
