<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8"/>
    <link style="text/css" href="css/build/main.css" rel="stylesheet">
    <script type="text/javascript" src="js/build/vendor.js"></script>
    <script type="text/javascript" src="js/build/main.js"></script>
  </head>
  <body>
    <header>
      <div style ="text-align:center; margin-top:5px;">
        <a href="/acookiestory/#!/">
          <img class="logo_img" src="images/ACS_logo.png"></img>
        </a>
      </div>
      <div class="bandeau" >
        <ul>
          <li><a href="/acookiestory/#!/">Accueil</a></li>
          <li><a href="/acookiestory/#!/categories">Categories</a></li>
          <li><a href="/acookiestory/#!/index">Index</a></li>
          <li>Blogroll</li>
          <li>A propos</li>
          <li>Contact</li>
        </ul>
      </div>
    </header>
    <div class="recette container" ng-app="cookieStoryApp">
      <div class="row">
        <div ui-view>
        </div>
      </div>
      <div class="row" ng-controller="feedCtrl">
        <hr />
        <div class="footer text-center">
          <a class="link_home" href="https://www.instagram.com/acookiestory/">Retrouvez-moi sur instagram !</a>
          <!-- SnapWidget -->
          <div class="row feed">
            <span ng-repeat="image in images">
              <a class="link_home" href="{{image.link}}">
                <img ng-src="{{image.src}}" alt="">
              </a>
            </span>
          </div>
          <p class="footer-cookie">A Cookie Story</p>
        </div>
      </div>
    </div>
  </body>
</html>
