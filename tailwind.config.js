/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    screens: {
      'tel': '320px',
      'telL': '375px',
      'telxl': '500px',
      'sm': '640px',
      'md': '768px',
      'lg': '1020px',
      'xl': '1280px',
      '1xl': '1329px',
      '2xl': '1536px',
      '4k': '2560px',
    },
    extend: {},
  },
  plugins: [require("daisyui")],
}

