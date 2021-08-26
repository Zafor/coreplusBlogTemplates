module.exports = {
  purge: [
    './page-templates/**/*.php',
    './templates/**/*.php',
    './app/**/*.php',
    './assets/js/**/*.js',
    './assets/js/**/*.vue',
  ],
  theme: {
    extend: {
        colors: {
            primary: {
                default: '#F98731',
            },
            pink: {
                default: '#e51f90',
            },
            teal: {
                light: '#BDFFF8',
                default: '#61C5B9',
                dark: '#26A1A8',
            },
            gray: {
                '100': '#f5f5f5',
                '200': '#eeeeee',
                '300': '#e0e0e0',
                '400': '#bdbdbd',
                '500': '#9e9e9e',
                '600': '#757575',
                '700': '#616161',
                '800': '#424242',
                '900': '#212121',
            },
        },
        boxShadow: {
            solid: '0 0px 8px rgba(0, 0, 0, .25)',
            'solid-lg': '0 0px 20px rgba(0, 0, 0, .25)',
        },
        fontSize: {
            'xs': '12px',
            'sm': '14px',
            'base': '16px', // <h5> and <p>
            'lg': '18px',   // <h4>
            'xl': '22px',   // <h3>
            '2xl': '26px',
            '3xl': '34px',  // <h2>
            '4xl': '40px',  // <h1>
            '5xl': '48px',
            '6xl': '56px',
        },
        spacing: {
            '1px': '1px',
            '1/2': '50%',
            '1/3': '33.333333%',
            '2/3': '66.666667%',
            '1/4': '25%',
            '2/4': '50%',
            '3/4': '75%',
            '1/5': '20%',
            '2/5': '40%',
            '3/5': '60%',
            '4/5': '80%',
            '1/6': '16.666667%',
            '2/6': '33.333333%',
            '3/6': '50%',
            '4/6': '66.666667%',
            '5/6': '83.333333%',
            '1/12': '8.333333%',
            '2/12': '16.666667%',
            '3/12': '25%',
            '4/12': '33.333333%',
            '5/12': '41.666667%',
            '6/12': '50%',
            '7/12': '58.333333%',
            '8/12': '66.666667%',
            '9/12': '75%',
            '10/12': '83.333333%',
            '11/12': '91.666667%',
            full: '100%',
        },
        maxWidth: {
            '800px': '800px',
        },
        scale: {
            '85': '0.85',
            '70': '0.7',
        },
        animation: {
            'spin-fast': 'spin 0.6s linear infinite',
        }
    },
  },
  variants: {
    scale: ['responsive', 'hover', 'focus', 'active', 'group-hover'],
    borderColor: ['responsive', 'hover', 'focus', 'active', 'group-hover'],
    textColor: ['responsive', 'hover', 'focus', 'active', 'group-hover'],
    backgroundColor: ['responsive', 'hover', 'focus', 'active', 'group-hover'],
  },
  plugins: [],
  prefix: 'tw-',
}
