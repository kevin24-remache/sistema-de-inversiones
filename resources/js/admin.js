import React from 'react';
import ReactDOM from 'react-dom';
import AdminPanel from './components/AdminPanel';

if (document.getElementById('admin-panel')) {
    ReactDOM.render(<AdminPanel />, document.getElementById('admin-panel'));
}