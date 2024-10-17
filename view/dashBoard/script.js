// Datos de ejemplo
let tickets = [
    { id: 1, description: "Problema con la red", status: "Abierto" },
    { id: 2, description: "Actualización de software", status: "En Progreso" },
    { id: 3, description: "Mantenimiento de servidores", status: "Cerrado" }
];

let engineers = [
    { id: 1, name: "Juan Pérez", specialty: "Redes" },
    { id: 2, name: "María García", specialty: "Software" },
    { id: 3, name: "Carlos Rodríguez", specialty: "Hardware" }
];

// Funciones para mostrar/ocultar secciones
function showSection(sectionId) {
    document.querySelectorAll('main > section').forEach(section => {
        section.classList.add('hidden');
    });
    document.getElementById(sectionId).classList.remove('hidden');
}

// Funciones para mostrar/ocultar modales
function showModal(modalId) {
    document.getElementById(modalId).classList.remove('hidden');
}

function closeModal(modalId) {
    document.getElementById(modalId).classList.add('hidden');
}

// Funciones para manejar tickets
function renderTickets() {
    const tbody = document.getElementById('ticketsTableBody');
    tbody.innerHTML = '';
    tickets.forEach(ticket => {
        const tr = document.createElement('tr');
        tr.innerHTML = `
            <td class="py-3 px-6">${ticket.id}</td>
            <td class="py-3 px-6">${ticket.description}</td>
            <td class="py-3 px-6">${ticket.status}</td>
            <td class="py-3 px-6">
                <button onclick="editTicket(${ticket.id})" class="bg-yellow-500 text-white px-2 py-1 rounded mr-2">Editar</button>
                <button onclick="deleteTicket(${ticket.id})" class="bg-red-500 text-white px-2 py-1 rounded">Eliminar</button>
            </td>
        `;
        tbody.appendChild(tr);
    });
}

function addTicket(description, status) {
    const newId = tickets.length > 0 ? Math.max(...tickets.map(t => t.id)) + 1 : 1;
    tickets.push({ id: newId, description, status });
    renderTickets();
}

function editTicket(id) {
    const ticket = tickets.find(t => t.id === id);
    if (ticket) {
        document.getElementById('ticketId').value = ticket.id;
        document.getElementById('ticketDescription').value = ticket.description;
        document.getElementById('ticketStatus').value = ticket.status;
        showModal('ticketModal');
    }
}

function updateTicket(id, description, status) {
    const index = tickets.findIndex(t => t.id === id);
    if (index !== -1) {
        tickets[index] = { ...tickets[index], description, status };
        renderTickets();
    }
}

function deleteTicket(id) {
    tickets = tickets.filter(t => t.id !== id);
    renderTickets();
}

// Funciones para manejar ingenieros
function renderEngineers() {
    const tbody = document.getElementById('engineersTableBody');
    tbody.innerHTML = '';
    engineers.forEach(engineer => {
        const tr = document.createElement('tr');
        tr.innerHTML = `
            <td class="py-3 px-6">${engineer.id}</td>
            <td class="py-3 px-6">${engineer.name}</td>
            <td class="py-3 px-6">${engineer.specialty}</td>
            <td class="py-3 px-6">
                <button onclick="editEngineer(${engineer.id})" class="bg-yellow-500 text-white px-2 py-1 rounded mr-2">Editar</button>
                <button onclick="deleteEngineer(${engineer.id})" class="bg-red-500 text-white px-2 py-1 rounded">Eliminar</button>
            </td>
        `;
        tbody.appendChild(tr);
    });
}

function addEngineer(name, specialty) {
    const newId = engineers.length > 0 ? Math.max(...engineers.map(e => e.id)) + 1 : 1;
    
    engineers.push({ id: newId, name, specialty });
    renderEngineers();
}

function editEngineer(id) {
    const engineer = engineers.find(e => e.id === id);
    if (engineer) {
        document.getElementById('engineerId').value = engineer.id;
        document.getElementById('engineerName').value = engineer.name;
        document.getElementById('engineerSpecialty').value = engineer.specialty;
        showModal('engineerModal');
    }
}

function updateEngineer(id, name, specialty) {
    const index = engineers.findIndex(e => e.id === id);
    if (index !== -1) {
        engineers[index] = { ...engineers[index], name, specialty };
        renderEngineers();
    }
}

function deleteEngineer(id) {
    engineers = engineers.filter(e => e.id !== id);
    renderEngineers();
}

// Event Listeners
document.getElementById('ticketForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const id = document.getElementById('ticketId').value;
    const description = document.getElementById('ticketDescription').value;
    const status = document.getElementById('ticketStatus').value;
    if (id) {
        updateTicket(parseInt(id), description, status);
    } else {
        addTicket(description, status);
    }
    closeModal('ticketModal');
    this.reset();
});

document.getElementById('engineerForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const id = document.getElementById('engineerId').value;
    const name = document.getElementById('engineerName').value;
    const specialty = document.getElementById('engineerSpecialty').value;
    if (id) {
        updateEngineer(parseInt(id), name, specialty);
    } else {
        addEngineer(name, specialty);
    }
    closeModal('engineerModal');
    this.reset();
});

// Inicialización
renderTickets();
renderEngineers();