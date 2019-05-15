window.onload = function(){
	document.getElementById("home").onclick = function(){
		window.location = "../../../";
	}
	if(document.getElementById("notification") != null){
		setTimeout("document.getElementById('notification').parentNode.removeChild(document.getElementById('notification'))", 5000);
	}
	if(document.getElementById("update") != null){
		document.getElementById("update").onclick = function(){
			if(check_form()){
				document.getElementById("form_update").submit();
			}
		}
	}
	if(document.getElementById("remove") != null){
		document.getElementById("remove").onclick = function(){
			if(confirm("Are you sure you want to remove this user?")){
				document.getElementById("form_remove").submit();
			}
		}
	}
	if(document.getElementById("back") != null){
		document.getElementById("back").onclick = function(){
			window.location = "../";
		}
	}
}

function check_form(){
	// Check if form filled completely.
	flag = true;
	var realname = document.getElementById("realname");
	if(realname.value == ""){
		realname.setAttribute("placeholder", "* Required");
		flag = false;
	}else if(realname.value.length > 64){
		realname.value = "";
		realname.setAttribute("placeholder", "* No more than 64 characters");
		flag = false;
	}else{
		realname.removeAttribute("placeholder");
	}
	var passport = document.getElementById("passport");
	if(passport.value == ""){
		passport.setAttribute("placeholder", "* Required");
		flag = false;
	}else if(passport.value.length > 32){
		passport.value = "";
		passport.setAttribute("placeholder", "* No more than 32 characters");
		flag = false;
	}else{
		passport.removeAttribute("placeholder");
	}
	var tel = document.getElementById("tel");
	if(tel.value == ""){
		tel.setAttribute("placeholder", "* Required");
		flag = false;
	}else if(tel.value.length > 32){
		tel.value = "";
		tel.setAttribute("placeholder", "* No more than 32 characters");
		flag = false;
	}else{
		tel.removeAttribute("placeholder");
	}
	var email = document.getElementById("email");
	if(email.value == ""){
		email.setAttribute("placeholder", "* Required");
		flag = false;
	}else if(email.value.length > 64){
		email.value = "";
		email.setAttribute("placeholder", "* No more than 64 characters");
		flag = false;
	}else{
		email.removeAttribute("placeholder");
	}
	return flag;
}
