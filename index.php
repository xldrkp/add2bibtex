<?php

    /**
     * add2bibtex
     * Stores clean BibTeX data in a file via JavaScript bookmarklet
     * @author Axel Dürkop <axel.duerkop@tu-harburg.de>
     * @copyright 2013
     * @license MIT
     *
     * Upload this file to a server. Change the file configuration.php.sample to configuration.php
     * and adjust the path and file name.
     * Also adjust the path in the bookmarklet code.
     */

    require_once './configuration.php';

    $backURL = '';

    if (isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] != '') {
        $backURL = $_SERVER['HTTP_REFERER'];
    }

    if (isset($_GET['data']) && $_GET['data'] != '') {

        $data = urldecode($_GET['data']) . "\n";

        if (substr($data, 0, 1) !== '@') {
            die('This does not seem to be valid BibTeX data!');
        }

        if ($o = fopen(BIBTEXPATH . BIBTEXFILE, "a")) {
            $w = fwrite($o, $data);

            if ($w) {
                header('Location: ' . $backURL);
            } else {
                die("There was an error writing the entry to the file!");
            }
        }
    } else {
        die('There was an error transmitting the BibTeX data!');
    }