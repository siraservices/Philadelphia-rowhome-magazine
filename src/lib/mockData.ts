import { Article, Author, Category, Event } from '@/types'

export const authors: Author[] = [
  {
    id: '1',
    name: 'Sarah Mitchell',
    bio: 'Food and culture writer covering Philadelphia neighborhoods',
    avatar: 'https://images.unsplash.com/photo-1494790108755-2616b612b786?w=150&h=150&fit=crop&crop=face',
    socialLinks: {
      twitter: '@sarahmitchell',
      instagram: '@sarahmitchell_food',
    },
  },
  {
    id: '2',
    name: 'Marcus Johnson',
    bio: 'Real estate expert and community advocate',
    avatar: 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=150&h=150&fit=crop&crop=face',
    socialLinks: {
      linkedin: 'marcus-johnson-realestate',
    },
  },
  {
    id: '3',
    name: 'Elena Rodriguez',
    bio: 'Arts and entertainment correspondent',
    avatar: 'https://images.unsplash.com/photo-1580489944761-15a19d654956?w=150&h=150&fit=crop&crop=face',
    socialLinks: {
      twitter: '@elenaarts',
      instagram: '@elena_philly_arts',
    },
  },
]

export const categories: Category[] = [
  { id: '1', name: 'Food & Dining', slug: 'menu', color: '#FF0000' },
  { id: '2', name: 'Real Estate', slug: 'real-estate', color: '#7FADA9' },
  { id: '3', name: 'Arts & Culture', slug: 'arts', color: '#FF0000' },
  { id: '4', name: 'Life', slug: 'life', color: '#FF0000' },
  { id: '5', name: 'Business', slug: 'business', color: '#7FADA9' },
  { id: '6', name: 'Health', slug: 'health', color: '#FF0000' },
  { id: '7', name: 'Weddings', slug: 'weddings', color: '#7FADA9' },
]

export const mockArticles: Article[] = [
  {
    id: '1',
    title: 'Skinny CHEESESTEAKS: A Healthier Take on Philly\'s Classic',
    slug: 'skinny-cheesesteaks-healthier-philly-classic',
    excerpt: 'Local chef reimagines the iconic Philadelphia cheesesteak with fresh, lighter ingredients while maintaining all the flavor that makes it a city staple.',
    content: 'Full article content would go here...',
    featuredImage: 'https://images.unsplash.com/photo-1568901346375-23c9450c58cd?w=800&h=600&fit=crop',
    imageAlt: 'Healthy cheesesteak with vegetables',
    imageCredit: 'Photo by John Smith',
    author: authors[0],
    category: categories[0],
    tags: ['food', 'health', 'philadelphia', 'cheesesteak'],
    publishedAt: '2024-01-15T10:00:00Z',
    featured: true,
    readTime: 5,
    status: 'published',
  },
  {
    id: '2',
    title: 'A TRIBUTE TO FAMILY TRADITIONS: Passing Down Stories Through Food',
    slug: 'tribute-family-traditions-food-stories',
    excerpt: 'Three generations of Philadelphia families share how recipes and cooking traditions keep their heritage alive in the modern city.',
    content: 'Full article content would go here...',
    featuredImage: 'https://images.unsplash.com/photo-1577303935007-0d306ee4ea10?w=800&h=600&fit=crop',
    imageAlt: 'Multi-generational family cooking together',
    imageCredit: 'Photo by Maria Garcia',
    author: authors[0],
    category: categories[3],
    tags: ['family', 'tradition', 'culture', 'food'],
    publishedAt: '2024-01-14T14:30:00Z',
    featured: true,
    readTime: 8,
    status: 'published',
  },
  {
    id: '3',
    title: 'The Rise of Boutique Real Estate in Fishtown',
    slug: 'boutique-real-estate-fishtown-rise',
    excerpt: 'How former industrial spaces are being transformed into unique residential properties that attract young professionals and artists.',
    content: 'Full article content would go here...',
    featuredImage: 'https://images.unsplash.com/photo-1560518883-ce09059eeffa?w=800&h=600&fit=crop',
    imageAlt: 'Modern loft apartment in converted warehouse',
    imageCredit: 'Photo by Architectural Digest',
    author: authors[1],
    category: categories[1],
    tags: ['real-estate', 'fishtown', 'development', 'architecture'],
    publishedAt: '2024-01-13T09:15:00Z',
    featured: false,
    readTime: 6,
    status: 'published',
  },
  {
    id: '4',
    title: 'Street Art Renaissance: Murals Transforming Philadelphia',
    slug: 'street-art-renaissance-murals-philadelphia',
    excerpt: 'Exploring the vibrant mural scene that has made Philadelphia one of the world\'s premier street art destinations.',
    content: 'Full article content would go here...',
    featuredImage: 'https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=800&h=600&fit=crop',
    imageAlt: 'Colorful mural on Philadelphia building',
    imageCredit: 'Photo by Street Art Collective',
    author: authors[2],
    category: categories[2],
    tags: ['art', 'murals', 'culture', 'community'],
    publishedAt: '2024-01-12T16:45:00Z',
    featured: false,
    readTime: 7,
    status: 'published',
  },
  {
    id: '5',
    title: 'Small Business Spotlight: Coffee Roasters Leading the Local Movement',
    slug: 'small-business-coffee-roasters-local-movement',
    excerpt: 'Meet the entrepreneurs behind Philadelphia\'s thriving independent coffee scene and learn how they\'re building community one cup at a time.',
    content: 'Full article content would go here...',
    featuredImage: 'https://images.unsplash.com/photo-1495774856032-8b90bbb32b32?w=800&h=600&fit=crop',
    imageAlt: 'Coffee roasting equipment in local cafe',
    imageCredit: 'Photo by Coffee Culture Magazine',
    author: authors[0],
    category: categories[4],
    tags: ['business', 'coffee', 'entrepreneurship', 'local'],
    publishedAt: '2024-01-11T11:20:00Z',
    featured: false,
    readTime: 4,
    status: 'published',
  },
  {
    id: '6',
    title: 'Wellness Wednesday: Yoga Studios Bringing Zen to Urban Living',
    slug: 'wellness-yoga-studios-zen-urban-living',
    excerpt: 'Discover how Philadelphia\'s yoga community is creating peaceful spaces for mindfulness and wellness in the heart of the city.',
    content: 'Full article content would go here...',
    featuredImage: 'https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?w=800&h=600&fit=crop',
    imageAlt: 'Yoga class in modern studio with city view',
    imageCredit: 'Photo by Wellness Weekly',
    author: authors[2],
    category: categories[5],
    tags: ['health', 'wellness', 'yoga', 'mindfulness'],
    publishedAt: '2024-01-10T08:00:00Z',
    featured: false,
    readTime: 5,
    status: 'published',
  },
]

export const mockEvents: Event[] = [
  {
    id: '1',
    title: 'First Friday Art Walk',
    description: 'Monthly art gallery hop through Old City featuring local artists and new exhibitions.',
    date: '2024-02-02',
    time: '6:00 PM - 10:00 PM',
    location: 'Old City Arts District',
    image: 'https://images.unsplash.com/photo-1513475382585-d06e58bcb0e0?w=400&h=300&fit=crop',
    category: 'Arts',
    ticketUrl: 'https://example.com/tickets',
  },
  {
    id: '2',
    title: 'Philadelphia Restaurant Week',
    description: 'Special prix fixe menus at the city\'s top restaurants.',
    date: '2024-02-15',
    time: 'All Day',
    location: 'Citywide',
    image: 'https://images.unsplash.com/photo-1555396273-367ea4eb4db5?w=400&h=300&fit=crop',
    category: 'Food',
  },
  {
    id: '3',
    title: 'Real Estate Market Update Seminar',
    description: 'Expert panel discussion on Philadelphia\'s current real estate trends and opportunities.',
    date: '2024-02-20',
    time: '7:00 PM - 9:00 PM',
    location: 'Center City Conference Center',
    image: 'https://images.unsplash.com/photo-1560472354-b33ff0c44a43?w=400&h=300&fit=crop',
    category: 'Business',
    ticketUrl: 'https://example.com/tickets',
  },
]

export function getFeaturedArticles(): Article[] {
  return mockArticles.filter(article => article.featured)
}

export function getArticlesByCategory(categorySlug: string): Article[] {
  return mockArticles.filter(article => article.category.slug === categorySlug)
}

export function getLatestArticles(limit: number = 6): Article[] {
  return mockArticles
    .sort((a, b) => new Date(b.publishedAt).getTime() - new Date(a.publishedAt).getTime())
    .slice(0, limit)
}
