var counting;

window.onload = function(){
	resize();
	document.getElementById("button").onclick = count;
};

function count(){
	document.getElementById("button").onclick = stop;
	var from = parseFloat(document.getElementById("from").value);
	var to = parseFloat(document.getElementById("to").value);
	if(from <= to && from % 1 == 0 && to % 1 == 0){
		document.getElementById("button").innerHTML = "Stop!";
		document.getElementById("from").disabled = true;
		document.getElementById("to").disabled = true;
		counting = setInterval(function(){
			document.getElementById("Number").innerHTML = Math.floor(Math.random() * (to - from + 1)) + from;
		}, 0.1);
	}else{
		alert("Invalid input!");
	}
}

function stop(){
	document.getElementById("button").onclick = count;
	document.getElementById("button").innerHTML = "Start!";
	document.getElementById("from").disabled = false;
	document.getElementById("to").disabled = false;
	clearInterval(counting);
}

window.onresize = resize;
function resize(){
	if(window.innerWidth >= 1180 && window.innerHeight >= 785){
		if(window.innerWidth / window.innerHeight >= 1180 / 785){
			document.body.style.backgroundSize = window.innerWidth + "px " + window.innerWidth / 1180 * 785 + "px";
		}else{
			document.body.style.backgroundSize = window.innerHeight / 785 * 1180 + "px " + window.innerHeight + "px";
		}
	}else if(window.innerWidth < 1180 && window.innerHeight >= 785){
		document.body.style.backgroundSize = window.innerHeight / 785 * 1180 + "px " + window.innerHeight + "px";
	}else if(window.innerWidth >= 1180 && window.innerHeight < 785){
		document.body.style.backgroundSize = window.innerWidth + "px " + window.innerWidth / 1180 * 785 + "px";
	}else{
		document.body.style.backgroundSize = "1180px 785px";
	}
}
