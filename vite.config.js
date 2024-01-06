import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import Icons from 'unplugin-icons/vite'

export default defineConfig({
  plugins: [
    laravel({
      input: [
        'resources/sass/app.scss',
        'resources/js/app.js',
      ],
      refresh: true,
    }),
    Icons({ autoInstall: true, }),
  ],
  resolve: {
    alias: {
      '$': 'jQuery'
    },
  },
});
