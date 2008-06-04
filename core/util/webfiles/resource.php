<?php

// resource.php
// manages the retrieval of rollup packages for resources

$packages = array(
    'js'    => array(
        SNAPTEST_WEBFILES . 'js' . DIRECTORY_SEPARATOR . 'yui' . DIRECTORY_SEPARATOR . 'utilities.js',
        SNAPTEST_WEBFILES . 'js' . DIRECTORY_SEPARATOR . 'yui' . DIRECTORY_SEPARATOR . 'json-min.js',
        SNAPTEST_WEBFILES . 'js' . DIRECTORY_SEPARATOR . 'constants.js',
        SNAPTEST_WEBFILES . 'js' . DIRECTORY_SEPARATOR . 'displaymanager.js',
        SNAPTEST_WEBFILES . 'js' . DIRECTORY_SEPARATOR . 'fileloader.js',
        SNAPTEST_WEBFILES . 'js' . DIRECTORY_SEPARATOR . 'testloader.js',
        SNAPTEST_WEBFILES . 'js' . DIRECTORY_SEPARATOR . 'testrunner.js',
        SNAPTEST_WEBFILES . 'js' . DIRECTORY_SEPARATOR . 'snaptest.js',
    ),
    'css'   => array(
        SNAPTEST_WEBFILES . 'css' . DIRECTORY_SEPARATOR . 'yui' . DIRECTORY_SEPARATOR .'reset-fonts.css',
        SNAPTEST_WEBFILES . 'css' . DIRECTORY_SEPARATOR . 'yui' . DIRECTORY_SEPARATOR .'base-min.css',
        SNAPTEST_WEBFILES . 'css' . DIRECTORY_SEPARATOR . 'snaptest.css',
    ),
    'corner.gif' => array(SNAPTEST_WEBFILES . 'img' . DIRECTORY_SEPARATOR . 'corners.gif'),
);

$content_types = array(
    'js'            => 'text/javascript',
    'css'           => 'text/css',
    'corner.gif'    => 'image/gif',
);

$replacements = array(
    'css'   => array(
        '{IMG}' => SNAP_WI_URL_PATH.'?mode=resource&file='
    ),
);

// get the option
$options = Snap_Request::getLongOptions(array(
    'file'      => 'null',
));

// no file
if (!$options['file']) {
    echo '';
    exit;
}

$file = $options['file'];

// no proper file
if (!isset($packages[$file])) {
    echo '';
    exit;
}

// send content type header
header('Content-type: '.(isset($content_types[$file]) ? $content_types[$file] : 'text/plain'));

// output every file in the package
$files = $packages[$file];
foreach ($files as $fname) {
    if (!isset($replacements[$file])) {
        readfile($fname);
    }
    else {
        echo str_replace(array_keys($replacements[$file]), array_values($replacements[$file]), file_get_contents($fname));
    }
}
