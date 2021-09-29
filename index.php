<?php

if (isset($_COOKIE["user"])) {
    header("Location: page/home");
} else {
    header("Location: page/login");
}