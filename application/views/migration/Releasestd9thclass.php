<div class="dashboard-wrapper class wysihtml5-supported">
    <div class="left-sidebar">

        <div class="row-fluid">
            <div class="span12">
                <div class="widget no-margin">
                    <div class="widget-header">
                        <div class="title">
                            Release 9th Registration Students<a data-original-title="" id="notifications"></a>
                        </div>
                        
                    </div>
                    <div class="widget-body">
                        <h4>
                            View All Submited Forms:
                        </h4>
                        <hr>
                        <div id="dt_example" class="example_alt_pagination">
                            <table class="table table-condensed table-striped table-hover table-bordered pull-left" id="data-table">
                                <thead>
                                    <tr>
                                        <th style="width: 1%;">
                                            Sr.No.
                                        </th>
                                         <th style="width:5%">
                                            App.No.
                                        </th>
                                        <th style="width:5%">
                                            Form No.
                                        </th>
                                        <th style="width:20%">
                                            Name
                                        </th>
                                        <th style="width:20%">
                                            Father's Name
                                        </th>
                                       
                                         <th style="width:4%" class="hidden-phone">
                                            Picture
                                        </th>
                                        <th style="width:18%" class="hidden-phone" >
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                   // DebugBreak();
                                    if($data != false)
                                    {
                                    $n=0;  
                                    $grp_name='';                             
                                    foreach($data as $key=>$vals):
                                    $n++;
                                    $formno = !empty($vals["Formno"])?$vals["Formno"]:"N/A";
                                   $PicPath = $formno.'.jpg';
                                    echo '<tr  >
                                    <td>'.$n.'</td>
                                  
                                    <td>'.$vals["app_No"].'</td>
                                      <td>'.$formno.'</td>
                                    <td>'.$vals["name"].'</td>
                                    <td>'.$vals["fname"].'</td>
                                     <td><img id="previewImg" style="width:40px; height: 40px;" src="'.base_url().IMAGE_PATH.$Inst_Id.'/'.$PicPath.'" alt="Candidate Image"></td>';
                                    echo'<td>
                                    <button type="button" class="btn btn-info" value="'.$vals["app_No"].'" onclick="downloadchallan('.$vals["app_No"].',1)">Download Challan</button>
                                    <button type="button" class="btn btn-info" value="'.$vals["app_No"].'" onclick="downloadchallan('.$vals["app_No"].',2)">Download Migration Form</button>
                                    </td>
                                    </tr>';
                                    endforeach;
                                    }
                                    ?>
 </tbody>
                            </table>
                            <div class="clearfix"></div>
                        </div>
                        <div class="control-group">
                            <div class="controls controls-row">
                                <label class="label label-important" style="font-size: large;">
                                    Note: Please write "No Image" in the above search to check if any image of candidate is missing or not.
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div> 
</div>
<script type="">
function downloadchallan(app_id,ischallan)
{
    if(ischallan == 2)
    {
     window.location.href = '<?=base_url()?>Migration/Print_migration_Form_Final/'+app_id;   
    }
    else if(ischallan == 1)
    {
      window.location.href = '<?=base_url()?>Migration/Print_challan_Form/'+app_id;      
    }
     
}
</script>

