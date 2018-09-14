var maxtime = parseInt($('#maxtime').attr('v')) * 60;

function CountDown() {
	if(maxtime >= 0) {
		minutes = Math.floor(maxtime / 60);
		seconds = Math.floor(maxtime % 60);
		msg = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;距离考试结束还有" + minutes + "分" + seconds + "秒";
		$('#cddisplay').html(msg);
		maxtime -= 1
	} else {
		clearInterval(f);
		//alert('考试已结束，点击确定交卷。');
		onpapersubmit_timeoutver()
	}
}
f = setInterval("CountDown()", 1000);