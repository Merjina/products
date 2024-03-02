<?php 
   session_start();
   include 'config.php';
   if(isset($_POST["add"])){
    if(isset($_SESSION["shopping_cart"])){
      $item_array_id=array_column($_SESSION["shopping_cart"],"productid");
      if(!in_array($_GET["id"],$item_array_id)){
        $count=count($_SESSION["shopping_cart"]);
        $item_array=array(
          'id'=>$_GET["id"],
          'name'=>$_POST["name"],
          'price'=>$_POST["price"],
          'img'=>$_POST["img"],
          'quantity'=>$_POST["quantity"],
        );
        $_SESSION["shopping_cart"][$count]=$item_array;
        echo '<script>alert("Product added to cart");</script>';
       
      }
    }else{
      $item_array=array(
        'id'=>$_GET["id"],
        'name'=>$_POST["name"],
        'price'=>$_POST["price"],
        'img'=>$_POST["img"],
        'quantity'=>$_POST["quantity"],
      );
      $_SESSION["shopping_cart"][0]=$item_array;
      echo '<script>alert("Product added to cart");</script>';
   

    }
   }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body style="background-color:lavender">
<?php 
   include 'header.php';
?>
   <div class="container p-3"style="background-color:gray">
    <div class="row">
    <?php
    $query = "SELECT * FROM product";
    $result=mysqli_query($conn,$query);
    if(mysqli_num_rows($result) > 0){
      while ($row = mysqli_fetch_assoc($result)) {
   ?>
        <div class="col-lg-3">
            <form action="index.php?action=add&id=<?php echo $row["id"];?>" method="post">
                <div class="card" style="height:320px">
                    <img src="../img/<?php echo $row['img']; ?>" width="258" height="150">
                    <div class="card-body text-center">
                        <h5 class="card-title"><?php echo $row['name']; ?></h5>
                        <p class="card-text">Rs.<?php echo $row['price']; ?></p>
                        <input type="text" id="quantity" name="quantity"style="width:30px;height:35px" value="1">
                        <input type="hidden" name="name" value="<?php echo $row["name"]; ?>">
                        <input type="hidden" name="price" value="<?php echo $row["price"]; ?>">
                        <input type="hidden" name="img" value="<?php echo $row["img"]; ?>">
                        <input type="submit" class="btn btn-primary btn-sm p-2 mt-1 mb-2"  value="add to card "name="add"></button>
                    </div>
                </div>
            </form>
        </div>
        
        <?php
      }
    }
    ?>
    </div>
  </div>
</body>
</html>