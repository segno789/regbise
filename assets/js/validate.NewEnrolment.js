jQuery(document).ready(function() {

    $("#MobNo").mask("0999-9999999", {
        placeholder: "_"
    });
    $("#fNic").mask("99999-9999999-9", {
        placeholder: "_"
    });

    var is_muslim = $('input:radio[name="rel"]:checked').val();
    var is_pakistani = $('input:radio[name="nat"]:checked').val();
    var id = $('#grp_cd').val();

    $('#std_group,.rel_class,.nationality_class').live('change keyup', function() {
        var is_muslim = $('input:radio[name="rel"]:checked').val();
        var is_pakistani = $('input:radio[name="nat"]:checked').val();
        var id = $('#grp_cd').val();
    });
    $("#image").change(function() {
        readURL(this);
    });

    $('#data-table').dataTable({
        "sPaginationType": "full_numbers"  ,
        "bAutoWidth" : false,
            "cache": false
    });
});

function readURL(input) {
    var  fileName = input.files[0].name
    var ext = fileName.substring(fileName.lastIndexOf('.') + 1);


    if(ext.toLowerCase() != "jpg" )
    {
        alertify.error("Please uplaod only .JPG Files!"); 

    }
    else
    {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#previewImg').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }  
    }

} 

