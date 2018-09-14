
var dataList = ["0", "1"];
var options = {
	dataList: dataList,
	success: function() {
		$("#captcha").val("ojbktrue");
	},
	fail: function() {}
};

function numsCheck() {
	sn = document.getElementById("stuNum").value;
	yn = document.getElementById("yktNum").value;
	if(sn == "" || yn == "") {
		alert("有项目为空！");
		return false
	}
	if(sn.length != 8 || yn.length != 9) {
		alert("有项目长度有误！");
		return false
	}
	return true
}

function idxonsub() {
	if(!numsCheck()) {
		return false
	}
	document.getElementById("loginform").submit();
    SliderBar("slideBar", options);
    $("#captcha").val("false");
    document.getElementById("stuNum").value = "";
	document.getElementById("yktNum").value = "";
}

function onsubrr() {
	if(!numsCheck()) {
		return false
	}
	if(confirm("【仔细确认】\n您要添加的用户：\n学号：" + sn + "\n一卡通号：" + yn)) {
		document.getElementById("regform").submit()
	}
}

function onsubaa() {
	if(!numsCheck()) {
		return false
	}
	document.getElementById("getmarkform").submit()
}

function onlogout() {
	var ccffmm = confirm('确定退出登录？');
	if(ccffmm) {
		window.open('./foo/foo_logout.php');
		window.close()
	}
}

function subit() {
	if(confirm("确认提交？")) {
		document.getElementById("errorqueryform").submit()
	}
}

function myreset() {
	document.getElementById("stuNum").value = "";
	document.getElementById("yktNum").value = "";
    $("#okFlag").val("false");
    SliderBar("slideBar", options);
}

var currentqid = 1;
var selectstatus = {};
var cmSubmitClickCnt = 0;


function onchangeques(qid) {

	var tgcssid = "#rbtn" + qid.toString();
	var curcssid = "#rbtn" + currentqid.toString();
	
	if(qid <= 0 || qid > $('#maxques').attr('v')) {
		return
	}
	if(currentqid <= $('#selcount').attr('v')) {
		var rdosetname = "radioof" + currentqid.toString();
		var res = document.getElementsByName(rdosetname);
		var flag = false;
		for(var i = 0; i < res.length; i += 1) {
			if(res[i].checked) {
				var tmp = $('#que' + currentqid.toString()).attr('queid');
				selectstatus[tmp] = (i + 1);
				$(curcssid).addClass('btn-success');
				flag = true;
				break
			}
		}
		if(!flag) {
			$(curcssid).addClass('btn-default')
		}
	} else {
		var rdosetname = "radioof" + currentqid.toString();
		var res = document.getElementsByName(rdosetname);
		var flag = false;
		for(var i = 0; i < res.length; i += 1) {
			if(res[i].checked) {
				var tmp = $('#que' + currentqid.toString()).attr('queid');
				selectstatus['TF' + tmp] = (i + 1) % 2;
				$(curcssid).addClass('btn-success');
				flag = true;
				break
			}
		}
		if(!flag) {
			$(curcssid).addClass('btn-default')
		}
	}
	$(curcssid).removeClass('btn-primary');
	$(tgcssid).removeClass('btn-default');
	$(tgcssid).removeClass('btn-success');
	$(tgcssid).addClass('btn-primary');
	var curqid = "#que" + currentqid.toString();
	var tgqid = "#que" + qid.toString();
	$(curqid).css('display', 'none');
	$(tgqid).css('display', 'block');
	currentqid = qid;
	$('.questioncontianer').css('height', $('.questioncontrol').height())
}

function nextque() {
	onchangeques(currentqid + 1)
}

function prevque() {
	onchangeques(currentqid - 1)
}

function onclickques(qid) {
	onchangeques(qid)
}

function onpapersubmitset() {
	cmSubmitClickCnt++;
	if (cmSubmitClickCnt >= 5)
	{
		document.getElementById('forcesubbtn').style.display='inline-block';
	}
	onpapersubmit();
}

function onpapersubmit() {
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
	var json = JSON.stringify(selectstatus);
	if(window.XMLHttpRequest) {
		xhr = new XMLHttpRequest()
	} else {
		xhr = new ActiveXObject("Microsoft.XMLHTTP")
	}
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

function onpapersubmit_timeoutver() {
	onchangeques(currentqid);
	sstmp = Object.keys(selectstatus);
	var json = JSON.stringify(selectstatus);
	if(window.XMLHttpRequest) {
		xhr = new XMLHttpRequest()
	} else {
		xhr = new ActiveXObject("Microsoft.XMLHTTP")
	}
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

function forcesubmit(){
	onpapersubmit_timeoutver();
}
