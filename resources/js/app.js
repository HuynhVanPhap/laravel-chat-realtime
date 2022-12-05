import './bootstrap';
import { createApp } from 'vue';
import ChatLayout from './components/ChatLayout.vue';

const app = createApp(ChatLayout);

app.mount('#app');
