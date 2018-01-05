<?php
//
//==============================================
// Author: FSI                                 =
// Date-written = March 15,2005                =
// Filename: boardReport.php                   =
// Copyright (C) FluentSoft Inc.               =
// Contact bmandyam@fluentsoft.com             =
// Revision: v1.0 OWT                          =
// Board report                                =
//==============================================


session_start();
header("Cache-control: private");
header ("Content-type: image/png");
if ( !isset ( $_SESSION['user'] ) )
{
     header ( "Location: login.php" );

}
$userid = $_SESSION['user'];
$_SESSION['pagename'] = 'reports';
//////session_register('pagename');

// First include the class definition
include('classes/operatorClass.php');
include('classes/reportClass.php');
include_once('classes/displayClass.php');
$newdisplay = new display;
$newoperator = new operator;
$newreport = new report;

$newlogin = new userlogin;
$newlogin->dbconnect();

$result = $newreport->getcrn_details();
$result1 = $newreport->getact_time();

//echo 'Hi';

while($myrow = mysql_fetch_assoc($result))
{
   $crn=$myrow["crn"];
   $qty=$myrow["qty"];
   $crn_qty[] = array($crn,$qty);
}
while($myrow = mysql_fetch_assoc($result1))
{
   $crn=$myrow["crn"];
   $acttime=$myrow["time"];
   
   //echo "$acttime<br>";
   $crn_acttime[] = array($crn,$acttime);

$values[] = $acttime;

   $graph_labels[]=$crn;
   $graph_items[]=$acttime;
}

// print_r($values);
/*$values = array("23","32","35","57","12",
                    "3","36","54","32","15",
                    "43","24","30");
// Get the total number of columns we are going to plot

    $columns  = count($values);

// Get the height and width of the final image

    $width = 200;
    $height = 200;

// Set the amount of space between each column

    $padding = 5;

// Get the width of 1 column

    $column_width = $width / $columns ;

// Generate the image variables

    $im        = imagecreate($width,$height);
    $gray      = imagecolorallocate ($im,0xcc,0xcc,0xcc);
    $gray_lite = imagecolorallocate ($im,0xee,0xee,0xee);
    $gray_dark = imagecolorallocate ($im,0x7f,0x7f,0x7f);
    $white     = imagecolorallocate ($im,0xff,0xff,0xff);

// Fill in the background of the image

    imagefilledrectangle($im,0,0,$width,$height,$white);

    $maxv = 0;

// Calculate the maximum value we are going to plot

    for($i=0;$i<$columns;$i++)$maxv = max($values[$i],$maxv);

// Now plot each column

    for($i=0;$i<$columns;$i++)
    {
        $column_height = ($height / 100) * (( $values[$i] / $maxv) *100);

        $x1 = $i*$column_width;
        $y1 = $height-$column_height;
        $x2 = (($i+1)*$column_width)-$padding;
        $y2 = $height;

        imagefilledrectangle($im,$x1,$y1,$x2,$y2,$gray);

// This part is just for 3D effect

        imageline($im,$x1,$y1,$x1,$y2,$gray_lite);
        imageline($im,$x1,$y2,$x2,$y2,$gray_lite);
        imageline($im,$x2,$y1,$x2,$y2,$gray_dark);

    }

// Send the PNG header information. Replace for JPEG or GIF or whatever

    header ("Content-type: image/png");
    imagepng($im);
    imagedestroy($im);   */
    
       function bar_graph($height,$width,$x_interval,$y_interval,$font_size,
                      $label_size,$scale,$bar_width,$graph_title,$font,
                      $graph_labels,$graph_items,$bg_color="F0F0F0",
                      $bar_color="FFCC66",$text_color="000000")

   {
      $edge_padding=50;
      $graph_height=$height-$edge_padding * 2;
      $graph_width=$width-$edge_padding-$bar_width;
      $scale_unit=$graph_height/$scale;

      $im = @ImageCreate($width,$height)
         or die("Cannot Initialize new GD image stream");

      if(strlen($bg_color) ==6)
      {
        $red=hexdec(substr($bg_color,0,2));
        $green=hexdec(substr($bg_color,2,2));
        $blue=hexdec(substr($bg_color,4,2));
        $bg_color=ImageColorAllocate($im,$red,$green,$blue);
      }

      else
      {
        $bg_color=ImageColorAllocate($im,240,240,240);
      }

      if(strlen($text_color)==6)
      {
        $red=hexdec(substr($text_color,0,2));
        $green=hexdec(substr($text_color,2,2));
        $blue=hexdec(substr($text_color,4,2));
        $text_color=ImageColorAllocate($im,$red,$green,$blue);
      }

      else
      {
        $text_color=ImageColorAllocate($im,0,0,0);
      }

      if(strlen($bar_color)==6)
      {
        $red=hexdec(substr($bar_color,0,2));
        $green=hexdec(substr($bar_color,2,2));
        $blue=hexdec(substr($bar_color,4,2));
        $bar_color=ImageColorAllocate($im,$red,$green,$blue);
      }

      else
      {
        $bar_color=ImageColorAllocate($im,0,0,0);
      }

      //Vertical graph border

      ImageLine($im,$edge_padding,$edge_padding,$edge_padding,
                ($height-$edge_padding),$text_color);

      //Horizontal graph border
      ImageLine($im,$edge_padding,($height-$edge_padding),
                ($width-$edge_padding),($height-$edge_padding),$text_color);

      //Horozontal graph numbers
      $num_lines = $graph_height/$y_interval + 1;

      for($i=0;$i<$num_lines;$i++)
      {
         $start_x = $edge_padding/2;
         $start_y=($height - $edge_padding) - ($i * $y_interval);
         $end_x = $width - $edge_padding;
         $end_y = $start_y;
         ImageLine($im,$start_x,$start_y,$end_x,$end_y,$text_color);

         //catch divide-by-zero errors
         if($i)
             ImageTTFText($im,$font_size,0,($edge_padding-25),$start_y-5,
              $text_color,$font,ceil(($i * $y_interval)/$scale_unit));
      }

      //Bars
      for($i=0;$i<count($graph_items);$i++)
      {
         $start_x = (($x_interval + $bar_width) * $i) + $edge_padding;
         $end_y = ($scale_unit * $graph_items[$i]);
         $end_y = $height - $edge_padding - $end_y;

         $bar_points =array();
         $bar_points[0] = $start_x;
         $bar_points[1] = $height - $edge_padding;
         $bar_points[2] = $start_x;
         $bar_points[3] = $end_y;
         $bar_points[4] = $start_x + $bar_width;
         $bar_points[5] = $end_y;
         $bar_points[6] = $start_x + $bar_width;
         $bar_points[7] = $height - $edge_padding;

         ImageFilledPolygon($im,$bar_points,4,$bar_color);
         $font_y = ($height - $edge_padding) + 5;
         $bar_label_bbox = ImageTTFBBox($font_size,90,$font,
                                       $graph_labels[$i]);
         $label_width = abs($bar_label_bbox[4]);
         $label_height = abs($bar_label_bbox[3]);
         ImageTTFText($im,$font_size,90,$start_x+$label_width,
                      $font_y+$label_height,$text_color,$font,$graph_labels[$i]);
      }

      $title_bbox=ImageTTFBBox($label_size + 5, 0, $font, $graph_title);
      $image_center = $width/2;
      $text_x = $image_center - round(($title_bbox[4]/2));

      ImageTTFText($im,$label_size+5,0,$text_x,25,$text_color,
                   $font,$graph_title);

      return $im;
   }


  // header("content-type: image/png");

   $height =600;
   $width  =600;
   $x_interval =23;
   $y_interval=50;
   $font_size=12;
   $label_size=14;
   $scale=100;
   $bar_width=20;
   $graph_title="Product Performance";
   $font="arial.ttf";

   $im=bar_graph($height,$width,$x_interval,$y_interval,$font_size,
                 $label_size,$scale,$bar_width,$graph_title,$font,
                 $graph_labels,$graph_items);

   ImagePng($im);


?>

