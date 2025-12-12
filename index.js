import { resolveComponent as s, createElementBlock as o, openBlock as i, createElementVNode as k, toDisplayString as _, createVNode as a, withCtx as p, createTextVNode as v } from "vue";
const d = (t, e) => {
  const r = t.__vccOpts || t;
  for (const [c, n] of e)
    r[c] = n;
  return r;
}, m = {
  name: "CaptionViewer",
  props: {
    src: { type: String, required: !0 }
  },
  data() {
    return {
      text: "",
      loading: !1,
      error: null
    };
  },
  watch: {
    src: {
      immediate: !0,
      handler() {
        this.load();
      }
    }
  },
  methods: {
    async load() {
      this.loading = !0, this.error = null, this.text = "";
      try {
        const t = await fetch(this.src, { credentials: "same-origin" });
        if (!t.ok) throw new Error(`HTTP ${t.status}`);
        let e = await t.text();
        e = e.replace(/^\uFEFF/, "").replace(/\r\n?/g, `
`), e = e.replace(/\n{3,}/g, `

`), this.text = e;
      } catch (t) {
        this.error = `Error loading captions (${t.message})`;
      } finally {
        this.loading = !1;
      }
    }
  }
}, h = { class: "k-caption-viewer" }, g = {
  key: 0,
  class: "k-caption-viewer__state"
}, x = {
  key: 1,
  class: "k-caption-viewer__state k-caption-viewer__state--error"
}, y = {
  key: 2,
  class: "k-caption-viewer__pre",
  spellcheck: "false"
}, C = { class: "k-caption-viewer__footer" };
function $(t, e, r, c, n, f) {
  const l = s("k-button");
  return i(), o("div", h, [
    n.loading ? (i(), o("div", g, "Loading…")) : n.error ? (i(), o(
      "div",
      x,
      _(n.error),
      1
      /* TEXT */
    )) : (i(), o(
      "pre",
      y,
      _(n.text),
      1
      /* TEXT */
    )),
    k("div", C, [
      a(l, {
        link: r.src,
        icon: "open",
        target: "_blank"
      }, {
        default: p(() => [...e[0] || (e[0] = [
          v(
            "Open raw file",
            -1
            /* CACHED */
          )
        ])]),
        _: 1
        /* STABLE */
      }, 8, ["link"])
    ])
  ]);
}
const E = /* @__PURE__ */ d(m, [["render", $], ["__scopeId", "data-v-f051a2dc"]]), F = {
  name: "KCaptionFilePreview",
  props: {
    details: Array,
    url: String
  },
  components: { CaptionViewer: E }
}, V = { class: "k-default-file-preview k-caption-file-preview" };
function b(t, e, r, c, n, f) {
  const l = s("caption-viewer"), u = s("k-file-preview-frame"), w = s("k-file-preview-details");
  return i(), o("figure", V, [
    a(u, null, {
      default: p(() => [
        a(l, { src: r.url }, null, 8, ["src"])
      ]),
      _: 1
      /* STABLE */
    }),
    a(w, { details: r.details }, null, 8, ["details"])
  ]);
}
const N = /* @__PURE__ */ d(F, [["render", b]]);
panel.plugin("scottboms/video-captions", {
  components: {
    "k-caption-file-preview": N
  }
});
