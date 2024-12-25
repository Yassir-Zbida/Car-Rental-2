// dashbord sidebzar hide and show function

const sidebarIcon = document.getElementById('sidebarIcon');
const sidebar = document.getElementById('sidebar');

sidebarIcon.addEventListener('click', () => {
   sidebar.classList.toggle('hidden');
});

// add new client modal hide and show 
const closeAddClient = document.querySelectorAll('.closeAddClient');
const addClientModal = document.getElementById('addClient');

closeAddClient.forEach(button => {
  button.addEventListener('click', () => {
    addClientModal.classList.add('hidden');
  });
});

// add new client button 
const addClientBtn = document.getElementById('addClientBtn');
const addCarModal = document.getElementById('addCarModal');
addClientBtn.addEventListener('click', () => {
   addClientModal.classList.remove('hidden');
});

// edit client modal 
const editClientBtn = document.querySelectorAll('.editClientBtn');
const editClientModal = document.getElementById('editClientModal');

 editClientBtn.forEach(button => {
    button.addEventListener('click', () => {
      console.log('test');
      editClientModal.classList.remove('hidden');
    });
  });

// close edit modal 
const closeEditClient = document.querySelectorAll('.closeEditClient');
closeEditClient.forEach(button => {
    button.addEventListener('click', () => {
        editClientModal.classList.add('hidden');
    });
  });  
 
 // print clients pdf 
 document.getElementById('printPdf').addEventListener('click', () => {
  window.print(); 
});