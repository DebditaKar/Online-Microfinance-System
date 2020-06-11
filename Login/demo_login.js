function register(){
    var x= document.getElementById("login");
    var y= document.getElementById("register");
    var z= document.getElementById("btn");
	    x.style.left = "-400px";
	    y.style.left = "50px";
        z.style.left = "110px";
}
function login(){
    var x= document.getElementById("login");
    var y= document.getElementById("register");
    var z= document.getElementById("btn");
    var a=document.getElementById("full_button");
    var b=document.getElementById("choice");
	x.style.left = "50px";
	y.style.left = "450px";
    z.style.left = "0px";
    a.style.left = "5px";
    b.style.left = "-450px";
}
function create_account(){
    var x= document.getElementById("login");
    var y= document.getElementById("register");
    var z= document.getElementById("create_account");
    var a=document.getElementById("full_button");
    var b= document.getElementById("u_name");
    var c= document.getElementById("mail");
    var d= document.getElementById("pass");
    if(b.value!="" && c.value!="" && d.value!="")
    {
        x.style.left = "-400px";
	    y.style.left = "-4000px";
        z.style.left = "50px";
        a.style.left = "-400px";
    }
    else
    {
        x.style.left = "-400px";
	    y.style.left = "50px";
        z.style.left = "450px";
        alert("All the fields must be filled");
    }
}
function admin_login()
{
    var a=document.getElementById("admin_login");
    var b=document.getElementById("choice");
    b.style.left= "-450px";
    a.style.left= "50px";
}