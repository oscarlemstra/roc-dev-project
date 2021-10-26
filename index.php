<?php

if (isset($_COOKIE["user"])) {
    header("Location: ./pages/home");
} else {
    header("Location: ./pages/login");
}