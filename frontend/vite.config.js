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
      '/BackAddFeedback': {
        target: 'http://127.0.0.1:8000',
        changeOrigin: true,
      },
      '/BackUpdateFeedback': {
        target: 'http://127.0.0.1:8000',
        changeOrigin: true,
      },
      '/BackDeleteFeedback': {
        target: 'http://127.0.0.1:8000',
        changeOrigin: true,
      },
      '/BackGetLogins': {
        target: 'http://127.0.0.1:8000',
        changeOrigin: true,
      },
      '/BackGetPageOfFeedbacks': {
        target: 'http://127.0.0.1:8000',
        changeOrigin: true,
      },
      '/BackGetProjects': {
        target: 'http://127.0.0.1:8000',
        changeOrigin: true,
      },
    },
  },
})