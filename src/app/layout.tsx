import type { Metadata, Viewport } from 'next'
import { Inter, Playfair_Display } from 'next/font/google'
import '../styles/globals.css'

const inter = Inter({
  subsets: ['latin'],
  display: 'swap',
  variable: '--font-inter',
})

const playfair = Playfair_Display({
  subsets: ['latin'],
  display: 'swap',
  variable: '--font-playfair',
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
  metadataBase: new URL('https://philadelphiarowhome.com'),
  openGraph: {
    type: 'website',
    locale: 'en_US',
    url: 'https://philadelphiarowhome.com',
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
  verification: {
    google: 'verification_token',
  },
}

export const viewport: Viewport = {
  width: 'device-width',
  initialScale: 1,
  maximumScale: 5,
  themeColor: [
    { media: '(prefers-color-scheme: light)', color: '#ffffff' },
    { media: '(prefers-color-scheme: dark)', color: '#000000' },
  ],
}

export default function RootLayout({
  children,
}: {
  children: React.ReactNode
}) {
  return (
    <html lang="en" className={`${inter.variable} ${playfair.variable}`}>
      <body className="font-sans antialiased">
        <div id="root">
          {children}
        </div>
      </body>
    </html>
  )
}
