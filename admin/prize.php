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

$weight = $prize -> getLastWeight();

if($_GET['type'] == "edit"){
	$result = $prize->getById($_GET['id']);
	$editRow = $conn->fetchArray($result);	
	extract($editRow);
}
if($_POST['type'] == "Save"){
  // echo '<pre>'; print_r($_POST); die();
	extract($_POST);
	$vall="";
	//print_r($_POST); die();
	
	if(empty($title))
		$errMsg .= "<li>Please enter title of the prize</li>";
	
	if(empty($errMsg)){
		
		$pid = $prize -> save($id, $title, $prizeType, $description, $onDate, $publish, $weight);
		if($id > 0)
			$pid = $id;
		$prize -> saveImage($pid);
		//$groups -> saveMap($pid);
		if($id>0)
			header("Location: prize.php?type=edit&id=$id&msg=Prize details updated successfully");
		else
			header("Location: prize.php?msg=Prize details saved successfully");
		exit();
	}		
}

if($_GET['type'] == "removeImage"){
	$prize->deleteImage($_GET['id']);
	//echo "hello";
	//header("location: prize.php?type=edit&id=".$_GET['id']."&msg=product image deleted successfully.");?>
	<script> document.location='prize.php?type=edit&id=<?=$_GET['id']?>&msg=Prize image deleted successfully.' </script>
<? }

if($_GET['type']=="del"){
		$prize -> delete($_GET['id']);
		//echo "hello";
		//header("Location : prize.php?&msg=Bill deleted successfully.");?>
    	<script> document.location='prize.php?&msg=Prize deleted successfully.' </script>    
<? }

if($_GET['type'] == "tooglePublish"){
  $id = $_GET['id'];
  $changeTo = $_GET['changeTo'];
  
  $sql = "UPDATE prize SET publish='$changeTo' WHERE id='$id'";
  $conn->exec($sql);
  header("location: prize.php?&msg=Prize Show/Hide status toogled successfully.");
  
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
                      <td class="heading2">&nbsp; Manage Prize
                        <div style="float: right;">
                          <?
														$addNewLink = "prize.php";
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

                              <td>&nbsp;</td>

                              <td class="tahomabold11"><strong> Prize Type : <span class="asterisk">*</span></strong></td>

                              <td>
                                <label for="prizeType"></label>
                                <select name="prizeType">
                                    <?
                                      $tt=mysql_query("select id,title from type order by weight ASC");
                                      while($ttGet=mysql_fetch_array($tt))
                                      {?>
                                        <option value="<?=$ttGet['id'];?>" 
                                        <? if($ttGet['id']==$type){ echo 'selected="selected"';}?>><?=$ttGet['title'];?></option> 
                                      <? }
                                    ?>
                                </select>
                              </td>

                            </tr>

                            <tr><td></td></tr>                           

                            <tr>
                              <td></td>
                              <td class="tahomabold11"><strong>Prize Description :</strong></td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr><td></td></tr>
                            <tr>
                              <td></td>
                              <td colspan="2">
                                  <textarea style="padding:5px" name="description" rows="10" cols="43">
                                      <?=$descrption;?>
                                    </textarea>
                              </td>
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

              <? if(file_exists("../".CMS_GROUPS_DIR.$image) and $image!='' && $_GET['type'] == 'edit')
              {?>
                                <tr>
                                  <td></td>
                                  <td class="tahomabold11"><strong>Current Image : </strong></td>
                                  <td><img src="../data/imager.php?file=../<?= CMS_GROUPS_DIR.$image; ?>&amp;mw=150&amp;mh=150" />
                                  [ <a href="prize.php?type=removeImage&id=<?= $id?>">Remove Image</a>]</td>
                                </tr>
                            <? }?>
                            <tr><td></td></tr>
                            <tr>
                              <td></td>
                              <td class="tahomabold11"><strong>Image :</strong></td>
                              <td><label for="image"></label>
                                <input type="file" name="image" id="image" /></td>
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
                            <td style="width:155px"> Prize Title </td>
                            <td style="width:110px">Prize Type</td>
                            <td style="width:80px;">Post Date</td>
                            <td style="width:100px;">Publish</td>
                            <td style="width:20px">Weight</td>
                            <td style="width:55px"><strong>Action</strong></td>
                          </tr>
                          <?php
							$counter = 0;
							$pagename = "prize.php?";
							$sql = "SELECT * FROM prize";
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
                                    <td valign="top">
                                      <?php $pType = $conn->fetchArray($prizeType->getById($row['type'])); echo $pType['title'];?>
                                    </td>
                                    <td valign="top"><?=$row['onDate'];?></td>
                                    <td valign="top">
                            		<?
									$changeTo = 'Yes';
									if ($row['publish'] == 'Yes')
										$changeTo = 'No';
									?>
                              		(<a href="prize.php?type=tooglePublish&id=<?= $row['id']?>&changeTo=<?=$changeTo;?>"><?=$row['publish'];?></a>)</td>
                                    
                                
                            		<td valign="top"><?= $row['weight'] ?></td>
                            		<td valign="top"> [ <a href="prize.php?type=edit&id=<?= $row['id']?>">Edit</a> | <a href="#" onClick="javascript: if(confirm('This will permanently remove this prize info from database. Continue?')){ document.location='prize.php?type=del&id=<?php echo $row['id']; ?>'; }">Delete</a> ]</td>
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