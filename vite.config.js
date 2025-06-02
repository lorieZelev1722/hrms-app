import { defineConfig } from 'vite';
import vue from '@vitejs/plugin-vue';
import path from 'path';

export default defineConfig({
  plugins: [vue()],
  build: {
    manifest: true,   // Generate manifest.json
    outDir: path.resolve(__dirname, 'public/build'),  // Output assets to public/build directory
    assetsDir: 'assets', // Optional: Store static assets here
  },
  server: {
    proxy: {
      '/app': 'http://localhost',  // Optional: Proxy requests to backend during development
    }
  }
});
