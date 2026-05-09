'use client'

import { useState, useEffect } from 'react'
import Link from 'next/link'
import Image from 'next/image'
import { ChevronLeftIcon, ChevronRightIcon } from '@heroicons/react/24/outline'
import { Article } from '@/types'
import { format } from 'date-fns'

interface HeroSectionProps {
  articles: Article[]
}

export default function HeroSection({ articles }: HeroSectionProps) {
  const [currentSlide, setCurrentSlide] = useState(0)
  const [isAutoPlaying, setIsAutoPlaying] = useState(true)

  useEffect(() => {
    if (!isAutoPlaying) return

    const interval = setInterval(() => {
      setCurrentSlide((prev) => (prev + 1) % articles.length)
    }, 5000)

    return () => clearInterval(interval)
  }, [articles.length, isAutoPlaying])

  const goToSlide = (index: number) => {
    setCurrentSlide(index)
    setIsAutoPlaying(false)
    setTimeout(() => setIsAutoPlaying(true), 10000) // Resume auto-play after 10 seconds
  }

  const goToPrevious = () => {
    setCurrentSlide((prev) => (prev - 1 + articles.length) % articles.length)
    setIsAutoPlaying(false)
  }

  const goToNext = () => {
    setCurrentSlide((prev) => (prev + 1) % articles.length)
    setIsAutoPlaying(false)
  }

  if (!articles.length) return null

  const currentArticle = articles[currentSlide]

  return (
    <section className="relative h-[60vh] md:h-[70vh] overflow-hidden">
      {/* Background Image */}
      <div className="absolute inset-0">
        <Image
          src={currentArticle.featuredImage}
          alt={currentArticle.imageAlt}
          fill
          className="object-cover transition-opacity duration-500"
          priority
        />
        <div className="absolute inset-0 bg-black bg-opacity-40" />
      </div>

      {/* Content Overlay */}
      <div className="relative h-full flex items-end">
        <div className="container-magazine pb-12 md:pb-16">
          <div className="max-w-3xl text-white">
            {/* Category Badge */}
            <Link
              href={`/category/${currentArticle.category.slug}`}
              className="inline-block bg-primary-red text-white px-4 py-2 text-sm font-medium uppercase tracking-wide mb-4 hover:bg-red-700 transition-colors"
            >
              {currentArticle.category.name}
            </Link>

            {/* Title */}
            <h1 className="text-3xl md:text-5xl lg:text-6xl font-serif font-bold leading-tight mb-4">
              <Link
                href={`/articles/${currentArticle.slug}`}
                className="hover:text-gray-200 transition-colors"
              >
                {currentArticle.title}
              </Link>
            </h1>

            {/* Excerpt */}
            <p className="text-lg md:text-xl text-gray-200 leading-relaxed mb-6 max-w-2xl">
              {currentArticle.excerpt}
            </p>

            {/* Meta Information */}
            <div className="flex items-center space-x-6 text-sm text-gray-300">
              <div className="flex items-center space-x-2">
                {currentArticle.author.avatar && (
                  <Image
                    src={currentArticle.author.avatar}
                    alt={currentArticle.author.name}
                    width={32}
                    height={32}
                    className="rounded-full"
                  />
                )}
                <span>By {currentArticle.author.name}</span>
              </div>
              <time dateTime={currentArticle.publishedAt}>
                {format(new Date(currentArticle.publishedAt), 'MMMM d, yyyy')}
              </time>
              <span>{currentArticle.readTime} min read</span>
            </div>
          </div>
        </div>
      </div>

      {/* Navigation Controls */}
      {articles.length > 1 && (
        <>
          {/* Arrow Navigation */}
          <button
            onClick={goToPrevious}
            className="absolute left-4 top-1/2 -translate-y-1/2 bg-black bg-opacity-50 hover:bg-opacity-75 text-white p-2 transition-all duration-200"
            aria-label="Previous article"
          >
            <ChevronLeftIcon className="h-6 w-6" />
          </button>
          <button
            onClick={goToNext}
            className="absolute right-4 top-1/2 -translate-y-1/2 bg-black bg-opacity-50 hover:bg-opacity-75 text-white p-2 transition-all duration-200"
            aria-label="Next article"
          >
            <ChevronRightIcon className="h-6 w-6" />
          </button>

          {/* Dot Indicators */}
          <div className="absolute bottom-4 left-1/2 -translate-x-1/2 flex space-x-2">
            {articles.map((_, index) => (
              <button
                key={index}
                onClick={() => goToSlide(index)}
                className={`w-3 h-3 rounded-full transition-all duration-200 ${
                  index === currentSlide
                    ? 'bg-white'
                    : 'bg-white bg-opacity-50 hover:bg-opacity-75'
                }`}
                aria-label={`Go to slide ${index + 1}`}
              />
            ))}
          </div>
        </>
      )}

      {/* Thumbnail Navigation (Desktop) */}
      {articles.length > 1 && (
        <div className="hidden lg:block absolute bottom-0 left-0 right-0 bg-black bg-opacity-75">
          <div className="container-magazine py-4">
            <div className="flex space-x-4 overflow-x-auto">
              {articles.map((article, index) => (
                <button
                  key={article.id}
                  onClick={() => goToSlide(index)}
                  className={`flex-shrink-0 flex items-center space-x-3 p-3 rounded transition-all duration-200 ${
                    index === currentSlide
                      ? 'bg-white bg-opacity-20'
                      : 'hover:bg-white hover:bg-opacity-10'
                  }`}
                >
                  <Image
                    src={article.featuredImage}
                    alt={article.imageAlt}
                    width={60}
                    height={40}
                    className="object-cover rounded"
                  />
                  <div className="text-left text-white min-w-0">
                    <h4 className="text-sm font-medium truncate max-w-xs">
                      {article.title}
                    </h4>
                    <p className="text-xs text-gray-300">
                      {article.category.name}
                    </p>
                  </div>
                </button>
              ))}
            </div>
          </div>
        </div>
      )}
    </section>
  )
}
