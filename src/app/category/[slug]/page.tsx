import { notFound } from 'next/navigation'
import Link from 'next/link'
import Header from '@/components/Header'
import Footer from '@/components/Footer'
import ArticleCard from '@/components/ArticleCard'
import { categories, getArticlesByCategory } from '@/lib/mockData'

interface CategoryPageProps {
  params: {
    slug: string
  }
}

// Generate static params for all categories
export function generateStaticParams() {
  return categories.map((category) => ({
    slug: category.slug,
  }))
}

export default function CategoryPage({ params }: CategoryPageProps) {
  const category = categories.find(c => c.slug === params.slug)
  
  if (!category) {
    notFound()
  }

  const articles = getArticlesByCategory(category.slug)

  return (
    <div className="min-h-screen bg-white">
      <Header />
      
      <main>
        {/* Category Header */}
        <section className="py-16 bg-background-light">
          <div className="container-magazine">
            {/* Breadcrumbs */}
            <nav className="flex items-center space-x-2 text-sm text-text-muted mb-8">
              <Link href="/" className="hover:text-text-dark transition-colors">
                Home
              </Link>
              <span>/</span>
              <Link href="/categories" className="hover:text-text-dark transition-colors">
                Categories
              </Link>
              <span>/</span>
              <span className="text-text-dark">{category.name}</span>
            </nav>

            {/* Category Title */}
            <div className="text-center max-w-3xl mx-auto">
              <h1 className="text-4xl md:text-5xl font-serif font-bold mb-6">
                {category.name}
              </h1>
              {category.description && (
                <p className="text-xl text-text-light leading-relaxed">
                  {category.description}
                </p>
              )}
            </div>
          </div>
        </section>

        {/* Articles */}
        <section className="py-16">
          <div className="container-magazine">
            {articles.length > 0 ? (
              <>
                <div className="flex items-center justify-between mb-12">
                  <h2 className="text-2xl font-serif font-bold">
                    {articles.length} Article{articles.length !== 1 ? 's' : ''} in {category.name}
                  </h2>
                  <div className="flex items-center space-x-4">
                    <select className="px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-primary-red">
                      <option value="newest">Newest First</option>
                      <option value="oldest">Oldest First</option>
                      <option value="popular">Most Popular</option>
                    </select>
                  </div>
                </div>

                {/* Featured Article */}
                {articles[0] && (
                  <div className="mb-12">
                    <ArticleCard
                      article={articles[0]}
                      layout="large"
                      showExcerpt={true}
                      showAuthor={true}
                      showDate={true}
                      showCategory={false}
                      className="border-b border-gray-200 pb-12"
                    />
                  </div>
                )}

                {/* Article Grid */}
                {articles.length > 1 && (
                  <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    {articles.slice(1).map((article) => (
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
                )}

                {/* Load More Button */}
                <div className="text-center mt-12">
                  <button className="btn-secondary">
                    Load More Articles
                  </button>
                </div>
              </>
            ) : (
              <div className="text-center py-16">
                <h3 className="text-2xl font-serif font-bold mb-4">
                  No Articles Yet
                </h3>
                <p className="text-text-light mb-8">
                  We haven't published any articles in this category yet. 
                  Check back soon for new content!
                </p>
                <Link href="/" className="btn-primary">
                  Explore Other Categories
                </Link>
              </div>
            )}
          </div>
        </section>

        {/* Related Categories */}
        <section className="py-16 bg-background-light">
          <div className="container-magazine">
            <h2 className="text-3xl font-serif font-bold text-center mb-12">
              Explore Other Categories
            </h2>
            <div className="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
              {categories
                .filter(c => c.id !== category.id)
                .map((relatedCategory) => (
                  <Link
                    key={relatedCategory.id}
                    href={`/category/${relatedCategory.slug}`}
                    className="group p-6 bg-white hover:bg-gray-50 border border-gray-200 hover:border-gray-300 transition-all text-center"
                  >
                    <h3 className="font-serif font-bold text-lg mb-2 group-hover:text-primary-red transition-colors">
                      {relatedCategory.name}
                    </h3>
                    {relatedCategory.description && (
                      <p className="text-sm text-text-light">
                        {relatedCategory.description}
                      </p>
                    )}
                  </Link>
                ))}
            </div>
          </div>
        </section>

        {/* Newsletter CTA */}
        <section className="py-16 bg-background-teal text-white">
          <div className="container-magazine text-center">
            <h2 className="text-3xl font-serif font-bold mb-4">
              Stay Updated on {category.name}
            </h2>
            <p className="text-lg mb-8 max-w-2xl mx-auto">
              Get notified when we publish new {category.name.toLowerCase()} articles 
              and other Philadelphia stories you'll love.
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
