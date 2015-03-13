<!DOCTYPE html>
<html lang="fr" ng-app="app">
<head>
    <meta charset="utf-8">
    <title>RA Sécurité</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=RobotoDraft:400,500,700,400italic"/>
    <link rel="stylesheet" href="resources/css/base.css"/>
</head>
<body>

<div id="page">
    <div>
        Actions :
        <ul>
            <li><a href="#/newReport">Nouveau rapport</a></li>
            <li><a href="#/listReports">Liste</a></li>
        </ul>
    </div>

    <div ng-view class="container"></div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular-route.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular-resource.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular-sanitize.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular-touch.js"></script>
<script src="resources/javascript/app.module.js"></script>
<script src="resources/javascript/app.js"></script>
<script src="resources/javascript/app-route.js"></script>
<script src="resources/javascript/angular-scroll-0.6.js"></script>
<!--[if lt IE 9]>
<script type="text/javascript" src="resources/javascript/flashcanvas.js"></script>
<![endif]-->
<script src="resources/javascript/jSignature.min.js"></script>
<script src="resources/javascript/form.js"></script>
<script src="resources/javascript/success.js"></script>
<script src="resources/javascript/list.js"></script>
<script src="resources/javascript/detail.js"></script>

</body>
</html>