import { useState } from 'react'
import reactLogo from './assets/react.svg'
import viteLogo from '/vite.svg'
import './App.css'
import axios from 'axios';

function App() {
  const [own, setOwn] = useState('');
  const [enemy, setOpponent] = useState('');
  const [result, setResult] = useState('');
  const [error, setError] = useState('');

  const handleSubmit = async () => {
    setResult('');
    setError('');
    try {
      const res = await axios.post('http://localhost:8000/api/battle-strategy', {
        own_platoon: own,
        opponent_platoon: enemy,
      });
      console.log(res.data.status);
      setResult(res.data.message);
    } catch (err) {
      console.error(err);
      setResult('Error calling API');
    }
  };

  return (
    <div className="App">
      <h2>Platoon Strategizer</h2>
      <textarea value={own} onChange={e => setOwn(e.target.value)} placeholder="Your input like Spearmen#10;Militia#30;..." rows="3" cols="50" />
      <br />
      <textarea value={enemy} onChange={e => setOpponent(e.target.value)} placeholder="Opponent input like Militia#10;Spearmen#10;..." rows="3" cols="50" />
      <br />
      <button onClick={handleSubmit}>Submit</button>
      {result && <div><strong><br />{result}</strong></div>}
      {error && <div style={{ color: 'red' }}>{error}</div>}
    </div>
  );
}

export default App
