<?php if ($_settings->chk_flashdata('success')): ?>
    <script>
        alert_toast("<?php echo $_settings->flashdata('success') ?>", 'success')
    </script>
<?php endif; ?>

<style>

    img#cimg{
        height: 15vh;
        width: 15vh;
        object-fit: cover;
        border-radius: 100% 100%;
    }
    img#cimg2{
        height: 50vh;
        width: 100%;
        object-fit: contain;
        /* border-radius: 100% 100%; */
    }


</style>
<div class="col-lg-12">
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h5 class="card-title">General Settings</h5>
            <!-- <div class="card-tools">
                    <a class="btn btn-block btn-sm btn-default btn-flat border-primary new_department" href="javascript:void(0)"><i class="fa fa-plus"></i> Add New</a>
            </div> -->
        </div>
        <div class="card-body">
            <form action="" id="general-setting">
                <div id="msg" class="form-group"></div>
                <div class="form-group">
                    <label for="pwd_min" class="control-label">Password Minimum Length</label>
                    <input type="number" class="form-control form-control-sm" name="pwd_min" id="name" value="<?php echo $_settings->info('pwd_min') ?>">
                </div>

                <div class="form-group">
                    <label for="theme_colour" class="control-label">Theme Colour</label>
                    <select class="form-control" id="theme_colour" name="theme_colour">
                        <option value="343a40">Dark Grey</option>
                        <option value="800000">Maroon</option>
                        <option value="8B0000">Dark Red</option>
                        <option value="A52A2A">Brown</option>
                        <option value="FF0000">Red</option>
                        <option value="FF6347">Tomato</option>
                        <option value="FF7F50">Coral</option>
                        <option value="CD5C5C">Indian Red</option>
                        <option value="F08080">Light Coral</option>
                        <option value="E9967A">Dark Salmon</option>
                        <option value="FA8072">Salmon</option>
                        <option value="FFA07A">Light Salmon</option>
                        <option value="FF4500">Orange Red</option>
                        <option value="FF8C00">Dark Orange</option>
                        <option value="FFA500">Orange</option>
                        <option value="FFD700">Gold</option>
                        <option value="B8860B">Dark Golden Rod</option>
                        <option value="EEE8AA">Pale Golden Rod</option>
                        <option value="BDB76B">Dark Khaki</option>
                        <option value="F0E68C">Khaki</option>
                        <option value="808000">Olive</option>
                        <option value="FFFF00">Yellow</option>
                        <option value="9ACD32">Yellow Green</option>
                        <option value="556B2F">Dark Olive Green</option>
                        <option value="6B8E23">Olive Drab</option>
                        <option value="7CFC00">Lawn Green</option>
                        <option value="7FFF00">Chart Reuse</option>
                        <option value="ADFF2F">Green Yellow</option>
                        <option value="006400">Dark Green</option>
                        <option value="008000">Green</option>
                        <option value="228B22">Forest Green</option>
                        <option value="00FF00">Lime</option>
                        <option value="32CD32">Lime Green</option>
                        <option value="90EE90">Light Green</option>
                        <option value="98FB98">Pale Green</option>
                        <option value="8FBC8F">Dark Sea Green</option>
                        <option value="00FA9A">Medium Spring Green</option>
                        <option value="00FF7F">Spring Green</option>
                        <option value="2E8B57">Sea Green</option>
                        <option value="66CDAA">Medium Aqua Marine</option>
                        <option value="3CB371">	Medium Sea Green</option>
                        <option value="20B2AA">Light Sea Green</option>
                        <option value="2F4F4F">Dark Slate Gray</option>
                    </select>
                </div>

                <div id="msg" class="form-group"></div>
                <div class="form-group">
                    <label for="idle_time" class="control-label">Idle Time</label>
                    <input type="number" class="form-control form-control-sm" name="idle_time" id="name" value="<?php echo $_settings->info('idle_time') ?>">
                </div>

            </form>
        </div>
        <div class="card-footer">
            <div class="col-md-12">
                <div class="row">
                    <button class="btn btn-sm btn-primary" form="general-setting">Update</button>
                </div>
            </div>
        </div>

    </div>
</div>
<script>
    $(document).ready(function () {
        $('#general-setting').submit(function (e) {
            e.preventDefault();
            start_loader();
            if ($('.err_msg').length > 0) {
                $('.err_msg').remove();
            }

            $.ajax({
                url: _base_url_ + 'classes/GeneralSettings.php?f=update_settings',
                data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                success: function (resp) {
                    if (resp == 1) {
                        // alert_toast("Data successfully saved",'success')
                        location.reload()
                    } else {
                        $('#msg').html('<div class="alert alert-danger err_msg">An Error occured</div>')
                        end_load()
                    }
                }
            })
        })

        $("#theme_colour").val("<?php echo $_settings->info('theme_colour') ?>");
    })
</script>