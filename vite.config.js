import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/assets/_painel/sass/app.scss',
                'resources/assets/_painel/js/app.js',
            ],
            refresh: true,
        }),
    ],
});
