<div class="dashboard-wrapper class wysihtml5-supported">
<form action="">
    <div class="left-sidebar">
        <div class="row-fluid">
            <div class="span12">
                <div class="widget no-margin">
                    <div class="widget-header">
                        <div class="title">
                             11th Registration Cards Printing<a data-original-title="" id="notifications">s</a>
                        </div>
                                           </div>
                    <div class="widget-body">
                     <!--   <div class="control-group">
                            <h4 class="title">
                                Reports:
                            </h4>
                        </div>-->
<!--                        <hr>-->
                        <div class="control-group">
                            <label class="control-label">
                                <b> Please Select the option and Provide input for Cards:</b>
                            </label>
                        </div>
                        <div class="control-group">
                            <label class="control-label span1">
                                Select Option:
                            </label>
                            <div class="controls controls-row">
                                <label class="radio inline span1">
                                    <input type="radio" name="opt" checked="checked" value="1">Group Wise <br>
                                </label>
                                <label class="radio inline span2">
                                    <input type="radio" name="opt"  value="2">Form No. Wise
                                </label>
                            </div>
                        </div>
                        <div class="control-group" id="grp_selected">
                            <label class="control-label span1">
                                Select Group:
                            </label>
                            <div class="controls controls-row">
                                <select id="std_group_regcard"   class="dropdown span3"  name="std_group_regcard">
                            <?php        
									$subgroups =  split(',',$grp_cdi);
                            echo "<option value='0' >SELECT GROUP</option>";
                            for($i =0 ; $i<count($subgroups); $i++)
                            {
                                if($subgroups[$i] == 1)
                                {
                                   
                                        echo "<option value='1' >Pre-Medical</option>";    
                                }
                                else if($subgroups[$i] == 2)
                                {
                                   
                                        echo "<option value='7'>Pre-Engineering</option>"; 

                                }
                                else if($subgroups[$i] == 3)
                                {
                                    
                                        echo "<option value='8'>Humanities</option>";  
                                    
                                }
                                else if($subgroups[$i] == 4)
                                {
                                   
                                        echo "<option value='2'>General Science</option>";   
                                    

                                }
                                else if($subgroups[$i] == 5)
                                {
                                   
                                        echo "<option value='5'>Commerce</option>";  
                                    

                                }
                                else if($subgroups[$i] == 6)
                                {
                                   
                                        echo "<option value='5'>Home Economics</option>";  
                                    

                                }
                            }
                            
                            echo "</select>" ?>
									
									
									
                            </div>
                        </div>
                        <div style="display: none;" id="formnowise_selected" >
                        <div class="control-group" >
                        <div class="controls controls-row">
                        <label class="control-label span1">Starting Form No.</label>
                        <input type="text" id="strt_formNo"> 
                        </div>
                        </div>
                         <div class="control-group" >
                        <div class="controls controls-row">
                        <label class="control-label span1">Ending Form No.</label>
                        <input type="text" id="ending_formNo"> 
                        </div>
                        </div>
                        </div>
                      </div>
                        <div class="control-group">
                            <div class="controls controls-row">
                                <input type="button" name="print_regCards" id="print_regCards" class="btn btn-large btn-info" value="Print Registration Cards">
                                <!--<input type="submit" name="get_Proof" class="btn btn-large btn-info " id="get_Proof" value="Get Proof Print of Return">
                                <input type="submit" name="get_Proof_reg" id="get_Proof_reg" class="btn btn-large btn-info "  value="Get Proof Print Registration From">-->
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="controls control-group">
                                <label class="control-label label label-important" style="font-size: large;"> 
                                    Instructions: 1-Please Use A-4 Size (80 gram) Paper to Print All Documents/Reports.
                                </label>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>  
    </div>
</div>
