<?php
//==============================================
// Author: FSI                                 =
// Date-written = Sep 30, 2010                 =
// Filename: export_masterdata.php             =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
//==============================================
session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );
}
$header='';
$data='';
include('classes/masterdataClass.php');
$newMD = new masterdata;
//Initialize the XML parser
$parser=xml_parser_create();
$masterdatarecnum=$_REQUEST['masterdatarecnum'];
$result = $newMD->getmasterdata($masterdatarecnum);
$myrow = mysql_fetch_assoc($result);

//Function to use at the start of an element
function start($parser,$element_name,$element_attrs)
{
  switch($element_name)
    {
    case "XML":
    echo "XML ";
    break;  
    case "MASTER_DATA":
    echo "MASTER_DATA ";
    break;  
    case "PARTNAME":
    echo "PARTNAME: ";
    break;    
    case "CUSTOMER":
    echo "CUSTOMER: ";
    break;
    case "PARTNUM":
    echo "PARTNUM: ";
    break;
    case "RM_BY_CIM":
    echo "RM_BY_CIM: ";
    break;
    case "PROJECT":
    echo "PROJECT: ";
    break;
    case "ATTACHMENT":
    echo "ATTACHMENT: ";
    break;
    case "RM_BY_CUSTOMER":
    echo "RM_BY_CUSTOMER: ";
    break;
    case "CIM_REFNUM":
    echo "CIM_REFNUM: ";
    break;
    case "DRG_ISSUE":
    echo "DRG_ISSUE: ";
    break;
    case "RM_TYPE":
    echo "RM_TYPE: ";
    break;
    case "RM_SPEC":
    echo "RM_SPEC: ";
    break;
    case "RM_DIM1":
    echo "RM_DIM1: ";
    break;
    case "RM_DIM2":
    echo "RM_DIM2: ";
    break;
    case "RM_DIM3":
    echo "RM_DIM3: ";
    break;
    case "MPS_REV":
    echo "MPS_REV: ";
    break;
    case "MPS_NUM":
    echo "MPS_NUM: ";
    break;
    case "DRAWING_NUM":
    echo "DRAWING_NUM: ";
    break;
    case "COS":
    echo "COS: ";
    break;
    case "CONDITION":
    echo "CONDITION: ";
    break;
    case "MAXRULING":
    echo "MAXRULING: ";
    break;
    case "GRAINFLOW":
    echo "GRAINFLOW: ";
    break;
    case "STATUS":
    echo "STATUS: ";
    break;
    case "MACHINE_NAME":
    echo "MACHINE_NAME: ";
    break;
    case "REVSTAT":
    echo "REVSTAT: ";
    break;
    case "SecPart":
    echo "SecPart: ";
    break;
    case "TYPE":
    echo "TYPE: ";
    break;
    case "APPROVAL":
    echo "APPROVAL: ";
    break;
    case "APPROVAL_DATE":
    echo "APPROVAL_DATE: ";
    break;
  case "LINE_NUM":
    echo "LINE_NUM: ";
    break;
  case "MPSREV":
    echo "MPSREV: ";
    break;
  case "REV_STATUS":
    echo "REV_STATUS: ";
    break;
  case "CONTROL":
    echo "CONTROL";
    break;
  case "REMARKS":
    echo "REMARKS";
    break;
  case "LINK2MASTER_DATA":
    echo "LINK2MASTER_DATA";
    break; 
  case "MASTER_DATA_RECNUM":
    echo "MASTER_DATA_RECNUM ";
    break; 
  case "MPS_RECNUM":
    echo "MPS_RECNUM ";
    break; 
    }
  }

//Function to use at the end of an element
function stop($parser,$element_name)
  {
  echo "<br />";
  }

//Function to use when finding character data
function char($parser,$data)
  {
  echo $data;
  }

//Specify element handler
xml_set_element_handler($parser,"start","stop");

//Specify data handler
xml_set_character_data_handler($parser,"char");

//Open XML file

$result4mps = $newMD->getmasterdata_mps($masterdatarecnum);

//Read data
$master_data_recnum=$myrow['recnum'];
$crn=$myrow["CIM_refnum"];
$partname=$myrow['partname'];
$drawing_num=$myrow["drawing_num"];
$partnum=$myrow["partnum"];
$customer=$myrow["customer"];
$rm_by_cim=$myrow["RM_by_CIM"];
$secondary_partname=$myrow["secondary_partname"];
$attachments=$myrow["attachments"];
$RM_by_customer=$myrow["RM_by_customer"];
$drg_issue=$myrow["drg_issue"];
$rm_type=$myrow["rm_type"];
$rm_spec=$myrow["rm_spec"];
$mps_rev=$myrow["mps_rev"];
$mps_num=$myrow["mps_num"];
$cos=$myrow["cos"];
$maxruling=$myrow["maxruling"];
$grainflow=$myrow["grainflow"];
$project=$myrow["project"];
$machine_name=$myrow["machine_name"];
$revstat=$myrow["revstat"];
$condition=$myrow["condition"];
$rm_dim1=$myrow["rm_dim1"];
$rm_dim2=$myrow["rm_dim2"];
$rm_dim3=$myrow["rm_dim3"];

$data .="<xml><master_data>
<MASTER_DATA_RECNUM>$master_data_recnum</MASTER_DATA_RECNUM>
<PARTNAME>$partname</PARTNAME>
<customer>$customer</customer>
<partnum>$partnum</partnum>
<rm_by_cim>$rm_by_cim</rm_by_cim>
<project>$project</project>
<attachment>$attachments</attachment>
<rm_by_customer>$RM_by_customer</rm_by_customer>
<cim_refnum>$crn</cim_refnum>
<drg_issue>$drg_issue</drg_issue>
<rm_type>$rm_type</rm_type>
<rm_spec>$rm_spec</rm_spec>
<rm_dim1>$rm_dim1</rm_dim1>
<rm_dim2>$rm_dim2</rm_dim2>
<rm_dim3>$rm_dim3</rm_dim3>
<mps_rev>$mps_rev</mps_rev>
<mps_num>$mps_num</mps_num>
<drawing_num>$drawing_num</drawing_num>
<cos>$cos</cos>
<condition>$condition</condition>
<maxruling>$maxruling</maxruling>
<grainflow>$grainflow</grainflow>
<status>$status</status>
<machine_name>$machine_name</machine_name>
<revstat>$revstat</revstat>
<SecPart>$secondary_partname</SecPart>
<type>type123</type>
<approval>approved</approval>
<approval_date>2010-09-05</approval_date>
</master_data>";

while($myrow4mps = mysql_fetch_row($result4mps))
{
$data .="
<mps>
<MPS_RECNUM>$myrow4mps[0]</MPS_RECNUM>
<line_num>$myrow4mps[1]</line_num>
<mpsrev>$myrow4mps[2]</mpsrev>
<rev_status>$myrow4mps[5]</rev_status>
<control>$myrow4mps[3]</control>
<remarks>$myrow4mps[4]</remarks>
<link2master_data>$myrow4mps[7]</link2master_data>
</mps>
";
}
$data .='</xml>';
header("Content-type: application/txt");
header("Content-Disposition: attachment; filename=$crn.txt"); 
header("Cache-Control: cache, must-revalidate");
header("Pragma: public");
header("Expires: 0");
print "$header\n$data";
?> 
