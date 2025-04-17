import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    server: {
        host: '0.0.0.0',         // aceita conexões externas (do Laravel)
        port: 5173,
        strictPort: true,
        watch: {
            usePolling: true,
        }
    },
    plugins: [
        laravel({
            input: ['resources/js/app.js'],
            refresh: true,
        }),
    ],
});
