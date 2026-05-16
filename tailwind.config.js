/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './src/pages/**/*.{js,ts,jsx,tsx,mdx}',
    './src/components/**/*.{js,ts,jsx,tsx,mdx}',
    './src/app/**/*.{js,ts,jsx,tsx,mdx}',
  ],
  theme: {
    extend: {
      colors: {
        'rh-bg':       '#fefdfa',
        'rh-paper':    '#ffffff',
        'rh-ink':      '#0c0c0c',
        'rh-ink-2':    '#2d2d2d',
        'rh-mute':     '#7a7a7a',
        'rh-accent':   '#d11f1f',
        'rh-accent-2': '#8a1313',
        'rh-tag':      '#0c0c0c',
        // Keep legacy names for backward compat with existing scaffold
        primary: {
          black: '#0c0c0c',
          red: '#d11f1f',
          white: '#fefdfa',
        },
        text: {
          dark: '#0c0c0c',
          light: '#2d2d2d',
          muted: '#7a7a7a',
        },
        background: {
          light: '#fefdfa',
          gray:  '#f8f5f0',
        },
      },
      fontFamily: {
        display: ['"Antic Didone"', '"Times New Roman"', 'serif'],
        serif:   ['"Crimson Pro"', 'Georgia', 'serif'],
        sans:    ['"Archivo"', 'system-ui', 'sans-serif'],
        ui:      ['"Archivo"', 'system-ui', 'sans-serif'],
      },
      fontSize: {
        'display-mast': ['clamp(80px,12vw,200px)',  { lineHeight: '.86' }],
        'display-1':    ['clamp(44px,7vw,88px)',     { lineHeight: '.96' }],
        'display-2':    ['clamp(40px,6vw,78px)',     { lineHeight: '.96' }],
        'display-3':    ['clamp(32px,5vw,60px)',     { lineHeight: '1.05' }],
        'display-4':    ['clamp(26px,3.5vw,40px)',   { lineHeight: '1' }],
        'display-5':    ['clamp(22px,3vw,34px)',     { lineHeight: '1.05' }],
        'display-6':    ['clamp(18px,2.5vw,26px)',   { lineHeight: '1.1' }],
        'display-7':    ['clamp(16px,2vw,22px)',     { lineHeight: '1.1' }],
        'body-lg':      ['22px', { lineHeight: '1.55' }],
        'body-rh':      ['18px', { lineHeight: '1.62' }],
        'body-sm':      ['14px', { lineHeight: '1.5' }],
        'eyebrow':      ['10px', { lineHeight: '1', letterSpacing: '.18em' }],
        'byline':       ['11px', { lineHeight: '1', letterSpacing: '.04em' }],
      },
      maxWidth: {
        'rh': '1280px',
        '8xl': '88rem',
      },
      spacing: {
        '18': '4.5rem',
        '88': '22rem',
        '128': '32rem',
      },
    },
  },
  plugins: [
    require('@tailwindcss/typography'),
    require('@tailwindcss/forms'),
  ],
}
