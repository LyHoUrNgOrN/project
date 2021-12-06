import { createApp } from 'vue'
import App from './App.vue'
import EventCard from './components/UI/EventCard.vue'
import EventView from './components/UI/EventView.vue'

const app = createApp(App);
app.component('event-card', EventCard)
app.component('event-view', EventView)

app.mount('#app')
