
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
  if (this.selectedIndex === 1) {
    document.querySelector('#noDVD').style.display = 'flex';
  } else if (this.selectedIndex === 2) {
    document.querySelector('#noBook').style.display = 'flex';
  }else if (this.selectedIndex === 3) {
    document.querySelector('#noFurniture').style.display = 'block';
  }
  }, false);

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
                        if (data.code === "404"){
                             $("#error-valid").html("<p>"+data.msg+"</p>");
                             $("#error-valid").css("display","block");
                        }
                        else
                        {
                            location.href = "/index.php";
                        }
                    }

                });
              });
             return false;
  });
