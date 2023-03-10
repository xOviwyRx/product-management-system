window.onload = function() {
  var el = document.getElementById("productType");
  el.selectedIndex = 0;
};

var el = document.getElementById("productType");
el.addEventListener("change", function() {
  var elems = document.querySelectorAll('#noDVD,#noBook,#noFurniture');

  for (var i = 0; i < elems.length; i++) {
    elems[i].style.display = 'none';
  }

  if (this.selectedIndex === 1) {
    document.querySelector('#noDVD').style.display = 'flex';
  } else if (this.selectedIndex === 2) {
    document.querySelector('#noBook').style.display = 'flex';
  } else if (this.selectedIndex === 3) {
    document.querySelector('#noFurniture').style.display = 'block';
  }

}, false);

function matchPattern(pattern, string) {
  if (pattern === null) { return true; }
  regex = new RegExp(pattern);
  return regex.test(string);
}
  
function validatefilledIn() {
  var arr = document.getElementsByClassName('form-control');

  for (var i = 0; i < arr.length; i++) {

      if (arr[i].value.trim() === "" || !matchPattern(arr[i].getAttribute("pattern"),arr[i].value)) {
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
              var sku_input = $("#sku");
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