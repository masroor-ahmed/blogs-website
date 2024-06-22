module.exports = {
    content: [
      './*.php',
      './admin/*.php',
      './blogs/*.php',
      './includes/*.php'
    ],
    theme: {
      extend: {
        colors: {
          primary: '#3498db',
          secondary: '#5bc0de',
          textDark: '#333333',
        },
      },
    },
    plugins: [
      require('@tailwindcss/typography'),
      require('@tailwindcss/forms'),
    ],
  }
  