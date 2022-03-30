/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Other/javascript.js to edit this template
 */

var el = document.getElementById("productType");
el.addEventListener("change", function() {
  var elems = document.querySelectorAll('#noDVD,#noBook,#noFurniture');
  for (var i = 0; i < elems.length; i++) {
    elems[i].style.display = 'none';
  }
  if (this.selectedIndex === 0) {
    document.querySelector('#noDVD').style.display = 'flex';
//    document.querySelector('#size').required = true;
//    document.querySelector('#length').required = false;
//    document.querySelector('#height').required = false;
//    document.querySelector('#weight').required = false;
//    document.querySelector('#width').required = false;
  } else if (this.selectedIndex === 1) {
    document.querySelector('#noBook').style.display = 'flex';
//    document.querySelector('#weight').required = true;
//    document.querySelector('#length').required = false;
//    document.querySelector('#height').required = false;
//    document.querySelector('#width').required = false;
//    document.querySelector('#size').required = false;
  }else if (this.selectedIndex === 2) {
    document.querySelector('#noFurniture').style.display = 'block';
//    document.querySelector('#width').required = true;
//    document.querySelector('#length').required = true;
//    document.querySelector('#height').required = true;
//    document.querySelector('#size').required = false;
//    document.querySelector('#weight').required = false;
  }
}, false); 

//var ob = document.getElementById("sku");
//ob.oninvalid = function(){
//    if (!this.value)
//        this.setCustomValidity('Please, submit requied data');
//    else
//        this.setCustomValidity('Please, provide the data of indicated type');
//        
//};
//const div = document.querySelector('#product_div');
//div.onclick = (e) => {
//    
//  const input = e.target.querySelector('input');
//  input.checked = !input.checked;
//};
