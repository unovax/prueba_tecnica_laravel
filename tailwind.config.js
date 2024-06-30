import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: {
                    DEFAULT: '#261447',
                    hover: '#190D30'
                },
                secondary: {
                    DEFAULT: '#D5DFE5',
                    hover: '#C0CFD8'
                },
                topbar: "#100821",
                sidebar: {
                    DEFAULT: '#100821',
                    hover: '#080410'
                },
                danger: {
                    DEFAULT: '#E3342F',
                    hover: '#CC1F1A'
                },
                success: {
                    DEFAULT: '#38C172',
                    hover: '#2F9E66'
                },
            }
        },
    },

    plugins: [forms, typography],
};
