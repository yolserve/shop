<?php

/**
 * Returns the importmap for this application.
 *
 * - "path" is a path inside the asset mapper system. Use the
 *     "debug:asset-map" command to see the full list of paths.
 *
 * - "entrypoint" (JavaScript only) set to true for any module that will
 *     be used as an "entrypoint" (and passed to the importmap() Twig function).
 *
 * The "importmap:require" command can be used to add new entries to this file.
 */
return [
    'app' => [
        'path' => './assets/app.js',
        'entrypoint' => true,
    ],
    '@hotwired/stimulus' => [
        'version' => '3.2.2',
    ],
    '@symfony/stimulus-bundle' => [
        'path' => './vendor/symfony/stimulus-bundle/assets/dist/loader.js',
    ],
    '@hotwired/turbo' => [
        'version' => '7.3.0',
    ],
    'bootstrap' => [
        'version' => '5.3.6',
    ],
    '@popperjs/core' => [
        'version' => '2.11.8',
    ],
    'bootstrap/dist/css/bootstrap.min.css' => [
        'version' => '5.3.6',
        'type' => 'css',
    ],
    'aos' => [
        'version' => '2.3.4',
    ],
    'drift-zoom' => [
        'version' => '1.5.1',
    ],
    'glightbox' => [
        'version' => '3.3.1',
    ],
    'swiper' => [
        'version' => '11.2.8',
    ],
    'isotope-layout' => [
        'version' => '3.0.6',
    ],
    'imagesloaded' => [
        'version' => '5.0.0',
    ],
    'outlayer' => [
        'version' => '2.1.1',
    ],
    'get-size' => [
        'version' => '2.0.3',
    ],
    'desandro-matches-selector' => [
        'version' => '2.0.2',
    ],
    'fizzy-ui-utils' => [
        'version' => '2.0.7',
    ],
    'masonry-layout' => [
        'version' => '4.2.1',
    ],
    'ev-emitter' => [
        'version' => '2.1.2',
    ],
    'quill2-emoji' => [
        'version' => '0.1.2',
    ],
    'quill' => [
        'version' => '2.0.3',
    ],
    'quill2-emoji/dist/style.css' => [
        'version' => '0.1.2',
        'type' => 'css',
    ],
    'lodash-es' => [
        'version' => '4.17.21',
    ],
    'parchment' => [
        'version' => '3.0.0',
    ],
    'quill-delta' => [
        'version' => '5.1.0',
    ],
    'eventemitter3' => [
        'version' => '5.0.1',
    ],
    'fast-diff' => [
        'version' => '1.3.0',
    ],
    'lodash.clonedeep' => [
        'version' => '4.5.0',
    ],
    'lodash.isequal' => [
        'version' => '4.5.0',
    ],
    'quill/dist/quill.snow.css' => [
        'version' => '2.0.3',
        'type' => 'css',
    ],
    'quill/dist/quill.bubble.css' => [
        'version' => '2.0.3',
        'type' => 'css',
    ],
    'axios' => [
        'version' => '1.9.0',
    ],
    'quill-resize-image' => [
        'version' => '1.0.7',
    ],
    '@symfony/ux-live-component' => [
        'path' => './vendor/symfony/ux-live-component/assets/dist/live_controller.js',
    ],
    'swiper/swiper-bundle.min.mjs' => [
        'version' => '11.2.8',
    ],
    'swiper/swiper-bundle.min.css' => [
        'version' => '11.2.8',
        'type' => 'css',
    ],
];
