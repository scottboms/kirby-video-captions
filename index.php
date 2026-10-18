<?php

/**
 * Caption Files Support for Kirby
 *
 * @author Scott Boms <plugins@scottboms.com>
 * @link https://github.com/scottboms/kirby-caption-files
 * @license MIT
**/

if (class_exists('Kirby\Panel\Ui\FilePreview') === false) {
	return;
}

load([
  'scottboms\CaptionFilePreview\CaptionFile' => __DIR__ . '/classes/CaptionFiles.php'
]);

use Kirby\Cms\App;
use Scottboms\CaptionFilePreview\CaptionFile;

$version = App::version() ?? '0.0.0';
if (
  version_compare($version, '6.0.0-beta.1', '<') ||
  version_compare($version, '7.0.0', '>=')
) {
  throw new Exception('Video Captions requires Kirby 6');
}

Kirby::plugin('scottboms/video-captions',
info: [
  'homepage' => 'https://github.com/scottboms/kirby-caption-files',
  'version' => '6.0.0',
  'license' => 'MIT',
  'authors' => [['name' => 'Scott Boms']]
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
  ],
  'filePreviews' => [
    CaptionFile::class
  ],
]);
