<?php

session_start();

$id = 0;
$product = "";
$supplier = "";
$price = null;

$update = false;

$conn = mysqli_connect('localhost', 'root', '', 'raktar') or die("Hiba a csatlakozás során!");

// check if save button has been pressed
// CREATE

if (isset($_POST['save'])) {
    $name = $_POST['name'];
    $supplier = $_POST['supplier'];
    $price = $_POST['price'];

    $sql = "INSERT INTO products (Product, Supplier, Price) VALUES ('$name', '$supplier', '$price');";

    mysqli_query($conn, $sql);

    $_SESSION['message'] = "Record has been saved successfully";
    $_SESSION['msg_type'] = "success";

}

// if edit button has been pressed
// UPDATE

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];

    $update = true;

    $sql = "SELECT * FROM products WHERE Id=$id;";

    $result = mysqli_query($conn, $sql);

    if ($result) { // EXISTS
        $row = mysqli_fetch_array($result);

        $product = $row['Product'];
        $supplier = $row['Supplier'];
        $price = $row['Price'];
    }

}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $supplier = $_POST['supplier'];
    $price = $_POST['price'];

    $sql = "UPDATE products SET Product='$name', Supplier='$supplier', Price='$price' WHERE Id=$id;";

    mysqli_query($conn, $sql);

    $_SESSION['message'] = "Record has been updated successfully";
    $_SESSION['msg_type'] = "success";    

    header("Location: index.php");

}

//if delete button has been pressed
// DELETE

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $sql = "DELETE FROM products WHERE Id=$id;";

    mysqli_query($conn, $sql);

    $_SESSION['message'] = "Record has been deleted successfully";
    $_SESSION['msg_type'] = "danger";

    header("Location: index.php");
}

mysqli_close($conn);

?>
