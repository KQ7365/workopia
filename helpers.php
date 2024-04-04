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

function loadView($name, $data = []) {
    $viewPath = basePath("App/views/{$name}.view.php");
// file_exists is built in PHP function to check file exist
    if (file_exists($viewPath)) {
        extract($data);
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
    $partialLoader = basePath("App/views/partials/{$name}.php");

    if(file_exists($partialLoader)) {
        require $partialLoader;
    } else {
        echo "View '{$name} not found!'";
    }
}

/**
* Inspect a value(s)
* @param mixed $value
* @return void aka nothing
*/

function inspect($value) {
        echo '<pre?>';
        var_dump($value);
        echo '</pre>';
}

/**
* Inspect a value(s) and die (function to kill script)
* @param mixed $value
* @return void aka nothing
*/

function inspectAndDie($value) {
    echo '<pre?>';
    die(var_dump($value));
    echo '</pre>';
}

//format salary function

function formatSalary($salary) {
    return '$' . number_format((floatval($salary)));
};

//sanitize data function that takes in dirty data and returns good string
//filter_var is built in function. trim is also built in function that removes whitespace
//
function sanitize($dirty) {
    return filter_var(trim($dirty), FILTER_SANITIZE_SPECIAL_CHARS);
};