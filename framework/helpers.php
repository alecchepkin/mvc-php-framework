<?php

/**
 * Dumper
 * @param mixed $value
 * @param string $name
 */
function dump($value, $name = '') {
    echo '<pre>';
    if ($name) {
        echo $name . ':';
    }
    print_r($value);
    echo '</pre>';
    echo '<br>';
}

/**
 * Выводит инфо, если $ok=false текст красного цвета
 * @param string $str
 * @param boolen $ok
 */
function line($str, $ok = true) {
    $color = $ok ? 'black' : 'red';
    echo "<div style='color:$color'>$str</div>";
}