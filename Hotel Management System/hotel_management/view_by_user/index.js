window.onload = function(){
	document.getElementById("home").onclick = function(){
		window.location = "../../";
	}
	if(document.getElementById("notification") != null){
		setTimeout("document.getElementById('notification').parentNode.removeChild(document.getElementById('notification'))", 5000);
	}
	if(document.getElementById("check") != null){
		document.getElementById("check").onclick = function(){
			if(!check_form()){
				return;
			}
			var request = new XMLHttpRequest();
			request.onreadystatechange = function(){
				if(request.readyState == 4 && request.status == 200){
					if(request.responseText == "WRONG USERNAME"){
						document.getElementById("table_caption").innerHTML = "User does not exist!";
						var addedRows = document.getElementsByClassName("added");
						for(var i = 0; i < addedRows.length; i++){
							addedRows[i].parentNode.removeChild(addedRows[i]);
						}
					}else if(request.responseText == "EMPTY SET"){
						document.getElementById("table_caption").innerHTML = document.getElementById("username").value + " haven't got any booking.";
						var addedRows = document.getElementsByClassName("added");
						for(var i = 0; i < addedRows.length; i++){
							addedRows[i].parentNode.removeChild(addedRows[i]);
						}
					}else{
						var bookings = JSON.parse(request.responseText);
						document.getElementById("table_caption").innerHTML = "All bookings by " + document.getElementById("username").value;
						var addedRows = document.getElementsByClassName("added");
						for(var i = 0; i < addedRows.length; i++){
							addedRows[i].parentNode.removeChild(addedRows[i]);
						}
						for(var booking in bookings){
							var roomNo = document.createElement("td");
							roomNo.innerHTML = bookings[booking][2];
							var passport = document.createElement("td");
							passport.innerHTML = bookings[booking][1];
							var checkInDate = document.createElement("td");
							checkInDate.innerHTML = bookings[booking][3];
							var checkOutDate = document.createElement("td");
							checkOutDate.innerHTML = bookings[booking][4];
							var remove = document.createElement("button");
							remove.setAttribute("onclick", "remove_booking(" + bookings[booking][2] + ", '" + bookings[booking][3] + "');");
							remove.innerHTML = "Remove";
							var operation = document.createElement("td");
							operation.appendChild(remove);
							var row = document.createElement("tr");
							row.setAttribute("class", "added");
							row.appendChild(roomNo);
							row.appendChild(passport);
							row.appendChild(checkInDate);
							row.appendChild(checkOutDate);
							row.appendChild(operation);
							document.getElementById("table").appendChild(row);
						}
					}
				}
			}
			request.open("POST", "user_status.php", true);
			request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			request.send("username=" + document.getElementById("username").value);
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
	return flag;
}

function remove_booking(roomNo, checkInDate){
	document.getElementById("roomNo").value = roomNo;
	document.getElementById("checkInDate").value = checkInDate;
	if(confirm("Are you sure you want to remove this booking information?")){
		document.getElementById("form").submit();
	}
}
