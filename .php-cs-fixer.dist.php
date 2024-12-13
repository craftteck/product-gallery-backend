<?php
/*
 * This document has been generated with
 * https://mlocati.github.io/php-cs-fixer-configurator/#version:3.1.0|configurator
 * you can change this configuration by importing this file.
 */
$config = new PhpCsFixer\Config();
return $config
    ->setRiskyAllowed(true)
    ->setRules([
        '@PSR12' => true,
        'ordered_imports' => true,
        'no_unused_imports' => true,
        'single_quote' => true,
    ])
    ->setFinder(PhpCsFixer\Finder::create()
        ->exclude([
            'vendor',
            'bootstrap/cache',
        ])
        ->in(__DIR__)
    )
;
