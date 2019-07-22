$(".tron").mouseover(function(){
	// 修改这个TR里每个TD的背景色
	$(this).find("td").css('backgroundColor', '#DEE7F5');
});
$(".tron").mouseout(function(){
	// 修改这个TR里每个TD的背景色
	$(this).find("td").css('backgroundColor', '#FFF');
});