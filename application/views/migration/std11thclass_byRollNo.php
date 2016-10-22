<div class="dashboard-wrapper class wysihtml5-supported">
    <div class="left-sidebar">

        <div class="row-fluid">
            <div class="span12">
                <div class="widget no-margin">
                    <div class="widget-header">
                        <div class="title">
                            11th By Roll No.<a data-original-title="" id="notifications">s</a>
                        </div>

                    </div>
                    <div class="widget-body">

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
                                        <th style="width:20%">
                                            Name
                                        </th>
                                        <th style="width:20%">
                                            Father's Name
                                        </th> <!--
                                        <th style="width:5%" class="hidden-phone">
                                        DOB
                                        </th> -->
                                        <th style="width:20%" class="hidden-phone">
                                            Subject Group
                                        </th>
                                        <th style="width:11%" class="hidden-phone">
                                            Selected Subjects
                                        </th>
                                        <!--<th style="width:4%" class="hidden-phone">
                                            Picture
                                        </th>  -->
                                        <th style="width:18%" class="hidden-phone" >
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // DebugBreak();
                                    $subarray = array(
                                        "E" =>"1",
                                        "U" =>"2",
                                        "BG" =>"3",
                                        "U(EASY)" =>"4",
                                        "BG(EASY)" =>"5",
                                        "P-CUL" =>"6",
                                        "PS" =>"91",
                                        "IE" =>"92",
                                        "CIV/NM" =>"93",
                                        "H" =>"7",
                                        "L/SC" =>"8",
                                        "ECO" =>"11",
                                        "GEO" =>"12",
                                        "MSc" =>"13",
                                        "PHIL" =>"14",
                                        "PSY" =>"16",
                                        "CIV" =>"17",
                                        "ST" =>"18",
                                        "M" =>"19",
                                        "IS" =>"20",
                                        "H-ECO" =>"21",
                                        "MUS" =>"22",
                                        "F/ART" =>"23",
                                        "AR" =>"24",
                                        "BG." =>"25",
                                        "BG(AD)" =>"26",
                                        "E/EL" =>"27",
                                        "FR" =>"28",
                                        "GER" =>"29",
                                        "LAT" =>"30",
                                        "PUN" =>"32",
                                        "PASH" =>"33",
                                        "PER" =>"34",
                                        "SAN" =>"35",
                                        "SIND" =>"36",
                                        "U(AD)" =>"37",
                                        "CP" =>"38",
                                        "HPED" =>"42",
                                        "EDU" =>"43",
                                        "GEOL" =>"44",
                                        "SOC" =>"45",
                                        "BIO" =>"46",
                                        "PHY" =>"47",
                                        "CH" =>"48",
                                        "CSc" =>"83",
                                        "NUR" =>"79",
                                        "AGRI" =>"90",
                                        "P/A" =>"70",
                                        "P/E" =>"71",
                                        "P/C" =>"39",
                                        "B/M" =>"80",
                                        "CG" =>"94",
                                        "BNK" =>"95",
                                        "TYP" =>"96",
                                        "B/ST" =>"97",
                                        "CST" =>"98",
                                        "BKA" =>"99",
                                        "AD/AR" =>"52",
                                        "AD/UR" =>"53",
                                        "F/UR" =>"54",
                                        "F/AR" =>"10",
                                        "IS-H" =>"9",
                                        "HP" =>"55",
                                        "H/ISL" =>"56",
                                        "HIP" =>"57",
                                        "HMW" =>"58",
                                        "IS/G" =>"15",
                                        "Cl/T" =>"75",
                                        "HM" =>"76",
                                        "AA" =>"59",
                                        "F&N" =>"60",
                                        "CD/FL" =>"61",
                                        "Bio(HEco)" =>"72",
                                        "ETH" =>"51",
                                        "Che(HEco)" =>"73",

                                    );
                                    if($data != false)
                                    {
                                   // DebugBreak();
                                        $n=0;  
                                        $grp_name='';                             
                                        foreach($data as $key=>$vals):
                                        $n++;
                                        $formno = !empty($vals["rno"])?$vals["rno"]:"N/A";
                                        $grp_name = $vals["grp_cd"];
                                        switch ($grp_name) {
                                            case '1':
                                                $grp_name = 'Pre-Medical';
                                                break;
                                            case '2':
                                                $grp_name = 'Pre-Engineering';
                                                break;
                                            case '3':
                                                $grp_name = 'Humanities';
                                                break;
                                            case '4':
                                                $grp_name = 'General Science';
                                                break;
                                            case '5':
                                                $grp_name = 'Commerce';
                                                break;
                                            case '6':
                                                $grp_name = 'Home Economics';
                                                break;
                                            default:
                                                $grp_name = "No Group Selected.";
                                        }

                                        echo '<tr  >
                                        <td>'.$n.'</td>
                                        <td>'.$formno.'</td>
                                        <td>'.$vals["name"].'</td>
                                        <td>'.$vals["Fname"].'</td>
                                        <td>'.$grp_name.'</td>
                                        <td>'.array_search($vals['sub1'],$subarray).','.array_search($vals['sub2'],$subarray).','.array_search($vals['sub3'],$subarray).','.array_search($vals['sub4'],$subarray).','.array_search($vals['sub5'],$subarray).','.array_search($vals['sub6'],$subarray).','.array_search($vals['sub7'],$subarray).'</td>
                                       ';
                                         // <td><img id="previewImg" style="width:40px; height: 40px;" src="'.base_url().IMAGE_PATH11.$Inst_Id.'/'.$vals['PicPath'].'" alt="Candidate Image"></td>
                                        echo'<td>
                                        <button type="button" class="btn btn-info" value="'.$formno.'" onclick="releasemForm11th_byRollNo('.$formno.')">Release</button>
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

