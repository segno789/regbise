
<?php 

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
?>

<div class="container-fluid">
<div class="dashboard-container">
<div class="top-nav">
    <ul>


        <?php 


        if(($isselected == '6' ||  $isselected == '7' || $isselected == '2' || $isselected == '12' ||  $isselected == '10') && $edu_lvl == 3){?>

            <li>
                <a href="<?php echo base_url(); ?>Registration" class="<?php if($isselected == '2') {echo 'selected';}?>" >
                    <div class="fs1" aria-hidden="true" data-icon="&#xe0b8;"></div>
                    9th Registration
                </a>
            </li>
            <!--  <li>
            <a href="<?php echo base_url(); ?>NinthCorrection/EditForms" class="<?php if($isselected == '7') {echo 'selected';}?>" >
            <div class="fs1" aria-hidden="true" data-icon="&#xe0c4;"></div>
            9th Correction
            </a>
            </li>-->
            <li>
                <a href="<?php echo base_url(); ?>Registration_11th" class="<?php if($isselected == '6') {echo 'selected';}?>" >
                    <div class="fs1" aria-hidden="true" data-icon="&#xe0b8;"></div>
                    11th Registration
                </a>
            </li>
            <!--  <li>
            <a href="<?php echo base_url(); ?>EleventhCorrection/EditForms" class="<?php if($isselected == '12') {echo 'selected';}?>" >
            <div class="fs1" aria-hidden="true" data-icon="&#xe0c4;"></div>
            11th Correction
            </a>
            </li>         
            <li>
            <a href="<?php echo base_url(); ?>migration/std11thclass" class="<?php if($isselected == '10') {echo 'selected';}?>" >
            <div class="fs1" aria-hidden="true" data-icon="&#xe0b8;"></div>
            Migration
            </a>
            </li>-->
            <?php }

        else if($isselected == '15' ){?>


            <li>
                <a href="<?php echo base_url(); ?>BiseCorrection/search_Form" class="<?php if($isselected == '13') {echo 'selected';}?>" >
                    <div class="fs1" aria-hidden="true" data-icon="&#xe0c4;"></div>
                    Correction
                </a>
            </li>

            <?php }

        else if(($isselected == '2' OR $isselected == '7' OR $isselected == '10')  && $edu_lvl == 1 ){?>

            <li>
                <a href="<?php echo base_url(); ?>Registration" class="<?php if($isselected == '2') {echo 'selected';}?>" >
                    <div class="fs1" aria-hidden="true" data-icon="&#xe0b8;"></div>
                    Registration
                </a>
            </li>
            <!--<li>
            <a href="<?php echo base_url(); ?>NinthCorrection/EditForms" class="<?php if($isselected == '7') {echo 'selected';}?>" >
            <div class="fs1" aria-hidden="true" data-icon="&#xe0c4;"></div>
            9th Correction
            </a>
            </li>-->
            <!--  <li>
            <a href="<?php echo base_url(); ?>migration/std9thclass" class="<?php if($isselected == '10') {echo 'selected';}?>" >
            <div class="fs1" aria-hidden="true" data-icon="&#xe0b8;"></div>
            Migration
            </a>
            </li>        -->
            <?php } 


        else if(($isselected == '6' ||  $isselected == '12' OR $isselected == '10') && $edu_lvl == 2){?>

            <li>
            <a href="<?php echo base_url(); ?>Registration_11th" class="<?php if($isselected == '6') {echo 'selected';}?>" >
                <div class="fs1" aria-hidden="true" data-icon="&#xe0b8;"></div>
                Registration
            </a>
            <!-- </li>
            <li>
            <a href="<?php echo base_url(); ?>EleventhCorrection/EditForms" class="<?php if($isselected == '12') {echo 'selected';}?>" >
            <div class="fs1" aria-hidden="true" data-icon="&#xe0c4;"></div>
            11th Correction
            </a>
            </li>   
            <li>
            <a href="<?php echo base_url(); ?>migration/std11thclass" class="<?php if($isselected == '10') {echo 'selected';}?>" >
            <div class="fs1" aria-hidden="true" data-icon="&#xe0b8;"></div>
            Migration
            </a>
            </li> -->
            <?php } 

        if($isselected == '0' OR $isselected == '8'  OR $isselected == '11'  OR $isselected == '4' OR $isselected == '13'  OR $isselected == '40'){?>

            <li>
                <a href="<?php echo base_url(); ?>BiseCorrection/reg9thcorrections" class="<?php if($isselected == '8') {echo 'selected';}?>" >
                    <div class="fs1" aria-hidden="true" data-icon="&#xe0b8;"></div>
                    9th Correction
                </a>
            </li>

            <li>
                <a href="<?php echo base_url(); ?>BiseCorrection/reg9thbatch" class="<?php if($isselected == '0') {echo 'selected';}?>" >
                    <div class="fs1" aria-hidden="true" data-icon="&#xe0b8;"></div>
                    9th Reg. Batch
                </a>
            </li>
            <li>
            <a style="width: 115px;" href="<?php echo base_url(); ?>BiseCorrection/migration9th" class="<?php if($isselected == '4') {echo 'selected';}?>" >
            <div class="fs1" aria-hidden="true" data-icon="&#xe032;"> </div>
            9th Migration
            </a>
            </li>
            <li>
                <a href="<?php echo base_url(); ?>BiseCorrection/reg11thcorrections" class="<?php if($isselected == '13') {echo 'selected';}?>" >
                    <div class="fs1" aria-hidden="true" data-icon="&#xe0b8;"></div>
                    11th Correction
                </a>
            </li>
               <li>
            <a style="width: 115px;" href="<?php echo base_url(); ?>BiseCorrection/migration11th" class="<?php if($isselected == '40') {echo 'selected';}?>" >
            <div class="fs1" aria-hidden="true" data-icon="&#xe032;"> </div>
            11th Migration
            </a>
            </li>
            <li>
                <a href="<?php echo base_url(); ?>BiseCorrection/SpecPermison_9th" class="<?php if($isselected == '11') {echo 'selected';}?>" >
                    <div class="fs1" aria-hidden="true" data-icon="&#xe0b9;"></div>
                    Spec. Permission
                </a>
            </li>

            <?php } ?>
    </ul>
    <div class="clearfix">
    </div>
</div>
<div class="sub-nav">
    <?php


    if($isselected == '40'){
        ?>
        <ul >
            <li><a href="<?php echo base_url(); ?>BiseCorrection/migration11th"   data-original-title="" class="<?php if($isselected == '2') {echo 'heading';}?>">Migration</a></li>

            <li>
                <a href="<?php echo base_url(); ?>BiseCorrection/migration11th">
                    11th Migration <?= MIGRATIONSESS?>
                </a>
            </li>
            <li>
                <a href="<?php echo base_url(); ?>BiseCorrection/listmigration11th">
                    List 11th Migration <?= MIGRATIONSESS?>
                </a>
            </li>
            <li>
                <a href="<?php echo base_url(); ?>BiseCorrection/migration12th">
                    12th Migration <?= MIGRATIONSESS2?>
                </a>
            </li>
            <li>
                <a href="<?php echo base_url(); ?>BiseCorrection/listmigration12th">
                    List 12th Migration <?= MIGRATIONSESS2?>
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
            <li><a href="<?php echo base_url(); ?>BiseCorrection/reg9thbatch"   data-original-title="" class="<?php if($isselected == '2') {echo 'heading';}?>">9th Registration</a></li>

            <li>
                <a href="<?php echo base_url(); ?>BiseCorrection/BatchRelease">
                    Online Batch Release
                </a>
            </li>
            <li>
                <a href="<?php echo base_url(); ?>BiseCorrection/BatchRestoreManual">
                    Manual Batch Release
                </a>
            </li>
            <li>
                <a href="<?php echo base_url(); ?>BiseCorrection/BatchRestore">
                    Batch Restore
                </a>
            </li>

            <li>
                <a onclick="return logout();">Logout</a>
            </li>

        </ul>
        <?php
    }     if($isselected == '13') {   ?>

        <ul >
            <li><a href="<?php echo base_url(); ?>BiseCorrection/reg11thcorrections"   data-original-title="" class="<?php if($isselected == '13') {echo 'heading';}?>">11th Registration</a></li>

            <li>
                <a href="<?php echo base_url(); ?>BiseCorrection/reg11thcorrectionapp">
                    11th Correction Applications
                </a>
            </li>
            <li>
                <a href="<?php echo base_url(); ?>BiseCorrection/reg11thcorrectionapp_verified">
                    Verified Correction  
                </a>
            </li>
            <!-- <li>
            <a href="<?php echo base_url(); ?>BiseCorrection/searchbyinst11th">
            11th Search By Inst. Code
            </a>
            </li>
            <li>
            <a href="<?php echo base_url(); ?>BiseCorrection/result11thcorrections">
            11th Result Cards(2016)  
            </a>
            </li>-->
            <li>
                <a href="<?php echo base_url(); ?>BiseCorrection/Delete_Form11">
                    Delete Candidate  
                </a>
            </li>
            <li>
                <a href="<?php echo base_url(); ?>BiseCorrection/Restore_form11">
                    Restore Candidate  
                </a>
            </li>
           <!-- <li>
            <a href="<?php echo base_url(); ?>BiseCorrection/otherBoardNOC">
            Other Board NOC 
            </a>
            </li>-->
            <li>
            <a href="<?php echo base_url(); ?>BiseCorrection/regElegibility">
            Candidate Elegibility  
            </a>
            </li>
            <!--  
            <li>
            <a href="<?php echo base_url(); ?>BiseCorrection/Restore_form">
            Restore Candidate  
            </a>
            </li>
            <li>
            <a href="<?php echo base_url(); ?>BiseCorrection/result11thcorrections">
            11th Result Cards(2016)  
            </a>
            </li>                                                   -->
            <li>
                <a onclick="return logout();">Logout</a>
            </li>

        </ul>
        <?php    }
    if($isselected == '8') {   ?>

        <ul >
            <li><a href="<?php echo base_url(); ?>BiseCorrection/reg9thcorrections"   data-original-title="" class="<?php if($isselected == '2') {echo 'heading';}?>">9th Registration</a></li>



            <li>
                <a href="<?php echo base_url(); ?>BiseCorrection/reg9thcorrectionapp">
                    9th Correction Applications
                </a>
            </li>
            <li>
                <a href="<?php echo base_url(); ?>BiseCorrection/reg9thcorrectionapp_verified">
                    Verified Correction  
                </a>
            </li>
            <!--       <li>
            <a href="<?php echo base_url(); ?>BiseCorrection/searchbyinst">
            9th Search By Inst. Code
            </a>
            </li>
            -->
            <li>
                <a href="<?php echo base_url(); ?>BiseCorrection/Delete_Form">
                    Delete Candidate  
                </a>
            </li>
            <li>
                <a href="<?php echo base_url(); ?>BiseCorrection/Restore_form">
                    Restore Candidate  
                </a>
            </li>
             <li><a href="<?php echo base_url(); ?>NinthCorrection/EditForms"   data-original-title="" >Apply for Correction </a></li>
                    <li>
                        <a href="<?php echo base_url(); ?>NinthCorrection/Applied">
                           Correction Applications
                        </a>
                    </li>
                    
              <li>
            <a href="<?php echo base_url(); ?>BiseCorrection/reg9thEligibility">
            9th Eligibilty List(2017-19)  
            </a>
            </li> 
            <!--  <li>
            <a href="<?php echo base_url(); ?>BiseCorrection/result9thcorrections">
            9th Result Cards(2016)  
            </a>
            </li> 
            <li>
            <a href="<?php echo base_url(); ?>BiseCorrection/result9thcancel">
            9th Result Cancel(2016)  
            </a>
            </li> 
            <li>
            <a href="<?php echo base_url(); ?>BiseCorrection/Correction9thReport">
            9th Correction Report  
            </a>
            </li> -->
            <li>
                <a onclick="return logout();">Logout</a>
            </li>

        </ul>


        <?php }
    if($isselected == '15') { 
        ?>
        <ul >
            <li><a href="<?php echo base_url(); ?>BiseCorrection/search_Form"  data-original-title="" class="<?php if($isselected == '15') {echo 'heading';}?>">Correction</a></li>
            <!--<li>
            <a href="<?php echo base_url(); ?>BiseCorrection/searchbyinst">
            9th Search By Inst. Code
            </a>
            </li>
            <li>
            <a href="<?php echo base_url(); ?>BiseCorrection/otherboard10th">
            9th other Board
            </a>
            </li>-->
            <li>
                <a href="<?php echo base_url(); ?>BiseCorrection/searchbyinst11thcr">
                    11th Search By Inst. Code
                </a>
            </li>
            <li>
                <a href="<?php echo base_url(); ?>BiseCorrection/otherboard11th">
                    11th other Board
                </a>
            </li>
            <!-- <li>
            <a href="#notifications">
            Notifications
            </a>
            </li>         -->
        </ul> <?php }
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
            <li><a href="<?php echo base_url(); ?>Registration"   data-original-title="" class="<?php if($isselected == '2') {echo 'heading';}?>">Registration</a></li>
            <?php if($isfeedingallow == 1) {?>
                <li>
                    <a href="<?php echo base_url(); ?>Registration/NewEnrolment">
                        New Enrolement
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url(); ?>Registration/ReAdmission">
                        Re-Admissions
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url(); ?>Registration/EditForms">
                        Edit Forms
                    </a>
                </li> 
                <li>
                    <a href="<?php echo base_url(); ?>Registration/CreateBatch">
                        Create Batch
                    </a>
                </li>
                <?php }?>

            <li>
                <a href="<?php echo base_url(); ?>Registration/EditPicForms">
                    Edit Pictures Forms
                </a>
            </li>   
            <li>
                <a href="<?php echo base_url(); ?>Registration/batchlist">
                    Batch List
                </a>
            </li>
            <li>
                <a href="<?php echo base_url(); ?>Registration/FormPrinting">
                    Form Printing
                </a>
            </li>
            <li>
                <a href="<?php echo base_url(); ?>Registration/Reg_Cards_Printing_9th">
                    Registration Cards
                </a>
            </li>
            <li>
                <a href="<?php echo base_url(); ?>/Registration/Profile">
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
            <li><a href="<?php echo base_url(); ?>Admission"   data-original-title="" >Admission</a></li>
            <li>
                <a href="<?php echo base_url(); ?>Admission/StudentsData">
                    Students Data
                </a>
            </li>
            <li>
                <a href="<?php echo base_url(); ?>Admission/EditForms">
                    Edit Forms
                </a>
            </li>
            <li>
                <a href="<?php echo base_url(); ?>Admission/CreateBatch">
                    Create Batch
                </a>
            </li>
            <li>
                <a href="<?php echo base_url(); ?>Admission/BatchList">
                    Batch List
                </a>
            </li>
            <li>
                <a href="<?php echo base_url(); ?>Admission/FormPrinting">
                    Form Printing
                </a>
            </li>
            <li>
                <a href="<?php echo base_url(); ?>Admission/ProofReading">
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
            <li><a href="<?php echo base_url(); ?>BiseCorrection/migration9th"   data-original-title="" class="<?php if($isselected == '2') {echo 'heading';}?>">Migration</a></li>

            <li>
                <a href="<?php echo base_url(); ?>BiseCorrection/migration9th">
                    9th Migration <?= MIGRATIONSESS?>
                </a>
            </li>
            <li>
                <a href="<?php echo base_url(); ?>BiseCorrection/listmigration9th">
                    List 9th Migration <?= MIGRATIONSESS?>
                </a>
            </li>
            <li>
                <a href="<?php echo base_url(); ?>BiseCorrection/migration10th">
                    10th Migration <?= MIGRATIONSESS2?>
                </a>
            </li>
            <li>
                <a href="<?php echo base_url(); ?>BiseCorrection/listmigration10th">
                    List 10th Migration <?= MIGRATIONSESS2?>
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

            <li><a href="<?php echo base_url(); ?>NinthCorrection"   data-original-title="" class="<?php if($isselected == '7') {echo 'heading';}?>">9th Correction </a></li>
            <li><a href="<?php echo base_url(); ?>NinthCorrection/EditForms"   data-original-title="" >Apply for Correction </a></li>
            <li>
                <a href="<?php echo base_url(); ?>NinthCorrection/Applied">
                    Applications
                </a>
            </li>

            <li>
                <a onclick="return logout();">Logout</a>
            </li>


        </ul>
        <?php
    }
    if($isselected == '12'){
        ?>
        <ul >

            <li><a href="<?php echo base_url(); ?>EleventhCorrection"   data-original-title="" class="<?php if($isselected == '12') {echo 'heading';}?>">11th Correction </a></li>
            <li><a href="<?php echo base_url(); ?>EleventhCorrection/EditForms"   data-original-title="" >Apply for Correction </a></li>
            <li>
                <a href="<?php echo base_url(); ?>EleventhCorrection/Applied">
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
            <li><a href="<?php echo base_url(); ?>Registration_11th"   data-original-title=""  class="<?php if($isselected == '6') {echo 'heading';}?>">Registration</a></li>

            <?php  if($isinterfeeding == 1) {?>


                <li>
                    <a href="<?php echo base_url(); ?>Registration_11th/Students_matricInfo">
                        Old Students 
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url(); ?>Registration_11th/ReAdmission">
                        Re-Admissions
                    </a>
                </li>

                <li>
                    <a href="<?php echo base_url(); ?>Registration_11th/EditForms">
                        Edit Forms
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url(); ?>Registration_11th/CreateBatch">
                        Create Batch
                    </a>
                </li>

                <?php }?>
            <li>
                <a href="<?php echo base_url(); ?>Registration_11th/batchlist">
                    Batch List
                </a>
            </li>
            <?php if($Inst_Id == 399903 || $Inst_Id == 399902) {?>
                <li>
                    <a href="<?php echo base_url(); ?>Registration_11th/Reg_Cards_Printing_11th">
                        Registration Cards
                    </a>
                </li>
                <?php }?>
            <li>
                <a href="<?php echo base_url(); ?>Registration_11th/FormPrinting">
                    Form Printing
                </a>
            </li>
            <li>
                <a href="<?php echo base_url(); ?>Registration_11th/Profile">
                    Profile
                </a>
            </li>
            <li>
                <a style="cursor: pointer" onclick="return logout();">Logout</a>
            </li>

        </ul>
        <?php
    }

    if($isselected == '10'){
        ?>
        <ul >
            <li><a href="<?php echo base_url(); ?>migration"   data-original-title="" >Migration</a></li>

            <?php 

            if( $edu_lvl == 3 ) {?>
                <!--<li>
                <a href="<?php echo base_url(); ?>migration/std9thclass">
                9th Class Students
                </a>
                </li>
                <li>
                <a href="<?php echo base_url(); ?>migration/get9threalease">
                9th Class Release List
                </a>
                </li>
                <li>
                <a href="<?php echo base_url(); ?>migration/std9thclass_byRollNo">
                9th By Roll No.
                </a>
                </li>
                <li>
                <a href="<?php echo base_url(); ?>migration/get9threalease_byRollNo">
                9th By Roll No. Release List
                </a>
                </li>          -->
                <li>
                    <a href="<?php echo base_url(); ?>migration/std11thclass">
                        11th Class Students
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url(); ?>migration/get11threalease">
                        11th Class Release List
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url(); ?>migration/std11thclass_byRollNo">
                        11th By Roll No.
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url(); ?>migration/get11threalease_byRollNo">
                        11th By Roll No. Release List
                    </a>
                </li>
                <?php } 
            else if($edu_lvl == 1 )
            {?>

                <!-- <li>
                <a href="<?php echo base_url(); ?>migration/std9thclass">
                9th Class Students
                </a>
                </li>
                <li>
                <a href="<?php echo base_url(); ?>migration/get9threalease">
                9th Class Release List
                </a>
                </li>
                <li>
                <a href="<?php echo base_url(); ?>migration/std9thclass_byRollNo">
                9th By Roll No.
                </a>
                </li>
                <li>
                <a href="<?php echo base_url(); ?>migration/get9threalease_byRollNo">
                9th By Roll No. Release List
                </a>
                </li>             -->
                <?php }

            else if($edu_lvl == 2 )
            {?>
                <li>
                    <a href="<?php echo base_url(); ?>migration/std11thclass">
                        11th Class Students
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url(); ?>migration/get11threalease">
                        11th Class Release List
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url(); ?>migration/std11thclass_byRollNo">
                        11th By Roll No.
                    </a>
                </li>

                <li>
                    <a href="<?php echo base_url(); ?>migration/get11threalease_byRollNo">
                        11th By Roll No. Release List
                    </a>
                </li>  


                <?php 
            }
            ?>

        </ul>
        <?php
    }


    ?>
    <?php
    if($isselected == '11') { 
        ?>
        <ul >
            <li><a href="#"   data-original-title=""  class="<?php if($isselected == '11') {echo 'heading';}?>">Special Permission</a></li>


            <li>
                <a href="<?php echo base_url(); ?>BiseCorrection/SpecPermison_9th">
                    9th Special Permission
                </a>
            </li>
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

