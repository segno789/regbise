<div class="dashboard-wrapper class wysihtml5-supported">
    <div class="left-sidebar">
        <div class="row-fluid">
            <div class="span12">
                <div class="widget">
                    <div class="widget-header">
                        <div class="title">
                            Event registration for<a id="redgForm" data-original-title="">m</a>
                        </div>

                    </div>
                    <div class="widget-body">

                        <form class="form-horizontal no-margin" action="<?php  echo base_url(); ?>/index.php/Registration_11th/NewEnrolment_insert" method="post" enctype="multipart/form-data">

                            <div class="control-group">
                                <h4 class="span4">Personal Information :</h4>
                                <label class="control-label span2" style="width: 411px;margin-left: -199px;">
                                      <img src="<?php echo base_url(); ?>assets/img/upalodimage.jpg" alt="" >
                                    </label>
                                <div class="controls controls-row">
                                    <input type="hidden" class="span2 hidden" id="isReAdm" name="isReAdm" value="0">

                                  
                                    <!--                                    '/'.IMAGE_PATH.$Inst_Id.'/'.$data[0]['PicPath']-->
                                    <img id="previewImg" style="width:80px; height: 80px;" class="span2" src="<?php echo base_url(); ?>assets/img/profile.png" alt="Candidate Image">
                                </div>
                            </div>
                            <div class="control-group">

                                <label id="ErrMsg" class="control-label span2" style=" text-align: left;"><?php ?></label>
                                 
                                <div class="controls controls-row">
                                
                                    <input class="span3 hidden"  type="text" placeholder="" >  
                                    <label class="control-label span2">
                                        Image :  
                                    </label> 
                                    <input type="file" class="span4" id="image" name="image" onchange="readURL(this);">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label span1" >
                                    Candidate Name :
                                </label>
                                <div class="controls controls-row">
                                    <input class="span3"  type="text" id="cand_name" readonly="readonly" style="text-transform: uppercase;" name="cand_name" placeholder="Candidate Name" maxlength="60"  value="<?php  echo  $data['0']['name']; ?>" <?php if($isReAdm==1) echo "readonly='readonly'";  ?>  >
                                    <label class="control-label span2" for="lblfather_name">
                                        Father's Name :
                                    </label> 
                                    <input class="span3" id="father_name" name="father_name" readonly="readonly" style="text-transform: uppercase;" type="text" placeholder="Father's Name" maxlength="60" value="<?php echo  $data['0']['Fname']; ?>" <?php if($isReAdm==1) echo "readonly='readonly'";  ?> required="required">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label span1" >
                                    Bay Form No :
                                </label>
                                <div class="controls controls-row">
                                    <input class="span3" type="text" id="bay_form" name="bay_form" readonly="readonly" placeholder="Bay Form No." value="<?php echo  $data['0']['bFormNo']; ?>" required="required" <?php if($isReAdm==1) echo "readonly='readonly'";  ?>>
                                    <label class="control-label span2" for="father_cnic">
                                        Father's CNIC :
                                    </label> 
                                    <input class="span3" id="father_cnic" name="father_cnic" readonly="readonly" type="text" placeholder="34101-1111111-1" value="<?php echo  $data['0']['FNIC']; ?>" <?php if($isReAdm==1) echo "readonly='readonly'";  ?> required="required">
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label span1" >
                                    Date of Birth:(dd-mm-yyyy)
                                </label>
                                <?php
                                $source = $data['0']['dob'];;
                                $date = new DateTime($source);
                                $date1 = $date->format('d-m-Y');
                                ?>
                                <div class="controls controls-row">
                                    <input class="span3" type="text" id="dob" name="dob" placeholder="DOB" value="<?php echo $date1;   ?>" required="required" readonly="readonly"  >

                                    <label class="control-label span2" >
                                        Mobile Number :
                                    </label> 
                                    <input class="span3" id="mob_number" name="mob_number" type="text" placeholder="0300-123456789" value=<?php echo  $data['0']['MobNo']; ?> required="required">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label span1" >
                                    MEDIUM:
                                </label>
                                <div class="controls controls-row">
                                    <select id="medium" class="dropdown span3" name="medium">
                                     <option value='1' selected='selected'>Urdu</option> <option value='2'>English</option>
                                                                      
                                    </select>
                                    <label class="control-label span2" >
                                        Class Roll No :
                                    </label> 
                                    <!--                                    $data['0']['classRno']; -->
                                    <input class="span3" id="Inst_Rno" type="text"  style="text-transform: uppercase;" name="Inst_Rno" placeholder="" value="<?php  echo '' ?>" required="required" maxlength="8">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label span1" >
                                    Mark Of Identification :
                                </label>
                                <div class="controls controls-row">
                                    <input class="span3" type="text" id="MarkOfIden" style="text-transform: uppercase;" name="MarkOfIden" value="<?php echo  $data['0']['markOfIden']; ?>" required="required" maxlength="60" >
                                    <label class="control-label span2" >
                                        Speciality:
                                    </label> 
                                    <select id="speciality"  class="span3" name="speciality">
                                       <option value='0' selected='selected'>None</option>  <option value='1'>Deaf &amp; Dumb</option> <option value='2'>Board Employee</option>
                                         </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label span1" >
                                    Nationality :
                                </label>
                                <div class="controls controls-row">  
                                    <?php
                                    $nat = $data[0]['IsPakistani'];
                                    if($nat == 1)
                                    {
                                        echo  " <label class='radio inline span1'><input type='radio' value='1' id='nationality' checked='checked' name='nationality'> Pakistani
                                        </label><label class='radio inline span2'><input type='radio'  id='nationality1' value='2' name='nationality'>  Non Pakistani</label>" ;
                                    }
                                    else if ($nat == 2)
                                    {
                                        echo  "<label class='radio inline span1'><input type='radio' value='1' id='nationality'  name='nationality'> Pakistani
                                        </label><label class='radio inline span2'><input type='radio'  id='nationality1' checked='checked' value='2' name='nationality'>  Non Pakistani</label>" ;
                                    }
                                    ?>

                                    <label class="control-label span2" for="gender1">
                                        Gender :
                                    </label> 
                                    <?php
                                    $gender = $data[0]['Gender'];
                                    if($gender == 1)
                                    {
                                        echo " <label class='radio inline span1'><input type='radio' id='gender1' value='1' checked='checked'  disabled='disabled' name='gender'> Male</label> 
                                        <label class='radio inline span1'><input type='radio' id='gender2' value='2'  name='gender'  disabled='disabled'> Female </label> " ;
                                    }
                                    else if ($gender == 2)
                                    {
                                        echo " <label class='radio inline span1'><input type='radio' id='gender1' value='1'  disabled='disabled' name='gender'> Male</label> 
                                        <label class='radio inline span1'><input type='radio' id='gender2' value='2'  checked='checked'  disabled='disabled'  name='gender'> Female </label> " ;
                                    }
                                    ?>
                                    <input type="hidden" name="gender" value="<?php echo $gender; ?>">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label span1" >
                                    Hafiz-e-Quran :
                                </label>
                                <div class="controls controls-row">
                                    <?php
                                    // DebugBreak();
                                    if($isReAdm == 1)
                                    {
                                        echo " <label class='radio inline span1'><input type='radio' id='hafiz1' value='1'  name='hafiz'> No</label>
                                        <label class='radio inline span1'><input type='radio' id='hafiz2' value='2' checked='checked' name='hafiz'> Yes</label>";
                                    }
                                    else
                                    {
                                       
                                            echo " <label class='radio inline span1'><input type='radio' id='hafiz1' value='1' checked='checked' name='hafiz'> No</label>
                                            <label class='radio inline span1'><input type='radio' id='hafiz2' value='2' name='hafiz'> Yes</label>";
                                       
                                    }    
                                    ?>

                                    <label class="control-label span3" >
                                        Religion :
                                    </label> 
                                    <?php
                                    $rel = $data[0]['IsMuslim'];
                                    if($rel == 1)
                                    {
                                        echo " <label class='radio inline span1'><input type='radio' id='religion' class='rel_class' value='1' checked='checked' name='religion'> Muslim
                                        </label><label class='radio inline span1'><input type='radio' id='religion1' class='rel_class' value='2' name='religion'> Non Muslim</label>" ;
                                    }
                                    else if ($rel == 2)
                                    {
                                        echo " <label class='radio inline span1'><input type='radio' id='religion' class='rel_class' value='1'  name='religion'> Muslim
                                        </label><label class='radio inline span1'><input type='radio' id='religion1' class='rel_class' value='2' checked='checked' name='religion'> Non Muslim</label>" ;
                                    }
                                    ?>

                                </div>
                            </div>
                            <div class="control-group">
                            <label class="control-label span1" >
                                Residency :
                            </label>
                            <div class="controls controls-row">  
                                <?php
                                $resid = $data[0]['isRural'];
                                if($resid == 1 )
                                {
                                    echo " <label class='radio inline span1'><input type='radio' value='1' id='UrbanRural' checked='checked' name='UrbanRural'> Urban
                                    </label><label class='radio inline span2'><input type='radio'  id='UrbanRural' value='2' name='UrbanRural'>  Rural </label>";
                                }
                                else if($resid == 2)
                                {
                                    echo " <label class='radio inline span1'><input type='radio' value='1' id='UrbanRural' name='UrbanRural'> Urban
                                    </label><label class='radio inline span2'><input type='radio'  id='UrbanRural' value='2'  checked='checked'  name='UrbanRural'>  Rural </label>";
                                }

                                ?>

                            </div>
                            <div class="control-group">
                                <label class="control-label span1" >
                                    Address :
                                </label>
                                <div class="controls controls-row">
                                    <textarea style="height:150px; text-transform: uppercase;"  id="address" class="span8" name="address" required="required"><?php
                                        echo $data[0]['addr'];
                                    ?></textarea>
                                </div>
                            </div>
                            <hr>
                            <div class="control-group">
                                <h4 class="span4">Exam Information :</h4>
                                <div class="controls controls-row">
                                    <input type="hidden" class="span2 hidden" id="isReAdm" name="isReAdm" value="0">
                                    <label class="control-label span2">

                                    </label> 

                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label span1" >
                                    Study Group :
                                </label>
                                <div class="controls controls-row">
                                    <select id="std_group" class="dropdown span6"  name="std_group">
                                        <?php
                                       
                                        $grp = $data[0]['RegGrp'];
                                        $subgroups =  split(',',$grp_cdi);
                                        echo "<option value='0' >SELECT GROUP</option>";
                                        if($isReAdm == 1 )
                                        {
                                            echo " <option value='1'>Pre-Medical</option>
                                            <option value='2'>Pre-Engineering</option>
                                            <option value='3'>Humanities</option>
                                            <option value='4'>General Science</option>
                                            <option value='5'>Commerce</option>
                                            <option value='6'>Home Economics</option>
                                            ";  
                                        }
                                        if($isReAdm != 1 )
                                        {

                                            for($i =0 ; $i<count($subgroups); $i++)
                                            {
                                                if($subgroups[$i] == 1)
                                                {
                                                   
                                                        echo "<option value='1' >Pre-Medical</option>";    
                                                   
                                                }
                                                else if($subgroups[$i] == 2)
                                                {
                                                   
                                                        echo "<option value='2'>Pre-Engineering</option>"; 
                                                  

                                                }
                                                else if($subgroups[$i] == 3)
                                                {
                                                   
                                                        echo "<option value='3'>Humanities</option>";  
                                                   

                                                }
                                                else if($subgroups[$i] == 4)
                                                {
                                                   
                                                        echo "<option value='4'>General Science</option>";   
                                                   
                                                }
                                                else if($subgroups[$i] == 5)
                                                {
                                                  
                                                        echo "<option value='5'>Commerce</option>";  
                                                   

                                                }
                                                else if($subgroups[$i] == 6)
                                                {
                                                   
                                                        echo "<option value='6'>Home Economics</option>";  
                                                   

                                                }
                                            } 
                                        }
                                        /*    if($isReAdm != 1)
                                        {
                                        for($i =0 ; $i<count($subgroups); $i++)
                                        {
                                        if($subgroups[$i] == 1)
                                        {
                                        if($grp == 1)
                                        {
                                        echo "<option value='1' selected='selected'>Pre-Medical</option>";  
                                        }
                                        else 
                                        {
                                        echo "<option value='1' >Pre-Medical</option>";    
                                        }
                                        }
                                        else if($subgroups[$i] == 2)
                                        {
                                        if($grp == 2)
                                        {
                                        echo "<option value='2' selected='selected'>Pre-Engineering</option>";
                                        }
                                        else
                                        {
                                        echo "<option value='2'>Pre-Engineering</option>"; 
                                        }

                                        }
                                        else if($subgroups[$i] == 3)
                                        {
                                        if($grp == 3)
                                        {
                                        echo "<option value='3' selected='selected'>Humanities</option>";  
                                        }
                                        else
                                        {
                                        echo "<option value='3'>Humanities</option>";  
                                        }

                                        }
                                        else if($subgroups[$i] == 4)
                                        {
                                        if($grp == 4)
                                        {
                                        echo "<option value='4' selected='selected'>General Science</option>";  
                                        }
                                        else
                                        {
                                        echo "<option value='4'>General Science</option>";   
                                        }

                                        }
                                        else if($subgroups[$i] == 5)
                                        {
                                        if($grp == 5)
                                        {
                                        echo "<option value='5' selected='selected'>Commerce</option>";  
                                        }
                                        else
                                        {
                                        echo "<option value='5'>Commerce</option>";  
                                        }

                                        }
                                        else if($subgroups[$i] == 6)
                                        {
                                        if($grp == 6)
                                        {
                                        echo "<option value='6' selected='selected'>Home Economics</option>";  
                                        }
                                        else
                                        {
                                        echo "<option value='6'>Home Economics</option>";  
                                        }

                                        }
                                        } 
                                        }*/
                                        $subarray = array(
                                            'ENGLISH' => '1',
                                            'URDU' => '2',
                                            'BANGALI' => '3',
                                            'URDU(ALTERNATIVE EASY COURSE)' => '4',
                                            'BENGALI(ALTERNATE EASY COURSE)' => '5',
                                            'PAKISTANI CULTURE' => '6',
                                            'HISTORY' => '7',
                                            'LIBRARY SCIENCE' => '8',
                                            'ISLAMIC HISTORY & CULTURE' => '9',
                                            'FAZAL ARABIC' => '10',
                                            'ECONOMICS' => '11',
                                            'GEOGRAPHY' => '12',
                                            'MILITARY SCIENCE' => '13',
                                            'PHILOSOPHY' => '14',
                                            'ISLAMIC STUDIES(ISL-ST. GROUP)' => '15',
                                            'PSYCHOLOGY' => '16',
                                            'CIVICS' => '17',
                                            'STATISTICS' => '18',
                                            'MATHEMATICS' => '19',
                                            'ISLAMIC STUDIES' => '20',
                                            'OUTLINES OF HOME ECONOMICS' => '21',
                                            'MUSIC' => '22',
                                            'FINE ARTS' => '23',
                                            'ARABIC' => '24',
                                            'BENGALI' => '25',
                                            'BENGALI(ADVANCE)' => '26',
                                            'ENGLISH ELECTIVE' => '27',
                                            'FRENCH' => '28',
                                            'GERMAN' => '29',
                                            'LATIN' => '30',
                                            'PUNJABI' => '32',
                                            'PASHTO' => '33',
                                            'PERSIAN' => '34',
                                            'SANSKRIT' => '35',
                                            'SINDHI' => '36',
                                            'URDU (ADVANCE)' => '37',
                                            'COMMERCIAL PRACTICE' => '38',
                                            'PRINCIPLES OF COMMERCE' => '39',
                                            'HEALTH & PHYSICAL EDUCATION' => '42',
                                            'EDUCATION' => '43',
                                            'GEOLOGY' => '44',
                                            'SOCIOLOGY' => '45',
                                            'BIOLOGY' => '46',
                                            'PHYSICS' => '47',
                                            'CHEMISTRY' => '48',
                                            'ETHICS FOR NON MUSLIM' => '51',
                                            'ADEEB ARBI' => '52',
                                            'ADEEB URDU' => '53',
                                            'FAZAL URDU' => '54',
                                            'HISTORY OF PAKISTAN' => '55',
                                            'HISTORY OF ISLAM' => '56',
                                            'HISTORY OF INDO-PAK' => '57',
                                            'HISTORY OF MODREN WORLD' => '58',
                                            'APPLIED ART  (H-Eco Group)' => '59',
                                            'FOOD & NUTRITION (H-Eco Group)' => '60',
                                            'CHILD DEVELOPMENT AND FAMILY LIVING (H-Eco Group)' => '61',
                                            'PRINCIPLES OF ACCOUNTING' => '70',
                                            'PRINCIPLES OF ECONOMICS' => '71',
                                            'BIOLOGY (H-Eco Group)' => '72',
                                            'CHEMISTRY (H-Eco Group)' => '73',
                                            'CLOTHING & TEXTILE (H-Eco Group)' => '75',
                                            'HOME MANAGEMNET  (H-Eco Group)' => '76',
                                            'NURSING' => '79',
                                            'BUSINESS MATH' => '80',
                                            'COMPUTER SCIENCE' => '83',
                                            'AGRICULTURE' => '90',
                                            'PAKISTAN STUDIES' => '91',
                                            'ISLAMIC EDUCATION' => '92',
                                            'CIVICS FOR NON MUSLIM' => '93',
                                            'COMMERCIAL GEOGRAPHY' => '94',
                                            'BANKING' => '95',
                                            'TYPING' => '96',
                                            'BUSINESS STATISTICS' => '97',
                                            'COMPUTER STUDIES' => '98',
                                            'BOOK KEEPING & ACCOUNTANCY' => '99'

                                        );
                                        //$result =  array_search($data[0]['sub4'],$subarray);



                                        ?>

                                    </select>                                            

                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label span12" style="width: 366px; font-weight: bold;" >
                                    Choose Subjects(Elective Subjects are Enabled Only)   
                                </label> 

                            </div>
                            <div class="control-group">
                                <label class="control-label span1" >

                                </label>
                                <div class="controls controls-row">
                                    <select id="sub1" class="span3 dropdown" name="sub1">

                                    </select> 
                                    <select id="sub2"  name="sub2" class="span3 dropdown">

                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label span1" >

                                </label>
                                <div class="controls controls-row">
                                    <select id="sub3" class="span3 dropdown" name="sub3">
                                    </select> 
                                    <select id="sub4"  name="sub4" class="span3 dropdown">

                                    </select>
                                </div>
                            </div>    <div class="control-group">
                                <label class="control-label span1" >

                                </label>
                                <div class="controls controls-row">
                                    <select id="sub5" class="span3 dropdown" name="sub5" selected="selected">

                                    </select> 
                                    <select id="sub6"  name="sub6" class="span3 dropdown" selected="selected">

                                    </select>
                                </div>
                            </div>    <div class="control-group">
                            <label class="control-label span1" >

                            </label>
                            <div class="controls controls-row">
                                <select id="sub7" class="span3 dropdown" name="sub7" selected="selected" style="display: none;">

                                </select> 
                                <!--     <select id="sub8"  name="sub8" class="span3 dropdown">-->
                                <!-- <option value="<?php  if($isReAdm != 1) { echo $data[0]['sub8'];} else{echo "";}    ?>" selected="selected"><?php  if($isReAdm != 1) {
                                    // DebugBreak();
                                    echo array_search($data[0]['sub8'],$subarray);}  else {echo "";};
                                ?></option>-->
                                <!--</select>
                                </div>-->
                            </div>

                            <div class="form-actions no-margin">
                                <input type="hidden"   value=""  name="formNo">
                                <input type="hidden"   value="<?php  echo $isReAdm; ?>"  name="IsReAdm">
                                <input type="hidden"   value="<?php  echo $data[0]['SSC_RNo'];; ?>"  name="OldRno">
                                <input type="hidden"   value="<?php  echo $data[0]['SSC_Year'];; ?>"  name="OldYear">
                                <input type="hidden"   value="<?php  echo $data[0]['SSC_Sess'];; ?>"  name="OldSess">
                                <input type="hidden"   value="<?php  echo $data[0]['SSC_brd_cd'];; ?>"  name="OldBrd">
                                <button type="submit" onclick="return checks()" name="btnsubmitUpdateEnrol" class="btn btn-large btn-info offset2">
                                    Save Form
                                </button>
                                <input type="button" class="btn btn-large btn-danger" value="Cancel" id="btnCancel" name="btnCancel" onclick="return CancelAlert();" >
                                <div class="clearfix">
                                </div>
                            </div>


                        </form>
                        <script type="text/javascript">


        function readURL(input) {
    debugger;
    if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
    $('#previewImg').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
    }
    }

                            function checks(){

                                var status  =  check_NewEnrol_validation();
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
