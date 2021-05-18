<?php
session_start();
// version 3.3 html print
$thisprgm = 'antechcal.php';
$prtprgm =  "antechprint.php";
//$thisprgm = 'necrocal.php';     		 //testname
//$prtprgm =  "printneroquote.php";      //testname
$masterlog = 'rem3021.txt';
$_SESSION['formdata'] = '';
$entrytime = time();
$rand = rand(100, 999);
$fldfocus = 'document.whmtss1.element_2.focus();';
$prtlink = '<a target="_blank" style="color: #C0C0C0">'; // print link disabled
$qotlink = '';
$emplyid8 = '';
$hptname = '';
$antchid = '';
$wt = '';
$area = '';
$miles = '';
$final = 0;
$dispocost = 0;
$necrocost = 0;
$transport = 0;
$foo = "";
if (isset($_POST['clienttzo'])){
	$clienttzo = $_POST['clienttzo'];
	$hptname = trim($_POST['element_1']);
	$antchid = trim($_POST['element_2']);
	$wt = trim($_POST['element_3']);
	$area = trim($_POST['element_4']);
	$miles = trim($_POST['element_5']);
	$miles = round(abs($miles));
	$emplyid8 = trim($_POST['element_8']);
	$entrytime = $entrytime - ($clienttzo * 60);
	$formdate = gmdate("m-d-Y",$entrytime);
	$formtime = gmdate("h:i:s A",$entrytime);

	if (isset($_POST['submit'])){
		if ($hptname == ''){
			$foo = $foo . "<script type='text/javascript'>alert('A hospital name is required')</script>\n";
		}
		if ($antchid == ''){
			$foo = $foo . "<script type='text/javascript'>alert('The hospital ID number is required')</script>\n";
		}
		if ($emplyid8 == ''){
			$foo = $foo . "<script type='text/javascript'>alert('Customer service intials are required')</script>\n";
		}
		if ($wt == ''){
			$foo = $foo . "<script type='text/javascript'>alert('A weight is required')</script>\n";
		}
		if ($foo == '' ){
			$area = abs($area);
			$wt = abs($wt);
// NECROPSY CALCULATION:    input - $wt ****************************
			$necrocost = 2615;
			if ($wt <= 9) $necrocost = 1380;
			if (($wt >= 10) && ($wt <= 39)) $necrocost = 1525;
			if (($wt >= 40) && ($wt <= 59)) $necrocost = 1670;
			if (($wt >= 60) && ($wt <= 89)) $necrocost = 2035;
			if (($wt >= 90) && ($wt <= 114)) $necrocost = 2250;
//DISPOSAL CALCULATION: **********************************************
// find $dispocost  input - $wt *************************************
			if (($wt >= 0) && ($wt <= 10)) $dispocost = 165;
			if (($wt >= 10.1) && ($wt <= 20)) $dispocost = 180;
			if (($wt >= 20.1) && ($wt <= 50)) $dispocost = 200;
			if (($wt >= 50.1) && ($wt <= 70)) $dispocost = 235;
			if (($wt >= 70.1) && ($wt <= 150)) $dispocost = 255;
			if (($wt >= 150.1) && ($wt <= 250)) $dispocost = 320;
//TRANSPORT CALCULATION: **********************************************
// find area code group input - $area *************************************
			$acode1 = array("213","310","323","562","714","949","626","909","951","818","424","747");
			$acode2 = array("619","760","858");
			$acdetype = "N/A";
			if (in_array($area, $acode1)) $acdetype = "acode1";
			if (in_array($area, $acode2)) $acdetype = "acode2";
// find TRANSPORT  input - $acdetype, $miles ****************************
			$overage = $miles - 20;
			if (($acdetype == "acode1") && ($overage <= 0)) $transport = 125;
			if (($acdetype == "acode1") && ($overage > 0)) $transport = 125 + $overage;
			if (($acdetype == "acode2") && ($overage <= 0)) $transport = 175;
			if (($acdetype == "acode2") && ($overage > 0)) $transport = 175 + $overage;
			if (!(($area == 0) && ($miles == 0))) {
				if ($acdetype == "N/A"){
					$msg = 'Area Code:  '.$area .'\nLocation is not within our pick up area.\nShipping will be required.\nTransport cost N/A.';
// <!--
					$foo = $foo . "<script type='text/javascript'>alert(\"$msg\")</script>\n";
// -->
				} 
				if ($miles <= 0 && $acdetype <> "N/A"){
					$transport = 0;
					$dispocost = 0;
					$necrocost = 0;
					$msg = 'Transport miles required with this area code.';
// <!--
					$foo = $foo . "<script type='text/javascript'>alert(\"$msg\")</script>\n";
// -->
				}
			}
		}
		$transport = round($transport); 
		$necrocost = round($necrocost); 
		$dispocost = round($dispocost); 
		$final = $dispocost + $necrocost + $transport;
		$transport = '$'.number_format($transport,2);
		if ($transport == '$0.00') $transport = 'N/A';
		if ($wt == 0) $wt = '';
		if ($area == 0) $area = '';
		if ($miles == 0) $miles = '';
		if ($final <> 0 ){
			$tmp1 = '';
//			$tmp1 = $tmp1 . 'Date of Quote:           '. $formdate . " \n" ;	// mm-dd-yyyy
//			$tmp1 = $tmp1 . 'Time of Quote:           '. $formtime . " \n" ;		// h:mm am/pm
			$tmp1 = $tmp1 . 'Hospital:                '. $hptname . " \n" ;
			$tmp1 = $tmp1 . 'Antech ID:               '. $antchid . " \n" ;
			$tmp1 = $tmp1 . 'CS Rep:                  '. $emplyid8 . " \n" ;
			$tmp1 = $tmp1 . 'Weight:                  '. $wt . " \n" ;
			$tmp1 = $tmp1 . 'Full Necropsy:           '. '$'.number_format($necrocost,2) . " \n" ;
			$tmp1 = $tmp1 . 'Carcass Transport:       '. $transport . " \n" ;
			$tmp1 = $tmp1 . '  Area Code:             '. $area . " \n" ;
			$tmp1 = $tmp1 . '  Transport Miles:       '. $miles . " \n" ;
			$tmp1 = $tmp1 . 'Cremation:               '. '$'.number_format($dispocost,2) . " \n" ;
			$tmp1 = $tmp1 . 'Full Necropsy Total:     '. '$'.number_format($final,2) . " " ;
			$_SESSION['formdata'] = $tmp1;
			$_SESSION['clienttzo'] = $clienttzo;

// activate print link
			$prtlink = '<a target="_blank" style="color: #0000FF" href="'.$prtprgm.'?'.$rand.'">';
			$fldfocus = 'document.whmtss1.element_2.focus();'. "\n";

		}
	}			// end of submit
//  \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
//   \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\


// CHECK area code group input - $area 
	if (isset($_POST['chkarea'])){	
		$acode1 = array("213","310","323","562","714","949","626","909","951","818","424","747");
		$acode2 = array("619","760","858");
		$acdetype = "N/A";
		if (in_array($area, $acode1)) $acdetype = "acode1";
		if (in_array($area, $acode2)) $acdetype = "acode2";
		if ($acdetype == "N/A"){
			$msg = 'Area Code:  '.$area .'\nLocation is not within our pick up area.\nShipping will be required.';
// <!--
			$foo = $foo . "<script type='text/javascript'>alert(\"$msg\")</script>\n";
// -->
			$area = '';
			$miles = '';
			$transport = 0;
		}
		else
		{
			$fldfocus = 'document.whmtss1.element_5.focus();'. "\n";
			$msg = 'Location is within our pick up area.\nPlease enter the transport miles below.';
// <!--
			$foo = $foo . "<script type='text/javascript'>alert(\"$msg\")</script>\n";
// -->
		}		
	}			// end of CHECK area code
//  \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
//   \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\


// CHECK CS ID for history 
	if (isset($_POST['csreplogin'])){
		if ($emplyid8 == ''){
			$msg = 'Customer service intials are required';
// <!--
			$foo = $foo . "<script type='text/javascript'>alert(\"$msg\")</script>\n";
// -->
		}
		else
		{
// 		goto history here
			$fname = strtolower(str2hex($emplyid8)) ;
			$qotlink = $fname  . '.txt?' . $rand;
			
			if (file_exists($fname  . '.txt')) {
			$qotlink = 'gmyWin=window.open("'.$qotlink.'","_blank");'. "\n";
			$fldfocus = 'document.whmtss1.element_3.focus();'. "\n";
			} else {
			$qotlink = '';
			$fldfocus = 'document.whmtss1.element_8.focus();'. "\n";
			$msg = 'No Quote History Found.';
// <!--
			$foo = $foo . "<script type='text/javascript'>alert(\"$msg\")</script>\n";
// -->
			}

		}
	}			// end of CHECK CS ID
//  \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
//   \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\

	

	if (isset($_POST['fndantchid'])){
/*		 Antech ID Look up   "fndantchid"
		 Antech-fields in reverse = count - 10 then -14 until 4
		 Hospital: = Antech-field-1
		 Area Code: = Antech-field+5
		 Transport Miles: = Antech-field+6
*/
//	read in file array
		$fldfocus = 'document.whmtss1.element_8.focus();'. "\n";
		$tmp1 = strtolower($antchid);
		$file2 = $masterlog;
		$fdata = file($file2, FILE_IGNORE_NEW_LINES );
		$start = count($fdata) - 10;
		for ($i = $start; $i >= 4; $i=$i-14) {
			$aid = strtolower(trim(substr($fdata[$i],24)));
			if ($aid == $tmp1) break;
		}
		if ($i >= 4){ 
			$hptname = trim(substr($fdata[$i-1],24));
			$antchid = trim(substr($fdata[$i],24));
			$area = trim(substr($fdata[$i+5],24));
			$miles = trim(substr($fdata[$i+6],24));			
		}
		else
		{
			$msg = 'Antech ID currently not in database.';
// <!--
		$foo = $foo . "<script type='text/javascript'>alert(\"$msg\")</script>\n";
// -->
		}
	}			// end of Antech ID Look up
//  \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
//   \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\





}			// end of CHECK POST['clienttzo']
//  \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
//   \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\


 /* WHM MOD convert a string of hex values to an ascii string */
  function hex2str($hex) {
	  $hex = str_ireplace('-','%',$hex);  	  	
	  $hex = str_ireplace('%2d','-',$hex);  	  	
	  $hex = str_ireplace('%2e','.',$hex);  	  	
	  $str = urldecode ( $hex );
    return $str;
  }

 /* WHM MOD convert a string of ascii values to an hex string */
  function str2hex($str) {
	  $hex = urlencode($str);
	  $hex = str_ireplace('.','%2e',$hex);
	  $hex = str_ireplace('-','%2d',$hex);  	  	
	  $hex = str_ireplace('%','-',$hex);  	  	
	return  $hex; 
}



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Antech Necropsy Calculator</title>
<link rel="stylesheet" type="text/css" href="$view.css" media="all">
<script type="text/javascript" src="$view.js"></script>
<script type="text/javascript">
function openlog() {
  <?=$qotlink?>
  <?=$fldfocus?>
  return 
}
function stopRKey(evt) { 
	var evt = (evt) ? evt : ((event) ? event : null); 
	var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null); 
	if ((evt.keyCode == 13) && (node.type=="text"))  {return false;} 
} 
function tabE(obj,e){ 
	var e=(typeof event!='undefined')?window.event:e;// IE : Moz 
	if(e.keyCode==13){ 
		var ele = document.forms[0].elements; 
		for(var i=0;i<ele.length;i++){ 
			var q=(i==ele.length-1)?0:i+1;// if last element : if any other 
			if(obj==ele[i]){ele[q].focus();break} 
		} 
		return false; 
	} 
}
function dontSubmit (event){
	if (event.keyCode == 13) {
		return false;
	}
} 
//document.onkeypress = stopRKey; 
</script> 
</head>
<body id="main_body" OnLoad="openlog()">	
	<img id="top" src="top.png" alt="">
	<div id="form_container">
	
		<h1><a>Calculator</a></h1>
		<form id="form_705900" class="appnitro" name="whmtss1" method="post" action="<?=$thisprgm?>">
					<div class="form_description">
			<h2>Antech Necropsy Calculator</h2>
			<table border="0" width="95%">
				<tr>
					<td width="16%" align="center">
					<a target="_blank" style="color: #0000FF" href="http://www.mapquest.com/maps?form=directions&2a=17672 Cowan&2c=Irvine&2s=CA&2z=92614-6843&2y=US&2l=33.694823&2g=-117.858286">
					MapQuest</a></td>
					<td width="16%" align="center">
					<a target="_top" style="color: #0000FF" href="<?=$thisprgm?>?<?=$rand?>">
					Clear</a></td>
					<td width="16%" align="center">
					<a target="_blank" style="color: #0000FF" href="http://www.antechnecropsy.com/nfaqs.pdf">
					FAQ Sheet</a></td>
					<td width="16%" align="center">
					<a target="_blank" style="color: #0000FF" href="http://www.antechnecropsy.com/shippinginfo.pdf">
					Shipping Info</a></td>
					<td width="16%" align="center">
					<?=$prtlink?>Print Quote</a></td>
				</tr>
			</table>
		</div>						
			<ul >

		<div>
 			<table border="0" width="98%" bgcolor="#0099FF">
				<tr>
					<td width="25%"><b>Necropsy Cost</b></td>
					<td width="25%"><b>Transport Cost<br>(Optional)</b></td>
					<td width="35%"><b>Private Cremation Cost<br>(Optional)</b></td>
					<td width="18%"><b>Total Cost</b></td>
				</tr>
				<tr>
					<td width="25%" style="font-weight: bold"><?='$'.number_format($necrocost,2)?></td>
					<td width="25%" style="font-weight: bold"><?=$transport?></td>
					<td width="35%" style="font-weight: bold"><?='$'.number_format($dispocost,2)?></td>
					<td width="18%" style="font-weight: bold"><?='$'.number_format($final,2)?></td>
				</tr>
			</table>
		
					<li id="li_1" >
		<label class="description" for="element_1">Hospital:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input id="element_1" name="element_1" class="element text large" type="text" maxlength="170" onkeypress="return tabE(this,event)" value="<?=$hptname?>"/>
 </label>		</li>		</div> 
		<div>
		<li id="li_2" >
		<label class="description" for="element_2">Antech ID:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input id="element_2" name="element_2" class="element text medium" type="text" maxlength="60" onkeypress="return tabE(this,event)" value="<?=$antchid?>"/>
<input id="saveForm" class="button_text" type="submit" name="fndantchid" value="ID Lookup" />
</label>		</li>		</div> 
		<div>
		<li id="li_8" >
		<label class="description" for="element_8">CS Rep:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input id="element_8" name="element_8" class="element text small" type="text" maxlength="60" onkeypress="return tabE(this,event)" value="<?=$emplyid8?>"/>
</label>		</li>		</div> 
		<div>
		<li id="li_3" >
		<label class="description" for="element_3">Weight:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input id="element_3" name="element_3" class="element text small" type="text" maxlength="3" onkeypress="return tabE(this,event)" value="<?=$wt?>"/>
</label>		</li>		</div> 

		
		<div> 
		<li id="li_4" >
		<label class="description" for="element_4">Area Code:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input id="element_4" name="element_4" class="element text small" type="text" maxlength="3" onkeypress="return tabE(this,event)" value="<?=$area?>"/>
<input id="saveForm" class="button_text" type="submit" name="chkarea" value="Check Area Code" />
</label>		</li>		</div> 
		<div>
		<li id="li_5" >
		<label class="description" for="element_5">Transport Miles:&nbsp;
			<input id="element_5" name="element_5" class="element text small" type="text" maxlength="3" onkeypress="return dontSubmit(event);" value="<?=$miles?>"/>&nbsp;
<a target="_blank" href="http://www.mapquest.com/maps?form=directions&2a=17672 Cowan&2c=Irvine&2s=CA&2z=92614-6843&2y=US&2l=33.694823&2g=-117.858286">
		MapQuest</a>
</label>		</li>		</div> 
			
					<li class="buttons">
<input type="hidden" name="form_id" value="705900" />
<p style="text-align: center">
<script type="text/javascript">
d = new Date();
tzo = d.getTimezoneOffset();
document.write('<input type="hidden" value="'+tzo+'" name="clienttzo" />');
</script>
<input id="saveForm" class="button_text" type="submit" name="submit" value="Calculate" />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input id="saveForm" class="button_text" type="submit" name="csreplogin" value="Quote History" style="font-size: 10pt" />
		</li>
			</ul>
		</form>	
		<div id="footer">
			3.3
		</div>
	</div>
	<?=$foo?>
	<img id="bottom" src="bottom.png" alt="">
	</body>
</html>