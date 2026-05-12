<?php include "partiel/entete.php";
?>
<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, Helvetica, sans-serif;
}

body {
    background: #f5f5f5;
}

.hero {
    width: 100%;
    min-height: 100vh;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 80px 10%;
    gap: 50px;
}

/* LEFT */

.hero-left {
    flex: 1;
}

.hero-left h1 {
    font-size: 78px;
    line-height: 1.1;
    font-weight: 900;
    color: #000;
    margin-bottom: 40px;
}

.hero-left p {
    font-size: 22px;
    line-height: 1.7;
    color: #666;
    max-width: 700px;
    margin-bottom: 40px;
}

.hero-left button {
    padding: 18px 35px;
    border: 2px solid #000;
    border-color: #000;
    background: #fff;
    color: black;
    font-size: 24px;
    border-radius: 12px;
    cursor: pointer;
    transition: 0.3s;
    font-weight: bold;
}

.hero-left button:hover {
    transform: translateY(-5px);
    background: #e6b000;
}

.hero_2 {
    width: 100%;
    min-height: 30vh;
    justify-content: space-between;
    align-items: center;
    padding: 80px 10%;
    gap: 50px;
    background: #ffaa00;
    text-align: center;
}

.hero_3 {
    width: 100%;
    min-height: 30vh;
    padding: 80px 10%;
    gap: 50px;
    background: #fff;
    align-content: center;
    text-align: center;
}

.hero_7 {
    width: 100%;
    min-height: 30vh;
    padding: 80px 10%;
    gap: 50px;
    background: #fff;
    align-content: center;
    text-align: center;
}


.container {
    min-height: 30vh;
    padding: 50px 10%;
    display: flex;
    justify-content: center;
    gap: 10px;
    flex-wrap: wrap;
}

.box {
    width: 350px;
    background: white;
    padding: 20px;
    border-radius: 15px;
    box-shadow: 0 15px 15px rgba(0, 0, 0, 0.08);
}

.box h2 {
    margin-bottom: 15px;
    font-size: 28px;
    text-align: center;
}

.box p {
    color: #666;
    line-height: 1.7;
    font-size: 18px;
    text-align: center;
}

.hero_6 button {
    padding: 18px 35px;
    border: 2px solid #000;
    border-color: #000;
    background: #fff;
    color: black;
    font-size: 24px;
    border-radius: 12px;
    cursor: pointer;
    transition: 0.3s;
    font-weight: bold;
}

.hero_6 button:hover {
    transform: translateY(-5px);
    background: #e6b000;
}


footer {
    background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab);
    background-size: 400% 400%;
    animation: gradientBG 15s ease infinite;
    padding: 60px 10%;
    color: white;
    margin-top: 50px;
}

@keyframes gradientBG {
    0% {
        background-position: 0% 50%;
    }

    50% {
        background-position: 100% 50%;
    }

    100% {
        background-position: 0% 50%;
    }
}

.footer-container {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 40px;
}

.footer-col h3 {
    font-size: 24px;
    margin-bottom: 20px;
    border-bottom: 2px solid rgba(255, 255, 255, 0.3);
    padding-bottom: 10px;
    display: inline-block;
}

.footer-col ul {
    list-style: none;
    padding: 0;
}

.footer-col ul li {
    margin-bottom: 12px;
}

.footer-col ul li a {
    color: white;
    text-decoration: none;
    transition: 0.3s;
}

.footer-col ul li a:hover {
    padding-left: 10px;
    opacity: 0.8;
}

.footer-bottom {
    text-align: center;
    margin-top: 40px;
    padding-top: 20px;
    border-top: 1px solid rgba(255, 255, 255, 0.2);
    font-size: 14px;
}

.features-section {
    background: #f5f7fb;
}

.features-section .container {
    margin: auto;
    display: grid;
    grid-template-columns: 1fr 350px 1fr;
    gap: 30px;
    align-items: center;
}

.features-section .left,
.features-section .right {
    display: flex;
    flex-direction: column;
    gap: 250px;
}

.features-section .card {
    background: #fff;
    padding: 25px;
    border-radius: 20px;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
    position: relative;
    transition: 0.3s;
}

.features-section .card:hover {
    transform: translateY(-5px);
}

.features-section .card i {
    position: absolute;
    top: 15px;
    right: 15px;
    font-size: 28px;
    color: #2563eb;
}

.features-section .card h3 {
    margin-bottom: 15px;
    color: #111827;
}

.features-section .card p {
    color: #555;
    line-height: 1.6;
}

.features-section .phone {
    display: flex;
    justify-content: center;
}

.features-section .phone img {
    width: 380px;
    border-radius: 30px;
    filter: drop-shadow(0 10px 20px rgba(0, 0, 0, 0.2));
}

@media(max-width:900px) {

    .features-section .container {
        grid-template-columns: 1fr;
    }

    .features-section .phone {
        order: -1;
    }

}
</style>

<section class="hero">

    <div class="hero-left">

        <h1>
            Achetez à <br>
            l’international, <br>
            réceptionnez chez <br>
            vous.
        </h1>

        <p>
            Avez vous besoin de commander un article de la Chine,
            de la France, des Etats Unis ou du Nigéria ?
            Faites livrer vos commandes à nos entrepôts dans ces pays
            et recevez vos articles dans votre pays !
        </p>

        <button><i class="fas fa-shopping-cart"></i>Commander</button>
        <button><i class="fas fa-shipping-fast"></i>Transit</button>
        <button><i class="fas fa-store"></i>Marketplace</button>
    </div>
</section>

<section class="hero_2">
    <p>La satisfaction de nos clients est notre priorité <span style="color: #fff;">★★★★★</span> Note moyenne de
        4.8/5 sur Google My Business basée sur plus de 1000 avis. </p>
</section>

<section class="hero_3">
    <h1 style="font-size: 60px; text-align: center;">Comment ça marche ?</h1>
    <p style="text-align: center;">Une solution logistique pensée pour offrir un traitement rapide, précis et fiable de
        chacun de vos colis.</p>
</section>

<section>
    <div class="container">

        <div class="box">
            <center><img style="width : 100px;" src="images/user.png" alt=""></center>
            <h2>Inscrivez-vous et obtenez instantanément vos adresses
                de réception.</h2>

            <p>
                Une fois inscrit, vous bénéficierez immédiatement d’adresses de livraison dans plusieurs pays comme la
                Chine, la France, les États-Unis et le Nigéria.
            </p>
        </div>

        <div class="box">
            <center><img style="width : 100px;" src="images/fast-delivery.png" alt=""></center>
            <h2>Faites vos achats et recevez-les à votre adresse Joegol</h2>

            <p>
                Dès réception de votre commande dans notre entrepôt, votre colis sera contrôlé, mesuré et pesé. Une
                notification vous sera ensuite envoyée avec les détails complets ainsi que la facture à régler lors de
                la livraison.
            </p>
        </div>

        <div class="box">
            <center><img style="width : 100px;" src="images/cash-on-delivery.png" alt=""></center>
            <h2>Recevez vos commandes chez vous et payez à réception</h2>

            <p>
                Votre commande sera ensuite envoyée vers notre entrepôt de destination. À son arrivée, vous recevrez une
                notification pour le paiement de la facture et la récupération du colis.
            </p>
        </div>
    </div>
</section>

<section class="hero_4">
    <h1 style="font-size: 60px; text-align: center;">Pourquoi nous ?</h1>
    <p style="text-align: center;">Chaque erreur rencontrée à nos débuts est devenue une leçon précieuse. Grâce à cette
        expérience, notre équipe s’est renforcée pour vous garantir un service plus sûr, plus fiable et plus efficace.
    </p>
</section>

<section class="features-section">

    <div class="container">

        <!-- LEFT -->
        <div class="left">

            <div class="card">
                <img src="images/logistic.png" style="width: 40px;" alt="">
                <h3>Couverture logistique</h3>
                <p>
                    Tous les colis reçus dans nos entrepôts bénéficient automatiquement d’une couverture d’assurance. En
                    cas de détérioration, nous vous remboursons intégralement la valeur déclarée de votre marchandise.

                </p>
            </div>

            <div class="card">
                <img src="images/eye.png" style="width: 40px;" alt="">
                <h3>Suivi de colis</h3>
                <p>
                    Recevez directement sur votre téléphone des notifications pour chaque étape du suivi de vos colis :
                    réception à l’entrepôt, expédition, arrivée à destination, etc.
                </p>
            </div>

        </div>

        <!-- PHONE -->
        <div class="phone">
            <img src="images/phone.png" alt="Téléphone">
        </div>

        <!-- RIGHT -->
        <div class="right">

            <div class="card">
                <img src="images/tax.png" style="width: 40px;" alt="">
                <h3>Prix imbattables</h3>
                <p>
                    Nos prix sont soigneusement définis afin de vous proposer des tarifs avantageux tout en garantissant
                    une qualité de service irréprochable.

                </p>
            </div>

            <div class="card">
                <img src="images/virtual-assistant.png" style="width: 40px;" alt="">
                <h3>Assistance clientèle immédiate</h3>
                <p>
                    Besoin d’assistance ou de conseils ? Notre équipe du service client est à votre disposition pour
                    vous accompagner jusqu’à votre entière satisfaction.

                </p>
            </div>

        </div>

    </div>

</section>
<section class="hero_6">
    <h1 style="font-size: 60px; text-align: center;">Nos clients aiment Joegol</h1>
    <p style="text-align: center;">Confier vos marchandises à un transitaire est toujours un acte de foi. Mais qui mieux
        que nos clients pour vous
        rassurer de la qualité de notre service? </p> <br> <br>
    <center><button>Voir tous les avis</button></center>
</section>

<section class="hero_7">
    <h1 style="font-size: 60px; text-align: center;">Nos dernières news</h1>
    <p style="text-align: center;">Confier vos marchandises à un transitaire est toujours un acte de foi. Mais qui mieux
        que nos clients pour vous rassurer de la qualité de notre service? </p>
</section>

<section class="hero_8">
    <div class="container">
        <div class="box">
            <h2 style="text-align: left;">Tutoriels</h2>
            <p>
                Nous nous engageons à traiter vos expéditions dans les plus brefs délais pour garantir une livraison
                express.
            </p>
        </div>

        <div class="box">
            <h2 style="text-align: left;">Sécurité</h2>
            <p>
                Vos colis sont manipulés avec le plus grand soin et bénéficient d'un suivi rigoureux jusqu'à
                destination.
            </p>
        </div>

        <div class="box">
            <h2 style="text-align: left;">Transparence</h2>
            <p>
                Aucun frais caché. Vous connaissez le coût de votre transport dès la pesée de vos articles en entrepôt.
            </p>
        </div>
    </div>

</section>


<footer>
    <div class="footer-container">
        <div class="footer-col">
            <h3>À propos de Joegol</h3>
            <p>Votre partenaire de confiance pour le transit international et la logistique simplifiée depuis la Chine,
                l'Europe et les USA.</p>
        </div>

        <div class="footer-col">
            <h3>Liens Rapides</h3>
            <ul>
                <li><a href="#">Accueil</a></li>
                <li><a href="#">Nos Tarifs</a></li>
                <li><a href="#">Suivi de Colis</a></li>
                <li><a href="#">Marketplace</a></li>
            </ul>
        </div>

        <div class="footer-col">
            <h3>Contact</h3>
            <ul>
                <li><i class="fas fa-envelope"></i> contact@joegol.com</li>
                <li><i class="fas fa-phone"></i> +227 00 00 00 00</li>
                <li><i class="fas fa-map-marker-alt"></i> Niamey, Niger</li>
            </ul>
        </div>
    </div>

    <div class="footer-bottom">
        &copy; 2026 Joegol - Tous droits réservés.
    </div>
</footer>

</body>

</html>