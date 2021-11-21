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
            <h5 class="card-title">System Information</h5>
            <!-- <div class="card-tools">
                    <a class="btn btn-block btn-sm btn-default btn-flat border-primary new_department" href="javascript:void(0)"><i class="fa fa-plus"></i> Add New</a>
            </div> -->
        </div>
        <div class="card-body">
            <form action="" id="system-frm">
                <div id="msg" class="form-group"></div>
                <div class="form-group">
                    <label for="name" class="control-label">System Name</label>
                    <input type="text" class="form-control form-control-sm" name="name" id="name" value="<?php echo $_settings->info('name') ?>">
                </div>
                <div class="form-group">
                    <label for="short_name" class="control-label">System Short Name</label>
                    <input type="text" class="form-control form-control-sm" name="short_name" id="short_name" value="<?php echo $_settings->info('short_name') ?>">
                </div>
                <div class="form-group">
                    <label for="company_name" class="control-label">Company Name</label>
                    <input type="text" class="form-control form-control-sm" name="company_name" id="company_name" value="<?php echo $_settings->info('company_name') ?>">
                </div>
                <div class="form-group">
                    <label for="company_email" class="control-label">Company Email</label>
                    <input type="text" class="form-control form-control-sm" name="company_email" id="company_email" value="<?php echo $_settings->info('company_email') ?>">
                </div>
                <div class="form-group">
                    <label for="company_address" class="control-label">Company Address 1</label>
                    <input type="text" class="form-control form-control-sm" name="company_address" id="company_address" value="<?php echo $_settings->info('company_address') ?>">
                </div>
                <div class="form-group">
                    <label for="company_address_1" class="control-label">Company Address 2</label>
                    <input type="text" class="form-control form-control-sm" name="company_address_1" id="company_address_1" value="<?php echo $_settings->info('company_address_1') ?>">
                </div>
                <div class="form-group">
                    <label for="company_city" class="control-label">Company City</label>
                    <input type="text" class="form-control form-control-sm" name="company_city" id="company_city" value="<?php echo $_settings->info('company_city') ?>">
                </div>
                <div class="form-group">
                    <label for="company_postcode" class="control-label">Company Postcode</label>
                    <input type="text" class="form-control form-control-sm" name="company_postcode" id="company_postcode" value="<?php echo $_settings->info('company_postcode') ?>">
                </div>

                <div class="form-group">
                    <label for="company_state" class="control-label">Company State</label>
                    <select class="form-control" id="state">
                        <option value="1">Johor</option>
                        <option value="2">Kedah</option>
                        <option value="3">Kelantan</option>
                        <option value="4">Melaka</option>
                        <option value="5">Negeri Sembilan</option>
                        <option value="6">Pahang </option>
                        <option value="7">Pulau Pinang</option>
                        <option value="8">Perak</option>
                        <option value="9">Perlis</option>
                        <option value="10">Selangor</option>
                        <option value="11">Terengganu</option>
                        <option value="12">Sabah</option>
                        <option value="13">Sarawak</option>
                        <option value="14">Wilayah Persekutuan Kuala Lumpur</option>
                        <option value="15">Wilayah Persekutuan Kuala Labuan</option>
                        <option value="16">Wilayah Persekutuan Kuala Putrajaya</option>
                    </select>
                </div>



                <div class="form-group">
                    <label for="" class="control-label">System Logo</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input rounded-circle" id="customFile" name="img" onchange="displayImg(this, $(this))">
                        <label class="custom-file-label" for="customFile">Choose file</label>
                    </div>
                </div>
                <div class="form-group d-flex justify-content-center">
                    <img src="<?php echo validate_image($_settings->info('logo')) ?>" alt="" id="cimg" class="img-fluid img-thumbnail">
                </div>
                <div class="form-group">
                    <label for="" class="control-label">Cover</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input rounded-circle" id="customFile" name="cover" onchange="displayImg2(this, $(this))">
                        <label class="custom-file-label" for="customFile">Choose file</label>
                    </div>
                </div>
                <div class="form-group d-flex justify-content-center">
                    <img src="<?php echo validate_image($_settings->info('cover')) ?>" alt="" id="cimg2" class="img-fluid img-thumbnail">
                </div>
            </form>
        </div>
        <div class="card-footer">
            <div class="col-md-12">
                <div class="row">
                    <button class="btn btn-sm btn-primary" form="system-frm">Update</button>
                </div>
            </div>
        </div>

    </div>
</div>
<script>
    function displayImg(input, _this) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#cimg').attr('src', e.target.result);
                _this.siblings('.custom-file-label').html(input.files[0].name)
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
    function displayImg2(input, _this) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                _this.siblings('.custom-file-label').html(input.files[0].name)
                $('#cimg2').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
    function displayImg3(input, _this) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                _this.siblings('.custom-file-label').html(input.files[0].name)
                $('#cimg3').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
    $(document).ready(function () {
        $('.summernote').summernote({
            height: 200,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']],
                ['fontname', ['fontname']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ol', 'ul', 'paragraph', 'height']],
                ['table', ['table']],
                ['view', ['undo', 'redo', 'fullscreen', 'codeview', 'help']]
            ]
        })
    })
</script>