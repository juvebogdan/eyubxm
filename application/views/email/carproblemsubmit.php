<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style type="text/css">
body,td,th {
	font-family: Tahoma, Geneva, sans-serif;
}
a.button {
    -webkit-appearance: button;
    -moz-appearance: button;
    appearance: button;

    text-decoration: none;
    color: initial;
}
</style>
</head>

<body>
<p>Zaposleni <?php echo $employee ?> je prijavio problem sa automobilom <?php echo $register ?></p>
<p>Opis problema:</p>
<p><?php echo $description ?></p>
<p>Pozdrav</p>
</br>
<!--<p><small>Created by EBOGDKR</small></p>-->
</body>
</html>
