window.onload = function(){
	document.getElementById("home").onclick = function(){
		window.location = window.location;
	}
	if(document.getElementById("notification") != null){
		setTimeout("document.getElementById('notification').parentNode.removeChild(document.getElementById('notification'))", 5000);
	}
	if(document.getElementById("login") != null){
		document.getElementById("login").onclick = function(){
			window.location = "user_login";
		}
	}
	if(document.getElementById("signup") != null){
		document.getElementById("signup").onclick = function(){
			window.location = "user_signup";
		}
	}
	if(document.getElementById("my_bookings") != null){
		document.getElementById("my_bookings").onclick = function(){
			window.location = "my_bookings";
		}
	}
	if(document.getElementById("user_profile") != null){
		document.getElementById("user_profile").onclick = function(){
			window.location = "user_profile";
		}
	}
	if(document.getElementById("hotel_management") != null){
		document.getElementById("hotel_management").onclick = function(){
			window.location = "hotel_management";
		}
	}
	if(document.getElementById("staff_profile") != null){
		document.getElementById("staff_profile").onclick = function(){
			window.location = "staff_profile";
		}
	}
	if(document.getElementById("logoff") != null){
		document.getElementById("logoff").onclick = function(){
			if(confirm("Are you sure you want to log off?") == true){
				window.location = "logoff.php";
			}
		}
	}
}
