import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
                'resources/css/app.css',
                'resources/css/areset.css', 
                'resources/css/custom.css',
                'resources/js/custom.js',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
});
