<template>
	<div class="k-caption-viewer">
		<div v-if="loading" class="k-caption-viewer__state">Loading…</div>
		<div v-else-if="error" class="k-caption-viewer__state k-caption-viewer__state--error">{{ error }}</div>
		<pre v-else class="k-caption-viewer__pre" spellcheck="false">{{ text }}</pre>
		<div class="k-caption-viewer__footer">
			<k-button :link="src" icon="open" target="_blank">Open raw file</k-button>
		</div>
	</div>
</template>

<script>
export default {
	name: 'CaptionViewer',
	props: {
		src: { type: String, required: true }
	},
	data() {
		return {
			text: '',
			loading: false,
			error: null
		};
	},
	watch: {
		src: {
			immediate: true,
			handler() { this.load(); }
		}
	},
	methods: {
		async load() {
			this.loading = true;
			this.error = null;
			this.text = '';

			try {
				const res = await fetch(this.src, { credentials: 'same-origin' });
				if (!res.ok) throw new Error(`HTTP ${res.status}`);
				let raw = await res.text();
				raw = raw.replace(/^\uFEFF/, '').replace(/\r\n?/g, '\n'); // trim bom + normalize
				raw = raw.replace(/\n{3,}/g, '\n\n'); // collapse long blank runs
				this.text = raw;
			} catch (e) {
				this.error = `Error loading captions (${e.message})`;
			} finally {
				this.loading = false;
			}
		}
	}
};
</script>

<style scoped>
.k-caption-viewer {
	display: flex;
	flex-direction: column;
	gap: var(--spacing-2);
	height: 100%;
}

.k-caption-viewer__pre {
	flex: 1 1 auto;
	overflow: auto;
	padding: var(--spacing-4);
	border-radius: var(--rounded-md);
	box-shadow: var(--shadow-md);
	background: var(--color-gray-100);
	color: var(--color-gray-900);
	font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", monospace;
	font-size: var(--text-sm);
	line-height: 1.45;
	white-space: pre-wrap; /* wrap long lines */
	word-break: break-word;
}

.k-caption-viewer__state {
	padding: var(--spacing-4);
	border-radius: var(--rounded-md);
	box-shadow: var(--shadow-md);
	color: var(--color-text-dimmed);
}

.k-caption-viewer__state--error {
	color: var(--color-negative-700);
	border-color: var(--color-negative-400);
	background: var(--color-negative-50);
}

.k-caption-viewer__footer {
	display: flex;
	justify-content: flex-end;
}
</style>
