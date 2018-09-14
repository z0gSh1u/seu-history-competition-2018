function sendToPhp(phpurl, how, async, doNext, ...info) {
	var xmlhttp = null;
	if(window.XMLHttpRequest) {
		xmlhttp = new XMLHttpRequest()
	} else {
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP")
	}
	for(var i = 0; i < info.length; i += 1) {
		if(i == 0) {
			phpurl += "?"
		} else {
			phpurl += "&"
		}
		phpurl += info[i].key + "=" + info[i].value
	}
	xmlhttp.onreadystatechange = function() {
		if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			doNext();
			return true
		} else if(xmlhttp.status == 404) {
			return false
		}
	};
	xmlhttp.open(how, phpurl, async);
	xmlhttp.send()
}

function isExists(filepath) {
	var xmlhttp = null;
	if(window.XMLHttpRequest) {
		xmlhttp = new XMLHttpRequest()
	} else {
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP")
	}
	xmlhttp.open("GET", filepath, false);
	xmlhttp.send();
	if(xmlhttp.readyState == 4) {
		if(xmlhttp.status == 200) {
			return true;
		} else if(xmlhttp.status == 404) {
			return false;
		} else {
			return false;
		}
	} else {
		return false
	}
}