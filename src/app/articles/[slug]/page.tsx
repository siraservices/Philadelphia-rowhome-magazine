import { notFound } from 'next/navigation'
import Image from 'next/image'
import Link from 'next/link'
import Header from '@/components/Header'
import Footer from '@/components/Footer'
import { mockArticles, getLatestArticles } from '@/lib/mockData'

interface ArticlePageProps {
  params: { slug: string }
}

export function generateStaticParams() {
  return mockArticles.map((article) => ({ slug: article.slug }))
}

export default function ArticlePage({ params }: ArticlePageProps) {
  const article = mockArticles.find((a) => a.slug === params.slug)
  if (!article) notFound()

  const relatedArticles = getLatestArticles(4).filter((a) => a.id !== article.id).slice(0, 4)

  const shareUrl   = encodeURIComponent(`https://philadelphia-rowhome-magazine.vercel.app/articles/${article.slug}`)
  const shareTitle = encodeURIComponent(article.title)

  return (
    <div style={{ background: 'var(--rh-bg)' }}>
      <Header />

      {/* ── Hero — 21:9 full-bleed ── */}
      <div className={`rh-article-hero${article.featuredImage ? '' : ' rh-article-hero--no-image'}`}>
        {article.featuredImage && (
          <div className="rh-article-hero__media">
            <Image
              src={article.featuredImage}
              alt={article.title}
              fill
              className="rh-article-hero__img rh-photo"
              style={{ objectFit: 'cover' }}
              priority
            />
            <div className="rh-article-hero__overlay" aria-hidden="true" />
          </div>
        )}
        <div className="rh-article-hero__caption">
          <div className="rh-container">
            <span className="rh-eyebrow rh-article-hero__eyebrow">{article.category.name}</span>
            <h1 className="rh-article-hero__headline">{article.title}</h1>
            {article.excerpt && (
              <p className="rh-article-hero__dek">{article.excerpt}</p>
            )}
          </div>
        </div>
      </div>

      {/* ── Meta strip ── */}
      <div className="rh-article-meta-strip">
        <div className="rh-container">
          <div className="rh-article-meta-strip__inner">
            <div className="rh-article-meta-strip__col">
              <span className="rh-article-meta-strip__label">By</span>
              <span className="rh-byline">{article.author.name}</span>
            </div>
            <div className="rh-article-meta-strip__col rh-article-meta-strip__col--center">
              <time className="rh-byline" dateTime={article.publishedAt}>
                {new Date(article.publishedAt).toLocaleDateString('en-US', { month: 'long', day: 'numeric', year: 'numeric' })}
              </time>
            </div>
            <div className="rh-article-meta-strip__col rh-article-meta-strip__col--right">
              <span className="rh-byline">{article.readTime} min read</span>
            </div>
          </div>
        </div>
      </div>

      {/* ── Body 3-col grid ── */}
      <div className="rh-container">
        <div className="rh-article-body">

          {/* Left rail: share */}
          <aside className="rh-article-rail rh-article-rail--left" aria-label="Share">
            <div className="rh-article-rail__inner">
              <div className="rh-article-share">
                <div className="rh-sidebar-block__label">Share</div>
                <div className="rh-article-share__buttons">
                  <a
                    href={`https://www.facebook.com/sharer/sharer.php?u=${shareUrl}`}
                    target="_blank" rel="noopener noreferrer"
                    className="rh-article-share__btn"
                    aria-label="Share on Facebook"
                  >
                    <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    Facebook
                  </a>
                  <a
                    href={`https://twitter.com/intent/tweet?url=${shareUrl}&text=${shareTitle}`}
                    target="_blank" rel="noopener noreferrer"
                    className="rh-article-share__btn"
                    aria-label="Share on X"
                  >
                    <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                    X / Twitter
                  </a>
                  <a
                    href={`https://www.linkedin.com/shareArticle?mini=true&url=${shareUrl}&title=${shareTitle}`}
                    target="_blank" rel="noopener noreferrer"
                    className="rh-article-share__btn"
                    aria-label="Share on LinkedIn"
                  >
                    <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                    LinkedIn
                  </a>
                </div>
              </div>
            </div>
          </aside>

          {/* Center: prose */}
          <div className="rh-article-center">
            <div className="rh-prose">
              <p>{article.excerpt}</p>
              <p>
                Philadelphia continues to be a city of contrasts — old neighborhoods giving way to new energy,
                classic traditions reimagined for contemporary life. In this feature, we dive deep into the story
                behind the story, uncovering what makes this piece of the city tick.
              </p>
              <h2>The Heart of the Matter</h2>
              <p>
                Every great Philadelphia story starts with people. The residents, the block captains, the shop
                owners who have watched neighborhoods transform over decades. This is no exception.
              </p>
              <blockquote>
                "This is what makes Philadelphia different from any other city — the sense that every street
                corner has a history, and every history is worth telling."
              </blockquote>
              <p>
                {article.content !== 'Full article content would go here...'
                  ? article.content
                  : 'The full article explores the layers of this story in depth, speaking to residents, historians, and community leaders who have shaped this part of the city.'}
              </p>
              <h2>Looking Ahead</h2>
              <p>
                As Philadelphia continues to evolve, the question isn&rsquo;t whether these stories will change —
                they always do. The question is whether we document them faithfully enough for the next generation
                of Philadelphians to understand where they came from.
              </p>
              <p>
                RowHome Magazine will continue to bring these stories to life, issue after issue, neighborhood
                after neighborhood. River to river.
              </p>
            </div>

            {/* Tags */}
            {article.tags && article.tags.length > 0 && (
              <div style={{ marginTop: '32px', paddingTop: '20px', borderTop: 'var(--rh-hairline)', display: 'flex', gap: '8px', flexWrap: 'wrap' }}>
                {article.tags.map((tag) => (
                  <Link
                    key={tag}
                    href={`/category/${tag}`}
                    className="rh-tag"
                    style={{ textDecoration: 'none' }}
                  >
                    {tag}
                  </Link>
                ))}
              </div>
            )}
          </div>

          {/* Right rail: ads + related */}
          <aside className="rh-article-rail rh-article-rail--right rh-sidebar" aria-label="Sidebar">
            <div className="rh-sidebar-block">
              <div className="rh-ad rh-ad--half" aria-label="Advertisement">Advertisement</div>
            </div>

            <div className="rh-sidebar-block">
              <div className="rh-sidebar-block__label">Article Stats</div>
              <div className="rh-article-stat-card">
                <span className="rh-article-stat-card__value">{article.readTime}</span>
                <span className="rh-article-stat-card__label rh-byline">min read</span>
              </div>
            </div>

            {relatedArticles.length > 0 && (
              <div className="rh-sidebar-block">
                <div className="rh-sidebar-block__label">Related</div>
                {relatedArticles.map((rel, i) => (
                  <Link key={rel.id} href={`/articles/${rel.slug}`} className="rh-ticker-item-link">
                    <div className="rh-ticker-item">
                      <span className="rh-ticker-item__index">{String(i + 1).padStart(2, '0')}</span>
                      <div>
                        <span className="rh-eyebrow">{rel.category.name}</span>
                        <p className="rh-ticker-item__headline">{rel.title}</p>
                        <span className="rh-ticker-item__byline">{rel.author.name}</span>
                      </div>
                    </div>
                  </Link>
                ))}
              </div>
            )}

            <div className="rh-sidebar-block">
              <div className="rh-ad rh-ad--half" aria-label="Advertisement">Advertisement</div>
            </div>
          </aside>
        </div>
      </div>

      <Footer />
    </div>
  )
}
