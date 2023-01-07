import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
// import fs from 'fs';

// const host = 'localhost'; 
export default defineConfig({
    plugins: [
        laravel({
            input: 'resources/js/app.js',
            ssr: 'resources/js/ssr.js',
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
    ssr: {
        noExternal: ['@inertiajs/server'],
    },
    // server: { 
    //     host, 
    //     hmr: { host }, 
    //     https: { 
    //         key: fs.readFileSync('C:/SSL/bin/server.key'),
    //         cert: fs.readFileSync('C:/SSL/bin/server.crt'), 
    //     }, 
    // }, 
});

