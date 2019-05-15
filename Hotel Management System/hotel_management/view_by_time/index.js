window.onload = function(){
	document.getElementById("home").onclick = function(){
		window.location = "../../";
	}
	if(document.getElementById("notification") != null){
		setTimeout("document.getElementById('notification').parentNode.removeChild(document.getElementById('notification'))", 5000);
	}
	if(document.getElementById("form") != null){
		// Define possible check-in dates.
		var minCheckInDate = new Date(document.getElementById("currentDate").value);
		minCheckInDate.setDate(minCheckInDate.getDate() + 1);
		var maxCheckInDate = new Date(document.getElementById("currentDate").value);
		maxCheckInDate.setDate(maxCheckInDate.getDate() + 181);
		// Get select elements and set onchange events.
		var checkInDate_Y_select = document.getElementById("checkInDate_Y");
		checkInDate_Y_select.addEventListener("change", checkInDate_Y_onchange);
		var checkInDate_m_select = document.getElementById("checkInDate_m");
		checkInDate_m_select.addEventListener("change", checkInDate_m_onchange);
		var checkInDate_d_select = document.getElementById("checkInDate_d");
		checkInDate_d_select.addEventListener("change", checkInDate_d_onchange);
		var checkOutDate_Y_select = document.getElementById("checkOutDate_Y");
		checkOutDate_Y_select.addEventListener("change", checkOutDate_Y_onchange);
		var checkOutDate_m_select = document.getElementById("checkOutDate_m");
		checkOutDate_m_select.addEventListener("change", checkOutDate_m_onchange);
		var checkOutDate_d_select = document.getElementById("checkOutDate_d");
		checkOutDate_d_select.addEventListener("change", filter_onchange);
		// Add options for checkInDate_Y.
		// This starts the chained option adding for other select elements.
		set_options_Y(minCheckInDate, maxCheckInDate, checkInDate_Y_select);
		// Define onchange events.
		function checkInDate_Y_onchange(){
			if(checkInDate_Y_select.value == minCheckInDate.getFullYear()){
				// This year.
				var newMaxCheckInDate = new Date(String(Number(checkInDate_Y_select.value) + 1));
				newMaxCheckInDate.setDate(newMaxCheckInDate.getDate() - 1);
				set_options_m(minCheckInDate, newMaxCheckInDate, checkInDate_m_select);
			}else{
				// Next year.
				var newMinCheckInDate = new Date(checkInDate_Y_select.value);
				set_options_m(newMinCheckInDate, maxCheckInDate, checkInDate_m_select);
			}
			checkInDate_m_onchange();
		}
		function checkInDate_m_onchange(){
			if(Number(month2indexstr(checkInDate_m_select.value)) == minCheckInDate.getMonth() + 1){
				// First month.
				var newMaxCheckInDate = new Date(checkInDate_Y_select.value + "-" + month2indexstr(checkInDate_m_select.value));
				newMaxCheckInDate.setMonth(newMaxCheckInDate.getMonth() + 1);
				newMaxCheckInDate.setDate(newMaxCheckInDate.getDate() - 1);
				set_options_d(minCheckInDate, newMaxCheckInDate, checkInDate_d_select);
			}else if(Number(month2indexstr(checkInDate_m_select.value)) == maxCheckInDate.getMonth() + 1){
				// Last month.
				var newMinCheckInDate = new Date(checkInDate_Y_select.value + "-" + month2indexstr(checkInDate_m_select.value));
				set_options_d(newMinCheckInDate, maxCheckInDate, checkInDate_d_select);
			}else{
				// Another month.
				var newMinCheckInDate = new Date(checkInDate_Y_select.value + "-" + month2indexstr(checkInDate_m_select.value));
				var newMaxCheckInDate = new Date(checkInDate_Y_select.value + "-" + month2indexstr(checkInDate_m_select.value));
				newMaxCheckInDate.setMonth(newMaxCheckInDate.getMonth() + 1);
				newMaxCheckInDate.setDate(newMaxCheckInDate.getDate() - 1);
				set_options_d(newMinCheckInDate, newMaxCheckInDate, checkInDate_d_select);
			}
			checkInDate_d_onchange();
		}
		function checkInDate_d_onchange(){
			var minCheckOutDate = new Date(checkInDate_Y_select.value + "-" + month2indexstr(checkInDate_m_select.value) + "-" + checkInDate_d_select.value);
			minCheckOutDate.setDate(minCheckOutDate.getDate() + 1);
			var maxCheckOutDate = new Date(checkInDate_Y_select.value + "-" + month2indexstr(checkInDate_m_select.value) + "-" + checkInDate_d_select.value);
			maxCheckOutDate.setDate(maxCheckOutDate.getDate() + 180);
			set_options_Y(minCheckOutDate, maxCheckOutDate, checkOutDate_Y_select);
			checkOutDate_Y_onchange();
		}
		function checkOutDate_Y_onchange(){
			var minCheckOutDate = new Date(checkInDate_Y_select.value + "-" + month2indexstr(checkInDate_m_select.value) + "-" + checkInDate_d_select.value);
			minCheckOutDate.setDate(minCheckOutDate.getDate() + 1);
			var maxCheckOutDate = new Date(checkInDate_Y_select.value + "-" + month2indexstr(checkInDate_m_select.value) + "-" + checkInDate_d_select.value);
			maxCheckOutDate.setDate(maxCheckOutDate.getDate() + 180);
			if(checkOutDate_Y_select.value == minCheckOutDate.getFullYear()){
				// This year.
				var newMaxCheckOutDate = new Date(String(Number(checkOutDate_Y_select.value) + 1));
				newMaxCheckOutDate.setDate(newMaxCheckOutDate.getDate() - 1);
				set_options_m(minCheckOutDate, newMaxCheckOutDate, checkOutDate_m_select);
			}else{
				// Next year.
				var newMinCheckOutDate = new Date(checkOutDate_Y_select.value);
				set_options_m(newMinCheckOutDate, maxCheckOutDate, checkOutDate_m_select);
			}
			checkOutDate_m_onchange();
		}
		function checkOutDate_m_onchange(){
			var minCheckOutDate = new Date(checkInDate_Y_select.value + "-" + month2indexstr(checkInDate_m_select.value) + "-" + checkInDate_d_select.value);
			minCheckOutDate.setDate(minCheckOutDate.getDate() + 1);
			var maxCheckOutDate = new Date(checkInDate_Y_select.value + "-" + month2indexstr(checkInDate_m_select.value) + "-" + checkInDate_d_select.value);
			maxCheckOutDate.setDate(maxCheckOutDate.getDate() + 180);
			if(Number(month2indexstr(checkOutDate_m_select.value)) == minCheckOutDate.getMonth() + 1){
				// First month.
				var newMaxCheckOutDate = new Date(checkOutDate_Y_select.value + "-" + month2indexstr(checkOutDate_m_select.value));
				newMaxCheckOutDate.setMonth(newMaxCheckOutDate.getMonth() + 1);
				newMaxCheckOutDate.setDate(newMaxCheckOutDate.getDate() - 1);
				set_options_d(minCheckOutDate, newMaxCheckOutDate, checkOutDate_d_select);
			}else if(Number(month2indexstr(checkOutDate_m_select.value)) == maxCheckOutDate.getMonth() + 1){
				// Last month.
				var newMinCheckOutDate = new Date(checkOutDate_Y_select.value + "-" + month2indexstr(checkOutDate_m_select.value));
				set_options_d(newMinCheckOutDate, maxCheckOutDate, checkOutDate_d_select);
			}else{
				// Another month.
				var newMinCheckOutDate = new Date(checkOutDate_Y_select.value + "-" + month2indexstr(checkOutDate_m_select.value));
				var newMaxCheckOutDate = new Date(checkOutDate_Y_select.value + "-" + month2indexstr(checkOutDate_m_select.value));
				newMaxCheckOutDate.setMonth(newMaxCheckOutDate.getMonth() + 1);
				newMaxCheckOutDate.setDate(newMaxCheckOutDate.getDate() - 1);
				set_options_d(newMinCheckOutDate, newMaxCheckOutDate, checkOutDate_d_select);
			}
		}
	}
	if(document.getElementById("type") != null){
		document.getElementById("type").addEventListener("change", filter_onchange);
	}
	if(document.getElementById("floor") != null){
		filter_onchange();
		document.getElementById("floor").addEventListener("change", filter_onchange);
	}
	if(document.getElementById("back") != null){
		document.getElementById("back").onclick = function(){
			window.location = "../";
		}
	}
}

function set_options_Y(minDate, maxDate, selectElement){
	while(selectElement.firstElementChild){
		selectElement.removeChild(selectElement.firstElementChild);
	}
	var option = document.createElement("option");
	option.innerHTML = minDate.getFullYear();
	selectElement.appendChild(option);
	if(minDate.getFullYear() != maxDate.getFullYear()){
		var option = document.createElement("option");
		option.innerHTML = maxDate.getFullYear();
		selectElement.appendChild(option);
	}
	selectElement.dispatchEvent(new Event("change"));
}

function set_options_m(minDate, maxDate, selectElement){
	while(selectElement.firstElementChild){
		selectElement.removeChild(selectElement.firstElementChild);
	}
	for(var i = minDate.getMonth(); i <= maxDate.getMonth(); i++){
		switch(i){
			case 0:
				var option = document.createElement("option");
				option.innerHTML = "January";
				selectElement.appendChild(option);
				break;
			case 1:
				var option = document.createElement("option");
				option.innerHTML = "February";
				selectElement.appendChild(option);
				break;
			case 2:
				var option = document.createElement("option");
				option.innerHTML = "March";
				selectElement.appendChild(option);
				break;
			case 3:
				var option = document.createElement("option");
				option.innerHTML = "April";
				selectElement.appendChild(option);
				break;
			case 4:
				var option = document.createElement("option");
				option.innerHTML = "May";
				selectElement.appendChild(option);
				break;
			case 5:
				var option = document.createElement("option");
				option.innerHTML = "June";
				selectElement.appendChild(option);
				break;
			case 6:
				var option = document.createElement("option");
				option.innerHTML = "July";
				selectElement.appendChild(option);
				break;
			case 7:
				var option = document.createElement("option");
				option.innerHTML = "August";
				selectElement.appendChild(option);
				break;
			case 8:
				var option = document.createElement("option");
				option.innerHTML = "September";
				selectElement.appendChild(option);
				break;
			case 9:
				var option = document.createElement("option");
				option.innerHTML = "October";
				selectElement.appendChild(option);
				break;
			case 10:
				var option = document.createElement("option");
				option.innerHTML = "November";
				selectElement.appendChild(option);
				break;
			case 11:
				var option = document.createElement("option");
				option.innerHTML = "December";
				selectElement.appendChild(option);
				break;
		}
	}
	selectElement.dispatchEvent(new Event("change"));
}

function set_options_d(minDate, maxDate, selectElement){
	while(selectElement.firstElementChild){
		selectElement.removeChild(selectElement.firstElementChild);
	}
	for(var i = minDate.getDate(); i <= maxDate.getDate(); i++){
		var option = document.createElement("option");
		if(i < 10){
			option.innerHTML = "0" + String(i);
		}else{
			option.innerHTML = String(i);
		}
		selectElement.appendChild(option);
	}
	selectElement.dispatchEvent(new Event("change"));
}

function filter_onchange(){
	var type = document.getElementById("type").value;
	var floor = document.getElementById("floor").value;
	var checkInDate = document.getElementById("checkInDate_Y").value + "-" + month2indexstr(document.getElementById("checkInDate_m").value) + "-" + document.getElementById("checkInDate_d").value;
	var checkOutDate = document.getElementById("checkOutDate_Y").value + "-" + month2indexstr(document.getElementById("checkOutDate_m").value) + "-" + document.getElementById("checkOutDate_d").value;
	var cells = document.getElementsByTagName("td");
	switch(type){
		case "ALL":
			for(var i = 0; i < cells.length; i++){
				if(i != 5 && i != 6 && i != 7 && i != 11 && i != 12){
					cells[i].style.backgroundColor = "red";
				}
			}
			break;
		case "LARGE DOUBLE":
			for(var i = 0; i < cells.length; i++){
				if(i == 0 || i == 1 || i == 13 || i == 14){
					cells[i].style.backgroundColor = "red";
				}else if(i != 5 && i != 6 && i != 7 && i != 11 && i != 12){
					cells[i].style.backgroundColor = "grey";
				}
			}
			break;
		case "LARGE SINGLE":
			for(var i = 0; i < cells.length; i++){
				if(i == 2 || i == 3 || i == 15 || i == 16){
					cells[i].style.backgroundColor = "red";
				}else if(i != 5 && i != 6 && i != 7 && i != 11 && i != 12){
					cells[i].style.backgroundColor = "grey";
				}
			}
			break;
		case "SMALL SINGLE":
			for(var i = 0; i < cells.length; i++){
				if(i == 4 || i == 9 || i == 10 || i == 17){
					cells[i].style.backgroundColor = "red";
				}else if(i != 5 && i != 6 && i != 7 && i != 11 && i != 12){
					cells[i].style.backgroundColor = "grey";
				}
			}
			break;
		case "VIP":
			for(var i = 0; i < cells.length; i++){
				if(i == 8){
					cells[i].style.backgroundColor = "red";
				}else if(i != 5 && i != 6 && i != 7 && i != 11 && i != 12){
					cells[i].style.backgroundColor = "grey";
				}
			}
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
						cells[i].style.backgroundColor = "limegreen";
					}
				}
			}
		}
	}
	request.open("POST", "floor_status.php", true);
	request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	request.send("type=" + type + "&floor=" + floor + "&checkInDate=" + checkInDate + "&checkOutDate=" + checkOutDate);
}

function month2indexstr(month){
	switch(month){
		case "January":
			return "01";
		case "February":
			return "02";
		case "March":
			return "03";
		case "April":
			return "04";
		case "May":
			return "05";
		case "June":
			return "06";
		case "July":
			return "07";
		case "August":
			return "08";
		case "September":
			return "09";
		case "October":
			return "10";
		case "November":
			return "11";
		case "December":
			return "12";
		default:
			return "00";
	}
}
