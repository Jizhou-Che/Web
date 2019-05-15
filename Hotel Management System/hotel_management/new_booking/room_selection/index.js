window.onload = function(){
	document.getElementById("home").onclick = function(){
		window.location = "../../../";
	}
	if(document.getElementById("notification") != null){
		setTimeout("document.getElementById('notification').parentNode.removeChild(document.getElementById('notification'))", 5000);
	}
	if(document.getElementById("floor") != null){
		floor_onchange();
		document.getElementById("floor").addEventListener("change", floor_onchange);
	}
	if(document.getElementById("book") != null){
		document.getElementById("book").onclick = function(){
			if(check_form()){
				if(document.getElementById("roomNo").value == ""){
					if(confirm("You have not selected any room to stay in. Are you sure you want to be assigned with a room automatically?")){
						document.getElementById("form").submit();
					}
				}else{
					document.getElementById("form").submit();
				}
			}
		}
	}
	if(document.getElementById("back") != null){
		document.getElementById("back").onclick = function(){
			window.location = "../";
		}
	}
}

function floor_onchange(){
	document.getElementById("roomNo").value = "";
	var type = document.getElementById("type").value;
	var floor = document.getElementById("floor").value;
	var checkInDate = document.getElementById("checkInDate").value;
	var checkOutDate = document.getElementById("checkOutDate").value;
	var cells = document.getElementsByTagName("td");
	for(var i = 0; i < cells.length; i++){
		if(i != 5 && i != 6 && i != 7 && i != 11 && i != 12){
			// Replace with a cloned cell to clear all event listeners.
			var cellClone = cells[i].cloneNode(true);
			cells[i].parentNode.replaceChild(cellClone, cells[i]);
			cells[i].style.backgroundColor = "grey";
			cells[i].style.cursor = "default";
		}
	}
	switch(type){
		case "LARGE DOUBLE":
			for(var i = 0; i < cells.length; i++){
				if(i == 0 || i == 1 || i == 13 || i == 14){
					cells[i].style.backgroundColor = "red";
				}
			}
			break;
		case "LARGE SINGLE":
			for(var i = 0; i < cells.length; i++){
				if(i == 2 || i == 3 || i == 15 || i == 16){
					cells[i].style.backgroundColor = "red";
				}
			}
			break;
		case "SMALL SINGLE":
			for(var i = 0; i < cells.length; i++){
				if(i == 4 || i == 9 || i == 10 || i == 17){
					cells[i].style.backgroundColor = "red";
				}
			}
			break;
		case "VIP":
			cells[8].style.backgroundColor = "red";
			break;
	}
	document.getElementById("X01").innerHTML = floor + "01";
	document.getElementById("X02").innerHTML = floor + "02";
	document.getElementById("X03").innerHTML = floor + "03";
	document.getElementById("X04").innerHTML = floor + "04";
	document.getElementById("X05").innerHTML = floor + "05";
	document.getElementById("X06").innerHTML = floor + "06";
	document.getElementById("X07").innerHTML = floor + "07";
	document.getElementById("X08").innerHTML = floor + "08";
	document.getElementById("X09").innerHTML = floor + "09";
	document.getElementById("X10").innerHTML = floor + "10";
	document.getElementById("X11").innerHTML = floor + "11";
	document.getElementById("X12").innerHTML = floor + "12";
	document.getElementById("X13").innerHTML = floor + "13";
	var request = new XMLHttpRequest();
	request.onreadystatechange = function(){
		if(request.readyState == 4 && request.status == 200){
			var availableRooms = JSON.parse(request.responseText);
			for(var room in availableRooms){
				var roomID = "X";
				if((availableRooms[room][0] % 100) < 10){
					roomID += "0" + availableRooms[room][0] % 100;
				}else{
					roomID += availableRooms[room][0] % 100;
				}
				for(var i = 0; i < cells.length; i++){
					if(cells[i].innerHTML.indexOf(roomID) != -1){
						cells[i].style.backgroundColor = "green";
						cells[i].style.cursor = "pointer";
						cells[i].addEventListener("click", set_room_selection);
					}
				}
			}
		}
	}
	request.open("POST", "floor_status.php", true);
	request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	request.send("type=" + type + "&floor=" + floor + "&checkInDate=" + checkInDate + "&checkOutDate=" + checkOutDate);
	function set_room_selection(event){
		if(event.currentTarget.style.backgroundColor == "green"){
			if(document.getElementById("roomNo").value != ""){
				for(var i = 0; i < cells.length; i++){
					if(cells[i].style.backgroundColor == "blue"){
						cells[i].style.backgroundColor = "green";
					}
				}
			}
			event.currentTarget.style.backgroundColor = "blue";
			document.getElementById("roomNo").value = floor + event.currentTarget.id;
		}else{
			event.currentTarget.style.backgroundColor = "green";
			document.getElementById("roomNo").value = "";
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
	return flag;
}

