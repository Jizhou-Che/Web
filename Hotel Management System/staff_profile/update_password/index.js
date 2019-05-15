window.onload = function(){
	document.getElementById("home").onclick = function(){
		window.location = "../../";
	}
	if(document.getElementById("notification") != null){
		setTimeout("document.getElementById('notification').parentNode.removeChild(document.getElementById('notification'))", 5000);
	}
	if(document.getElementById("update") != null){
		document.getElementById("update").onclick = function(){
			if(!check_form()){
				return;
			}
			document.getElementById("form").submit();
		}
		document.getElementById("form").addEventListener("keydown", function(e){
			if(e.keyCode === 13){
				if(!check_form()){
					return;
				}
				document.getElementById("form").submit();
			}
		});
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
	var password0 = document.getElementById("password0");
	if(password0.value == ""){
		password0.setAttribute("placeholder", "* Required");
		flag = false;
	}else if(password0.value.length > 64){
		password0.value = "";
		password0.setAttribute("placeholder", "* No more than 64 characters");
		flag = false;
	}else{
		password0.removeAttribute("placeholder");
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
