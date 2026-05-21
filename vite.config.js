import { defineConfig, loadEnv } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

const env = loadEnv(process.env.NODE_ENV, __dirname, 'APP_URL');

export default defineConfig({
    server: {
        host: env.APP_URL ? new URL(env.APP_URL).hostname : undefined,
    },
    css: {
        transformer: 'lightningcss',
        lightningcss: {
            errorRecovery: true,
            targets: {
                firefox: 112, // transpile color-mix / oklch
            },
        }
    },
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js', 'resources/js/hls.js'],
            assets: ['resources/img/**'],
            refresh: true,
            detectTls: env.APP_URL && new URL(env.APP_URL).protocol === 'https:',
        }),
        tailwindcss(),
    ],
});
