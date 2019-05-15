window.onload = function(){
	document.getElementById("home").onclick = function(){
		window.location = "../../";
	}
	if(document.getElementById("notification") != null){
		setTimeout("document.getElementById('notification').parentNode.removeChild(document.getElementById('notification'))", 5000);
	}
	if(document.getElementById("add_user") != null){
		document.getElementById("add_user").onclick = function(){
			window.location = "add_user";
		}
	}
	if(document.getElementById("back") != null){
		document.getElementById("back").onclick = function(){
			window.location = "../";
		}
	}
}

function update_user(userName){
	document.getElementById("userName").value = userName;
	document.getElementById("form").submit();
}
