const defaultTheme = require("tailwindcss/defaultTheme");

module.exports = {
    darkMode: "class",
    purge: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.vue",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Nunito", ...defaultTheme.fontFamily.sans],
            },
        },
    },

    variants: {
        extend: {
            opacity: ["disabled"],
            transform: ["active"],
            scale: ["active"],
            tableLayout: ["hover"],
        },
    },

    plugins: [require("@tailwindcss/forms")],
};
