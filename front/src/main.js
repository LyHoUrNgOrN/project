import { createApp } from 'vue'
import App from './App.vue'
import EventCard from './components/UI/EventCard.vue'
import EventView from './components/UI/EventView.vue'

import BaseButton from './components/UI/BaseButton.vue';
import BaseDialog from './components/UI/BaseDialog.vue';

const app = createApp(App);

app.component('base-button', BaseButton);
app.component('base-dialog', BaseDialog);

app.component('event-card', EventCard)
app.component('event-view', EventView)

app.mount('#app')
