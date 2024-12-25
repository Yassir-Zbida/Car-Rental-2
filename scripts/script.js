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

// add new car hide and show modal 
const closeAddCar = document.querySelectorAll('.closeAddCar');
closeAddCar.forEach(button => {
   button.addEventListener('click', () => {
      addCarModal.classList.add('hidden');
   });
 });
 // add new car button 
 const addCarBtn = document.getElementById('addCarBtn');
 addCarBtn.addEventListener('click', () => {
   console.log('ffffff');
   addCarModal.classList.remove('hidden');
});

// add new contrat modal 
const addContratBtn = document.getElementById('addContratBtn');
const addContratModal = document.getElementById('addContratModal')
addContratBtn.addEventListener('click', () => {
  console.log('ffffff');
  addContratModal.classList.remove('hidden');
});

// close add new contrat modal
const closeAddContrat = document.querySelectorAll('.closeAddContrat');
closeAddContrat.forEach(button => {
   button.addEventListener('click', () => {
      addContratModal.classList.add('hidden');
   });
 });

// edit client modal 
const editClientBtn = document.getElementById('editClientBtn');
 
// chart js


    