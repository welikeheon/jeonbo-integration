<?php


require('./libs/lib-core.php');

if ($_SESSION['logged_in'] == true) {
    header("Location: ./contents/main/main_0100.php");
} else {
    header("Location: ./contents/hello/hello_0100.php");
}