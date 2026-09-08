<?php

if ($_SERVER['HTTP_HOST'] === 'localhost:81') {
    define('BASE_URL', 'http://localhost:81/forsk-coding-school');
} else {
    define('BASE_URL', 'https://forskcodingschool.com');
}