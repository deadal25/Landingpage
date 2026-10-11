/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.js',
    ],
    theme: {
        extend: {
            screens: {
                'xs': '420px',
                '3xl': '1920px',
                '4k': '2560px',
            },
            colors: {
                // Musashi Identity Colors & CSS Variable hooks
                musashi: {
                    red: 'var(--color-primary, #E60012)',
                    darkred: 'var(--color-primary-dark, #B8000E)',
                    black: 'var(--color-dark, #0B0F14)',
                    charcoal: 'var(--color-charcoal, #151A21)',
                    surface: 'var(--color-surface, #1C232D)',
                    gold: 'var(--color-accent-gold, #F59E0B)',
                    sunrise: 'var(--color-accent-sunrise, #FF6F00)',
                },
                primary: {
                    DEFAULT: 'var(--color-primary, #E60012)',
                    50: '#FFF1F2',
                    100: '#FFE4E6',
                    200: '#FECDD3',
                    300: '#FDA4AF',
                    400: '#FB7185',
                    500: '#E60012',
                    600: '#CC0010',
                    700: '#99000C',
                    800: '#660008',
                    900: '#330004',
                },
                secondary: {
                    DEFAULT: 'var(--color-secondary, #F59E0B)',
                    light: '#FBBF24',
                    dark: '#D97706',
                },
                dark: {
                    DEFAULT: 'var(--color-dark, #0B0F14)',
                    nav: 'var(--color-nav-bg, rgba(14, 18, 23, 0.85))',
                    dropdown: 'var(--color-dropdown-bg, #0D1117)',
                    card: '#161B22',
                    border: '#242C37',
                },
                accent: {
                    DEFAULT: 'var(--color-accent, #FF6F00)',
                    glow: 'rgba(230, 0, 18, 0.25)',
                }
            },
            fontFamily: {
                sans: ['"Plus Jakarta Sans"', 'Inter', 'system-ui', 'sans-serif'],
                heading: ['"Plus Jakarta Sans"', 'Inter', 'sans-serif'],
            },
            boxShadow: {
                'subtle': '0 4px 20px -2px rgba(0, 0, 0, 0.05)',
                'card': '0 10px 30px -5px rgba(0, 0, 0, 0.08)',
                'glow': '0 0 25px -5px rgba(230, 0, 18, 0.35)',
            },
            keyframes: {
                'pulse-slow': {
                    '0%, 100%': { opacity: '1' },
                    '50%': { opacity: '0.6' },
                },
                'float': {
                    '0%, 100%': { transform: 'translateY(0)' },
                    '50%': { transform: 'translateY(-6px)' },
                }
            },
            animation: {
                'pulse-slow': 'pulse-slow 3s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                'float': 'float 4s ease-in-out infinite',
            }
        },
    },
    plugins: [],
};
