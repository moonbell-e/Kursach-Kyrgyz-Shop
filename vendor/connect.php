<?php

    $connect = mysqli_connect('localhost', 'root', '', 'KyrgyzShop');

    if (!$connect) {
        die('Error connect to DataBase');
    }