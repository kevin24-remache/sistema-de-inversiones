import React, { useState, useEffect } from 'react';

const AdminPanel = () => {
  // Estado para almacenar clientes y tasa de inversión
  const [clients, setClients] = useState([]);
  const [pendingClients, setPendingClients] = useState([]);
  const [investmentRate, setInvestmentRate] = useState(3.0);
  const [editingClient, setEditingClient] = useState(null);
  const [isEditing, setIsEditing] = useState(false);

  // Campos para editar cliente
  const [editName, setEditName] = useState('');
  const [editEmail, setEditEmail] = useState('');
  const [editInvestment, setEditInvestment] = useState('');

  // Simular carga de datos
  useEffect(() => {
    // En una aplicación real, estos datos vendrían de una API
    const mockClients = [
      { id: 1, name: 'Juan Pérez', email: 'juan@ejemplo.com', investment: 5000, status: 'approved' },
      { id: 2, name: 'María López', email: 'maria@ejemplo.com', investment: 7500, status: 'approved' },
      { id: 3, name: 'Carlos Rodríguez', email: 'carlos@ejemplo.com', investment: 10000, status: 'approved' },
    ];

    const mockPendingClients = [
      { id: 4, name: 'Ana Martínez', email: 'ana@ejemplo.com', investment: 3000, status: 'pending' },
      { id: 5, name: 'Roberto García', email: 'roberto@ejemplo.com', investment: 6000, status: 'pending' },
    ];

    setClients(mockClients);
    setPendingClients(mockPendingClients);
  }, []);

  // Función para aprobar un cliente
  const handleApproveClient = (client) => {
    client.status = 'approved';
    setClients([...clients, client]);
    setPendingClients(pendingClients.filter(c => c.id !== client.id));
  };

  // Función para rechazar un cliente
  const handleRejectClient = (clientId) => {
    setPendingClients(pendingClients.filter(client => client.id !== clientId));
  };

  // Función para eliminar un cliente
  const handleDeleteClient = (clientId) => {
    if (window.confirm('¿Estás seguro de que deseas eliminar este cliente?')) {
      setClients(clients.filter(client => client.id !== clientId));
    }
  };

  // Función para actualizar la tasa de inversión
  const handleInvestmentRateChange = (e) => {
    setInvestmentRate(parseFloat(e.target.value));
  };

  // Función para mostrar el formulario de edición
  const handleShowEditForm = (client) => {
    setEditingClient(client);
    setEditName(client.name);
    setEditEmail(client.email);
    setEditInvestment(client.investment);
    setIsEditing(true);
  };

  // Función para guardar los cambios en un cliente
  const handleSaveChanges = () => {
    const updatedClients = clients.map(client => {
      if (client.id === editingClient.id) {
        return {
          ...client,
          name: editName,
          email: editEmail,
          investment: parseFloat(editInvestment)
        };
      }
      return client;
    });

    setClients(updatedClients);
    setIsEditing(false);
    setEditingClient(null);
  };

  // Función para cancelar la edición
  const handleCancelEdit = () => {
    setIsEditing(false);
    setEditingClient(null);
  };

  return (
    <div className="admin-panel">
      <h1>Panel Administrativo</h1>

      {/* Sección de configuración */}
      <div className="config-section">
        <h2>Configuración General</h2>
        <div className="rate-config">
          <label htmlFor="investmentRate">Tasa de inversión mensual (%):</label>
          <input
            id="investmentRate"
            type="number"
            step="0.1"
            value={investmentRate}
            onChange={handleInvestmentRateChange}
          />
          <button onClick={() => alert(`Tasa de inversión actualizada al ${investmentRate}%`)}>
            Guardar Cambios
          </button>
        </div>
      </div>

      {/* Sección de clientes pendientes */}
      <div className="pending-clients-section">
        <h2>Clientes Pendientes de Aprobación</h2>
        {pendingClients.length === 0 ? (
          <p>No hay clientes pendientes de aprobación.</p>
        ) : (
          <table>
            <thead>
              <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th>Inversión Inicial</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              {pendingClients.map(client => (
                <tr key={client.id}>
                  <td>{client.name}</td>
                  <td>{client.email}</td>
                  <td>${client.investment.toLocaleString()}</td>
                  <td>
                    <button onClick={() => handleApproveClient(client)}>Aprobar</button>
                    <button onClick={() => handleRejectClient(client.id)}>Rechazar</button>
                  </td>
                </tr>
              ))}
            </tbody>
          </table>
        )}
      </div>

      {/* Sección de clientes aprobados */}
      <div className="approved-clients-section">
        <h2>Clientes Aprobados</h2>
        {clients.length === 0 ? (
          <p>No hay clientes aprobados.</p>
        ) : (
          <table>
            <thead>
              <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th>Inversión</th>
                <th>Rendimiento Mensual Est.</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              {clients.map(client => (
                <tr key={client.id}>
                  <td>{client.name}</td>
                  <td>{client.email}</td>
                  <td>${client.investment.toLocaleString()}</td>
                  <td>${(client.investment * investmentRate / 100).toLocaleString()}</td>
                  <td>
                    <button onClick={() => handleShowEditForm(client)}>Editar</button>
                    <button onClick={() => handleDeleteClient(client.id)}>Eliminar</button>
                  </td>
                </tr>
              ))}
            </tbody>
          </table>
        )}
      </div>

      {/* Modal de edición */}
      {isEditing && (
        <div className="edit-modal">
          <div className="modal-content">
            <h2>Editar Cliente</h2>
            <div className="form-group">
              <label>Nombre:</label>
              <input
                type="text"
                value={editName}
                onChange={e => setEditName(e.target.value)}
              />
            </div>
            <div className="form-group">
              <label>Email:</label>
              <input
                type="email"
                value={editEmail}
                onChange={e => setEditEmail(e.target.value)}
              />
            </div>
            <div className="form-group">
              <label>Inversión ($):</label>
              <input
                type="number"
                value={editInvestment}
                onChange={e => setEditInvestment(e.target.value)}
              />
            </div>
            <div className="modal-buttons">
              <button onClick={handleSaveChanges}>Guardar Cambios</button>
              <button onClick={handleCancelEdit}>Cancelar</button>
            </div>
          </div>
        </div>
      )}

      <style jsx>{`
        .admin-panel {
          font-family: Arial, sans-serif;
          padding: 20px;
          max-width: 1200px;
          margin: 0 auto;
        }

        h1 {
          color: #333;
          text-align: center;
        }

        h2 {
          color: #555;
          margin-top: 30px;
        }

        .config-section {
          background-color: #f8f9fa;
          padding: 20px;
          border-radius: 5px;
          margin-bottom: 30px;
        }

        .rate-config {
          display: flex;
          align-items: center;
          gap: 10px;
        }

        input[type="number"] {
          padding: 8px;
          width: 80px;
        }

        table {
          width: 100%;
          border-collapse: collapse;
          margin-top: 20px;
        }

        th, td {
          border: 1px solid #ddd;
          padding: 12px;
          text-align: left;
        }

        th {
          background-color: #f2f2f2;
        }

        button {
          background-color: #4CAF50;
          color: white;
          border: none;
          padding: 8px 12px;
          margin-right: 5px;
          cursor: pointer;
          border-radius: 4px;
        }

        button:hover {
          opacity: 0.8;
        }

        button:nth-child(2) {
          background-color: #f44336;
        }

        .edit-modal {
          position: fixed;
          top: 0;
          left: 0;
          width: 100%;
          height: 100%;
          background-color: rgba(0, 0, 0, 0.5);
          display: flex;
          align-items: center;
          justify-content: center;
        }

        .modal-content {
          background-color: white;
          padding: 30px;
          border-radius: 5px;
          width: 400px;
        }

        .form-group {
          margin-bottom: 15px;
        }

        .form-group label {
          display: block;
          margin-bottom: 5px;
        }

        .form-group input {
          width: 100%;
          padding: 8px;
          box-sizing: border-box;
        }

        .modal-buttons {
          display: flex;
          justify-content: flex-end;
          gap: 10px;
          margin-top: 20px;
        }
      `}</style>
    </div>
  );
};

export default AdminPanel;