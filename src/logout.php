<?php
session_start();
session_destroy();
//pindah halaman login
header("location:../index.php");