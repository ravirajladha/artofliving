<!-- <style>
    body {
        background-color: black;
        color: white;
    }

    h1 {
        color: red;
    }

    h6 {
        color: red;
        text-decoration: underline;
    }
</style>
<!DOCTYPE html>
<html>

<head>
    <title>Access Denied</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta charset="UTF-8">
  
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>

<body>
    <div class="w3-display-middle">
        <h1 class="w3-jumbo w3-animate-top w3-center"><code>Access Denied</code></h1>
        <hr class="w3-border-white w3-animate-left" style="margin:auto;width:50%">
        <h3 class="w3-center w3-animate-right">You dont have permission to view this site.</h3>
        <h3 class="w3-center w3-animate-zoom">🚫🚫🚫🚫</h3>
        <h6 class="w3-center w3-animate-zoom">error code:403 forbidden</h6>
    </div>
</body>

</html> -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <script src="//use.fontawesome.com/84c9ca0cf8.js"></script>
    <title>403 Access Denied</title>

    <style type="text/css">
        @import url('//fonts.googleapis.com/css?family=Roboto');
        body {
            background: #f8a218;
            color: #D7D7D7;
            font: 16px/1.3 "Roboto", sans-serif;
        }
        header {
            width: 100%;
            margin:0px auto;
        }
        h1 {
            text-align: center;
            color:#D7D7D7;
            font: 100px/1 "Roboto";
            text-transform: uppercase;
            margin: 5% auto 5%;
            margin-bottom: 35px;
        }

        article { display: block; text-align: center; width: 650px; margin: 10px auto; }

        @media screen and (max-width: 720px) {
            article { display: block; text-align: center; width: 450px; margin: 0 auto; }
            h1 { font: 70px/1 "Roboto";}
            .wrap {margin-top: 50px;}
        }

        @media screen and (max-width: 480px) {
            article { display: block; text-align: center; width: 300px !important; margin: 0 auto; }
            h1 { font: 50px/1 "Roboto";}
            .wrap {margin-top: 50px;}

        }
    </style>

    <!--[if IE]><script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->

</head>
<body>
<div class="wrap">
  <article>
    <header>
      <h1 id="fittext1">403<i class="fa fa-exclamation-triangle fa-fw"></i></h1>
    </header>
    <p id="fittext2">Access Denied</p>
  </article>
</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/FitText.js/1.2.0/jquery.fittext.js"></script>
<script type="text/javascript">
    $("#fittext1").fitText(1.1);
    $("#fittext2").fitText(1.5);
</script>
</body>
</html>