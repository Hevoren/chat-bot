<?php

session_unset();
session_destroy();
header('Location: /public/index.php?page=hello');