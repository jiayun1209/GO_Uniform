<?php
if (isset($_GET['rfq_ID']) && $_GET['rfq_ID'] > 0) {
    $qry = $conn->query("SELECT * from `rfq` where rfq_ID = '{$_GET['rfq_ID']}' ");
    if ($qry->num_rows > 0) {
        foreach ($qry->fetch_assoc() as $k => $v) {
            $$k = $v;
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
    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Firefox */
    input[type=number] {
        -moz-appearance: textfield;
    }
    [name="tax_percentage"],[name="discount_percentage"]{
        width:5vw;
    }
</style>
<div class="card card-outline card-info">
    <div class="card-header">
        <h3 class="card-title"><?php echo isset($id) ? "Update RFQ Details" : "New RFQ" ?> </h3>
    </div>
    <div class="card-body">
        <form action="" id="po-form">
            <input type="hidden" name ="id" value="<?php echo isset($id) ? $id : '' ?>">
            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="vendor_ID">Supplier</label>
                    <select name="vendor_ID" id="vendor_ID" class="custom-select custom-select-sm rounded-0 select2">
                        <option value="" disabled <?php echo!isset($vendor_ID) ? "selected" : '' ?>></option>
                        <?php
                        $supplier_qry = $conn->query("SELECT * FROM `vendor` WHERE registration_status!=0 order by `name` asc");
                        while ($row = $supplier_qry->fetch_assoc()):
                            ?>
                            <option value="<?php echo $row['vendor_ID'] ?>" <?php echo isset($vendor_ID) && $vendor_ID == $row['vendor_ID'] ? 'selected' : '' ?>><?php echo $row['name'] ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="col-md-6 form-group">
                    <label for=rfq_ID>RFQ # <span class="po_err_msg text-danger"></span></label>
                    <input type="text" class="form-control form-control-sm rounded-0" id="rfq_ID" name="rfq_ID" value="<?php echo isset($rfq_ID) ? $rfq_ID : '' ?>">
                    <small><i>Leave this blank to Automatically Generate upon saving.</i></small>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-striped table-bordered" id="item-list">
                        <colgroup>
                            <col width="15%">
                            <col width="20%">
                            <col width="20%">
                            <col width="15%">
                            <col width="20%">
                            <col width="15%">
                        </colgroup>
                        <thead>
                            <tr class="bg-navy disabled">

                                <th class="px-1 py-1 text-center">Quantity</th>
                                <th class="px-1 py-1 text-center">Item Name</th>
                                <th class="px-1 py-1 text-center">Description</th>
                                <th class="px-1 py-1 text-center">Unit Price</th>
                                <th class="px-1 py-1 text-center">Sub Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($rfq_ID)):
                                $rfq_qry = $conn->query("SELECT i.*,p.*,r.* FROM inventory i, purchase_requisiton_details p, rfq r where i.item_code = p.item_id AND p.pr_ID = r.pr_ID AND r.`rfq_ID` = '$rfq_ID' ");
                                echo $conn->error;
                                $total = 0;
                                while ($row = $rfq_qry->fetch_assoc()):
                                    $total += ($row['quantity_request'] * $row['unit_price']);
                                    ?>

                                <td class="align-middle p-1 text-center"> <?php echo $row['quantity_request'] ?> </td>
                                <td class="align-middle p-1 text-center"><?php echo $row['name'] ?> </td>
                                <td class="align-middle p-1 text-center"><?php echo $row['description'] ?></td>
                                <td class="align-middle p-1 text-center"><?php echo ($row['unit_price']) ?> </td>
                                <td class="align-middle p-1 text-center total-price"><?php echo number_format($row['quantity_request'] * $row['unit_price']) ?>
                                </td>
                                </tr>
                                <?php
                            endwhile;
                        endif;
                        ?>
                        </tbody>
                        <tfoot>
                            <tr class="bg-lightblue">
                            <tr>
                                <th class="p-1 text-right" colspan="5">Total</th>
                                <th class="p-1 text-right" id="total"><?php echo number_format($total) ?></th>
                            </tr>
                            </tr>
                        </tfoot>
                    </table>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="remarks" class="control-label">Remarks</label>
                            <textarea name="remarks" id="remarks" cols="10" rows="4" class="form-control rounded-0"><?php echo isset($remark) ? $remark : '' ?></textarea>
                        </div>
                        <div class="col-md-6">
                            <label for="status" class="control-label">Status</label>
                            <select name="status" id="status" class="form-control form-control-sm rounded-0">
								<option value="0" <?php echo isset($status) && $status == 0 ? 'selected': '' ?>>Pending</option>
								<option value="1" <?php echo isset($status) && $status == 1 ? 'selected': '' ?>>Approved</option>
								<option value="2" <?php echo isset($status) && $status == 2 ? 'selected': '' ?>>Rejected</option>
							</select>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="card-footer">
        <button class="btn btn-flat btn-primary" form="po-form">Save</button>
        <a class="btn btn-flat btn-default" href="?page=RFQ">Cancel</a>
    </div>
</div>
<table class="d-none" id="item-clone">
    <tr class="po-item" data-id="">
        <td class="align-middle p-1 text-center">
            <button class="btn btn-sm btn-danger py-0" type="button" onclick="rem_item($(this))"><i class="fa fa-times"></i></button>
        </td>
        <td class="align-middle p-0 text-center">
            <input type="number" class="text-center w-100 border-0" step="any" name="qty[]"/>
        </td>
        <td class="align-middle p-1">
            <input type="hidden" name="item_id[]">
            <input type="text" class="text-center w-100 border-0 item_id" required/>
        </td>
        <td class="align-middle p-1 item-description"></td>
        <td class="align-middle p-1">
            <input type="number" step="any" class="text-right w-100 border-0" name="unit_price[]" value="0"/>
        </td>
        <td class="align-middle p-1 text-right total-price">0</td>
    </tr>
</table>
<script>
    function rem_item(_this) {
        _this.closest('tr').remove()
    }
    function calculate() {
        var _total = 0
        $('.po-item').each(function () {
            var qty = $(this).find("[name='qty[]']").val()
            var unit_price = $(this).find("[name='unit_price[]']").val()
            var row_total = 0;
            if (qty > 0 && unit_price > 0) {
                row_total = parseFloat(qty) * parseFloat(unit_price)
            }
            $(this).find('.total-price').text(parseFloat(row_total).toLocaleString('en-US'))
        })
        $('.total-price').each(function () {
            var _price = $(this).text()
            _price = _price.replace(/\,/gi, '')
            _total += parseFloat(_price)
        })
        /*var discount_perc = 0
        if ($('[name="discount_percentage"]').val() > 0) {
            discount_perc = $('[name="discount_percentage"]').val()
        }
        var discount_amount = _total * (discount_perc / 100);
        $('[name="discount_amount"]').val(parseFloat(discount_amount).toLocaleString("en-US"))
        var tax_perc = 0
        if ($('[name="tax_percentage"]').val() > 0) {
            tax_perc = $('[name="tax_percentage"]').val()
        }
        var tax_amount = _total * (tax_perc / 100);
        $('[name="tax_amount"]').val(parseFloat(tax_amount).toLocaleString("en-US"))*/
        $('#sub_total').text(parseFloat(_total).toLocaleString("en-US"))
        $('#total').text(parseFloat(_total - discount_amount).toLocaleString("en-US"))
    }

     function _autocomplete(_item) {
     _item.find('.item_id').autocomplete({
     source: function (request, response) {
     $.ajax({
     url: base_url + "classes/Master.php?f=search_items",
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
     _item.find('input[name="material_details[]"]').val(ui.item.id)
     _item.find('.item-description').text(ui.item.description)
     }
     })
     }
    $(document).ready(function () {
         $('#add_row').click(function () {
         var tr = $('#item-clone tr').clone()
         $('#item-list tbody').append(tr)
         _autocomplete(tr)
         tr.find('[name="qty[]"],[name="unit_price[]"]').on('input keypress', function (e) {
         calculate()
         })
         
         })
         if ($('#item-list .po-item').length > 0) {
         $('#item-list .po-item').each(function(){
         var tr = $(this)
         _autocomplete(tr)
         tr.find('[name="qty[]"],[name="unit_price[]"]').on('input keypress', function (e) {
         calculate()
         })
         
         tr.find('[name="qty[]"],[name="unit_price[]"]').trigger('keypress')
         }
          else {
         $('#add_row').trigger('click')
         }
        $('.select2').select2({placeholder: "Please Select here", width: "relative"})
        $('#po-form').submit(function (e) {
            e.preventDefault();
            var _this = $(this)
            $('.err-msg').remove();
            $('[name="rfq_ID"]').removeClass('border-danger')
             if ($('#item-list .po-item').length <= 0) {
             alert_toast(" Please add at least 1 item on the list.", 'warning')
             return false;
             }
            start_loader();
            $.ajax({
                url: base_url + "classes/Master.php?f=save_rfq",
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