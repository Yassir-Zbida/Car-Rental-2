// dashbord sidebzar hide and show function

const sidebarIcon = document.getElementById('sidebarIcon');
const sidebar = document.getElementById('sidebar');

sidebarIcon.addEventListener('click', () => {
   sidebar.classList.toggle('hidden');
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

 // print clients pdf 
 document.getElementById('printPdf').addEventListener('click', () => {
   window.print(); 
 });
