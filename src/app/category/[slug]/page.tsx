import { notFound } from 'next/navigation'
import Link from 'next/link'
import Image from 'next/image'
import Header from '@/components/Header'
import Footer from '@/components/Footer'
import { categories, mockArticles, getArticlesByCategory } from '@/lib/mockData'

interface CategoryPageProps {
  params: { slug: string }
}

const sectionChildrenMap: Record<string, string[]> = {
  life:      ['Health', 'Fashion', 'Brides Guide', 'Community', 'Writers Block'],
  business:  ['Real Estate', 'Tech', 'Education', 'Politics'],
  arts:      ['Music & Art', 'Film', 'Flashback', 'History'],
  lifestyle: ['Menu', 'Travel', 'Events'],
}

const sectionDescriptions: Record<string, string> = {
  life:          "Philadelphia living at its best — health, fashion, community, and more.",
  business:      "Real estate, tech, education, and politics shaping the city's economy.",
  arts:          "Music, art, film, and history from Philadelphia's creative scene.",
  'real-estate': "Navigate Philadelphia's evolving neighborhoods and housing market.",
  menu:          "The best restaurants, bars, and food culture in Philadelphia.",
  health:        "Wellness, fitness, and healthcare for Philadelphians.",
  weddings:      "Philadelphia weddings and bridal inspiration.",
}

// Build a broader set of static params: categories + common department slugs
const deptSlugs = [
  'health','fashion','brides-guide','community','writers-block',
  'real-estate','tech','education','politics',
  'music-art','film','flashback','history',
  'menu','travel','events','sports','environment','games','people',
  'life','business','arts','lifestyle',
]

export function generateStaticParams() {
  const catSlugs = categories.map((c) => ({ slug: c.slug }))
  const deptParams = deptSlugs.map((s) => ({ slug: s }))
  // deduplicate
  const all = [...catSlugs, ...deptParams]
  const seen = new Set<string>()
  return all.filter(({ slug }) => {
    if (seen.has(slug)) return false
    seen.add(slug)
    return true
  })
}

export default function CategoryPage({ params }: CategoryPageProps) {
  const { slug } = params

  // Match against known categories; for dept slugs, synthesize a name
  const category = categories.find((c) => c.slug === slug) ?? {
    id: slug,
    name: slug.replace(/-/g, ' ').replace(/\b\w/g, (c) => c.toUpperCase()),
    slug,
    color: '#0c0c0c',
  }

  const articles = getArticlesByCategory(slug)
  const fallbackArticles = articles.length > 0 ? articles : mockArticles.slice(0, 6)
  const description = sectionDescriptions[slug] ?? `Stories and features from Philadelphia's ${category.name} scene.`
  const children = sectionChildrenMap[slug] ?? []

  return (
    <div style={{ background: 'var(--rh-bg)' }}>
      <Header />

      {/* Section hero */}
      <div className="section-hero">
        <div className="rh-container">
          <div className="section-hero__content">
            <nav className="section-hero__breadcrumb" aria-label="Breadcrumb">
              <Link href="/">Home</Link>
              <span> / </span>
              <span>{category.name}</span>
            </nav>
            <h1 className="section-hero__title">{category.name}</h1>
            <p className="section-hero__tagline">{description}</p>
            <p className="section-hero__count">{fallbackArticles.length} article{fallbackArticles.length !== 1 ? 's' : ''}</p>
          </div>
        </div>
      </div>

      <main>
        <div className="rh-container rh-section">

          {/* Sub-departments strip */}
          {children.length > 0 && (
            <div style={{ marginBottom: '32px', display: 'flex', gap: '8px', flexWrap: 'wrap' }}>
              {children.map((child) => (
                <Link
                  key={child}
                  href={`/category/${child.toLowerCase().replace(/[^a-z0-9]+/g, '-')}`}
                  className="rh-tag"
                  style={{ textDecoration: 'none' }}
                >
                  {child}
                </Link>
              ))}
            </div>
          )}

          {/* Section header */}
          <div className="rh-section-header rh-section-header--ruled" style={{ marginBottom: '32px' }}>
            <h2 className="rh-section-header__title">Latest in {category.name}</h2>
          </div>

          {/* Hero article */}
          {fallbackArticles[0] && (
            <Link href={`/articles/${fallbackArticles[0].slug}`} className="rh-story-card-link" style={{ display: 'block', marginBottom: '40px' }}>
              <article className="rh-story-card" style={{ display: 'grid', gridTemplateColumns: '1fr 1fr', gap: '32px' }}>
                <div className="rh-story-card__image" style={{ aspectRatio: '4/3' }}>
                  <span className="rh-tag rh-story-card__tag">{fallbackArticles[0].category.name}</span>
                  <Image
                    src={fallbackArticles[0].featuredImage}
                    alt={fallbackArticles[0].title}
                    width={800}
                    height={600}
                    className="rh-photo"
                    style={{ width: '100%', height: '100%', objectFit: 'cover' }}
                  />
                </div>
                <div style={{ display: 'flex', flexDirection: 'column', justifyContent: 'center', paddingTop: '24px' }}>
                  <span className="rh-eyebrow">{fallbackArticles[0].category.name}</span>
                  <h2 style={{ fontFamily: 'var(--rh-display)', fontSize: 'var(--rh-display-4)', lineHeight: 1, fontWeight: 400, color: 'var(--rh-ink)', margin: '12px 0' }}>
                    {fallbackArticles[0].title}
                  </h2>
                  <p style={{ fontFamily: 'var(--rh-body)', fontSize: 'var(--rh-body-lg)', lineHeight: 'var(--rh-lh-body-lg)', color: 'var(--rh-ink-2)', marginBottom: '16px' }}>
                    {fallbackArticles[0].excerpt}
                  </p>
                  <span className="rh-byline">By {fallbackArticles[0].author.name}</span>
                </div>
              </article>
            </Link>
          )}

          {/* Article grid */}
          {fallbackArticles.length > 1 && (
            <div style={{ display: 'grid', gridTemplateColumns: 'repeat(3, 1fr)', gap: 'var(--rh-grid-gap)' }} className="section-article-grid">
              {fallbackArticles.slice(1).map((article) => (
                <Link key={article.id} href={`/articles/${article.slug}`} className="rh-story-card-link">
                  <article className="rh-story-card rh-story-card--m">
                    <div className="rh-story-card__image">
                      <span className="rh-tag rh-story-card__tag">{article.category.name}</span>
                      <Image
                        src={article.featuredImage}
                        alt={article.title}
                        width={600}
                        height={400}
                        className="rh-photo"
                        style={{ width: '100%', aspectRatio: '16/9', objectFit: 'cover' }}
                      />
                    </div>
                    <div className="rh-story-card__body">
                      <span className="rh-eyebrow">{article.category.name}</span>
                      <h3 className="rh-story-card__headline">{article.title}</h3>
                      <span className="rh-byline">By {article.author.name}</span>
                    </div>
                  </article>
                </Link>
              ))}
            </div>
          )}

          {fallbackArticles.length === 0 && (
            <div style={{ textAlign: 'center', padding: '64px 0' }}>
              <p style={{ fontFamily: 'var(--rh-body)', fontSize: 'var(--rh-body-lg)', color: 'var(--rh-mute)', marginBottom: '24px' }}>
                No articles yet in this section. Check back soon.
              </p>
              <Link href="/" className="rh-tag" style={{ textDecoration: 'none', padding: '12px 20px', fontSize: '11px' }}>
                Return Home
              </Link>
            </div>
          )}
        </div>
      </main>

      <style>{`
        @media (max-width: 768px) {
          .section-article-grid { grid-template-columns: 1fr !important; }
          .rh-story-card[style*="grid-template-columns"] { grid-template-columns: 1fr !important; }
        }
        @media (max-width: 480px) {
          .section-article-grid { grid-template-columns: 1fr !important; }
        }
      `}</style>

      <Footer />
    </div>
  )
}
