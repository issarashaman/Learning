import { fileURLToPath, URL } from 'url'

import { defineConfig } from 'vite';
import vue from '@vitejs/plugin-vue'
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        vue(),
        laravel([
            //'resources/sass/app.scss',
            //'resources/js/app.js',
            { config: 'default' },
        ]),
    ],
    resolve: {
        alias: {
            '@': fileURLToPath(new URL('./resources/js', import.meta.url)),
        },
    },
});
