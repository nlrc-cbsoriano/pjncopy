import React from 'react';
import ReactDOM from 'react-dom';
import Chatbot from './components/Chatbot';

// resources/js/app.js
import './bootstrap';
import '../css/app.css';

// Example for Vue
import { createApp } from 'vue';
import ExampleComponent from './components/ExampleComponent.vue';

if (document.getElementById('chatbot')) {
    ReactDOM.render(<Chatbot />, document.getElementById('chatbot'));
}
const app = createApp({});
app.component('example-component', ExampleComponent);
app.mount('#app');

// Example for React
// import React from 'react';
// import ReactDOM from 'react-dom/client';
// import ExampleComponent from './components/ExampleComponent.jsx';

// ReactDOM.createRoot(document.getElementById('app')).render(
//   <React.StrictMode>
//     <ExampleComponent />
//   </React.StrictMode>
// );
