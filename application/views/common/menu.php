<html>
    <body>
        <div class="container-fluid">
        <div class="dashboard-container">
        <div class="top-nav">
            <ul>
               

                <?php 
                
                if($isselected == '5'){?>

                    <li>
                        <a style="width: 115px;" href="<?php echo base_url(); ?>index.php/Complaints" class="<?php if($isselected == '5') {echo 'selected';}?>" >
                            <div class="fs1" aria-hidden="true" data-icon="&#xe032;"> </div>
                            Complaints
                        </a>
                    </li>

                    <?php } 
                if($isselected == '4'){?>

                    <li>
                        <a style="width: 115px;" href="<?php echo base_url(); ?>index.php/RollNoSlip" class="<?php if($isselected == '4') {echo 'selected';}?>" >
                            <div class="fs1" aria-hidden="true" data-icon="&#xe032;"> </div>
                            Roll No. Slips
                        </a>
                    </li>
                    <?php } 
                else  if(($isselected == '6' || $isselected == '2') && $edu_lvl == 3){?>

                    <li>
                        <a href="<?php echo base_url(); ?>index.php/Registration" class="<?php if($isselected == '2') {echo 'selected';}?>" >
                            <div class="fs1" aria-hidden="true" data-icon="&#xe0b8;"></div>
                            9th Registration
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>index.php/NinthCorrection/EditForms" class="<?php if($isselected == '7') {echo 'selected';}?>" >
                            <div class="fs1" aria-hidden="true" data-icon="&#xe0c4;"></div>
                            9th Correction
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>index.php/Registration_11th" class="<?php if($isselected == '6') {echo 'selected';}?>" >
                            <div class="fs1" aria-hidden="true" data-icon="&#xe0b8;"></div>
                            11th Registration
                        </a>
                    </li>
                    <?php }

                else if($isselected == '2' OR $isselected == '7'){?>

                    <li>
                        <a href="<?php echo base_url(); ?>index.php/Registration" class="<?php if($isselected == '2') {echo 'selected';}?>" >
                            <div class="fs1" aria-hidden="true" data-icon="&#xe0b8;"></div>
                            Registration
                        </a>
                    </li>
                       <li>
                        <a href="<?php echo base_url(); ?>index.php/NinthCorrection/EditForms" class="<?php if($isselected == '7') {echo 'selected';}?>" >
                            <div class="fs1" aria-hidden="true" data-icon="&#xe0c4;"></div>
                            9th Correction
                        </a>
                    </li>
                    <?php } 

             
                else if($isselected == '6'){?>

                    <li>
                        <a href="<?php echo base_url(); ?>index.php/Registration_11th" class="<?php if($isselected == '6') {echo 'selected';}?>" >
                            <div class="fs1" aria-hidden="true" data-icon="&#xe0b8;"></div>
                            Registration
                        </a>
                    </li>
                    
                    <?php }?>
            </ul>
            <div class="clearfix">
            </div>
        </div>
        <div class="sub-nav">
            <?php
            if($isselected == '5') { 
                ?>
                <ul >

                    <li>
                        <a href="<?php echo base_url(); ?>index.php/complaints">
                            Pending Complaints
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>index.php/complaints/completeCMP">
                            Completed
                        </a>
                    </li>
                    <li>
                        <a onclick="return logout();">Logout</a>
                    </li>

                </ul>
                <?php
            }




            if($isselected == '0') { 
                ?>
                <ul >
                    <li><a href="<?php echo base_url(); ?>index.php/BiseCorrection/reg9thcorrections"   data-original-title="" class="<?php if($isselected == '2') {echo 'heading';}?>">9th Registration</a></li>

                    <li>
                        <a href="<?php echo base_url(); ?>index.php/BiseCorrection/BatchRelease">
                            Online Batch Release
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>index.php/BiseCorrection/BatchRestoreManual">
                            Manual Batch Release
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>index.php/BiseCorrection/BatchRestore">
                            Batch Restore
                        </a>
                    </li>
                    <!--   <li>
                    <a href="<?php echo base_url(); ?>index.php/BiseCorrection/NewEnrolment">
                    9th New Enrolment
                    </a>
                    </li>
                    <li>
                    <a href="<?php echo base_url(); ?>index.php/BiseCorrection/tracebyfromno">
                    Trace by FormNo
                    </a>
                    </li>
                    <li>
                    <a href="<?php echo base_url(); ?>index.php/BiseCorrection/tracebyinstcode">
                    Trace by Institute Code
                    </a>
                    </li>
                    <li>
                    <a href="<?php echo base_url(); ?>index.php/BiseCorrection/migration">
                    9th Migration
                    </a>
                    </li>-->
                    <li>
                        <a onclick="return logout();">Logout</a>
                    </li>
                    <!--  <li>
                    <a href="<?php echo base_url(); ?>Registration/ProofReading">
                    Proof Reading
                    </a>
                    </li>-->
                </ul>
                <?php
            }
            if($isselected == '1') { 
                ?>
                <ul >
                    <li><a href="<?php echo base_url(); ?>index.php"  data-original-title="" class="<?php if($isselected == '1') {echo 'heading';}?>">Dashboard</a></li>
                    <!-- <li>
                    <a href="#notifications">
                    Notifications
                    </a>
                    </li>         -->
                </ul>
                <?php
            }
            if($isselected == '2') { 
                ?>
                <ul >
                    <li><a href="<?php echo base_url(); ?>index.php/Registration"   data-original-title="" class="<?php if($isselected == '2') {echo 'heading';}?>">Registration</a></li>
                    <?php if($isfeedingallow == 1) {?>
                        <li>
                            <a href="<?php echo base_url(); ?>index.php/Registration/NewEnrolment">
                                New Enrolement
                            </a>
                        </li>
                        <!--<li>
                        <a href="<?php echo base_url(); ?>Registration/ReAdmission">
                        Re-Admissions
                        </a>
                        </li>-->
                        <li>
                            <a href="<?php echo base_url(); ?>index.php/Registration/EditForms">
                                Edit Forms
                            </a>
                        </li> 
                        <li>
                            <a href="<?php echo base_url(); ?>index.php/Registration/CreateBatch">
                                Create Batch
                            </a>
                        </li>
                        <?php }?>

                    <li>
                        <a href="<?php echo base_url(); ?>index.php/Registration/EditPicForms">
                            Edit Pictures Forms
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>index.php/Registration/batchlist">
                            Batch List
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>index.php/Registration/FormPrinting">
                            Form Printing
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>/index.php/Registration/Profile">
                            Profile
                        </a>
                    </li>
                    <li>
                        <a style="cursor: pointer" onclick="return logout();">Logout</a>
                    </li>
                    <!--  <li>
                    <a href="<?php echo base_url(); ?>Registration/ProofReading">
                    Proof Reading
                    </a>
                    </li>-->
                </ul>
                <?php
            }
            ?>
            <?php   // 9th admission
            if($isselected == '3'){
                ?>
                <ul >
                    <li><a href="<?php echo base_url(); ?>index.php/Admission"   data-original-title="" >Admission</a></li>
                    <li>
                        <a href="<?php echo base_url(); ?>index.php/Admission/StudentsData">
                            Students Data
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>index.php/Admission/EditForms">
                            Edit Forms
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>index.php/Admission/CreateBatch">
                            Create Batch
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>index.php/Admission/BatchList">
                            Batch List
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>index.php/Admission/FormPrinting">
                            Form Printing
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>index.php/Admission/ProofReading">
                            Proof Reading
                        </a>
                    </li>

                </ul>
                <?php
            }
            ?>
            <?php
            if($isselected == '4'){
                ?>
                <ul >
                    <li><a href="<?php echo base_url(); ?>index.php/RollNoSlip"   data-original-title="" >Roll No. Slips: </a></li>
                    <!-- <li>
                    <a href="<?php echo base_url(); ?>index.php/RollNoSlip/NinthStd">
                    9th Roll No. Slip
                    </a>
                    </li>-->
                    <li>
                        <a href="<?php echo base_url(); ?>index.php/RollNoSlip/TenthStd">
                            10th Roll No. Slip
                        </a>
                    </li>
                    <!-- <li>
                    <a href="<?php echo base_url(); ?>index.php/RollNoSlip/EleventhStd">
                    11th Roll No. Slip
                    </a>
                    </li>-->
                    <li>
                        <a href="<?php echo base_url(); ?>index.php/RollNoSlip/InterStd">
                            12th Roll No. Slip
                        </a>
                    </li>
                    <li>
                        <a onclick="return logout();">Logout</a>
                    </li>


                </ul>
                <?php
            }
           
            if($isselected == '7'){
                ?>
                <ul >
                
                    <li><a href="<?php echo base_url(); ?>index.php/NinthCorrection"   data-original-title="" class="<?php if($isselected == '7') {echo 'heading';}?>">9th Correction </a></li>
                  <li><a href="<?php echo base_url(); ?>index.php/NinthCorrection/EditForms"   data-original-title="" >Apply for Correction </a></li>
                    <li>
                        <a href="<?php echo base_url(); ?>index.php/NinthCorrection/Applied">
                            Applications
                        </a>
                    </li>
                    
                    <li>
                        <a onclick="return logout();">Logout</a>
                    </li>
                   

                </ul>
                <?php
            }
            
            // Inter Registration
            if($isselected == '6') { 
                ?>
                <ul >
                    <li><a href="<?php echo base_url(); ?>index.php/Registration_11th"   data-original-title="" class="<?php if($isselected == '6') {echo 'heading';}?>">Registration</a></li>

                    <?php  if($isinterfeeding == 1) {?>


                        <li>
                            <a href="<?php echo base_url(); ?>index.php/Registration_11th/Students_matricInfo">
                                Old Students 
                            </a>
                        </li>
                        <!-- <li>
                        <a href="<?php echo base_url(); ?>Registration_11th/ReAdmission">
                        Re-Admissions
                        </a>
                        </li>-->

                        <li>
                            <a href="<?php echo base_url(); ?>index.php/Registration_11th/EditForms">
                                Edit Forms
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>index.php/Registration_11th/CreateBatch">
                                Create Batch
                            </a>
                        </li>

                        <?php }?>
                    <li>
                        <a href="<?php echo base_url(); ?>index.php/Registration_11th/batchlist">
                            Batch List
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>index.php/Registration_11th/FormPrinting">
                            Form Printing
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>/index.php/Registration_11th/Profile">
                            Profile
                        </a>
                    </li>
                    <li>
                        <a style="cursor: pointer" onclick="return logout();">Logout</a>
                    </li>
                    <!--  <li>
                    <a href="<?php echo base_url(); ?>Registration/ProofReading">
                    Proof Reading
                    </a>
                    </li>-->
                </ul>
                <?php
            }
            ?>
            <div class="btn-group pull-right">
                <button class="btn btn-primary">
                    Main Menu
                </button>
                <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle">
                    <span class="caret">
                    </span>
                </button>
                <ul class="dropdown-menu pull-right">
                    <li>
                        <a href="index.html" data-original-title="">
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>Registration.php" data-original-title="">
                            Registration
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>Admission.php" data-original-title="">
                            Admission
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>Result.php" data-original-title="">
                            Result
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>Profile.php" data-original-title="">
                            Profile
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </body>
</html>
