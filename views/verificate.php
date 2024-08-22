<?php
    $token = $server[3];
    include('classes/Auth.php');
    $auth = new Auth();
    $auth->validate_email($token);
?>