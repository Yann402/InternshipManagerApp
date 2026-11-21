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
            fontFamily: {
                sans: ['"IBM Plex Sans"', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                pine: { 50: '#EEF5F4', 100: '#D5E6E3', 600: '#1A6159', 700: '#134E4A', 800: '#0F3F3C', 900: '#0B302E' },
                ink: '#1B2321',
                paper: '#F5F7F6',
                line: '#DDE4E1',
                muted: '#5F6B67',
            },
        },
    },

    plugins: [forms],
};
