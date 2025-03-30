<?php


$user = isset($_SERVER["REMOTE_USER"]) ? $_SERVER["REMOTE_USER"]: "";


$addr = $_SERVER['REMOTE_ADDR'];
$host = gethostbyaddr( $addr );

if (FALSE !== strstr($host, 'grpud.net')) {
	$addr = 'grpud.net';
}

error_log("SWAGGER UI access user: $user - host/addr ..: $host / $addr");

switch ($addr) {
	case '127.0.0.1':
	case 'grpud.net':
	case '80.16.165.62':
		break;
}

switch ($user) {
        case 'developer':
               break; 	
}

?><!-- HTML for static distribution bundle build -->
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Swagger UI</title>
    <link rel="stylesheet" type="text/css" href="./swagger-ui.css" />
    <link rel="stylesheet" type="text/css" href="index.css" />
    <link rel="icon" type="image/png" href="./favicon-32x32.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="./favicon-16x16.png" sizes="16x16" />
  </head>

  <body>
    <div id="swagger-ui"></div>
    <script src="./swagger-ui-bundle.js" charset="UTF-8"> </script>
    <script src="./swagger-ui-standalone-preset.js" charset="UTF-8"> </script>
    <script src="./swagger-initializer.js" charset="UTF-8"> </script>
  </body>
</html>
