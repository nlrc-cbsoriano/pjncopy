import { defineConfig } from 'vite';
import react from '@vitejs/plugin-react';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        react(),
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.jsx'],
            refresh: true,
        }),
    ],
    build: {
        outDir: 'public/build', // Ensure that build files are output to the public directory
        rollupOptions: {
            input: {
                main: 'resources/js/app.jsx',
            },
        },
    },
});
