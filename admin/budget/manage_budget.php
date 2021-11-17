<?php
require_once('../../config.php');
if (isset($_GET['budget_no']) && $_GET['budget_no'] != "") {
    $qry = $conn->query("SELECT * from `budget_limit` where budget_no = '{$_GET['budget_no']}' ");
    if ($qry->num_rows > 0) {
        foreach ($qry->fetch_assoc() as $k => $v) {
            $$k = stripslashes($v);
        }
    }
}
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
    <input type="hidden" name="budget_no" value="<?php echo($budget_no) ? $budget_no : "" ?>" readonly>
    <div class="container-fluid">
        <div class="form-group">
            <label for="staff_ID" class="control-label">Staff_ID</label>
            <input type="text" name="staff_ID" id="staff_ID" class="form-control rounded-0" value="<?php echo isset($staff_ID) ? $staff_ID : " " ?>" readonly>
        </div>
        <div class="form-group">
            <label for="amount" class="control-label">Amount</label>
            <input type="text" name="" id="amount" class="form-control rounded-0" value="<?php echo isset($amount) ? $amount : " " ?>" required>
        </div>
        <div class="form-group">
            <label for="description" class="control-label">Description</label>
            <input type="text" name="description" id="description" class="form-control rounded-0" value="<?php echo isset($description) ? $description : " " ?>" required>
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