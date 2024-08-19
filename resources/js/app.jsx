import './bootstrap';
import React from 'react';
import ReactDOM from 'react-dom';
import Chatbot from './components/Chatbot';

if (document.getElementById('chatbot')) {
    ReactDOM.render(<Chatbot />, document.getElementById('chatbot'));
}
