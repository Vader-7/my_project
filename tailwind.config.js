/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./assets/**/*.js",
    "./templates/**/*.html.twig",
  ],
  theme: {
    container: {
      center: true,
      padding: {
        DEFAULT: '2rem',
        sm: '7rem',
        lg: '12rem',
        xl: '17rem',
        '2xl': '20rem',
      },
    },
    extend: {
    },
  },
  plugins: [],
}
