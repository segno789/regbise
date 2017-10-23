<div class="dashboard-wrapper class wysihtml5-supported" style="background: white;">
<div class="left-sidebar">
    <div class="row-fluid">
        <div class="span12">
            <div class="widget">
                <div class="widget-header">
                    <div class="title">
                        Search Candidates through Form No.<a id="redgForm" data-original-title=""></a>
                    </div>
                </div>
                <div class="widget-body">
                    <form class="form-horizontal no-margin" action="<?php echo base_url(); ?>/index.php/BiseCorrection/NewEnrolment_EditForm11" method="post" enctype="multipart/form-data">
                        <div class='control-group'>
                            <div class='controls controls-row'>
                                <label class='control-label span1' >
                                    FORM NO:
                                </label>
                                <input class='span3' type='number' id='txtformNo_search' style='text-transform: uppercase;' name='txtformNo_search' placeholder='FORM NO.' maxlength="10" value = '' >
                            </div>
                        </div>
                          <div class='control-group'>
                            <div class='controls controls-row'>
                                <label class='control-label span12' style="text-align: left; font-weight:900;" >
                                    OR SEARCH BY <u> <a href="<?php echo base_url(); ?>BiseCorrection/searchbyinst11thDelete_candidate" style="color: blue;">INSTITUTE CODE</a></u>
                                </label>         

                            </div>
                        </div>
                          
                        <div class='control-group'>
                            <div class='controls controls-row'>
                                <label class='control-label span12' style="text-align: left; font-weight:900;" >
                                    OR SEARCH BY MATRIC INFORMATION
                                </label>

                            </div>
                        </div>
                        <div class='control-group'>
                            <div class='controls controls-row'>
                                <label class='control-label span1' >
                                    Matric Roll No:
                                </label>
                                <input class='span3' type='number' id='txtmatricRollno_search' style='text-transform: uppercase;' name='txtmatricRollno_search' placeholder='Matric Rno.' maxlength="8" value = '' >
                            </div>
                            <div class='controls controls-row'>
                                <label class='control-label span1' >
                                    Matric Year:
                                </label>
                                <select  class='span3' id="txtmatricYear_search" name="txtmatricYear_search" ><option value="0">Select Year</option>
                                    <?php $current_year=date("Y");
                                    for($i=2000;$i<=$current_year;$i++){ ?>
                                        <option value="<?php echo $i;?>"><?php echo $i;?></option>
                                        <?php } ?>
                                </select>
                            </div>
                            <div class='controls controls-row'>
                                <label class='control-label span1' >
                                    Matric Session:
                                </label>
                                <select id="txtmatricSess_search" name="txtmatricSess_search" class='span3' >
                                    <option value="0">Select Session</option>
                                    <option value="1">Annual</option>
                                    <option value="2">Supplementary</option>
                                </select>
                            </div>
                            <div class='controls controls-row'>
                                <label class='control-label span1' >
                                    Matric Board:
                                </label>
                                <select  class='span3' id="txtmatricBrd_search" name="txtmatricBrd_search">
                                    <option value="0">Select Board</option>
                                    <option value="1" >BISE, GUJRANWALA</option>
                                    <option value="2" >BISE,  LAHORE</option>
                                    <option value="3" >BISE,  RAWALPINDI</option>
                                    <option value="4" >BISE,  MULTAN</option>
                                    <option value="5" >BISE,  FAISALABAD</option>
                                    <option value="6" >BISE,  BAHAWALPUR</option>
                                    <option value="7" >BISE,  SARGODHA</option>
                                    <option value="8" >BISE,  DERA GHAZI KHAN</option>
                                    <option value="9" >FBISE, ISLAMABAD</option>
                                    <option value="10" >BISE, MIRPUR</option>
                                    <option value="11" >BISE, ABBOTTABAD</option>
                                    <option value="12" >BISE, PESHAWAR</option>
                                    <option value="13" >BISE, KARACHI</option>
                                    <option value="14" >BISE, QUETTA</option>
                                    <option value="15" >BISE, MARDAN</option>
                                    <option value="16" >FBISE, ISLAMABAD</option>
                                    <option value="17" >CAMBRIDGE</option>
                                    <option value="18" >AIOU, ISLAMABAD</option>
                                    <option value="19" >BISE, KOHAT</option>
                                    <option value="20" >KARAKURUM</option>
                                    <option value="21" >MALAKAN</option>
                                    <option value="22" >BISE, BANNU</option>
                                    <option value="23" >BISE, D.I.KHAN</option>
                                    <option value="24" >AKUEB, KARACHI</option>
                                    <option value="25" >BISE, HYDERABAD</option>
                                    <option value="26" >BISE, LARKANA</option>
                                    <option value="27" >BISE, MIRPUR(SINDH)</option>
                                    <option value="28" >BISE, SUKKUR</option>
                                    <option value="29" >BISE, SWAT</option>
                                    <option value="30" >SBTE KARACHI</option>
                                    <option value="31" >PBTE, LAHORE</option>
                                    <option value="32" >AFBHE RAWALPINDI</option>
                                    <option value="33" >BIE, KARACHI</option>
                                    <option value="34" >BISE SAHIWAL</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-actions no-margin">
                        <button type="submit" onclick="return valid_delete_form()" name="btnsubmitNewEnrol" class="btn btn-large btn-info offset2">
                            Show Record
                        </button>


                        <div class="clearfix">
                        </div>

                    </form>
                </div>
            </div>  

        </div>
    </div>
</div>
<script type="text/javascript">



    function CancelAlert()
    {
        var msg = "Are You Sure You want to Cancel this Form ?"
        alertify.confirm(msg, function (e) {
            if (e) {
                // user clicked "ok"
                window.location.href ="<?php echo base_url(); ?>index.php/Registration/index/7";
            } else {
                // user clicked "cancel"

            }
        });
    }
</script>