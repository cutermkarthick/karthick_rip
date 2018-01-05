<?php


session_start();
header("Cache-control: private");

if ( !isset ( $_SESSION['user'] ) )
{
    header ( "Location: login.php" );
}
$userid = $_SESSION['user'];

$_SESSION['pagename'] = 'newcontract';
$page="Contract";

$userid = $_SESSION['user'];
$userrecnum = $_SESSION['userrecnum'];

include('classes/menuClass.php'); 
$newmenu = new menu;

$recnum = $_REQUEST['recnum'];
$result = $newmenu->GetMenusDeatils($recnum);
$mymenu = mysql_fetch_assoc($result);

$menus = json_decode($mymenu['menus']);

?>
<link rel="stylesheet" href="style.css">
<script language="javascript" src="scripts/mouseover.js"></script>
<script language="javascript" src="scripts/emp.js"></script>


<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>jQuery Menu Editor - Demo</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="assets/menu-builder/bs-iconpicker/css/bootstrap-iconpicker.min.css" rel="stylesheet">
  </head>
  <body leftmargin="0" topmargin="0" marginwidth="0">

    <?php
    // include('sidebar.php');
    ?>


    <div class="container">
      <div class="row">
          <div class="col-md-12"><h2>Menu Customization</h2></div>
      </div>
      <div class="row">

          <div class="col-md-6">
              <div class="panel panel-default">
                  <div class="panel-heading clearfix"><h5 class="pull-left">Menu</h5>
                      <div class="pull-right">
                          <button id="btnReload" type="button" class="btn btn-default">
                              <i class="glyphicon glyphicon-triangle-right"></i> Load Data</button>
                      </div>
                  </div>
                  <div class="panel-body" id="cont">
                      <ul id="myEditor" class="sortableLists list-group">
                      </ul>
                  </div>
              </div>
              <div class="form-group">
                  <button id="btnOut" type="button" class="btn btn-success"><i class="glyphicon glyphicon-ok"></i> Output</button>
              </div>
              <div class="form-group"><textarea id="out" class="form-control" cols="50" rows="10"><?php echo json_encode($menus); ?></textarea>
              </div>

              <div class="form-group">
                <label for="dept" class="col-sm-2 control-label">URL</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control item-menu" id="dept" name="dept" placeholder="Dept" value="<?php echo $mymenu['dept'] ?>">
                </div>
              </div>
              <div class="form-group">
                <label for="urole" class="col-sm-2 control-label">User Role</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control item-menu" id="urole" name="urole" placeholder="User Role" value="<?php echo $mymenu['userrole'] ?>">
                </div>
              </div>

          </div>

          <div class="col-md-6">

              <div class="panel panel-primary">

                  <div class="panel-heading">Edit item</div>
                  

                  <div class="panel-body">
                      <form id="frmEdit" class="form-horizontal">
                          <div class="form-group">
                              <label for="text" class="col-sm-2 control-label">Text</label>
                              <div class="col-sm-10">
                                  <div class="input-group">
                                      <input type="text" class="form-control item-menu" name="text" id="text" placeholder="Text">
                                      <div class="input-group-btn">
                                          <button type="button" id="myEditor_icon" class="btn btn-default" data-iconset="fontawesome"></button>
                                      </div>
                                      <input type="hidden" name="icon" class="item-menu">
                                  </div>
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="href" class="col-sm-2 control-label">URL</label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control item-menu" id="href" name="href" placeholder="URL">
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="target" class="col-sm-2 control-label">Target</label>
                              <div class="col-sm-10">
                                  <select name="target" id="target" class="form-control item-menu">
                                      <option value="_self">Self</option>
                                      <option value="_blank">Blank</option>
                                      <option value="_top">Top</option>
                                  </select>
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="title" class="col-sm-2 control-label">Tooltip</label>
                              <div class="col-sm-10">
                                  <input type="text" name="title" class="form-control item-menu" id="title" placeholder="Tooltip">
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="id" class="col-sm-2 control-label">ID</label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control item-menu" id="id" name="id" placeholder="URL">
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="class" class="col-sm-2 control-label">Class</label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control item-menu" id="class" name="class" placeholder="URL">
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="seqnum" class="col-sm-2 control-label">Seq #</label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control item-menu" id="seqnum" name="seqnum" placeholder="URL">
                              </div>
                          </div>
                      </form>
                  </div>
                  <div class="panel-footer">
                      <button type="button" id="btnUpdate" class="btn btn-primary" disabled><i class="fa fa-refresh"></i> Update</button>
                      <button type="button" id="btnAdd" class="btn btn-success"><i class="fa fa-plus"></i> Add</button>
                  </div>

              </div>
                <button type="button" id="btnSubmit" class="btn btn-success"><i class="fa fa-plus"></i> Submit</button>
          </div>

          <input type="hidden" id="page" name="page" value="Edit">
          <input type="hidden" id="recnum" name="recnum" value="<?php echo $recnum; ?>">

      </div>
     
    </div>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src='assets/menu-builder/js/jquery-menu-editor.js'></script>
    <script src='assets/menu-builder/bs-iconpicker/js/iconset/iconset-fontawesome-4.2.0.min.js'></script>
    <script src='assets/menu-builder/bs-iconpicker/js/bootstrap-iconpicker.js'></script>
    <script>
        jQuery(document).ready(function () {
            var strjson = '<?php echo json_encode($menus); ?>';
            var iconPickerOpt = {cols: 5, searchText: "Buscar...", labelHeader: '{0} de {1} Pags.', footer: false};
            var options = {
                hintCss: {'border': '1px dashed #13981D'},
                placeholderCss: {'background-color': 'gray'},
                opener: {
                    as: 'html',
                    close: '<i class="fa fa-minus"></i>',
                    open: '<i class="fa fa-plus"></i>',
                    openerCss: {'margin-right': '10px'},
                    openerClass: 'btn btn-success btn-xs'
                }
            };
            var editor = new MenuEditor('myEditor', {listOptions: options, iconPicker: iconPickerOpt, labelEdit: 'Edit'});
            editor.setForm($('#frmEdit'));
            editor.setUpdateButton($('#btnUpdate'));
            
            $('#btnReload').on('click', function () {
                editor.setData(strjson);
            });
            $('#btnOut').on('click', function () {
                var str = editor.getString();
                $("#out").text(str);
            });
            $("#btnUpdate").click(function(){
                editor.update();
            });
            $('#btnAdd').click(function(){
                editor.add();
            });

            $('#btnSubmit').click(function(){
                var dept = $('#dept').val();
                var urole = $('#urole').val();
                var output = $('#out').val();
                var page = $('#page').val();
                var recnum = $('#recnum').val();
                var errmsg = '';
                if (dept == "") {
                  errmsg += "Please Enter Dept \n";
                }

                if (urole == "") {
                  errmsg += "Please Enter User Role \n";
                }

                if (output == "") {
                  errmsg += "Output Should not Be Empty \n";
                }

                if (errmsg !="") {
                  alert(errmsg); return false;
                }
                else
                {
                  $.ajax({
                  async : false,
                  global : false,
                  url : "ProcessMenu.php",
                  type : "POST",
                  dataType: "html", 
                  data : "dept="+dept+"&urole="+urole+"&menus="+output+"&page="+page+"&recnum="+recnum,
                  success : function (response)
                  {
                    if (response != 'Success') 
                    {
                     alert("Update Failed");
                     return false;
                    }else{
                      alert("Successfully Updated \n");
                      window.location.href ="MenuSummary.php";
                    }

                  }

                  });

                
                }

            });

            $( "#btnReload" ).trigger( "click" );

        });
    </script>


  </body>
</html>
