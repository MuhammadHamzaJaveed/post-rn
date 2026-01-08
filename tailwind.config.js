const defaultTheme = require('tailwindcss/defaultTheme');
const colors = require('tailwindcss/colors');

function withOpacityValue(variable) {
    return ({ opacityValue }) => {
        if (opacityValue === undefined) {
            return `rgb(var(${variable}))`
        }
        return `rgb(var(${variable}) / ${opacityValue})`
    }
}

/** @type {import('tailwindcss').Config} */
module.exports = {
    presets: [
        require('./vendor/wireui/wireui/tailwind.config.js')
    ],
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',

        './vendor/wireui/wireui/resources/**/*.blade.php',
        './vendor/wireui/wireui/ts/**/*.ts',
        './vendor/wireui/wireui/src/View/**/*.php',
        './vendor/filament/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
                poppins: ['Poppins', 'sans-serif'],
                inter: ['Inter', 'sans-serif']
            },
            colors: {
                    primary: colors.blue,
                    secondary: colors.gray,
                    positive: colors.emerald,
                    negative: {
                            DEFAULT: '#D50000',
                                50: '#ffe5e5',
                                100: '#ffd6d6',
                                200: '#ffa3a3',
                                300: '#ff7070',
                                400: '#ff4747',
                                500: '#D50000',
                                600: '#c20000',
                                700: '#990000',
                                800: '#800000',
                                900: '#660000'
                        },
                    warning: colors.amber,
                    info: colors.blue,
                    danger: colors.red,
                    success: colors.green,
                },
        },
    },

    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography'),
        require('tailwindcss-aspect-ratio'),
        require('flowbite/plugin'),
    ],
};
