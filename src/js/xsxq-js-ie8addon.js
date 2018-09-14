var code;

function createCode() {
	code = "";
	var codeLength = 5;
	var checkCode = document.getElementById("checkCode");
	var codeChars = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];
	for(var i = 0; i < codeLength; i += 1) {
		var charNum = Math.floor(Math.random() * 52);
		code += codeChars[charNum]
	}
	if(checkCode) {
		checkCode.className = "code";
		checkCode.innerHTML = code
	}
}

function validateCode() {
	var inputCode = document.getElementById("yzm").value;
	if(inputCode.length <= 0) {
		alert("请输入验证码！");
		return false
	} else if(inputCode.toUpperCase() != code.toUpperCase()) {
		alert("验证码输入有误！");
		createCode();
		return false
	} else {
		return true
	}
}

function setvalue(id, val) {
	document.getElementById(id).value = val
}

function idxonsub_ie8() {
	if (validateCode())
	{
		$("#captcha").val("tuotuodeie8");
		createCode();
		
	document.getElementById('yktNum').type='text';
		document.getElementById("loginform").submit();
		setvalue('yktNum', '一 卡 通 号');
	setvalue('stuNum', '学       号');
	setvalue('yzm', '验  证  码');
	}
	else
	{
		createCode();
	}
}

function myreset_ie8() {
	setvalue('yktNum', '一 卡 通 号');
	setvalue('stuNum', '学       号');
	setvalue('yzm', '验  证  码');
	document.getElementById('yktNum').type='text';
	createCode();
}
if(!Object.keys) {
	Object.keys = (function() {
		var hasOwnProperty = Object.prototype.hasOwnProperty,
			hasDontEnumBug = !({
				toString: null
			}).propertyIsEnumerable('toString'),
			dontEnums = ['toString', 'toLocaleString', 'valueOf', 'hasOwnProperty', 'isPrototypeOf', 'propertyIsEnumerable', 'constructor'],
			dontEnumsLength = dontEnums.length;
		return function(obj) {
			if(typeof obj !== 'object' && typeof obj !== 'function' || obj === null) {
				throw new TypeError('Object.keys called on non-object')
			}
			var result = [];
			for(var prop in obj) {
				if(hasOwnProperty.call(obj, prop)) {
					result.push(prop)
				}
			}
			if(hasDontEnumBug) {
				for(var i = 0; i < dontEnumsLength; i += 1) {
					if(hasOwnProperty.call(obj, dontEnums[i])) {
						result.push(dontEnums[i])
					}
				}
			}
			return result
		}
	})()
};

var cmSubmitClickCnt = 0;

function onpapersubmit_ie8() {
	cmSubmitClickCnt++;
	if (cmSubmitClickCnt >= 5)
	{
		document.getElementById('forcesubbtn').style.display='inline-block';
	}
	
	var cfm = confirm('确认提交试卷？');
	if(!cfm) {
		return
	}
	onchangeques(currentqid);
	sstmp = Object.keys(selectstatus);
	if(sstmp.length != $('#maxques').attr('v')) {
		alert('未完成所有题目，不能提交！');
		return
	}
	
	if(window.XMLHttpRequest) {
		xhr = new XMLHttpRequest()
	} else {
		xhr = new ActiveXObject("Microsoft.XMLHTTP")
	}
	var json = JSON.stringify(selectstatus);
	xhr.open('POST', './foo/foo_paperSubmit.php');
	xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	xhr.send("answers=" + json);
	xhr.onreadystatechange = function() {
		if(xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 304)) {
			alert('交卷成功！点击确定查询成绩。');
			window.location.href = './foo/foo_getMark.php?stuNum=' + $('#xuehaodiv').attr('v') + "&yktNum=" + $('#yikatongdiv').attr('v')
		}
		if(xhr.readyState == 4 && xhr.status != 200 && xhr.status != 304) {
			alert('提交失败，请重试！若问题重复出现，请联系管理员。')
		}
	}
}