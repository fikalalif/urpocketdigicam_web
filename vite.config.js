import {
    defineConfig
} from "vite";
import laravel from "laravel-vite-plugin";
import tailwindcss from "@tailwindcss/vite";
import path from "path";

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),
        tailwindcss(),
    ],
    build: {
        outDir: 'api/public/build',
        manifest: 'manifest.json',
        emptyOutDir: true,
        rollupOptions: {
            input: ['resources/css/app.css', 'resources/js/app.js'],
        },
    },

    server: {
        cors: true,
    },
    resolve: {
        alias: {
            "~": path.resolve(__dirname, "./"),
        },
    },
});
