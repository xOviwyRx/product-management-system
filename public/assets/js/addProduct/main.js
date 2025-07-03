document.querySelector("#productType").addEventListener(
  "change",
  function () {
    const productSpecBlocks = document.querySelectorAll(".specific_product_block");

    //think about replacing modern by loop
    for (let i = 0; i < productSpecBlocks.length; i++){
      let visibleClass = (productSpecBlocks[i].id === 'furniture_block') ? 'd-block' : 'd-flex';

      if (i === this.selectedIndex - 1) {
        productSpecBlocks[i].classList.replace('d-none', visibleClass);
      } else {
        productSpecBlocks[i].classList.replace(visibleClass, 'd-none');
      }

    }
  },
);

function validate() {
  const inputs = document.querySelectorAll('.form-control');
  inputs.forEach(input => {
    if (inputValid(input))
    {
      input.classList.replace('border-danger', 'border-dark');
    } else {
      input.classList.replace('border-dark', 'border-danger');
    }
  })
}

function inputValid(input){
  const value = input.value;
  const pattern = input.getAttribute('pattern');
  return (value.trim() !== '' && matchPattern(value, pattern));
}

function matchPattern(value, pattern) {
  if (pattern === null) {
    return true;
  }
  return new RegExp(pattern).test(value);
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
          location.href = "/";
        }
      },
    });
  });
  return false;
});
