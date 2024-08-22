import React, { useState, useEffect, useRef } from 'react';
import axios from 'axios';
import './Chatbot.css';
import { AiOutlinePaperClip } from 'react-icons/ai';

const Chatbot = () => {
  const [messages, setMessages] = useState([]);
  const [input, setInput] = useState('');
  const [file, setFile] = useState(null);
  const chatWindowRef = useRef(null);

  useEffect(() => {
    setMessages([{ sender: 'bot', text: 'Hi, I am your PhilJobNet AI assistant. Happy to assist you!' }]);
  }, []);

  const handleSendMessage = async () => {
    if (input.trim()) {
      const userMessage = { sender: 'user', text: input };
      setMessages((prevMessages) => [...prevMessages, userMessage]);

      try {
        const response = await axios.post('/api/chatbot', { message: input });
        const botMessage = { sender: 'bot', text: response.data.text || 'No response' };
        setMessages((prevMessages) => [...prevMessages, botMessage]);
      } catch (error) {
        console.error('Error sending message:', error);
      }

      setInput('');
    }
  };

  const handleFileUpload = async (event) => {
    const uploadedFile = event.target.files[0];
    if (uploadedFile) {
      setFile(uploadedFile);
      setMessages((prevMessages) => [
        ...prevMessages,
        { sender: 'user', text: `Uploaded file: ${uploadedFile.name}` },
      ]);

      const formData = new FormData();
      formData.append('file', uploadedFile);

      try {
        const response = await axios.post('/api/chatbot/upload', formData, {
          headers: {
            'Content-Type': 'multipart/form-data',
          },
        });

        const botMessage = { sender: 'bot', text: response.data.text || 'No response' };
        setMessages((prevMessages) => [...prevMessages, botMessage]);
      } catch (error) {
        console.error('Error uploading file:', error);
      }
    }
  };

  useEffect(() => {
    chatWindowRef.current.scrollTop = chatWindowRef.current.scrollHeight;
  }, [messages]);

  return (
    <div className="chatbot">
      <div className="chat-window" ref={chatWindowRef}>
        {messages.map((message, index) => (
          <div key={index} className={`message ${message.sender}`}>
            <div className="avatar">
              <img src={message.sender === 'bot' ? '/images/bot-avatar.jpg' : '/images/user-avatar.png'} alt="Avatar" />
            </div>
            <div className="text">{message.text}</div>
          </div>
        ))}
      </div>
      <div className="input-area">
        <input
          type="file"
          id="file-upload"
          style={{ display: 'none' }}
          onChange={handleFileUpload}
        />
        <label htmlFor="file-upload" className="clip-icon">
          <AiOutlinePaperClip />
        </label>
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
