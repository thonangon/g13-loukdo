import { fileURLToPath, URL } from 'node:url'
import { defineConfig } from 'vite';
import vue from '@vitejs/plugin-vue';
import vueJsx from '@vitejs/plugin-vue-jsx'
import VueDevTools from 'vite-plugin-vue-devtools'
import UnoCSS from 'unocss/vite';

export default defineConfig({
  plugins: [
    vue(),
    vueJsx(),
    VueDevTools(),
    UnoCSS()
  ],
  resolve: {
    alias: {
      '@': fileURLToPath(new URL('./src', import.meta.url))
    }
  },
  server: {
    historyApiFallback: true,
    allowedHosts: ['eba6-202-56-2-118.ngrok-free.app']
  }
})
