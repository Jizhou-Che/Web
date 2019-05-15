window.onload = function(){
	document.getElementById("home").onclick = function(){
		window.location = "../";
	}
	if(document.getElementById("notification") != null){
		setTimeout("document.getElementById('notification').parentNode.removeChild(document.getElementById('notification'))", 5000);
	}
	if(document.getElementById("close") != null){
		document.getElementById("close").onclick = function(){
			document.getElementById("home").style.display = "none";
			document.getElementById("main").style.display = "none";
			// Create window contents.
			var confirmParagraph1 = document.createElement("p");
			confirmParagraph1.innerHTML = "Are you sure you want to close your account? You will lose all your profile information as well as room bookings!";
			var confirmParagraph2 = document.createElement("p");
			confirmParagraph2.innerHTML = "You will have to enter your password to continue.";
			var passwordField = document.createElement("input");
			passwordField.setAttribute("type", "password");
			passwordField.setAttribute("name", "password");
			var form = document.createElement("form");
			form.setAttribute("id", "form");
			form.setAttribute("action", "close_account.php");
			form.setAttribute("method", "POST");
			form.appendChild(passwordField);
			var cancelButton = document.createElement("div");
			cancelButton.setAttribute("id", "cancel_button");
			cancelButton.innerHTML = "Cancel";
			var confirmButton = document.createElement("div");
			confirmButton.setAttribute("id", "confirm_button");
			confirmButton.innerHTML = "Confirm";
			// Add event listeners.
			cancelButton.addEventListener("click", function(){
				document.getElementById("home").style.display = "block";
				document.getElementById("main").style.display = "block";
				// Remove confirmation window.
				document.body.removeChild(document.getElementById("close_confirm"));
			});
			confirmButton.addEventListener("click", function(){
				// Check if password is empty.
				if(passwordField.value == ""){
					passwordField.setAttribute("placeholder", "* Required");
					return;
				}else if(passwordField.value.length > 64){
					passwordField.value = "";
					passwordField.setAttribute("placeholder", "* No more than 64 characters");
					return;
				}else{
					passwordField.removeAttribute("placeholder");
					document.getElementById("form").submit();
				}
			});
			// Create confirmaton window.
			var confirmWindow = document.createElement("div");
			confirmWindow.setAttribute("id", "close_confirm");
			confirmWindow.appendChild(confirmParagraph1);
			confirmWindow.appendChild(confirmParagraph2);
			confirmWindow.appendChild(form);
			confirmWindow.appendChild(cancelButton);
			confirmWindow.appendChild(confirmButton);
			document.body.appendChild(confirmWindow);
		}
	}
	if(document.getElementById("back") != null){
		document.getElementById("back").onclick = function(){
			window.location = "../";
		}
	}
}
