/** @type {import('tailwindcss').Config} */

module.exports = {
  content: [
    'dashboard-seller.php',
    'templates/client/products/products.php',
    'templates/client/products/add-product.php',
    'templates/client/orders.php',
    'assets/client/js/add-product.js'
  ],
  theme: {
    extend: {
      colors: {
        'primary': '#fda701',
        'secondary': '#252e49',
        'back': '#f6f4e7',
        'paragraph': '#606060',
        'dark-gray': '#808080',
        'gray': '#ccc',
        'lite-gray': '#D9D9D9',
      },
      fontSize: {
        'xxs': '10px',
      },
      transitionDuration: {
        DEFAULT: '300ms'
      }
    }
  },
  plugins: [],
}