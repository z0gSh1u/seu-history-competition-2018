function getAcaList() {
	var data = null;
	$.ajax({
		url: "./json/acanuminfo.json",
		beforeSend: function(xmlHttp) {
			xmlHttp.setRequestHeader("If-Modified-Since", "0");
			xmlHttp.setRequestHeader("Cache-Control", "no-cache")
		},
		data: {},
		success: function(result) {
			data = result
		},
		dataType: 'json',
		async: false
	});
	return data
}

function getScoreList(academy) {
	var data = null;
	var updateData = false;
	updateData = !(isExists("./json/updatetime" + academy + ".json") && isExists("./json/list" + academy + ".json"));
	if (!updateData) {
		$.ajax({
			url: "./json/updatetime" + academy + ".json",
			beforeSend: function(xmlHttp) {
				xmlHttp.setRequestHeader("If-Modified-Since", "0");
				xmlHttp.setRequestHeader("Cache-Control", "no-cache")
			},
			data: {},
			success: function(result) {
				data = result
			},
			dataType: 'json',
			async: false
		});
		var updateTime = Number(data);
		var nowTime = new Date().getTime() / 1000;
		updateData = nowTime - updateTime > 60
	}
	if (updateData) {
		sendToPhp("./superfoo/superfoo_updateScoreInfo.php", "GET", false, function() {}, {
			key: "academy",
			value: academy
		})
	}
	$.ajax({
		url: "./json/list" + academy + ".json",
		beforeSend: function(xmlHttp) {
			xmlHttp.setRequestHeader("If-Modified-Since", "0");
			xmlHttp.setRequestHeader("Cache-Control", "no-cache")
		},
		data: {},
		success: function(result) {
			data = result
		},
		dataType: 'json',
		async: false
	});
	return data
}

function getAveTopTen() {
	var scoreList = null;
	var acaRate = [];
	for (var i = 0; i < 10; i += 1) {
		acaRate[i] = {
			academy: "00",
			aveScore: 0
		}
	}
	scoreList = getScoreList("00");
	var listLength = scoreList.length;
	for (var i = 0; i < listLength; i += 1) {
		var acaScore = {
			academy: scoreList[i].academy,
			aveScore: 0
		};
		var amount = 0;
		for (; i < listLength && scoreList[i].academy == acaScore.academy; i += 1) {
			if (Number(scoreList[i].score) >= 0) {
				acaScore.aveScore += Number(scoreList[i].score);
				amount += 1
			}
		}
		i -= 1;
		if (amount != 0) {
			acaScore.aveScore /= amount
		}
		for (var j = 0; j < 10; j += 1) {
			if (acaScore.aveScore > acaRate[j].aveScore) {
				acaRate.splice(j, 0, acaScore);
				acaRate.pop();
				break
			}
		}
	}
	for (var k = 0; k < acaRate.length; k += 1) {
		acaRate[k].aveScore = acaRate[k].aveScore.toFixed(2)
	}
	return acaRate
}

function getAcaCondition() {
	var scoreList = null;
	var acaList = [];
	scoreList = getScoreList("00");
	var listLength = (scoreList != null ? scoreList.length : 0);
	for (var i = 0; i < listLength; i += 1) {
		var acaCon = {
			academy: scoreList[i].academy,
			aveScore: 0,
			finishAmt: 0,
			unfinishAmt: 0
		};
		for (; i < listLength && scoreList[i].academy == acaCon.academy; i += 1) {
			if (Number(scoreList[i].score) >= 0) {
				acaCon.aveScore += Number(scoreList[i].score);
				acaCon.finishAmt += 1
			} else {
				acaCon.unfinishAmt += 1
			}
		}
		i -= 1;
		if (acaCon.finishAmt != 0) {
			acaCon.aveScore /= acaCon.finishAmt
		}
		acaList.push(acaCon)
	}
	return acaList
}

function getStuScoreList(academy) {
	return getScoreList(academy)
}

function getScoreSection(academy) {
	var scoreList = getScoreList(academy);
	var scoreSection = [];
	scoreSection[0] = {
		begin: 100,
		end: 101,
		amt: 0
	};
	for (var i = 1; i <= 11; i += 1) {
		scoreSection[i] = {
			begin: (10 - i) * 10,
			end: (11 - i) * 10,
			amt: 0
		}
	}
	var listLength = (scoreList != null ? scoreList.length : 0);
	for (var i = 0; i < listLength; i += 1) {
		var score = scoreList[i].score;
		for (var j = 0; j <= 11; j += 1) {
			if (score >= scoreSection[j].begin && score < scoreSection[j].end) {
				scoreSection[j].amt += 1;
				break
			}
		}
	}
	return scoreSection
}

function drawAveTen(domId) {
	var topTen = getAveTopTen();
	var data = [];
	for (var i = 0; i < 10; i += 1) {
		data[i] = {
			name: topTen[i].academy,
			value: topTen[i].aveScore,
			color: '#76a871'
		}
	}
	$(function() {
		var chart = new iChart.Column2D({
			render: domId,
			data: data,
			title: '平均分前十院系',
			width: 800,
			height: 400,
			shadow: false,
			shadow_color: '#ffffff',
			coordinate: {
				scale: [{
					position: 'left',
					start_scale: 0,
					end_scale: 100,
					scale_space: 10,
					listeners: {
						parseText: function(t, x, y) {
							return {
								text: t
							}
						}
					}
				}]
			}
		});
		chart.draw()
	})
}
var compare = [];
compare["aveScoreAscend"] = function(x, y) {
	if (x.aveScore > y.aveScore) {
		return -1
	} else if (x.aveScore < y.aveScore) {
		return 1
	} else {
		return 0
	}
};
compare["aveScoreDescend"] = function(x, y) {
	if (x.aveScore > y.aveScore) {
		return 1
	} else if (x.aveScore < y.aveScore) {
		return -1
	} else {
		return 0
	}
};
compare["academy"] = function(x, y) {
	if (x.academy < y.academy) {
		return -1
	} else if (x.academy > y.academy) {
		return 1
	} else {
		return 0
	}
};
compare["score"] = function(x, y) {
	if (Number(x.score) > Number(y.score)) {
		return -1
	} else if (Number(x.score) < Number(y.score)) {
		return 1
	} else {
		return 0
	}
};
compare["stunum"] = function(x, y) {
	if (x.stunum < y.stunum) {
		return -1
	} else if (x.stunum > y.stunum) {
		return 1
	} else {
		return 0
	}
};

function drawAcaCon(domId, key) {
	var acaCon = getAcaCondition();
	var acaList = getAcaList();
	acaCon.sort(compare[key]);
	var $table = $("<div class='container'><table class='table table-striped table-hover table-bordered' style='width:510px;'></table></div>");
	$("#" + domId).empty();
	$("#" + domId).append($table);
	$table.children("table").first().append("<thead><tr><th style='width:240px;'>院系</th><th style='width:70px;'>平均分</th><th style='width:100px;'>已答题人数</th><th style='width:100px;'>未答题人数</th></tr></thead>");
	$table.children("table").first().append("<tbody></tbody>");
	var listLength = (acaCon != null ? acaCon.length : 0);
	for (var i = 0; i < listLength; i += 1) {
		var $tr = $("<tr></tr>");
		$tr.append("<td></td>");
		for (var j = 0; j < acaList.academies.length; j += 1) {
			if (acaList.academies[j].number == acaCon[i].academy) {
				$tr.children("td").first().remove();
				$tr.append("<td>" + acaCon[i].academy + " " + acaList.academies[j].academy + "</td>");
				break
			}
		}
		$tr.append("<td>" + String(acaCon[i].aveScore) + "</td>");
		$tr.append("<td>" + String(acaCon[i].finishAmt) + "</td>");
		$tr.append("<td>" + String(acaCon[i].unfinishAmt) + "</td>");
		$table.find("tbody").first().append($tr)
	}
}

function drawScoreSection(domId, academy) {
	var scoreSec = getScoreSection(academy);
	var $table = $("<div class='container'><table class='table table-striped table-hover table-bordered' style='width:280px;'></table></div>");
	$("#" + domId).empty();
	$("#" + domId).append($table);
	$table.children("table").first().append("<thead><tr><th style='width:140px;'>分数段</th><th style='width:140px;'>人数</th></tr></thead>");
	$table.children("table").first().append("<tbody></tbody>");
	var listLength = scoreSec.length;
	for (var i = 0; i < listLength; i += 1) {
		var $tr = $("<tr></tr>");
		if (scoreSec[i].begin < 0) {
			$tr.append("<td>未完成</td>")
		} else if (scoreSec[i].begin == 100) {
			$tr.append("<td>100</td>")
		} else {
			$tr.append("<td>" + String(scoreSec[i].begin) + "-" + String(scoreSec[i].end - 1) + "</td>")
		}
		$tr.append("<td>" + String(scoreSec[i].amt) + "</td>");
		$table.find("tbody").first().append($tr)
	}
}

function drawStuRate(domId, academy, key) {
	var stuRate = getStuScoreList(academy);
	if (stuRate != null) {
		stuRate.sort(compare[key])
	}
	var $table = $("<div class='container'><table class='table table-striped table-hover table-bordered' style='width:520px;'></table></div>");
	$("#" + domId).empty();
	$("#" + domId).append($table);
	$table.children("table").first().append("<thead><tr><th style='width:140px;'>学号</th><th style='width:240px;'>姓名</th><th style='width:140px;'>分数</th></tr></thead>");
	$table.children("table").first().append("<tbody></tbody>");
	var listLength = (stuRate != null ? stuRate.length : 0);
	for (var i = 0; i < listLength; i += 1) {
		if (i == 50) {
			break
		}
		var $tr = $("<tr></tr>");
		$tr.append("<td>" + stuRate[i].stunum + "</td>");
		$tr.append("<td>" + stuRate[i].name + "</td>");
		if (stuRate[i].score < 0) {
			$tr.append("<td>未完成</td>")
		} else {
			$tr.append("<td>" + String(stuRate[i].score) + "</td>")
		}
		$table.find("tbody").first().append($tr)
	}
}

function onChangeChart_superadmin(selectId, divId) {
	var chart = $("select#" + selectId + " option:selected").val();
	$("select#" + selectId).nextAll("select").empty();
	$("select#" + selectId).nextAll("select").remove();
	switch (chart) {
		case "0":
			var $detail = $("<select style='height:30px;'></select>");
			$("select#" + selectId).after($detail);
			$detail.append('<option value="" selected="selected" disabled="disabled" style="display: none">请选择排序方式</option>');
			$detail.append("<option value='academy'>院系代码顺序</option><option value='aveScoreAscend'>平均分升序</option><option value='aveScoreDescend'>平均分降序</option>");
			$detail.change(function() {
				drawAcaCon(divId, $detail.children("option:selected").first().val())
			});
			break;
		case "1":
			drawAveTen(divId);
			break;
		case "2":
			var acaList = getAcaList();
			var $detail = $("<select style='height:30px;'></select>");
			$("select#" + selectId).after($detail);
			$detail.append('<option value="" selected="selected" disabled="disabled" style="display: none">请选择院系</option>');
			$detail.append("<option value='00'>全部</option>");
			var listLength = acaList.academies.length;
			for (var i = 0; i < listLength; i += 1) {
				$detail.append("<option value='" + acaList.academies[i].number + "'>" + acaList.academies[i].number + " " + acaList.academies[i].academy + "</option>")
			}
			$detail.change(function() {
				drawScoreSection(divId, $detail.children("option:selected").first().val())
			});
			break;
		case "3":
			var acaList = getAcaList();
			var $detail = $("<select style='height:30px;'></select>");
			var $detail2 = $("<select style='height:30px; margin-left:20px;'></select>");
			$("select#" + selectId).after($detail, $detail2);
			$detail.append('<option value="" selected="selected" disabled="disabled" style="display: none">请选择院系</option>');
			$detail.append("<option value='00'>全部</option>");
			var listLength = acaList.academies.length;
			for (var i = 0; i < listLength; i += 1) {
				$detail.append("<option value='" + acaList.academies[i].number + "'>" + acaList.academies[i].number + " " + acaList.academies[i].academy + "</option>")
			}
			$detail2.append('<option value="" selected="selected" disabled="disabled" style="display: none">请选择排序方式</option>');
			$detail2.append("<option value='stunum'>班级顺序</option><option value='score'>分数顺序</option>");
			$detail.change(function() {
				if ($detail2.children("option:selected").first().val() != "") {
					drawStuRate(divId, $detail.children("option:selected").first().val(), $detail2.children("option:selected").first().val())
				}
			});
			$detail2.change(function() {
				if ($detail.children("option:selected").first().val() != "") {
					drawStuRate(divId, $detail.children("option:selected").first().val(), $detail2.children("option:selected").first().val())
				}
			});
			break
	}
}

function onChangeChart_admin(selectId, divId, academy) {
	var chart = $("select#" + selectId + " option:selected").val();
	$("select#" + selectId).nextAll("select").empty();
	$("select#" + selectId).nextAll("select").remove();
	switch (chart) {
		case "0":
			var $detail = $("<select style='height:30px;'></select>");
			$("select#" + selectId).after($detail);
			$detail.append('<option value="" selected="selected" disabled="disabled" style="display: none">请选择排序方式</option>');
			$detail.append("<option value='academy'>院系代码顺序</option><option value='aveScoreAscend'>平均分升序</option><option value='aveScoreDescend'>平均分降序</option>");
			$detail.change(function() {
				drawAcaCon(divId, $detail.children("option:selected").first().val())
			});
			break;
		case "1":
			drawAveTen(divId);
			break;
		case "2":
			drawScoreSection(divId, academy);
			break;
		case "3":
			var acaList = getAcaList();
			var $detail2 = $("<select style='height:30px;'></select>");
			$("select#" + selectId).after($detail2);
			$detail2.append('<option value="" selected="selected" disabled="disabled" style="display: none">请选择排序方式</option>');
			$detail2.append("<option value='stunum'>班级顺序</option><option value='score'>分数顺序</option>");
			$detail2.change(function() {
				drawStuRate(divId, academy, $detail2.children("option:selected").first().val())
			});
			break
	}
}

function refreshAll() {
	var acaList = getAcaList();
	var listLength = acaList.academies.length;
	sendToPhp("./superfoo/superfoo_updateScoreInfo.php", "GET", true, function() {}, {
		key: "academy",
		value: "00"
	});
	for (var i = 0; i < listLength; i += 1) {
		sendToPhp("./superfoo/superfoo_updateScoreInfo.php", "GET", true, function() {}, {
			key: "academy",
			value: acaList.academies[i].number
		})
	}
	alert("缓存已更新")
}