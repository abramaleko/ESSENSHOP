$(document).ready(function(){
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }}); 
         pricing();
  });
  function pricing()
  {
    //function to calculate the total and subtotal price
    const elements=document.getElementsByClassName("price"); //gets a collection of prices
    let total=0;
    for(let i=0; i<elements.length; i++)
    {
      total+=parseInt(elements[i].textContent);
    }
  
    document.getElementById('subtotal').textContent=total+ " Tshs";
    document.getElementById('subtotal').style.fontWeight="bolder";
  }
  function updateprice(element,price,productName)
  {
     //function to calculate the price depending on the quantity
    let itemprice=parseInt(price);
    let quantity=parseInt(element.value);
    let newprice=itemprice * quantity ;
    firstel=element.parentNode; //get the td element
    priceNode=firstel.nextElementSibling;
    priceNode.textContent=newprice;
    updateQuantity(quantity,productName)
      //calls the update quantity function after the user changes the quantity
  }
  function updateQuantity(quantity,productName)
  {
    //this function sends the quantity selected by the user to the database
        $.ajax({
          type:'POST',
          url: '/updatequantity',
          data: {quantity:quantity,productName:productName},
          success:function()
          {
            pricing();
          }
        });
  }

//loads the confirm page 
document.getElementById('checkout').addEventListener('click',function(){
  let subtotal=document.getElementById('subtotal').textContent;
     $.ajax({
       type:'POST',
       url: '/confirm',
       data:{subtotal:subtotal},
       success:function(data)
       {
         $(".carttable").html(data);
       }
     });
 });
  