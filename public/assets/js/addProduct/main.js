//use let or const instead of var variable declaration
// also use const for function expressions

document.querySelector("#productType").addEventListener(
  "change",
  function () {
    const productsBlocks = document.querySelectorAll("#dvd, #book, #furniture");

    //think about replacing modern by loop
    for (let i = 0; i < productsBlocks.length; i++){
      let visibleClass = (i === 2) ? 'd-block' : 'd-flex';

      if (i === this.selectedIndex - 1) {
        productsBlocks[i].classList.replace('d-none', visibleClass);
      } else {
        productsBlocks[i].classList.replace(visibleClass, 'd-none');
      }

    }
  },
);

function matchPattern(pattern, string) {
  if (pattern === null) {
    return true;
  }
  regex = new RegExp(pattern);
  return regex.test(string);
}

function validate() {
  //use modern query selector approach
  var arr = document.getElementsByClassName("form-control");

  //replace by more modern loop
  for (var i = 0; i < arr.length; i++) {
    if (
      arr[i].value.trim() === "" ||
      !matchPattern(arr[i].getAttribute("pattern"), arr[i].value)
    ) {
      //think about toggle/replace methods here
      arr[i].classList.remove("border-dark");
      arr[i].classList.add("border-danger");
    } else {
      arr[i].classList.remove("border-danger");
      arr[i].classList.add("border-dark");
    }
  }
}

$(document).ready(function () {
  $("#submit").click(function (e) {
    e.preventDefault();
    const form = $("#product_form");
    $.ajax({
      type: "POST",
      dataType: "json",
      data: form.serialize(),
      url: form.attr("action"),
      success: function (data) {
        if (data.code !== "200") {
          $("#error-valid").html(data.msg);
          $("#error-valid").removeClass("d-none");

          if (data.code === 1) {
            $("#sku").removeClass("border-dark").addClass("border-danger");
          }
        } else {
          location.href = "/public/index.php";
        }
      },
    });
  });
  return false;
});
