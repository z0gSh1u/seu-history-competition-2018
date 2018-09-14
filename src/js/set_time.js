function showTime(url) {
	var xmldoc = null;
	xmlurl = url;
	xmldoc = parseXml(xmlurl, "post");
	beginDate = new Date(0), endDate = new Date(0);
	var nowDate = new Date();
	var beginStr = "",
		endStr = "";
	var isRunning = false;
	beginDate.setTime(Number(xmldoc.getElementsByTagName("begin")[0].childNodes[0].nodeValue));
	endDate.setTime(Number(xmldoc.getElementsByTagName("end")[0].childNodes[0].nodeValue));
	isRunning = (beginDate.getTime() <= nowDate.getTime() && endDate.getTime() >= nowDate.getTime());
	beginStr = beginDate.getFullYear() + "-" + (beginDate.getMonth() < 9 ? "0" : "") + String(Number(beginDate.getMonth()) + 1) + "-" + (beginDate.getDate() < 10 ? "0" : "") + beginDate.getDate() + "  " + (beginDate.getHours() < 10 ? "0" : "") + beginDate.getHours() + ":" + (beginDate.getMinutes() < 10 ? "0" : "") + beginDate.getMinutes();
	endStr = endDate.getFullYear() + "-" + (endDate.getMonth() < 9 ? "0" : "") + String(Number(endDate.getMonth()) + 1) + "-" + (endDate.getDate() < 10 ? "0" : "") + endDate.getDate() + "  " + (endDate.getHours() < 10 ? "0" : "") + endDate.getHours() + ":" + (endDate.getMinutes() < 10 ? "0" : "") + endDate.getMinutes();
	document.getElementById("begin").innerHTML = "<p><b>竞赛开始时间</b> " + beginStr + "</p>";
	document.getElementById("end").innerHTML = "<p><b>竞赛结束时间</b> " + endStr + "</p>";
	if (isRunning) {
		document.getElementById("flag").innerHTML = "<p>竞赛正在进行</p>"
	} else {
		document.getElementById("flag").innerHTML = "<p>竞赛未在进行</p>"
	}
	changeSetValue(beginDate, "begin");
	changeSetValue(endDate, "end")
}

function changeSetValue(date, which) {
	document.getElementById(which + "Year").value = date.getFullYear();
	document.getElementById(which + "Month").value = date.getMonth() + 1;
	document.getElementById(which + "Date").value = date.getDate();
	document.getElementById(which + "Hour").value = date.getHours();
	document.getElementById(which + "Minute").value = date.getMinutes()
}

function onNow(which) {
	var nowDate = new Date();
	changeSetValue(nowDate, which)
}

function onChange(which) {
	var newDate = new Date(0);
	var another = "";
	var anotherDate = new Date(0);
	newDate.setFullYear(document.getElementById(which + "Year").value);
	newDate.setMonth(document.getElementById(which + "Month").value - 1);
	newDate.setDate(document.getElementById(which + "Date").value);
	newDate.setHours(document.getElementById(which + "Hour").value);
	newDate.setMinutes(document.getElementById(which + "Minute").value);
	another = (which == "begin" ? "end" : "begin");
	anotherDate.setTime((which == "begin" ? endDate.getTime() : beginDate.getTime()));
	sendToPhp("./superfoo/superfoo_settime.php", "get", true, function() {
		onRefresh()
	}, {
		key: "xmlurl",
		value: "../" + xmlurl
	}, {
		key: which,
		value: newDate.getTime()
	}, {
		key: another,
		value: anotherDate.getTime()
	})
}

function onRefresh() {
	showTime(xmlurl)
}