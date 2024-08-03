/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./components/**/*.{js,vue,ts}",
    "./layouts/**/*.vue",
    "./pages/**/*.vue",
    "./plugins/**/*.{js,ts}",
    "./app.vue",
    "./error.vue"
  ],
  theme: {
    extend: {
      fontFamily: {
        'nunito': ['nunito', 'sans-serif'],
      },
      colors: {
        'lottery-yellow': {
          50: '#F9F7F1',
          100: '#F3F0E0',
          200: '#E9E0B9',
          300: '#D7D08F',
          400: '#BFB85C',
          500: '#F6F0C6', // Base color
          600: '#D6D3A3',
          700: '#B4B27A',
          800: '#8A8B48',
          900: '#5F5F1F',
          950: '#3E3E12',
        },
        // Define other colors similarly
        'lottery-green': {
          50: '#F0F6F1',
          100: '#D9E5D5',
          200: '#B2D4B4',
          300: '#8AC28E',
          400: '#5DAC6C',
          500: '#A5D9C8', // Base color
          600: '#8AC2A8',
          700: '#6F9E8A',
          800: '#4F7C68',
          900: '#2F5A4C',
          950: '#1E3B31',
        },
        'lottery-gray': {
          50: '#F9F9F9',
          100: '#F2F2F2',
          200: '#E0E0E0',
          300: '#C6C6C6',
          400: '#A8A8A8',
          500: '#F2F2F2', // Base color
          600: '#B8B8B8',
          700: '#8E8E8E',
          800: '#6C6C6C',
          900: '#4A4A4A',
          950: '#2D2D2D',
        },
        'lottery-blue': {
          50: '#E6E7F0',
          100: '#BCC0E4',
          200: '#8B9BDF',
          300: '#4A6FD9',
          400: '#0F3F8F',
          500: '#020056', // Base color
          600: '#010043',
          700: '#010033',
          800: '#000823',
          900: '#000515',
          950: '#000309',
        },
      },
    },
  },
}

