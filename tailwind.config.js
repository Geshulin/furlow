import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            colors: {
              furlow: {
                ink: '#1F3A2E',
                bg: '#F2F5EE',
                accent: '#E8A33D',
                'accent-ink': '#5C3B0E',
                teal: '#6E9B8F',
                blob: '#FBDFC0',
                body: '#4B5A50',
            },
        },
        fontFamily: {
            sans: ['Work Sans', ...defaultTheme.fontFamily.sans],
            display: ['Fraunces', 'serif'],
        },
    },
    },

    plugins: [forms],
};
