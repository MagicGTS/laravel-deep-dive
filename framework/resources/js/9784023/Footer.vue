<template>
  <footer class="footer">
        <section class="footer-top-ribbon">
            <div class="footer-top-ribbon-wrap wrap padding-global">
                <address class="address">
                    <h1>Контакты</h1>
                    <p>107497, г. Москва, ул. Монтажная д.3, стр.2, офис 25.</p>
                    <p>м. Щелковская (первый вагон из центра).</p>
                    <p>Автобус №3 или №627 (остановка «Тарная фабрика»).</p>
                </address>
                <section class="map"><img :src="require('../../img/gmap.png').default"></section>
            </div>
        </section>
        <section class="footer-midle-ribbon">
            <div class="footer-midle-ribbon-wrap wrap padding-global">
            </div>
        </section>
        <section class="footer-bottom-ribbon">
            <div class="footer-bottom-ribbon-wrap wrap padding-global">
            </div>
        </section>
    </footer>
</template>
<style lang="less" scoped>

/* Variables */
/* Colors */
@text_fs: 0.75em;
@text_lh: 0.875em;
@text_w: normal;
@text_ls: normal;
@color_01: #67697e;
@color_02: #6f7185;
@color_04: #269eb7;
@color_05: #ecf0f3;
@color_06: #94cfdb;
@color_10: #ecf0f3;
@color_13: #269eb7;
@color_white: #ffffff;

.fonts(@fs: @text_fs; @lh: @text_lh; @w: @text_w; @ls: @text_ls) {
  font-size: @fs;
  line-height: @lh;
  font-weight: @w;
  letter-spacing: @ls;
}
.btn {
  &-rnd_lb {
    @btn_h: 1.2em;
    @lh: 1em;
    @fs: 0.9em;
    @bor_th: 0.001rem;
    @color_t: @color_white;
    @color_back: @color_04;
    @color_t__focus: @color_white;
    @color_back_focus: @color_06;
    @bor_rad: 0.4rem;
    @pad_txt: 0.6em 1.1rem;
    height: @btn_h;
    display: inline-block;
    & a {
      text-decoration: none;
      padding: @pad_txt;
    }

    &__text {
      color: @color_t;
      .fonts(@fs; @lh; 500; normal);
    }

    &__link {
      display: inline;
      background-color: @color_back;
      position: relative;
      border-radius: @bor_rad;

      &:hover {
        transition: 100ms;
        background-color: @color_back_focus;

        & .btn-rnd_lb__text {
          color: @color_t__focus;
        }
      }
    }
  }
  }
.header {
  background-color: @color_10;
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  background-color: @color_05;
  width: 100%;
  & .ribbon-top {
    padding-left: 0;
    margin-left: 0;
  }
  .contacts {
    & p {
      margin: 0 0 0.5em 0;
      padding-top: 0.5em;
      padding-bottom: 0.2em;
      color: @color_01;
      .fonts();
      text-align: right;
      &:nth-child(2) {
        .fonts(1.5em; 0.4em; 700);
        color: @color_04;

        &:hover {
          color: @color_06;
          transition: 500ms;
        }
      }
    }
  }
}

.footer {
  &-top-ribbon {
    &-wrap {
      .address {
        h1 {
          .fonts(2.101em; 1.19em; 700);
        }
      }
    }
  }
}
</style>
<script>
import { defineComponent } from "vue";
import { Head, Link } from "@inertiajs/inertia-vue3";

export default defineComponent({
  components: {
    Head,
    Link,
  },
});
</script>