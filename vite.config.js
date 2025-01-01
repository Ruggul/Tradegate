import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js'
            ],
            refresh: [
                'resources/views/admin/**/*.blade.php',
            ],
        }),
    ],
    server: {
        hmr: true,
        watch: {
            usePolling: false,
        },
    },
    build: {
        outDir: 'public/build',
        manifest: true
    }
});