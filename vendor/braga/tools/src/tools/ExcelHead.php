<?php
namespace braga\tools\tools;
/**
 * Created on 11-03-2012 18:53:41
 * @author Tomasz Gajewski
 * @package package_name
 * error prefix
 */
class ExcelHead
{
	// -------------------------------------------------------------------------
	static function get($fileName = "Dane")
	{
		header("Cache-Control: no-cache");
		header("Pragma: no-cache");
		header("Content-Disposition: attachment; filename=\"" . $fileName . "\"");
		header("Content-type: application/vnd.ms-excel");
		$retval = "<html xmlns:o=\"urn:schemas-microsoft-com:office:office\"
xmlns:x=\"urn:schemas-microsoft-com:office:excel\"
xmlns=\"http://www.w3.org/TR/REC-html40\">

<head>
<meta http-equiv=Content-Type content=\"text/html; charset=utf-8\">
<meta name=ProgId content=Excel.Sheet>
<meta name=Generator content=\"TransSped\">

<!--[if gte mso 9]><xml>
 <o:DocumentProperties>
  <o:Author>TransSped</o:Author>
  <o:LastAuthor>TransSped</o:LastAuthor>
  <o:Created>" . date("%Y-%m-%d") . "T" . date("%H:%i:%s") . "Z</o:Created>
  <o:LastSaved>" . date("%Y-%m-%d") . "T" . date("%H:%i:%s") . "Z</o:LastSaved>
  <o:Company>Tomasz Gajewski INC</o:Company>
  <o:Version>9.6926</o:Version>
 </o:DocumentProperties>
 <o:OfficeDocumentSettings>
  <o:DownloadComponents/>
  <o:LocationOfComponents HRef=\"file:C:\msowc.cab\"/>
 </o:OfficeDocumentSettings>
</xml><![endif]-->
<style>
<!--table
	{mso-displayed-decimal-separator:\"\.\";
	mso-displayed-thousand-separator:\"`\";}
@page
	{margin:.98in .79in .98in .79in;
	mso-header-margin:.5in;
	mso-footer-margin:.5in;
	mso-page-orientation:landscape;}
tr
	{mso-height-source:auto;}
col
	{mso-width-source:auto;}
br
	{mso-data-placement:same-cell;}
.style0
	{mso-number-format:General;
	text-align:general;
	vertical-align:bottom;
	white-space:nowrap;
	mso-rotate:0;
	mso-background-source:auto;
	mso-pattern:auto;
	color:windowtext;
	font-size:10.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:\"Arial\";
	mso-generic-font-family:auto;
	mso-font-charset:238;
	border:none;
	mso-protection:locked visible;
	mso-style-name:Normalny;
	mso-style-id:0;}
td
	{mso-style-parent:style0;
	padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:windowtext;
	font-size:10.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:\"Arial\";
	mso-generic-font-family:auto;
	mso-font-charset:238;
	mso-number-format:General;
	border:0.1pt black solid;
	mso-pattern:auto none;
	mso-background-source:auto;
	mso-protection:locked visible;
	white-space:normal;
	mso-rotate:0;}

td.no_border
	{
		border:none;
	}


.bigheader
	{font-size:20px;
	text-align:center;}
.bordered
	{border: 1px black solid;}

.xl25
	{mso-style-parent:style0;
	font-size:9.0pt;
	border: 1.0pt solid black;
	white-space:normal;}

.xl26
	{mso-style-parent:style0;
	font-size:15.0pt;
	text-align:center;
	vertical-align:middle;
	white-space:normal;}
.yellow
	{background:#FFFFDD;

	}
.blue
	{background:#99CCFF;

	}
.white
	{background:#FFFFFF;
	}

.Chocolate
	{background:#FF6600;}

.Gold
	{background:#FFCC00;}

.Khaki
	{background:#FFFF99;}

.LightCyan
	{background:#CCFFFF;}

.Orange
	{background:#FF9900;}

.PeachPuff
	{background:#FFCC99;}

.SkyBlue
	{background:#99CCFF;}

.YellowGreen
	{background:#CCFFCC;}

.xldate
	{mso-style-parent:style0;
	mso-number-format:\"dd\\-mm\\-yyyy\";}


.DBListDate
	{mso-style-parent:style0;
	text-align:right;
	mso-number-format:\"dd\\-mm\\-yyyy\";}
.DBListNumber
	{mso-style-parent:style0;
	text-align:right;
	mso-number-format:\"\#\,\#\#0\.00_ \;\[Red\]\\-\#\,\#\#0\.00\\ \";}
.DBListProcent
	{mso-style-parent:style0;
	text-align:right;
	mso-number-format:0%;}
.DBListText
	{mso-style-parent:style0;
	text-align:left;}
.RedDot {
	color:red;
}
.BlueDot {
	color:blue;
}
.l {
	text-align:left;
}
.r {
	text-align:right;
}
.c {
	text-align:center;
}
-->
</style>
<!--[if gte mso 9]><xml>
 <x:ExcelWorkbook>
  <x:ExcelWorksheets>
   <x:ExcelWorksheet>
	<x:Name>Stan na dzień " . date("Y-m-d H.i") . "</x:Name>
	<x:WorksheetOptions>
	 <x:FitToPage/>
	 <x:Print>
	  <x:ValidPrinterInfo/>
	  <x:PaperSizeIndex>9</x:PaperSizeIndex>
	  <x:Scale>72</x:Scale>
	  <x:HorizontalResolution>600</x:HorizontalResolution>
	  <x:VerticalResolution>600</x:VerticalResolution>
	 </x:Print>
	 <x:Selected/>
	 <x:Panes>
	  <x:Pane>
	   <x:Number>1</x:Number>
	   <x:ActiveRow>1</x:ActiveRow>
	   <x:ActiveCol>1</x:ActiveCol>
	  </x:Pane>
	 </x:Panes>
	 <x:ProtectContents>False</x:ProtectContents>
	 <x:ProtectObjects>False</x:ProtectObjects>
	 <x:ProtectScenarios>False</x:ProtectScenarios>
	</x:WorksheetOptions>
   </x:ExcelWorksheet>
  </x:ExcelWorksheets>
  <x:WindowHeight>12360</x:WindowHeight>
  <x:WindowWidth>18015</x:WindowWidth>
  <x:WindowTopX>480</x:WindowTopX>
  <x:WindowTopY>15</x:WindowTopY>
  <x:ProtectStructure>False</x:ProtectStructure>
  <x:ProtectWindows>False</x:ProtectWindows>
 </x:ExcelWorkbook>
</xml><![endif]-->
</head>
";
		return $retval;
	}
	// -------------------------------------------------------------------------
}
?>