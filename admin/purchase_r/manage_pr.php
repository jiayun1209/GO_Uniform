<?php
if (isset($_GET['id']) && $_GET['id'] > 0) {
    $qry = $conn->query("SELECT * from `purchase_requisition` where id = '{$_GET['id']}' ");
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
        <h3 class="card-title"><b><?php echo isset($id) ? "Update PR Details" : "New PR" ?></b> </h3>
    </div>
    <div class="card-body">
        <form action="" id="pr-form">
            <input type="hidden" name ="id" value="<?php echo isset($id) ? $id : '' ?>">
            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="staff_ID">Staff Name</label>
                    <select name="staff_ID" id="staff_ID" class="custom-select custom-select-sm rounded-0 select2">
                        <option value="" disabled <?php echo!isset($staff_ID) ? "selected" : '' ?>></option>
                        <?php
                        $staff_qry = $conn->query("SELECT * FROM `staff` WHERE registration_status!=0 order by `name` asc");
                        while ($row = $staff_qry->fetch_assoc()):
                            ?>
                            <option value="<?php echo $row['staff_ID'] ?>" <?php echo isset($staff_ID) && $staff_ID == $row['staff_ID'] ? 'selected' : '' ?>></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                 <div class="col-md-6 form-group">
                    <label for="q_ID">RR NO# <span class="po_err_msg text-danger"></span></label>
                    <input type="text" class="form-control form-control-sm rounded-0" id="pr_no" name="pr_no" value="<?php echo isset($pr_no) ? $pr_no : '' ?>">
                    <small><i>Leave this blank to Automatically Generate upon saving.</i></small>
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
                               
                            </tr>
                        </thead>
                        <tbody> <?php
                            if (isset($id)):
                                $rqry = $conn->query("SELECT o.*, i.item_code, i.name, i.description FROM `purchase_requisition_details` o inner join inventory i on o.item_id = i.id where o.`pr_id` = '$id' ");
                                echo $conn->error;
                                
                                while ($row = $rqry->fetch_assoc()):
                                   
                                    ?>
                                    <tr class="pr-item" data-id="">
                                        <td class="align-middle p-1 text-center">
                                            <button class="btn btn-sm btn-danger py-0" type="button" onclick="rem_item($(this))"><i class="fa fa-times"></i></button>
                                        </td>
                                        <td class="align-middle p-0 text-center">
                                            <input type="number" class="text-center w-100 border-0" step="any" name="qty[]" value="<?php echo $row['quantity'] ?>"/>
                                        </td>
                                        <td class="align-middle p-1">
                                            <input type="hidden" name="item_id[]" value="<?php echo $row['item_id'] ?>">
                                            <input type="text" class="text-center w-100 border-0 item_id" value="<?php echo $row['name'] ?>" required/>
                                        </td>                                        
                                         <td class="align-middle p-1 item-code text-center"><?php echo $row['item_code'] ?></td>
                                        <td class="align-middle p-1 item-description"><?php echo $row['description'] ?></td>                                     
                                       
                                       
                                    </tr>
                                    <?php
                                endwhile;
                            endif;
                            ?>
                        </tbody>                         
                       <tfoot>
                            <tr class="bg-lightblue">
                            <tr>
                                <th class="p-1 text-right" colspan="5"><span><button class="btn btn btn-sm btn-flat btn-primary py-0 mx-1" type="button" id="add_row">Add Row</button>
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
                            <select name="status" id="status" class="form-control form-control-sm rounded-0" onchange="displayCancellation()">
                                <option value="0" <?php echo isset($status) && $status == 0 ? 'selected' : '' ?>>Pending</option>
                                <option value="1" <?php echo isset($status) && $status == 1 ? 'selected' : '' ?>>Active</option>
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
    <tr class="pr-item" data-id="">
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
        <td class="align-middle p-1 item-code"></td>
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
        if ($('#item-list .pr-item').length > 0) {
            $('#item-list .pr-item').each(function () {
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
        $('#pr-form').submit(function (e) {
            e.preventDefault();
            var _this = $(this)
            $('.err-msg').remove();
            $('[name="pr_no"]').removeClass('border-danger')
            if ($('#item-list .pr-item').length <= 0) {
                alert_toast(" Please add at least 1 item on the list.", 'warning')
                return false;
            }
            start_loader();
            $.ajax({
                url: _base_url_ + "classes/Master.php?f=save_pr",
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
                        location.href = "./?page=purchase_r/view_pr&id=" + resp.id;
                    } else if ((resp.status == 'failed' || resp.status == 'pr_failed') && !!resp.msg) {
                        var el = $('<div>')
                        el.addClass("alert alert-danger err-msg").text(resp.msg)
                        _this.prepend(el)
                        el.show('slow')
                        $("html, body").animate({scrollTop: 0}, "fast");
                        end_loader()
                        if (resp.status == 'pr_failed') {
                            $('[name="pr_no"]').addClass('border-danger').focus()
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
