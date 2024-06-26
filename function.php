<?php
include_once "config.php";

 function connectDatab(){
    $servername = SERVERNAME;
    $username = USERNAME;
    $password = PASSWORD;
    $dbname = DATABASE;
   
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $conn;
        
    }
    
    catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }

 }

 function getData($table){
  // Connect database
  $conn = connectDatab();

  // Select data uit de opgegeven table methode query
  // query: is een prepare en execute in 1 zonder placeholders
  // $result = $conn->query("SELECT * FROM $table")->fetchAll();

  // Select data uit de opgegeven table methode prepare
  $sql = "SELECT * FROM $table";
  $query = $conn->prepare($sql);
  $query->execute();
  $result = $query->fetchAll();

  return $result;
}

function getKlant($klantid){

    $conn = connectDatab();
    $sql = "SELECT * FROM " . CRUD_TABLE . " WHERE klantid = :klantid";
    $query = $conn->prepare($sql);
    $query->execute([':klantid'=>$klantid]);
    $result = $query->fetch();

    return $result;
 }

 function getproduct($productid){

    $conn = connectDatab();
    $sql = "SELECT * FROM " . CRUD_TABLE2 . " WHERE productid = :productid";
    $query = $conn->prepare($sql);
    $query->execute([':productid'=>$productid]);
    $result = $query->fetch();

    return $result;
 }





function addtable($result){
  $headers = array_keys($result[0]);
    $table .= "<tr>";
    foreach($headers as $header){
        $table .= "<th>" . $header . "</th>";   
    }

    // print elke rij van de tabel
    foreach ($result as $row) {
        
        $table .= "<tr>";
        // print elke kolom
        foreach ($row as $cell) {
            $table .= "<td>" . $cell . "</td>";
        }
        $table .= "</tr>";
    }
    $table.= "</table>";

    echo $table;
 

}

function crud(){

  // Menu-item   insert
  $txt = "
 
  <a href='insertklant.php'>Toevoegen nieuwe klant</a>
  ";
  echo $txt;

  // Haal alle  record uit de tabel 
  $result = getData(CRUD_TABLE);
  
            

  //print table
  filterklant($result);
  
  
}

function deleteklant($id){

    // Connect database
    $conn = connectDatab();
    
    // Maak een query 
    $sql = "
    DELETE FROM " . CRUD_TABLE . 
    " WHERE klantid = :klantid";
    
    ;

    // Prepare query
    $stmt = $conn->prepare($sql);

    // Uitvoeren
    $stmt->execute([
    ':klantid'=>$_GET['klantid' ]
    ]);

    // test of database actie is gelukt
    $retVal = ($stmt->rowCount() == 1) ? true : false ;
    return $retVal;
}

function updateKlant($row){

    $conn = connectDatab();
    $sql = "UPDATE " . CRUD_TABLE .
    " SET 
    voornaam = :voornaam, 
    achternaam = :achternaam, 
    adres = :adres, 
    plaats = :plaats
    WHERE klantid = :klantid
";

    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':voornaam'=>$row['voornaam'],
        ':achternaam'=>$row['achternaam'],
        ':adres'=>$row['adres'],
        ':plaats'=>$row['plaats'],
        ':klantid'=>$row['klantid'] 
    ]);

    $retVal = ($stmt->rowCount() == 1) ? true : false ;
    return $retVal;
}

function insertklant($post){
    // Maak database connectie
    $conn = connectDatab();

    // Maak een query 
    $sql = "
        INSERT INTO " . CRUD_TABLE . " (voornaam, achternaam, adres, plaats )
        VALUES (:voornaam, :achternaam, :adres, :plaats ) 
    ";

    // Prepare query
    $stmt = $conn->prepare($sql);
    // Uitvoeren
    $stmt->execute([
        ':voornaam'=>$_POST['voornaam'],
        ':achternaam'=>$_POST['achternaam'],
        ':adres'=>$_POST['adres'],
        ':plaats'=>$_POST['plaats']
        
    ]);

    
    // test of database actie is gelukt
    $retVal = ($stmt->rowCount() == 1) ? true : false ;
    return $retVal;  
}

function filterklant(){
    if (isset($_POST["selectKlantName"]))
    {
    $selector = "%" . $_POST["klantName"] . "%";
    }
    else
    {
    $selector = "%%";
    };

    $conn = connectDatab();
    $qrySelectKlant = $conn->prepare("SELECT klantid, voornaam, achternaam, adres, plaats  FROM klanten
                                     WHERE voornaam LIKE :selector OR achternaam LIKE :selector 
                                     OR adres LIKE :selector OR plaats LIKE :selector");
    $qrySelectKlant->bindValue("selector", $selector);
    $qrySelectKlant->execute();
    $selectedKlant = $qrySelectKlant->fetchAll(PDO::FETCH_ASSOC);

    printCrudklant($selectedKlant);
}

function crud2(){
    $txt = "
 
  <a href='insertproduct.php'>Toevoegen nieuw product</a>
  ";
  echo $txt;

  


  // Haal alle  record uit de tabel 
  
  $result2 = getData(CRUD_TABLE2);
  
            

  //print table
  filterproduct($result2);
  
  
}

function updateproduct($row){

    $conn = connectDatab();
    $sql = "UPDATE " . CRUD_TABLE2 .
    " SET 
    naam = :naam, 
    merk = :merk, 
    prijs = :prijs
    
    WHERE productid = :productid
";

    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':naam'=>$row['naam'],
        ':merk'=>$row['merk'],
        ':prijs'=>$row['prijs'],
        ':productid'=>$row['productid'] 
    ]);

    $retVal = ($stmt->rowCount() == 1) ? true : false ;
    return $retVal;
}
function deleteproduct($id){

    // Connect database
    $conn = connectDatab();
    
    // Maak een query 
    $sql = "
    DELETE FROM " . CRUD_TABLE2 . 
    " WHERE productid = :productid";
    
    ;

    // Prepare query
    $stmt = $conn->prepare($sql);

    // Uitvoeren
    $stmt->execute([
    ':productid'=>$_GET['productid' ]
    ]);

    // test of database actie is gelukt
    $retVal = ($stmt->rowCount() == 1) ? true : false ;
    return $retVal;
}

function insertproduct($post){
    // Maak database connectie
    $conn = connectDatab();

    // Maak een query 
    $sql = "
        INSERT INTO " . CRUD_TABLE2 . " (naam, merk, prijs  )
        VALUES (:naam, :merk, :prijs  ) 
    ";

    // Prepare query
    $stmt = $conn->prepare($sql);
    // Uitvoeren
    $stmt->execute([
        ':naam'=>$_POST['naam'],
        ':merk'=>$_POST['merk'],
        ':prijs'=>$_POST['prijs']
        
        
    ]);

    
    // test of database actie is gelukt
    $retVal = ($stmt->rowCount() == 1) ? true : false ;
    return $retVal;  
}

function filterproduct(){
            if (isset($_POST["selectProductName"]))
        {
            $selector = "%" . $_POST["productName"] . "%";
        }
        else
        {
            $selector = "%%";
        };


        $conn = connectDatab();
        $qrySelectProducts = $conn->prepare("SELECT productid, naam, merk FROM producten WHERE naam LIKE :selector OR merk LIKE :selector");
        $qrySelectProducts->bindValue("selector", $selector);
        $qrySelectProducts->execute();
        $selectedProducts = $qrySelectProducts->fetchAll(PDO::FETCH_ASSOC);

        printCrudproducten($selectedProducts);
}

function crud3(){
  // Haal alle  record uit de tabel 
  $result3 = getData(CRUD_TABLE3);
            

  //print table
  filterbestelling($result3);
}

function filterbestelling(){
    if (isset($_POST["selectBestellingName"]))
    {
    $selector = "%" . $_POST["bestellingName"] . "%";
    }
    else
    {
    $selector = "%%";
    };


    $conn = connectDatab();
    $qrySelectBestelling = $conn->prepare("SELECT bestelid, klantid, productid, aantal, datum FROM bestellingen WHERE bestelid LIKE :selector OR klantid LIKE :selector");
    $qrySelectBestelling->bindValue("selector", $selector);
    $qrySelectBestelling->execute();
    $selectedBestelling = $qrySelectBestelling->fetchAll(PDO::FETCH_ASSOC);

    printCrudbestellingen($selectedBestelling);
}

function printCrudklant($result){
  // Zet de hele table in een variable en print hem 1 keer 
  $table = "<table>";

  // Print header table

  // haal de kolommen uit de eerste rij [0] van het array $result mbv array_keys
  $headers = array_keys($result[0]);
  $table .= "<tr>";
  foreach($headers as $header){
      $table .= "<th>" . $header . "</th>";   
  }
  // Voeg actie kopregel toe
  $table .= "<th colspan=2>Actie</th>";
  $table .= "</th>";

  // print elke rij
  foreach ($result as $row) {
      
      $table .= "<tr>";
      // print elke kolom
      foreach ($row as $cell) {
          $table .= "<td>" . $cell . "</td>";  
      }
      
      // Wijzig knopje
      $table .= "<td>
          <form class='wzg-btn' method='post' action='updateklant.php?klantid=$row[klantid]' >       
              <button>Wijzig</button>	 
          </form></td>";

      // Delete knopje
      $table .= "<td>
          <form class='del-btn' method='post' action='deleteklant.php?klantid=$row[klantid]' >       
              <button>Verwijder</button>	 
          </form></td>";

      $table .= "</tr>";
  }
  $table.= "</table>";

  echo $table;
}

function printCrudproducten($result2){
  // Zet de hele table in een variable en print hem 1 keer 
  $table = "<table>";

  // Print header table

  // haal de kolommen uit de eerste rij [0] van het array $result mbv array_keys
  $headers = array_keys($result2[0]);
  $table .= "<tr>";
  foreach($headers as $header){
      $table .= "<th>" . $header . "</th>";   
  }
  // Voeg actie kopregel toe
  $table .= "<th colspan=2>Actie</th>";
  $table .= "</th>";

  // print elke rij
  foreach ($result2 as $row) {
      
      $table .= "<tr>";
      // print elke kolom
      foreach ($row as $cell) {
          $table .= "<td>" . $cell . "</td>";  
      }
      
      // Wijzig knopje
      $table .= "<td>
          <form class='wzg-btn' method='post' action='updateproduct.php?productid=$row[productid]' >       
              <button>Wijzig</button>	 
          </form></td>";

      // Delete knopje
      $table .= "<td>
          <form class='del-btn' method='post' action='deleteproduct.php?productid=$row[productid]' >       
              <button>Verwijder</button>	 
          </form></td>";

      $table .= "</tr>";
  }
  $table.= "</table>";

  echo $table;
}

function printCrudbestellingen($result3){
  // Zet de hele table in een variable en print hem 1 keer 
  $table = "<table>";

  // Print header table

  // haal de kolommen uit de eerste rij [0] van het array $result mbv array_keys
  $headers = array_keys($result3[0]);
  $table .= "<tr>";
  foreach($headers as $header){
      $table .= "<th>" . $header . "</th>";   
  }
 

  // print elke rij
  foreach ($result3 as $row) {
      
      $table .= "<tr>";
      // print elke kolom
      foreach ($row as $cell) {
          $table .= "<td>" . $cell . "</td>";  
      }
      
     

      $table .= "</tr>";
  }
  $table.= "</table>";

  echo $table;
}

function crud4(){
    // Haal alle  record uit de tabel 
    $result4 = getData(CRUD_TABLE4);
              
  
    //print table
    printCrudbericht($result4);
    
  }

function printCrudbericht($result4) {
    // Zet de hele table in een variable en print hem 1 keer 
  $table = "<table>";

  // Print header table

  // haal de kolommen uit de eerste rij [0] van het array $result mbv array_keys
  $headers = array_keys($result4[0]);
  $table .= "<tr>";
  foreach($headers as $header){
      $table .= "<th>" . $header . "</th>";   
  }
 

  // print elke rij
  foreach ($result4 as $row) {
      
      $table .= "<tr>";
      // print elke kolom
      foreach ($row as $cell) {
          $table .= "<td>" . $cell . "</td>";  
      }
      
     

      $table .= "</tr>";
  }
  $table.= "</table>";

  echo $table;
}

function insertbericht($post){
    // Maak database connectie
    $conn = connectDatab();

    // Maak een query 
    $sql = "
        INSERT INTO " . CRUD_TABLE4 . " (voornaam, leeftijd, geslacht, bericht  )
        VALUES (:voornaam, :leeftijd, :geslacht, :bericht  ) 
    ";

    // Prepare query
    $stmt = $conn->prepare($sql);
    // Uitvoeren
    $stmt->execute([
        ':voornaam'=>$_POST['voornaam'],
        ':leeftijd'=>$_POST['leeftijd'],
        ':geslacht'=>$_POST['geslacht'],
        ':bericht'=>$_POST['bericht']
        
        
    ]);

    
    // test of database actie is gelukt
    $retVal = ($stmt->rowCount() == 1) ? true : false ;
    return $retVal;  
}



  

