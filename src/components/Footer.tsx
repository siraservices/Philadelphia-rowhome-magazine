import Link from 'next/link'
import { 
  FacebookIcon, 
  TwitterIcon, 
  InstagramIcon, 
  LinkedinIcon,
  MailIcon 
} from 'lucide-react'

const footerNavigation = {
  magazine: [
    { name: 'Current Issue', href: '/current-issue' },
    { name: 'Back Issues', href: '/archive' },
    { name: 'Subscribe', href: '/subscribe' },
    { name: 'Advertise', href: '/advertise' },
  ],
  community: [
    { name: 'Events', href: '/events' },
    { name: 'Local Directory', href: '/directory' },
    { name: 'Submit News', href: '/submit' },
    { name: 'Contact Us', href: '/contact' },
  ],
  categories: [
    { name: 'Life', href: '/life' },
    { name: 'Business', href: '/business' },
    { name: 'Real Estate', href: '/real-estate' },
    { name: 'Food & Dining', href: '/menu' },
  ],
  about: [
    { name: 'About Us', href: '/about' },
    { name: 'Our Team', href: '/team' },
    { name: 'Careers', href: '/careers' },
    { name: 'Privacy Policy', href: '/privacy' },
  ],
}

const socialLinks = [
  {
    name: 'Facebook',
    href: 'https://facebook.com/phillyrowhome',
    icon: FacebookIcon,
  },
  {
    name: 'Twitter',
    href: 'https://twitter.com/phillyrowhome',
    icon: TwitterIcon,
  },
  {
    name: 'Instagram',
    href: 'https://instagram.com/phillyrowhome',
    icon: InstagramIcon,
  },
  {
    name: 'LinkedIn',
    href: 'https://linkedin.com/company/phillyrowhome',
    icon: LinkedinIcon,
  },
]

export default function Footer() {
  return (
    <footer className="bg-black text-white">
      {/* Newsletter Signup */}
      <div className="border-b border-gray-800">
        <div className="container-magazine py-12">
          <div className="max-w-2xl mx-auto text-center">
            <h3 className="text-2xl font-serif font-bold mb-4">
              Stay Connected with Philadelphia
            </h3>
            <p className="text-gray-400 mb-6">
              Get the latest stories, events, and local insights delivered to your inbox.
            </p>
            <form className="flex flex-col sm:flex-row gap-4 max-w-md mx-auto">
              <input
                type="email"
                placeholder="Enter your email address"
                className="flex-1 bg-white text-black px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary-red"
                required
              />
              <button
                type="submit"
                className="btn-primary whitespace-nowrap"
              >
                Subscribe
              </button>
            </form>
          </div>
        </div>
      </div>

      {/* Main Footer Content */}
      <div className="container-magazine py-12">
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-8">
          {/* Logo and Description */}
          <div className="lg:col-span-1">
            <Link href="/" className="flex items-center mb-4">
              <div className="text-xl font-bold tracking-wider">
                <span className="text-white">ROW</span>
                <span className="text-primary-red">HOME</span>
              </div>
            </Link>
            <p className="text-gray-400 text-sm mb-6">
              Philadelphia's premier lifestyle magazine, celebrating the stories, 
              culture, and community that make our neighborhoods unique.
            </p>
            <div className="flex space-x-4">
              {socialLinks.map((item) => (
                <a
                  key={item.name}
                  href={item.href}
                  target="_blank"
                  rel="noopener noreferrer"
                  className="text-gray-400 hover:text-white transition-colors"
                  aria-label={item.name}
                >
                  <item.icon className="h-5 w-5" />
                </a>
              ))}
            </div>
          </div>

          {/* Navigation Columns */}
          <div>
            <h4 className="text-sm font-semibold uppercase tracking-wider mb-4">
              Magazine
            </h4>
            <ul className="space-y-2">
              {footerNavigation.magazine.map((item) => (
                <li key={item.name}>
                  <Link
                    href={item.href}
                    className="text-gray-400 hover:text-white transition-colors text-sm"
                  >
                    {item.name}
                  </Link>
                </li>
              ))}
            </ul>
          </div>

          <div>
            <h4 className="text-sm font-semibold uppercase tracking-wider mb-4">
              Community
            </h4>
            <ul className="space-y-2">
              {footerNavigation.community.map((item) => (
                <li key={item.name}>
                  <Link
                    href={item.href}
                    className="text-gray-400 hover:text-white transition-colors text-sm"
                  >
                    {item.name}
                  </Link>
                </li>
              ))}
            </ul>
          </div>

          <div>
            <h4 className="text-sm font-semibold uppercase tracking-wider mb-4">
              Categories
            </h4>
            <ul className="space-y-2">
              {footerNavigation.categories.map((item) => (
                <li key={item.name}>
                  <Link
                    href={item.href}
                    className="text-gray-400 hover:text-white transition-colors text-sm"
                  >
                    {item.name}
                  </Link>
                </li>
              ))}
            </ul>
          </div>

          <div>
            <h4 className="text-sm font-semibold uppercase tracking-wider mb-4">
              About
            </h4>
            <ul className="space-y-2">
              {footerNavigation.about.map((item) => (
                <li key={item.name}>
                  <Link
                    href={item.href}
                    className="text-gray-400 hover:text-white transition-colors text-sm"
                  >
                    {item.name}
                  </Link>
                </li>
              ))}
            </ul>
          </div>
        </div>
      </div>

      {/* Bottom Bar */}
      <div className="border-t border-gray-800">
        <div className="container-magazine py-6 flex flex-col sm:flex-row justify-between items-center">
          <p className="text-gray-400 text-sm">
            © {new Date().getFullYear()} Philadelphia RowHome Magazine. All rights reserved.
          </p>
          <div className="flex space-x-6 mt-4 sm:mt-0">
            <Link
              href="/terms"
              className="text-gray-400 hover:text-white transition-colors text-sm"
            >
              Terms of Service
            </Link>
            <Link
              href="/privacy"
              className="text-gray-400 hover:text-white transition-colors text-sm"
            >
              Privacy Policy
            </Link>
            <Link
              href="/accessibility"
              className="text-gray-400 hover:text-white transition-colors text-sm"
            >
              Accessibility
            </Link>
          </div>
        </div>
      </div>
    </footer>
  )
}
