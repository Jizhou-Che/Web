window.onload = function(){
	var video = document.getElementById("video");
	var buffer = document.getElementById("buffer");
	var display = document.getElementById("display");
	var range = document.getElementById("progress");
	var duration = 0;
	var effectPointer = {
		effect: none
	};
	video.addEventListener("play", processFrame, false);
	video.play();
	video.ontimeupdate = function(){
		duration = video.duration;
		range.value = video.currentTime * 1000 / duration;
	};
	range.onchange = function(){
		video.currentTime = duration * range.value / 1000;
	};
	function processFrame(){
		if(video.paused || video.ended){
			return;
		}
		var bufferContext = buffer.getContext("2d");
		var displayContext = display.getContext("2d");
		bufferContext.drawImage(video, 0, 0, buffer.width, buffer.height);
		var frame = bufferContext.getImageData(0, 0, buffer.width, buffer.height);
		var length = frame.data.length / 4;
		for(var i = 0;i < length; i++){
			var r = frame.data[i * 4 + 0];
			var g = frame.data[i * 4 + 1];
			var b = frame.data[i * 4 + 2];
			var a = frame.data[i * 4 + 3];
			effectPointer.effect(i, r, g, b, a, frame.data);
		}
		displayContext.putImageData(frame, 0, 0);
		setTimeout(processFrame, 0);
	}
	var pure = document.getElementById("pure");
	pure.onclick = function(){
		effectPointer.effect = none;
	};
	var effect1 = document.getElementById("noir");
	effect1.onclick = function(){
		effectPointer.effect = noir;
	};
	var effect2 = document.getElementById("western");
	effect2.onclick = function(){
		effectPointer.effect = western;
	};
	var effect3 = document.getElementById("scifi");
	effect3.onclick = function(){
		effectPointer.effect = scifi;
	};
	var effect4 = document.getElementById("bwcartoon");
	effect4.onclick = function(){
		effectPointer.effect = bwcartoon;
	};
	var pause = document.getElementById("pause");
	pause.onclick = function(){
		video.pause();
	};
	var play = document.getElementById("play");
	play.onclick = function(){
		video.play();
	};
};

function none(pos, r, g, b, a, data){
	//do nothing.
}

function noir(pos, r, g, b, a, data){
	var brightness = (3 * r + 4 * g + b) >>> 3;
	if(brightness < 0){
		brightness=0;
	}
	data[pos * 4 + 0] = brightness;
	data[pos * 4 + 1] = brightness;
	data[pos * 4 + 2] = brightness;
}

function western(pos, r, g, b, a, data){
	var brightness = (3 * r + 4 * g + b) >>> 3;
	data[pos * 4 + 0] = brightness + 40;
	data[pos * 4 + 1] = brightness + 20;
	data[pos * 4 + 2] = brightness - 20;
}

function scifi(pos, r, g, b, a, data){
	data[pos * 4 + 0] = Math.round(255 - r);
	data[pos * 4 + 1] = Math.round(255 - g);
	data[pos * 4 + 2] = Math.round(255 - b);
}

function bwcartoon(pos, r, g, b, a, data){
	var offset = pos * 4;
	if(data[offset] < 120){
		data[offset] = 80;
		data[++offset] = 80;
		data[++offset] = 80;
	}else{
		data[offset] = 255;
		data[++offset] = 255;
		data[++offset] = 255;
	}
	data[++offset] = 255;
	++offset;
}
