<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8"/>
    <link style="text/css" href="css/build/main.css" rel="stylesheet">
    <script type="text/javascript" src="js/build/vendor.js"></script>
    <script type="text/javascript" src="js/build/main.js"></script>
  </head>
  <body>
    <div class="col-md-12">
      <div class="col-md-8 col-md-offset-2">
        <div style ="text-align:center; margin-top:5px;">
          <img class="logo_img" src="images/ACookieStoryLogo.png"></img>
        </div>
        <div class="container bandeau" >
          <ul>
            <li><a href="/acookiestory/#!/">Accueil</a></li>
            <li><a href="/acookiestory/#!/categories">Categories</a></li>
            <li><a href="/acookiestory/#!/index">Index</a></li>
            <li>Materiel</li>
            <li>A propos</li>
            <li>Contact</li>
          </ul>
        </div>
        <div class="recette col-md-12" ng-app="cookieStoryApp">
          <div ui-view>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
