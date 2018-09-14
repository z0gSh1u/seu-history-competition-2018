function delquestion(ty) {
	var resjson = [];
	resjson.push(ty);
	var cfmdel = confirm('请确认当前操作！');
	if(!cfmdel) {
		return
	}
	if(ty == 1) {
		allpro = document.getElementsByName('selcb[]')
	}
	if(ty == 2) {
		allpro = document.getElementsByName('tfcb[]')
	}
	if(allpro.length == 0) {
		alert('未选中任何项目！');
		return
	}
	for(var i = 0; i < allpro.length; i += 1) {
		if(allpro[i].checked) {
			var qid = allpro[i].value;
			resjson.push(qid)
		}
	}
	$.ajax({
		type: "POST",
		url: "./superfoo_quesedit.php",
		data: "json=" + JSON.stringify(resjson),
		success: function(data) {
			alert(data);
			location.reload()
		},
		error: function() {
			alert('发生错误！')
		}
	})
}
var allpro = null;

function allsel(ty) {
	if(ty == 1) {
		allpro = document.getElementsByName('selcb[]')
	}
	if(ty == 2) {
		allpro = document.getElementsByName('tfcb[]')
	}
	for(var i = 0; i < allpro.length; i += 1) {
		if(allpro[i].type == 'checkbox') {
			allpro[i].checked = true
		}
	}
}

function allrev(ty) {
	if(ty == 1) {
		allpro = document.getElementsByName('selcb[]')
	}
	if(ty == 2) {
		allpro = document.getElementsByName('tfcb[]')
	}
	for(var i = 0; i < allpro.length; i += 1) {
		if(allpro[i].type == 'checkbox') {
			allpro[i].checked = !allpro[i].checked
		}
	}
}