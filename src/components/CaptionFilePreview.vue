<template>
  <figure class="k-default-file-preview k-caption-file-preview">
    <k-file-preview-frame>
      <CaptionViewer :src="url" />
    </k-file-preview-frame>

    <k-file-preview-details :details="details" />
  </figure>
</template>

<script>
import CaptionViewer from "./CaptionViewer.vue";

export default {
  name: "KCaptionFilePreview",

  components: {
    CaptionViewer
  },

  props: {
    details: {
      type: Array,
      default: () => []
    },
    url: {
      type: String,
      required: true
    }
  }
};
</script>

<style>
.k-caption-file-preview {
  width: 100%;
  min-width: 0;
  max-width: 100%;
}

.k-caption-file-preview .k-file-preview-frame {
  width: 100%;
  min-width: 0;
  max-width: 100%;
  height: clamp(300px, 50vh, 600px);
  aspect-ratio: auto;
  overflow: hidden;
}

.k-caption-file-preview .k-caption-viewer {
  display: flex;
  flex-direction: column;
  width: 100%;
  min-width: 0;
  height: 100%;
  min-height: 0;
  overflow: hidden;
}

.k-caption-file-preview .k-caption-viewer__pre {
  flex: 1 1 auto;
  min-width: 0;
  min-height: 0;
  max-width: 100%;
  overflow: auto;
  overflow-wrap: anywhere;
}

.k-caption-file-preview .k-caption-viewer__footer {
  flex: 0 0 auto;
}
</style>