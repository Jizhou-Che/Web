window.onload = function(){
	document.getElementById("home").onclick = function(){
		window.location = "../../";
	}
	if(document.getElementById("notification") != null){
		setTimeout("document.getElementById('notification').parentNode.removeChild(document.getElementById('notification'))", 5000);
	}
	if(document.getElementById("add_staff") != null){
		document.getElementById("add_staff").onclick = function(){
			window.location = "add_staff";
		}
	}
	if(document.getElementById("back") != null){
		document.getElementById("back").onclick = function(){
			window.location = "../";
		}
	}
}

function update_staff(staffName){
	document.getElementById("staffName").value = staffName;
	document.getElementById("form").submit();
}
