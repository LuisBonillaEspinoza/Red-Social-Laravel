/** @type {import('tailwindcss').Config} */
module.exports = {
  // Donde van las vistas que usaran tailwindcss
  content: [
    // "./resources/views/app/navbar.blade.php"
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}
