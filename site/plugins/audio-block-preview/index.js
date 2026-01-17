panel.plugin("plb/audio-block-preview", {
  blocks: {
    audio: {
      data() {
        return {
          mime: null,
        };
      },
      computed: {
        poster() {
          return (this.content.poster && this.content.poster[0]) || {};
        },
        source() {
          return (this.content.source && this.content.source[0]) || {};
        },
        title() {
          return (this.content.title || "").trim();
        }
      },
      watch: {
        "source.link": {
          handler(link) {
            if (!link) {
              this.mime = null;
              return;
            }

            this.$api.get(link).then((file) => {
              this.mime = file.mime || null;
            });
          },
          immediate: true,
        },
      },
      template: `
        <k-block-figure
          :is-empty="!source.url"
          empty-icon="audio-file"
          empty-text="Keine Audiodatei ausgewählt …"
          @open="open"
          @update="update"
        >
          <div class="k-block-type-audio-preview">
            <k-aspect-ratio
              v-if="poster.url"
              class="k-block-type-audio-preview__poster"
              ratio="1/1"
              cover="true"
            >
              <img :src="poster.url" :alt="title" />
            </k-aspect-ratio>

            <div class="k-block-type-audio-preview__body">
              <div class="k-block-type-audio-preview__title">
                {{ title || 'Audio' }}
              </div>

              <audio
                v-if="source.url"
                class="k-block-type-audio-preview__player"
                controls
              >
                <source :src="source.url" :type="mime || 'audio/mpeg'" />
              </audio>
            </div>
          </div>
        </k-block-figure>
      `,
    },
  },
});
