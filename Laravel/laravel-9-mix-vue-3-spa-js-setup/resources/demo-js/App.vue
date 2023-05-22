<script setup>
import { RouterView } from "vue-router";
import { getCurrentInstance } from "vue";

import IconSVG from "@/components/icons/IconSVG.vue";

const internalInstance = getCurrentInstance();

//  [App.vue specific] When App.vue is first loaded start the progress bar
internalInstance.appContext.config.globalProperties.$Progress.start();
</script>

<template>
  <transition name="layout" mode="out-in">
    <component :is="$route.meta.layout ?? 'layout-default'">
      <router-view v-slot="{ Component }">
        <transition name="route" mode="out-in">
          <component :is="Component" />
        </transition>
      </router-view>
      <vue-progress-bar></vue-progress-bar>
      <IconSVG />
    </component>
  </transition>
</template>

<style>
@import "@/assets/css/base.css";
</style>
