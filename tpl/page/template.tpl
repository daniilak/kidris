<!doctype html>
<html class="no-js" lang="ru">

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title> {title} | Kidris </title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="apple-touch-icon" href="apple-touch-icon.png">
  <!-- Place favicon.ico in the root directory -->
  <link rel="stylesheet" href="../../dist/css/vendor.css">
  <link rel="stylesheet" id="theme-style" href="../../dist/css/app-seagreen.css">
</head>

<body>
  <div class="main-wrapper">
    <div class="app" id="app">
      <header class="header">
        <div class="header-block header-block-collapse hidden-lg-up"> <button class="collapse-btn" id="sidebar-collapse-btn">
         <i class="fa fa-bars"></i>
       </button> </div>
       <div class="header-block header-block-search hidden-sm-down">

       </div>
       <div class="header-block header-block-buttons"> <a  href="https://vk.com/kidrisru" target="_blank" class="btn btn-sm header-btn">
         <i class="fa fa-vk"></i>
         <span>Мы в Вконтакте</span>
       </a> <a href="https://vk.com/topic-88986513_31841141" target="_blank" class="btn btn-sm header-btn">
       <i class="fa fa-star"></i>
       <span>Отзывы</span>
     </a> <a href="https://vk.com/topic-88986513_31711983" target="_blank" class="btn btn-sm header-btn">
     <i class="fa fa-cloud-download"></i>
     <span>Предложения</span>
   </a> </div>
   <div class="header-block header-block-nav">
    <ul class="nav-profile">
      <li class="notifications new"> <a href="" data-toggle="dropdown" style="display: none;">
       <i class="fa fa-bell-o"></i>
       <sup>
         <span class="counter">8</span>
       </sup>
     </a>
     <div class="dropdown-menu notifications-dropdown-menu">
      <ul class="notifications-container">

        <li>
          <a href="" class="notification-item">
            <div class="img-col">
              <div class="img" style="background-image: url('assets/faces/5.jpg')"></div>
            </div>
            <div class="body-col">
              <p> <span class="accent">Amaya Hatsumi</span> started new task: <span class="accent">Dashboard UI design.</span>. </p>
            </div>
          </a>
        </li>
        <li>
          <a href="" class="notification-item">
            <div class="img-col">
              <div class="img" style="background-image: url('assets/faces/8.jpg')"></div>
            </div>
            <div class="body-col">
              <p> <span class="accent">Andy Nouman</span> deployed new version of <span class="accent">NodeJS REST Api V3</span> </p>
            </div>
          </a>
        </li>
      </ul>
      <footer>
        <ul>
          <li> <a href="">
           View All
         </a> </li>
       </ul>
     </footer>
   </div>
 </li>
 <li class="profile dropdown">
  <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
    <div class="img" style="background-image: url('{photo_user}')"> </div> <span class="name">
    {fName} {lName}
  </span> </a>
  <div class="dropdown-menu profile-dropdown-menu" aria-labelledby="dropdownMenu1"> 
   <a class="dropdown-item" href="#">
     <i class="fa fa-bell icon"></i>
     Уведомления
   </a> <a class="dropdown-item" href="#">
   <i class="fa fa-gear icon"></i>
   Настройки
 </a>
 <div class="dropdown-divider"></div> <a class="dropdown-item" href="/starter?logout">
 <i class="fa fa-power-off icon"></i>
 Выйти   
</a> </div>
</li>
</ul>
</div>
</header>
<aside class="sidebar">
  <div class="sidebar-container">
    <div class="sidebar-header">
      <div class="brand">
        <div class="logo"> </div> Kidris</div>
      </div>
      <nav class="menu">
        <ul class="nav metismenu" id="sidebar-menu">
          {block_menu}
        </ul>
      </nav>
    </div>
  </aside>
  <div class="sidebar-overlay" id="sidebar-overlay"></div>
  <article class="content dashboard-page">
   {content}

 </article>
 <footer class="footer">
  <div class="footer-block author">
    <ul>
      <li> by Kidris </li>
    </ul>
  </div>
</footer>


</div>
</div>
<!-- Reference block for JS -->
<div class="ref" id="ref">
  <div class="color-primary"></div>
  <div class="chart">
    <div class="color-primary"></div>
    <div class="color-secondary"></div>
  </div>
</div>
<script src="../dist/js/vendor.js"></script>
<script src="../dist/js/app.js"></script>
{scripts}
</body>

</html>