import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import path from "path";

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
            valetTls: false,
            host: "blog.test",
        }),
    ],
    server: {
        host: "0.0.0.0",
        hmr: {
            host: "blog.test",
        },
        cors: true,
    },
    resolve: {
        alias: {
            "@": path.resolve(__dirname, "resources"),
        },
    },
});
