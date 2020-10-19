window.onload=function()
{
let no=document.getElementsByClassName('number');
for (let i = 0; i < no.length; i++) {
    no[i].innerHTML=i+1;
}
};
function sort()
{
    let tag=document.getElementById('tag').value;
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }});
           $.ajax({
               type:'POST',
               url:'/admin/orders/sort',
               data:{tag:tag},
               success:function(data)
               {
                   $(".orders-table").html(data);
                   
               }

           });
}