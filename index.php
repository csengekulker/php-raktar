<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="index.css">

    <title>CRUD Electronics</title>
</head>
<body>
    <?php include_once('process.php'); 

    // if session message has been sent

    if (isset($_SESSION['message'])) {

        echo '<div role="alert" class="alert alert-'.$_SESSION['msg_type'].'">';
        echo $_SESSION['message'];
        unset($_SESSION['message']);
        // unset($_SESSION['msg_type']);
        echo '</div>';
    }
    
    $conn = mysqli_connect('localhost', 'root', '', 'raktar') or die("Hiba a csatlakozás során!");

    $sql = "SELECT * FROM products;";

    $result = mysqli_query($conn, $sql);

    ?>
    <div class="container-fluid p-2">

    <div class="row justify-content-center">
        <h1>CRUD Electronics</h1>
    </div>

    <!-- <div class="row mb-3 w-100">
        <div class="col">
            <input class="form-control me-1 col" type="search" id="searchInput" placeholder="Nem mukodik" aria-label="Search">
        </div>
        <button class="btn btn-outline-success col-2">Search</button>
    </div> -->

    <!-- HTML TABLE -->
    <div class="row">

    <div class="col-8">

        <table id="table" class="table table-responsive table-striped bg-light rounded">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Product name</th>
                    <th>Supplier</th>
                    <th>Price ($)</th>
                </tr>
            </thead>

    <?php

    while ($row = mysqli_fetch_assoc($result)) { 

        echo '<tr>';
        echo '<td>'.$row['Id'].'</td>';
        echo '<td>'.$row['Product'].'</td>';
        echo '<td>'.$row['Supplier'].'</td>';
        echo '<td>'.$row['Price'].'</td>';
        echo '<td><a class="btn btn-secondary me-2" href="index.php?edit='.$row['Id'].'">Edit';
        echo '<a class="btn btn-danger" href="process.php?delete='.$row['Id'].'">Delete</td>';
        echo '</tr>';
    }

    ?>
    </table>
    </div>


    <!-- HTML FORM -->

    <?php 

        if ($update == true) {
            echo '<div
            id="editForm"
            class="
                col-4 h-100 rounded p-3 
            ">';
            echo '<h3>Edit existing product</h3>
                ';
        } else {
            echo '<div
            id="addForm"
            class="
                col-4 h-100 rounded p-3
            ">';
            echo '<h3>Add new product</h3>
            ';
        }

    ?>

        <form action="" method="POST">
        <div class="form-group">
                <input type="hidden" name="id" value="<?php echo $id;?>">
                <label for="">Name</label>
                <input 
                    type="text" 
                    class="form-control" 
                    name="name" 
                    value="<?php echo $product?>">
        </div>
        <div class="form-group">
                <label for="">Supplier</label>
                <input 
                    type="text"
                    class="form-control"
                    name="supplier"
                    value="<?php echo $supplier?>">
        </div>
        <div class="form-group mb-3">
                <label for="">Price</label>
                <input 
                    type="number"
                    class="form-control"
                    name="price"
                    value="<?php echo $price?>">
        </div>
        <div class="form-group">
            <?php  
                if ($update == true) {
                    echo '<button class="btn btn-secondary w-100" type="submit" name="update">Update record</button>';
                } else {
                    echo '<button class="btn btn-primary w-100" type="submit" name="save">Submit record</button>';
                }
            ?>
    </div>
    </form>
    </div>
    </div>


</body>
</html>