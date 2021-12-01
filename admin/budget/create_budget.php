<?php
require_once('../../config.php');
?>
<style>
    span.select2-selection.select2-selection--single {
        border-radius: 0;
        padding: 0.25rem 0.5rem;
        padding-top: 0.25rem;
        padding-right: 0.5rem;
        padding-bottom: 0.25rem;
        padding-left: 0.5rem;
        height: auto;
    }
</style>
<form action="" id="budget-form">
    <input type="hidden" name="budget_no" value="" readonly>
    <div class="container-fluid">
        
        <div class="form-group"> <label class="control-label" for="basicinput">Staff Name</label>
            <div class="controls">
                <select name="staff_ID" class="custom-select custom-select-sm rounded-0 select3"  required>
                    <option value="">Select Staff Name</option> 
                    <?php
                    $query = mysqli_query($conn, "select s.id,s.firstname, s.lastname from staff s left join budget_limit b on s.id = b.staff_ID where b.staff_ID is null");
                    while ($row = mysqli_fetch_array($query)) {
                        ?>

                        <option value="<?php echo $row['id']; ?>"><?php echo $row['firstname']." ".$row['lastname']; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        
        <div class="form-group">
            <label for="amount" class="control-label">Amount</label>
            <input type="text" name="amount" id="amount" class="form-control rounded-0" value=" " required>
        </div>
        
        <div class="form-group">
            <label for="description" class="control-label">Description</label>
            <input type ="text" name="description" id="description" class="form-control rounded-0" value=" "required>
        </div>

    </div>
</form>
<script>
    $(function () {
        $('#budget-form').submit(function (e) {
            e.preventDefault();
            var _this = $(this)
            $('.err-msg').remove();
            start_loader();
            $.ajax({
                url: _base_url_ + "classes/Master.php?f=save_budget",
                data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                dataType: 'json',
                error: err => {
                    console.log(err)
                    alert_toast("An error occured", 'error');
                    end_loader();
                },
                success: function (resp) {
                    if (typeof resp == 'object' && resp.status == 'success') {
                        location.reload();
                    } else if (resp.status == 'failed' && !!resp.msg) {
                        var el = $('<div>')
                        el.addClass("alert alert-danger err-msg").text(resp.msg)
                        _this.prepend(el)
                        el.show('slow')
                        $("html, body").animate({scrollTop: 0}, "fast");
                    } else {
                        alert_toast("An error occured", 'error');
                        console.log(resp)
                    }
                    end_loader()
                }
            })
        })
    })
</script>

