import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'
import pkg from './package.json'
import path from 'path'
import svgLoader from 'vite-svg-loader'

process.env.VITE_APP_VERSION = pkg.version
if (process.env.NODE_ENV === 'production') {
  process.env.VITE_APP_BUILD_EPOCH = new Date().getTime().toString()
}

export default defineConfig({
  plugins: [
    svgLoader({
      svgo: false,
    }),
    vue({
      script: {
        refSugar: true,
      },
    }),
  ],
  root: 'assets',
  resolve: {
    alias: {
      '@': path.resolve(__dirname, './assets'),
    },
  },
  server: {
    hmr: {
      protocol: 'ws',
      host: 'localhost',
      port: 4000
    },
    host: '0.0.0.0',
    port: 3000
  },
  build: {
    manifest: true,
    assetsDir: '',
    outDir: './../public/assets/',
    rollupOptions: {
      output: {
        manualChunks: undefined,
      },
      input: {
        'main.ts': './assets/main.ts',
      },
    },
  },
})