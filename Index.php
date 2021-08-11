<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'>
    <link href='./vendors_login/css/style.css' rel='stylesheet' type='text/css'>
    <link href='./vendors/alertify/css/alertify.min.css' rel='stylesheet' type='text/css'>
    <link href='./vendors/bootstrap/dist/css/bootstrap.min.css' rel='stylesheet' type='text/css'>
</head>
<body>
    

<div class="container">
  <div class="frame">
    <div class="nav">
      <ul>
        <li class="signin-active" style="text-align: center;">Login</li>
      </ul>
  </div>
    <div class="container">
       <form class="login-form" id="formLogin" action="" method="post" name="login-form">
          <label for="username">Username</label>
          <input class="form-styling" id="username" type="text" name="username" placeholder=""/>
          <label for="password">Password</label>
          <input class="form-styling" id="password" type="password" name="password" placeholder=""/>
          <input type="checkbox" id="checkbox"/>
          <label for="checkbox" ><span class="ui"></span>Recordarme</label>
          </p>
            <div class="d-grid gap-2 col-6 mx-auto">
              <button class="btn btn-primary" type="submit">Iniciar Sesion</button>
            </div>           
		   </form>   
    </div>   
  </div>
    
</div>


<script type="text/javascript" src="./vendors/jquery1/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="./vendors/alertify/js/alertify.min.js"></script>
<script type="text/javascript" src="./vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<script type="text/javascript" src="login.js"></script>
</body>
</html>