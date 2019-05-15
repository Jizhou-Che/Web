window.onload = function(){
	document.getElementById("home").onclick = function(){
		window.location = "../";
	}
	if(document.getElementById("notification") != null){
		setTimeout("document.getElementById('notification').parentNode.removeChild(document.getElementById('notification'))", 5000);
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

function cancel_booking(roomNo, checkInDate){
	if(confirm("Are you sure you want to cancel this appointment for room " + roomNo + " at " + checkInDate + "?")){
		document.getElementById("roomNo").value = roomNo;
		document.getElementById("checkInDate").value = checkInDate;
		document.getElementById("form").submit();
	}
}
