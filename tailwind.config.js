const defaultTheme = require("tailwindcss/defaultTheme");

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./vendor/laravel/jetstream/**/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./node_modules/tw-elements/dist/js/**/*.js",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Inter var", "Nunito", ...defaultTheme.fontFamily.sans],
            },
            colors: {
                "cool-gray": {
                    50: "#f8fafc",
                    100: "#f1f5f9",
                    200: "#e2e8f0",
                    300: "#cfd8e3",
                    400: "#97a6ba",
                    500: "#64748b",
                    600: "#475569",
                    700: "#364152",
                    800: "#27303f",
                    900: "#1a202e",
                },
            },
        },
    },
    corePlugins: {
        aspectRatio: false,
    },
    plugins: [
        require("@tailwindcss/forms"),
        require("@tailwindcss/typography"),
        require("@tailwindcss/aspect-ratio"),
        require("tw-elements/dist/plugin"),
    ],
};
