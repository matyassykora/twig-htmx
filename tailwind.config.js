/** @type {import('tailwindcss').Config} */
const plugin = require('tailwindcss/plugin');
module.exports = {
  darkMode: "class",
  content: ["./src/views/**/*.{html,twig}"],
  theme: {
    extend: {},
  },
  plugins: [
       plugin(function({ addVariant }) {
            addVariant('current', '&.active');
            addVariant('current', '&.disabled');
        }),
  ],
}

