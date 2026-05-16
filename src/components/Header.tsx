'use client'

import { useState } from 'react'
import Link from 'next/link'

const departments = [
  { name: 'People',      href: '/people',      children: [] },
  { name: 'Life',        href: '/life',         children: ['Health', 'Fashion', 'Brides Guide', 'Community', 'Writers Block'] },
  { name: 'Business',    href: '/business',     children: ['Real Estate', 'Tech', 'Education', 'Politics'] },
  { name: 'Arts',        href: '/arts',         children: ['Music & Art', 'Film', 'Flashback', 'History'] },
  { name: 'Lifestyle',   href: '/lifestyle',    children: ['Menu', 'Travel', 'Events'] },
  { name: 'Sports',      href: '/sports',       children: [] },
  { name: 'Environment', href: '/environment',  children: [] },
  { name: 'Games',       href: '/games',        children: [] },
]

export default function Header() {
  const [mobileMenuOpen, setMobileMenuOpen] = useState(false)
  const [searchOpen, setSearchOpen] = useState(false)
  const [activeDropdown, setActiveDropdown] = useState<string | null>(null)

  return (
    <header className="site-header" style={{
      background: 'var(--rh-bg)',
      borderBottom: '1px solid color-mix(in srgb, var(--rh-rule) 14%, transparent)',
      position: 'sticky',
      top: 0,
      zIndex: 100,
    }}>

      {/* Main header bar: search | logo | actions */}
      <div className="rh-container" style={{ display: 'flex', alignItems: 'center', justifyContent: 'space-between', height: '72px', gap: '24px' }}>

        {/* Left: Search */}
        <div style={{ flex: '0 0 auto' }}>
          <button
            type="button"
            aria-label="Search"
            onClick={() => setSearchOpen(!searchOpen)}
            style={{ background: 'none', border: 'none', cursor: 'pointer', padding: '4px', color: 'var(--rh-ink)', display: 'flex', alignItems: 'center' }}
          >
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2.5" strokeLinecap="round" strokeLinejoin="round" aria-hidden="true">
              <circle cx="11" cy="11" r="8"/>
              <path d="m21 21-4.35-4.35"/>
            </svg>
          </button>
        </div>

        {/* Center: Logo */}
        <div style={{ flex: 1, textAlign: 'center' }}>
          <Link href="/" style={{ textDecoration: 'none', display: 'inline-block' }}>
            <span style={{
              fontFamily: 'var(--rh-display)',
              fontSize: 'clamp(28px, 4vw, 44px)',
              lineHeight: 1,
              color: 'var(--rh-ink)',
              letterSpacing: '.01em',
            }}>
              Row<em>Home</em>
            </span>
            <span style={{ display: 'block', fontFamily: 'var(--rh-ui)', fontSize: '9px', letterSpacing: '.22em', textTransform: 'uppercase', color: 'var(--rh-mute)', marginTop: '2px' }}>
              River to River. One Neighborhood.
            </span>
          </Link>
        </div>

        {/* Right: Subscribe + hamburger */}
        <div style={{ flex: '0 0 auto', display: 'flex', alignItems: 'center', gap: '16px' }}>
          <Link
            href="/subscribe"
            style={{
              fontFamily: 'var(--rh-ui)',
              fontSize: '10px',
              fontWeight: 700,
              letterSpacing: '.14em',
              textTransform: 'uppercase',
              padding: '8px 14px',
              background: 'var(--rh-ink)',
              color: '#fff',
              textDecoration: 'none',
              whiteSpace: 'nowrap',
              display: 'none',
            }}
            className="header-subscribe-btn"
          >
            Subscribe · $1/wk
          </Link>

          <button
            type="button"
            aria-label={mobileMenuOpen ? 'Close menu' : 'Open menu'}
            aria-expanded={mobileMenuOpen}
            onClick={() => setMobileMenuOpen(!mobileMenuOpen)}
            style={{ background: 'none', border: 'none', cursor: 'pointer', padding: '4px', color: 'var(--rh-ink)', display: 'flex', flexDirection: 'column', gap: '5px' }}
          >
            {mobileMenuOpen ? (
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2.5" strokeLinecap="round" aria-hidden="true">
                <path d="M18 6 6 18M6 6l12 12"/>
              </svg>
            ) : (
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2.5" strokeLinecap="round" aria-hidden="true">
                <path d="M3 12h18M3 6h18M3 18h18"/>
              </svg>
            )}
          </button>
        </div>
      </div>

      {/* Department nav bar */}
      <nav
        aria-label="Department Navigation"
        style={{
          borderTop: '1px solid color-mix(in srgb, var(--rh-rule) 12%, transparent)',
          background: 'var(--rh-bg)',
          overflowX: 'auto',
          scrollbarWidth: 'none',
        }}
        className="dept-nav-bar"
      >
        <div className="rh-container" style={{ display: 'flex', alignItems: 'center', gap: '0', whiteSpace: 'nowrap', height: '40px' }}>
          {departments.map((dept) => (
            <div
              key={dept.name}
              style={{ position: 'relative' }}
              onMouseEnter={() => dept.children.length ? setActiveDropdown(dept.name) : undefined}
              onMouseLeave={() => setActiveDropdown(null)}
            >
              <Link
                href={dept.href}
                style={{
                  fontFamily: 'var(--rh-ui)',
                  fontSize: '10.5px',
                  fontWeight: 600,
                  letterSpacing: '.16em',
                  textTransform: 'uppercase',
                  color: 'var(--rh-ink)',
                  textDecoration: 'none',
                  padding: '0 16px',
                  display: 'flex',
                  alignItems: 'center',
                  height: '40px',
                  gap: '5px',
                  transition: 'color .15s',
                }}
                className="dept-nav-link"
              >
                {dept.name}
                {dept.children.length > 0 && (
                  <svg width="8" height="5" viewBox="0 0 10 6" fill="currentColor" aria-hidden="true" style={{ opacity: .6 }}>
                    <path d="M5 6L0 0h10L5 6z"/>
                  </svg>
                )}
              </Link>

              {dept.children.length > 0 && activeDropdown === dept.name && (
                <div style={{
                  position: 'absolute',
                  top: '100%',
                  left: 0,
                  background: 'var(--rh-paper)',
                  border: '1px solid color-mix(in srgb, var(--rh-rule) 14%, transparent)',
                  boxShadow: '0 8px 24px rgba(0,0,0,.1)',
                  minWidth: '160px',
                  zIndex: 200,
                  padding: '8px 0',
                }}>
                  {dept.children.map((child) => (
                    <Link
                      key={child}
                      href={`/category/${child.toLowerCase().replace(/[^a-z0-9]+/g, '-')}`}
                      style={{
                        display: 'block',
                        fontFamily: 'var(--rh-ui)',
                        fontSize: '11px',
                        fontWeight: 500,
                        letterSpacing: '.1em',
                        textTransform: 'uppercase',
                        color: 'var(--rh-ink)',
                        padding: '9px 18px',
                        textDecoration: 'none',
                        transition: 'color .15s',
                      }}
                      className="dept-dropdown-item"
                    >
                      {child}
                    </Link>
                  ))}
                </div>
              )}
            </div>
          ))}
        </div>
      </nav>

      {/* Search overlay */}
      {searchOpen && (
        <div
          style={{
            position: 'fixed', inset: 0, background: 'rgba(0,0,0,.94)',
            zIndex: 9999, display: 'flex', alignItems: 'center', justifyContent: 'center',
          }}
          onClick={(e) => { if (e.target === e.currentTarget) setSearchOpen(false) }}
        >
          <div style={{ position: 'relative', width: '90%', maxWidth: '600px' }}>
            <button
              onClick={() => setSearchOpen(false)}
              style={{ position: 'absolute', top: '-48px', right: 0, background: 'none', border: 'none', color: '#fff', fontSize: '2.5rem', cursor: 'pointer', lineHeight: 1 }}
              aria-label="Close search"
            >×</button>
            <form style={{ display: 'flex', gap: '10px' }}>
              <input
                type="search"
                placeholder="Search articles..."
                autoFocus
                style={{ flex: 1, padding: '18px 20px', fontSize: '1.25rem', border: 'none', borderRadius: '2px', fontFamily: 'var(--rh-body)' }}
              />
              <button
                type="submit"
                style={{ padding: '18px 28px', background: 'var(--rh-accent)', border: 'none', borderRadius: '2px', cursor: 'pointer', color: '#fff' }}
                aria-label="Submit search"
              >
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2.5" strokeLinecap="round" aria-hidden="true">
                  <circle cx="11" cy="11" r="8"/>
                  <path d="m21 21-4.35-4.35"/>
                </svg>
              </button>
            </form>
          </div>
        </div>
      )}

      {/* Mobile menu drawer */}
      {mobileMenuOpen && (
        <div style={{
          position: 'fixed', top: 0, left: 0, right: 0, bottom: 0,
          background: 'var(--rh-bg)', zIndex: 300, overflowY: 'auto',
          paddingTop: '80px',
        }}>
          <button
            onClick={() => setMobileMenuOpen(false)}
            aria-label="Close menu"
            style={{ position: 'absolute', top: '20px', right: '20px', background: 'none', border: 'none', cursor: 'pointer', color: 'var(--rh-ink)' }}
          >
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2.5" strokeLinecap="round" aria-hidden="true">
              <path d="M18 6 6 18M6 6l12 12"/>
            </svg>
          </button>

          <div style={{ padding: '0 var(--rh-gutter) 40px' }}>
            <div style={{ marginBottom: '24px', paddingBottom: '24px', borderBottom: '1px solid color-mix(in srgb, var(--rh-rule) 14%, transparent)' }}>
              <Link
                href="/subscribe"
                onClick={() => setMobileMenuOpen(false)}
                style={{
                  display: 'block',
                  fontFamily: 'var(--rh-ui)',
                  fontSize: '11px',
                  fontWeight: 700,
                  letterSpacing: '.14em',
                  textTransform: 'uppercase',
                  padding: '12px 20px',
                  background: 'var(--rh-ink)',
                  color: '#fff',
                  textDecoration: 'none',
                  textAlign: 'center',
                  marginBottom: '12px',
                }}
              >
                Subscribe · $1/Week
              </Link>
              <Link
                href="/login"
                onClick={() => setMobileMenuOpen(false)}
                style={{
                  display: 'block',
                  fontFamily: 'var(--rh-ui)',
                  fontSize: '11px',
                  fontWeight: 600,
                  letterSpacing: '.14em',
                  textTransform: 'uppercase',
                  textAlign: 'center',
                  color: 'var(--rh-ink)',
                  textDecoration: 'none',
                  padding: '8px',
                }}
              >
                Log In
              </Link>
            </div>

            {departments.map((dept) => (
              <div key={dept.name} style={{ borderBottom: '1px solid color-mix(in srgb, var(--rh-rule) 10%, transparent)' }}>
                <Link
                  href={dept.href}
                  onClick={() => setMobileMenuOpen(false)}
                  style={{
                    display: 'block',
                    fontFamily: 'var(--rh-ui)',
                    fontSize: '12px',
                    fontWeight: 700,
                    letterSpacing: '.16em',
                    textTransform: 'uppercase',
                    color: 'var(--rh-ink)',
                    textDecoration: 'none',
                    padding: '14px 0',
                  }}
                >
                  {dept.name}
                </Link>
                {dept.children.length > 0 && (
                  <div style={{ paddingBottom: '8px', paddingLeft: '16px' }}>
                    {dept.children.map((child) => (
                      <Link
                        key={child}
                        href={`/category/${child.toLowerCase().replace(/[^a-z0-9]+/g, '-')}`}
                        onClick={() => setMobileMenuOpen(false)}
                        style={{
                          display: 'block',
                          fontFamily: 'var(--rh-ui)',
                          fontSize: '11px',
                          fontWeight: 500,
                          letterSpacing: '.1em',
                          textTransform: 'uppercase',
                          color: 'var(--rh-ink-2)',
                          textDecoration: 'none',
                          padding: '8px 0',
                        }}
                      >
                        {child}
                      </Link>
                    ))}
                  </div>
                )}
              </div>
            ))}
          </div>
        </div>
      )}

      <style>{`
        @media (min-width: 640px) {
          .header-subscribe-btn { display: flex !important; }
        }
        .dept-nav-bar::-webkit-scrollbar { display: none; }
        .dept-nav-link:hover { color: var(--rh-accent) !important; }
        .dept-dropdown-item:hover { color: var(--rh-accent) !important; }
      `}</style>
    </header>
  )
}
