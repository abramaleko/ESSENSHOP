jQuery('<div class="quantity-nav"><div class="quantity-button quantity-up">+</div><div class="quantity-button quantity-down">-</div></div>').insertAfter('.quantity input');
jQuery('.quantity').each(function() {
  var spinner = jQuery(this),
    input = spinner.find('input[type="number"]'),
    btnUp = spinner.find('.quantity-up'),
    btnDown = spinner.find('.quantity-down'),
    min = input.attr('min'),
    max = input.attr('max');

  btnUp.click(function() {
    var oldValue = parseFloat(input.val());
    if (oldValue >= max) {
      var newVal = oldValue;
    } else {
      var newVal = oldValue + 1;
    }
    spinner.find("input").val(newVal);
    spinner.find("input").trigger("change");
  });

  btnDown.click(function() {
    var oldValue = parseFloat(input.val());
    if (oldValue <= min) {
      var newVal = oldValue;
    } else {
      var newVal = oldValue - 1;
    }
    spinner.find("input").val(newVal);
    spinner.find("input").trigger("change");
  });

});

function addToCart()
{
    let product_name=document.getElementById('product_name').textContent;
    let product_id=document.getElementById('product_id').textContent;
    let product_description=document.getElementById('description').textContent;
    let quantity=document.getElementById('quantityNo').value;
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }});
           $.ajax({
            type:'POST',
            url:'/addToCart',
            data:{product_name:product_name,product_id:product_id,product_description:product_description,quantity:quantity},
            success:function(data) {
             let dataResult = JSON.parse(data);
               if(dataResult.statusCode==200){
                //updates the cartbadge if data has been seen successfull
                $.ajax({
                    type:'GET',
                    url:'/cartbadge',
                    success:function(data)
                    {
                        document.getElementById("badge").textContent=data;
                        document.getElementById("cartbadge").style.animation="shake 0.7s";
                    }
                });
             }
               else{
                 let dataResult = JSON.parse(data);
                   alert(dataResult);
               }
    }});
}