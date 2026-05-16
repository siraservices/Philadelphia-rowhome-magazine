import type { Metadata, Viewport } from 'next'
import { Antic_Didone, Crimson_Pro, Archivo } from 'next/font/google'
import '../styles/globals.css'

const anticDidone = Antic_Didone({
  weight: '400',
  subsets: ['latin'],
  display: 'swap',
  variable: '--font-antic-didone',
})

const crimsonPro = Crimson_Pro({
  subsets: ['latin'],
  display: 'swap',
  variable: '--font-crimson-pro',
  style: ['normal', 'italic'],
})

const archivo = Archivo({
  subsets: ['latin'],
  display: 'swap',
  variable: '--font-archivo',
})

export const metadata: Metadata = {
  title: {
    default: 'Philadelphia RowHome Magazine | Local Stories, Culture & Community',
    template: '%s | Philadelphia RowHome Magazine',
  },
  description: 'Philadelphia RowHome Magazine features local stories, culture, food, real estate, and community events in Philadelphia neighborhoods.',
  keywords: ['Philadelphia', 'magazine', 'local news', 'culture', 'food', 'real estate', 'community'],
  authors: [{ name: 'Philadelphia RowHome Magazine' }],
  creator: 'Philadelphia RowHome Magazine',
  publisher: 'Philadelphia RowHome Magazine',
  metadataBase: new URL('https://philadelphia-rowhome-magazine.vercel.app'),
  openGraph: {
    type: 'website',
    locale: 'en_US',
    url: 'https://philadelphia-rowhome-magazine.vercel.app',
    siteName: 'Philadelphia RowHome Magazine',
    title: 'Philadelphia RowHome Magazine | Local Stories, Culture & Community',
    description: 'Philadelphia RowHome Magazine features local stories, culture, food, real estate, and community events in Philadelphia neighborhoods.',
    images: [
      {
        url: '/og-image.jpg',
        width: 1200,
        height: 630,
        alt: 'Philadelphia RowHome Magazine',
      },
    ],
  },
  twitter: {
    card: 'summary_large_image',
    title: 'Philadelphia RowHome Magazine | Local Stories, Culture & Community',
    description: 'Philadelphia RowHome Magazine features local stories, culture, food, real estate, and community events in Philadelphia neighborhoods.',
    images: ['/og-image.jpg'],
    creator: '@phillyrowhome',
  },
  robots: {
    index: true,
    follow: true,
    googleBot: {
      index: true,
      follow: true,
      'max-video-preview': -1,
      'max-image-preview': 'large',
      'max-snippet': -1,
    },
  },
}

export const viewport: Viewport = {
  width: 'device-width',
  initialScale: 1,
  maximumScale: 5,
  themeColor: [
    { media: '(prefers-color-scheme: light)', color: '#fefdfa' },
    { media: '(prefers-color-scheme: dark)', color: '#0c0c0c' },
  ],
}

export default function RootLayout({
  children,
}: {
  children: React.ReactNode
}) {
  return (
    <html
      lang="en"
      className={`${anticDidone.variable} ${crimsonPro.variable} ${archivo.variable}`}
    >
      <body>
        {children}
      </body>
    </html>
  )
}
