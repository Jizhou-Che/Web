window.onload = function(){
	document.getElementById("home").onclick = function(){
		window.location = "../";
	}
	if(document.getElementById("notification") != null){
		setTimeout("document.getElementById('notification').parentNode.removeChild(document.getElementById('notification'))", 5000);
	}
	if(document.getElementById("login") != null){
		document.getElementById("login").onclick = function(){
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
	if(document.getElementById("logoff") != null){
		document.getElementById("logoff").onclick = function(){
			if(confirm("Are you sure you want to log off?") == true){
				window.location = "../logoff.php";
			}
		}
	}
}

function check_form(){
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
	var password = document.getElementById("password");
	if(password.value == ""){
		password.setAttribute("placeholder", "* Required");
		flag = false;
	}else if(password.value.length > 64){
		password.value = "";
		password.setAttribute("placeholder", "* No more than 64 characters");
		flag = false;
	}else{
		password.removeAttribute("placeholder");
	}
	return flag;
}
