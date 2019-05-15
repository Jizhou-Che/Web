window.onload = function(){
	document.getElementById("home").onclick = function(){
		window.location = "../../";
	}
	if(document.getElementById("notification") != null){
		setTimeout("document.getElementById('notification').parentNode.removeChild(document.getElementById('notification'))", 5000);
	}
	if(document.getElementById("floor") != null){
		filter_onchange();
		document.getElementById("floor").addEventListener("change", filter_onchange);
		document.getElementById("room").addEventListener("change", filter_onchange);
	}
	if(document.getElementById("back") != null){
		document.getElementById("back").onclick = function(){
			window.location = "../";
		}
	}
}

function filter_onchange(){
	var roomNo;
	if(Number(document.getElementById("room").value) < 10){
		roomNo = String(document.getElementById("floor").value) + "0" + String(document.getElementById("room").value);
	}else{
		roomNo = String(document.getElementById("floor").value) + String(document.getElementById("room").value);
	}
	var request = new XMLHttpRequest();
	request.onreadystatechange = function(){
		if(request.readyState == 4 && request.status == 200){
			if(request.responseText == "EMPTY SET"){
				var addedRows = document.getElementsByClassName("added");
				for(var i = 0; i < addedRows.length; i++){
					addedRows[i].parentNode.removeChild(addedRows[i]);
				}
				document.getElementById("table_caption").innerHTML = "There isn't any booking for room " + roomNo;
			}else{
				var bookings = JSON.parse(request.responseText);
				var addedRows = document.getElementsByClassName("added");
				for(var i = 0; i < addedRows.length; i++){
					addedRows[i].parentNode.removeChild(addedRows[i]);
				}
				document.getElementById("table_caption").innerHTML = "All Bookings for Room " + roomNo;
				for(var booking in bookings){
					var username = document.createElement("td");
					username.innerHTML = bookings[booking][0];
					var passport = document.createElement("td");
					passport.innerHTML = bookings[booking][1];
					var checkInDate = document.createElement("td");
					checkInDate.innerHTML = bookings[booking][3];
					var checkOutDate = document.createElement("td");
					checkOutDate.innerHTML = bookings[booking][4];
					var remove = document.createElement("button");
					remove.setAttribute("onclick", "remove_booking(" + roomNo + ", '" + bookings[booking][3] + "');");
					remove.innerHTML = "Remove";
					var operation = document.createElement("td");
					operation.appendChild(remove);
					var row = document.createElement("tr");
					row.setAttribute("class", "added");
					row.appendChild(username);
					row.appendChild(passport);
					row.appendChild(checkInDate);
					row.appendChild(checkOutDate);
					row.appendChild(operation);
					document.getElementById("table").appendChild(row);
				}
			}
		}
	}
	request.open("POST", "room_status.php", true);
	request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	request.send("roomNo=" + roomNo);
}

function remove_booking(roomNo, checkInDate){
	document.getElementById("roomNo").value = roomNo;
	document.getElementById("checkInDate").value = checkInDate;
	if(confirm("Are you sure you want to remove this booking information?")){
		document.getElementById("form").submit();
	}
}
