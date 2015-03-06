<html>
<head>
    <title>Main</title>
    <link href="assets/css/bootstrap_edited.min.css" rel="stylesheet">
    <link href="assets/css/school.css" rel="stylesheet">
    <link href="assets/css/ng-table.min.css" rel="stylesheet">
    <link href="assets/css/angular-toggle-switch-bootstrap-2.css" rel="stylesheet">
    <link href="assets/font-awesome/css/font-awesome.min.css"
          rel="stylesheet">

</head>
<body class="main-body-area" ng-app="mainApp">

<div ng-controller="MainCtrl as ctrl">

    <div ng-hide="progress_hidden" class="loading-backdrop">
        <span class="loading"><i class="fa fa-5x fa-spinner fa-spin"></i></span>
    </div>


    <div class="top-bar" >
        <div class="menu-area">

            <div class="menu-item">

                <a ui-sref-active="menu-active" ui-sref="statistics">
                    <div class="menu-icon">
                        <i class="fa fa-lg fa-fw fa-bar-chart" aria-hidden="true"></i>
                    </div> Statistics
                </a>

					<span class="dropdown" dropdown on-toggle="toggled(open)">
      <a href="#" ng-class="{'menu-active': $state.includes('class-list')}" class="dropdown-toggle" dropdown-toggle>
          <div class="menu-icon">
              <i ui-sref-active="menu-active" class="fa fa-lg fa-fw fa-list-alt" aria-hidden="true"></i>
          </div> Class List
      </a>
      <ul class="dropdown-menu">
          <li><a ui-sref-active="menu-active" ui-sref="class-list.ond1({id: 1})">OND 1</a></li>
          <li><a ui-sref-active="menu-active" ui-sref="class-list.ond2({id: 2})">OND 2</a></li>
          <li><a ui-sref-active="menu-active" ui-sref="class-list.hnd1({id: 3})">HND 1</a></li>
          <li><a ui-sref-active="menu-active" ui-sref="class-list.hnd2({id: 4})">HND 2</a></li>
          <li><a ui-sref-active="menu-active" ui-sref="class-list.extra({id: 5})">EXTRA YEAR</a></li>
      </ul>
    </span>

			<span class="dropdown" dropdown on-toggle="toggled(open)">
      <a href="#" ng-class="{'menu-active': $state.includes('score-sheet')}" class="dropdown-toggle" dropdown-toggle>
          <div class="menu-icon">
              <i class="fa fa-lg fa-fw fa-newspaper-o" aria-hidden="true"></i>
          </div>Score Sheet
      </a>
      <ul class="dropdown-menu">
          <li><a ui-sref-active="menu-active" ui-sref="score-sheet.ond1({id: 1})">OND 1</a></li>
          <li><a ui-sref-active="menu-active" ui-sref="score-sheet.ond2({id: 2})">OND 2</a></li>
          <li><a ui-sref-active="menu-active" ui-sref="score-sheet.hnd1({id: 3})">HND 1</a></li>
          <li><a ui-sref-active="menu-active" ui-sref="score-sheet.hnd2({id: 4})">HND 2</a></li>
      </ul>
    </span>

                <a ui-sref-active="menu-active" ui-sref="courses">
                    <div class="menu-icon">
                        <i class="fa fa-lg fa-fw fa-book" aria-hidden="true"></i>
                    </div> Courses
                </a>


				<span class="dropdown" dropdown on-toggle="toggled(open)">
      <a href="#" ng-class="{'menu-active': $state.includes('results')}" class="dropdown-toggle" dropdown-toggle>
          <div class="menu-icon">
              <i class="fa fa-lg fa-fw fa-table" aria-hidden="true"></i>
          </div>Results
      </a>
      <ul class="dropdown-menu">
          <li><a ui-sref-active="menu-active" ui-sref="results.ond1({id: 1})">OND 1</a></li>
          <li><a ui-sref-active="menu-active" ui-sref="results.ond2({id: 2})">OND 2</a></li>
          <li><a ui-sref-active="menu-active" ui-sref="results.hnd1({id: 3})">HND 1</a></li>
          <li><a ui-sref-active="menu-active" ui-sref="results.hnd2({id: 4})">HND 2</a></li>
      </ul>
    </span>


                <a ui-sref-active="menu-active" ui-sref="close-semester">
                    <div class="menu-icon">
                        <i class="fa fa-lg fa-fw fa-sign-out" aria-hidden="true"></i>
                    </div> Close
                </a> <a ui-sref-active="menu-active" ui-sref="settings">
                    <div class="menu-icon">
                        <i class="fa fa-lg fa-fw fa-gear" aria-hidden="true"></i>
                    </div> Settings
                </a> <a  class="menu-passive" href="">
                    <div class="menu-icon">
                        <i class="fa fa-lg fa-fw fa-unlock-alt" aria-hidden="true"></i>
                    </div> Logout
                </a>

            </div>

        </div>
    </div>
</div>
<div class="container main-area ng-cloak" ui-view></div>



<script src="assets/js/angular.min.js"></script>
<script src="assets/js/angular-ui-router.min.js"></script>
<script src="assets/js/ng-table.min.js"></script>
<script src="assets/js/ui-bootstrap-tpls-0.12.0.min.js"></script>
<script src="assets/js/angular-toggle-switch.min.js"></script>
<script src="assets/js/angular-sanitize.min.js"></script>
<!-- shim is needed to support non-HTML5 FormData browsers (IE8-9)-->
<script src="assets/js/angular-file-upload-shim.min.js"></script>
<script src="assets/js/angular-file-upload.min.js"></script>

<script src="assets/js/main.js"></script>

<script src="assets/js/controllers.js"></script>

</body>
</html>