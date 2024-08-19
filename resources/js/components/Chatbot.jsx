import React, { useState } from 'react';
import axios from 'axios';
import './Chatbot.css'; // Assuming you have some CSS for styling

const Chatbot = () => {
  const [messages, setMessages] = useState([]);
  const [input, setInput] = useState('');

  const handleSendMessage = async () => {
    if (input.trim()) {
      const userMessage = { sender: 'user', text: input };
      setMessages((prevMessages) => [...prevMessages, userMessage]);

      try {
        const response = await axios.post('/chatbot/getresponse', { message: input });
        const botMessage = { sender: 'bot', text: response.data.choices[0].message.content || 'No response' };
        setMessages((prevMessages) => [...prevMessages, botMessage]);
      } catch (error) {
        console.error('Error sending message:', error);
      }

      setInput('');
    }
  };

  return (
    <div className="chatbot">
      <div className="chat-window">
        {messages.map((message, index) => (
          <div key={index} className={`message ${message.sender}`}>
            <div className="text">{message.text}</div>
          </div>
        ))}
      </div>
      <div className="input-area">
        <input
          type="text"
          value={input}
          onChange={(e) => setInput(e.target.value)}
          placeholder="Type a message..."
        />
        <button onClick={handleSendMessage}>Send</button>
      </div>
    </div>
  );
};

export default Chatbot;
