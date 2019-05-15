window.onload = function(){
	document.getElementById("home").onclick = function(){
		window.location = "../";
	}
	if(document.getElementById("notification") != null){
		setTimeout("document.getElementById('notification').parentNode.removeChild(document.getElementById('notification'))", 5000);
	}
	if(document.getElementById("manage_staff") != null){
		document.getElementById("manage_staff").onclick = function(){
			window.location = "manage_staff";
		}
	}
	if(document.getElementById("manage_user") != null){
		document.getElementById("manage_user").onclick = function(){
			window.location = "manage_user";
		}
	}
	if(document.getElementById("view_by_time") != null){
		document.getElementById("view_by_time").onclick = function(){
			window.location = "view_by_time";
		}
	}
	if(document.getElementById("view_by_room") != null){
		document.getElementById("view_by_room").onclick = function(){
			window.location = "view_by_room";
		}
	}
	if(document.getElementById("view_by_user") != null){
		document.getElementById("view_by_user").onclick = function(){
			window.location = "view_by_user";
		}
	}
	if(document.getElementById("new_booking") != null){
		document.getElementById("new_booking").onclick = function(){
			window.location = "new_booking";
		}
	}
	if(document.getElementById("back") != null){
		document.getElementById("back").onclick = function(){
			window.location = "../";
		}
	}
}
