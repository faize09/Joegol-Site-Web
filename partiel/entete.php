<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
<style>
  body {
    margin: 0;
    font-family: Arial, sans-serif;
  }

  header {
    background: #fff;
    padding: 20px 40px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    border-top: 1px solid #eee;
  }

  .logo {
    font-size: 32px;
    font-weight: bold;
  }
  .logo span {
    color: #e42323;
  }

  nav {
    display: flex;
    gap: 40px;
    font-size: 18px;
  }


  .suivi-btn {
    background: #e68d07ff;
    color: #fff;
    padding: 12px 26px;
    border-radius: 12px;
    font-size: 16px;
    border: none;
    cursor: pointer;
  }
  .market-btn{
    background: #e67607ff;
    color : #fff;
    padding: 15px 10px;
    border-radius: 12px;
    font-size: 10px;
    border: none;
    cursor: pointer;
  }
</style>
</head>
<body>

<header>
  <div class="logo">Joe<span>Gol</span></div>

  <nav>
    <div>Accueil</div>
    <div>Services</div>
    <div>Tarifs</div>
    <div>Contacts</div>
  </nav>
<button class="market-btn"><i class="fa-solid fa-shop"></i><b>  Marketplace</b></button>
  <button class="suivi-btn"><i class="fa-duotone fa-solid fa-magnifying-glass"></i><b>  Suivi</b></button>
</header>
