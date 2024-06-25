
<?php

require_once('function.php');
 
 
 
 if(isset($_POST['submit'])) {
  
  if(updateproduct($_POST) == true){
header("Location: productcrud.php"); 
exit();
} 

  

 }

 if(isset($_GET['productid'])){  
  $productid = $_GET['productid'];
  $row = getproduct($productid);
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="homes.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css" /> 
</head>
<body>
<nav>
        <div class="navimg">
        <a href="homes.php"><img src="img/LLC.png" alt="llc"></a>
            </div>
                <div class="nav-cont">
                  <div class="navitem1">
                    <a href="#">formulieren</a>
                      <div class="navitem1-sub">
                          <a href="klacht.php">klachten</a>
                          <a href="comp.php">compliment</a>
                          <a href="">info</a>
                          </div>
                            </div>
                              <div class="navitem2">
                                <a href="product.php">producten</a>
                              <div class="navitem2-sub">
                                <a href="klant.php">klantcrud</a>
                                <a href="productcrud.php">productcrud</a>
                                <a href="bestelling.php">bestelcrud</a>
                            </div>
                          </div>
                        <div class="navitem3">   
                      <a href="#">over ons</a>
                    <div class="navitem3-sub">
                    <a href="levering.php">levering</a>
                  <a href="mil.php">milieu </a>
                  <a href="levering.php"> team</a>
                </div>
              </div>
            </div>
          </div>
        </nav>

        <div class="titel-table">product wijzigen</div>

   <form action="" method="post" >

   <input type="hidden" id="naam" name="productid" required value="<?php echo $row['productid']; ?>"><br>

    <label class="naam" for="naam">naam
    <input type="text" name="naam" required value="<?php echo $row['naam']; ?>" >
    </label>

    <label class="merk" for="merk">merk
    <input required type="text" name="merk" required value="<?php echo $row['merk']; ?>">
    </label>
    <br>

    <label class="prijs" for="prijs">prijs
    <input required  type="text" name="prijs" required value="<?php echo $row['prijs']; ?>">
    </label>
    <br>
    

    <label class="submit" for="submit">
      <input type="submit" name="submit" value="Wijzig">
    </label>
 </form>

 <?php
    } else {
        "Geen klantid opgegeven<br>";
    }
?>




    
  
  
  
  
  
  <footer>
    <div class="footeritem1">
      <p>
        contact
      </p>
      <p>
        tel: 0657483453
       </p>
       <p>
        email: LLC@gmail.com
       </p>
    </div>
    <div class="footeritem2">
      <p>
        locatie
      </p>
      <p>
        stad:almere
      </p>
      <p>
      straat:Randstad 21 nummer 77
      </p>
      <p>
        <a target="_blank" href="https://www.google.com/maps/place/Randstad+21+77,+1314+BJ+Almere/@52.3772265,5.2216661,
        17z/data=!3m1!4b1!4m6!3m5!1s0x47c6171c30a5f0bf:0xae8845b536033d5d!8m2!3d52.3772233!4d5.224241!16s%2Fg
      %2F11bw3yy7wd?entry=ttu" class="google-maps">google maps</a>
    </p>
    </div>
  </footer>
 
</body>
</html>