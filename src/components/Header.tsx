'use client'

import { useState } from 'react'
import Link from 'next/link'
import { Bars3Icon, XMarkIcon, MagnifyingGlassIcon } from '@heroicons/react/24/outline'
import { UserIcon } from '@heroicons/react/24/solid'

const mainNavigation = [
  { name: 'Events', href: '/events' },
  { name: 'In the Magazine', href: '/magazine' },
  { name: 'Neighborhood', href: '/neighborhood' },
  { name: 'Discover', href: '/discover' },
]

const secondaryNavigation = [
  { name: 'LIFE', href: '/life' },
  { name: 'BUSINESS', href: '/business' },
  { name: 'HEALTH', href: '/health' },
  { name: 'REAL ESTATE', href: '/real-estate' },
  { name: 'MENU', href: '/menu' },
  { name: 'ARTS', href: '/arts' },
  { name: 'WEDDINGS', href: '/weddings' },
]

export default function Header() {
  const [mobileMenuOpen, setMobileMenuOpen] = useState(false)
  const [searchOpen, setSearchOpen] = useState(false)

  return (
    <header className="bg-black text-white">
      {/* Top Bar */}
      <div className="border-b border-gray-800">
        <div className="container-magazine flex items-center justify-between py-2">
          <div className="flex items-center space-x-4">
            <span className="text-xs text-gray-400">Philadelphia's Premier Lifestyle Magazine</span>
          </div>
          <div className="flex items-center space-x-4">
            <button
              onClick={() => setSearchOpen(!searchOpen)}
              className="text-gray-400 hover:text-white transition-colors"
              aria-label="Search"
            >
              <MagnifyingGlassIcon className="h-4 w-4" />
            </button>
            <Link
              href="/subscribe"
              className="text-xs text-gray-400 hover:text-white transition-colors"
            >
              Subscribe
            </Link>
            <Link
              href="/login"
              className="flex items-center space-x-1 text-xs text-gray-400 hover:text-white transition-colors"
            >
              <UserIcon className="h-4 w-4" />
              <span>Login</span>
            </Link>
          </div>
        </div>
      </div>

      {/* Search Bar */}
      {searchOpen && (
        <div className="border-b border-gray-800 bg-gray-900">
          <div className="container-magazine py-4">
            <div className="relative max-w-md">
              <input
                type="text"
                placeholder="Search articles, events, and more..."
                className="w-full bg-black border border-gray-600 rounded-none px-4 py-2 text-white placeholder-gray-400 focus:outline-none focus:border-white"
              />
              <button className="absolute right-2 top-2 text-gray-400 hover:text-white">
                <MagnifyingGlassIcon className="h-5 w-5" />
              </button>
            </div>
          </div>
        </div>
      )}

      {/* Main Navigation */}
      <div className="container-magazine">
        <div className="flex items-center justify-between py-4">
          {/* Logo */}
          <Link href="/" className="flex items-center">
            <div className="text-2xl font-bold tracking-wider">
              <span className="text-white">ROW</span>
              <span className="text-primary-red">HOME</span>
            </div>
          </Link>

          {/* Desktop Navigation */}
          <nav className="hidden md:flex items-center space-x-8">
            {mainNavigation.map((item) => (
              <Link
                key={item.name}
                href={item.href}
                className="nav-link text-white hover:text-primary-red"
              >
                {item.name}
              </Link>
            ))}
          </nav>

          {/* Mobile Menu Button */}
          <button
            type="button"
            className="md:hidden text-white"
            onClick={() => setMobileMenuOpen(!mobileMenuOpen)}
          >
            {mobileMenuOpen ? (
              <XMarkIcon className="h-6 w-6" />
            ) : (
              <Bars3Icon className="h-6 w-6" />
            )}
          </button>
        </div>

        {/* Secondary Navigation */}
        <div className="hidden lg:flex border-t border-gray-800 py-3">
          <nav className="flex items-center space-x-6">
            {secondaryNavigation.map((item) => (
              <Link
                key={item.name}
                href={item.href}
                className="nav-link text-sm text-gray-300 hover:text-white"
              >
                {item.name}
              </Link>
            ))}
          </nav>
        </div>
      </div>

      {/* Mobile Menu */}
      {mobileMenuOpen && (
        <div className="md:hidden border-t border-gray-800 bg-gray-900">
          <div className="px-4 py-6 space-y-4">
            {mainNavigation.map((item) => (
              <Link
                key={item.name}
                href={item.href}
                className="block nav-link text-white hover:text-primary-red py-2"
                onClick={() => setMobileMenuOpen(false)}
              >
                {item.name}
              </Link>
            ))}
            <div className="border-t border-gray-700 pt-4 mt-4">
              <div className="text-xs text-gray-400 mb-2">Categories</div>
              {secondaryNavigation.map((item) => (
                <Link
                  key={item.name}
                  href={item.href}
                  className="block nav-link text-sm text-gray-300 hover:text-white py-1"
                  onClick={() => setMobileMenuOpen(false)}
                >
                  {item.name}
                </Link>
              ))}
            </div>
          </div>
        </div>
      )}
    </header>
  )
}
