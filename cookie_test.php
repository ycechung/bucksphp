<?php

$month = 60*60*24*30;
$expires_at = time() + $month;

echo "now: " . time() . "<hr>";
echo "next month: " . $expires_at;

setcookie('my_cookie', 'chocolate', $expires_at);