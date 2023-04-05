<div class="info">
        <h4>INFORMATIONS LEGALES</h4>
            <a href="">Nous contacter</a>
            <a href="">Mentions légales</a>
            <a href="">Conditions générales de vente</a>
</div>
    <div class="contact">
        <h4>CONTACT</h4>
        <ul>
            <li>Société E-gaming</li>
            <li>ZAC la valentine</li>
            <li>13011 MARSEILLE</li>
            <li>Tél: 04.04.04.04.04</li>
        </ul>
    </div>
    <?php
         if(isset($_GET['mode']) && $_GET['mode'] == 'index'){
    ?>
    <div class="paiement">
        <h4 >PAIEMENTS</h4>
        <img src="./asset/img/CB-1.jpg" width="19%" alt="image carte bleue">
        <br>
        <img src="./asset/img/Paypal_2007_logo.svg_-1.png"  width="19%" alt="image de paypal">       
    </div>
    <div class="livraison">
        <h4>LIVRAISONS</h4>
        <img src="./asset/img/colissimo.png" width="19%"  alt="logo colissimo">
        <img src="./asset/img/dpd.png" width="19%" alt="logo dpd">       
    </div>
    <?php
         }else{
            if(isset($_GET['mode']) && $_GET['mode'] != 'index'){
     ?>        
            <div class="paiement">
            <h4 >PAIEMENTS</h4>
            <img src="../asset/img/CB-1.jpg" width="19%" alt="image carte bleue">
            <br>
            <img src="../asset/img/Paypal_2007_logo.svg_-1.png"  width="19%" alt="image de paypal">       
        </div>
        <div class="livraison">
            <h4>LIVRAISONS</h4>
            <img src="../asset/img/colissimo.png" width="19%"  alt="logo colissimo">
            <img src="../asset/img/dpd.png" width="19%" alt="logo dpd">
        
        </div>
    <?php
         }
        }
   ?>
   
