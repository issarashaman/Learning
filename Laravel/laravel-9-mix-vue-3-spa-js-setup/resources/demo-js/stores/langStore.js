import { defineStore } from "pinia";

const { locale, locales } = window.configs;

export const useLangStore = defineStore({
  id: "langStore",
  state: () => ({
    locale: getLocale(locales, locale),
    locales: locales
  }),
  getters: {
    Locale: (state) => state.locale,
    Locales: (state) => state.locales
  },
  actions: {
    setLocale (locale) {
      this.locale = locale;
  
      localStorage.setItem("locale", locale);
    }
  }
});

/**
 * @param  {String[]} locales
 * @param  {String} fallback
 * @return {String}
 */
 function getLocale (locales, fallback) {
  const locale = localStorage.getItem("locale");

  if (Object.prototype.hasOwnProperty.call(locales, locale)) {
    return locale;
  } else if (locale) {
    localStorage.removeItem("locale");
  }

  return fallback;
}
