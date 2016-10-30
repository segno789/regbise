<div class="dashboard-wrapper class wysihtml5-supported">
    <div class="left-sidebar">
        <div class="row-fluid">
            <div class="span12">
                <div class="widget">
                    <div class="widget-header">
                        <div class="title">
                            Migration for<a id="redgForm" data-original-title="">m</a>
                        </div>

                    </div>
                    <div class="widget-body">

                        <form class="form-horizontal no-margin" action="<?php  echo base_url(); ?>Migration/updatefrom11th" method="post" enctype="multipart/form-data">

                            <div class="control-group">
                                <h4 class="span4">Personal Information :</h4>
                                <div class="controls controls-row">
                                    <input type="hidden" class="span2 hidden" id="formno" name="formno" value="<?=  $data['0']['FormNo']?>">
                                    <input type="hidden" class="span2 hidden" id="cand_name" name="cand_name" value="<?=  $data['0']['name']?>">
                                    <input type="hidden" class="span2 hidden" id="father_name" name="father_name" value="<?=  $data['0']['Fname']?>">
                                    <input type="hidden" class="span2 hidden" id="bform" name="bform" value="<?=  $data['0']['BForm']?>">
                                    <input type="hidden" class="span2 hidden" id="fnic" name="fnic" value="<?=  $data['0']['FNIC']?>">
                                    <input type="hidden" class="span2 hidden" id="sex" name="sex" value="<?=  $data['0']['sex']?>">
                                    <img id="previewImg" style="width:80px; height: 80px;" class="span2" src="<?php  echo base_url().IMAGE_PATH11.$Inst_Id.'/'.$data[0]['PicPath'];?>" alt="Candidate Image">
                                </div>
                            </div>
                            <div class="control-group">

                                <label id="ErrMsg" class="control-label span2" style=" text-align: left;    font-size: 22px;font-weight: bold;">FormNo. <?= $data['0']['FormNo']?></label>

                            </div>
                            <div class="control-group">
                                <label class="control-label span1" >
                                    Candidate Name :
                                </label>
                                <div class="controls controls-row">
                                    <input class="span3"  type="text" id="cand_name" style="text-transform: uppercase;" name="cand_name" placeholder="Candidate Name" maxlength="60"  value="<?php  echo  $data['0']['name']; ?>" readonly='readonly'  >
                                    <label class="control-label span2" for="lblfather_name">
                                        Father's Name :
                                    </label> 
                                    <input class="span3" id="father_name" name="father_name" style="text-transform: uppercase;" type="text" placeholder="Father's Name" maxlength="60" value="<?php echo  $data['0']['Fname']; ?>" readonly='readonly' required="required">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label span1" >
                                    Bay Form No :
                                </label>
                                <div class="controls controls-row">
                                    <input type="hidden" name="oldbform" value="<?php echo   $data['0']['BForm']; ?>">
                                    <input type="hidden" name="oldfform" value="<?php echo  $data['0']['FNIC']; ?>">
                                    <input class="span3" type="text" id="bay_form" name="bay_form" placeholder="Bay Form No." value="<?php echo  $data['0']['BForm']; ?>" required="required" readonly='readonly'>
                                    <label class="control-label span2" for="father_cnic">
                                        Father's CNIC :
                                    </label> 
                                    <input class="span3" id="father_cnic" name="father_cnic" type="text" placeholder="34101-1111111-1" value="<?php echo  $data['0']['FNIC']; ?>" readonly='readonly' required="required">
                                </div>
                            </div>


                            <div class="control-group">
                                <label class="control-label span1" >
                                    Address :
                                </label>
                                <div class="controls controls-row">
                                    <textarea style="height:150px; text-transform: uppercase;"  id="address" class="span8" name="address" readonly='readonly' required="required"><?php
                                        echo $data[0]['addr'];
                                    ?></textarea>
                                </div>
                            </div>
                            <hr>
                            <div class="control-group">
                                <h4 class="span4">Migration Information:</h4>
                                <div class="controls controls-row">
                                    <input type="hidden" class="span2 hidden" id="isReAdm" name="isReAdm" value="0">
                                    <label class="control-label span2">

                                      

                                    </label> 

                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label span1" >
                                    Migrate To :
                                </label>
                                <div class="controls controls-row">
                                    <select id="migrateto" class="dropdown span6"  name="migrateto">
                                     <option value="-1"> Please Select Inst.</option>
                                     <?php 
                                            foreach($install  as $key => $value)
                                            {
                                                echo  '<option value="'.$value['inst_cd'].'"> '.$value['inst_cd'].'-'.$value['name'].'</option>'; 

                                            }


                                            ?>
                                    </select>                                            

                                </div>
                            </div>
                            <div class="form-actions no-margin">

                                <button type="submit" onclick="return checks()" name="btnsubmitUpdateEnrol" class="btn btn-large btn-info offset2">
                                    Release Form
                                </button>
                                <input type="button" class="btn btn-large btn-danger" value="Cancel" id="btnCancel" name="btnCancel" onclick="return CancelAlert();" >
                                <div class="clearfix">
                                </div>
                            </div>


                        </form>
                        <script type="text/javascript">



                            function checks(){

                                var status  =  check_migration_validation();
                                if(status == 0)
                                {

                                    return false;    
                                }
                                else
                                {

                                    return true;
                                } 


                            }
                            function CancelAlert()
                            {
                                var msg = "Are You Sure You want to Cancel this Form ?"
                                alertify.confirm(msg, function (e) {
                                    if (e) {
                                        // user clicked "ok"
                                        window.location.href ='<?php echo base_url(); ?>index.php/Registration_11th/EditForms';
                                    } else {
                                        // user clicked "cancel"

                                    }
                                });
                            }
                        </script>

                    </div>  

                </div>
            </div>
        </div>
    </div>
</div>
