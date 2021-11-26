<?php if ($_settings->chk_flashdata('success')): ?>
    <script>
        alert_toast("<?php echo $_settings->flashdata('success') ?>", 'success')
    </script>
<?php endif; ?>
    <?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM catalog WHERE id = '$id' LIMIT 1";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $current_data = $row;
            echo '<script>var current_data = ' . json_encode($current_data) . ';</script>';
            break;
        }
    } else {
        echo '<script>alert("Extract data error !\nContact IT department to maintainence");window.location.href = "category_list.php";</script>';
    }
} else {
    echo '<script>var current_data = null;</script>';
    
    $sql = "SELECT id FROM catalog ORDER BY id DESC LIMIT 1";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = mysqli_fetch_array($result)) {
             $latestnum = ((int) substr($row['id'], 1)) + 1;
            if ($latestnum < 10) {
                $newid = "1000{$latestnum}";
            } else if ($latestnum < 100) {
                $newid = "100{$latestnum}";
            } else if ($latestnum < 1000) {
                $newid = "10{$latestnum}";
            } else if ($latestnum < 1000) {
                $newid = "1{$latestnum}";
            } 
            break;
        }
    }
}


//Update existing product
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST["action"] == "delete") {
        $sql = "DELETE FROM category WHERE id=" . $current_data["id"];
        if ($conn->query($sql)) {
            $sql = "UPDATE product"
                    . " SET category='" . null . "'"
                    . "WHERE category ='" . $current_data["name"] . "'";
            $conn->query($sql);
            if ($conn->query($sql)) {
                echo '<script>alert("Successfuly delete !");window.location.href = "category_list.php";</script>';
            } else {
                echo '<script>alert("Delete successfully but update product have fail !\nContact IT department to maintainence");window.location.href = "category_list.php";</script>';
            }
        } else {
            echo '<script>alert("Delete fail!\nContact IT department for maintainence")</script>';
        }
    } else if ($_POST["action"] == "update") {
        $sql = "UPDATE category"
                . " SET name='" . $_POST["name"] . "'"
                . "WHERE id ='" . $current_data["id"] . "'";
        if ($conn->query($sql)) {
            $sql = "UPDATE product"
                    . " SET category='" . $_POST["name"] . "'"
                    . "WHERE category ='" . $current_data["name"] . "'";
            if ($conn->query($sql)) {
                echo '<script>alert("Successfuly update !");var currentURL = window.location.href;window.location.href = currentURL;</script>';
            } else {
                echo '<script>alert("Update successfully but update product have fail !\nContact IT department to maintainence");window.location.href = "category_list.php";</script>';
            }
        } else {
            echo '<script>alert("Update fail!\nContact IT department for maintainence")</script>';
        }
    } else {
        $sql = "INSERT INTO category(id, name) VALUES ("
                . "'" . $newid . "',"
                . "'" . $_POST['name'] . "')";

        if ($conn->query($sql)) {
            echo '<script>alert("Successfuly insert !");window.location.href = "category_list.php";</script>';
        } else {
            echo '<script>alert("Insert fail!\nContact IT department for maintainence")</script>';
        }
    }
}
?>

<div class="card card-outline card-primary">
	<div class="card-header">
		<h3 class="card-title">Category ID : <?php
                                        if (isset($current_data)) {
                                            echo $current_data["catalog_ID"];
                                        } else {
                                            echo "(New)" . $newid;
                                        }
                                        ?></h3>
            <br>
            <h4 class="card-title">Category Name : <?php
                                        if (isset($current_data)) {
                                            echo $current_data["description"];
                                        } else {
                                            echo "(New)" . $newid;
                                        }
                                        ?></h4>
		
	</div>
	<div class="col-md-12">
                            <div class="card card-dark">

                                <div class="card-header">
                                    <h3 class="card-title" id="titleid">Product that related to this category</h3>
                                </div>

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table id="producttable" class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 10%">
                                                            Product Id / Code
                                                        </th>
                                                        <th style="width: 35%">
                                                            Name
                                                        </th>
                                                        <th style="width: 10%">
                                                            Category
                                                        </th>
                                                        
                                                        <th style="width: 10%">
                                                            Price(RM)
                                                        </th>
                                                        <th style="width: 10%">
                                                            Activation
                                                        </th>
                                                        <th style="width: 10%">

                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    if (isset($current_data)) {
                                                        $sql = "SELECT * FROM inventory WHERE catalog_ID = '" . $current_data["id"] . "'";
                                                        $result = $conn->query($sql);
                                                        if ($result->num_rows > 0) {
                                                            while ($row = $result->fetch_assoc()) {
                                                                if ($row["status"] == true) {
                                                                    $active = 1;
                                                                    $color = "green";
                                                                } else {
                                                                    $active = 0;
                                                                    $color = "red";
                                                                }
                                                                echo "<tr><td><a>" . $row["item_code"] . "</a></td>"
                                                                . "<td><a>" . $row["name"] . "</a></td>"
                                                                . "<td><a>" . $row["catalog_ID"] . "</a></td>"
                                                                . "<td><a>" . $row["price"] . "</a></td>"
                                                                . "<td><a value =" . $row["status"] . "  style=" . "'color:" . $color . "'" . ">" . $active . "</a></td>"
                                                                . "<td class='project-actions text-right'>"
                                                                . "<a class=" . "'btn btn-dark btn-sm'" . "href=" . "'?page=category/product_detail&id=" . $row["id"] . "'>"
                                                                . "</i> View Details</a></td></tr>";
                                                            }
                                                        }
                                                    }
                                                    ?>
                                                </tbody>
                                                
                                            </table>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
</div>

<script>
    $('#producttable').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true
    });

    function loadform() {
        var params = new window.URLSearchParams(window.location.search);
        if (!params.get('id')) {
            document.getElementById('btndelete').disabled = true;
        }
    }

    function submitForm(action) {
        if (action === "delete") {
            if (confirm("Confirm to delete ?\n All product related to this category will be update the category to null !")) {
                document.getElementById('action').value = "delete";
                document.getElementById("form").submit();
            }
        } else {
            if (current_data) {
                if (confirm("Confirm to Save ?\n All product related to this category will be update the category to current category !")) {
                    document.getElementById('action').value = "update";
                    document.getElementById("form").submit();
                }
            } else {
                if (confirm("Confirm to insert ?")) {
                    document.getElementById('action').value = "add";
                    document.getElementById("form").submit();
                }
            }

        }
    }
</script>

