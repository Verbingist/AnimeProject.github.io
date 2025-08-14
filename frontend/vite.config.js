import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'

export default defineConfig({
  plugins: [vue()],
  server: {
    proxy: {
      '/Register': {
        target: 'http://127.0.0.1:8000',
        changeOrigin: true
      },
      '/Login': {
        target: 'http://127.0.0.1:8000',
        changeOrigin: true
      },
      '/getPageOfFeedbacks': {
        target: 'http://127.0.0.1:8000',
        changeOrigin: true
      },
      '/addFeedback': {
        target: 'http://127.0.0.1:8000',
        changeOrigin: true
      },
      '/deleteFeedback': {
        target: 'http://127.0.0.1:8000',
        changeOrigin: true
      },
      '/updateFeedback': {
        target: 'http://127.0.0.1:8000',
        changeOrigin: true
      },
      '/getList': {
        target: 'http://127.0.0.1:8000',
        changeOrigin: true
      }
    }
  }
})
