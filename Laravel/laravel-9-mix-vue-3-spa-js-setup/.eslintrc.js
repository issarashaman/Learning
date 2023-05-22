/* eslint-env node */
module.exports = {
  root: true,
  extends: ["plugin:vue/vue3-essential", "eslint:recommended"],
  env: {
    "vue/setup-compiler-macros": true,
  },
  rules: {
    quotes: ["error", "double"],
    semi: ["error", "always"],
    "vue/multi-word-component-names": 0
  },
};
