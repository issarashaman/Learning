import { fileURLToPath, URL } from 'url'

import { defineConfig } from 'vite';
import vue from '@vitejs/plugin-vue'
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        vue(),
        laravel([
            //'resources/sass/main.scss',
            //'resources/scripts/main.js',
            { config: 'back-office' },
        ]),
    ],
    resolve: {
        alias: {
            '@': fileURLToPath(new URL('./resources/scripts', import.meta.url))
        },
    },
});
