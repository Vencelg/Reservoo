/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./node_modules/flowbite/**/*.js",
    ],
  theme: {
    extend: {
        backgroundImage: {
            'image-auth': "url(http://localhost/images/auth-bg.png)",
            'image-main': "url(http://localhost/images/main-bg.png)",
        }
    },
  },
  plugins: [
      require('flowbite/plugin')
  ],
}

