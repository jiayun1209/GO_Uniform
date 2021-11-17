if ($_SERVER["REQUEST_METHOD"] == "POST") {
   

    $sql = "INSERT INTO inventory(id, item_code, name, description, quantity, price, status, date_created, catalog_ID)VALUES("
            . "'" . $newid . "',"
            . "'" . $_POST['item_code'] . "',"
            . "'" . $_POST['name'] . "',"
            . "'" . $_POST['description'] . "',"
            . "'" . $_POST['quantity'] . "',"
            . "'" . $_POST['price'] . "',"
             . "'" . $_POST['status'] . "',"
            . "'" . $_POST['date_created'] . "',"
            . "'" . $_POST['catalog_ID'])";
    
    echo '<script>alert("' . $sql . '");</script>';

    if ($dbc->query($sql)) {

        echo '<script>alert("Successfuly insert !");window.location.href = "contact.php?id=' . $_POST['id'] . '";</script>';
    } else {
        echo '<script>alert("Insert fail !\n")</script>';
    }
}
?>

