<?php
if (isset($_GET['id']) && $_GET['id'] > 0) {
    $qry = $conn->query("SELECT * from `purchase_order` where id = '{$_GET['id']}' ");
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
        <h3 class="card-title"><b><?php echo isset($id) ? "Update Purchase Order Details" : "New Purchase Order" ?></b> </h3>
        <div class="card-tools">
            <a href="?page=purchase_orders/create_with_quo" class="btn btn-flat btn-primary"><span class="fas fa-plus"></span>  With Reference</a>
            <a href="?page=purchase_orders/create_with_template" class="btn btn-flat btn-info"><span class="fas fa-plus"></span>  With Template</a>
        </div>
    </div>
    <div class="card-body">
        <form action="" id="po-form">
            <input type="hidden" name ="id" value="<?php echo isset($id) ? $id : '' ?>">
            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="delivery_date">Delivery Date</label>
                    <input type="date" name="delivery_date" id="delivery_date" class="text-center form-control form-control-sm rounded-0 delivery_date"  placeholder="Delivery Date" required value="<?php echo isset($delivery_date) ? $delivery_date : '' ?>">                               
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="vendor_ID">Supplier Name</label>
                    <select name="vendor_ID" id="vendor_ID" class="custom-select custom-select-sm rounded-0 select2" required>
                        <option value="" disabled <?php echo!isset($vendor_ID) ? "selected" : '' ?>></option>
                        <?php
                        $supplier_qry = $conn->query("SELECT * FROM `vendor` WHERE registration_status!=0 order by `name` asc");
                        while ($row = $supplier_qry->fetch_assoc()):
                            ?>
                            <option value="<?php echo $row['vendor_ID'] ?>" <?php echo isset($vendor_ID) && $vendor_ID == $row['vendor_ID'] ? 'selected' : '' ?>><?php echo $row['name'] ?></option>
                        <?php endwhile; ?><
                    </select>
                </div>
                <div class="col-md-6 form-group">
                    <label for="po_no">PO Number <span class="po_err_msg text-danger"></span></label>
                    <input type="text" class="form-control form-control-sm rounded-0" id="po_no" name="po_no" value="<?php echo isset($po_no) ? $po_no : '' ?>">
                    <small><i>Leave this blank to Automatically Generate upon saving.</i></small>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-striped table-bordered" id="item-list">
                        <colgroup>
                            <col width="5%">
                            <col width="5%">
                            <col width="15%">
                            <col width="10%">
                            <col width="25%">
                            <col width="15%">
                            <col width="15%">
                        </colgroup>
                        <thead>
                            <tr class="bg-navy disabled">
                                <th class="px-1 py-1 text-center"></th>
                                <th class="px-1 py-1 text-center">Qty</th>
                                <th class="px-1 py-1 text-center">Item Name</th>
                                <th class="px-1 py-1 text-center">Item Code</th>
                                <th class="px-1 py-1 text-center">Description</th>
                                <th class="px-1 py-1 text-center">Price (RM)</th>
                                <th class="px-1 py-1 text-center">Total (RM)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($id)):
                                $order_items_qry = $conn->query("SELECT o.*, i.item_code, i.name, i.description FROM `purchase_order_details` o inner join inventory i on o.item_id = i.id where o.`po_id` = '$id' ");
                                echo $conn->error;
                                while ($row = $order_items_qry->fetch_assoc()):
                                    ?>
                                    <tr class="po-item" data-id="">
                                        <td class="align-middle p-1 text-center">
                                            <button class="btn btn-sm btn-danger py-0" type="button" onclick="rem_item($(this))"><i class="fa fa-times"></i></button>
                                        </td>
                                        <td class="align-middle p-0 text-center">
                                            <input type="number" class="text-center w-100 border-0" step="any" name="qty[]" value="<?php echo $row['quantity'] ?>" required/>
                                        </td>
                                        <td class="align-middle p-1">
                                            <input type="hidden" name="item_id[]" value="<?php echo $row['item_id'] ?>">
                                            <input type="text" class="text-center w-100 border-0 item_id" value="<?php echo $row['name'] ?>" required/>
                                        </td>
                                        <td class="align-middle p-1 item-code text-center"><?php echo $row['item_code'] ?></td>
                                        <td class="align-middle p-1 item-description"><?php echo $row['description'] ?></td>
                                        <td class="align-middle p-1">
                                            <input type="number" step="any" class="text-right w-100 border-0" name="unit_price[]"  value="<?php echo ($row['unit_price']) ?>" required/>
                                        </td>
                                        <td class="align-middle p-1 text-right total-price"><?php echo number_format($row['quantity'] * $row['unit_price']) ?></td>
                                    </tr>
                                    <?php
                                endwhile;
                            endif;
                            ?>
                        </tbody>
                        <tfoot>
                            <tr class="bg-lightblue">
                            <tr>
                                <th class="p-1 text-right" colspan="6"><span><button class="btn btn btn-sm btn-flat btn-primary py-0 mx-1" type="button" id="add_row">Add Row</button></span> Sub Total</th>
                                <th class="p-1 text-right" id="sub_total">0</th>
                            </tr>
                            <tr>
                                <th class="p-1 text-right" colspan="6">Discount (%)
                                    <input type="number" step="any" name="discount_percentage" class="border-light text-right" value="<?php echo isset($discount_percentage) ? $discount_percentage : 0 ?>">
                                </th>
                                <th class="p-1"><input type="text" class="w-100 border-0 text-right" readonly value="<?php echo isset($discount_amount) ? $discount_amount : 0 ?>" name="discount_amount"></th>
                            </tr>
                            <tr>
                                <th class="p-1 text-right" colspan="6">Tax Inclusive (%)
                                    <input type="number" step="any" name="tax_percentage" class="border-light text-right" value="<?php echo isset($tax_percentage) ? $tax_percentage : 0 ?>">
                                </th>
                                <th class="p-1"><input type="text" class="w-100 border-0 text-right" readonly value="<?php echo isset($tax_amount) ? $tax_amount : 0 ?>" name="tax_amount"></th>
                            </tr>
                            <tr>
                                <th class="p-1 text-right" colspan="6">Total</th>
                                <th class="p-1 text-right" id="total">0</th>
                            </tr>

                        </tfoot>
                    </table>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="remarks" class="control-label">Remarks</label>
                            <textarea name="remarks" id="remarks" cols="10" rows="6" class="form-control rounded-0"><?php echo isset($remarks) ? $remarks : '' ?></textarea>
                        </div>
                        <div class="col-md-6">
                            <label for="status" class="control-label">Status</label>
                            <span class='form-control form-control-sm rounded-0'>Pending</span>
                            <br>
                            <label for="cancel_reason" class="control-label">Cancellation Reason</label>
                            <textarea name="cancel_reason" disabled id="cancel_reason" cols="10" rows="2" class="form-control rounded-0"><?php echo isset($cancel_reason) ? $cancel_reason : '' ?></textarea>
                            <small><i>Please enter relevant cancellation reason here.</i></small>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="card-footer">
        <button class="btn btn-flat btn-primary" form="po-form">Save</button>
        <a class="btn btn-flat btn-default" href="?page=purchase_orders">Cancel</a>
    </div>
</div>
<table class="d-none" id="item-clone">
    <tr class="po-item" data-id="">
        <td class="align-middle p-1 text-center">
            <button class="btn btn-sm btn-danger py-0" type="button" onclick="rem_item($(this))"><i class="fa fa-times"></i></button>
        </td>
        <td class="align-middle p-0 text-center">
            <input type="number" class="text-center w-100 border-0" step="any" name="qty[]" required/>
        </td>
        <td class="align-middle p-1">
            <input type="hidden" name="item_id[]">
            <input type="text" class="text-center w-100 border-0 item_id" required/>
        </td>
        <td class="align-middle p-1 item-code"></td>
        <td class="align-middle p-1 item-description"></td>
        <td class="align-middle p-1">
            <input type="number" step="any" class="text-right w-100 border-0" name="unit_price[]" value="0" required/>
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
        var discount_perc = 0
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
        $('[name="tax_amount"]').val(parseFloat(tax_amount).toLocaleString("en-US"))
        $('#sub_total').text(parseFloat(_total).toLocaleString("en-US"))
        $('#total').text(parseFloat(_total - discount_amount).toLocaleString("en-US"))
    }

    function _autocomplete(_item) {
        _item.find('.item_id').autocomplete({
            source: function (request, response) {
                $.ajax({
                    url: _base_url_ + "classes/Master.php?f=search_items",
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
                _item.find('input[name="item_id[]"]').val(ui.item.id)
                _item.find('.item-code').text(ui.item.item_code)
                _item.find('.item-description').text(ui.item.description)
            }
        })
    }
    function displayCancellation() {
        var status = document.getElementById("status");
        if (status.value == "3") {
            document.getElementById("cancel_reason").disabled = false;
        } else {
            document.getElementById("cancel_reason").disabled = true;
        }
    }
    $(document).ready(function () {
        $('#add_row').click(function () {
            var tr = $('#item-clone tr').clone()
            $('#item-list tbody').append(tr)
            _autocomplete(tr)
            tr.find('[name="qty[]"],[name="unit_price[]"]').on('input keypress', function (e) {
                calculate()
            })
            $('#item-list tfoot').find('[name="discount_percentage"],[name="tax_percentage"]').on('input keypress', function (e) {
                calculate()
            })
        })
        if ($('#item-list .po-item').length > 0) {
            $('#item-list .po-item').each(function () {
                var tr = $(this)
                _autocomplete(tr)
                tr.find('[name="qty[]"],[name="unit_price[]"]').on('input keypress', function (e) {
                    calculate()
                })
                $('#item-list tfoot').find('[name="discount_percentage"],[name="tax_percentage"]').on('input keypress', function (e) {
                    calculate()
                })
                tr.find('[name="qty[]"],[name="unit_price[]"]').trigger('keypress')
            })
        } else {
            $('#add_row').trigger('click')
        }
        $('.select2').select2({placeholder: "Please Select here", width: "relative"})
        $('#po-form').submit(function (e) {
            e.preventDefault();
            var _this = $(this)
            $('.err-msg').remove();
            $('[name="po_no"]').removeClass('border-danger')
            if ($('#item-list .po-item').length <= 0) {
                alert_toast(" Please add at least 1 item on the list.", 'warning')
                return false;
            }
            start_loader();
            $.ajax({
                url: _base_url_ + "classes/Master.php?f=save_po",
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
                        location.href = "./?page=purchase_orders/view_po&id=" + resp.id;
                    } else if ((resp.status == 'failed' || resp.status == 'po_failed') && !!resp.msg) {
                        var el = $('<div>')
                        el.addClass("alert alert-danger err-msg").text(resp.msg)
                        _this.prepend(el)
                        el.show('slow')
                        $("html, body").animate({scrollTop: 0}, "fast");
                        end_loader()
                        if (resp.status == 'po_failed') {
                            $('[name="po_no"]').addClass('border-danger').focus()
                        }
                    } else {
                        alert_toast("An error occured", 'error');
                        end_loader();
                        console.log(resp)
                    }
                }
            })
        })
    })

    document.addEventListener("DOMContentLoaded", function () {
        var elements = document.getElementsByName("delivery_date");
        for (var i = 0; i < elements.length; i++) {
            elements[i].oninvalid = function (e) {
                e.target.setCustomValidity("");
                if (!e.target.validity.valid) {
                    e.target.setCustomValidity("Please select delivery date.");
                }
            };
            elements[i].oninput = function (e) {
                e.target.setCustomValidity("");
            };
        }
    })

    document.addEventListener("DOMContentLoaded", function () {
        var elements = document.getElementsByName("vendor_ID");
        for (var i = 0; i < elements.length; i++) {
            elements[i].oninvalid = function (e) {
                e.target.setCustomValidity("");
                if (!e.target.validity.valid) {
                    e.target.setCustomValidity("Please select a supplier.");
                }
            };
            elements[i].oninput = function (e) {
                e.target.setCustomValidity("");
            };
        }
    })
</script>