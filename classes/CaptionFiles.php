<?php

namespace Scottboms\CaptionFilePreview;

use Kirby\Cms\File;
use Kirby\Panel\Ui\FilePreview;

class CaptionFile extends FilePreview
{
	public function __construct(
		public File $file,
		public string $component = 'k-caption-file-preview'
	) {
	}

	public static function accepts(File $file): bool
	{
		// only accept .vtt and .srt (case-insensitive)
		return in_array(strtolower($file->extension()), ['vtt', 'srt'], true);
	}

	public function details(): array
	{
		return [
			...parent::details(),
		];
	}

	public function props(): array
	{
		return [
			...parent::props(),
		];
	}

	/**
	 * mount vue component, props are available
	 * as `url` and `details`.
	 */
	public function preview(): string
	{
		// return html for your custom preview in the panel
		return '<k-caption-file-preview :details="details" :url="url"></k-caption-file-preview>';
	}

}
