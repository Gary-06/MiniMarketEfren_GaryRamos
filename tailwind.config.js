/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./public/*/.{html,js,php}"],
  theme: {
    extend: {},
  },
  plugins: [ require('@tailwindcss/typography'),
    require('@tailwindcss/forms'),],
}

