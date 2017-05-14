<?php
error_reporting(0);
// Set Error Handler
set_error_handler(error_handler, E_ALL);
function error_handler($nr, $string, $file, $line) {
    $error = date("d-m-Y H:i")." ".$nr." ".$file." ".$line." ".$string."\r\n";
    error_log($error, 3, "/iu/cube/u0/s236355/www/webprog/assets/errorlog.txt");
}
// Register Shutdown Function
register_shutdown_function("shutdown");
function shutdown() {
    $error = error_get_last();
    if ($error["type"] == E_ERROR) {
        error_handler(E_ERROR,$error["message"],$error["file"],$error["line"]);
        ob_start();
        header("Location: http://student.cs.hioa.no/~s236355/webprog/error.php");
        ob_flush();
    }
}
?>