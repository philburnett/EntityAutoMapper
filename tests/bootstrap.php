<?php
if (is_dir(__DIR__ . '/../src/')) {
    set_include_path(
        __DIR__ . '/../src/'
        . PATH_SEPARATOR
        . __DIR__ . '/../tests/'
        . PATH_SEPARATOR . get_include_path()
    );
}
spl_autoload_register(function($c){@include preg_replace('#\\\|_(?!.+\\\)#','/',$c).'.php';});
 