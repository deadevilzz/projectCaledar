<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Index Website</title>
<link rel="stylesheet" type="text/css" href="tables.css">
</head>
<form action="#" method="POST">
		<select name="pe" style="padding:5px;margin:20px;">
			<?php 
				require('config.php');
				$sql = "SELECT username FROM user";
				$query = mysql_query($sql);
				while($row = mysql_fetch_assoc($query))
				{
					foreach ($row as $cell) 
					{
						echo "<option value\"".$cell."\" >".$cell."</option>";
					}
				}
			?>
		</select>
		<input type="submit" value="save" id="submit2">
	</form>
<?php 
	require('config.php');
	if(isset($_POST['pe']))
	{	
		$result = selectDB($objConnect,$_POST['pe']);
		echo "<h1 style=\"margin-left:100px;\">".$_POST['pe']."</h1>";
	}
	if(isset($_POST['total'][1]))
	{	for($i=0;$i<5;$i++)
		if($_POST['total'][$i]>0&&$_POST['datepost'][$i]!=0&&$_POST['total'][$i]<=8)
		{
			$found = searchDB($_POST['datepost'][$i],$_POST['pe'],$objConnect);
			//echo $found;
			if($found)
			{
				/////////++++++++++++++++++++++++++++++++++++++++++++++++++++
				$sql = "UPDATE calender SET sr='".$_POST['sr'][$i]."',project='".$_POST['project'][$i]."',";
				$sql.= "all_leaves='".$_POST['all'][$i]."',remain='".$_POST['remain'][$i]."',meeting='".$_POST['meeting'][$i]."',";
				$sql.= "general='".$_POST['general'][$i]."',total='".$_POST['total'][$i]."',etc='".$_POST['etc'][$i]."',";
				$sql.= "comment='".$_POST['comment'][$i]."',PE='".$_POST['pe']."'";
				$sql.= " WHERE date='".$_POST['datepost'][$i]."' AND PE='".$_POST['pe']."'";
				//echo $sql;
				mysql_query($sql,$objConnect) or die("SQL Error");
			}
			else
			{
				/////////++++++++++++++++++++++++++++++++++++++++++++++++++++
				$sql = "INSERT INTO calender (sr,date,project,all_leaves,remain,meeting,general,total,comment,etc,pe)";
				$sql.= "VALUES('".$_POST['sr'][$i]."','".$_POST['datepost'][$i]."','".$_POST['project'][$i]."','".$_POST['all'][$i]."',";
				$sql.= "'".$_POST['remain'][$i]."','".$_POST['meeting'][$i]."','".$_POST['general'][$i]."','".$_POST['total'][$i]."',";
				$sql.= "'".$_POST['comment'][$i]."','".$_POST['etc'][$i]."','".$_POST['pe']."')";
				//echo $sql;
				mysql_query($sql,$objConnect) or die("SQL error");
			}
		}
		else if($_POST['total'][$i]>8)
	     { echo("<script> alert('total over 8 can not save haha');</script>"); }
	}

	function searchDB($datepost,$pe,$objConnect)
	{
		/////////++++++++++++++++++++++++++++++++++++++++++++++++++++
		$sql = "SELECT * FROM calender WHERE date='$datepost' AND PE='$pe'" ;
		//echo $sql;
		$query = mysql_query($sql,$objConnect);
		$row = mysql_fetch_assoc($query);
		$found  = empty($row) ? false : true;
		return $found;
	}
	//echo var_dump($result);
	function selectDB($objConnect,$pe)
	{	$result = array();
		$sql = "SELECT * FROM calender WHERE PE='".$pe."'";
		//echo $sql;
		$query = mysql_query($sql,$objConnect)or die('Sql error');
		while ($obResult = mysql_fetch_array($query)) 
		{
			array_push($result,$obResult);
		}
		return $result;
	}

	//echo $result['0']['date'];
	//echo var_dump($result);
/*$click=0;
$arDate = generate($click);
function generate($click)
{	$arDate = array(5);
	for($i=-2;$i<=2;$i++)
	{	$inputDate = date("Y-m-d");
		$date = add_date($inputDate,$click+$i,0,0);
		$strdate = date("d-l",strtotime($date));
		array_push($arDate, $strdate);
	}
	return $arDate;
}

function add_date($givendate,$day=0,$mth=0,$yr=0)
{
	$cd = strtotime($givendate);
	$newdate = date('Y-m-d', mktime(date('h',$cd),
	date('i',$cd), date('s',$cd), date('m',$cd)+$mth,
	date('d',$cd)+$day, date('Y',$cd)+$yr));
	return $newdate;
}*/
 ?>
<form action="#" method="POST">
<p><input class="submit" type="button" onclick="back();" value="<<<"><input class="submit" type="button" onclick="forward();" value=">>>"></p>
<table id="price-chart" cellspacing="0" cellpadding="0" align="center"> 
	<tbody>
	<tr class="even">
		<td class="left-col-captions">Activity</td>
		<td class="table-col-0" id="date1"></td>
		<td class="table-col-1" id="date2"></td>
		<td class="table-col-2" id="date3"></td>
		<td class="table-col-3" id="date4"></td>
		<td class="table-col-4" id="date5"></td>
	</tr>
 
	<tr class="odd">
		<td class="left-col-captions">SR</td>
		<td class="table-col-0"> 
			<p><textarea id="sr0" name="sr[]" value="55555" style="width:80px;height:20px;background-color:#c4e2ec;"/></textarea></p>
		</td> 
		<td class="table-col-1">
			<p><textarea id="sr1" name="sr[]" value="55555" style="width:80px;height:20px;background-color:#e9dbaa;"/></textarea></p>
		</td>
		<td class="table-col-2">
			<p><textarea id="sr2" name="sr[]" value="55555" style="width:80px;height:20px;background-color:#e9bfbf;"/></textarea></p>
		</td>
		<td class="table-col-3">
	 		<p><textarea id="sr3" name="sr[]" value="55555" style="width:80px;height:20px;background-color:#d4e0a9;"/></textarea></p>
	 	</td>
		<td class="table-col-4">
 			<p><textarea id="sr4" name="sr[]" value="55555" style="width:80px;height:20px;background-color:#d7c4ed;"/></textarea></p>
 		</td>
	</tr>
 
	<tr class="even">
		<td class="left-col-captions">Project</td>
		<td class="table-col-0">
			<p><textarea id="project0" name="project[]" value="" style="width:80px;height:20px;background-color:#e5e5e5;"/></textarea></p>
		</td>
		<td class="table-col-1">
			<p><textarea id="project1" name="project[]" value="" style="width:80px;height:20px;background-color:#e5e5e5;"/></textarea></p>
		</td>
		<td class="table-col-2">
			<p><textarea id="project2" name="project[]" value="" style="width:80px;height:20px;background-color:#e5e5e5;"/></textarea></p>
		</td>
		<td class="table-col-3">
			<p><textarea id="project3" name="project[]" value="" style="width:80px;height:20px;background-color:#e5e5e5;"/></textarea></p>
		</td>
		<td class="table-col-4">
			<p><textarea id="project4" name="project[]" value="" style="width:80px;height:20px;background-color:#e5e5e5;"/></textarea></p>
		</td>
	</tr>
 
	<tr class="odd">
		<td class="left-col-captions">All Leaves</td>
		<td class="table-col-0">
			<p><textarea id="all0" name="all[]" value="55555 " style="width:80px;height:20px;background-color:#c4e2ec;"/></textarea></p>
		</td>
		<td class="table-col-1">
			<p><textarea id="all1" name="all[]" value="55555 " style="width:80px;height:20px;background-color:#e9dbaa;"/></textarea></p>
		</td>
		<td class="table-col-2">
			<p><textarea id="all2" name="all[]" value="55555 " style="width:80px;height:20px;background-color:#e9bfbf;"/></textarea></p>
		</td>
		<td class="table-col-3">
			<p><textarea id="all3" name="all[]" value="55555 " style="width:80px;height:20px;background-color:#d4e0a9;"/></textarea></p>
		</td>
		<td class="table-col-4">
			<p><textarea id="all4" name="all[]" value="55555 " style="width:80px;height:20px;background-color:#d7c4ed;"/></textarea></p>
		</td>
	</tr>
 
	<tr class="even">
		<td class="left-col-captions">etc</td>
		<td class="table-col-0">
			<p><textarea id="etc0" name="etc[]" value="" style="width:80px;height:20px;background-color:#e5e5e5;"/></textarea></p>
		</td>
		<td class="table-col-1">
			<p><textarea id="etc1" name="etc[]" value="" style="width:80px;height:20px;background-color:#e5e5e5;"/></textarea></p>
		</td> 
		<td class="table-col-2">
			<p><textarea id="etc2" name="etc[]" value="" style="width:80px;height:20px;background-color:#e5e5e5;"/></textarea></p>
		</td>
		<td class="table-col-3">
			<p><textarea id="etc3" name="etc[]" value="" style="width:80px;height:20px;background-color:#e5e5e5;"/></textarea></p>
		</td> 
		<td class="table-col-4">
			<p><textarea id="etc4" name="etc[]" value="" style="width:80px;height:20px;background-color:#e5e5e5;"/></textarea></p>
		</td>
	</tr>
 
	<tr class="odd">
		<td class="left-col-captions">Remaining,Open/Dev</td>
		<td class="table-col-0">
			<p><textarea id="remain0" name="remain[]" value="55555 " style="width:80px;height:20px;background-color:#c4e2ec;"/></textarea></p>
		</td>
		<td class="table-col-1">
			<p><textarea id="remain1" name="remain[]" value="55555 " style="width:80px;height:20px;background-color:#e9dbaa;"/></textarea></p>
		</td>
		<td class="table-col-2">
			<p><textarea id="remain2" name="remain[]" value="55555 " style="width:80px;height:20px;background-color:#e9bfbf;"/></textarea></p>
		</td>
		<td class="table-col-3">
			<p><textarea id="remain3" name="remain[]" value="55555 " style="width:80px;height:20px;background-color:#d4e0a9;"/></textarea></p>
		</td>
		<td class="table-col-4">
			<p><textarea id="remain4" name="remain[]" value="55555 " style="width:80px;height:20px;background-color:#d7c4ed;"/></textarea></p>
		</td>
	</tr>


	<tr class="even">
		<td class="left-col-captions">Meeting</td>
		<td class="table-col-0">
			<p><textarea id="meeting0" name="meeting[]" value="" style="width:80px;height:20px;background-color:#e5e5e5;"/></textarea></p>
		</td>
		<td class="table-col-1">
			<p><textarea id="meeting1" name="meeting[]" value="" style="width:80px;height:20px;background-color:#e5e5e5;"/></textarea></p>
		</td> 
		<td class="table-col-2">
			<p><textarea id="meeting2" name="meeting[]" value="" style="width:80px;height:20px;background-color:#e5e5e5;"/></textarea></p>
		</td>
		<td class="table-col-3">
			<p><textarea id="meeting3" name="meeting[]" value="" style="width:80px;height:20px;background-color:#e5e5e5;"/></textarea></p>
		</td> 
		<td class="table-col-4">
			<p><textarea id="meeting4" name="meeting[]" value="" style="width:80px;height:20px;background-color:#e5e5e5;"/></textarea></p>
		</td>
	</tr>


	<tr class="odd">
 
	<td class="left-col-captions">General Management</td>
 
	<td class="table-col-0">
			<p><textarea id="general0" name="general[]" value="55555 " style="width:80px;height:20px;background-color:#c4e2ec;"/></textarea></p>
		</td>
		<td class="table-col-1">
			<p><textarea id="general1" name="general[]" value="55555 " style="width:80px;height:20px;background-color:#e9dbaa;"/></textarea></p>
		</td>
		<td class="table-col-2">
			<p><textarea id="general2" name="general[]" value="55555 " style="width:80px;height:20px;background-color:#e9bfbf;"/></textarea></p>
		</td>
		<td class="table-col-3">
			<p><textarea id="general3" name="general[]" value="55555 " style="width:80px;height:20px;background-color:#d4e0a9;"/></textarea></p>
		</td>
		<td class="table-col-4">
			<p><textarea id="general4" name="general[]" value="55555 " style="width:80px;height:20px;background-color:#d7c4ed;"/></textarea></p>
		</td>
	</tr>


	<tr class="even" style="height:100px;font-weight:bold;">
	<td class="left-col-captions">Total</td>
	<td class="table-col-0">
			<p><textarea id="total0" name="total[]" value="0" style="width:80px;height:20px;background-color:#e5e5e5;"/></textarea></p>
		</td>
		<td class="table-col-1">
			<p><textarea id="total1" name="total[]" value="0" style="width:80px;height:20px;background-color:#e5e5e5;"/></textarea></p>
		</td> 
		<td class="table-col-2">
			<p><textarea id="total2" name="total[]" value="0" style="width:80px;height:20px;background-color:#e5e5e5;"/></textarea></p>
		</td>
		<td class="table-col-3">
			<p><textarea id="total3" name="total[]" value="0" style="width:80px;height:20px;background-color:#e5e5e5;"/></textarea></p>
		</td> 
		<td class="table-col-4">
			<p><textarea id="total4" name="total[]" value="0" style="width:80px;height:20px;background-color:#e5e5e5;"/></textarea></p>
		</td>
 
	</tr>


	<tr class="odd">
	<td class="left-col-captions">Comment</td>
	<td class="table-col-0">
			<p><textarea id="comment0" name="comment[]" value="55555 " style="width:80px;height:20px;background-color:#c4e2ec;"/></textarea></p>
		</td>
		<td class="table-col-1">
			<p><textarea id="comment1" name="comment[]" value="55555 " style="width:80px;height:20px;background-color:#e9dbaa;"/></textarea></p>
		</td>
		<td class="table-col-2">
			<p><textarea id="comment2" name="comment[]" value="55555 " style="width:80px;height:20px;background-color:#e9bfbf;"/></textarea></p>
		</td>
		<td class="table-col-3">
			<p><textarea id="comment3" name="comment[]" value="55555 " style="width:80px;height:20px;background-color:#d4e0a9;"/></textarea></p>
		</td>
		<td class="table-col-4">
			<p><textarea id="comment4" name="comment[]" value="55555 " style="width:80px;height:20px;background-color:#d7c4ed;"/></textarea></p>
		</td>
	</tr>
	<tr class="even">
	<td class="left-col-captions">Total Week</td>
	<td class="table-col-0" id="totalweek"></td>
	<input type="hidden" name="datepost[]" id="datepost0" value="0" />
	<input type="hidden" name="datepost[]" id="datepost1" value="0" />
	<input type="hidden" name="datepost[]" id="datepost2" value="0" />
	<input type="hidden" name="datepost[]" id="datepost3" value="0" />
	<input type="hidden" name="datepost[]" id="datepost4" value="0" />
	<input type="hidden" name="pe" id="pe" value="<?=$_POST['pe']?>" />
	</tbody>
	</table>
	<p><input type="submit" value="save" class="submit"></p> 
</form>
	<script type="text/javascript"> 
	var click = 0;
	var arDate = [];
	var sr = [];var project = [];var all_leaves = [];var remain = [];var meeting = [];var general =[];var total=[];var comment=[];var date = [];var etc=[];var pe=[];
	/**
	* read all data from database
	**/
	<?php  
			$pe="";
			if(isset($_POST['pe'])) 
			{	$pe = $_POST['pe'];
				$result = array();
				//echo $pe;
				$sql = "SELECT * FROM calender WHERE PE='".$pe."'";
				$query = mysql_query($sql,$objConnect)or die ('sql error');$i=0;
				/////////++++++++++++++++++++++++++++++++++++++++++++++++++++
				while ($obResult = mysql_fetch_array($query)) 
				{  	$sr = empty($obResult['sr']) ? " " : $obResult['sr'];
					$project = empty($obResult['project']) ? " " : $obResult['project'];
					$date = empty($obResult['date']) ? " " : $obResult['date'];
					$all_leaves = empty($obResult['all_leaves']) ? " " : $obResult['all_leaves'];
					$remain = empty($obResult['remain']) ? " " : $obResult['remain'];
					$meeting = empty($obResult['meeting']) ? " " : $obResult['meeting'];
					$general =empty($obResult['general']) ? " " : $obResult['general'];
					$total = empty($obResult['total']) ? " " : $obResult['total'];
					$comment = empty($obResult['comment']) ? " " : $obResult['comment'];
					$etc = empty($obResult['etc']) ? " " : $obResult['etc'];
					
	?>
				sr.push('<?=$sr?>');
				project.push('<?=$project?>');
				date.push('<?=$date?>');
				all_leaves.push('<?=$all_leaves?>');
				remain.push('<?=$remain?>');
				meeting.push('<?=$meeting?>');
				general.push('<?=$general?>');
				total.push('<?=$total?>');
				comment.push('<?=$comment?>');
				etc.push('<?=$etc?>');
				
				
	<?php	} } ?>
	/**
	* Start Code read data finish 
	**/
	var arD = generate(click);
	renderAll(arD);
	inputdate(arD);
	setPE();
	function generate(click)
	{	var arDate = [];
		var arDate2 = [];
		for(var i=-2;i<3;i++)
		{	var adddate=[3,2,1,0,-1,-2,-3];
			var strday = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
			var strMonth = ['Jan','Feb','Mar','Apr','May','June','July','Aug','Sep','Oct','Nov','Dec'];
			var datetime = new Date();
			datetime = addDay(datetime,adddate[datetime.getDay()]);
			datetime = addDay(datetime,(click*7)+i);
			var strdate = datetime.getDate().toString()+" "+strday[datetime.getDay()]+" "+strMonth[datetime.getUTCMonth()];
			var intmonth = datetime.getUTCMonth()+1;
			var month = intmonth.toString().length==1 ? "0"+intmonth.toString() : intmonth.toString() ;
			var day = datetime.getUTCDate().toString().length==1 ? "0"+datetime.getUTCDate() : datetime.getUTCDate();
			var strdate2 = datetime.getUTCFullYear()+"-"+month+"-"+day;
			arDate.push(strdate);
			arDate2.push(strdate2);
		}
		document.all['date1'].innerHTML = arDate[0];
		document.all['date2'].innerHTML = arDate[1];
		document.all['date3'].innerHTML = arDate[2];
		document.all['date4'].innerHTML = arDate[3];
		document.all['date5'].innerHTML = arDate[4];
		return arDate2;
	}
		function addDay(datetime,day)
	{
		datetime.setDate(datetime.getDate()+day);
		return datetime;
	}
	
	function renderAll(arDate2)
	{
		for(var i=0;i<5;i++)
		{	var j=0;var found=false;
			//alert('test');
			while(j<sr.length&&!found)
			{	//alert(date[j]+" "+arDate2[i]);
				if(date[j]==arDate2[i])
				{
					/*document.all["sr"+i].innerHTML = sr[j];
					document.all["project"+i].innerHTML = project[j];
					document.all["all"+i].innerHTML = all_leaves[j];
					document.all["remain"+i].innerHTML = remain[j];
					document.all["meeting"+i].innerHTML = meeting[j];
					document.all["general"+i].innerHTML = general[j];
					document.all["total"+i].innerHTML = total[j];
					document.all["comment"+i].innerHTML = comment[j];
					document.all["etc"+i].innerHTML = etc[j];*/
					document.getElementById("sr"+i).value = sr[j];
					document.getElementById("project"+i).value = project[j];
					document.getElementById("all"+i).value = all_leaves[j];
					document.getElementById("remain"+i).value = remain[j];
					document.getElementById("meeting"+i).value = meeting[j];
					document.getElementById("general"+i).value = general[j];
					document.getElementById("total"+i).value = total[j]
					document.getElementById("comment"+i).value = comment[j];
					document.getElementById("etc"+i).value = etc[j];
					found = true;
				}
				else
				{
					j++;
				}
			}
		}
	}
	function renderBlank()
	{
		for(var i=0;i<5;i++)
		{
			/*document.all["sr"+i].innerHTML = "";
			document.all["project"+i].innerHTML = "";
			document.all["all"+i].innerHTML = "";
			document.all["remain"+i].innerHTML = "";
			document.all["meeting"+i].innerHTML = "";
			document.all["general"+i].innerHTML = "";
			document.all["total"+i].innerHTML = "";
			document.all["comment"+i].innerHTML = "";
			document.all["etc"+i].innerHTML = "";*/
			/*$("sr"+i).value = "";
			$("project"+i).value = "";
			$("all"+i).value = "";
			$("remain"+i).value = "";
			$("meeting"+i).value = "";
			$("general"+i).value = "";
			$("total"+i).value = "";
			$("comment"+i).value = "";
			$("etc"+i).value = "";*/
			document.getElementById("sr"+i).value = "";
			document.getElementById("project"+i).value = "";
			document.getElementById("all"+i).value = "";
			document.getElementById("remain"+i).value = "";
			document.getElementById("meeting"+i).value = "";
			document.getElementById("general"+i).value = "";
			document.getElementById("total"+i).value = "";
			document.getElementById("comment"+i).value = "";
			document.getElementById("etc"+i).value = "";
		}
	}
function setPE()
	{
		document.getElementById('pe').value = '<?=$pe?>';
	}
	function inputdate(arDate)
	{
		for(var i=0;i<5;i++)
		{
			document.getElementById('datepost'+i).value = arDate[i];
		}
	}
	function back(){
		click--;
		renderBlank();
		var arDate2 = generate(click);
		renderAll(arDate2);
		inputdate(arDate2);
		showTotalWeek();
	}
	function forward(){
		click++;
		renderBlank();
		var arDate2 = generate(click);
		renderAll(arDate2);
		inputdate(arDate2);
		showTotalWeek();
	}

	</script>
	<script type="text/javascript" src="jquery.js"></script>
	<script type="text/javascript" src="tables.js"></script>
</html>