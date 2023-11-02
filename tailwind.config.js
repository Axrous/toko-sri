module.exports = {
  darkMode: "class",
  content: ["./**/*.{html,js,php}"],
  theme: {
    extend: {},
  },
  plugins: [require("@tailwindcss/forms"), require("@tailwindcss/typography")],
};
