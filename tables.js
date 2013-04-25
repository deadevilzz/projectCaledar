$(document).ready(function(){
	$('*').css({display:"none"});
	//$('.left-col-captions').fadeIn('fast');
	$('*').fadeIn('slow');
	loadAndClick();
	$('textarea').keyup(loadAndClick)
	//.blur(loadAndClick);
	//$('textarea').blur(loadAndClick);

});
function loadAndClick()
{	//$('*').css({display:"none"});
	//$('*').fadeIn('slow');
	var total = [0,0,0,0,0];
	for(var i=0;i<5;i++)
	{	var project =  $('#project'+i).val().toString().trim();
		var all = $('#all'+i).val().toString().trim();
		var etc = $('#etc'+i).val().toString().trim();
		var remain = $('#remain'+i).val().toString().trim();
		var meeting = $('#meeting'+i).val().toString().trim();
		var general = $('#general'+i).val().toString().trim();
		var sr = $('#sr'+i).val().toString().trim();
		if(sr!="") total[i]+=parseInt(sr);
		if(project!="") total[i]+=parseInt(project);
		if(all!="") total[i]+=parseInt(all);
		if(etc!="") total[i]+=parseInt(etc);
		if(remain!="") total[i]+=parseInt(remain);
		if(meeting!="") total[i]+=parseInt(meeting);
		if(general!="") total[i]+=parseInt(general);
		//alert(parseInt(project)+parseInt(all)+parseInt(etc)+parseInt(remain)+parseInt(meeting)+parseInt(general));
		$('#total'+i).val(total[i]);
		if((total[i])>8)
		{
			//document.getElementById('total'+i).style.background = "red";
			$('#total'+i).css({'background-color':'red'});
		}
		else
		{
			//document.getElementById('total'+i).style.background = "#e5e5e5";
			$('#total'+i).css({'background-color':"#e5e5e5"});
		}
	}
	showTotalWeek();
}
function showTotalWeek()
{
	var totalweek = 0;
	for(var i=0;i<5;i++)
	{	
		var total = $('#total'+i).val().toString().trim();
		if(total!="") totalweek+=parseInt(total);
	}
	$('#totalweek').html(totalweek);
	if(totalweek>40)
	{
		$('#totalweek').css({'background-color':'red'});
	}
	else 
	{
		$('#totalweek').css({'background-color':'#e5e5e5'})
	}
}
