<?php
require_once('config.php');
$Array_account = array();
$sql = "SELECT * FROM vendor";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = mysqli_fetch_array($result)) {
        array_push($Array_account, $row);
    }
}
echo '<script>var Array_account = ' . json_encode($Array_account) . ';</script>';
?>

<div class="form-group">
    <label>Employee ID</label>
    <select class="form-control" name="eid" id="eid" onchange="select_id_check_name()" onclick="select_id_check_name()">
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
<div class="form-group">
    <label>Employee Name</label>
    <input type="text" class="form-control" name="ename" id="ename" placeholder="" readOnly/>
</div>
</div>

<script>
    function select_id_check_name() {
        var i = 0;
        while (Array_account) {
            if (Array_account[i][0] === document.getElementById("eid").value) {
                document.getElementById("ename").value = Array_account[i][1].toString();
            }
            i++;
        }
    }
</script>

