<!-- this will have helper functions for entire site -->
<?php
/**
* Get the base path
* @param string path
* @return string
*/

function basePath($path = '') {
    return __DIR__ . '/' . $path;
}


/**
* Load a view
* @param string $name
* @return void aka nothing
*/

function loadView($name) {
    $viewPath = basePath("views/{$name}.view.php");
// file_exists is built in PHP function to check file exist
    if (file_exists($viewPath)) {
        require $viewPath;
    } else {
        echo "View '{$name} not found!'";
    }
}

/**
* Load a partial
* @param string $name
* @return void aka nothing
*/

function loadPartial($name) {
    $partialLoader = basePath("views/partials/{$name}.php");

    if(file_exists($partialLoader)) {
        require $partialLoader;
    } else {
        echo "View '{$name} not found!'";
    }
}