function sort()
{
    let tag=document.getElementById('tag').value;
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }});
           $.ajax({
               type:'POST',
               url:'/admin/showProductDetails/sort',
               data:{tag:tag},
               success:function(data)
               {
                   $(".products-table").html(data);
               }

           });
}