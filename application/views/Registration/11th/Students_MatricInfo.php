<div class="dashboard-wrapper">
    <div class="left-sidebar">
        <div class="row-fluid">
            <div class="span12">
                <div class="widget">
                <link href="<?php echo base_url(); ?>assets/css_matric/main.css" rel="stylesheet">
                    <div class="widget-header">
                        <div class="title" style="float: none !important;">
                            <label class="welcome_note myEngheading" style="float: left;">Please Provide Below Information</label>
                            <label class="myUrduheading" style="float: right;"> براۓ مہربانی سابقہ امتحان کی معلومات فراہم کریں </label>
                        </div>

                    </div>
                    <div class="widget-body">
                        <div id="dt_example" class="example_alt_pagination">
                            <div class="info"  style="position:relative;margin:0;padding:0;overflow:hidden;">
                                <!--FORM START-->
                                <form enctype="multipart/form-data" id="ReturnStatus" name="ReturnStatus" method="post" action="<?php echo base_url(); ?>/index.php/Registration_11th/Get_students_record" >
                                    <table width="99%" class="tbl_form fresh_cand" >
                                        <tbody>

                                            <tr>
                                               <!-- <td style="text-align: left;"><label class=mytblmargin><b>Date of Birth</b><br /><span class="mytblmargin">(DD-MM-YYYY)</span></label></td>
                                                <td><input type="text" class="panjang required custom" id="dob" name="dob" value=""   ></td> -->
                                                <td style="text-align: left;"><b class=mytblmargin>Old Roll No </b></td>
                                                <td><input type="text" class="panjang custom required" id="oldRno" required name="oldRno" value="" maxlength="10" /></td>
                                                
                                                 <td style="text-align: left;"><b class=mytblmargin>Year</b></td>
                                                <td><select id="oldYear" class="custom" name="oldYear">
                                                <?php
                                               // DebugBreak();
                                                
                                                
                                                
                                                    $current_year = date("Y");
                                                    $prev_year = date("Y",strtotime("-1 year"));
                                                    
                                                if($gender== 1){ ?>
                                                       <option value="<?php echo $current_year;  ?>"><?php echo $current_year;  ?></option>
                                                        <option value="<?php echo $prev_year; ?>" ><?php echo $prev_year; ?></option>  
                                                        <option value="<?php echo date("Y",strtotime("-2 year")); ?>" ><?php echo date("Y",strtotime("-2 year")); ?></option>  
                                                        <option value="<?php echo date("Y",strtotime("-3 year")); ?>" ><?php echo date("Y",strtotime("-3 year")); ?></option>  
                                                        <option value="<?php echo date("Y",strtotime("-4 year")); ?>" ><?php echo date("Y",strtotime("-4 year")); ?></option>  
                                                        <option value="<?php echo date("Y",strtotime("-5 year")); ?>" ><?php echo date("Y",strtotime("-5 year")); ?></option>  
                                                <?php }
                                                else{?>
                                                        <option value="<?php echo $current_year;  ?>"><?php echo $current_year;  ?></option>
                                                        <option value="<?php echo $prev_year; ?>" ><?php echo $prev_year; ?></option>  
                                                        <option value="<?php echo date("Y",strtotime("-2 year")); ?>" ><?php echo date("Y",strtotime("-2 year")); ?></option>  
                                                        <option value="<?php echo date("Y",strtotime("-3 year")); ?>" ><?php echo date("Y",strtotime("-3 year")); ?></option>  
                                                        <option value="<?php echo date("Y",strtotime("-4 year")); ?>" ><?php echo date("Y",strtotime("-4 year")); ?></option>  
                                                        <option value="<?php echo date("Y",strtotime("-5 year")); ?>" ><?php echo date("Y",strtotime("-5 year")); ?></option>  
                                                <?php }    
                                                ?>
                                                  
                                                  
                                                    </select>
                                                </td>
                                            </tr>
<!--                                            <tr>-->
                                                <!--<td style="text-align: left;"><b class=mytblmargin>Class</b></td>
                                                <td><select id="oldClass" class="custom" name="oldClass">
                                                        <option value="10" >10</option>
                                                        <option value="9" >09</option>
                                                    </select></td>-->
                                                <!--<td style="text-align: left;"><b class=mytblmargin>Year</b></td>
                                                <td><select id="oldYear" class="custom" name="oldYear">
                                                        <option value="2015">2015</option>
                                                        <option value="2014" >2014</option>
                                                    </select>
                                                </td>-->
<!--                                            </tr>-->
                                            <tr>
                                                <td style="text-align: left;"><b class=mytblmargin>Session</b></td>
                                                <td><select id="oldSess" class="custom" name="oldSess">
                                                        <option value="1" >Annual</option>
                                                        <option value="2">Supplementary</option>
                                                    </select>
                                                </td>
                                                <td style="text-align: left;"><b class=mytblmargin>Board</b></td>
                                                <td>
                                                    <select id="sec_board" class="custom" name="oldBrd_cd">
                                                    <option value="1">BISE, GUJRANWALA</option><option value="2">BISE,  LAHORE</option><option value="3">BISE,  RAWALPINDI</option><option value="4">BISE,  MULTAN</option><option value="5">BISE,  FAISALABAD</option><option value="6">BISE,  BAHAWALPUR</option><option value="7">BISE,  SARGODHA</option><option value="8">BISE,  DERA GHAZI KHAN</option><option value="9">FBISE, ISLAMABAD</option><option value="10">BISE, MIRPUR</option><option value="11">BISE, ABBOTTABAD</option><option value="12">BISE, PESHAWAR</option><option value="13">BSE, KARACHI</option><option value="14">BISE, QUETTA</option><option value="15">BISE, MARDAN</option><option value="17">CAMBRIDGE</option><option value="18">AIOU, ISLAMABAD</option><option value="19">BISE, KOHAT</option><option value="20">KARAKURUM</option><option value="21">MALAKAN</option><option value="22">BISE, BANNU</option><option value="23">BISE, D.I.KHAN</option><option value="24">AKUEB, KARACHI</option><option value="25">BISE, HYDERABAD</option><option value="26">BISE, LARKANA</option><option value="27">BISE, MIRPUR(SINDH)</option><option value="28">BISE, SUKKUR</option><option value="29">BISE, SWAT</option><option value="30">SBTE KARACHI</option><option value="31">PBTE, LAHORE</option><option value="32">AFBHE RAWALPINDI</option><option value="33">BIE, KARACHI</option><option value="34">BISE SAHIWAL</option>
                                                                                   </select>
                                                                                    <!-- <select id="sec_board" class="custom" name="oldBrd_cd">
                                                    <option value="1" selected="selected">BISE, GUJRANWALA</option>
                                                    </select> -->
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>

                                    
                                    <div style="vertical-align:bottom;margin-top: 20px;">
                                        <input type="submit" value="Proceed" id="proceed" name="proceed" class="jbtn jmedium jblack">
                                        <input type="button" value="Cancel" onclick="return Dashboard();" class="jbtn jmedium jblack">
                                    </div>
                                </form>
                            </div>
                           
                            <div class="clearfix">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>



    </div>
</div>
<!--<script type="">
function std_group(val)
{
if(val>0)
{
document.getElementById("downbtn").disabled=false; 
document.getElementById("viewbtn").disabled=false; 
}
else
{
document.getElementById("downbtn").disabled=true;
document.getElementById("viewbtn").disabled=true;
}

}

</script>-->

