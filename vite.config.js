import { defineConfig, loadEnv } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

// Đưa các env sang node level -> có thể dùng được tại vite.config.js
// tham số đầu 'mock' của loadEnv vẫn chưa biết
process.env = {...process.env, ...loadEnv('mock', process.cwd())};

export default defineConfig({
    server: {
        // https: true,
        host: process.env.VITE_API_IP_HOST,
        // hrm for config WebSocket
        hmr: {
            // server: process.env.VITE_API_LARAVEL_ECHO_SERVER_URL,
            // clientPort: 6001,
            overlay: false
        },
    },
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
    resolve: {
        alias: {
            vue: 'vue/dist/vue.esm-bundler.js',
        },
    },
    define: {
        'process.env': {} // Chuyển import.meta.env sang process.env
    }
});
