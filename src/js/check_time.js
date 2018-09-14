(function(window) {
	var xmldoc = parseXml("./xml/contest_time.xml", "post");
	var nowDate = new Date();
	if (nowDate.getTime() < Number(xmldoc.getElementsByTagName("begin")[0].childNodes[0].nodeValue) || nowDate.getTime() > Number(xmldoc.getElementsByTagName("end")[0].childNodes[0].nodeValue)) {}
}(window));