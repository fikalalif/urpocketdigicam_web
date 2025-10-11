import {
    defineConfig
} from "vite";
import laravel from "laravel-vite-plugin";
import tailwindcss from "@tailwindcss/vite";
import path from 'path';

export default defineConfig({
    // theme: {
    //     extend: {
    //         backgroundImage: {
    //             "hero-watch": "url('storage/images/hero-watch.jpg')",
    //         },
    //     },
    // },
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),
        tailwindcss(),
    ],

    build: {
        manifest: true,
        outDir: 'public/build',
        rollupOptions: {
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
        },
    },
    server: {
        cors: true,
    },
    resolve: {
        alias: {
            '~': path.resolve(__dirname, './'),
        },
    },
});
