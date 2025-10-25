import flowbite from "flowbite/plugin";
// import { initFlowbite } from "flowbite";

export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./node_modules/flowbite/**/*.js"
  ],
  theme: {
    extend: {},
  },
  plugins: [
    require('@tailwindcss/typography'),
    flowbite,
    // initFlowbite,
  ],
}
