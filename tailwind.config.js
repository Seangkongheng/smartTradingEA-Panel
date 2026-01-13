/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./resources/**/*.html",
        "./resources/**/*.php",
        './Modules/**/resources/**/*.blade.php',
    ],
    theme: {
        extend: {
            colors: {
                customGray: 'rgb(59, 130, 246)',
            },
            zIndex: {
                 49: '49',
            }
        },
    },
    plugins: [],
}

