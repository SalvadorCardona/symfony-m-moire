import * as path from 'path'
import {defineConfig} from 'vite'
import vue from '@vitejs/plugin-vue'
import pkg from './package.json'
import { resolve } from 'path';

const twigRefreshPlugin = {
    name: 'twig-refresh',
    configureServer({watcher, ws}) {
        watcher.add(resolve('../templates/**/*.twig'));
        watcher.on('change', function (path) {
            if (path.endsWith('.twig')) {
                ws.send({
                    type: 'full-reload'
                });
            }
        });
    }
}

process.env.VITE_APP_VERSION = pkg.version
if (process.env.NODE_ENV === 'production') {
    process.env.VITE_APP_BUILD_EPOCH = new Date().getTime().toString()
}

export default defineConfig({
    root: './assets',
    base: '/assets/',
    plugins: [
        twigRefreshPlugin,
        vue({
            script: {
                refSugar: true,
            },
        }),
    ],
    server: {
        watch: {
            disableGlobbing: false
        },
        hmr: {
            protocol: 'ws',
            host: 'localhost'
        }
    },
    resolve: {
        alias: {
            '@': path.resolve(__dirname, './assets'),
        },
    },
    build: {
    manifest: true,
        assetsDir: '',
        outDir: '../public/assets/',
        rollupOptions: {
        output: {
            manualChunks: undefined
        },
        input: {
            'main.ts': './assets/main.ts'
        }
    }
}
})

