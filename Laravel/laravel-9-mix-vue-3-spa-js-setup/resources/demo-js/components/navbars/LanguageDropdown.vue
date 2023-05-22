<template>
  <li v-if="Object.keys(Locales).length > 1" class="nav-item dropdown mt-3 mt-lg-0">
    <a class="nav-link dropdown-toggle active" href="#" id="LanguageDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
      <i class="fa-solid fa-globe"></i> <span class="text-light d-lg-none d-xl-inline">{{ $t("message.language") }} :</span> {{ Locales[Locale] }}
    </a>
    <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end" aria-labelledby="LanguageDropdown">
      <li v-for="(value, key) in Locales" :key="key">
        <a class="dropdown-item" href="#" @click.prevent="setLocale(key)">{{ value }}</a>
      </li>
    </ul>
  </li>
</template>

<script setup>
import { useLangStore } from "@/stores/langStore";
import { storeToRefs } from "pinia";

const lang = useLangStore();

const { Locale, Locales } = storeToRefs(lang);

function setLocale(locale) {
  lang.setLocale(locale);
  window.location.reload(true);
}

</script>

<style lang="scss" scoped></style>
