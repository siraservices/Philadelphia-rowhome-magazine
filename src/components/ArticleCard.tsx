import Link from 'next/link'
import Image from 'next/image'
import { format } from 'date-fns'
import { ClockIcon, UserIcon } from '@heroicons/react/24/outline'
import { ArticleCardProps } from '@/types'
import { cn } from '@/lib/utils'

export default function ArticleCard({
  article,
  layout = 'grid',
  showExcerpt = true,
  showAuthor = true,
  showDate = true,
  showCategory = true,
  className,
}: ArticleCardProps) {
  const {
    title,
    slug,
    excerpt,
    featuredImage,
    imageAlt,
    author,
    category,
    publishedAt,
    readTime,
  } = article

  const cardClasses = cn(
    'article-card group',
    {
      'flex flex-col': layout === 'grid' || layout === 'minimal',
      'flex flex-row': layout === 'list',
      'w-full': layout === 'featured' || layout === 'large',
      'h-auto': layout !== 'featured',
      'min-h-[500px]': layout === 'featured',
    },
    className
  )

  const imageClasses = cn({
    'w-full h-48 md:h-64': layout === 'grid',
    'w-full h-32': layout === 'minimal',
    'w-32 h-32 flex-shrink-0': layout === 'list',
    'w-full h-64 md:h-96': layout === 'featured' || layout === 'large',
  })

  const contentClasses = cn('article-card-content', {
    'p-6': layout === 'grid' || layout === 'featured' || layout === 'large',
    'p-4': layout === 'minimal',
    'pl-4 py-0 flex-1': layout === 'list',
  })

  return (
    <article className={cardClasses}>
      {/* Image */}
      <div className="relative overflow-hidden">
        <Link href={`/articles/${slug}`}>
          <Image
            src={featuredImage}
            alt={imageAlt}
            width={layout === 'list' ? 128 : 800}
            height={layout === 'list' ? 128 : 600}
            className={cn(imageClasses, 'object-cover transition-transform duration-300 group-hover:scale-105')}
          />
        </Link>
        
        {/* Category Badge */}
        {showCategory && (
          <div className="absolute top-4 left-4">
            <Link
              href={`/category/${category.slug}`}
              className="category-badge hover:bg-red-700 transition-colors"
            >
              {category.name}
            </Link>
          </div>
        )}
      </div>

      {/* Content */}
      <div className={contentClasses}>
        {/* Title */}
        <h3 className={cn(
          'font-serif font-bold leading-tight mb-3 group-hover:text-primary-red transition-colors',
          {
            'text-xl md:text-2xl': layout === 'grid' || layout === 'list',
            'text-lg': layout === 'minimal',
            'text-2xl md:text-4xl': layout === 'featured',
            'text-xl md:text-3xl': layout === 'large',
          }
        )}>
          <Link href={`/articles/${slug}`} className="hover:text-primary-red transition-colors">
            {title}
          </Link>
        </h3>

        {/* Excerpt */}
        {showExcerpt && excerpt && (
          <p className={cn(
            'text-text-light leading-relaxed mb-4',
            {
              'text-sm': layout === 'minimal',
              'text-base': layout === 'grid' || layout === 'list',
              'text-lg': layout === 'featured' || layout === 'large',
              'line-clamp-2': layout === 'minimal' || layout === 'list',
              'line-clamp-3': layout === 'grid',
              'line-clamp-4': layout === 'featured' || layout === 'large',
            }
          )}>
            {excerpt}
          </p>
        )}

        {/* Meta Information */}
        <div className="flex items-center justify-between text-sm text-text-muted">
          <div className="flex items-center space-x-4">
            {/* Author */}
            {showAuthor && (
              <Link
                href={`/authors/${author.id}`}
                className="flex items-center space-x-2 hover:text-text-dark transition-colors"
              >
                {author.avatar ? (
                  <Image
                    src={author.avatar}
                    alt={author.name}
                    width={24}
                    height={24}
                    className="rounded-full"
                  />
                ) : (
                  <UserIcon className="h-4 w-4" />
                )}
                <span>{author.name}</span>
              </Link>
            )}

            {/* Read Time */}
            <div className="flex items-center space-x-1">
              <ClockIcon className="h-4 w-4" />
              <span>{readTime} min read</span>
            </div>
          </div>

          {/* Date */}
          {showDate && (
            <time dateTime={publishedAt} className="text-xs">
              {format(new Date(publishedAt), 'MMM d, yyyy')}
            </time>
          )}
        </div>
      </div>
    </article>
  )
}
