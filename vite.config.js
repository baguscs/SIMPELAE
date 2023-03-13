import { defineConfig } from "vite";
import laravel, { refreshPaths } from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/js/app.js",
                "public/assets/vendor/fonts/boxicons.css",
                "public/assets/vendor/css/core.css",
                "public/assets/vendor/css/theme-default.css",
                "public/assets/css/demo.css",
                "public/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css",
                "public/assets/vendor/libs/apex-charts/apex-charts.css",
                "public/assets/vendor/js/helpers.js",
                "public/assets/js/config.js",
                "public/assets/vendor/libs/jquery/jquery.js",
                "public/assets/vendor/libs/popper/popper.js",
                "public/assets/vendor/js/bootstrap.js",
                "public/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js",
                "public/assets/vendor/js/menu.js",
                "public/assets/js/dashboards-analytics.js",
            ],
            refresh: [...refreshPaths, "app/Http/Livewire/**"],
        }),
    ],
});
