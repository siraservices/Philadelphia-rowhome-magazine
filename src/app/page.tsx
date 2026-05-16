import Header from '@/components/Header'
import Footer from '@/components/Footer'
import { mockArticles, mockEvents } from '@/lib/mockData'
import Link from 'next/link'
import Image from 'next/image'

const coverArticle = mockArticles[0]
const coverLines   = mockArticles.slice(1, 5)
const contentRows  = mockArticles.slice(0, 6)
const hotList      = mockArticles.slice(0, 3)
const mostRead     = [mockArticles[3], mockArticles[4], mockArticles[5]]

const navSections = [
  { name: 'Life',        href: '/life' },
  { name: 'Business',   href: '/business' },
  { name: 'Arts',       href: '/arts' },
  { name: 'Lifestyle',  href: '/lifestyle' },
  { name: 'Sports',     href: '/sports' },
  { name: 'Environment',href: '/environment' },
]

const allDepartments = [
  { name: 'Health',        slug: 'health' },
  { name: 'Fashion',       slug: 'fashion' },
  { name: 'Brides Guide',  slug: 'brides-guide' },
  { name: 'Community',     slug: 'community' },
  { name: 'Writers Block', slug: 'writers-block' },
  { name: 'Real Estate',   slug: 'real-estate' },
  { name: 'Tech',          slug: 'tech' },
  { name: 'Education',     slug: 'education' },
  { name: 'Politics',      slug: 'politics' },
  { name: 'Music & Art',   slug: 'music-art' },
  { name: 'Film',          slug: 'film' },
  { name: 'Flashback',     slug: 'flashback' },
  { name: 'History',       slug: 'history' },
  { name: 'Menu',          slug: 'menu' },
  { name: 'Travel',        slug: 'travel' },
  { name: '2025 Hotspots', slug: '2025-hotspots' },
  { name: 'Events',        slug: 'events' },
  { name: 'Sports',        slug: 'sports' },
  { name: 'Environment',   slug: 'environment' },
  { name: 'Games',         slug: 'games' },
  { name: 'People',        slug: 'people' },
]

const spotlights = [
  {
    dept:  'Menu',
    class: 'rh-dept-spotlight--food',
    href:  '/menu',
    title: "Philadelphia's Hottest Restaurants",
    dek:   "From South Street to Fishtown, discover the dining experiences shaping the city's food scene this season.",
    img:   mockArticles[0].featuredImage,
  },
  {
    dept:  'Real Estate',
    class: 'rh-dept-spotlight--real-estate',
    href:  '/real-estate',
    title: 'The Row Home Market Is Booming',
    dek:   "Philadelphia's historic housing stock is seeing renewed interest. Here's what buyers and sellers need to know.",
    img:   mockArticles[2].featuredImage,
  },
  {
    dept:  'Music & Art',
    class: 'rh-dept-spotlight--arts',
    href:  '/arts',
    title: 'Local Artists Transforming the City',
    dek:   'Murals, music venues, and gallery openings — the arts are alive across every Philadelphia neighborhood.',
    img:   mockArticles[3].featuredImage,
  },
]

export default function HomePage() {
  return (
    <div style={{ background: 'var(--rh-bg)' }}>
      <Header />

      {/* ============================================================
          1. COVER MASTHEAD
          ============================================================ */}
      <div className="rh-cover-masthead" role="banner" aria-label="Cover">
        <Image
          src={coverArticle.featuredImage}
          alt={coverArticle.title}
          fill
          className="rh-cover-masthead__bg rh-photo"
          style={{ objectFit: 'cover' }}
          priority
        />

        <div className="rh-cover-masthead__gradient" aria-hidden="true" />

        {/* Dateline */}
        <div className="rh-cover-masthead__dateline">
          <span>Issue 03 · Feb 2026 · $7.95</span>
          <Link href="/subscribe" className="rh-cover-masthead__dateline-link">
            Subscribe · $1/wk
          </Link>
        </div>

        {/* Wordmark */}
        <div className="rh-cover-masthead__wordmark">
          <Link href="/" className="rh-cover-masthead__wordmark-link">
            <span className="rh-cover-masthead__wordmark-text">
              Row<em>Home</em>
            </span>
          </Link>
          <span className="rh-cover-masthead__tagline-text">
            River to River. One Neighborhood.
          </span>
        </div>

        {/* Cover lines (left) */}
        <div className="rh-cover-masthead__lines" aria-label="Inside this issue">
          <span className="rh-cover-masthead__lines-eyebrow">Inside</span>
          {coverLines.map((article, i) => (
            <div key={article.id} className="rh-cover-masthead__line-item">
              <Link href={`/articles/${article.slug}`} className="rh-cover-masthead__line-link">
                {article.title}
              </Link>
              <span className="rh-cover-masthead__line-page">p.&nbsp;{30 + i * 12}</span>
            </div>
          ))}
        </div>

        {/* Cover headline (right) */}
        <div className="rh-cover-masthead__headline">
          <span className="rh-cover-masthead__hed-tag">
            {coverArticle.category.name} · The Cover Story
          </span>
          <Link href={`/articles/${coverArticle.slug}`} className="rh-cover-masthead__hed-link">
            <h1 className="rh-cover-masthead__hed-title">{coverArticle.title}</h1>
          </Link>
        </div>

        {/* Bottom nav strip */}
        <nav className="rh-cover-masthead__nav" aria-label="Section navigation">
          <div className="rh-cover-masthead__nav-sections">
            {navSections.map((s) => (
              <Link key={s.name} href={s.href} className="rh-cover-masthead__nav-link">
                {s.name}
              </Link>
            ))}
          </div>
          <span className="rh-cover-masthead__nav-hint">↓ Scroll for the issue</span>
        </nav>
      </div>

      <main id="main" tabIndex={-1}>

        {/* ============================================================
            2. IN THIS ISSUE
            ============================================================ */}
        <section className="rh-in-this-issue rh-section" aria-labelledby="rh-in-this-issue-heading">
          <div className="rh-container">
            <div className="rh-in-this-issue__inner">
              <div>
                <h2 id="rh-in-this-issue-heading" className="rh-in-this-issue__issue-label">
                  In This Issue
                </h2>
                <p className="rh-in-this-issue__issue-meta">Issue 03 · Feb 2026</p>
              </div>

              <div className="rh-in-this-issue__grid">
                {contentRows.map((article, idx) => (
                  <Link key={article.id} href={`/articles/${article.slug}`} className="rh-contents-row-link">
                    <div className="rh-contents-row">
                      <span className="rh-contents-row__number">
                        {String(idx + 1).padStart(2, '0')}
                      </span>
                      <div className="rh-contents-row__body">
                        <span className="rh-eyebrow">{article.category.name}</span>
                        <p className="rh-contents-row__headline">{article.title}</p>
                        <span className="rh-byline">By {article.author.name}</span>
                      </div>
                      <span className="rh-contents-row__page">p.&nbsp;{18 + (idx + 1) * 12}</span>
                    </div>
                  </Link>
                ))}
              </div>
            </div>
          </div>
        </section>

        {/* ============================================================
            3. SPONSOR STRIP
            ============================================================ */}
        <div className="rh-sponsor-strip" aria-label="Advertisement">
          <div className="rh-ad rh-ad--leader">
            Advertisement · 970 × 90
          </div>
        </div>

        {/* ============================================================
            4. THE HOT LIST
            ============================================================ */}
        <section className="rh-hot-list rh-section" aria-labelledby="rh-hot-list-heading">
          <div className="rh-container">
            <div className="rh-section-header rh-section-header--ruled">
              <h2 id="rh-hot-list-heading" className="rh-section-header__title">The Hot List</h2>
            </div>

            <div className="rh-hot-list__grid">
              {/* Hero card */}
              <Link href={`/articles/${hotList[0].slug}`} className="rh-story-card-link">
                <article className="rh-story-card rh-story-card--xl">
                  <div className="rh-story-card__image">
                    <span className="rh-tag rh-story-card__tag">{hotList[0].category.name}</span>
                    <Image
                      src={hotList[0].featuredImage}
                      alt={hotList[0].title}
                      width={800}
                      height={1000}
                      className="rh-photo"
                      style={{ width: '100%', height: '100%', objectFit: 'cover', aspectRatio: '4/5' }}
                    />
                  </div>
                  <div className="rh-story-card__body">
                    <span className="rh-eyebrow">{hotList[0].category.name}</span>
                    <h3 className="rh-story-card__headline">{hotList[0].title}</h3>
                    <span className="rh-byline">By {hotList[0].author.name}</span>
                  </div>
                </article>
              </Link>

              {/* Stacked 2 cards */}
              <div className="rh-hot-list__stacked">
                {hotList.slice(1, 3).map((article) => (
                  <Link key={article.id} href={`/articles/${article.slug}`} className="rh-story-card-link">
                    <article className="rh-story-card rh-story-card--m">
                      <div className="rh-story-card__image">
                        <span className="rh-tag rh-story-card__tag">{article.category.name}</span>
                        <Image
                          src={article.featuredImage}
                          alt={article.title}
                          width={800}
                          height={450}
                          className="rh-photo"
                          style={{ width: '100%', objectFit: 'cover', aspectRatio: '16/9' }}
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

              {/* Sidebar */}
              <div className="rh-hot-list__sidebar rh-sidebar">
                <div className="rh-sidebar-block">
                  <div className="rh-ad rh-ad--rect">Advertisement · 300 × 300</div>
                </div>
                <div className="rh-sidebar-block">
                  <div className="rh-sidebar-block__label">Most Read</div>
                  {mostRead.map((article, i) => (
                    <Link key={article.id} href={`/articles/${article.slug}`} className="rh-ticker-item-link">
                      <div className="rh-ticker-item">
                        <span className="rh-ticker-item__index">{String(i + 1).padStart(2, '0')}</span>
                        <div>
                          <span className="rh-eyebrow">{article.category.name}</span>
                          <p className="rh-ticker-item__headline">{article.title}</p>
                          <span className="rh-ticker-item__byline">By {article.author.name}</span>
                        </div>
                      </div>
                    </Link>
                  ))}
                </div>
              </div>
            </div>
          </div>
        </section>

        {/* ============================================================
            5. DEPARTMENT SPOTLIGHTS
            ============================================================ */}
        <section className="rh-dept-spotlights-section rh-section" aria-labelledby="rh-spotlights-heading">
          <div className="rh-container">
            <h2
              id="rh-spotlights-heading"
              className="rh-section-header__title"
              style={{ textAlign: 'center', marginBottom: '32px' }}
            >
              Department Spotlights
            </h2>
            <div className="rh-dept-spotlights">
              {spotlights.map((sp) => (
                <div key={sp.dept} className={`rh-dept-spotlight ${sp.class}`}>
                  <Image
                    src={sp.img}
                    alt={sp.title}
                    width={800}
                    height={600}
                    className="rh-dept-spotlight__image rh-photo"
                    style={{ objectFit: 'cover' }}
                  />
                  <h3 className="rh-dept-spotlight__title">{sp.title}</h3>
                  <p className="rh-dept-spotlight__dek">{sp.dek}</p>
                  <Link href={sp.href} className="rh-dept-spotlight__cta">
                    Read All →
                  </Link>
                </div>
              ))}
            </div>
          </div>
        </section>

        {/* ============================================================
            6. ALL DEPARTMENTS
            ============================================================ */}
        <section className="rh-all-depts rh-section" aria-labelledby="rh-all-depts-heading">
          <div className="rh-container">
            <h2 id="rh-all-depts-heading" className="rh-all-depts__heading">
              All Departments
            </h2>
            <div className="rh-all-depts__grid">
              {allDepartments.map((dept, idx) => (
                <Link
                  key={dept.slug}
                  href={`/category/${dept.slug}`}
                  className="rh-dept-index-item"
                >
                  <span className="rh-dept-index-item__num">
                    {String(idx + 1).padStart(2, '0')}
                  </span>
                  <span className="rh-dept-index-item__name">{dept.name}</span>
                  <span className="rh-dept-index-item__arrow" aria-hidden="true">→</span>
                </Link>
              ))}
            </div>
          </div>
        </section>

      </main>

      <Footer />
    </div>
  )
}
