<?php
if (isset($_GET['id']) && $_GET['id'] > 0) {
    $qry = $conn->query("SELECT * from `contract` where id = {$_GET['id']} ");
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
        <h3 class="card-title"><?php echo isset($id) ? "Update Contract Date" : "New Contract" ?> </h3>
    </div>
    <div class="card-body">
        <form action="" id="po-form">
            <input type="hidden" name ="id" value="<?php echo isset($id) ? $id : '' ?>">
            <div class="row">               
                <div class="col-md-6 form-group">
                    <label for="contract_ID">Contract ID # <span class="po_err_msg text-danger"></span></label>
                    <input type="text" class="form-control form-control-sm rounded-0" id="contract_ID" name="contract_ID" value="<?php echo isset($contract_ID) ? $contract_ID : '' ?>">
                    <small><i>Leave this blank to Automatically Generate upon saving.</i></small>
                </div>                
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-striped table-bordered" id="item-list">
                        <colgroup>                           
                            <col width="5%">
                            <col width="20%">
                            <col width="20%">
                            <col width="20%">
                        </colgroup>
                        <thead>
                        <br>
                        <tr class="bg-navy disabled">
                            <th class="px-1 py-1 text-center"></th>
                            <th class="px-1 py-1 text-center">Sub Contractor ID</th>
                            <th class="px-1 py-1 text-center">Start Date</th>
                            <th class="px-1 py-1 text-center">End Date</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($id)):                               
                                $sub = $conn->query("SELECT c.*, s.* from contract c, subcontractor s where c.subcontractor_ID = s.subcontractor_ID and c.contract_ID = '$id'");
                                echo $conn->error;
                                while ($row = $sub->fetch_assoc()):
                                    ?>
                                    <tr class="po-item" data-id="">
                                        <td class="align-middle p-1 text-center">
                                            <button class="btn btn-sm btn-danger py-0" type="button" onclick="rem_item($(this))"><i class="fa fa-times"></i></button>
                                        </td>
                                         <td class="align-middle p-1 sub_id "><?php echo $row['subcontractor_ID'] ?></td>                                                                             
                                         <td class="align-middle p-1 date "><?php echo $row['startDate'] ?></td>
                                         <td class="align-middle p-1">
                                            <input type="date" step="any" class="text-right w-100 border-0" name="date[]"  value="<?php echo $row['endDate'] ?>"/>
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
                                <th class="p-1 text-right" colspan="5"><span><button class="btn btn btn-sm btn-flat btn-primary py-0 mx-1" type="button" id="add_row">Add Row</button>
                            </tr>  
                        </tfoot>
                    </table>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="remarks" class="control-label">Remarks</label>
                            <textarea name="remarks" id="remarks" cols="10" rows="4" class="form-control rounded-0"><?php echo isset($remarks) ? $remarks : '' ?></textarea>
                        </div>                       
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="card-footer">
        <button class="btn btn-flat btn-primary" form="po-form">Save</button>
        <a class="btn btn-flat btn-default" href="?page=contract_mgm">Cancel</a>
    </div>
</div>
<table class="d-none" id="item-clone">
    <tr class="po-item" data-id="">
        <td class="align-middle p-1 text-center">
            <button class="btn btn-sm btn-danger py-0" type="button" onclick="rem_item($(this))"><i class="fa fa-times"></i></button>
        </td>      
           <td class="align-middle p-1 sub_id"></td>    
         <td class="align-middle p-1 date"></td>
       <td class="align-middle p-1">
            <input type="hidden" name="date[]">
            <input type="date" class="text-center w-100 border-0 date" required/>
        </td>
     
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
            $('[name="contract_ID"]').removeClass('border-danger')
            if ($('#item-list .po-item').length <= 0) {
                alert_toast(" Please add at least 1 item on the list.", 'warning')
                return false;
            }
            start_loader();
            $.ajax({
                url: _base_url_ + "classes/Master.php?f=save_con",
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
                        location.href = "./?page=contract_mgm" + resp.id;
                    } else if ((resp.status == 'failed' || resp.status == 'po_failed') && !!resp.msg) {
                        var el = $('<div>')
                        el.addClass("alert alert-danger err-msg").text(resp.msg)
                        _this.prepend(el)
                        el.show('slow')
                        $("html, body").animate({scrollTop: 0}, "fast");
                        end_loader()
                        if (resp.status == 'po_failed') {
                            $('[name="contract_ID"]').addClass('border-danger').focus()
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