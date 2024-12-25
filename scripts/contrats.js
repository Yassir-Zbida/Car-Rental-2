// dashbord sidebzar hide and show function

const sidebarIcon = document.getElementById('sidebarIcon');
const sidebar = document.getElementById('sidebar');

sidebarIcon.addEventListener('click', () => {
   sidebar.classList.toggle('hidden');
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

 // edit btn modal 
 const editContractBtns = document.querySelectorAll('.editContractBtn');
 const editContratModal = document.getElementById('editContratModal');
 editContractBtns.forEach(button => {
    button.addEventListener('click', () => {
       editContratModal.classList.remove('hidden');
    });
 });

 // close edit modal 
 const closeEditContrat = document.querySelectorAll('.closeEditContrat');
 closeEditContrat.forEach(button => {
   button.addEventListener('click', () => {
      editContratModal.classList.add('hidden');
   });
 });

 function openEditModal(id,startDate,endDate,Total,ClientId,CarId){
   editContratModal.classList.remove('hidden');
   document.getElementById('carIdEdit').value = CarId ;
   document.getElementById('totalEdit').value = Total;
   document.getElementById('endDateEdit').value = endDate;
   document.getElementById('startDateEdit').value = startDate ; 
   document.getElementById('clientIdEdit').value = ClientId;  
   const contractEdit = document.getElementById('ContractEdit');
   contractEdit.value = id ;
 }

  // print clients pdf 
  document.getElementById('printPdf').addEventListener('click', () => {
   window.print(); 
 });

