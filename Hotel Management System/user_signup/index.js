window.onload = function(){
	document.getElementById("home").onclick = function(){
		window.location = "../";
	}
	if(document.getElementById("notification") != null){
		setTimeout("document.getElementById('notification').parentNode.removeChild(document.getElementById('notification'))", 5000);
	}
	if(document.getElementById("signup") != null){
		document.getElementById("signup").onclick = function(){
			if(check_form()){
				document.getElementById("form").submit();
			}
		}
		document.getElementById("form").addEventListener("keydown", function(e){
			if(e.keyCode === 13){
				if(check_form()){
					document.getElementById("form").submit();
				}
			}
		});
	}
	if(document.getElementById("back") != null){
		document.getElementById("back").onclick = function(){
			window.location = "../";
		}
	}
	if(document.getElementById("logoff") != null){
		document.getElementById("logoff").onclick = function(){
			if(confirm("Are you sure you want to log off?") == true){
				window.location = "../logoff.php";
			}
		}
	}
}

function check_form(){
	// Check if form filled completely.
	flag = true;
	var username = document.getElementById("username");
	if(username.value == ""){
		username.setAttribute("placeholder", "* Required");
		flag = false;
	}else if(username.value.length > 64){
		username.value = "";
		username.setAttribute("placeholder", "* No more than 64 characters");
		flag = false;
	}else{
		username.removeAttribute("placeholder");
	}
	var password1 = document.getElementById("password1");
	if(password1.value == ""){
		password1.setAttribute("placeholder", "* Required");
		flag = false;
	}else if(password1.value.length > 64){
		password1.value = "";
		password1.setAttribute("placeholder", "* No more than 64 characters");
		flag = false;
	}else{
		password1.removeAttribute("placeholder");
	}
	var password2 = document.getElementById("password2");
	if(password2.value == ""){
		password2.setAttribute("placeholder", "* Required");
		flag = false;
	}else if(password2.value.length > 64){
		password2.value = "";
		password2.setAttribute("placeholder", "* No more than 64 characters");
		flag = false;
	}else{
		password2.removeAttribute("placeholder");
	}
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
	if(flag == false){
		return false;
	}
	// Check if passwords match.
	if(password1.value != password2.value){
		password1.value = "";
		password2.value = "";
		password1.setAttribute("placeholder", "* Passwords do not match");
		return false;
	}else{
		password1.removeAttribute("placeholder");
	}
	return true;
}
