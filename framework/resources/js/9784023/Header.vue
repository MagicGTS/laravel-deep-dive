<template>
  <header class="header">
        <section class="search">
            <form action="#"><svg width="20" height="19">
                    <use href="img/search.svg#search"></use>
                </svg><input type="text" class="search-input"></form>
        </section>
        <section class="ribbon-top wrap padding-global">
            <nav class="nav">
                <ul class="nav-list">
                    <li class="nav-item">
                        <div class="nav-item__hower-wrap"><a href="" class="nav-link">Главная</a></div>
                    </li>
                    <li class="nav-item">
                        <div class="nav-item__hower-wrap nav-item__active"><a href="" class="nav-link">О&nbsp;центре</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <div class="nav-item__hower-wrap"><a href="" class="nav-link">Каталог&nbsp;услуг</a></div>
                    </li>
                    <li class="nav-item">
                        <div class="nav-item__hower-wrap"><a href="" class="nav-link">Цены</a></div>
                    </li>
                    <li class="nav-item">
                        <div class="nav-item__hower-wrap"><a href="" class="nav-link">Акции</a></div>
                    </li>
                    <li class="nav-item">
                        <div class="nav-item__hower-wrap"><a href="" class="nav-link">Новости</a></div>
                    </li>
                    <li class="nav-item">
                        <div class="nav-item__hower-wrap"><a href="" class="nav-link">Контакты</a></div>
                    </li>
                </ul>
            </nav>
            <section class="location">
                <p>г. Москва, ул. Монтажная, 3,<br> стр. 2, офис 25</p>
                <p>
                    <a href="#">
                        <svg width="10" height="10">
                            <use href="img/arrow-location.svg#arrow"></use>
                        </svg> Посмотреть на карте
                    </a>
                </p>
            </section>
            <section class="contacts">
                <p>Единый бесплатный номер</p>
                <p>8 (800) 201-16-70</p>
                <p>
                    <span class="btn-rnd_lb">
                        <a href="" class="btn-rnd_lb__link">
                            <span class="btn-rnd_lb__text">Обратный звонок</span>
                        </a>
                    </span>
                </p>
            </section>
        </section>
    </header>
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
.ribbon-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  flex-wrap: wrap;
  flex-grow: 1;
  padding-left: 13rem;
  & > * {
    align-self: stretch;
    margin-left: 0.5rem;
    margin-right: 0.5rem;
  }
}
.nav {
  &-list {
    list-style: none;
    display: flex;
    flex-wrap: wrap;
    margin: 0;
    padding: 0;
    height: 100%;
  }
  &-link {
    text-decoration: none;
    /* (@size: @textBaseSize; @lHeight: @textBaseLineHeight; @weight: @textBaseWeight; @ls: @textLS) */
    .fonts();
    color: @color_01;
    padding: 0.4em 0.625rem;
    display: inline-block;
  }

  &-item {
    margin: auto 0;
    height: 100%;
    &__active {
      background-color: @color_04;

      & a {
        color: @color_white;
        text-decoration: underline;
      }
    }
    &__hower-wrap {
      height: 100%;
      display: flex;
      align-items: center;
    }
    &:hover {
      background-color: @color_06;
      transition: 500ms;
      & a {
        color: @color_white;
      }
    }
  }
}
.search {
  color: @color_02;
  margin: 1em 1rem;
  /*position: absolute;
  top: 2em;
  left: 0;*/
  & form {
    display: flex;
    align-items: center;
    & svg {
      margin-right: 0.5rem;
    }
  }
  &-input {
    visibility: hidden;
    border: none;
    border-bottom: 0.0001rem solid @color_04;
    &:focus {
      outline: none;
    }
  }
  &:hover {
    color: @color_04;
    & .search-input {
      visibility: visible;
    }
  }
}
.location {
  margin-bottom: auto;
  margin-top: 1em;
  & p {
    .fonts();
    margin: 0.7em 0;
    color: @color_01;
    &:last-child {
      & a {
        color: @color_13;
        & svg {
          display: inline-block;
        }
        &:hover {
          color: @color_06;
          transition: 500ms;
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