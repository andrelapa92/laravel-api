import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    base: 'https://laravel-api-production-8fd5.up.railway.app/', // Ajuste para o domínio do Railway
    server: {
        host: '0.0.0.0', // Aceita conexões externas (do Laravel)
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
