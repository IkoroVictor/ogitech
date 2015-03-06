<html>
<head>
    <title>Login</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/school.css" rel="stylesheet">
    <link href="assets/font-awesome/css/font-awesome.min.css"
          rel="stylesheet">


</head>
<body class="login-body-area">

<div class="container area">

    <div class="row login-content">
        <div class="col-lg-2"></div>
        <div class="col-lg-4">
            <div class="login-box-l">
                <img class="logo-l" src="assets/images/logo.jpg">
            </div>
        </div>
        <div class="col-lg-4">

            <div class="login-box-r">

                <div class="login-title">
						<span>Department of Computer Science
						 </span>
                </div>

                <form class="login-form" method="post" action="/login">
                    <div class="login-input">
                        <input type="text" class="form-control"
                               placeholder="&#xf007;  Username" name="username" required="true">
                    </div>
                    <div class="login-input">
                        <input type="password" class="form-control"
                               placeholder="&#xf023;  Password" name="password" required="true">
                    </div>
                    <div class="btn-group login-button">
                        <input type="submit" class="btn btn-success" value="Login">

                    </div>
                </form>
            </div>
        </div>
        <div class="col-lg-2"></div>

    </div>
</div>
<script src="assets/js/angular.min.js"></script>
</body>
</html>