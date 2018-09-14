var currentShow = "defaultright";

function showdiv(id) {
	if(currentShow != null) {
		document.getElementById(currentShow).style.display = "none"
	}
	document.getElementById(id).style.display = "inline";
	currentShow = id
}

function resetformsub(v) {
	document.getElementById('rsfty').value = v;
	$.ajax({
		type: "POST",
		url: "./superfoo/superfoo_resetStatus.php",
		data: $('#resetform').serialize(),
		success: function(data) {
			alert(data)
		},
		error: function() {
			alert('发生错误！')
		}
	})
}

function opsqlosb(ty) {
	document.getElementById('outputmethod').value = ty;
	document.getElementById('opsqlform').submit()
}

function cfgeditsub(id) {
	$.ajax({
		type: "POST",
		url: "./superfoo/superfoo_savecfg.php",
		data: $('#' + id).serialize(),
		success: function(data) {
			alert('保存成功！')
		},
		error: function() {
			alert('发生错误！')
		}
	})
}

function asksql() {
	cfm = confirm('请确认本操作！');
	if(cfm) {
		document.getElementById('sqlfileform').submit()
	} else {
		return false
	}
}

function interquerysub() {
	var url = "./superfoo/superfoo_interquery.php?stuNum=" + document.getElementById('stuNumaa').value + "&yktNum=" + document.getElementById('yktNumaa').value;
	url = url + '&name=' + document.getElementById('nameaa').value;
	document.getElementById('interqueryres').src = url;
	document.getElementById('interqueryres').style.display = 'block'
}