import { defineConfig } from 'vite';
import path from 'path';

export default defineConfig({
  root: path.resolve(__dirname, '.'),
  base: '/wp-content/themes/twentytwentyfive-child/',

  build: {
    outDir: 'build',
    emptyOutDir: true,
    manifest: true,
    rollupOptions: {
      input: {
        main: path.resolve(__dirname, 'src/main.js'),
      },
      output: {
        entryFileNames: 'main.js',
        assetFileNames: 'main.[ext]'
      }
    }
  },

  server: {
    hmr: {
      host: 'localhost'
    }
  }
});

