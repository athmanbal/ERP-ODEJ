/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        // Navy encre — topbar, texte fort, fonds sombres
        navy: {
          DEFAULT: '#0B1220',
          50:  '#EEF1F6',
          100: '#D6DCE8',
          400: '#4A5A7A',
          700: '#151F33',
          900: '#0B1220',
        },
        // Bleu institutionnel — accent primaire (déjà présent dans les chevrons)
        institutionnel: {
          DEFAULT: '#3B78E7',
          50:  '#EAF1FD',
          100: '#CFE0FA',
          400: '#5F92EC',
          600: '#3B78E7',
          700: '#2A5BC0',
        },
        // Violet — icônes, accents secondaires
        violet: {
          DEFAULT: '#6D5BD0',
          50:  '#F1EFFB',
          100: '#DFDAF5',
          400: '#8A7BDD',
          600: '#6D5BD0',
          700: '#54439E',
        },
        // Fond de contenu (au lieu du blanc pur)
        canvas: '#F6F7FB',
        ink: {
          DEFAULT: '#101828',
          secondary: '#5F6B85',
          muted: '#98A2B3',
        },
        // Statuts sémantiques
        status: {
          success: '#1D9E75',
          warning: '#BA7517',
          danger:  '#A32D2D',
        },
      },
      fontFamily: {
        // Titres, grands chiffres — registre officiel/administratif
        display: ['"Playfair Display"', 'serif'],
        // UI, tableaux, navigation
        sans: ['Inter', 'ui-sans-serif', 'system-ui', 'sans-serif'],
      },
      borderRadius: {
        card: '12px',
      },
    },
  },
  plugins: [],
}
