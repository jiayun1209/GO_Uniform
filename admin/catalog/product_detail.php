<?php if ($_settings->chk_flashdata('success')): ?>
    <script>
        alert_toast("<?php echo $_settings->flashdata('success') ?>", 'success')
    </script>
<?php endif; ?>
<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM inventory WHERE id = '$id' LIMIT 1";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $current_data = $row;
            $vendor_ID =  $current_data["vendor_ID"];
            $catalog_ID =  $current_data["catalog_ID"];
            break;
        }
    } else {
        echo '<script>alert("Error !\nPlease try again");window.location.href = "product_detail.php";</script>';
    }
} else {
    $sql = "SELECT item_code FROM `inventory` ORDER BY item_code DESC LIMIT 1";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $latestnum = ((int) substr($row['item_code'], 2)) + 1;
            if ($latestnum < 10) {
                $newid = "IC000{$latestnum}";
            } else if ($latestnum < 100) {
                $newid = "IC00{$latestnum}";
            } else if ($latestnum < 1000) {
                $newid = "IC0{$latestnum}";
            } else if ($latestnum < 10000) {
                $newid = "IC{$latestnum}";
            }
            break;
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $item_code = $_POST['item_code'];
    $description = $_POST['description'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $status = $_POST['activation'];
    $date_created = $_POST['date_created'];
    $catalog_ID = $_POST['category'];
    $vendor_ID = $_POST['vendor'];
    $currentID = $current_data["id"];

    if (isset($_GET['id'])) {
        $img = $_FILES['img']['name'];
        if ($img) {
            $newimg = "../photo/$img";
        } else {
            $newimg = $current_data["img"];
        }

        $sql = "UPDATE `inventory` SET name = '$name', item_code = '$item_code', img ='$newimg', description='$description', quantity=$quantity, price=$price,status=$status, date_created ='$date_created', catalog_ID=$catalog_ID, vendor_ID=$vendor_ID where id = $currentID ";

        if ($conn->query($sql)) {
            if ($img) {
                move_uploaded_file($_FILES['img']['tmp_name'], "../photo/$img");
            }
            echo '<script>alert("Successfuly update !");window.location.href = "?page=catalog/product_detail&id=' . $currentID . '";</script>';
        } else {
            echo '<script>alert("' . $sql . '")</script>';
        }
    } else {
        $img = $_FILES['img']['name'];
        if ($img) {
            $newimg = "../photo/$img";
        } else {
            $newimg = null;
        }

        $sql = "INSERT INTO `inventory`(`item_code`, `name`, `img`, `description`, `quantity`, `price`, `status`, `catalog_ID`,`vendor_ID`) VALUES('$item_code','$name','$newimg','$description',$quantity,$price,$status,$catalog_ID,$vendor_ID)";

        if ($conn->query($sql)) {
            if ($img) {
                move_uploaded_file($_FILES['img']['tmp_name'], "../photo/$img");
            }
            echo '<script>alert("Successfuly insert!");window.location.href = "?page=items/";</script>';
        } else {
            echo '<script>alert("' . $sql . '")</script>';
        }
    }
}
?>


<html>
    <div class="card card-outline card-info">
        <div class="card-header">
            <h3 class="card-title"><b><?php echo isset($id) ? "Item Details" : "New Item" ?></b> </h3>
        </div>
        <body class="hold-transition sidebar-mini layout-fixed" onload="addnew()">
            <div>
                <section class="content">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-dark">

                                <div class="card-header">
                                    <h3 class="card-title" id="id" name="id">Product id : <?php
                                        if (isset($current_data)) {
                                            echo $current_data["id"];
                                        } else {
                                            echo "(New)";
                                        }
                                        ?></h3>
                                </div>

                                <div class="card-body">
                                    <form method="post" id="form" enctype="multipart/form-data">
                                        <div class="row">

                                            <div class="col-md-4">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="col-md-12">
                                                            <img class="img-fluid mb-12" src="<?php
                                                            if (isset($current_data)) {
                                                                echo $current_data["img"];
                                                            }
                                                            ?>" alt="Photo" style="width: 100%;height:400px;padding-top: 10px" id="img_display" name="img_display">
                                                        </div>
                                                        <div class="col-md-12" >
                                                            <div class="form-group" style="padding-top: 15px">
                                                                <div class="custom-file">
                                                                    <input type="file" accept="image/*" onchange="loadFile(event)" class="custom-file-input" id="img" disabled name="img">
                                                                    <label class="custom-file-label" id="validate_img">Choose file</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-8">
                                                <div class="row">

                                                    <div class="col-md-12">
                                                        <label>Product Code : </label>
                                                        <div class="form-group">                                             
                                                            <input class="form-control"  value="<?php
                                                            if (isset($current_data)) {
                                                                echo $current_data["item_code"];
                                                            } else {
                                                                echo $newid;
                                                            }
                                                            ?>" name="item_code">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <label>Name : </label>
                                                        <div class="form-group">                                             
                                                            <input class="form-control" id="name" name="name"  value="<?php
                                                            if (isset($current_data)) {
                                                                echo $current_data["name"];
                                                            }
                                                            ?>">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <label>Vendor :</label>
                                                        <div class="form-group">
                                                            <select name="vendor" id="vendor" class="custom-select custom-select-lsm rounded-0 select2">
                                                                <option value="" disabled <?php echo!isset ($current_data["vendor_ID"]) ? "selected" : '' ?>></option>
                                                                <?php
                                                                $supplier_qry = $conn->query("SELECT * FROM `vendor`");
                                                                while ($row = $supplier_qry->fetch_assoc()):
                                                                    ?>
                                                                    <option value="<?php echo $row['vendor_ID'] ?>" <?php echo isset($vendor_ID) && $vendor_ID == $row['vendor_ID'] ? 'selected' : '' ?>><?php echo $row['name'] ?></option>
                                                                <?php endwhile; ?>
                                                            </select>   
                                                        </div>
                                                    </div>



                                                    <div class="col-md-12">
                                                        <label>Date release :</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                                            </div>
                                                            <input type="text" class="form-control" placeholder="Leave blank will autogenerate" id="release_date" maxlength="10" value="<?php
                                                            if (isset($current_data)) {
                                                                echo $current_data["date_created"];
                                                            }
                                                            ?>" readOnly name="date_created">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <label>Price(RM) :</label>
                                                        <div class="form-group">                                             
                                                            <input class="form-control" id="price"  onkeypress="return isNumberKey(event)" onkeyup="cal()" value="<?php
                                                            if (isset($current_data)) {
                                                                echo $current_data["price"];
                                                            }
                                                            ?>" name="price">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <label>Quantity in stock :</label>
                                                        <div class="form-group">                                             
                                                            <input class="form-control" id="quantity"  value="<?php
                                                            if (isset($current_data)) {
                                                                echo $current_data["quantity"];
                                                            }
                                                            ?>" name="quantity">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <label>Category :</label>
                                                        <div class="form-group">
                                                            <select name="category" id="category" class="custom-select custom-select-lsm rounded-0 select2">
                                                                <option value="" disabled <?php echo!isset ($current_data["catalog_ID"]) ? "selected" : '' ?>></option>
                                                                <?php
                                                                $supplier_qry = $conn->query("SELECT * FROM `catalog`");
                                                                while ($row = $supplier_qry->fetch_assoc()):
                                                                    ?>
                                                                    <option value="<?php echo $row['id'] ?>" <?php echo isset($catalog_ID) && $catalog_ID == $row['id'] ? 'selected' : '' ?>><?php echo $row['catalog_ID'] ?> <?php echo $row['description'] ?></option>
                                                                <?php endwhile; ?>
                                                            </select> 
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <label>Activation :</label>
                                                        <div class="form-group row" style="padding-left: 5px">   

                                                            <div class="custom-control custom-radio col-md-6">
                                                                <input class="custom-control-input" type="radio" id="customRadio1" name="activation" value="1"  <?php
                                                                if (isset($current_data)) {
                                                                    if ($current_data["status"] == 1) {
                                                                        echo 'checked';
                                                                    }
                                                                }
                                                                ?>>
                                                                <label for="customRadio1" class="custom-control-label">Active</label>
                                                            </div>

                                                            <div class="custom-control custom-radio col-md-6">
                                                                <input class="custom-control-input" type="radio" id="customRadio2" name="activation" value="0"  <?php
                                                                if (isset($current_data)) {
                                                                    if ($current_data["status"] == 0) {
                                                                        echo 'checked';
                                                                    }
                                                                }
                                                                ?>>
                                                                <label for="customRadio2" class="custom-control-label">Inactive</label>
                                                            </div>

                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <label>Description :</label>
                                                        <div class="form-group">
                                                            <textarea class="form-control" rows="5" id="description" name="description"><?php
                                                                if (isset($current_data)) {
                                                                    echo $current_data["description"];
                                                                }
                                                                ?></textarea>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="card-footer">
                                <div class="row">

                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <button class="btn btn-dark" style="width:100%" id="btnback" onclick="back()"> < Back</button>
                                        </div>
                                    </div>

                                    <div class="col-md-9"></div>

                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <button class="btn btn-dark" style="width:100%" id="btncancel" onclick="cancel()" disabled>Cancel</button>
                                        </div>
                                    </div>

                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <button class="btn btn-dark" style="width:100%" id="btnsave" onclick="editorsave()">Edit</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            </section>
    </div>

</body>

</html>

<script>
    var currentURL = window.location.href;
    var input = document.getElementById("release_date");
    var isnew = false;
    function back() {
        var btnoption = document.getElementById("btnsave").textContent;
        if (btnoption === "Save") {
            if (confirm("Confirm to unsave ?")) {
                window.location.href = "?page=catalog/";
            }
        } else {
            window.location.href = "?page=catalog/";
        }
    }

    var dateInputMask = function dateInputMask(elm) {
        elm.addEventListener('keypress', function (e) {
            if (e.keyCode < 47 || e.keyCode > 57) {
                e.preventDefault();
            }

            var len = elm.value.length;

            if (len !== 1 || len !== 3) {
                if (e.keyCode === 47) {
                    e.preventDefault();
                }
            }

            if (len === 2) {
                elm.value += '/';
            }

            if (len === 5) {
                elm.value += '/';
            }
        });
    };

    dateInputMask(input);

    function editable() {
        document.getElementById("btnsave").textContent = "Save";
        document.getElementById("btncancel").disabled = false;
        document.getElementById("img").disabled = false;
        document.getElementById("name").readOnly = false;
        document.getElementById("date_created").readOnly = false;
        document.getElementById("price").readOnly = false;
        document.getElementById("discount").readOnly = false;
        document.getElementById("quantity").readOnly = false;
        document.getElementById("category").readOnly = false;
        document.getElementById("description").readOnly = false;
        document.getElementById("customRadio1").disabled = false;
        document.getElementById("customRadio1").checked = true;
        document.getElementById("customRadio2").disabled = false;
    }

    function addnew() {
        var params = new window.URLSearchParams(window.location.search);
        if (!params.get('id')) {
            isnew = true;
            editable();
            var today = new Date();
            var dd = String(today.getDate()).padStart(2, '0');
            var mm = String(today.getMonth() + 1).padStart(2, '0');
            var yyyy = today.getFullYear();
            document.getElementById("release_date").value = dd + '/' + mm + '/' + yyyy;
        }
    }

    function editorsave() {
        if (document.getElementById("btnsave").textContent === "Save") {
            document.getElementById("form").submit();
        } else {
            editable();
        }


    }

    function isNumberKey(evt) {

        var charCode = (evt.which) ? evt.which : event.keyCode;
        if (charCode > 31 && (charCode !== 46 && (charCode < 48 || charCode > 57)))
            return false;
        if (charCode === 46 && charCode === ".")
            return false;
        if (charCode === ".")
        {
            var number = [];
            number = charCode.split(".");
            if (number[1].length === decimalPts)
                return false;
        }
        return true;

    }

    var loadFile = function (event) {
        var image = document.getElementById('img_display');
        image.src = URL.createObjectURL(event.target.files[0]);
    };
</script>

