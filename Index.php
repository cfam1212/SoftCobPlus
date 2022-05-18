<!DOCTYPE html>
<html lang="en">

<head>
  <title>Login</title>
  <!-- meta tags -->
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <link href="./vendors_login/css/style.css" rel="stylesheet" type="text/css" />
  <link href="./vendors_login/css/fontawesome-all.css" rel="stylesheet" />
  <link href="./vendors/alertify/css/alertify.min.css" rel="stylesheet">
  <link href="//fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

</head>


<body>
  <h1></h1>
  <div class=" w3l-login-form">
    <h2>SoftCob Plus</h2>
    <form id="formLogin" method="POST">
      <div class=" w3l-form-group">
        <label>Username:</label>
        <div class="group">
          <i class="fas fa-user"></i>
          <input type="text" class="form-control" id="username" placeholder="Username" required="required" autocomplete="off" autofocus />
        </div>
      </div>
      <div class=" w3l-form-group">
        <label>Password:</label>
        <div class="group">
          <i class="fas fa-unlock"></i>
          <input type="password" class="form-control" id="password" placeholder="Password" required="required" autocomplete="off" />
        </div>
      </div>
      <br />
      <br />
      <button type="submit">Login</button>
    </form>
  </div>
  <footer>
    <p class="copyright-agileinfo"> &copy; Best Bussinesnes Plus S.A <a href="https://bbplus-ec.com">Best Bussines Plus</a></p>
  </footer>

</body>

</html>
<script src="./vendors_login/jquery/jquery-3.6.0.min.js"></script>
<script src="./login.js"></script>
<script src="./vendors/alertify/js/alertify.min.js"></script>
<script src="./codejs/funciones.js"></script>