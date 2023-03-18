//use let or const instead of var variable declaration
// also use const for function expressions
window.onload = function() {
  //use modern approach (querySelector here)
  var el = document.getElementById("productType");
  el.selectedIndex = 0;
};

var el = document.getElementById("productType");
el.addEventListener("change", function() {
  var elems = document.querySelectorAll('#noDVD,#noBook,#noFurniture');

  //replace by more modern forEach loop
  
  for (var i = 0; i < elems.length; i++) {
    //use bootstrap d-none class instead
    elems[i].style.display = 'none';
  }

  if (this.selectedIndex === 1) {
    //use bootstrap d-flex class instead
    document.querySelector('#noDVD').style.display = 'flex';
  } else if (this.selectedIndex === 2) {
    //use bootstrap d-flex class instead
    document.querySelector('#noBook').style.display = 'flex';
  } else if (this.selectedIndex === 3) {
    // use bootstrap d-block class instead
    document.querySelector('#noFurniture').style.display = 'block';
  }

}, false);

function matchPattern(pattern, string) {
  if (pattern === null) { return true; }
  regex = new RegExp(pattern);
  return regex.test(string);
}
  
function validatefilledIn() {
  //use modern query selector approach
  var arr = document.getElementsByClassName('form-control');

  //replace by more modern loop
  for (var i = 0; i < arr.length; i++) {

      if (arr[i].value.trim() === "" || !matchPattern(arr[i].getAttribute("pattern"),arr[i].value)) {
        //think about toggle/replace methods here
          arr[i].classList.remove('border-dark');
          arr[i].classList.add('border-danger');
      } else {
          arr[i].classList.remove('border-danger');
          arr[i].classList.add('border-dark');
      }
  }
  
} 

$(document).ready(function() {
  $('#submit').click(function(e){
    e.preventDefault();
    var form = $("#product_form");
    $.ajax({
      type: "POST",
      dataType: "json",
      data: form.serialize(),
      url: form.attr('action'),
      success: function(data){
        if (data.code !== "200"){
          $("#error-valid").html("<p>"+data.msg+"</p>");
          $("#error-valid").css("display","block");
          
          if (data.code === 1) {
              //instead var use const or let
              var sku_input = $("#sku");
              //think about toggle/replace methods here
              sku_input.addClass('border-danger');
              sku_input.removeClass('border-dark');
          }

        } else {
            location.href = "/index.php";
        }
      }
    });
  });
  return false;
});