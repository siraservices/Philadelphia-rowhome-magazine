import Link from 'next/link'
import Header from '@/components/Header'
import Footer from '@/components/Footer'
import ArticleCard from '@/components/ArticleCard'
import AdPlaceholder from '@/components/AdPlaceholder'
import { categories, getArticlesByCategory } from '@/lib/mockData'

export default function LifePage() {
  const category = categories.find(c => c.slug === 'life')
  const articles = getArticlesByCategory('life')

  return (
    <div className="min-h-screen bg-white">
      <Header />
      
      {/* Top Banner Ad */}
      <div className="container-magazine py-4">
        <div className="hidden md:block">
          <AdPlaceholder 
            position="top-banner" 
            size="728x90" 
            style="banner"
          />
        </div>
        <div className="md:hidden">
          <AdPlaceholder 
            position="top-banner-mobile" 
            size="320x50" 
            style="banner"
          />
        </div>
      </div>

      <main>
        {/* Category Header */}
        <section className="py-12 bg-background-light">
          <div className="container-magazine">
            <nav className="flex items-center space-x-2 text-sm text-text-muted mb-6">
              <Link href="/" className="hover:text-text-dark transition-colors">
                Home
              </Link>
              <span>/</span>
              <span className="text-text-dark">Life</span>
            </nav>
            <div className="text-center max-w-3xl mx-auto">
              <h1 className="text-4xl md:text-5xl font-serif font-bold mb-4">
                Life
              </h1>
              <p className="text-xl text-text-light leading-relaxed">
                Discover stories about living well in Philadelphia, from family traditions to community connections.
              </p>
            </div>
          </div>
        </section>

        {/* Featured Article with Sidebar Ad */}
        {articles.length > 0 && (
          <section className="py-12">
            <div className="container-magazine">
              <div className="grid grid-cols-1 lg:grid-cols-3 gap-8">
                {/* Main Content - Featured Article */}
                <div className="lg:col-span-2">
                  <ArticleCard
                    article={articles[0]}
                    layout="large"
                    showExcerpt={true}
                    showAuthor={true}
                    showDate={true}
                    showCategory={false}
                    className="border-b border-gray-200 pb-8"
                  />
                </div>

                {/* Sidebar - Top Ad */}
                <div className="lg:col-span-1">
                  <div className="sticky top-4">
                    <div className="hidden lg:block mb-8">
                      <AdPlaceholder 
                        position="sidebar-top" 
                        size="300x250" 
                        style="banner"
                      />
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
        )}

        {/* In-stream Native Ad */}
        <div className="container-magazine py-8">
          <AdPlaceholder 
            position="in-stream-1" 
            size="responsive" 
            style="native"
            className="w-full"
          />
        </div>

        {/* Article Grid (2 cols) with Sidebar Ad */}
        {articles.length > 1 && (
          <section className="py-12">
            <div className="container-magazine">
              <div className="grid grid-cols-1 lg:grid-cols-3 gap-8">
                {/* Main Content - Article Grid */}
                <div className="lg:col-span-2">
                  <h2 className="text-2xl md:text-3xl font-serif font-bold mb-8">
                    Latest in Life
                  </h2>
                  <div className="grid grid-cols-1 md:grid-cols-2 gap-8">
                    {articles.slice(1, 5).map((article) => (
                      <ArticleCard
                        key={article.id}
                        article={article}
                        layout="grid"
                        showExcerpt={true}
                        showAuthor={true}
                        showDate={true}
                        showCategory={false}
                      />
                    ))}
                  </div>
                </div>

                {/* Sidebar - Middle Ad (Skyscraper) */}
                <div className="lg:col-span-1">
                  <div className="sticky top-4">
                    <div className="hidden lg:block">
                      <AdPlaceholder 
                        position="sidebar-middle" 
                        size="300x600" 
                        style="banner"
                      />
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
        )}

        {/* Mid-page Banner Ad */}
        <div className="container-magazine py-8">
          <div className="hidden md:block">
            <AdPlaceholder 
              position="mid-page-banner" 
              size="728x90" 
              style="banner"
            />
          </div>
          <div className="md:hidden">
            <AdPlaceholder 
              position="mid-page-banner-mobile" 
              size="320x50" 
              style="banner"
            />
          </div>
        </div>

        {/* Article Grid (3 cols) with Sidebar Ad */}
        {articles.length > 5 && (
          <section className="py-12">
            <div className="container-magazine">
              <div className="grid grid-cols-1 lg:grid-cols-3 gap-8">
                {/* Main Content - Article Grid */}
                <div className="lg:col-span-2">
                  <h2 className="text-2xl md:text-3xl font-serif font-bold mb-8">
                    More Stories
                  </h2>
                  <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    {articles.slice(5).map((article) => (
                      <ArticleCard
                        key={article.id}
                        article={article}
                        layout="grid"
                        showExcerpt={true}
                        showAuthor={true}
                        showDate={true}
                        showCategory={false}
                      />
                    ))}
                  </div>
                </div>

                {/* Sidebar - Bottom Ad */}
                <div className="lg:col-span-1">
                  <div className="sticky top-4">
                    <div className="hidden lg:block">
                      <AdPlaceholder 
                        position="sidebar-bottom" 
                        size="300x250" 
                        style="banner"
                      />
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
        )}

        {/* Bottom Banner Ad */}
        <div className="container-magazine py-8">
          <AdPlaceholder 
            position="bottom-banner" 
            size="responsive" 
            style="native"
            className="w-full"
          />
        </div>

        {/* Newsletter CTA */}
        <section className="py-16 bg-background-teal text-white">
          <div className="container-magazine text-center">
            <h2 className="text-3xl font-serif font-bold mb-4">
              Stay Updated on Life
            </h2>
            <p className="text-lg mb-8 max-w-2xl mx-auto">
              Get notified when we publish new life articles and other Philadelphia stories you'll love.
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
          </div>
        </section>
      </main>

      <Footer />
    </div>
  )
}

