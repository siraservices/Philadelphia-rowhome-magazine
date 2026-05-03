import React, { useState } from 'react';
import './Login.css'; // We will create a CSS file for styling

const Login = ({ onLogin }) => {
  const [username, setUsername] = useState('');
  const [password, setPassword] = useState('');
  const [error, setError] = useState('');

  const correctUsername = 'user';
  const correctPassword = 'password123';

  const handleSubmit = (event) => {
    event.preventDefault();

    if (username === correctUsername && password === correctPassword) {
      setError('');
      onLogin(true);
    } else {
      setError('Login failed! Incorrect username or password.');
    }
  };

  return (
    <div className="login-container">
      <h2>Resume Upload Tool</h2>
      <form onSubmit={handleSubmit}>
        <div className="input-group">
          <input
            type="text"
            placeholder="Username"
            value={username}
            onChange={(e) => setUsername(e.target.value)}
          />
        </div>
        <div className="input-group">
          <input
            type="password"
            placeholder="Password"
            value={password}
            onChange={(e) => setPassword(e.target.value)}
          />
        </div>
        <button type="submit" className="login-button">Login</button>
        <button type="button" className="forgot-button">Forgot Password</button>
      </form>
      {error && <p style={{ color: 'red' }}>{error}</p>}
    </div>
  );
};

export default Login;
