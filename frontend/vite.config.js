import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'

export default defineConfig({
  plugins: [vue()],
  server: {
    proxy: {
      '/BackLogin': {
        target: 'http://127.0.0.1:8000',
        changeOrigin: true,
      },
      '/BackRegister': {
        target: 'http://127.0.0.1:8000',
        changeOrigin: true,
      },
      '/BackFeedback': {
        target: 'http://127.0.0.1:8000',
        changeOrigin: true,
      },
    },
  },
})