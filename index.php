<?php

/**
 * Caption Files Support for Kirby
 *
 * @author Scott Boms <plugins@scottboms.com>
 * @link https://github.com/scottboms/kirby-caption-files
 * @license MIT
**/

use Kirby\Cms\App;

// shamelessly borrowed from distantnative/retour-for-kirby
if (
	version_compare(App::version() ?? '0.0.0', '4.0.1', '<') === true ||
	version_compare(App::version() ?? '0.0.0', '6.0.0', '>=') === true
) {
	throw new Exception('Caption Files Support requires Kirby v4 or v5');
}

Kirby::plugin('scottboms/video-captions',
info: [
	'homepage' => 'https://github.com/scottboms/kirby-caption-files',
	'version' => '1.0.1',
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
