import { defineConfig } from 'vite';
import laravel, { refreshPaths } from "laravel-vite-plugin";
// import react from '@vitejs/plugin-react';
// import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/sass/app.scss",
                "resources/js/app.js",
                "resources/css/app.css",
                "resources/js/blade-app.js",
                // "resources/css/output.css"
                
            ],
            refresh: [
                ...refreshPaths,
                "app/Http/Livewire/**",
                "app/Forms/Components/**",
                'app/Tables/Columns/**',
            ],
        }),
        {
            name: 'blade',
            handleHotUpdate({ file, server }) {
                if (file.endsWith('.blade.php')) {
                    server.ws.send({
                        type: 'full-reload',
                        path: '*',
                    });
                }
            },
        }
    ],
    resolve: {
        alias: {
            '@': '/resources/js'
        }
    },
    server: {
        hmr: {
            host: 'localhost',
        },
        watch: {
            usePolling: true
        }
    },
    base:'https://testfb.lalachante.fr/teamfb'
});