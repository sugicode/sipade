<?php

// LEMBAR KTP
	$rule_std = mysql_query("select * from pengaturan where id='2'");
	$rule=mysql_fetch_array($rule_std);
	$rule_cap = mysql_query("select * from pengaturan where id='1'");
	$rulecap=mysql_fetch_array($rule_cap);
	$set_pejabat = mysql_query("select * from pejabat where id='$_POST[ybt]' ");
	$setpejabat=mysql_fetch_array($set_pejabat);
	$RULEDESA = $rule['desa'];
	$RULEKODEDESA = $rule['kodedesa'];
	$RULEKEC = $rule['kecamatan'];
	$RULEKAB = $rule['kabupaten'];
	$RULEKODEKAB = $rule['kodekab'];
	$RULEPROV = $rule['provinsi'];
	$RULEALMT = $rule['alamat'];
	$RULEKODEPOS = $rule['kodepos'];
	
	$RULECAPKODE = $rulecap['kodekab'];
	$RULECAPDESA = $rulecap['desa'];
	$RULEKODEDESA = $rulecap['kodedesa'];
	$RULECAPKEC = $rulecap['kecamatan'];
	$RULEKODEKEC =  substr($RULECAPKODE ,4,4);
	$RULECAPKAB = $rulecap['kabupaten'];
	$RULEKODEKAB =  substr($RULECAPKODE ,2,2);
	$RULECAPPROV = $rulecap['provinsi'];
	$RULEKODEPROV = substr($RULECAPKODE ,0,2);
	$RULECAPALMT = $rulecap['alamat'];
	$RULECAPKODEPOS = $rulecap['kodepos'];

	
	if ($_POST[tglbuat]!==''){ // menentukan kewarganegaraan (1=WNI)
$TGLBUAT = $_POST['tglbuat'];
		}
		else {
		$TGLBUAT = date('d-m-Y');
		}
  $TGLBUAT = tgl_mod1($TGLBUAT);
  
$NAMA = $_POST['nama'];
$NAMA = ubah_huruf_ke_besar($NAMA);
$NOID = preg_replace('/\D/', '', $_POST['noid']);
$NOKK = preg_replace('/\D/', '', $_POST['nokk']);
$NAMAKK = ubah_huruf_ke_besar($_POST['skpdkk']);
$RT = $_POST['rt'];
$RW	 = $_POST['rw']; 
$ALMT = ubah_huruf_ke_besar($_POST['almt']);
$DESA = ubah_huruf_ke_besar($_POST['desa']);
$KEC = ubah_huruf_ke_besar($_POST['kec']);
$KAB = ubah_huruf_ke_besar($_POST['kab']);
$PROV = $RULECAPPROV;
$ddt_KKYGPD = $_POST['skpdnokkp'];
$ddt_NOKK = $_POST['nokktujuan'];
$ddt_NIKKK = $_POST['nikkktujuan'];
$ddt_NMKK = ubah_huruf_ke_besar($_POST['nmkktujuan']);  


if($ddt_KKYGPD=='1'){ //numpang kk
$ddt_NOKK = $ddt_NOKK;
$ddt_NIKKK = $ddt_NOKK;
$ddt_NMKK = $ddt_NMKK;  
}
else {
$ddt_NOKK = ".";
$ddt_NIKKK =  ".";
$ddt_NMKK =  ".";
}


  $TGLPINDAH = $_POST['skpdrtglpindah'];
  	
  $THNP = substr($TGLPINDAH ,6,4); 
  $BLNP = substr($TGLPINDAH ,3,2); 
  $TGLP = substr($TGLPINDAH ,0,2); 

$ddt_ANTAR = $_POST['skpdkp'];
if($ddt_ANTAR=='1'){ //dalam 1 desa
$ddt_ALMT = ubah_huruf_ke_besar($_POST['skpdalmt']);
$ddt_RT = $_POST['skpdrt'];
$ddt_RW = $_POST['skpdrw'];
$ddt_DESA = $RULECAPDESA;
$ddt_KEC = $RULECAPKEC;
$ddt_KAB = $RULECAPKAB;
$ddt_PROV = $RULECAPPROV;
}
if($ddt_ANTAR=='2'){ //dalam 1 kecamatan
$ddt_ALMT = ubah_huruf_ke_besar($_POST['skpdalmt']);
$ddt_RT = $_POST['skpdrt'];
$ddt_RW = $_POST['skpdrw'];
$ddt_DESA = ubah_huruf_ke_besar($_POST['skpddesa']);
$ddt_KEC = $RULECAPKEC;
$ddt_KAB = $RULECAPKAB;
$ddt_PROV = $RULECAPPROV;
}
if($ddt_ANTAR=='3'){ //dalam 1 kabupaten
$ddt_ALMT = ubah_huruf_ke_besar($_POST['skpdalmt']);
$ddt_RT = $_POST['skpdrt'];
$ddt_RW = $_POST['skpdrw'];
$ddt_DESA = ubah_huruf_ke_besar($_POST['skpddesa']);
$ddt_KEC = ubah_huruf_ke_besar($_POST['skpdkec']);
$ddt_KAB = $RULECAPKAB;
$ddt_PROV = $RULECAPPROV;
}
if($ddt_ANTAR=='4'){ //dalam 1 provinsi
$ddt_ALMT = ubah_huruf_ke_besar($_POST['skpdalmt']);
$ddt_RT = $_POST['skpdrt'];
$ddt_RW = $_POST['skpdrw'];
$ddt_DESA = ubah_huruf_ke_besar($_POST['skpddesa']);
$ddt_KEC = ubah_huruf_ke_besar($_POST['skpdkec']);
$ddt_KAB = ubah_huruf_ke_besar($_POST['skpdkab']);
$ddt_PROV = $RULECAPPROV;
}
if($ddt_ANTAR=='4'){ //antar provinsi
$ddt_ALMT = ubah_huruf_ke_besar($_POST['skpdalmt']);
$ddt_RT = $_POST['skpdrt'];
$ddt_RW = $_POST['skpdrw'];
$ddt_DESA = ubah_huruf_ke_besar($_POST['skpddesa']);
$ddt_KEC = ubah_huruf_ke_besar($_POST['skpdkec']);
$ddt_KAB = ubah_huruf_ke_besar($_POST['skpdkab']);
$ddt_PROV = ubah_huruf_ke_besar($_POST['skpdprov']);
}
?>


<?php

		function changeCell($jmlkolom,$text,$attr1,$attr2,$attr3){
			$nm = "$text";
			$count = mb_strlen($nm);
			$nm = (string)$nm; // convert into a string
			$arr = str_split($nm, "1"); // break string in 3 character sets
			$ino=1;
			foreach ($arr as $hrf) {  
				$hrf=ucwords(strtolower($hrf));  
				$echo.="<td".$attr1.">
						    <p".$attr2."><span".$attr3.">".$hrf."</span><o:p></o:p></p>
							</td>";
				
				$ino++;		
				} 

			if ($count< $jmlkolom){
			$jml = $jmlkolom-$count;
			}
			for ($i=1; $i<=$jml; $i++){
					$echo.="<td".$attr1.">
						    <p".$attr2."><span".$attr3.">&nbsp;</span><o:p></o:p></p>
							</td>"	; 
			}
		return $echo; 
		}
		
		
		function changeCellR($jmlkolom,$text,$attr1,$attr2,$attr3){
			$nm = "$text";
			$count = mb_strlen($nm);
			$nm = (string)$nm; // convert into a string
			$arr = str_split($nm, "1"); // break string in 3 character sets
			$ino=1;
			
			if ($count< $jmlkolom){
			$jml = $jmlkolom-$count;
			}
			for ($i=1; $i<=$jml; $i++){
					$echo.="<td".$attr1.">
						    <p".$attr2."><span".$attr3.">0</span><o:p></o:p></p>
							</td>"	; 
			}
			foreach ($arr as $hrf) {  
				$hrf=ucwords(strtolower($hrf));  
				$echo.="<td".$attr1.">
						    <p".$attr2."><span".$attr3.">".$hrf."</span><o:p></o:p></p>
							</td>";
				
				$ino++;		
				} 

		return $echo; 
		}
		
		
		
?>
<html xmlns:v="urn:schemas-microsoft-com:vml"
xmlns:o="urn:schemas-microsoft-com:office:office"
xmlns:w="urn:schemas-microsoft-com:office:word"
xmlns:m="http://schemas.microsoft.com/office/2004/12/omml"
xmlns="http://www.w3.org/TR/REC-html40">

<head>
<meta http-equiv=Content-Type content="text/html; charset=windows-1252">
<!--
<meta name=ProgId content=Word.Document>
<meta name=Generator content="Microsoft Word 15">
<meta name=Originator content="Microsoft Word 15">
<link rel=File-List href="F.1-32_NONGRID%20-%20Copy_files/filelist.xml">
<link rel=themeData href="F.1-32_NONGRID%20-%20Copy_files/themedata.thmx">
<link rel=colorSchemeMapping
href="F.1-32_NONGRID%20-%20Copy_files/colorschememapping.xml">
-->
<!--[if gte mso 9]><xml>
 <w:WordDocument>
  <w:View>Print</w:View>
  <w:Zoom>110</w:Zoom>
  <w:SpellingState>Clean</w:SpellingState>
  <w:GrammarState>Clean</w:GrammarState>
  <w:TrackMoves>false</w:TrackMoves>
  <w:TrackFormatting/>
  <w:ValidateAgainstSchemas/>
  <w:SaveIfXMLInvalid>false</w:SaveIfXMLInvalid>
  <w:IgnoreMixedContent>false</w:IgnoreMixedContent>
  <w:AlwaysShowPlaceholderText>false</w:AlwaysShowPlaceholderText>
  <w:DoNotPromoteQF/>
  <w:LidThemeOther>IN</w:LidThemeOther>
  <w:LidThemeAsian>X-NONE</w:LidThemeAsian>
  <w:LidThemeComplexScript>X-NONE</w:LidThemeComplexScript>
  <w:Compatibility>
   <w:BreakWrappedTables/>
   <w:SplitPgBreakAndParaMark/>
  </w:Compatibility>
  <w:BrowserLevel>MicrosoftInternetExplorer4</w:BrowserLevel>
  <m:mathPr>
   <m:mathFont m:val="Cambria Math"/>
   <m:brkBin m:val="before"/>
   <m:brkBinSub m:val="&#45;-"/>
   <m:smallFrac m:val="off"/>
   <m:dispDef/>
   <m:lMargin m:val="0"/>
   <m:rMargin m:val="0"/>
   <m:defJc m:val="centerGroup"/>
   <m:wrapIndent m:val="1440"/>
   <m:intLim m:val="subSup"/>
   <m:naryLim m:val="undOvr"/>
  </m:mathPr></w:WordDocument>
</xml><![endif]--><!--[if gte mso 9]><xml>
 <w:LatentStyles DefLockedState="false" DefUnhideWhenUsed="false"
  DefSemiHidden="false" DefQFormat="false" DefPriority="99"
  LatentStyleCount="371">
  <w:LsdException Locked="false" Priority="0" QFormat="true" Name="Normal"/>
  <w:LsdException Locked="false" Priority="9" QFormat="true" Name="heading 1"/>
  <w:LsdException Locked="false" Priority="9" SemiHidden="true"
   UnhideWhenUsed="true" QFormat="true" Name="heading 2"/>
  <w:LsdException Locked="false" Priority="9" SemiHidden="true"
   UnhideWhenUsed="true" QFormat="true" Name="heading 3"/>
  <w:LsdException Locked="false" Priority="9" SemiHidden="true"
   UnhideWhenUsed="true" QFormat="true" Name="heading 4"/>
  <w:LsdException Locked="false" Priority="9" SemiHidden="true"
   UnhideWhenUsed="true" QFormat="true" Name="heading 5"/>
  <w:LsdException Locked="false" Priority="9" SemiHidden="true"
   UnhideWhenUsed="true" QFormat="true" Name="heading 6"/>
  <w:LsdException Locked="false" Priority="9" SemiHidden="true"
   UnhideWhenUsed="true" QFormat="true" Name="heading 7"/>
  <w:LsdException Locked="false" Priority="9" SemiHidden="true"
   UnhideWhenUsed="true" QFormat="true" Name="heading 8"/>
  <w:LsdException Locked="false" Priority="9" SemiHidden="true"
   UnhideWhenUsed="true" QFormat="true" Name="heading 9"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="index 1"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="index 2"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="index 3"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="index 4"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="index 5"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="index 6"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="index 7"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="index 8"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="index 9"/>
  <w:LsdException Locked="false" Priority="39" SemiHidden="true"
   UnhideWhenUsed="true" Name="toc 1"/>
  <w:LsdException Locked="false" Priority="39" SemiHidden="true"
   UnhideWhenUsed="true" Name="toc 2"/>
  <w:LsdException Locked="false" Priority="39" SemiHidden="true"
   UnhideWhenUsed="true" Name="toc 3"/>
  <w:LsdException Locked="false" Priority="39" SemiHidden="true"
   UnhideWhenUsed="true" Name="toc 4"/>
  <w:LsdException Locked="false" Priority="39" SemiHidden="true"
   UnhideWhenUsed="true" Name="toc 5"/>
  <w:LsdException Locked="false" Priority="39" SemiHidden="true"
   UnhideWhenUsed="true" Name="toc 6"/>
  <w:LsdException Locked="false" Priority="39" SemiHidden="true"
   UnhideWhenUsed="true" Name="toc 7"/>
  <w:LsdException Locked="false" Priority="39" SemiHidden="true"
   UnhideWhenUsed="true" Name="toc 8"/>
  <w:LsdException Locked="false" Priority="39" SemiHidden="true"
   UnhideWhenUsed="true" Name="toc 9"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Normal Indent"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="footnote text"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="annotation text"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="header"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="footer"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="index heading"/>
  <w:LsdException Locked="false" Priority="35" SemiHidden="true"
   UnhideWhenUsed="true" QFormat="true" Name="caption"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="table of figures"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="envelope address"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="envelope return"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="footnote reference"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="annotation reference"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="line number"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="page number"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="endnote reference"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="endnote text"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="table of authorities"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="macro"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="toa heading"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="List"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="List Bullet"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="List Number"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="List 2"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="List 3"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="List 4"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="List 5"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="List Bullet 2"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="List Bullet 3"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="List Bullet 4"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="List Bullet 5"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="List Number 2"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="List Number 3"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="List Number 4"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="List Number 5"/>
  <w:LsdException Locked="false" Priority="10" QFormat="true" Name="Title"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Closing"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Signature"/>
  <w:LsdException Locked="false" Priority="1" SemiHidden="true"
   UnhideWhenUsed="true" Name="Default Paragraph Font"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Body Text"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Body Text Indent"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="List Continue"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="List Continue 2"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="List Continue 3"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="List Continue 4"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="List Continue 5"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Message Header"/>
  <w:LsdException Locked="false" Priority="11" QFormat="true" Name="Subtitle"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Salutation"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Date"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Body Text First Indent"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Body Text First Indent 2"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Note Heading"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Body Text 2"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Body Text 3"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Body Text Indent 2"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Body Text Indent 3"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Block Text"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Hyperlink"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="FollowedHyperlink"/>
  <w:LsdException Locked="false" Priority="22" QFormat="true" Name="Strong"/>
  <w:LsdException Locked="false" Priority="20" QFormat="true" Name="Emphasis"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Document Map"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Plain Text"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="E-mail Signature"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="HTML Top of Form"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="HTML Bottom of Form"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Normal (Web)"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="HTML Acronym"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="HTML Address"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="HTML Cite"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="HTML Code"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="HTML Definition"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="HTML Keyboard"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="HTML Preformatted"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="HTML Sample"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="HTML Typewriter"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="HTML Variable"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Normal Table"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="annotation subject"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="No List"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Outline List 1"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Outline List 2"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Outline List 3"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Simple 1"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Simple 2"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Simple 3"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Classic 1"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Classic 2"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Classic 3"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Classic 4"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Colorful 1"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Colorful 2"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Colorful 3"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Columns 1"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Columns 2"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Columns 3"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Columns 4"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Columns 5"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Grid 1"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Grid 2"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Grid 3"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Grid 4"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Grid 5"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Grid 6"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Grid 7"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Grid 8"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table List 1"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table List 2"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table List 3"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table List 4"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table List 5"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table List 6"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table List 7"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table List 8"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table 3D effects 1"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table 3D effects 2"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table 3D effects 3"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Contemporary"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Elegant"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Professional"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Subtle 1"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Subtle 2"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Web 1"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Web 2"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Web 3"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Balloon Text"/>
  <w:LsdException Locked="false" Priority="39" Name="Table Grid"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Theme"/>
  <w:LsdException Locked="false" SemiHidden="true" Name="Placeholder Text"/>
  <w:LsdException Locked="false" Priority="1" QFormat="true" Name="No Spacing"/>
  <w:LsdException Locked="false" Priority="60" Name="Light Shading"/>
  <w:LsdException Locked="false" Priority="61" Name="Light List"/>
  <w:LsdException Locked="false" Priority="62" Name="Light Grid"/>
  <w:LsdException Locked="false" Priority="63" Name="Medium Shading 1"/>
  <w:LsdException Locked="false" Priority="64" Name="Medium Shading 2"/>
  <w:LsdException Locked="false" Priority="65" Name="Medium List 1"/>
  <w:LsdException Locked="false" Priority="66" Name="Medium List 2"/>
  <w:LsdException Locked="false" Priority="67" Name="Medium Grid 1"/>
  <w:LsdException Locked="false" Priority="68" Name="Medium Grid 2"/>
  <w:LsdException Locked="false" Priority="69" Name="Medium Grid 3"/>
  <w:LsdException Locked="false" Priority="70" Name="Dark List"/>
  <w:LsdException Locked="false" Priority="71" Name="Colorful Shading"/>
  <w:LsdException Locked="false" Priority="72" Name="Colorful List"/>
  <w:LsdException Locked="false" Priority="73" Name="Colorful Grid"/>
  <w:LsdException Locked="false" Priority="60" Name="Light Shading Accent 1"/>
  <w:LsdException Locked="false" Priority="61" Name="Light List Accent 1"/>
  <w:LsdException Locked="false" Priority="62" Name="Light Grid Accent 1"/>
  <w:LsdException Locked="false" Priority="63" Name="Medium Shading 1 Accent 1"/>
  <w:LsdException Locked="false" Priority="64" Name="Medium Shading 2 Accent 1"/>
  <w:LsdException Locked="false" Priority="65" Name="Medium List 1 Accent 1"/>
  <w:LsdException Locked="false" SemiHidden="true" Name="Revision"/>
  <w:LsdException Locked="false" Priority="34" QFormat="true"
   Name="List Paragraph"/>
  <w:LsdException Locked="false" Priority="29" QFormat="true" Name="Quote"/>
  <w:LsdException Locked="false" Priority="30" QFormat="true"
   Name="Intense Quote"/>
  <w:LsdException Locked="false" Priority="66" Name="Medium List 2 Accent 1"/>
  <w:LsdException Locked="false" Priority="67" Name="Medium Grid 1 Accent 1"/>
  <w:LsdException Locked="false" Priority="68" Name="Medium Grid 2 Accent 1"/>
  <w:LsdException Locked="false" Priority="69" Name="Medium Grid 3 Accent 1"/>
  <w:LsdException Locked="false" Priority="70" Name="Dark List Accent 1"/>
  <w:LsdException Locked="false" Priority="71" Name="Colorful Shading Accent 1"/>
  <w:LsdException Locked="false" Priority="72" Name="Colorful List Accent 1"/>
  <w:LsdException Locked="false" Priority="73" Name="Colorful Grid Accent 1"/>
  <w:LsdException Locked="false" Priority="60" Name="Light Shading Accent 2"/>
  <w:LsdException Locked="false" Priority="61" Name="Light List Accent 2"/>
  <w:LsdException Locked="false" Priority="62" Name="Light Grid Accent 2"/>
  <w:LsdException Locked="false" Priority="63" Name="Medium Shading 1 Accent 2"/>
  <w:LsdException Locked="false" Priority="64" Name="Medium Shading 2 Accent 2"/>
  <w:LsdException Locked="false" Priority="65" Name="Medium List 1 Accent 2"/>
  <w:LsdException Locked="false" Priority="66" Name="Medium List 2 Accent 2"/>
  <w:LsdException Locked="false" Priority="67" Name="Medium Grid 1 Accent 2"/>
  <w:LsdException Locked="false" Priority="68" Name="Medium Grid 2 Accent 2"/>
  <w:LsdException Locked="false" Priority="69" Name="Medium Grid 3 Accent 2"/>
  <w:LsdException Locked="false" Priority="70" Name="Dark List Accent 2"/>
  <w:LsdException Locked="false" Priority="71" Name="Colorful Shading Accent 2"/>
  <w:LsdException Locked="false" Priority="72" Name="Colorful List Accent 2"/>
  <w:LsdException Locked="false" Priority="73" Name="Colorful Grid Accent 2"/>
  <w:LsdException Locked="false" Priority="60" Name="Light Shading Accent 3"/>
  <w:LsdException Locked="false" Priority="61" Name="Light List Accent 3"/>
  <w:LsdException Locked="false" Priority="62" Name="Light Grid Accent 3"/>
  <w:LsdException Locked="false" Priority="63" Name="Medium Shading 1 Accent 3"/>
  <w:LsdException Locked="false" Priority="64" Name="Medium Shading 2 Accent 3"/>
  <w:LsdException Locked="false" Priority="65" Name="Medium List 1 Accent 3"/>
  <w:LsdException Locked="false" Priority="66" Name="Medium List 2 Accent 3"/>
  <w:LsdException Locked="false" Priority="67" Name="Medium Grid 1 Accent 3"/>
  <w:LsdException Locked="false" Priority="68" Name="Medium Grid 2 Accent 3"/>
  <w:LsdException Locked="false" Priority="69" Name="Medium Grid 3 Accent 3"/>
  <w:LsdException Locked="false" Priority="70" Name="Dark List Accent 3"/>
  <w:LsdException Locked="false" Priority="71" Name="Colorful Shading Accent 3"/>
  <w:LsdException Locked="false" Priority="72" Name="Colorful List Accent 3"/>
  <w:LsdException Locked="false" Priority="73" Name="Colorful Grid Accent 3"/>
  <w:LsdException Locked="false" Priority="60" Name="Light Shading Accent 4"/>
  <w:LsdException Locked="false" Priority="61" Name="Light List Accent 4"/>
  <w:LsdException Locked="false" Priority="62" Name="Light Grid Accent 4"/>
  <w:LsdException Locked="false" Priority="63" Name="Medium Shading 1 Accent 4"/>
  <w:LsdException Locked="false" Priority="64" Name="Medium Shading 2 Accent 4"/>
  <w:LsdException Locked="false" Priority="65" Name="Medium List 1 Accent 4"/>
  <w:LsdException Locked="false" Priority="66" Name="Medium List 2 Accent 4"/>
  <w:LsdException Locked="false" Priority="67" Name="Medium Grid 1 Accent 4"/>
  <w:LsdException Locked="false" Priority="68" Name="Medium Grid 2 Accent 4"/>
  <w:LsdException Locked="false" Priority="69" Name="Medium Grid 3 Accent 4"/>
  <w:LsdException Locked="false" Priority="70" Name="Dark List Accent 4"/>
  <w:LsdException Locked="false" Priority="71" Name="Colorful Shading Accent 4"/>
  <w:LsdException Locked="false" Priority="72" Name="Colorful List Accent 4"/>
  <w:LsdException Locked="false" Priority="73" Name="Colorful Grid Accent 4"/>
  <w:LsdException Locked="false" Priority="60" Name="Light Shading Accent 5"/>
  <w:LsdException Locked="false" Priority="61" Name="Light List Accent 5"/>
  <w:LsdException Locked="false" Priority="62" Name="Light Grid Accent 5"/>
  <w:LsdException Locked="false" Priority="63" Name="Medium Shading 1 Accent 5"/>
  <w:LsdException Locked="false" Priority="64" Name="Medium Shading 2 Accent 5"/>
  <w:LsdException Locked="false" Priority="65" Name="Medium List 1 Accent 5"/>
  <w:LsdException Locked="false" Priority="66" Name="Medium List 2 Accent 5"/>
  <w:LsdException Locked="false" Priority="67" Name="Medium Grid 1 Accent 5"/>
  <w:LsdException Locked="false" Priority="68" Name="Medium Grid 2 Accent 5"/>
  <w:LsdException Locked="false" Priority="69" Name="Medium Grid 3 Accent 5"/>
  <w:LsdException Locked="false" Priority="70" Name="Dark List Accent 5"/>
  <w:LsdException Locked="false" Priority="71" Name="Colorful Shading Accent 5"/>
  <w:LsdException Locked="false" Priority="72" Name="Colorful List Accent 5"/>
  <w:LsdException Locked="false" Priority="73" Name="Colorful Grid Accent 5"/>
  <w:LsdException Locked="false" Priority="60" Name="Light Shading Accent 6"/>
  <w:LsdException Locked="false" Priority="61" Name="Light List Accent 6"/>
  <w:LsdException Locked="false" Priority="62" Name="Light Grid Accent 6"/>
  <w:LsdException Locked="false" Priority="63" Name="Medium Shading 1 Accent 6"/>
  <w:LsdException Locked="false" Priority="64" Name="Medium Shading 2 Accent 6"/>
  <w:LsdException Locked="false" Priority="65" Name="Medium List 1 Accent 6"/>
  <w:LsdException Locked="false" Priority="66" Name="Medium List 2 Accent 6"/>
  <w:LsdException Locked="false" Priority="67" Name="Medium Grid 1 Accent 6"/>
  <w:LsdException Locked="false" Priority="68" Name="Medium Grid 2 Accent 6"/>
  <w:LsdException Locked="false" Priority="69" Name="Medium Grid 3 Accent 6"/>
  <w:LsdException Locked="false" Priority="70" Name="Dark List Accent 6"/>
  <w:LsdException Locked="false" Priority="71" Name="Colorful Shading Accent 6"/>
  <w:LsdException Locked="false" Priority="72" Name="Colorful List Accent 6"/>
  <w:LsdException Locked="false" Priority="73" Name="Colorful Grid Accent 6"/>
  <w:LsdException Locked="false" Priority="19" QFormat="true"
   Name="Subtle Emphasis"/>
  <w:LsdException Locked="false" Priority="21" QFormat="true"
   Name="Intense Emphasis"/>
  <w:LsdException Locked="false" Priority="31" QFormat="true"
   Name="Subtle Reference"/>
  <w:LsdException Locked="false" Priority="32" QFormat="true"
   Name="Intense Reference"/>
  <w:LsdException Locked="false" Priority="33" QFormat="true" Name="Book Title"/>
  <w:LsdException Locked="false" Priority="37" SemiHidden="true"
   UnhideWhenUsed="true" Name="Bibliography"/>
  <w:LsdException Locked="false" Priority="39" SemiHidden="true"
   UnhideWhenUsed="true" QFormat="true" Name="TOC Heading"/>
  <w:LsdException Locked="false" Priority="41" Name="Plain Table 1"/>
  <w:LsdException Locked="false" Priority="42" Name="Plain Table 2"/>
  <w:LsdException Locked="false" Priority="43" Name="Plain Table 3"/>
  <w:LsdException Locked="false" Priority="44" Name="Plain Table 4"/>
  <w:LsdException Locked="false" Priority="45" Name="Plain Table 5"/>
  <w:LsdException Locked="false" Priority="40" Name="Grid Table Light"/>
  <w:LsdException Locked="false" Priority="46" Name="Grid Table 1 Light"/>
  <w:LsdException Locked="false" Priority="47" Name="Grid Table 2"/>
  <w:LsdException Locked="false" Priority="48" Name="Grid Table 3"/>
  <w:LsdException Locked="false" Priority="49" Name="Grid Table 4"/>
  <w:LsdException Locked="false" Priority="50" Name="Grid Table 5 Dark"/>
  <w:LsdException Locked="false" Priority="51" Name="Grid Table 6 Colorful"/>
  <w:LsdException Locked="false" Priority="52" Name="Grid Table 7 Colorful"/>
  <w:LsdException Locked="false" Priority="46"
   Name="Grid Table 1 Light Accent 1"/>
  <w:LsdException Locked="false" Priority="47" Name="Grid Table 2 Accent 1"/>
  <w:LsdException Locked="false" Priority="48" Name="Grid Table 3 Accent 1"/>
  <w:LsdException Locked="false" Priority="49" Name="Grid Table 4 Accent 1"/>
  <w:LsdException Locked="false" Priority="50" Name="Grid Table 5 Dark Accent 1"/>
  <w:LsdException Locked="false" Priority="51"
   Name="Grid Table 6 Colorful Accent 1"/>
  <w:LsdException Locked="false" Priority="52"
   Name="Grid Table 7 Colorful Accent 1"/>
  <w:LsdException Locked="false" Priority="46"
   Name="Grid Table 1 Light Accent 2"/>
  <w:LsdException Locked="false" Priority="47" Name="Grid Table 2 Accent 2"/>
  <w:LsdException Locked="false" Priority="48" Name="Grid Table 3 Accent 2"/>
  <w:LsdException Locked="false" Priority="49" Name="Grid Table 4 Accent 2"/>
  <w:LsdException Locked="false" Priority="50" Name="Grid Table 5 Dark Accent 2"/>
  <w:LsdException Locked="false" Priority="51"
   Name="Grid Table 6 Colorful Accent 2"/>
  <w:LsdException Locked="false" Priority="52"
   Name="Grid Table 7 Colorful Accent 2"/>
  <w:LsdException Locked="false" Priority="46"
   Name="Grid Table 1 Light Accent 3"/>
  <w:LsdException Locked="false" Priority="47" Name="Grid Table 2 Accent 3"/>
  <w:LsdException Locked="false" Priority="48" Name="Grid Table 3 Accent 3"/>
  <w:LsdException Locked="false" Priority="49" Name="Grid Table 4 Accent 3"/>
  <w:LsdException Locked="false" Priority="50" Name="Grid Table 5 Dark Accent 3"/>
  <w:LsdException Locked="false" Priority="51"
   Name="Grid Table 6 Colorful Accent 3"/>
  <w:LsdException Locked="false" Priority="52"
   Name="Grid Table 7 Colorful Accent 3"/>
  <w:LsdException Locked="false" Priority="46"
   Name="Grid Table 1 Light Accent 4"/>
  <w:LsdException Locked="false" Priority="47" Name="Grid Table 2 Accent 4"/>
  <w:LsdException Locked="false" Priority="48" Name="Grid Table 3 Accent 4"/>
  <w:LsdException Locked="false" Priority="49" Name="Grid Table 4 Accent 4"/>
  <w:LsdException Locked="false" Priority="50" Name="Grid Table 5 Dark Accent 4"/>
  <w:LsdException Locked="false" Priority="51"
   Name="Grid Table 6 Colorful Accent 4"/>
  <w:LsdException Locked="false" Priority="52"
   Name="Grid Table 7 Colorful Accent 4"/>
  <w:LsdException Locked="false" Priority="46"
   Name="Grid Table 1 Light Accent 5"/>
  <w:LsdException Locked="false" Priority="47" Name="Grid Table 2 Accent 5"/>
  <w:LsdException Locked="false" Priority="48" Name="Grid Table 3 Accent 5"/>
  <w:LsdException Locked="false" Priority="49" Name="Grid Table 4 Accent 5"/>
  <w:LsdException Locked="false" Priority="50" Name="Grid Table 5 Dark Accent 5"/>
  <w:LsdException Locked="false" Priority="51"
   Name="Grid Table 6 Colorful Accent 5"/>
  <w:LsdException Locked="false" Priority="52"
   Name="Grid Table 7 Colorful Accent 5"/>
  <w:LsdException Locked="false" Priority="46"
   Name="Grid Table 1 Light Accent 6"/>
  <w:LsdException Locked="false" Priority="47" Name="Grid Table 2 Accent 6"/>
  <w:LsdException Locked="false" Priority="48" Name="Grid Table 3 Accent 6"/>
  <w:LsdException Locked="false" Priority="49" Name="Grid Table 4 Accent 6"/>
  <w:LsdException Locked="false" Priority="50" Name="Grid Table 5 Dark Accent 6"/>
  <w:LsdException Locked="false" Priority="51"
   Name="Grid Table 6 Colorful Accent 6"/>
  <w:LsdException Locked="false" Priority="52"
   Name="Grid Table 7 Colorful Accent 6"/>
  <w:LsdException Locked="false" Priority="46" Name="List Table 1 Light"/>
  <w:LsdException Locked="false" Priority="47" Name="List Table 2"/>
  <w:LsdException Locked="false" Priority="48" Name="List Table 3"/>
  <w:LsdException Locked="false" Priority="49" Name="List Table 4"/>
  <w:LsdException Locked="false" Priority="50" Name="List Table 5 Dark"/>
  <w:LsdException Locked="false" Priority="51" Name="List Table 6 Colorful"/>
  <w:LsdException Locked="false" Priority="52" Name="List Table 7 Colorful"/>
  <w:LsdException Locked="false" Priority="46"
   Name="List Table 1 Light Accent 1"/>
  <w:LsdException Locked="false" Priority="47" Name="List Table 2 Accent 1"/>
  <w:LsdException Locked="false" Priority="48" Name="List Table 3 Accent 1"/>
  <w:LsdException Locked="false" Priority="49" Name="List Table 4 Accent 1"/>
  <w:LsdException Locked="false" Priority="50" Name="List Table 5 Dark Accent 1"/>
  <w:LsdException Locked="false" Priority="51"
   Name="List Table 6 Colorful Accent 1"/>
  <w:LsdException Locked="false" Priority="52"
   Name="List Table 7 Colorful Accent 1"/>
  <w:LsdException Locked="false" Priority="46"
   Name="List Table 1 Light Accent 2"/>
  <w:LsdException Locked="false" Priority="47" Name="List Table 2 Accent 2"/>
  <w:LsdException Locked="false" Priority="48" Name="List Table 3 Accent 2"/>
  <w:LsdException Locked="false" Priority="49" Name="List Table 4 Accent 2"/>
  <w:LsdException Locked="false" Priority="50" Name="List Table 5 Dark Accent 2"/>
  <w:LsdException Locked="false" Priority="51"
   Name="List Table 6 Colorful Accent 2"/>
  <w:LsdException Locked="false" Priority="52"
   Name="List Table 7 Colorful Accent 2"/>
  <w:LsdException Locked="false" Priority="46"
   Name="List Table 1 Light Accent 3"/>
  <w:LsdException Locked="false" Priority="47" Name="List Table 2 Accent 3"/>
  <w:LsdException Locked="false" Priority="48" Name="List Table 3 Accent 3"/>
  <w:LsdException Locked="false" Priority="49" Name="List Table 4 Accent 3"/>
  <w:LsdException Locked="false" Priority="50" Name="List Table 5 Dark Accent 3"/>
  <w:LsdException Locked="false" Priority="51"
   Name="List Table 6 Colorful Accent 3"/>
  <w:LsdException Locked="false" Priority="52"
   Name="List Table 7 Colorful Accent 3"/>
  <w:LsdException Locked="false" Priority="46"
   Name="List Table 1 Light Accent 4"/>
  <w:LsdException Locked="false" Priority="47" Name="List Table 2 Accent 4"/>
  <w:LsdException Locked="false" Priority="48" Name="List Table 3 Accent 4"/>
  <w:LsdException Locked="false" Priority="49" Name="List Table 4 Accent 4"/>
  <w:LsdException Locked="false" Priority="50" Name="List Table 5 Dark Accent 4"/>
  <w:LsdException Locked="false" Priority="51"
   Name="List Table 6 Colorful Accent 4"/>
  <w:LsdException Locked="false" Priority="52"
   Name="List Table 7 Colorful Accent 4"/>
  <w:LsdException Locked="false" Priority="46"
   Name="List Table 1 Light Accent 5"/>
  <w:LsdException Locked="false" Priority="47" Name="List Table 2 Accent 5"/>
  <w:LsdException Locked="false" Priority="48" Name="List Table 3 Accent 5"/>
  <w:LsdException Locked="false" Priority="49" Name="List Table 4 Accent 5"/>
  <w:LsdException Locked="false" Priority="50" Name="List Table 5 Dark Accent 5"/>
  <w:LsdException Locked="false" Priority="51"
   Name="List Table 6 Colorful Accent 5"/>
  <w:LsdException Locked="false" Priority="52"
   Name="List Table 7 Colorful Accent 5"/>
  <w:LsdException Locked="false" Priority="46"
   Name="List Table 1 Light Accent 6"/>
  <w:LsdException Locked="false" Priority="47" Name="List Table 2 Accent 6"/>
  <w:LsdException Locked="false" Priority="48" Name="List Table 3 Accent 6"/>
  <w:LsdException Locked="false" Priority="49" Name="List Table 4 Accent 6"/>
  <w:LsdException Locked="false" Priority="50" Name="List Table 5 Dark Accent 6"/>
  <w:LsdException Locked="false" Priority="51"
   Name="List Table 6 Colorful Accent 6"/>
  <w:LsdException Locked="false" Priority="52"
   Name="List Table 7 Colorful Accent 6"/>
 </w:LatentStyles>
</xml><![endif]-->
<style>
<!--
 /* Font Definitions */
 @font-face
	{font-family:"Cambria Math";
	panose-1:2 4 5 3 5 4 6 3 2 4;
	mso-font-charset:1;
	mso-generic-font-family:roman;
	mso-font-pitch:variable;
	mso-font-signature:0 0 0 0 0 0;}
@font-face
	{font-family:Calibri;
	panose-1:2 15 5 2 2 2 4 3 2 4;
	mso-font-charset:0;
	mso-generic-font-family:swiss;
	mso-font-pitch:variable;
	mso-font-signature:-520092929 1073786111 9 0 415 0;}
@font-face
	{font-family:"Arial Black";
	panose-1:2 11 10 4 2 1 2 2 2 4;
	mso-font-charset:0;
	mso-generic-font-family:swiss;
	mso-font-pitch:variable;
	mso-font-signature:647 0 0 0 159 0;}
@font-face
	{font-family:"Segoe UI";
	panose-1:2 11 5 2 4 2 4 2 2 3;
	mso-font-charset:0;
	mso-generic-font-family:swiss;
	mso-font-pitch:variable;
	mso-font-signature:-520084737 -1073683329 41 0 479 0;}
 /* Style Definitions */
 p.MsoNormal, li.MsoNormal, div.MsoNormal
	{mso-style-unhide:no;
	mso-style-qformat:yes;
	mso-style-parent:"";
	margin-top:0cm;
	margin-right:0cm;
	margin-bottom:8.0pt;
	margin-left:0cm;
	line-height:105%;
	mso-pagination:widow-orphan;
	font-size:11.0pt;
	font-family:"Calibri",sans-serif;
	mso-fareast-font-family:"Times New Roman";
	mso-fareast-theme-font:minor-fareast;}
p.MsoAcetate, li.MsoAcetate, div.MsoAcetate
	{mso-style-noshow:yes;
	mso-style-priority:99;
	mso-style-link:"Balloon Text Char";
	margin:0cm;
	margin-bottom:.0001pt;
	mso-pagination:widow-orphan;
	font-size:9.0pt;
	font-family:"Segoe UI",sans-serif;
	mso-fareast-font-family:"Times New Roman";
	mso-fareast-theme-font:minor-fareast;}
p.MsoListParagraph, li.MsoListParagraph, div.MsoListParagraph
	{mso-style-priority:34;
	mso-style-unhide:no;
	mso-style-qformat:yes;
	margin-top:0cm;
	margin-right:0cm;
	margin-bottom:8.0pt;
	margin-left:36.0pt;
	mso-add-space:auto;
	line-height:105%;
	mso-pagination:widow-orphan;
	font-size:11.0pt;
	font-family:"Calibri",sans-serif;
	mso-fareast-font-family:"Times New Roman";
	mso-fareast-theme-font:minor-fareast;}
p.MsoListParagraphCxSpFirst, li.MsoListParagraphCxSpFirst, div.MsoListParagraphCxSpFirst
	{mso-style-priority:34;
	mso-style-unhide:no;
	mso-style-qformat:yes;
	mso-style-type:export-only;
	margin-top:0cm;
	margin-right:0cm;
	margin-bottom:0cm;
	margin-left:36.0pt;
	margin-bottom:.0001pt;
	mso-add-space:auto;
	line-height:105%;
	mso-pagination:widow-orphan;
	font-size:11.0pt;
	font-family:"Calibri",sans-serif;
	mso-fareast-font-family:"Times New Roman";
	mso-fareast-theme-font:minor-fareast;}
p.MsoListParagraphCxSpMiddle, li.MsoListParagraphCxSpMiddle, div.MsoListParagraphCxSpMiddle
	{mso-style-priority:34;
	mso-style-unhide:no;
	mso-style-qformat:yes;
	mso-style-type:export-only;
	margin-top:0cm;
	margin-right:0cm;
	margin-bottom:0cm;
	margin-left:36.0pt;
	margin-bottom:.0001pt;
	mso-add-space:auto;
	line-height:105%;
	mso-pagination:widow-orphan;
	font-size:11.0pt;
	font-family:"Calibri",sans-serif;
	mso-fareast-font-family:"Times New Roman";
	mso-fareast-theme-font:minor-fareast;}
p.MsoListParagraphCxSpLast, li.MsoListParagraphCxSpLast, div.MsoListParagraphCxSpLast
	{mso-style-priority:34;
	mso-style-unhide:no;
	mso-style-qformat:yes;
	mso-style-type:export-only;
	margin-top:0cm;
	margin-right:0cm;
	margin-bottom:8.0pt;
	margin-left:36.0pt;
	mso-add-space:auto;
	line-height:105%;
	mso-pagination:widow-orphan;
	font-size:11.0pt;
	font-family:"Calibri",sans-serif;
	mso-fareast-font-family:"Times New Roman";
	mso-fareast-theme-font:minor-fareast;}
p.msonormal0, li.msonormal0, div.msonormal0
	{mso-style-name:msonormal;
	mso-style-unhide:no;
	mso-margin-top-alt:auto;
	margin-right:0cm;
	mso-margin-bottom-alt:auto;
	margin-left:0cm;
	mso-pagination:widow-orphan;
	font-size:12.0pt;
	font-family:"Times New Roman",serif;
	mso-fareast-font-family:"Times New Roman";
	mso-fareast-theme-font:minor-fareast;}
span.BalloonTextChar
	{mso-style-name:"Balloon Text Char";
	mso-style-noshow:yes;
	mso-style-priority:99;
	mso-style-unhide:no;
	mso-style-locked:yes;
	mso-style-link:"Balloon Text";
	mso-ansi-font-size:9.0pt;
	mso-bidi-font-size:9.0pt;
	font-family:"Segoe UI",sans-serif;
	mso-ascii-font-family:"Segoe UI";
	mso-fareast-font-family:"Times New Roman";
	mso-fareast-theme-font:minor-fareast;
	mso-hansi-font-family:"Segoe UI";
	mso-bidi-font-family:"Segoe UI";}
p.msochpdefault, li.msochpdefault, div.msochpdefault
	{mso-style-name:msochpdefault;
	mso-style-unhide:no;
	mso-margin-top-alt:auto;
	margin-right:0cm;
	mso-margin-bottom-alt:auto;
	margin-left:0cm;
	mso-pagination:widow-orphan;
	font-size:12.0pt;
	font-family:"Calibri",sans-serif;
	mso-fareast-font-family:"Times New Roman";
	mso-fareast-theme-font:minor-fareast;}
p.msopapdefault, li.msopapdefault, div.msopapdefault
	{mso-style-name:msopapdefault;
	mso-style-unhide:no;
	mso-margin-top-alt:auto;
	margin-right:0cm;
	margin-bottom:8.0pt;
	margin-left:0cm;
	line-height:105%;
	mso-pagination:widow-orphan;
	font-size:12.0pt;
	font-family:"Times New Roman",serif;
	mso-fareast-font-family:"Times New Roman";
	mso-fareast-theme-font:minor-fareast;}
.MsoChpDefault
	{mso-style-type:export-only;
	mso-default-props:yes;
	font-size:10.0pt;
	mso-ansi-font-size:10.0pt;
	mso-bidi-font-size:10.0pt;
	mso-ascii-font-family:Calibri;
	mso-hansi-font-family:Calibri;
	mso-bidi-font-family:Calibri;}
@page WordSection1
	{size:612.0pt 1008.0pt;
	margin:36.0pt 36.0pt 36.0pt 36.0pt;
	mso-header-margin:35.4pt;
	mso-footer-margin:35.4pt;
	mso-paper-source:0;}
div.WordSection1
	{page:WordSection1;}
-->
</style>
<!--[if gte mso 10]>
<style>
 /* Style Definitions */
 table.MsoNormalTable
	{mso-style-name:"Table Normal";
	mso-tstyle-rowband-size:0;
	mso-tstyle-colband-size:0;
	mso-style-noshow:yes;
	mso-style-priority:99;
	mso-style-parent:"";
	mso-padding-alt:0cm 5.4pt 0cm 5.4pt;
	mso-para-margin:0cm;
	mso-para-margin-bottom:.0001pt;
	mso-pagination:widow-orphan;
	font-size:10.0pt;
	font-family:"Calibri",sans-serif;}
</style>
<![endif]--><!--[if gte mso 9]><xml>
 <o:shapedefaults v:ext="edit" spidmax="1026"/>
</xml><![endif]--><!--[if gte mso 9]><xml>
 <o:shapelayout v:ext="edit">
  <o:idmap v:ext="edit" data="1"/>
 </o:shapelayout></xml><![endif]-->
</head>

<body lang=IN style='tab-interval:36.0pt'>

<div class=WordSection1>

<table class=MsoNormalTable border=0 cellspacing=0 cellpadding=0 width=735
 style='width:551.4pt;margin-left:-1.5pt;border-collapse:collapse;mso-yfti-tbllook:
 1184;mso-padding-alt:0cm 0cm 0cm 0cm'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;height:13.7pt'>
  <td width=104 colspan=4 rowspan=3 valign=top style='width:78.15pt;border:
  none;border-bottom:solid windowtext 1.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:13.7pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;text-autospace:none'><span
  style='mso-no-proof:yes'><!--[if gte vml 1]><v:shapetype id="_x0000_t75"
   coordsize="21600,21600" o:spt="75" o:preferrelative="t" path="m@4@5l@4@11@9@11@9@5xe"
   filled="f" stroked="f">
   <v:stroke joinstyle="miter"/>
   <v:formulas>
    <v:f eqn="if lineDrawn pixelLineWidth 0"/>
    <v:f eqn="sum @0 1 0"/>
    <v:f eqn="sum 0 0 @1"/>
    <v:f eqn="prod @2 1 2"/>
    <v:f eqn="prod @3 21600 pixelWidth"/>
    <v:f eqn="prod @3 21600 pixelHeight"/>
    <v:f eqn="sum @0 0 1"/>
    <v:f eqn="prod @6 1 2"/>
    <v:f eqn="prod @7 21600 pixelWidth"/>
    <v:f eqn="sum @8 21600 0"/>
    <v:f eqn="prod @7 21600 pixelHeight"/>
    <v:f eqn="sum @10 21600 0"/>
   </v:formulas>
   <v:path o:extrusionok="f" gradientshapeok="t" o:connecttype="rect"/>
   <o:lock v:ext="edit" aspectratio="t"/>
  </v:shapetype><v:shape id="Picture_x0020_1" o:spid="_x0000_i1025" type="#_x0000_t75"
   style='width:43.5pt;height:51.75pt;visibility:visible;mso-wrap-style:square'>
   <v:imagedata src="../../images/logokab.jpg"
    o:title=""/>
  </v:shape><![endif]--><![if !vml]><img width=58 height=69
  src="../../images/logokab.jpg" v:shapes="Picture_x0020_1"><![endif]></span></p>
  </td>
  <td width=544 colspan=25 valign=top style='width:408.25pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:13.7pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;text-autospace:none'><b style='mso-bidi-font-weight:normal'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>PEMERINTAH
  KABUPATEN BOGOR</span><o:p></o:p></b></p>
  </td>
  <td width=87 colspan=4 rowspan=2 valign=top style='width:65.0pt;border:solid windowtext 1.0pt;
  border-bottom:none;padding:0cm 5.4pt 0cm 5.4pt;height:13.7pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;text-autospace:none'><b><span
  style='font-size:16.0pt;font-family:"Arial",sans-serif;color:black'>F.1-32</span></b></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:1;height:13.4pt'>
  <td width=544 colspan=25 valign=top style='width:408.25pt;border:none;
  border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;height:13.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;text-autospace:none'><b style='mso-bidi-font-weight:normal'><span
  style='font-size:12.0pt;mso-bidi-font-size:8.0pt;font-family:"Arial",sans-serif;
  color:black'>DINAS KEPENDUDUKAN DAN PENCATATAN SIPIL</span><o:p></o:p></b></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:2;height:10.2pt'>
  <td width=631 colspan=29 valign=top style='width:473.25pt;border:none;
  border-bottom:solid windowtext 1.5pt;padding:0cm 5.4pt 0cm 5.4pt;height:10.2pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;text-autospace:none'><b style='mso-bidi-font-weight:normal'>JALAN
  BERSIH KELURAHAN TENGAH KEC. CIBINONG TELP. (021) 87902288<o:p></o:p></b></p>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;text-autospace:none'><b style='mso-bidi-font-weight:normal'>CIBINONG
  16914<o:p></o:p></b></p>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;text-autospace:none'><b style='mso-bidi-font-weight:normal'><span
  style='font-size:3.0pt;mso-bidi-font-size:11.0pt'><o:p>&nbsp;</o:p></span></b></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:3;height:2.85pt'>
  <td width=35 valign=top style='width:26.4pt;border:none;mso-border-top-alt:
  solid windowtext 1.5pt;padding:0cm 5.4pt 0cm 5.4pt;height:2.85pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;text-autospace:none'><span
  style='font-size:4.0pt;mso-bidi-font-size:8.0pt;font-family:"Arial",sans-serif;
  color:black'>&nbsp;</span><span style='font-size:4.0pt;mso-bidi-font-size:
  11.0pt'><o:p></o:p></span></p>
  </td>
  <td width=23 valign=top style='width:17.25pt;border:none;mso-border-top-alt:
  solid windowtext 1.5pt;padding:0cm 5.4pt 0cm 5.4pt;height:2.85pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;text-autospace:none'><span
  style='font-size:4.0pt;mso-bidi-font-size:8.0pt;font-family:"Arial",sans-serif;
  color:black'>&nbsp;</span><span style='font-size:4.0pt;mso-bidi-font-size:
  11.0pt'><o:p></o:p></span></p>
  </td>
  <td width=23 valign=top style='width:17.25pt;border:none;mso-border-top-alt:
  solid windowtext 1.5pt;padding:0cm 5.4pt 0cm 5.4pt;height:2.85pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;text-autospace:none'><span
  style='font-size:4.0pt;mso-bidi-font-size:8.0pt;font-family:"Arial",sans-serif;
  color:black'>&nbsp;</span><span style='font-size:4.0pt;mso-bidi-font-size:
  11.0pt'><o:p></o:p></span></p>
  </td>
  <td width=23 valign=top style='width:17.25pt;border:none;mso-border-top-alt:
  solid windowtext 1.5pt;padding:0cm 5.4pt 0cm 5.4pt;height:2.85pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;text-autospace:none'><span
  style='font-size:4.0pt;mso-bidi-font-size:8.0pt;font-family:"Arial",sans-serif;
  color:black'>&nbsp;</span><span style='font-size:4.0pt;mso-bidi-font-size:
  11.0pt'><o:p></o:p></span></p>
  </td>
  <td width=23 valign=top style='width:17.25pt;border:none;mso-border-top-alt:
  solid windowtext 1.5pt;padding:0cm 5.4pt 0cm 5.4pt;height:2.85pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;text-autospace:none'><span
  style='font-size:4.0pt;mso-bidi-font-size:8.0pt;font-family:"Arial",sans-serif;
  color:black'>&nbsp;</span><span style='font-size:4.0pt;mso-bidi-font-size:
  11.0pt'><o:p></o:p></span></p>
  </td>
  <td width=23 valign=top style='width:17.2pt;border:none;mso-border-top-alt:
  solid windowtext 1.5pt;padding:0cm 5.4pt 0cm 5.4pt;height:2.85pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;text-autospace:none'><span
  style='font-size:4.0pt;mso-bidi-font-size:8.0pt;font-family:"Arial",sans-serif;
  color:black'>&nbsp;</span><span style='font-size:4.0pt;mso-bidi-font-size:
  11.0pt'><o:p></o:p></span></p>
  </td>
  <td width=21 valign=top style='width:16.05pt;border:none;mso-border-top-alt:
  solid windowtext 1.5pt;padding:0cm 5.4pt 0cm 5.4pt;height:2.85pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;text-autospace:none'><span
  style='font-size:4.0pt;mso-bidi-font-size:8.0pt;font-family:"Arial",sans-serif;
  color:black'>&nbsp;</span><span style='font-size:4.0pt;mso-bidi-font-size:
  11.0pt'><o:p></o:p></span></p>
  </td>
  <td width=22 valign=top style='width:16.3pt;border:none;border-bottom:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext 1.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:2.85pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;text-autospace:none'><span
  style='font-size:4.0pt;mso-bidi-font-size:8.0pt;font-family:"Arial",sans-serif;
  color:black'>&nbsp;</span><span style='font-size:4.0pt;mso-bidi-font-size:
  11.0pt'><o:p></o:p></span></p>
  </td>
  <td width=22 valign=top style='width:16.3pt;border:none;border-bottom:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext 1.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:2.85pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;text-autospace:none'><span
  style='font-size:4.0pt;mso-bidi-font-size:8.0pt;font-family:"Arial",sans-serif;
  color:black'>&nbsp;</span><span style='font-size:4.0pt;mso-bidi-font-size:
  11.0pt'><o:p></o:p></span></p>
  </td>
  <td width=22 valign=top style='width:16.35pt;border:none;mso-border-top-alt:
  solid windowtext 1.5pt;padding:0cm 5.4pt 0cm 5.4pt;height:2.85pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;text-autospace:none'><span
  style='font-size:4.0pt;mso-bidi-font-size:8.0pt;font-family:"Arial",sans-serif;
  color:black'>&nbsp;</span><span style='font-size:4.0pt;mso-bidi-font-size:
  11.0pt'><o:p></o:p></span></p>
  </td>
  <td width=22 valign=top style='width:16.35pt;border:none;mso-border-top-alt:
  solid windowtext 1.5pt;padding:0cm 5.4pt 0cm 5.4pt;height:2.85pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;text-autospace:none'><span
  style='font-size:4.0pt;mso-bidi-font-size:8.0pt;font-family:"Arial",sans-serif;
  color:black'>&nbsp;</span><span style='font-size:4.0pt;mso-bidi-font-size:
  11.0pt'><o:p></o:p></span></p>
  </td>
  <td width=22 valign=top style='width:16.3pt;border:none;mso-border-top-alt:
  solid windowtext 1.5pt;padding:0cm 5.4pt 0cm 5.4pt;height:2.85pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;text-autospace:none'><span
  style='font-size:4.0pt;mso-bidi-font-size:8.0pt;font-family:"Arial",sans-serif;
  color:black'>&nbsp;</span><span style='font-size:4.0pt;mso-bidi-font-size:
  11.0pt'><o:p></o:p></span></p>
  </td>
  <td width=22 valign=top style='width:16.25pt;border:none;mso-border-top-alt:
  solid windowtext 1.5pt;padding:0cm 5.4pt 0cm 5.4pt;height:2.85pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;text-autospace:none'><span
  style='font-size:4.0pt;mso-bidi-font-size:8.0pt;font-family:"Arial",sans-serif;
  color:black'>&nbsp;</span><span style='font-size:4.0pt;mso-bidi-font-size:
  11.0pt'><o:p></o:p></span></p>
  </td>
  <td width=22 valign=top style='width:16.15pt;border:none;mso-border-top-alt:
  solid windowtext 1.5pt;padding:0cm 5.4pt 0cm 5.4pt;height:2.85pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;text-autospace:none'><span
  style='font-size:4.0pt;mso-bidi-font-size:8.0pt;font-family:"Arial",sans-serif;
  color:black'>&nbsp;</span><span style='font-size:4.0pt;mso-bidi-font-size:
  11.0pt'><o:p></o:p></span></p>
  </td>
  <td width=22 valign=top style='width:16.15pt;border:none;border-bottom:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext 1.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:2.85pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;text-autospace:none'><span
  style='font-size:4.0pt;mso-bidi-font-size:8.0pt;font-family:"Arial",sans-serif;
  color:black'>&nbsp;</span><span style='font-size:4.0pt;mso-bidi-font-size:
  11.0pt'><o:p></o:p></span></p>
  </td>
  <td width=22 valign=top style='width:16.15pt;border:none;border-bottom:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext 1.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:2.85pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;text-autospace:none'><span
  style='font-size:4.0pt;mso-bidi-font-size:8.0pt;font-family:"Arial",sans-serif;
  color:black'>&nbsp;</span><span style='font-size:4.0pt;mso-bidi-font-size:
  11.0pt'><o:p></o:p></span></p>
  </td>
  <td width=22 valign=top style='width:16.15pt;border:none;border-bottom:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext 1.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:2.85pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;text-autospace:none'><span
  style='font-size:4.0pt;mso-bidi-font-size:8.0pt;font-family:"Arial",sans-serif;
  color:black'>&nbsp;</span><span style='font-size:4.0pt;mso-bidi-font-size:
  11.0pt'><o:p></o:p></span></p>
  </td>
  <td width=22 valign=top style='width:16.15pt;border:none;border-bottom:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext 1.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:2.85pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;text-autospace:none'><span
  style='font-size:4.0pt;mso-bidi-font-size:8.0pt;font-family:"Arial",sans-serif;
  color:black'>&nbsp;</span><span style='font-size:4.0pt;mso-bidi-font-size:
  11.0pt'><o:p></o:p></span></p>
  </td>
  <td width=22 valign=top style='width:16.15pt;border:none;border-bottom:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext 1.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:2.85pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;text-autospace:none'><span
  style='font-size:4.0pt;mso-bidi-font-size:8.0pt;font-family:"Arial",sans-serif;
  color:black'>&nbsp;</span><span style='font-size:4.0pt;mso-bidi-font-size:
  11.0pt'><o:p></o:p></span></p>
  </td>
  <td width=22 valign=top style='width:16.15pt;border:none;border-bottom:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext 1.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:2.85pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;text-autospace:none'><span
  style='font-size:4.0pt;mso-bidi-font-size:8.0pt;font-family:"Arial",sans-serif;
  color:black'>&nbsp;</span><span style='font-size:4.0pt;mso-bidi-font-size:
  11.0pt'><o:p></o:p></span></p>
  </td>
  <td width=22 valign=top style='width:16.15pt;border:none;border-bottom:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext 1.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:2.85pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;text-autospace:none'><span
  style='font-size:4.0pt;mso-bidi-font-size:8.0pt;font-family:"Arial",sans-serif;
  color:black'>&nbsp;</span><span style='font-size:4.0pt;mso-bidi-font-size:
  11.0pt'><o:p></o:p></span></p>
  </td>
  <td width=22 valign=top style='width:16.4pt;border:none;border-bottom:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext 1.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:2.85pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;text-autospace:none'><span
  style='font-size:4.0pt;mso-bidi-font-size:8.0pt;font-family:"Arial",sans-serif;
  color:black'>&nbsp;</span><span style='font-size:4.0pt;mso-bidi-font-size:
  11.0pt'><o:p></o:p></span></p>
  </td>
  <td width=22 valign=top style='width:16.35pt;border:none;border-bottom:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext 1.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:2.85pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;text-autospace:none'><span
  style='font-size:4.0pt;mso-bidi-font-size:8.0pt;font-family:"Arial",sans-serif;
  color:black'>&nbsp;</span><span style='font-size:4.0pt;mso-bidi-font-size:
  11.0pt'><o:p></o:p></span></p>
  </td>
  <td width=22 valign=top style='width:16.35pt;border:none;border-bottom:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext 1.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:2.85pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;text-autospace:none'><span
  style='font-size:4.0pt;mso-bidi-font-size:8.0pt;font-family:"Arial",sans-serif;
  color:black'>&nbsp;</span><span style='font-size:4.0pt;mso-bidi-font-size:
  11.0pt'><o:p></o:p></span></p>
  </td>
  <td width=22 valign=top style='width:16.35pt;border:none;border-bottom:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext 1.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:2.85pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;text-autospace:none'><span
  style='font-size:4.0pt;mso-bidi-font-size:8.0pt;font-family:"Arial",sans-serif;
  color:black'>&nbsp;</span><span style='font-size:4.0pt;mso-bidi-font-size:
  11.0pt'><o:p></o:p></span></p>
  </td>
  <td width=22 valign=top style='width:16.35pt;border:none;border-bottom:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext 1.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:2.85pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;text-autospace:none'><span
  style='font-size:4.0pt;mso-bidi-font-size:8.0pt;font-family:"Arial",sans-serif;
  color:black'>&nbsp;</span><span style='font-size:4.0pt;mso-bidi-font-size:
  11.0pt'><o:p></o:p></span></p>
  </td>
  <td width=22 valign=top style='width:16.3pt;border:none;border-bottom:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext 1.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:2.85pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;text-autospace:none'><span
  style='font-size:4.0pt;mso-bidi-font-size:8.0pt;font-family:"Arial",sans-serif;
  color:black'>&nbsp;</span><span style='font-size:4.0pt;mso-bidi-font-size:
  11.0pt'><o:p></o:p></span></p>
  </td>
  <td width=22 valign=top style='width:16.3pt;border:none;border-bottom:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext 1.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:2.85pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;text-autospace:none'><span
  style='font-size:4.0pt;mso-bidi-font-size:8.0pt;font-family:"Arial",sans-serif;
  color:black'>&nbsp;</span><span style='font-size:4.0pt;mso-bidi-font-size:
  11.0pt'><o:p></o:p></span></p>
  </td>
  <td width=22 valign=top style='width:16.3pt;border:none;border-bottom:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext 1.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:2.85pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;text-autospace:none'><span
  style='font-size:4.0pt;mso-bidi-font-size:8.0pt;font-family:"Arial",sans-serif;
  color:black'>&nbsp;</span><span style='font-size:4.0pt;mso-bidi-font-size:
  11.0pt'><o:p></o:p></span></p>
  </td>
  <td width=22 valign=top style='width:16.3pt;border:none;border-bottom:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext 1.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:2.85pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;text-autospace:none'><span
  style='font-size:4.0pt;mso-bidi-font-size:8.0pt;font-family:"Arial",sans-serif;
  color:black'>&nbsp;</span><span style='font-size:4.0pt;mso-bidi-font-size:
  11.0pt'><o:p></o:p></span></p>
  </td>
  <td width=22 valign=top style='width:16.25pt;border:none;border-bottom:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext 1.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:2.85pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;text-autospace:none'><span
  style='font-size:4.0pt;mso-bidi-font-size:8.0pt;font-family:"Arial",sans-serif;
  color:black'>&nbsp;</span><span style='font-size:4.0pt;mso-bidi-font-size:
  11.0pt'><o:p></o:p></span></p>
  </td>
  <td width=22 valign=top style='width:16.3pt;border:none;border-bottom:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext 1.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:2.85pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;text-autospace:none'><span
  style='font-size:4.0pt;mso-bidi-font-size:8.0pt;font-family:"Arial",sans-serif;
  color:black'>&nbsp;</span><span style='font-size:4.0pt;mso-bidi-font-size:
  11.0pt'><o:p></o:p></span></p>
  </td>
  <td width=22 valign=top style='width:16.15pt;border:none;border-bottom:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext 1.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:2.85pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;text-autospace:none'><span
  style='font-size:4.0pt;mso-bidi-font-size:8.0pt;font-family:"Arial",sans-serif;
  color:black'>&nbsp;</span><span style='font-size:4.0pt;mso-bidi-font-size:
  11.0pt'><o:p></o:p></span></p>
  </td>
 </tr>
 
 <tr style='mso-yfti-irow:4;height:7.55pt'>
  <td width=150 colspan=6 valign=top style='width:112.65pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:7.55pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;text-autospace:none'><span style='font-size:8.0pt;font-family:"Arial",sans-serif;
  color:black'>PROVINSI</span></p>
  </td>
  <td width=21 valign=top style='width:16.1pt;border:none;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:7.55pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>:</span></p>
  </td>
     <?php echo changeCell("2",$RULEKODEPROV," width=22 valign=top style='width:16.35pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:7.55pt'"," class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;text-autospace:none'"," style='font-size:8.0pt;font-family:\"Arial\",sans-serif;
  color:black'"); ?>
  <td width=43 colspan=2 valign=top style='width:32.55pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:7.55pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;text-autospace:none'><span style='font-size:8.0pt;font-family:"Arial",sans-serif;
  color:black'>&nbsp;</span></p>
  </td>
  <td width=65 colspan=3 valign=top style='width:48.7pt;border:none;border-right:
  solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;height:7.55pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>*)</span></p>
  </td>
  <td width=412 colspan=19 valign=top style='width:308.75pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:7.55pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;text-autospace:none'><span style='font-size:8.0pt;font-family:"Arial",sans-serif;
  color:black'><?php echo $RULECAPPROV; ?></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:5;height:2.5pt'>
  <td width=735 colspan=33 valign=top style='width:551.4pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:2.5pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;text-autospace:none'><span style='font-size:4.0pt;font-family:"Arial",sans-serif;
  color:black'>&nbsp;</span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:6;height:7.55pt'>
  <td width=150 colspan=6 valign=top style='width:112.65pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:7.55pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;text-autospace:none'><span style='font-size:8.0pt;font-family:"Arial",sans-serif;
  color:black'>KABUPATEN/KOTA</span></p>
  </td>
  <td width=21 valign=top style='width:16.1pt;border:none;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:7.55pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>:</span></p>
  </td>
  
     <?php echo changeCell("2",$RULEKODEKAB," width=22 valign=top style='width:16.35pt;border:solid windowtext 1.0pt;
  border-left:none;padding:0cm 5.4pt 0cm 5.4pt;height:7.55pt'"," class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;text-autospace:none'"," style='font-size:8.0pt;font-family:\"Arial\",sans-serif;
  color:black'"); ?>
  
  <td width=43 colspan=2 valign=top style='width:32.55pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:7.55pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;text-autospace:none'><span style='font-size:8.0pt;font-family:"Arial",sans-serif;
  color:black'>&nbsp;</span></p>
  </td>
  <td width=65 colspan=3 valign=top style='width:48.7pt;border:none;border-right:
  solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;height:7.55pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>*)</span></p>
  </td>
  <td width=412 colspan=19 valign=top style='width:308.75pt;border:solid windowtext 1.0pt;
  border-left:none;padding:0cm 5.4pt 0cm 5.4pt;height:7.55pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;text-autospace:none'><span style='font-size:8.0pt;font-family:"Arial",sans-serif;
  color:black'><?php echo $RULECAPKAB; ?></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:7;height:2.5pt'>
  <td width=735 colspan=33 valign=top style='width:551.4pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:2.5pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;text-autospace:none'><span style='font-size:4.0pt;font-family:"Arial",sans-serif;
  color:black'>&nbsp;</span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:8;height:7.55pt'>
  <td width=150 colspan=6 valign=top style='width:112.65pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:7.55pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;text-autospace:none'><span style='font-size:8.0pt;font-family:"Arial",sans-serif;
  color:black'>KECAMATAN</span></p>
  </td>
  <td width=21 valign=top style='width:16.1pt;border:none;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:7.55pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>:</span></p>
  </td>
  
     <?php echo changeCell("2",$RULEKODEKEC," width=22 valign=top style='width:16.35pt;border:solid windowtext 1.0pt;
  border-left:none;padding:0cm 5.4pt 0cm 5.4pt;height:7.55pt'"," class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;text-autospace:none'"," style='font-size:8.0pt;font-family:\"Arial\",sans-serif;
  color:black'"); ?>
  
  
  <td width=43 colspan=2 valign=top style='width:32.55pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:7.55pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;text-autospace:none'><span style='font-size:8.0pt;font-family:"Arial",sans-serif;
  color:black'>&nbsp;</span></p>
  </td>
  <td width=65 colspan=3 valign=top style='width:48.7pt;border:none;border-right:
  solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;height:7.55pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>*)</span></p>
  </td>
  <td width=412 colspan=19 valign=top style='width:308.75pt;border:solid windowtext 1.0pt;
  border-left:none;padding:0cm 5.4pt 0cm 5.4pt;height:7.55pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;text-autospace:none'><span style='font-size:8.0pt;font-family:"Arial",sans-serif;
  color:black'><?php echo $RULECAPKEC; ?></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:9;height:2.5pt'>
  <td width=735 colspan=33 valign=top style='width:551.4pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:2.5pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;text-autospace:none'><span style='font-size:4.0pt;font-family:"Arial",sans-serif;
  color:black'>&nbsp;</span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:10;height:7.55pt'>
  <td width=150 colspan=6 valign=top style='width:112.65pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:7.55pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;text-autospace:none'><span style='font-size:8.0pt;font-family:"Arial",sans-serif;
  color:black'>DESA/KELURAHAN</span></p>
  </td>
  <td width=21 valign=top style='width:16.1pt;border:none;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:7.55pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>:</span></p>
  </td>
    
     <?php echo changeCell("2",$RULEKODEDESA," width=22 valign=top style='width:16.35pt;border:solid windowtext 1.0pt;
  border-left:none;padding:0cm 5.4pt 0cm 5.4pt;height:7.55pt'"," class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;text-autospace:none'"," style='font-size:8.0pt;font-family:\"Arial\",sans-serif;
  color:black'"); ?>
  
 
  <td width=65 colspan=3 valign=top style='width:48.7pt;border:none;border-right:
  solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;height:7.55pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>*)</span></p>
  </td>
  <td width=412 colspan=19 valign=top style='width:308.75pt;border:solid windowtext 1.0pt;
  border-left:none;padding:0cm 5.4pt 0cm 5.4pt;height:7.55pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;text-autospace:none'><span style='font-size:8.0pt;font-family:"Arial",sans-serif;
  color:black'><?php echo $RULECAPDESA; ?></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:11;height:2.5pt'>
  <td width=735 colspan=33 valign=top style='width:551.4pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:2.5pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;text-autospace:none'><span style='font-size:4.0pt;font-family:"Arial",sans-serif;
  color:black'>&nbsp;</span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:12;height:7.55pt'>
  <td width=150 colspan=6 valign=top style='width:112.65pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:7.55pt'>
  <p class=MsoNormal style='margin-top:0cm;margin-right:-5.85pt;margin-bottom:
  0cm;margin-left:0cm;margin-bottom:.0001pt;line-height:normal;text-autospace:
  none'><span style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>DUSUN/DUKUH/KAMPUNG</span></p>
  </td>
  <td width=21 valign=top style='width:16.1pt;border:none;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:7.55pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>:</span></p>
  </td>
  <td width=564 colspan=26 valign=top style='width:422.65pt;border:solid windowtext 1.0pt;
  border-left:none;padding:0cm 5.4pt 0cm 5.4pt;height:7.55pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;text-autospace:none'><span style='font-size:8.0pt;font-family:"Arial",sans-serif;
  color:black'>&nbsp;</span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:13;height:5.35pt'>
  <td width=735 colspan=33 valign=top style='width:551.4pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:5.35pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;text-autospace:none'><span
  style='font-size:4.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:14;height:3.0pt'>
  <td width=735 colspan=33 valign=top style='width:551.4pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:3.0pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:4.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:15;height:13.7pt'>
  <td width=735 colspan=33 valign=top style='width:551.4pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:13.7pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;text-autospace:none'><b><span
  style='font-size:14.0pt;font-family:"Arial Black",sans-serif;color:black'>FORMULIR
  PERMOHONAN PINDAH DATANG WNI</span></b></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:16;height:12.25pt'>
  <td width=735 colspan=33 valign=top style='width:551.4pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:12.25pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;text-autospace:none'><b><span
  style='font-size:12.0pt;font-family:"Arial",sans-serif;color:black'>No.
  ................................................</span></b></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:17;height:7.55pt'>
  <td width=735 colspan=33 valign=top style='width:551.4pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:7.55pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:18;mso-yfti-lastrow:yes;height:10.7pt'>
  <td width=735 colspan=33 valign=top style='width:551.4pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:10.7pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;text-autospace:none'><b><span style='font-family:"Arial Black",sans-serif;
  color:black'>DATA DAERAH ASAL</span></b></p>
  </td>
 </tr>
</table>

<p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt'><span
style='font-size:2.0pt;line-height:105%'><o:p>&nbsp;</o:p></span></p>


<table class=MsoNormalTable border=0 cellspacing=0 cellpadding=0 width=710
 style='width:532.7pt;margin-left:-1.5pt;border-collapse:collapse;mso-yfti-tbllook:
 1184;mso-padding-alt:0cm 0cm 0cm 0cm'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;mso-yfti-lastrow:yes;
  height:3.35pt'>
  <td width=172 valign=top style='width:129.1pt;border:none;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:3.35pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;text-autospace:none'><span style='font-size:8.0pt;font-family:"Arial",sans-serif;
  color:black'>1. Nomor Kartu Keluarga</span></p>
  </td>
   <?php echo changeCell("16",$NOKK," width=32 valign=top style='width:24.1pt;border:solid windowtext 1.0pt;
  border-left:none;padding:0cm 5.4pt 0cm 5.4pt;height:3.35pt'","  class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;text-autospace:none'"," 
  style='font-size:8.0pt;font-family:\"Arial\",sans-serif;color:black'"); ?>
   
  <td width=24 valign=top style='width:18.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:3.35pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
 </tr>
</table>

<p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt'><span
style='font-size:2.0pt;line-height:105%'><o:p>&nbsp;</o:p></span></p>

<table class=MsoNormalTable border=0 cellspacing=0 cellpadding=0 width=735
 style='width:551.4pt;margin-left:-1.5pt;border-collapse:collapse;mso-yfti-tbllook:
 1184;mso-padding-alt:0cm 0cm 0cm 0cm'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;height:10.2pt'>
  <td width=172 colspan=7 valign=top style='width:128.75pt;border:none;
  border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;height:10.2pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;text-autospace:none'><span style='font-size:8.0pt;font-family:"Arial",sans-serif;
  color:black'>2. Nama Kepala Keluarga</span></p>
  </td>
  <td width=564 colspan=12 valign=top style='width:422.65pt;border:solid windowtext 1.0pt;
  border-left:none;padding:0cm 5.4pt 0cm 5.4pt;height:10.2pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;text-autospace:none'><span style='font-size:8.0pt;font-family:"Arial",sans-serif;
  color:black'><?php echo $NAMAKK; ?></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:1;height:3.35pt'>
  <td width=735 colspan=19 valign=top style='width:551.4pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:3.35pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:4.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:2;height:10.2pt'>
  <td width=172 colspan=7 valign=top style='width:128.75pt;border:none;
  border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;height:10.2pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;text-autospace:none'><span style='font-size:8.0pt;font-family:"Arial",sans-serif;
  color:black'>3. Alamat</span></p>
  </td>
  <td width=303 colspan=3 valign=top style='width:226.95pt;border:solid windowtext 1.0pt;
  border-left:none;padding:0cm 5.4pt 0cm 5.4pt;height:10.2pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;text-autospace:none'><span style='font-size:8.0pt;font-family:"Arial",sans-serif;
  color:black'>-</span></p>
  </td>
  <td width=65 colspan=2 valign=top style='width:49.1pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:10.2pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>RT</span></p>
  </td>
  
  <?php echo changeCellR("3",$RT," width=22 valign=top style='width:16.35pt;border:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:10.2pt'"," class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;text-autospace:none'","
  style='font-size:8.0pt;font-family:\"Arial\",sans-serif;color:black'"); ?>
  <td width=65 valign=top style='width:48.9pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:10.2pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>RW</span></p>
  </td>
  
  <?php echo changeCellR("3",$RW," width=22 valign=top style='width:16.35pt;border:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:10.2pt'"," class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;text-autospace:none'","
  style='font-size:8.0pt;font-family:\"Arial\",sans-serif;color:black'"); ?>
 </tr>
 <tr style='mso-yfti-irow:3;height:3.35pt'>
  <td width=735 colspan=19 valign=top style='width:551.4pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:3.35pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:4.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:4;height:10.2pt'>
  <td width=35 valign=top style='width:26.4pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:10.2pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
  <td width=23 valign=top style='width:17.25pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:10.2pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
  <td width=23 valign=top style='width:17.25pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:10.2pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
  <td width=23 valign=top style='width:17.25pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:10.2pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
  <td width=23 valign=top style='width:17.25pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:10.2pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
  <td width=23 valign=top style='width:17.25pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:10.2pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
  <td width=21 valign=top style='width:16.1pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:10.2pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
  <td width=130 valign=top style='width:97.75pt;border:none;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:10.2pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>Dusun/Dukuh/Kampung</span></p>
  </td>
  <td width=433 colspan=11 valign=top style='width:324.9pt;border:solid windowtext 1.0pt;
  border-left:none;padding:0cm 5.4pt 0cm 5.4pt;height:10.2pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;text-autospace:none'><span style='font-size:8.0pt;font-family:"Arial",sans-serif;
  color:black'><?php echo $ALMT; ?></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:5;height:3.35pt'>
  <td width=735 colspan=19 valign=top style='width:551.4pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:3.35pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:4.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:6;height:10.2pt'>
  <td width=35 valign=top style='width:26.4pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:10.2pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
  <td width=136 colspan=6 valign=top style='width:102.35pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:10.2pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;text-autospace:none'><span style='font-size:8.0pt;font-family:"Arial",sans-serif;
  color:black'>a. Desa/Kelurahan</span></p>
  </td>
  <td width=238 colspan=2 valign=top style='width:178.5pt;border:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:10.2pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;text-autospace:none'><span style='font-size:8.0pt;font-family:"Arial",sans-serif;
  color:black'><?php echo $DESA; ?></span></p>
  </td>
  <td width=74 colspan=2 valign=top style='width:55.75pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:10.2pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>c.
  Kab/Kota</span></p>
  </td>
  <td width=251 colspan=8 valign=top style='width:188.4pt;border:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:10.2pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;text-autospace:none'><span style='font-size:8.0pt;font-family:"Arial",sans-serif;
  color:black'><?php echo $KAB; ?></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:7;height:3.35pt'>
  <td width=735 colspan=19 valign=top style='width:551.4pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:3.35pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:4.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:8;height:10.2pt'>
  <td width=35 valign=top style='width:26.4pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:10.2pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
  <td width=136 colspan=6 valign=top style='width:102.35pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:10.2pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;text-autospace:none'><span style='font-size:8.0pt;font-family:"Arial",sans-serif;
  color:black'>b. Kecamatan</span></p>
  </td>
  <td width=238 colspan=2 valign=top style='width:178.5pt;border:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:10.2pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;text-autospace:none'><span style='font-size:8.0pt;font-family:"Arial",sans-serif;
  color:black'><?php echo $KEC; ?></span></p>
  </td>
  <td width=74 colspan=2 valign=top style='width:55.75pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:10.2pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>d.
  Provinsi</span></p>
  </td>
  <td width=251 colspan=8 valign=top style='width:188.4pt;border:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:10.2pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;text-autospace:none'><span style='font-size:8.0pt;font-family:"Arial",sans-serif;
  color:black'><?php echo $PROV; ?></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:9;mso-yfti-lastrow:yes;height:3.35pt'>
  <td width=735 colspan=19 valign=top style='width:551.4pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:3.35pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:4.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
 </tr>
 <![if !supportMisalignedColumns]>
 <tr height=0>
  <td width=35 style='border:none'></td>
  <td width=23 style='border:none'></td>
  <td width=23 style='border:none'></td>
  <td width=23 style='border:none'></td>
  <td width=23 style='border:none'></td>
  <td width=23 style='border:none'></td>
  <td width=21 style='border:none'></td>
  <td width=130 style='border:none'></td>
  <td width=108 style='border:none'></td>
  <td width=65 style='border:none'></td>
  <td width=10 style='border:none'></td>
  <td width=56 style='border:none'></td>
  <td width=22 style='border:none'></td>
  <td width=22 style='border:none'></td>
  <td width=22 style='border:none'></td>
  <td width=65 style='border:none'></td>
  <td width=22 style='border:none'></td>
  <td width=22 style='border:none'></td>
  <td width=22 style='border:none'></td>
 </tr>
 <![endif]>
</table>

<p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt'><span
style='font-size:2.0pt;line-height:105%'><o:p>&nbsp;</o:p></span></p>

<table class=MsoNormalTable border=0 cellspacing=0 cellpadding=0 width=738
 style='width:553.35pt;margin-left:-1.5pt;border-collapse:collapse;mso-yfti-tbllook:
 1184;mso-padding-alt:0cm 0cm 0cm 0cm'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;mso-yfti-lastrow:yes;
  height:10.2pt'>
  <td width=17 valign=top style='width:13.05pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:10.2pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
  <td width=17 valign=top style='width:13.05pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:10.2pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
  <td width=17 valign=top style='width:13.05pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:10.2pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
  <td width=17 valign=top style='width:13.05pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:10.2pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
  <td width=17 valign=top style='width:13.05pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:10.2pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
  <td width=17 valign=top style='width:13.05pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:10.2pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
  <td width=68 valign=top style='width:50.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:10.2pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
  <td width=66 valign=top style='width:49.6pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:10.2pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;text-autospace:none'><span style='font-size:8.0pt;font-family:"Arial",sans-serif;
  color:black'>Kode Pos</span></p>
  </td>
  
  <?php echo changeCell("5",$RULEKODEPOS," width=34 valign=top style='width:25.5pt;border:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:10.2pt'"," class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;text-autospace:none'","
  style='font-size:8.0pt;font-family:\"Arial\",sans-serif;color:black'"); ?>
  <td width=76 valign=top style='width:57.15pt;border:none;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:10.2pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>Telepon</span></p>
  </td>
  
  <?php echo changeCell("10","."," width=25 valign=top style='width:19.0pt;border:solid windowtext 1.0pt;
  border-left:none;padding:0cm 5.4pt 0cm 5.4pt;height:10.2pt'"," class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;text-autospace:none'","
  style='font-size:8.0pt;font-family:\"Arial\",sans-serif;color:black'"); ?>

 </tr>
</table>

<p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt'><span
style='font-size:2.0pt;line-height:105%'><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt'><span
style='font-size:2.0pt;line-height:105%'><o:p>&nbsp;</o:p></span></p>

<table class=MsoNormalTable border=0 cellspacing=0 cellpadding=0 width=710
 style='width:532.7pt;margin-left:-1.5pt;border-collapse:collapse;mso-yfti-tbllook:
 1184;mso-padding-alt:0cm 0cm 0cm 0cm'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;mso-yfti-lastrow:yes;
  height:3.35pt'>
  <td width=172 valign=top style='width:129.1pt;border:none;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:3.35pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;text-autospace:none'><span style='font-size:8.0pt;font-family:"Arial",sans-serif;
  color:black'>4. NIK Pemohon</span><o:p></o:p></p>
  </td>
  <?php echo changeCell("16",$NOID," width=32 valign=top style='width:24.1pt;border:solid windowtext 1.0pt;
  border-left:none;padding:0cm 5.4pt 0cm 5.4pt;height:3.35pt'","  class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;text-autospace:none'"," 
  style='font-size:8.0pt;font-family:\"Arial\",sans-serif;color:black'"); ?>
 
  <td width=24 valign=top style='width:18.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:3.35pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span><o:p></o:p></p>
  </td>
 </tr>
</table>

<p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt'><span
style='font-size:2.0pt;line-height:105%'><o:p>&nbsp;</o:p></span></p>

<table class=MsoNormalTable border=0 cellspacing=0 cellpadding=0 width=735
 style='width:551.4pt;margin-left:-1.5pt;border-collapse:collapse;mso-yfti-tbllook:
 1184;mso-padding-alt:0cm 0cm 0cm 0cm'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;height:10.2pt'>
  <td width=172 valign=top style='width:128.75pt;border:none;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:10.2pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;text-autospace:none'><span style='font-size:8.0pt;font-family:"Arial",sans-serif;
  color:black'>5. Nama Lengkap</span></p>
  </td>
  <td width=564 valign=top style='width:422.65pt;border:solid windowtext 1.0pt;
  border-left:none;padding:0cm 5.4pt 0cm 5.4pt;height:10.2pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;text-autospace:none'><span style='font-size:8.0pt;font-family:"Arial",sans-serif;
  color:black'><?php echo $NAMA; ?></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:1;height:10.2pt'>
  <td width=735 colspan=2 valign=top style='width:551.4pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:10.2pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:2;mso-yfti-lastrow:yes;height:10.2pt'>
  <td width=735 colspan=2 valign=top style='width:551.4pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:10.2pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;text-autospace:none'><b><span style='font-family:"Arial Black",sans-serif;
  color:black'>DATA DAERAH TUJUAN</span></b></p>
  </td>
 </tr>
</table>

<p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt'><span
style='font-size:2.0pt;line-height:105%'><o:p>&nbsp;</o:p></span></p>


<table class=MsoNormalTable border=0 cellspacing=0 cellpadding=0 width=743
 style='width:557.25pt;margin-left:-1.5pt;border-collapse:collapse;mso-yfti-tbllook:
 1184;mso-padding-alt:0cm 0cm 0cm 0cm'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;height:10.2pt;mso-row-margin-right:
  .6pt'>
  <td width=172 valign=top style='width:128.75pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:10.2pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;text-autospace:none'><span style='font-size:8.0pt;font-family:"Arial",sans-serif;
  color:black'>1. Status Nomor KK</span></p>
  </td>
  <td width=29 valign=top style='width:21.6pt;border:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:10.2pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'><?php echo $ddt_KKYGPD; ?></span></p>
  </td>
  <td width=542 valign=top style='width:406.3pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:10.2pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;text-autospace:none'><span style='font-size:8.0pt;font-family:"Arial",sans-serif;
  color:black'>1. Numpang KK&nbsp;&nbsp; 2. Membuat KK Baru&nbsp;&nbsp; 3.
  Nomor KK Tetap</span></p>
  </td>
  <td style='mso-cell-special:placeholder;border:none;padding:0cm 0cm 0cm 0cm'
  width=1><p class='MsoNormal'>&nbsp;</td>
 </tr>
 <tr style='mso-yfti-irow:1;mso-yfti-lastrow:yes;height:10.2pt'>
  <td width=743 colspan=4 valign=top style='width:557.25pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:10.2pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;text-autospace:none'><span style='font-size:8.0pt;font-family:"Arial",sans-serif;
  color:black'>&nbsp;&nbsp;&nbsp; Bagi Yang Pindah</span></p>
  </td>
 </tr>
</table>

<p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt'><span
style='font-size:2.0pt;line-height:105%'><o:p>&nbsp;</o:p></span></p>

<table class=MsoNormalTable border=0 cellspacing=0 cellpadding=0 width=710
 style='width:532.7pt;margin-left:-1.5pt;border-collapse:collapse;mso-yfti-tbllook:
 1184;mso-padding-alt:0cm 0cm 0cm 0cm'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;mso-yfti-lastrow:yes;
  height:3.35pt'>
  <td width=172 valign=top style='width:129.1pt;border:none;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:3.35pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;text-autospace:none'><span style='font-size:8.0pt;font-family:"Arial",sans-serif;
  color:black'>2. Nomor Kartu Keluarga</span><o:p></o:p></p>
  </td>
     <?php echo changeCell("16",$ddt_NOKK," width=32 valign=top style='width:24.1pt;border:solid windowtext 1.0pt;
  border-left:none;padding:0cm 5.4pt 0cm 5.4pt;height:3.35pt'","  class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;text-autospace:none'"," 
  style='font-size:8.0pt;font-family:\"Arial\",sans-serif;color:black'"); ?>
  <td width=24 valign=top style='width:18.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:3.35pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span><o:p></o:p></p>
  </td>
 </tr>
</table>

<p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt'><span
style='font-size:2.0pt;line-height:105%'><o:p>&nbsp;</o:p></span></p>

<table class=MsoNormalTable border=0 cellspacing=0 cellpadding=0 width=710
 style='width:532.7pt;margin-left:-1.5pt;border-collapse:collapse;mso-yfti-tbllook:
 1184;mso-padding-alt:0cm 0cm 0cm 0cm'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;mso-yfti-lastrow:yes;
  height:3.35pt'>
  <td width=172 valign=top style='width:129.1pt;border:none;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:3.35pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;text-autospace:none'><span style='font-size:8.0pt;font-family:"Arial",sans-serif;
  color:black'>3. NIK Kepala Keluarga</span><o:p></o:p></p>
  </td>
     <?php echo changeCell("16",$ddt_NIKKK," width=32 valign=top style='width:24.1pt;border:solid windowtext 1.0pt;
  border-left:none;padding:0cm 5.4pt 0cm 5.4pt;height:3.35pt'","  class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;text-autospace:none'"," 
  style='font-size:8.0pt;font-family:\"Arial\",sans-serif;color:black'"); ?>
  <td width=24 valign=top style='width:18.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:3.35pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span><o:p></o:p></p>
  </td>
 </tr>
</table>

<p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt'><span
style='font-size:2.0pt;line-height:105%'><o:p>&nbsp;</o:p></span></p>

<table class=MsoNormalTable border=0 cellspacing=0 cellpadding=0 width=735
 style='width:551.4pt;margin-left:-1.5pt;border-collapse:collapse;mso-yfti-tbllook:
 1184;mso-padding-alt:0cm 0cm 0cm 0cm'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;height:10.2pt'>
  <td width=172 valign=top style='width:128.75pt;border:none;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:10.2pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;text-autospace:none'><span style='font-size:8.0pt;font-family:"Arial",sans-serif;
  color:black'>4. Nama Keapala Keluarga</span></p>
  </td>
  <td width=564 valign=top style='width:422.65pt;border:solid windowtext 1.0pt;
  border-left:none;padding:0cm 5.4pt 0cm 5.4pt;height:10.2pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;text-autospace:none'><span style='font-size:8.0pt;font-family:"Arial",sans-serif;
  color:black'><?php echo $ddt_NMKK; ?></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:1;mso-yfti-lastrow:yes;height:3.35pt'>
  <td width=735 colspan=2 valign=top style='width:551.4pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:3.35pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:4.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
 </tr>
</table>

<p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt'><span
style='font-size:2.0pt;line-height:105%'><o:p>&nbsp;</o:p></span></p>

<table class=MsoNormalTable border=0 cellspacing=0 cellpadding=0 width=549
 style='width:411.45pt;margin-left:-1.5pt;border-collapse:collapse;mso-yfti-tbllook:
 1184;mso-padding-alt:0cm 0cm 0cm 0cm'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;mso-yfti-lastrow:yes;
  height:10.2pt'>
  <td width=170 valign=top style='width:127.6pt;border:none;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:10.2pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;text-autospace:none'><span style='font-size:8.0pt;font-family:"Arial",sans-serif;
  color:black'>5. Tanggal Kepindahan</span></p>
  </td>
     <?php echo changeCell("2",$TGLP," width=40 valign=top style='width:29.85pt;border:solid windowtext 1.0pt;
  border-left:none;padding:0cm 5.4pt 0cm 5.4pt;height:10.2pt'"," class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;text-autospace:none'","
  style='font-size:8.0pt;font-family:\"Arial\",sans-serif;color:black'"); ?> 
 
  <td width=28 valign=top style='width:21.25pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:10.2pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
       <?php echo changeCell("2",$BLNP," width=38 valign=top style='width:1.0cm;border:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:10.2pt'"," class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;text-autospace:none'","
  style='font-size:8.0pt;font-family:\"Arial\",sans-serif;color:black'"); ?> 

  <td width=28 valign=top style='width:21.25pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:10.2pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
   <?php echo changeCell("4",$THNP," width=38 valign=top style='width:1.0cm;border:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:10.2pt'"," class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;text-autospace:none'","
  style='font-size:8.0pt;font-family:\"Arial\",sans-serif;color:black'"); ?> 


  <td width=17 valign=top style='width:13.05pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:10.2pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
 </tr>
</table>

<p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt'><span
style='font-size:2.0pt;line-height:105%'><o:p>&nbsp;</o:p></span></p>

<table class=MsoNormalTable border=0 cellspacing=0 cellpadding=0 width=735
 style='width:551.4pt;margin-left:-1.5pt;border-collapse:collapse;mso-yfti-tbllook:
 1184;mso-padding-alt:0cm 0cm 0cm 0cm'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;height:3.35pt'>
  <td width=735 colspan=33 valign=top style='width:551.4pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:3.35pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:4.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:1;height:10.2pt'>
  <td width=172 colspan=7 valign=top style='width:128.75pt;border:none;
  border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;height:10.2pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;text-autospace:none'><span style='font-size:8.0pt;font-family:"Arial",sans-serif;
  color:black'>6. Alamat</span></p>
  </td>
  <td width=303 colspan=14 valign=top style='width:226.95pt;border:solid windowtext 1.0pt;
  border-left:none;padding:0cm 5.4pt 0cm 5.4pt;height:10.2pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;text-autospace:none'><span style='font-size:8.0pt;font-family:"Arial",sans-serif;
  color:black'>_</span></p>
  </td>
  <td width=65 colspan=3 valign=top style='width:49.1pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:10.2pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>RT</span></p>
  </td>
  
  <?php echo changeCellR("3",$ddt_RT," width=22 valign=top style='width:16.35pt;border:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:10.2pt'"," class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;text-autospace:none'","
  style='font-size:8.0pt;font-family:\"Arial\",sans-serif;color:black'"); ?>
    
  <td width=65 colspan=3 valign=top style='width:48.9pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:10.2pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>RW</span></p>
  </td>
  
  <?php echo changeCellR("3",$ddt_RW," width=22 valign=top style='width:16.35pt;border:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:10.2pt'"," class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;text-autospace:none'","
  style='font-size:8.0pt;font-family:\"Arial\",sans-serif;color:black'"); ?>
 </tr>
 <tr style='mso-yfti-irow:2;height:3.35pt'>
  <td width=735 colspan=33 valign=top style='width:551.4pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:3.35pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:4.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:3;height:10.2pt'>
  <td width=35 valign=top style='width:26.4pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:10.2pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
  <td width=23 valign=top style='width:17.25pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:10.2pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
  <td width=23 valign=top style='width:17.25pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:10.2pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
  <td width=23 valign=top style='width:17.25pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:10.2pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
  <td width=23 valign=top style='width:17.25pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:10.2pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
  <td width=23 valign=top style='width:17.25pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:10.2pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
  <td width=21 valign=top style='width:16.1pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:10.2pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
  <td width=130 colspan=6 valign=top style='width:97.75pt;border:none;
  border-right:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;height:10.2pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>Dusun/Dukuh/Kampung</span></p>
  </td>
  <td width=433 colspan=20 valign=top style='width:324.9pt;border:solid windowtext 1.0pt;
  border-left:none;padding:0cm 5.4pt 0cm 5.4pt;height:10.2pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;text-autospace:none'><span style='font-size:8.0pt;font-family:"Arial",sans-serif;
  color:black'><?php echo $ddt_ALMT; ?></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:4;height:3.35pt'>
  <td width=735 colspan=33 valign=top style='width:551.4pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:3.35pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:4.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:5;height:10.2pt'>
  <td width=35 valign=top style='width:26.4pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:10.2pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
  <td width=136 colspan=6 valign=top style='width:102.35pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:10.2pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;text-autospace:none'><span style='font-size:8.0pt;font-family:"Arial",sans-serif;
  color:black'>a. Desa/Kelurahan</span></p>
  </td>
  <td width=238 colspan=11 valign=top style='width:178.5pt;border:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:10.2pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;text-autospace:none'><span style='font-size:8.0pt;font-family:"Arial",sans-serif;
  color:black'><?php echo $ddt_DESA; ?></span></p>
  </td>
  <td width=86 colspan=4 valign=top style='width:64.85pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:10.2pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>c.
  Kab/Kota</span></p>
  </td>
  <td width=239 colspan=11 valign=top style='width:179.3pt;border:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:10.2pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;text-autospace:none'><span style='font-size:8.0pt;font-family:"Arial",sans-serif;
  color:black'><?php echo $ddt_KAB; ?></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:6;height:3.35pt'>
  <td width=735 colspan=33 valign=top style='width:551.4pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:3.35pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:4.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:7;height:10.2pt'>
  <td width=35 valign=top style='width:26.4pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:10.2pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
  <td width=136 colspan=6 valign=top style='width:102.35pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:10.2pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;text-autospace:none'><span style='font-size:8.0pt;font-family:"Arial",sans-serif;
  color:black'>b. Kecamatan</span></p>
  </td>
  <td width=238 colspan=11 valign=top style='width:178.5pt;border:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:10.2pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;text-autospace:none'><span style='font-size:8.0pt;font-family:"Arial",sans-serif;
  color:black'><?php echo $ddt_KEC; ?></span></p>
  </td>
  <td width=86 colspan=4 valign=top style='width:64.85pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:10.2pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>d.
  Provinsi</span></p>
  </td>
  <td width=239 colspan=11 valign=top style='width:179.3pt;border:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:10.2pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;text-autospace:none'><span style='font-size:8.0pt;font-family:"Arial",sans-serif;
  color:black'><?php echo $ddt_PROV; ?></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:8;height:3.35pt'>
  <td width=735 colspan=33 valign=top style='width:551.4pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:3.35pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:4.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:9;height:10.2pt'>
  <td width=150 colspan=6 valign=top style='width:112.65pt;border:none;
  border-bottom:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;height:10.2pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;text-autospace:none'><span style='font-size:8.0pt;font-family:"Arial",sans-serif;
  color:black'>7. Keluarga Yang Datang</span></p>
  </td>
  <td width=21 valign=top style='width:16.1pt;border:none;border-bottom:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:10.2pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;text-autospace:none'><span style='font-size:8.0pt;font-family:"Arial",sans-serif;
  color:black'>&nbsp;</span></p>
  </td>
  <td width=22 valign=top style='width:16.35pt;border:none;border-bottom:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:10.2pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
  <td width=22 valign=top style='width:16.3pt;border:none;border-bottom:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:10.2pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
  <td width=22 valign=top style='width:16.3pt;border:none;border-bottom:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:10.2pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
  <td width=22 valign=top style='width:16.25pt;border:none;border-bottom:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:10.2pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
  <td width=22 valign=top style='width:16.3pt;border:none;border-bottom:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:10.2pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
  <td width=22 valign=top style='width:16.25pt;border:none;border-bottom:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:10.2pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
  <td width=22 valign=top style='width:16.15pt;border:none;border-bottom:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:10.2pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
  <td width=22 valign=top style='width:16.15pt;border:none;border-bottom:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:10.2pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
  <td width=22 valign=top style='width:16.15pt;border:none;border-bottom:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:10.2pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
  <td width=22 valign=top style='width:16.15pt;border:none;border-bottom:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:10.2pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
  <td width=22 valign=top style='width:16.15pt;border:none;border-bottom:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:10.2pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
  <td width=22 valign=top style='width:16.15pt;border:none;border-bottom:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:10.2pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
  <td width=22 valign=top style='width:16.15pt;border:none;border-bottom:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:10.2pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
  <td width=22 valign=top style='width:16.15pt;border:none;border-bottom:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:10.2pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
  <td width=22 valign=top style='width:16.4pt;border:none;border-bottom:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:10.2pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
  <td width=22 valign=top style='width:16.35pt;border:none;border-bottom:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:10.2pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
  <td width=22 valign=top style='width:16.35pt;border:none;border-bottom:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:10.2pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
  <td width=22 valign=top style='width:16.35pt;border:none;border-bottom:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:10.2pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
  <td width=22 valign=top style='width:16.35pt;border:none;border-bottom:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:10.2pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
  <td width=22 valign=top style='width:16.3pt;border:none;border-bottom:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:10.2pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
  <td width=22 valign=top style='width:16.3pt;border:none;border-bottom:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:10.2pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
  <td width=22 valign=top style='width:16.3pt;border:none;border-bottom:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:10.2pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
  <td width=22 valign=top style='width:16.3pt;border:none;border-bottom:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:10.2pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
  <td width=22 valign=top style='width:16.25pt;border:none;border-bottom:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:10.2pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
  <td width=22 valign=top style='width:16.3pt;border:none;border-bottom:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:10.2pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
  <td width=22 valign=top style='width:16.15pt;border:none;border-bottom:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:10.2pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:10;height:24.9pt'>
  <td width=35 valign=top style='width:26.4pt;border:solid windowtext 1.0pt;
  border-top:none;padding:0cm 5.4pt 0cm 5.4pt;height:24.9pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;text-autospace:none'><b><span
  style='font-size:7.0pt;font-family:"Arial",sans-serif;color:black'>NO.</span></b></p>
  </td>
  <td width=353 colspan=16 valign=top style='width:264.7pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:24.9pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;text-autospace:none'><b><span
  style='font-size:7.0pt;font-family:"Arial",sans-serif;color:black'>N I K</span></b></p>
  </td>
  <td width=304 colspan=14 valign=top style='width:227.85pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:24.9pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;text-autospace:none'><b><span
  style='font-size:7.0pt;font-family:"Arial",sans-serif;color:black'>N A M A</span></b></p>
  </td>
  <td width=43 colspan=2 valign=top style='width:32.45pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:24.9pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;text-autospace:none'><b><span
  style='font-size:7.0pt;font-family:"Arial",sans-serif;color:black'>SHDK</span></b></p>
  </td>
 </tr>
 
 <?php 
 
  $no=1;
  foreach ($_POST['anggkk'] as $selectedOption){ 
  $NOPEN = split_char($selectedOption); 
  $pen  = mysql_query("SELECT * FROM penduduk WHERE no_pen='$selectedOption'");
  $p=mysql_fetch_array($pen);
 ?>
  <tr style='mso-yfti-irow:11;height:10.2pt'>
  <td width=35 valign=top style='width:26.4pt;border:solid windowtext 1.0pt;
  border-top:none;padding:0cm 5.4pt 0cm 5.4pt;height:10.2pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'><?php echo $no; ?></span></p>
  </td>
  
     <?php echo changeCell("16",$p['no_pen']," width=23 valign=top style='width:17.25pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:10.2pt'"," class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;text-autospace:none'","
  style='font-size:8.0pt;font-family:\"Arial\",sans-serif;color:black'"); ?> 
  <td width=304 colspan=14 valign=top style='width:227.85pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:10.2pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;text-autospace:none'><span style='font-size:8.0pt;font-family:"Arial",sans-serif;
  color:black'><?php echo $p['nama_pen']; ?></span></p>
  </td>
  <?php echo changeCellR("2",$p['status_hdk_pen']," width=22 valign=top style='width:16.3pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:10.2pt'"," class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;text-autospace:none'","
  style='font-size:8.0pt;font-family:\"Arial\",sans-serif;color:black'"); ?> 
   
 </tr>

 
 
 <?php
 
  $no++;
  }
  $jmldatatr = $no;
  $batas = 7;
  if ($jmldatatr < $batas) {
	$jmltr = $batas-$jmldatatr;
	$jmltrmulai = $jmldatatr;
     for ($i=$jmltrmulai; $i<=$batas; $i++){
	  ?>
	   <tr style='mso-yfti-irow:11;height:10.2pt'>
  <td width=35 valign=top style='width:26.4pt;border:solid windowtext 1.0pt;
  border-top:none;padding:0cm 5.4pt 0cm 5.4pt;height:10.2pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'><?php echo $i; ?></span></p>
  </td>
  
     <?php echo changeCell("16","-"," width=23 valign=top style='width:17.25pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:10.2pt'"," class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;text-autospace:none'","
  style='font-size:8.0pt;font-family:\"Arial\",sans-serif;color:black'"); ?> 
  <td width=304 colspan=14 valign=top style='width:227.85pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:10.2pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;text-autospace:none'><span style='font-size:8.0pt;font-family:"Arial",sans-serif;
  color:black'>-</span></p>
  </td>
  <?php echo changeCell("2","--"," width=22 valign=top style='width:16.3pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:10.2pt'"," class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;text-autospace:none'","
  style='font-size:8.0pt;font-family:\"Arial\",sans-serif;color:black'"); ?> 
   
 </tr>

 
 <?php
  
	 }
	 
	 }
	 ?>
	 
 
 
 <tr style='mso-yfti-irow:18;height:7.55pt'>
  <td width=735 colspan=33 valign=top style='width:551.4pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:7.55pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:19;height:7.55pt'>
  <td width=735 colspan=33 valign=top style='width:551.4pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:7.55pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:20;height:7.55pt'>
  <td width=35 valign=top style='width:26.4pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:7.55pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
  <td width=23 valign=top style='width:17.25pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:7.55pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
  <td width=23 valign=top style='width:17.25pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:7.55pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
  <td width=23 valign=top style='width:17.25pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:7.55pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
  <td width=23 valign=top style='width:17.25pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:7.55pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
  <td width=23 valign=top style='width:17.25pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:7.55pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
  <td width=21 valign=top style='width:16.1pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:7.55pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
  <td width=22 valign=top style='width:16.35pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:7.55pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
  <td width=22 valign=top style='width:16.3pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:7.55pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
  <td width=22 valign=top style='width:16.3pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:7.55pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
  <td width=22 valign=top style='width:16.25pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:7.55pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
  <td width=22 valign=top style='width:16.3pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:7.55pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
  <td width=22 valign=top style='width:16.25pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:7.55pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
  <td width=22 valign=top style='width:16.15pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:7.55pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
  <td width=22 valign=top style='width:16.15pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:7.55pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
  <td width=22 valign=top style='width:16.15pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:7.55pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
  <td width=22 valign=top style='width:16.15pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:7.55pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
  <td width=22 valign=top style='width:16.15pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:7.55pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
  <td width=22 valign=top style='width:16.15pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:7.55pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
  <td width=22 valign=top style='width:16.15pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:7.55pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
  <td width=22 valign=top style='width:16.15pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:7.55pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
  <td width=239 colspan=11 valign=top style='width:179.55pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:7.55pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'><?php echo $RULEKAB.", ".$TGLBUAT; ?></span></p>
  </td>
  <td width=22 valign=top style='width:16.15pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:7.55pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:21;height:7.55pt'>
  <td width=35 valign=top style='width:26.4pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:7.55pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
  <td width=245 colspan=11 valign=top style='width:183.85pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:7.55pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>Petugas
  Registrasi</span></p>
  </td>
  <td width=22 valign=top style='width:16.25pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:7.55pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
  <td width=22 valign=top style='width:16.15pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:7.55pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
  <td width=22 valign=top style='width:16.15pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:7.55pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
  <td width=22 valign=top style='width:16.15pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:7.55pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
  <td width=22 valign=top style='width:16.15pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:7.55pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
  <td width=22 valign=top style='width:16.15pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:7.55pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
  <td width=22 valign=top style='width:16.15pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:7.55pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
  <td width=22 valign=top style='width:16.15pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:7.55pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
  <td width=22 valign=top style='width:16.15pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:7.55pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
  <td width=239 colspan=11 valign=top style='width:179.55pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:7.55pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>Pemohon</span></p>
  </td>
  <td width=22 valign=top style='width:16.15pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:7.55pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:22;height:7.55pt'>
  <td width=735 colspan=33 valign=top style='width:551.4pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:7.55pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:23;height:7.55pt'>
  <td width=735 colspan=33 valign=top style='width:551.4pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:7.55pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:24;height:7.55pt'>
  <td width=735 colspan=33 valign=top style='width:551.4pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:7.55pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:25;height:7.55pt'>
  <td width=735 colspan=33 valign=top style='width:551.4pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:7.55pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:26;height:7.55pt'>
  <td width=35 valign=top style='width:26.4pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:7.55pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
  <td width=245 colspan=11 valign=top style='width:183.85pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:7.55pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>(..................................................................)</span></p>
  </td>
  <td width=22 valign=top style='width:16.25pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:7.55pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
  <td width=22 valign=top style='width:16.15pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:7.55pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
  <td width=22 valign=top style='width:16.15pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:7.55pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
  <td width=22 valign=top style='width:16.15pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:7.55pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
  <td width=22 valign=top style='width:16.15pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:7.55pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
  <td width=22 valign=top style='width:16.15pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:7.55pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
  <td width=22 valign=top style='width:16.15pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:7.55pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
  <td width=22 valign=top style='width:16.15pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:7.55pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
  <td width=22 valign=top style='width:16.15pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:7.55pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
  <td width=239 colspan=11 valign=top style='width:179.55pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:7.55pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>( <?php echo $NAMA; ?> )</span></p>
  </td>
  <td width=22 valign=top style='width:16.15pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:7.55pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:27;height:7.55pt'>
  <td width=735 colspan=33 valign=top style='width:551.4pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:7.55pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:28;height:7.55pt'>
  <td width=735 colspan=33 valign=top style='width:551.4pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:7.55pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;text-autospace:none'><span
  style='font-size:8.0pt;font-family:"Arial",sans-serif;color:black'>&nbsp;</span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:29;height:8.05pt'>
  <td width=735 colspan=33 valign=top style='width:551.4pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:8.05pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;text-autospace:none'><b><span style='font-size:9.0pt;font-family:"Arial",sans-serif;
  color:black'>Keterangan :</span></b></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:30;mso-yfti-lastrow:yes;height:8.05pt'>
  <td width=735 colspan=33 valign=top style='width:551.4pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:8.05pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;text-autospace:none'><span style='font-size:9.0pt;font-family:"Arial",sans-serif;
  color:black'>*) Diisi Oleh Petugas;</span></p>
  </td>
 </tr>
 <![if !supportMisalignedColumns]>
 <tr height=0>
  <td width=35 style='border:none'></td>
  <td width=23 style='border:none'></td>
  <td width=23 style='border:none'></td>
  <td width=23 style='border:none'></td>
  <td width=23 style='border:none'></td>
  <td width=23 style='border:none'></td>
  <td width=21 style='border:none'></td>
  <td width=22 style='border:none'></td>
  <td width=22 style='border:none'></td>
  <td width=22 style='border:none'></td>
  <td width=22 style='border:none'></td>
  <td width=22 style='border:none'></td>
  <td width=22 style='border:none'></td>
  <td width=22 style='border:none'></td>
  <td width=22 style='border:none'></td>
  <td width=22 style='border:none'></td>
  <td width=22 style='border:none'></td>
  <td width=22 style='border:none'></td>
  <td width=22 style='border:none'></td>
  <td width=22 style='border:none'></td>
  <td width=22 style='border:none'></td>
  <td width=22 style='border:none'></td>
  <td width=22 style='border:none'></td>
  <td width=22 style='border:none'></td>
  <td width=22 style='border:none'></td>
  <td width=22 style='border:none'></td>
  <td width=22 style='border:none'></td>
  <td width=22 style='border:none'></td>
  <td width=22 style='border:none'></td>
  <td width=22 style='border:none'></td>
  <td width=22 style='border:none'></td>
  <td width=22 style='border:none'></td>
  <td width=22 style='border:none'></td>
 </tr>
 <![endif]>
</table>

<p class=MsoNormal>&nbsp;</p>

</div>

</body>

</html>
