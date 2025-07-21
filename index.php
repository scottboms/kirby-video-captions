<?php

/**
 * Caption Files Support for Kirby
 *
 * @author Scott Boms <plugins@scottboms.com>
 * @link https://github.com/scottboms/kirby-caption-files
 * @license MIT
**/

use Composer\Semver\Semver;
use Kirby\Cms\App as Kirby;

// validate Kirby version
if (Semver::satisfies(Kirby::version() ?? '0.0.0', '~4.0 || ~5.0') === false) {
	throw new Exception('SVG Tag requires Kirby 4 or 5');
}

Kirby::plugin('scottboms/video-captions', 
info: [
	'homepage' => 'https://github.com/scottboms/kirby-caption-files',
	'version' => '1.0.0',
	'license' => 'MIT',
	'authors' => [
		[
			'name' => 'Scott Boms'
		]
	]
],
extends: [
	'fileTypes' => [
		'srt' => [
			'mime' => ['text/plain', 'application/x-subrip'],
			'type' => 'document',
			'resizable' => false,
			'viewable' => true
		],
		'vtt' => [
			'mime' => ['text/plain', 'text/vtt'],
			'type' => 'document',
			'resizable' => false,
			'viewable' => true
		]
	],
	'blueprints' => [
		'files/captions' => __DIR__ . '/blueprints/files/captions.yml'
	]
]);