import Link from 'next/link'
import Header from '@/components/Header'
import Footer from '@/components/Footer'

export default function NotFound() {
  return (
    <div className="min-h-screen bg-white">
      <Header />
      
      <main>
        <section className="py-24 bg-background-light">
          <div className="container-magazine text-center">
            <div className="max-w-2xl mx-auto">
              {/* 404 Number */}
              <div className="text-8xl md:text-9xl font-serif font-bold text-primary-red mb-8">
                404
              </div>
              
              {/* Heading */}
              <h1 className="text-3xl md:text-4xl font-serif font-bold mb-6">
                Page Not Found
              </h1>
              
              {/* Description */}
              <p className="text-lg text-text-light mb-8 leading-relaxed">
                Sorry, we couldn't find the page you're looking for. 
                It might have been moved, deleted, or you entered the wrong URL.
              </p>
              
              {/* Action Buttons */}
              <div className="flex flex-col sm:flex-row gap-4 justify-center">
                <Link href="/" className="btn-primary">
                  Go Home
                </Link>
                <Link href="/articles" className="btn-secondary">
                  Browse Articles
                </Link>
              </div>
              
              {/* Search Suggestion */}
              <div className="mt-12 p-6 bg-white rounded-lg border border-gray-200">
                <h3 className="font-serif font-bold mb-4">
                  Try searching for what you need:
                </h3>
                <form className="flex flex-col sm:flex-row gap-4 max-w-md mx-auto">
                  <input
                    type="text"
                    placeholder="Search articles, events, and more..."
                    className="flex-1 px-4 py-3 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary-red"
                  />
                  <button
                    type="submit"
                    className="btn-primary"
                  >
                    Search
                  </button>
                </form>
              </div>
              
              {/* Popular Links */}
              <div className="mt-12">
                <h3 className="font-serif font-bold mb-6">
                  Popular Pages
                </h3>
                <div className="grid grid-cols-2 md:grid-cols-4 gap-4">
                  <Link
                    href="/menu"
                    className="p-4 bg-white hover:bg-gray-50 border border-gray-200 hover:border-gray-300 transition-all rounded-lg"
                  >
                    <h4 className="font-medium mb-1">Food & Dining</h4>
                    <p className="text-sm text-text-light">Local restaurants</p>
                  </Link>
                  <Link
                    href="/real-estate"
                    className="p-4 bg-white hover:bg-gray-50 border border-gray-200 hover:border-gray-300 transition-all rounded-lg"
                  >
                    <h4 className="font-medium mb-1">Real Estate</h4>
                    <p className="text-sm text-text-light">Market updates</p>
                  </Link>
                  <Link
                    href="/events"
                    className="p-4 bg-white hover:bg-gray-50 border border-gray-200 hover:border-gray-300 transition-all rounded-lg"
                  >
                    <h4 className="font-medium mb-1">Events</h4>
                    <p className="text-sm text-text-light">What's happening</p>
                  </Link>
                  <Link
                    href="/arts"
                    className="p-4 bg-white hover:bg-gray-50 border border-gray-200 hover:border-gray-300 transition-all rounded-lg"
                  >
                    <h4 className="font-medium mb-1">Arts & Culture</h4>
                    <p className="text-sm text-text-light">Local scene</p>
                  </Link>
                </div>
              </div>
            </div>
          </div>
        </section>
      </main>
      
      <Footer />
    </div>
  )
}
