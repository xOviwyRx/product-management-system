/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Other/javascript.js to edit this template
 */

window.onload = function(){
  
  var el = document.getElementById("productType");
  el.selectedIndex = 0;
 };

var el = document.getElementById("productType");
el.addEventListener("change", function() {
  var elems = document.querySelectorAll('#noDVD,#noBook,#noFurniture');
  for (var i = 0; i < elems.length; i++) {
    elems[i].style.display = 'none';
  }
  if (this.selectedIndex === 0) {
    document.querySelector('#noDVD').style.display = 'flex';
  } else if (this.selectedIndex === 1) {
    document.querySelector('#noBook').style.display = 'flex';
  }else if (this.selectedIndex === 2) {
    document.querySelector('#noFurniture').style.display = 'block';
  }
}, false); 

