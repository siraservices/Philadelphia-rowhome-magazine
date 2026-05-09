import { notFound } from 'next/navigation'
import Image from 'next/image'
import Link from 'next/link'
import { format } from 'date-fns'
import { 
  CalendarIcon, 
  ClockIcon, 
  ShareIcon, 
  UserIcon,
  TagIcon 
} from '@heroicons/react/24/outline'
import { 
  FacebookIcon, 
  TwitterIcon, 
  LinkedinIcon,
  Share2Icon 
} from 'lucide-react'
import Header from '@/components/Header'
import Footer from '@/components/Footer'
import ArticleCard from '@/components/ArticleCard'
import { mockArticles, getLatestArticles } from '@/lib/mockData'

interface ArticlePageProps {
  params: {
    slug: string
  }
}

// Generate static params for all articles
export function generateStaticParams() {
  return mockArticles.map((article) => ({
    slug: article.slug,
  }))
}

export default function ArticlePage({ params }: ArticlePageProps) {
  const article = mockArticles.find(a => a.slug === params.slug)
  
  if (!article) {
    notFound()
  }

  const relatedArticles = getLatestArticles(3).filter(a => a.id !== article.id)

  return (
    <div className="min-h-screen bg-white">
      <Header />
      
      <main>
        {/* Article Header */}
        <article className="py-12">
          <div className="container-magazine max-w-4xl">
            {/* Breadcrumbs */}
            <nav className="flex items-center space-x-2 text-sm text-text-muted mb-8">
              <Link href="/" className="hover:text-text-dark transition-colors">
                Home
              </Link>
              <span>/</span>
              <Link 
                href={`/category/${article.category.slug}`}
                className="hover:text-text-dark transition-colors"
              >
                {article.category.name}
              </Link>
              <span>/</span>
              <span className="text-text-dark">{article.title}</span>
            </nav>

            {/* Category Badge */}
            <Link
              href={`/category/${article.category.slug}`}
              className="inline-block category-badge mb-6 hover:bg-red-700 transition-colors"
            >
              {article.category.name}
            </Link>

            {/* Title */}
            <h1 className="text-4xl md:text-5xl lg:text-6xl font-serif font-bold leading-tight mb-6">
              {article.title}
            </h1>

            {/* Excerpt */}
            <p className="text-xl text-text-light leading-relaxed mb-8 max-w-3xl">
              {article.excerpt}
            </p>

            {/* Author and Meta */}
            <div className="flex flex-col md:flex-row md:items-center md:justify-between mb-8 pb-8 border-b border-gray-200">
              <div className="flex items-center space-x-4 mb-4 md:mb-0">
                <Link
                  href={`/authors/${article.author.id}`}
                  className="flex items-center space-x-3 hover:text-primary-red transition-colors"
                >
                  {article.author.avatar ? (
                    <Image
                      src={article.author.avatar}
                      alt={article.author.name}
                      width={48}
                      height={48}
                      className="rounded-full"
                    />
                  ) : (
                    <div className="w-12 h-12 bg-gray-200 rounded-full flex items-center justify-center">
                      <UserIcon className="h-6 w-6 text-gray-500" />
                    </div>
                  )}
                  <div>
                    <div className="font-medium">{article.author.name}</div>
                    {article.author.bio && (
                      <div className="text-sm text-text-muted">{article.author.bio}</div>
                    )}
                  </div>
                </Link>
              </div>

              <div className="flex items-center space-x-6 text-sm text-text-muted">
                <div className="flex items-center space-x-1">
                  <CalendarIcon className="h-4 w-4" />
                  <time dateTime={article.publishedAt}>
                    {format(new Date(article.publishedAt), 'MMMM d, yyyy')}
                  </time>
                </div>
                <div className="flex items-center space-x-1">
                  <ClockIcon className="h-4 w-4" />
                  <span>{article.readTime} min read</span>
                </div>
              </div>
            </div>

            {/* Featured Image */}
            <div className="relative mb-8">
              <Image
                src={article.featuredImage}
                alt={article.imageAlt}
                width={1200}
                height={800}
                className="w-full h-auto rounded-lg"
                priority
              />
              {article.imageCredit && (
                <p className="text-sm text-text-muted mt-2 italic">
                  {article.imageCredit}
                </p>
              )}
            </div>

            {/* Share Buttons */}
            <div className="flex items-center justify-between mb-8 p-4 bg-background-light rounded-lg">
              <span className="font-medium text-text-dark">Share this article:</span>
              <div className="flex items-center space-x-3">
                <button className="p-2 bg-blue-600 hover:bg-blue-700 text-white rounded transition-colors">
                  <FacebookIcon className="h-5 w-5" />
                </button>
                <button className="p-2 bg-blue-400 hover:bg-blue-500 text-white rounded transition-colors">
                  <TwitterIcon className="h-5 w-5" />
                </button>
                <button className="p-2 bg-blue-700 hover:bg-blue-800 text-white rounded transition-colors">
                  <LinkedinIcon className="h-5 w-5" />
                </button>
                <button className="p-2 bg-red-600 hover:bg-red-700 text-white rounded transition-colors">
                  <Share2Icon className="h-5 w-5" />
                </button>
                <button className="p-2 bg-gray-600 hover:bg-gray-700 text-white rounded transition-colors">
                  <ShareIcon className="h-5 w-5" />
                </button>
              </div>
            </div>

            {/* Article Content */}
            <div className="prose prose-lg max-w-none">
              <p className="lead">
                This is where the full article content would be displayed. In a real application, 
                this would be rendered from a rich text editor or markdown content. The content 
                would include paragraphs, headings, images, quotes, and other rich media elements.
              </p>
              
              <h2>A Sample Heading</h2>
              
              <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor 
                incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis 
                nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
              </p>
              
              <blockquote className="border-l-4 border-primary-red pl-6 italic text-xl my-8">
                "Philadelphia is a city where tradition meets innovation, where every neighborhood 
                tells a unique story."
              </blockquote>
              
              <p>
                Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore 
                eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, 
                sunt in culpa qui officia deserunt mollit anim id est laborum.
              </p>
              
              <h3>Another Section</h3>
              
              <p>
                Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium 
                doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore 
                veritatis et quasi architecto beatae vitae dicta sunt explicabo.
              </p>
            </div>

            {/* Tags */}
            {article.tags.length > 0 && (
              <div className="mt-12 pt-8 border-t border-gray-200">
                <div className="flex items-center space-x-2 mb-4">
                  <TagIcon className="h-5 w-5 text-text-muted" />
                  <span className="font-medium text-text-dark">Tags:</span>
                </div>
                <div className="flex flex-wrap gap-2">
                  {article.tags.map((tag) => (
                    <Link
                      key={tag}
                      href={`/tag/${tag}`}
                      className="px-3 py-1 bg-background-light hover:bg-gray-300 text-text-dark text-sm rounded-full transition-colors"
                    >
                      #{tag}
                    </Link>
                  ))}
                </div>
              </div>
            )}
          </div>
        </article>

        {/* Related Articles */}
        {relatedArticles.length > 0 && (
          <section className="py-16 bg-background-light">
            <div className="container-magazine">
              <h2 className="text-3xl font-serif font-bold mb-12 text-center">
                Related Articles
              </h2>
              <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
                {relatedArticles.map((relatedArticle) => (
                  <ArticleCard
                    key={relatedArticle.id}
                    article={relatedArticle}
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
        )}

        {/* Newsletter CTA */}
        <section className="py-16 bg-primary-black text-white">
          <div className="container-magazine text-center">
            <h2 className="text-3xl font-serif font-bold mb-4">
              Don't Miss Our Latest Stories
            </h2>
            <p className="text-lg mb-8 text-gray-300 max-w-2xl mx-auto">
              Subscribe to Philadelphia RowHome Magazine and get the best local stories 
              delivered to your inbox every week.
            </p>
            <form className="max-w-md mx-auto flex flex-col sm:flex-row gap-4">
              <input
                type="email"
                placeholder="Enter your email address"
                className="flex-1 px-4 py-3 text-black focus:outline-none focus:ring-2 focus:ring-primary-red"
                required
              />
              <button
                type="submit"
                className="btn-primary"
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
