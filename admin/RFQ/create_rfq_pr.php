<?php
$Array_account = array();
$sql = "SELECT * FROM purchase_requisitions_details";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = mysqli_fetch_array($result)) {
        array_push($Array_account, $row);
    }
}
echo '<script>var Array_account = ' . json_encode($Array_account) . ';</script>';

if (isset($_GET['id']) && $_GET['id'] > 0) {
    $qry = $conn->query("SELECT * from `quotation` where id = '{$_GET['id']}' ");
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
        <h3 class="card-title"><b><?php echo isset($id) ? "Update Quotation Details" : "New Quotation" ?></b> </h3>
    </div>
    <div class="card-body">
        <form action="" id="po-form">
            <input type="hidden" name ="id" value="<?php echo isset($id) ? $id : '' ?>">
            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="vendor_ID">Supplier Name</label>
                    <select name="vendor_ID" id="vendor_ID" class="custom-select custom-select-lsm rounded-0 select2">
                        <option value="" disabled <?php echo!isset($vendor_ID) ? "selected" : '' ?>></option>
                        <?php
                        $supplier_qry = $conn->query("SELECT * FROM `vendor` WHERE registration_status!=0 order by `name` asc");
                        while ($row = $supplier_qry->fetch_assoc()):
                            ?>
                            <option value="<?php echo $row['vendor_ID'] ?>" <?php echo isset($vendor_ID) && $vendor_ID == $row['vendor_ID'] ? 'selected' : '' ?>><?php echo $row['company_code'] ?> <?php echo $row['name'] ?></option>
                        <?php endwhile; ?>
                    </select>                                        
                    <label for="pr_ID">PR ID</label>
                    <select class="form-control" name="pr_ID" id="pid" onchange="select_id_check_qty()" required>
                        <option value=""> </option>
                        <?php
                        $sql = "SELECT * FROM purchase_requisitions where status != 0 ";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = mysqli_fetch_array($result)) {
                                echo "<option value=" . $row["id"] . ">" . $row["pr_no"] . "</option>";
                            }
                        } else {
                            echo '<script>alert("Invalid input !")</script>';
                        }
                        ?>
                    </select>
                </div> 
                <div class="col-md-6 form-group">
                    <label for="q_ID">RFQ NO# <span class="po_err_msg text-danger"></span></label>
                    <input type="text" class="form-control form-control-lsm rounded-0" id="q_ID" name="q_ID" value="<?php echo isset($q_ID) ? $q_ID : '' ?>">
                    <small><i>Leave this blank to Automatically Generate upon saving.</i></small>
                </div>
                <div class="col-6">
                    <p  class="m-0"><b>Deadline</b></p>
                    <input type="date" name="deadline" id="deadline" class="text-center w-100 border-0 deadline"  placeholder="deadline" required value="<?php echo isset($deadline) ? $deadline : '' ?>">          
                </div>           
                <div class="col-6">
                    <p  class="m-0"><b>Delivery Date</b></p>
                    <input type="date" name="delivery_date" id="delivery_date" class="text-center w-100 border-0 delivery_date"  placeholder="Delivery Date" required value="<?php echo isset($delivery_date) ? $delivery_date : '' ?>">                               
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-striped table-bordered" id="item-list">
                        <colgroup>
                            <col width="5%">
                            <col width="5%">
                            <col width="15%">
                            <col width="15%">
                            <col width="15%">
                        </colgroup>
                        <thead>
                            <tr class="bg-navy disabled">
                                <th class="px-1 py-1 text-center"></th>
                                <th class="px-1 py-1 text-center">Qty</th>
                                <th class="px-1 py-1 text-center">Item ID</th>
                                <th class="px-1 py-1 text-center">Unit Price (RM)</th>
                                <th class="px-1 py-1 text-center">Sub Total (RM)</th>
                            </tr>
                        </thead>
                        <tbody> <?php
                            if (isset($id)):
                                $rqry = $conn->query("SELECT o.*, i.item_code,i.name,i.description,i.id,p.item_id,p.pr_id,p.quantity FROM `quotation` o , inventory i, purchase_requisitions_details p WHERE p.item_id = i.id AND p.pr_id = o.pr_ID AND o.pr_ID = '$id' ");
                                echo $conn->error;
                                $total = 0;
                                while ($row = $rqry->fetch_assoc()):
                                    $total += ($row['quantity'] * $row['unit_price']);
                                    ?>
                                    <tr class="po-item" data-id="">
                                        <td class="align-middle p-1 text-center">
                                            <button class="btn btn-sm btn-danger py-0" type="button" onclick="rem_item($(this))"><i class="fa fa-times"></i></button>
                                        </td>
                                        <td class="align-middle p-1">
                                            <input type="number" step="any" class="text-right w-100 border-0" id="qty[]" name="qty[]"  value="<?php echo ($row['quantity']) ?>"/>
                                        </td>
                                        <td class="align-middle p-1">
                                            <input type="number" class="text-center w-100 border-0" name="item_id[]" value="<?php echo $row['item_id'] ?>" required/>
                                        </td>                                                                
                                        <td class="align-middle p-1">
                                            <input type="number" step="any" class="text-right w-100 border-0" name="unit_price[]"  value="<?php echo ($row['unit_price']) ?>"/>
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
                                <th class="p-1 text-right" colspan="4"><span><button class="btn btn btn-sm btn-flat btn-primary py-0 mx-1" type="button" id="add_row">Add Row</button>
                            </tr>

                            <tr>
                                <th class="p-1 text-right" colspan="4">Total</th>
                                <th class="p-1 text-right" id="total">0</th>
                            </tr>
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
                            <select name="status" id="status" class="form-control form-control-sm rounded-0"">
                                <option value="0" <?php echo isset($status) && $status == 0 ? 'selected' : '' ?>>Pending</option>
                                <option value="1" <?php echo isset($status) && $status == 1 ? 'selected' : '' ?>>Approved</option>
                                <option value="2" <?php echo isset($status) && $status == 2 ? 'selected' : '' ?>>Inactive</option>
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
        <td class="align-middle p-1">
            <input type="number" step="any" class="text-right w-100 border-0" name="qty[]"/>
        </td>
        <td class="align-middle p-1">         
            <input type="number" class="text-center w-100 border-0" name="item_id[]" required/>
        </td>        
        <td class="align-middle p-1">
            <input type="number" step="any" class="text-right w-100 border-0" name="unit_price[]" value="0"/>
        </td>
        <td class="align-middle p-1 text-right total-price">0</td>
    </tr>
</table>
<script>
    var c = false;
    function select_id_check_qty() {
        var elmtTable = document.getElementById('item-list');
        var tableRows = elmtTable.getElementsByTagName('tr');
        var rowCount = tableRows.length;
        for (var x = rowCount - 3; x > 0; x--) {
            document.getElementById("item-list").deleteRow(1);
        }
        for (i = 0; i < Array_account.length; i++) {
            if (Array_account[i][0] === document.getElementById("pid").value) {
                var total = Array_account[i][3] * Array_account[i][2];

                var tr = '<tr class="po-item" data-id="">';
                tr += '<td class="align-middle p-1 text-center">';
                tr += '<button class="btn btn-sm btn-danger py-0" type="button" onclick="rem_item($(this))"><i class="fa fa-times"></i></button></td>';
                tr += ' <td class="align-middle p-1">';
                tr += '<input type="number" step="any" class="text-right w-100 border-0" id="qty[]" name="qty[]" onchange="calculate()" value="' + Array_account[i][3] + '"/></td>';
                tr += '<td class="align-middle p-1">';
                tr += '<input type="number" class="text-center w-100 border-0" name="item_id[]" value="' + Array_account[i][1] + '" required/>';
                tr += '<td class="align-middle p-1">';
                tr += '<input type="number" step="any" class="text-right w-100 border-0" name="unit_price[]" onchange="calculate()" value="' + Array_account[i][2] + '"/></td>';
                tr += ' <td class="align-middle p-1 text-right total-price">' + total + '</td> </tr>';
                $('#item-list tbody').append(tr);
                
                var total1 = sum(Array_account[i][3] * Array_account[i][2]);
                tr += '<tr class="bg-lightblue">';
                tr += '<tr><th class="p-1 text-right" colspan="4"><span><button class="btn btn btn-sm btn-flat btn-primary py-0 mx-1" type="button" id="add_row">Add Row</button></tr>';
                tr += '<tr><th class="p-1 text-right" colspan="4">Total</th>';
                tr += '<th class="p-1 text-right" id="total">' + total1 + '</th></tr>';


                /*     console.log(Array_account[i]);
                 var table = document.getElementById("item-list");
                 var row = table.insertRow(1);j
                 var cell1 = row.insertCell(0);
                 var cell2 = row.insertCell(1);
                 var cell3 = row.insertCell(2);
                 var cell4 = row.insertCell(3);
                 var cell5 = row.insertCell(4);
                 var total = Array_account[i][3] * Array_account[i][2];
                 cell1.innerHTML = '<button class="btn btn-sm btn-danger py-0" type="button" onclick="rem_item($(this))"><i class="fa fa-times"></i></button>';
                 cell2.innerHTML = '<input type="number" step="any" class="text-right w-100 border-0" id="quantity" name="quantity[]" onkeypress="calculate()"  value="' + Array_account[i][3] + '"/>';
                 cell3.innerHTML = '<input type="text" class="text-center w-100 border-0" id="item_id" name="item_id" value="' + Array_account[i][1] + '"/>';
                 cell4.innerHTML = '<input type="number" step="any" class="text-right w-100 border-0" name="unit_price[]"  value="' + Array_account[i][2] + '"/>';
                 cell5.innerHTML = '<td class="align-middle p-1 text-right total-price">' + total + '</td>';*/
            }
        }
    }
    function rem_item(_this) {
        _this.closest('tr').remove();
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
                tr.find('[name=qty[]"],[name="unit_price[]"]').on('input keypress', function (e) {
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
            $('[name="q_ID"]').removeClass('border-danger')
            if ($('#item-list .po-item').length <= 0) {
                alert_toast(" Please add at least 1 item on the list.", 'warning')
                return false;
            }
            start_loader();
            $.ajax({
                url: _base_url_ + "classes/Master.php?f=save_rfq",
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
                        location.href = "./?page=RFQ/view_rfq&id=" + resp.id;
                    } else if ((resp.status == 'failed' || resp.status == 'po_failed') && !!resp.msg) {
                        var el = $('<div>')
                        el.addClass("alert alert-danger err-msg").text(resp.msg)
                        _this.prepend(el)
                        el.show('slow')
                        $("html, body").animate({scrollTop: 0}, "fast");
                        end_loader()
                        if (resp.status == 'po_failed') {
                            $('[name="q_ID"]').addClass('border-danger').focus()
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
</script>
