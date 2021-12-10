<?php
require_once('../../config.php');
$Array_account = array();
$sql = "SELECT * FROM purchase_order";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = mysqli_fetch_array($result)) {
        array_push($Array_account, $row);
    }
}
echo '<script>var Array_account = ' . json_encode($Array_account) . ';</script>';

if (isset($_GET['vendor_ID']) && $_GET['vendor_ID'] != "") {
    $qry = $conn->query("SELECT * from `vendor` where vendor_ID = '{$_GET['vendor_ID']}' ");
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
<form action="method" id="supplier-form">
    <input type="hidden" name="vendor_ID" value="" readonly>
    <div class="container-fluid">             
        <div class="form-group">
            <label for="vendor_ID" >Supplier Name</label>
            <select class="form-control" name="vendor_ID" id="vendor_ID" onchange="select_id_check_name()" onclick="select_id_check_name()">
                <?php
                $sql = "SELECT * FROM vendor";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = mysqli_fetch_array($result)) {
                        echo "<option value=" . $row["vendor_ID"] . ">" . $row["vendor_ID"] . "</option>";
                    }
                } else {
                    echo '<script>alert("Invalid input !")</script>';
                }
                ?>
            </select>
        </div>
        <div class="form-group" border-style: dotted>
            <label for="po" class="control-label">Completed Purchase Order</label>  <br>     
            <textarea type= "text" class="form-control" id="po" cols="10" rows="6" placeholder="" name="po" readOnly/>
            </textarea>    
        </div>   
        <div class="form-group" border-style: dotted>
            <label for="po_no" class="control-label">Cancelled Purchase Order</label>  <br> 
            <textarea type= "text"  id="po_no" cols="10" rows="6" class="form-control rounded-0" name="po_no" readonly>
            </textarea> 
        </div>    
        <div class="form-group">
            <label for="performance_ID" class="control-label">Rating Status</label>
            <select name="performance_ID" id="performance_ID" class="form-control rounded-0" required>
                <option value="P0000" <?php echo isset($performance_ID) && $performance_ID == 0 ? "selected" : "P0000" ?>>0&#9956</option>
                <option value="P0001" <?php echo isset($performance_ID) && $performance_ID == 1 ? "selected" : "P0001" ?>>1&#9956</option>
                <option value="P0002" <?php echo isset($performance_ID) && $performance_ID == 2 ? "selected" : "P0002" ?>>2&#9956</option>
                <option value="P0003" <?php echo isset($performance_ID) && $performance_ID == 3 ? "selected" : "P0003" ?>>3&#9956</option>
                <option value="P0004" <?php echo isset($performance_ID) && $performance_ID == 4 ? "selected" : "P0004" ?>>4&#9956</option>
                <option value="P0005" <?php echo isset($performance_ID) && $performance_ID == 5 ? "selected" : "P0005" ?>>5&#9956</option>                    
            </select>
        </div>      
    </div>
</form>
<script>
    function select_id_check_name() {
        var str = "";
        for (i = 0; i < Array_account.length; i++) {
            if (Array_account[i][4] === document.getElementById("vendor_ID").value && Array_account[i][10] === '5') {
                str += Array_account[i][1].toString() + " " + Array_account[i][9].toString() + '\r\n';
            }
        }
        document.getElementById("po").value = str;
        var str = "";
        for (i = 0; i < Array_account.length; i++) {
            if (Array_account[i][4] === document.getElementById("vendor_ID").value && Array_account[i][10] === '3') {
                str += Array_account[i][1].toString() + " " + Array_account[i][14].toString() + '\r\n';
            }
        }
        document.getElementById("po_no").value = str;
    }


    $(function () {
        $('#supplier-form').submit(function (e) {
            e.preventDefault();
            var _this = $(this);
            $('.err-msg').remove();
            start_loader();
            $.ajax({
                url: _base_url_ + "classes/Master.php?f=save_rating",
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