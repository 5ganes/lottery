<?php
include("init.php");
if(!isset($_SESSION['sessUserId'])){
  header("Location: login.php");
  exit();
}

if(isset($_POST['id']))
	$id = $_POST['id'];
elseif(isset($_GET['id']))
	$id = $_GET['id'];
else
	$id = 0;

$weight = $prizeType -> getLastWeight();

if($_GET['type'] == "edit"){
	$result = $prizeType->getById($_GET['id']);
	$editRow = $conn->fetchArray($result);	
	extract($editRow);
}
if($_POST['type'] == "Save"){
  // echo '<pre>'; print_r($_POST); die();
	extract($_POST);
	$vall="";
	//print_r($_POST); die();
	
	if(empty($title))
		$errMsg .= "<li>Please enter Type Title of the prize</li>";
	
	if(empty($errMsg)){
		
		$pid = $prizeType -> save($id, $title, $publish, $weight);
		if($id > 0)
			$pid = $id;
		// $prize -> saveImage($pid);
		//$groups -> saveMap($pid);
		if($id>0)
			header("Location: type.php?type=edit&id=$id&msg=Prize Type details updated successfully");
		else
			header("Location: type.php?msg=Prize Type details saved successfully");
		exit();
	}		
}

if($_GET['type']=="del"){
		$prizeType -> delete($_GET['id']);
		//echo "hello";
		//header("Location : type.php?&msg=Prize Type deleted successfully.");?>
    	<script> document.location='type.php?&msg=Prize Type deleted successfully.' </script>    
<? }

if($_GET['type'] == "tooglePublish"){
  $id = $_GET['id'];
  $changeTo = $_GET['changeTo'];
  
  $sql = "UPDATE type SET publish='$changeTo' WHERE id='$id'";
  $conn->exec($sql);
  header("location: type.php?&msg=Prize Type Show/Hide status toogled successfully.");
  
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
  <title><?php echo ADMIN_TITLE; ?></title>
  <link href="../css/admin.css" rel="stylesheet" type="text/css">
  <style type="text/css">
  <!--
  .style1 {
  	color: #FF0000
  }
  -->
  </style>
  <script type="text/javascript" src="../js/cms.js"></script>
  <script type="text/javascript" src="../js/jquery.min.js"></script>

  <!--for date picker-->
  <script type="text/javascript" src="../datepicker/jquery.js"></script>
  <!-- <script type="text/javascript" src="../datepicker/nepali.datepicker.min.js"></script>
  <link rel="stylesheet" type="text/css" href="../datepicker/nepali.datepicker.css" />
  <script>
    $(document).ready(function(){
      $('.nepali-calendar').nepaliDatePicker();
      $('.collectedDate').nepaliDatePicker();
    });
  </script> -->
  <!--end date picker-->

  <script type="text/javascript" src="ckeditor/ckeditor.js"></script>

</head>
<body>
<table width="<?php echo ADMIN_PAGE_WIDTH; ?>" border="0" align="center" cellpadding="0"
	cellspacing="5" bgcolor="#FFFFFF">
  <tr>
    <td colspan="2"><?php include("header.php"); ?></td>
  </tr>
  <tr>
    <td width="<?php echo ADMIN_LEFT_WIDTH; ?>" valign="top"><?php include("leftnav.php"); ?></td>
    <td width="<?php echo ADMIN_BODY_WIDTH; ?>" valign="top"><table width="100%" border="0" cellspacing="1" cellpadding="0">
        <tr>
          <td class="bgborder"><table width="100%" border="0" cellspacing="1" cellpadding="0">
              <tr>
                <td bgcolor="#fff"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td class="heading2">&nbsp; Manage Prize Type
                        <div style="float: right;">
                          <?
														$addNewLink = "type.php";
													?>
                          <a href="<?= $addNewLink?>" class="headLink">Add New</a></div></td>
                    </tr>
                    <tr>
                      <td>
                      <form action="<?= $_REQUEST['uri']?>" method="post" enctype="multipart/form-data">

                      <table width="100%" border="0" cellpadding="2" cellspacing="0">

                          <?php if(!empty($errMsg)){ ?>

                          <tr align="left">

                            <td colspan="3" class="err_msg"><?php echo $errMsg; ?></td>

                          </tr>

                          <?php } ?>                          

                            <tr>

                              <td>&nbsp;</td>

                              <td class="tahomabold11"><strong> Prize Title : <span class="asterisk">*</span></strong></td>

                              <td><label for="title"></label>

                                <input name="title" type="text" class="text" id="title" value="<?= $title; ?>" onChange="" /></td>

                            </tr>

                            <tr><td></td></tr>  
                                                       
                            <tr>
                              <td></td>
                              <td class="tahomabold11"><strong>Publish :</strong></td>
                              <td>
                                <label>
                                  <input name="publish" type="radio" id="featured_0" value="No" checked="checked" />
                                  No</label>
                                <label>
                                  <input type="radio" name="publish" value="Yes" id="featured_1" <? if($publish == 'Yes') echo 'checked="checked"';?> />
                                  Yes</label>
                              </td>
                            </tr>
                            
                            <tr><td></td></tr>
                            
                            <tr>
                              <td></td>
                              <td class="tahomabold11"><strong>Weight :</strong></td>
                              <td><input name="weight" type="text" class="text" id="weight" value="<?php echo $weight; ?>" style="width:25px;" /></td>

                            </tr>

                            <tr><td></td></tr>
                         
                            <tr>
                              <td></td>
                              <td></td>
                              <td>
                                <input name="type" type="submit" class="button" id="button" value="Save" />
                                <?php if($_GET['type'] == "edit"){?>
                                <input type="hidden" value="<?= $id?>" name="id" id="id" />
                                <?php }else{ ?>                                
                                <input name="reset" type="reset" class="button" id="button2" value="Clear" />
                                <?php } ?>
                                </td>
                            </tr>                        
                        </table>
                        </form></td>
                    </tr>
                  </table></td>
              </tr>
            </table></td>
        </tr>
        <tr height="5"><td></td></tr>
        <tr>
          <td class="bgborder"><table width="100%" border="0" cellspacing="1" cellpadding="0">
              <tr>
                <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td class="heading2">&nbsp;Product Lists</td>
                    </tr>
                    <tr>
                      <td><table width="100%"  border="0" cellpadding="4" cellspacing="0">
                          <tr bgcolor="#F1F1F1" class="tahomabold11">
                            <td width="1">&nbsp;</td>
                            <td style="width:10px"><strong>S.N.</strong></td>
                            <td style="width:155px"> Prize Type </td>
                            <td style="width:80px;">Post Date</td>
                            <td style="width:100px;">Publish</td>
                            <td style="width:20px">Weight</td>
                            <td style="width:55px"><strong>Action</strong></td>
                          </tr>
                          <?php
							$counter = 0;
							$pagename = "type.php?";
							$sql = "SELECT * FROM type";
							$sql .= " ORDER BY weight";
							//echo $sql;
							$limit = 20;
							include("paging.php"); $i=0;
							while($row = $conn -> fetchArray($result))
							{?>
                          		<tr <?php if($counter%2 != 0) echo 'bgcolor="#F7F7F7"'; else echo 'bgcolor="#FFFFFF"'; ?>>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top"><?=++$i;?></td>
                                    <td valign="top"><?= $row['title'] ?></td>
                                    <td valign="top"><?=$row['onDate'];?></td>
                                    <td valign="top">
                            		<?
									$changeTo = 'Yes';
									if ($row['publish'] == 'Yes')
										$changeTo = 'No';
									?>
                              		(<a href="type.php?type=tooglePublish&id=<?= $row['id']?>&changeTo=<?=$changeTo;?>"><?=$row['publish'];?></a>)</td>
                                    
                                
                            		<td valign="top"><?= $row['weight'] ?></td>
                            		<td valign="top"> [ <a href="type.php?type=edit&id=<?= $row['id']?>">Edit</a> | <a href="#" onClick="javascript: if(confirm('This will permanently remove this type info from database. Continue?')){ document.location='type.php?type=del&id=<?php echo $row['id']; ?>'; }">Delete</a> ]</td>
                                </td>
                          </tr>
                          <?
													}
													?>
                        </table>
                      <?php include("paging_show.php"); ?></td>
                    </tr>
                  </table></td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td colspan="2"><?php include("footer.php"); ?></td>
  </tr>
</table>
  
  <script type="text/javascript">

    //CKEDITOR.basepath = "/ckeditor/";
    CKEDITOR.replace( 'description');
    //var editor_data = CKEDITOR.instances.shortcontents.getData();
  </script>

</body>
</html>