window.onload = function(){
	resize();
	var animate = document.getElementById("animate");
	var animateArea = animate.getContext("2d");
	var randomOriginalX = new Array();
	var randomOriginalY = new Array();
	var randomHalfwayX = new Array();
	var randomHalfwayY = new Array();
	var randomHalfwayZ = new Array();
	var destinationX = new Array();
	var destinationY = new Array();
	var namelist = new Array();
	var nameCount = 0;
	for(var i in names){
		nameCount++;
		namelist[nameCount] = names[i];
		randomOriginalX[nameCount] = Math.ceil(Math.random() * animate.width * 0.9) + animate.width * 0.05;
		randomOriginalY[nameCount] = Math.ceil(Math.random() * animate.height * 0.9) + animate.height * 0.05;
		randomHalfwayX[nameCount] = Math.ceil(Math.random() * animate.width * 0.9) + animate.width * 0.05;
		randomHalfwayY[nameCount] = Math.ceil(Math.random() * animate.height * 0.9) + animate.height * 0.05;
		randomHalfwayZ[nameCount] = Math.ceil(animate.height * 0.03) * Math.ceil(Math.random() * 10) / 5;
		animateArea.fillText(namelist[nameCount], randomOriginalX[nameCount], randomOriginalY[nameCount]);
	}
	document.getElementById("randomGrouping").onclick = function(){
		document.getElementById("randomGrouping").disabled = true;
		var nameCounted = 0;
		var groupCounted = 0;
		var groupCount = parseFloat(document.getElementById("groupCount").value);
		if(groupCount >= 1 && groupCount <= nameCount && groupCount % 1 == 0){
			for(var i = 1; i <= groupCount; i++){
				var member = Math.ceil((nameCount - nameCounted) / (groupCount - groupCounted));
				groupCounted++;
				for(var j = 1; j <= member; j++){
					var randomNumber = Math.ceil(Math.random() * (nameCount - nameCounted));
					var last = nameCount - nameCounted;
					var temp = namelist[randomNumber];
					namelist[randomNumber] = namelist[last];
					namelist[last] = temp;
					var temp = randomOriginalX[randomNumber];
					randomOriginalX[randomNumber] = randomOriginalX[last];
					randomOriginalX[last] = temp;
					var temp = randomOriginalY[randomNumber];
					randomOriginalY[randomNumber] = randomOriginalY[last];
					randomOriginalY[last] = temp;
					var temp = randomHalfwayX[randomNumber];
					randomHalfwayX[randomNumber] = randomHalfwayX[last];
					randomHalfwayX[last] = temp;
					var temp = randomHalfwayY[randomNumber];
					randomHalfwayY[randomNumber] = randomHalfwayY[last];
					randomHalfwayY[last] = temp;
					var temp = randomHalfwayZ[randomNumber];
					randomHalfwayZ[randomNumber] = randomHalfwayZ[last];
					randomHalfwayZ[last] = temp;
					destinationX[last] = animate.width * 0.2 + (animate.height * 0.12) * (j - 1);
					destinationY[last] = animate.height / (groupCount + 1) * i;
					while(destinationX[last] > window.innerWidth * 0.7){
						destinationX[last] -= window.innerWidth * 0.6;
						destinationY[last] += 50;
					}
					nameCounted++;
				}
			}
			var temp = 0;
			var animation = setInterval(function(){
				temp++;
				animateArea.clearRect(0, 0, animate.width, animate.height);
				if(temp <= 50){
					for(var i = 1; i <= nameCount; i++){
						var tempX = randomOriginalX[i] + (randomHalfwayX[i] - randomOriginalX[i]) * (1 - Math.cos(Math.PI * temp / 50)) / 2;
						var tempY = randomOriginalY[i] + (randomHalfwayY[i] - randomOriginalY[i]) * (1 - Math.cos(Math.PI * temp / 50)) / 2;
						animateArea.font = Math.ceil(animate.height * 0.03) + (randomHalfwayZ[i] - Math.ceil(animate.height * 0.03)) * (1 - Math.cos(Math.PI * temp / 50)) / 2 + "px Arial";
						animateArea.fillText(namelist[i], tempX, tempY);
					}
				}else{
					for(var i = 1; i <= nameCount; i++){
						var tempX = randomHalfwayX[i] + (destinationX[i] - randomHalfwayX[i]) * (1 - Math.cos(Math.PI * (temp - 50) / 50)) / 2;
						var tempY = randomHalfwayY[i] + (destinationY[i] - randomHalfwayY[i]) * (1 - Math.cos(Math.PI * (temp - 50) / 50)) / 2;
						animateArea.font = randomHalfwayZ[i] + (Math.ceil(animate.height * 0.03) - randomHalfwayZ[i]) * (1 - Math.cos(Math.PI * (temp - 50) / 50)) / 2 + "px Arial";
						animateArea.fillText(namelist[i], tempX, tempY);
					}
					if(temp == 100){
						for(var i = 1; i <= groupCount; i++){
							animateArea.fillText("Group" + i + ": ", animate.width * 0.1, animate.height / (groupCount + 1) * i);
						}
						for(var i = 1; i <= nameCount; i++){
							randomOriginalX[i] = destinationX[i];
							randomOriginalY[i] = destinationY[i];
							randomHalfwayX[i] = Math.ceil(Math.random() * animate.width * 0.9) + animate.width * 0.05;
							randomHalfwayY[i] = Math.ceil(Math.random() * animate.height * 0.9) + animate.height * 0.05;
							randomHalfwayZ[i] = Math.ceil(animate.height * 0.03) * Math.ceil(Math.random() * 10) / 5;
						}
						document.getElementById("randomGrouping").disabled = false;
						clearInterval(animation);
					}
				}
			}, 1);
		}else{
			alert("Number of groups is invalid!");
			document.getElementById("randomGrouping").disabled = false;
		}
	};
};

window.onresize = resize;
function resize(){
	var animate = document.getElementById("animate");
	var animateArea = animate.getContext("2d");
	if(window.innerWidth >= 1180 && window.innerHeight >= 785){
		if(window.innerWidth / window.innerHeight >= 1180 / 785){
			document.body.style.backgroundSize = window.innerWidth + "px " + window.innerWidth / 1180 * 785 + "px";
		}else{
			document.body.style.backgroundSize = window.innerHeight / 785 * 1180 + "px " + window.innerHeight + "px";
		}
		animate.width = window.innerWidth * 0.8;
		animate.height = window.innerHeight * 0.7;
		animateArea.font = Math.ceil(animate.height * 0.03) + "px Arial";
	}else if(window.innerWidth < 1180 && window.innerHeight >= 785){
		document.body.style.backgroundSize = window.innerHeight / 785 * 1180 + "px " + window.innerHeight + "px";
		animate.width = 1180 * 0.8;
		animate.height = window.innerHeight * 0.7;
		animateArea.font = Math.ceil(animate.height * 0.03) + "px Arial";
	}else if(window.innerWidth >= 1180 && window.innerHeight < 785){
		document.body.style.backgroundSize = window.innerWidth + "px " + window.innerWidth / 1180 * 785 + "px";
		animate.width = window.innerWidth * 0.8;
		animate.height = 785 * 0.7;
		animateArea.font = Math.ceil(animate.height * 0.03) + "px Arial";
	}else{
		document.body.style.backgroundSize = "1180px 785px";
		animate.width = 1180 * 0.8;
		animate.height = 785 * 0.7;
		animateArea.font = Math.ceil(animate.height * 0.03) + "px Arial";
	}
};
