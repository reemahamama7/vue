/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            backgroundImage: {
                hero: "url('/public/img/hero.jpg')", // Use a relative path to the image
                footer: "url('/public/img/footer.png')",
            },
            colors: {
                green: "#07C961",
                babyblue: "#4B93D0",
                gray: "#F6F6F6",
                boldgray: " #3F3631",
                purple1: " #A34D9F",

                pink1: "#275FD0",
                gray2: "#C4C4C4",
                lwhite: " #FBFBFB",
                lgray: " #A4A4A5",
            },
        },
    },
    plugins: [],
};
