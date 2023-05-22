import { createI18n } from "vue-i18n";
import locales from "./locales";

const messages = locales;

const currentLocale = localStorage.getItem("locale");

const i18n = createI18n({
  locale: currentLocale,
  messages: messages,
});

export default i18n;
