<template>
	<figure class="k-default-file-preview k-caption-file-preview">
		<k-file-preview-frame>
			<caption-viewer :src="url" />
		</k-file-preview-frame>

		<k-file-preview-details :details="details" />
	</figure>
</template>

<script>
import CaptionViewer from './CaptionViewer.vue';

export default {
	name: 'KCaptionFilePreview',
	props: {
		details: Array,
		url: String
	},
	components: { CaptionViewer }
};
</script>
