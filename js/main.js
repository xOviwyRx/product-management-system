$("#delete-product-btn").click(function(event){
     if ($("#list_form input:checkbox:checked").length === 0) {
        event.preventDefault();
     }
});


