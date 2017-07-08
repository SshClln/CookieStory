<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8"/>
    <link style="text/css" href="css/build/main.css" rel="stylesheet">
    <script type="text/javascript" src="js/build/vendor.js"></script>
    <script type="text/javascript" src="js/build/main.js"></script>
  </head>
  <body>
    <div class="row">

      <div class="col-md-8 col-md-offset-2">
        <div style ="text-align:center; margin-top:5px;">
          <img class="logo_img" src="images/ACookieStoryLogo.png"></img>
        </div>
        <div class="container bandeau" >
          <ul>
            <li><a href="/acookiestory/#!/">Accueil</a></li>
            <li><a href="/acookiestory/#!/categories">Categories</a></li>
            <li><a href="/acookiestory/#!/index">Index</a></li>
            <li>Blogroll</li>
            <li>A propos</li>
            <li>Contact</li>
          </ul>
        </div>
      </div>
    </div>
    <div class="recette row" ng-app="cookieStoryApp">
      <div ui-view>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 titre-home">
        <a href="https://www.instagram.com/acookiestory/"><p class="footer text-center">Retrouvez-moi sur instagram !</p></a>
        <!-- SnapWidget -->
        <script src="https://snapwidget.com/js/snapwidget.js"></script>
        <iframe src="https://snapwidget.com/embed/403526" class="snapwidget-widget" allowTransparency="true" frameborder="0" scrolling="no" style="border:none; overflow:hidden; width:100%; "></iframe>
        <p class="footer-cookie text-center">A Cookie Story</p>
      </div>
    </div>
  </body>
</html>
