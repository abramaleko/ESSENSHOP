$(document).ready(function(){
    $('#password').popover();
  });

document.getElementById('register').addEventListener('click',function(event)
{
event.preventDefault();
let pswd=document.getElementById('password').value;
let pswdLength=pswd.length;
if (pswdLength>=6) {
  verify();
    
} else {
  $("#password").popover("show");

}

});

function verify()
{
let pswd1=document.getElementById('password').value;
let pswd2=document.getElementById('confirmpassword').value;
if (pswd1!=pswd2) {
    $("#confirmpassword").popover("show");
    return false;
}
else{
document.getElementById('registerForm').submit();
}
}