<?php
require_once('../../config.php');
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
<form action="" id="supplier-form">
    <input type="hidden" name="vendor_ID" value="<?php echo($vendor_ID) ? $vendor_ID : "" ?>" readonly>
    <div class="container-fluid">      
        <div class="form-group">        
            <label for="name" class="control-label">Supplier ID</label>  
            <input type="text" name="vendor_ID" id="vendor_ID" class="form-control rounded-0" value="<?php echo($vendor_ID) ? $vendor_ID : "" ?>"readonly>
        </div> 
        <div class="form-group">
            <label for="po" class="control-label">Completed Purchase Order</label>  <br> 
           <textarea name="po" id="po" cols="10" rows="6" class="form-control rounded-0" readonly>
            <?php
            if (isset($vendor_ID)):
                $supplier_qry = $conn->query("SELECT r.*,p.* FROM rating r, purchase_order p WHERE r.vendor_ID = p.vendor_ID and p.status = 4 and r.vendor_ID ='$vendor_ID'");
                while ($row = $supplier_qry->fetch_assoc()):
                    ?> 
 PO Number > <?php echo $row['po_no'] ?>     
 Remarks > <?php echo $row['remarks'] ?> 
                        <?php
                    endwhile;
                endif
                ?>         
            </textarea>  
        </div>
        <div class="form-group">
            <label for="po" class="control-label">Cancelled Purchase Order</label>  <br> 
            <textarea name="po" id="po" cols="10" rows="6" class="form-control rounded-0" readonly>
            <?php
            if (isset($vendor_ID)):
                $supplier_qry = $conn->query("SELECT r.*,p.* FROM rating r, purchase_order p WHERE r.vendor_ID = p.vendor_ID and p.status = 3 and r.vendor_ID ='$vendor_ID'");
                while ($row = $supplier_qry->fetch_assoc()):?> 
PO Number > <?php echo $row['po_no'] ?>    
Cancel Reason > <?php echo $row['cancel_reason'] ?>

                        <?php
                    endwhile;
                endif
                ?>            
            </textarea>   
    </div> 
    <div class="form-group">
        <label for="rating_ID" class="control-label">Rating ID</label>  <br>         
        <?php
        if (isset($vendor_ID)):
            $supplier_qry = $conn->query("SELECT r.*,v.*,m.* FROM `rating_measurement` m, vendor v, rating r WHERE r.vendor_ID = v.vendor_ID and r.performance_ID = m.performance_ID and v.vendor_ID ='$vendor_ID'");
            while ($row = $supplier_qry->fetch_assoc()):
                ?>                     
                <input type="text" name="rating_ID" id="rating_ID" class="form-control rounded-0" value="<?php echo $row['rating_ID'] ?>" readonly> 
                <?php
            endwhile;
        endif
        ?>        
    </div>      
    <div class="form-group">
        <label for="performance_ID" class="control-label">Rating Status</label>
        <select name="performance_ID" id="performance_ID" class="form-control rounded-0" required>
            <?php
            if (isset($vendor_ID)):
                $r_qry = $conn->query("SELECT r.rating_ID,v.*,m.performance_ID FROM `rating_measurement` m, vendor v, rating r WHERE r.vendor_ID = v.vendor_ID and r.performance_ID = m.performance_ID and v.vendor_ID ='$vendor_ID'");
                while ($row = $r_qry->fetch_assoc()):
                    ?>
                    <option value="P0000" <?php echo isset($performance_ID) && $performance_ID == 0 ? "selected" : "P0000" ?> >0&#9956</option>
                    <option value="P0001" <?php echo isset($performance_ID) && $performance_ID == 1 ? "selected" : "P0001" ?>>1&#9956</option>
                    <option value="P0002" <?php echo isset($performance_ID) && $performance_ID == 2 ? "selected" : "P0002" ?>>2&#9956</option>
                    <option value="P0003" <?php echo isset($performance_ID) && $performance_ID == 3 ? "selected" : "P0003" ?>>3&#9956</option>
                    <option value="P0004" <?php echo isset($performance_ID) && $performance_ID == 4 ? "selected" : "P0004" ?>>4&#9956</option>
                    <option value="P0005" <?php echo isset($performance_ID) && $performance_ID == 5 ? "selected" : "P0005" ?>>5&#9956</option>                    
                    <?php
                endwhile;
            endif
            ?>
        </select>
    </div>            
</div>   
</form>
<script>
    $(function () {
        $('#supplier-form').submit(function (e) {
            e.preventDefault();
            var _this = $(this)
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
    function _autocomplete(_item) {
        _item.find('.item_id').autocomplete({
            source: function (request, response) {
                $.ajax({
                    url: _base_url_ + "classes/Master.php?f=search_rating",
                    method: 'POST',
                    data: {q: request.term},
                    dataType: 'json',
                    error: err => {
                        console.log(err)
                    },
                    success: function (resp) {
                        response(resp)
                    }
                })
            },
            select: function (event, ui) {
                console.log(ui)
                _item.find('input[name="performance_ID"]').val(ui.item.id)
                _item.find('.remarks').text(ui.item.item_code)
            }
        })
    }
</script>