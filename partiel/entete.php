<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
  <style>
    * {
      box-sizing: border-box;
    }

    body {
      margin: 0;
      font-family: Arial, sans-serif;
      overflow-x: hidden;
    }

    header {
      background: #fff;
      padding: 18px clamp(16px, 4vw, 40px);
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 16px;
      flex-wrap: wrap;
      border-top: 1px solid #eee;
    }

    .logo {
      font-size: clamp(24px, 4vw, 32px);
      font-weight: bold;
      white-space: nowrap;
    }

    .logo span {
      color: #e42323;
    }

    nav {
      display: flex;
      gap: clamp(14px, 3vw, 40px);
      font-size: clamp(15px, 2vw, 18px);
      align-items: center;
      flex-wrap: wrap;
      justify-content: center;
    }


    .suivi-btn {
      background: #e68d07ff;
      color: #fff;
      padding: 12px 18px;
      border-radius: 12px;
      font-size: 16px;
      border: none;
      cursor: pointer;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      gap: 6px;
      white-space: nowrap;
    }

    .market-btn {
      background: #e67607ff;
      color: #fff;
      padding: 15px 10px;
      border-radius: 12px;
      font-size: 10px;
      border: none;
      cursor: pointer;
      display: inline-flex;
      align-items: center;
      gap: 6px;
      white-space: nowrap;
    }

    @media (max-width: 768px) {
      header {
        justify-content: center;
        text-align: center;
      }

      nav {
        order: 3;
        width: 100%;
      }

      .suivi-btn,
      .market-btn {
        flex: 1 1 140px;
        justify-content: center;
        max-width: 220px;
      }
    }

    @media (max-width: 480px) {
      header {
        align-items: stretch;
      }

      .logo,
      nav {
        width: 100%;
      }

      nav {
        gap: 10px 16px;
      }

      .suivi-btn,
      .market-btn {
        max-width: none;
        width: 100%;
      }
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
    <a class="suivi-btn" href="admin/blog.php"><i class="fas fa-blog"></i>Blog</a>
    <button class="market-btn"><i class="fa-solid fa-shop"></i><b> Marketplace</b></button>
    <button class="suivi-btn"><i class="fa-duotone fa-solid fa-magnifying-glass"></i><b> Suivi</b></button>
  </header>
