import Header from '@/components/Header'
import Footer from '@/components/Footer'
import HeroSection from '@/components/HeroSection'
import ArticleCard from '@/components/ArticleCard'
import { getFeaturedArticles, getLatestArticles, mockEvents } from '@/lib/mockData'
import Link from 'next/link'
import Image from 'next/image'
import { CalendarIcon, MapPinIcon } from '@heroicons/react/24/outline'
import { format } from 'date-fns'

export default function HomePage() {
  const featuredArticles = getFeaturedArticles()
  const latestArticles = getLatestArticles(6)
  const upcomingEvents = mockEvents.slice(0, 3)

  return (
    <div className="min-h-screen bg-white">
      <Header />
      
      {/* Hero Section */}
      <HeroSection articles={featuredArticles} />

      <main>
        {/* Latest Articles Section */}
        <section className="py-16 bg-white">
          <div className="container-magazine">
            <div className="flex items-center justify-between mb-12">
              <h2 className="text-3xl md:text-4xl font-serif font-bold">
                Latest Stories
              </h2>
              <Link
                href="/articles"
                className="text-primary-red hover:text-red-700 font-medium transition-colors"
              >
                View All Articles →
              </Link>
            </div>

            {/* Article Grid */}
            <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
              {latestArticles.map((article) => (
                <ArticleCard
                  key={article.id}
                  article={article}
                  layout="grid"
                  showExcerpt={true}
                  showAuthor={true}
                  showDate={true}
                  showCategory={true}
                />
              ))}
            </div>
          </div>
        </section>

        {/* Featured Categories Section */}
        <section className="py-16 bg-background-light">
          <div className="container-magazine">
            <h2 className="text-3xl md:text-4xl font-serif font-bold text-center mb-12">
              Explore Philadelphia
            </h2>
            
            <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
              {/* Food & Dining */}
              <Link
                href="/menu"
                className="group relative h-64 overflow-hidden rounded-lg shadow-lg hover:shadow-xl transition-shadow"
              >
                <Image
                  src="https://images.unsplash.com/photo-1551218808-94e220e084d2?w=400&h=300&fit=crop"
                  alt="Philadelphia Food Scene"
                  fill
                  className="object-cover group-hover:scale-105 transition-transform duration-300"
                />
                <div className="absolute inset-0 bg-black bg-opacity-40 group-hover:bg-opacity-30 transition-all" />
                <div className="absolute bottom-0 left-0 right-0 p-6 text-white">
                  <h3 className="text-xl font-serif font-bold mb-2">Food & Dining</h3>
                  <p className="text-sm text-gray-200">Discover the flavors that make Philadelphia unique</p>
                </div>
              </Link>

              {/* Real Estate */}
              <Link
                href="/real-estate"
                className="group relative h-64 overflow-hidden rounded-lg shadow-lg hover:shadow-xl transition-shadow"
              >
                <Image
                  src="https://images.unsplash.com/photo-1560518883-ce09059eeffa?w=400&h=300&fit=crop"
                  alt="Philadelphia Real Estate"
                  fill
                  className="object-cover group-hover:scale-105 transition-transform duration-300"
                />
                <div className="absolute inset-0 bg-black bg-opacity-40 group-hover:bg-opacity-30 transition-all" />
                <div className="absolute bottom-0 left-0 right-0 p-6 text-white">
                  <h3 className="text-xl font-serif font-bold mb-2">Real Estate</h3>
                  <p className="text-sm text-gray-200">Navigate the city's evolving neighborhoods</p>
                </div>
              </Link>

              {/* Arts & Culture */}
              <Link
                href="/arts"
                className="group relative h-64 overflow-hidden rounded-lg shadow-lg hover:shadow-xl transition-shadow"
              >
                <Image
                  src="https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=400&h=300&fit=crop"
                  alt="Philadelphia Arts"
                  fill
                  className="object-cover group-hover:scale-105 transition-transform duration-300"
                />
                <div className="absolute inset-0 bg-black bg-opacity-40 group-hover:bg-opacity-30 transition-all" />
                <div className="absolute bottom-0 left-0 right-0 p-6 text-white">
                  <h3 className="text-xl font-serif font-bold mb-2">Arts & Culture</h3>
                  <p className="text-sm text-gray-200">Experience the creative spirit of the city</p>
                </div>
              </Link>

              {/* Lifestyle */}
              <Link
                href="/life"
                className="group relative h-64 overflow-hidden rounded-lg shadow-lg hover:shadow-xl transition-shadow"
              >
                <Image
                  src="https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?w=400&h=300&fit=crop"
                  alt="Philadelphia Lifestyle"
                  fill
                  className="object-cover group-hover:scale-105 transition-transform duration-300"
                />
                <div className="absolute inset-0 bg-black bg-opacity-40 group-hover:bg-opacity-30 transition-all" />
                <div className="absolute bottom-0 left-0 right-0 p-6 text-white">
                  <h3 className="text-xl font-serif font-bold mb-2">Life</h3>
                  <p className="text-sm text-gray-200">Live well in the City of Brotherly Love</p>
                </div>
              </Link>
            </div>
          </div>
        </section>

        {/* Upcoming Events Section */}
        <section className="py-16 bg-white">
          <div className="container-magazine">
            <div className="flex items-center justify-between mb-12">
              <h2 className="text-3xl md:text-4xl font-serif font-bold">
                Upcoming Events
              </h2>
              <Link
                href="/events"
                className="text-primary-red hover:text-red-700 font-medium transition-colors"
              >
                View All Events →
              </Link>
            </div>

            <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
              {upcomingEvents.map((event) => (
                <article key={event.id} className="bg-white border border-gray-200 hover:shadow-lg transition-shadow">
                  {event.image && (
                    <div className="relative h-48 overflow-hidden">
                      <Image
                        src={event.image}
                        alt={event.title}
                        fill
                        className="object-cover"
                      />
                    </div>
                  )}
                  <div className="p-6">
                    <div className="flex items-center space-x-4 text-sm text-text-muted mb-3">
                      <div className="flex items-center space-x-1">
                        <CalendarIcon className="h-4 w-4" />
                        <span>{format(new Date(event.date), 'MMM d, yyyy')}</span>
                      </div>
                      <div className="flex items-center space-x-1">
                        <MapPinIcon className="h-4 w-4" />
                        <span>{event.location}</span>
                      </div>
                    </div>
                    <h3 className="text-xl font-serif font-bold mb-3 hover:text-primary-red transition-colors">
                      <Link href={`/events/${event.id}`}>
                        {event.title}
                      </Link>
                    </h3>
                    <p className="text-text-light mb-4 line-clamp-3">
                      {event.description}
                    </p>
                    <div className="flex items-center justify-between">
                      <span className="text-sm font-medium text-primary-red">
                        {event.category}
                      </span>
                      {event.ticketUrl && (
                        <Link
                          href={event.ticketUrl}
                          target="_blank"
                          rel="noopener noreferrer"
                          className="text-sm font-medium text-primary-red hover:text-red-700 transition-colors"
                        >
                          Get Tickets →
                        </Link>
                      )}
                    </div>
                  </div>
                </article>
              ))}
            </div>
          </div>
        </section>

        {/* Newsletter Section */}
        <section className="py-16 bg-background-teal text-white">
          <div className="container-magazine text-center">
            <h2 className="text-3xl md:text-4xl font-serif font-bold mb-4">
              Stay in the Loop
            </h2>
            <p className="text-lg mb-8 max-w-2xl mx-auto">
              Get the latest Philadelphia stories, event updates, and neighborhood insights 
              delivered straight to your inbox every week.
            </p>
            <form className="max-w-md mx-auto flex flex-col sm:flex-row gap-4">
              <input
                type="email"
                placeholder="Enter your email address"
                className="flex-1 px-4 py-3 text-black focus:outline-none focus:ring-2 focus:ring-white"
                required
              />
              <button
                type="submit"
                className="bg-primary-red hover:bg-red-700 text-white px-8 py-3 font-medium transition-colors"
              >
                Subscribe
              </button>
            </form>
            <p className="text-sm mt-4 opacity-90">
              Join 10,000+ Philadelphians who trust us to keep them informed.
            </p>
          </div>
        </section>
      </main>

      <Footer />
    </div>
  )
}
