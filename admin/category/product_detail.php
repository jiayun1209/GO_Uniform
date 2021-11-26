<?php

$category_array = array();
$sql = "SELECT item_code FROM inventory";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = mysqli_fetch_array($result)) {
        $category_array[] = $row['item_code'];
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM inventory WHERE id = '$id' LIMIT 1";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $current_data = $row;
            break;
        }
    } else {
        echo '<script>alert("Error !\nPlease try again");window.location.href = "product_detail.php";</script>';
    }
} else {
    $sql = "SELECT id FROM inventory ORDER BY id DESC LIMIT 1";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $latestnum = ((int) substr($row['id'], 1)) + 1;
            if ($latestnum < 10) {
                $newid = "P0000{$latestnum}";
            } else if ($latestnum < 100) {
                $newid = "P000{$latestnum}";
            } else if ($latestnum < 1000) {
                $newid = "P00{$latestnum}";
            } else if ($latestnum < 10000) {
                $newid = "P0{$latestnum}";
            } else if ($latestnum < 10000) {
                $newid = "P{$latestnum}";
            }
            break;
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_GET['id'])) {
        $img = $_FILES['img']['name'];
        if ($img) {
            $newimg = "../photo/$img";
        } else {
            $newimg = $current_data["img"];
        }

        $sql = "UPDATE `product`"
                . " SET img='" . $newimg . "',"
                . "productname='" . $_POST['productname'] . "',"
                . "daterelease='" . $_POST['daterelease'] . "',"
                . "price='" . $_POST['price'] . "',"
                . "quantity='" . $_POST['quantity'] . "',"
                . "category='" . $_POST['category'] . "',"
                . "description='" . $_POST['description'] . "',"
                . "activation='" . $_POST['activation'] . "'"
                . " WHERE productid ='" . $current_data["productid"] . "'";

        if ($conn->query($sql)) {
            if ($img) {
                move_uploaded_file($_FILES['img']['tmp_name'], "../photo/$img");
            }
            echo '<script>alert("Successfuly update !");var currentURL = window.location.href;window.location.href = currentURL;</script>';
        } else {
            echo $sql ;
        }
    }
    else {
        $img = $_FILES['img']['name'];
        if ($img) {
            $newimg = "../photo/$img";
        } else {
            $newimg =null;
        }

        $sql = "INSERT INTO `product`(`productid`, `img`, `productname`, `daterelease`, `price`, `quantity`, `category`, `description`, `activation`) VALUES("
                . "'" . $_POST['productid'] . "',"
                . "'" . $newimg . "',"
                . "'" . $_POST['productname'] . "',"
                . "'" . $_POST['daterelease'] . "',"
                . $_POST['price'] . ","
                . $_POST['quantity'] . ","
                . "'" . $_POST['category'] . "',"
                . "'" . $_POST['description'] . "',"
                . "'" . $_POST['activation'] . "')";

        if ($conn->query($sql)) {
            if ($img) {
                move_uploaded_file($_FILES['img']['tmp_name'], "../photo/$img");
            }
            echo '<script>alert("Successfuly insert !");window.location.href = "product_detail.php?id=' . $_POST['productid'] . '";</script>';
        } else {
            echo '<script>alert("'.$sql.'")</script>';
        }
    }
}
?>


<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Tempusdominus Bbootstrap 4 -->
        <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
        <!-- iCheck -->
        <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
        <!-- JQVMap -->
        <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="dist/css/adminlte.min.css">
        <!-- overlayScrollbars -->
        <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
        <!-- Daterange picker -->
        <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
        <!-- summernote -->
        <link rel="stylesheet" href="plugins/summernote/summernote-bs4.css">
        <!-- Google Font: Source Sans Pro -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
        <link rel="shortcut icon" href="../images/p_icon.ico">
        <title>Product detail</title>
    </head>
    <body class="hold-transition sidebar-mini layout-fixed" onload="addnew()">
        <div class="wrapper">
            <div class="content-wrapper">
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0 text-dark">Product detail</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="product_list.php">Product List</a></li>
                                    <li class="breadcrumb-item active">Product detail</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                <section class="content">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-dark">

                                <div class="card-header">
                                    <h3 class="card-title" id="titleid">Product id : <?php
                                        if (isset($current_data)) {
                                            echo $current_data["productid"];
                                        } else {
                                            echo "(New) " . $newid;
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
                                                        <label>Product id : </label>
                                                        <div class="form-group">                                             
                                                            <input class="form-control"  value="<?php
                                                            if (isset($current_data)) {
                                                                echo $current_data["productid"];
                                                            } else {
                                                                echo $newid;
                                                            }
                                                            ?>" name="productid">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <label>Name : </label>
                                                        <div class="form-group">                                             
                                                            <input class="form-control" id="name" name="productname"  value="<?php
                                                            if (isset($current_data)) {
                                                                echo $current_data["productname"];
                                                            }
                                                            ?>">
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-md-12">
                                                        <label>Date release :</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                                            </div>
                                                            <input type="text" class="form-control" placeholder="dd/mm/yyyy" id="release_date" maxlength="10" value="<?php
                                                            if (isset($current_data)) {
                                                                echo $current_data["daterelease"];
                                                            }
                                                            ?>" readOnly name="daterelease">
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
                                                            <select class="custom-select" id="category" name="category">
                                                                <option value="">--Select--</option>
                                                                <?php
                                                                foreach ($category_array as $selection) {
                                                                    $selected = ($current_data["category"] == $selection) ? "selected" : "";
                                                                    echo '<option ' . $selected . ' value="' . $selection . '">' . $selection . '</option>';
                                                                }
                                                                echo '</select>';
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <label>Activation :</label>
                                                        <div class="form-group row" style="padding-left: 5px">   

                                                            <div class="custom-control custom-radio col-md-6">
                                                                <input class="custom-control-input" type="radio" id="customRadio1" name="activation" value="1"  <?php
                                                                if (isset($current_data)) {
                                                                    if ($current_data["activation"] == 1) {
                                                                        echo 'checked';
                                                                    }
                                                                }
                                                                ?>>
                                                                <label for="customRadio1" class="custom-control-label">Active</label>
                                                            </div>

                                                            <div class="custom-control custom-radio col-md-6">
                                                                <input class="custom-control-input" type="radio" id="customRadio2" name="activation" value="0"  <?php
                                                                if (isset($current_data)) {
                                                                    if ($current_data["activation"] == 0) {
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
                                                            <textarea class="form-control" rows="10" id="description" name="description"><?php
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
</div>
<?php include "./templates/footer.php"; ?>
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
                window.location.href = "product_list.php";
            }
        } else {
            window.location.href = "product_list.php";
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
        document.getElementById("release_date").readOnly = false;
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
        if(document.getElementById("btnsave").textContent === "Save" ){
            document.getElementById ("form").submit();
        }else{
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

