<div class="dashboard-wrapper class wysihtml5-supported" style="background: white;">
<div class="left-sidebar">
    <div class="row-fluid">
        <div class="span12">
            <div class="widget">
                <div class="widget-header">
                    <div class="title">
                        10th Migration by Roll No.<a id="redgForm" data-original-title=""></a>
                    </div>
                </div>
           <!--     <div class="widget-body">
                    <form class="form-horizontal no-margin" action="<?php echo base_url(); ?>BiseCorrection/migrate/9" method="post" enctype="multipart/form-data">
                        <div class='control-group'>
                            <div class='controls controls-row'>
                                <label class='control-label span2' >
                                    Roll Number:
                                </label>
                                <input class='span3' type='number' id='txtformNo_search' style='text-transform: uppercase;' name='txtformNo_search' placeholder='Roll Number.' maxlength="10" value = '' required='required'>
                                  <label class='control-label span2' >
                                   Inst. Code:
                                </label>
                                <input class='span3' type='number' id='txtinst_search' style='text-transform: uppercase;' name='txtinst_search' placeholder='Inst. Code.' maxlength="6" value = '' required='required'>
                            </div>
                        </div>


                        <div class="form-actions no-margin">
                        <button type="submit" onclick="return valid_migration_form()" name="btnsubmitNewEnrol" class="btn btn-large btn-info offset2">
                            Update Form
                        </button>


                        <div class="clearfix">
                        </div>

                    </form>
                </div>-->
                
                  <div class="widget-body">
                        <h4>
                            All OneWindow 10th Migration Forms:
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
                                            Roll No.
                                        </th>
                                        <th style="width:10%">
                                            Name
                                        </th>
                                        <th style="width:10%">
                                            Father's Name
                                        </th>
                                       
                                      
                                        <th style="width:8%" class="hidden-phone" >
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    if($migration != false)
                                    {
                                        $n=0;  
                                        $grp_name='';                             
                                        foreach($migration as $key=>$vals):
                                        $n++;
                                        $formno = !empty($vals["rno"])?$vals["rno"]:"N/A";
                                      
                                        echo '<tr  >
                                        <td>'.$n.'</td>
                                        <td>'.$formno.'</td>
                                        <td>'.$vals["name"].'</td>
                                        <td>'.$vals["fname"].'</td>';

                                        echo'<td>
                                        <button type="button" class="btn btn-info" value="'.$formno.'" onclick="migrateto('.$formno.','.$vals['Migrated_to'].')">Update Migrate</button>
                                        </td>
                                        </tr>';
                                        endforeach;
                                    }
                                    ?>
 </tbody>
                            </table>
                            <div class="clearfix"></div>
                        </div>
                     
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
    function migrateto(formno,inst_cd)
    {
        window.location.href ="<?php echo base_url(); ?>bisecorrection/migrate/10/"+formno+"/"+inst_cd; 
    }
</script>