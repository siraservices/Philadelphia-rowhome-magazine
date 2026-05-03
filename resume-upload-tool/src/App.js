import React, { useState } from 'react';
import Login from './Login';
import FileUpload from './FileUpload';
import './App.css';

const App = () => {
  const [isLoggedIn, setIsLoggedIn] = useState(false);

  const handleLogin = (status) => {
    setIsLoggedIn(status);
  };

  return (
    <div className="app-container">
      {isLoggedIn ? (
        <FileUpload />
      ) : (
        <Login onLogin={handleLogin} />
      )}
    </div>
  );
};

export default App;
