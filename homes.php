<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: loginpage.php');
    exit;
}

$username = $_SESSION['username'];
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
                  <a href="team.php"> team</a>
                </div>
              </div>
            <div class="navitem4">
            <p>Welcome, <?php echo htmlspecialchars($username); ?>!</p>
            <div class="navitem4-sub">
            <a href="logout.php">Logout</a>
          </div>
          </div>
        </div>
      </div>
    </nav>

    <div class="titel-home">ons bedrijf llc</div>
  
  <img class="LLC-gebouw" src="img/gebouw-llc.png" alt="llc">

  <div class="home-text">
      Bent u op zoek naar een geavanceerde oplossing om uw zakelijke of persoonlijke behoeften te verbeteren? 
      Zoek niet verder dan onze ultramoderne laserlampen en pennencollectie! Onze producten van topkwaliteit zijn ontworpen om u precisie, 
      efficiëntie en stijl te bieden. Of u nu een professionele kunstenaar, 
      een hobbyist of gewoon iemand bent die de kracht van lasers waardeert, 
      onze laserlampen en pennen tillen uw werk naar een hoger niveau.
      Onze laserlampen hebben een strak ontwerp en intuïtieve bediening, 
      waardoor u eenvoudig ingewikkelde ontwerpen en patronen kunt creëren. 
      De instelbare focusfunctie zorgt ervoor dat u het perfecte detailniveau kunt bereiken, 
      of u nu aan een klein project of aan een volledige muurschildering werkt. 
      En met een verscheidenheid aan kleuren om uit te kiezen, kunt u een vleugje persoonlijkheid toevoegen aan elk oppervlak.
      Onze laserpennen zijn daarentegen perfect voor degenen die waarde hechten aan draagbaarheid en discretie. 
      Dankzij het compacte ontwerp kun je ze gemakkelijk overal mee naartoe nemen, en dankzij de krachtige laserstraal kun je op vrijwel elk oppervlak prachtige ontwerpen maken.
      Bovendien kunt u, dankzij de vele beschikbare kleuren en patronen, uw pen aanpassen aan uw persoonlijke stijl.
      Dus waarom wachten? Investeer vandaag nog in uzelf en uw creativiteit door onze eersteklas laserlamp of pen aan te schaffen. 
      U zult niet alleen versteld staan van de resultaten, maar u ondersteunt ook een bedrijf dat zich toelegt op het leveren van producten van de hoogste kwaliteit en een uitzonderlijke klantenservice. 
      Shop nu en ervaar zelf de kracht van lasers!
  </div>
    
  
  
  
  
  
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