function parseXml(fileName, how, doWhenFail = function() {
	alert("您的浏览器不能正常加载文件。请切换到兼容模式，或者更换浏览器")
}) {
	var xmlDoc = null;
	try {
		xmlDoc = new ActiveXObject("Microsoft.XMLDOM");
		xmlDoc.async = "false";
		xmlDoc.load(fileName)
	} catch (e) {
		try {
			xmlDoc = document.implementation.createDocument("", "", null);
			xmlDoc.async = "false";
			xmlDoc.load(fileName)
		} catch (e) {
			try {
				var xmlhttp = new window.XMLHttpRequest();
				xmlhttp.open(how, fileName, false);
				xmlhttp.send(null);
				xmlDoc = xmlhttp.responseXML.documentElement
			} catch (e) {
				doWhenFail();
				return false
			}
		}
	}
	return xmlDoc
}