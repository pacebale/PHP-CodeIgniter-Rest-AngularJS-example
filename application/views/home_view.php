<!DOCTYPE html>
<html>   
    <head>
        <title>Multiplikatori</title>
        <link href="bower_components/foundation/css/foundation.min.css" rel="stylesheet" type="text/css"/>
        <link href="bower_components/style.css" rel="stylesheet" type="text/css"/>
    </head>
    <body ng-app="mainModule">
        <div ng-controller="NavigationController">
            <nav class="top-bar" data-topbar role="navigation">
                <ul class="title-area">
                    <li class="name">
                        <h1><a href="#">{{title}}</a></h1>
                    </li>  

                </ul>

                <section class="top-bar-section"> 
                    <!-- Right Nav Section -->
                    <ul class="left">
                        <li class="has-dropdown">
                            <a  dropdown-toggle="#ng-dropdown" )>Izbornik</a>
                            <ul id="ng-dropdown" class="dropdown">
                                <li ng-repeat="(key, value) in menuItems" class="{{value.class}}">
                                    <a href="{{value.href}}" data-ng-click="navigate(key)">{{value.title}}</a>
                                </li>
                            </ul>
                        </li>
                    </ul>           
                </section>
            </nav>
            <div class="row collapse top-buffer">
                <div class="small-1 columns right">
                    <button ng-click="search()" class="left button postfix">Go</button>
                </div>
                <div class="small-3 columns right">
                    <input type="text" placeholder="pretrazi" ng-model="searchString">
                </div>
            </div>

            <div ng-view>

            </div>

            <footer class="small-offset-1 small-11 columns footer bottom" >
                Buntić Marija ,
                El-Ayedi Sindi ,
                Elijaš Iva ,
                Ilić Maja ,
                Jurić Ivana ,
                Jurišić Elizabeta,
                Soldo Tonka ,

            </footer>
        </div>


    </body>

    <!-- SCRIPTS -->

    <!-- Angular main and dependencies -->
    <script src="bower_components/angular/angular.js" type="text/javascript"></script>
    <script src="bower_components/angular-foundation/mm-foundation-tpls.min.js" type="text/javascript"></script>
    <script src="bower_components/angular-route/angular-route.min.js" type="text/javascript"></script>
    <script src="bower_components/angular-animate/angular-animate.min.js" type="text/javascript"></script>
    <script src="app/mainModule.js" type="text/javascript"></script>

    <!-- navigation -->
    <script src="app/navigation/navigation.service.js" type="text/javascript"></script>
    <script src="app/navigation/navigation.controller.js" type="text/javascript"></script>

    <!-- home -->
    <script src="app/home/home.controller.js" type="text/javascript"></script>

    <!-- multiplikator-->
    <script src="app/multiplikator/multiplikator.controller.js" type="text/javascript"></script>
    <script src="app/multiplikator/multiplikator.service.js" type="text/javascript"></script>

    <!-- Formatters -->
    <script src="app/formatters/number.formatter.js" type="text/javascript"></script>
    <script src="app/formatters/percentage.formatter.js" type="text/javascript"></script>
    <script src="app/formatters/decnumber.formatter.js" type="text/javascript"></script>
</html>