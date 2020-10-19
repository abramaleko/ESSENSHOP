document.getElementById('tokenbutton').addEventListener('click',function()
{
    //function to generate token of ten characters
    let result= '';
    const characters= 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    const charactersLength = characters.length;
    for ( let i = 0; i < 10; i++ ) {
       result += characters.charAt(Math.floor(Math.random() * charactersLength));
    }
    document.getElementById('token').value=result;  //sets input the value of the token
});

function completeOrder(element)
{
if(document.getElementById('token').value == '') //if token not generated
{
  document.getElementById('messageAlert').style.display='block';
}
else
{
  let token=document.getElementById('token').value;
  let total=document.getElementById('total').value;
  let location=document.getElementById('location').value;

  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       }});
       $.ajax({
         type:'POST',
         url:'/addToOrder',
         data:{reference_token:token,total:total,location:location},
         success:function(data)
         {
           let dataResult=JSON.parse(data);
           if (dataResult.statusCode===200) {
            document.getElementById('messageAlert').style.display='none';
            element.style.display='none';
            document.getElementById('message').style.display='block'
           }
         }
       });
}
}


