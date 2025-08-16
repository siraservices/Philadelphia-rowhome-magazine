export interface Author {
  id: string;
  name: string;
  bio?: string;
  avatar?: string;
  email?: string;
  socialLinks?: {
    twitter?: string;
    instagram?: string;
    linkedin?: string;
  };
}

export interface Category {
  id: string;
  name: string;
  slug: string;
  description?: string;
  color?: string;
}

export interface Article {
  id: string;
  title: string;
  slug: string;
  excerpt: string;
  content: string;
  featuredImage: string;
  imageAlt: string;
  imageCredit?: string;
  author: Author;
  category: Category;
  tags: string[];
  publishedAt: string;
  updatedAt?: string;
  featured: boolean;
  readTime: number;
  viewCount?: number;
  status: 'draft' | 'published' | 'archived';
  seoTitle?: string;
  seoDescription?: string;
}

export interface Event {
  id: string;
  title: string;
  description: string;
  date: string;
  time: string;
  location: string;
  image?: string;
  ticketUrl?: string;
  category: string;
}

export interface Newsletter {
  email: string;
  subscribedAt: string;
  categories?: string[];
}

export interface MenuItem {
  id: string;
  label: string;
  href: string;
  children?: MenuItem[];
}

export interface SiteConfig {
  name: string;
  description: string;
  logo: string;
  url: string;
  socialLinks: {
    facebook?: string;
    twitter?: string;
    instagram?: string;
    linkedin?: string;
  };
  navigation: {
    main: MenuItem[];
    secondary: MenuItem[];
  };
}

export interface PaginationProps {
  currentPage: number;
  totalPages: number;
  onPageChange: (page: number) => void;
}

export interface SearchResult {
  articles: Article[];
  events: Event[];
  totalResults: number;
}

export interface LayoutProps {
  children: React.ReactNode;
  title?: string;
  description?: string;
  image?: string;
  canonical?: string;
}

export type ArticleLayout = 'featured' | 'grid' | 'list' | 'minimal' | 'large';

export interface ArticleCardProps {
  article: Article;
  layout: ArticleLayout;
  showExcerpt?: boolean;
  showAuthor?: boolean;
  showDate?: boolean;
  showCategory?: boolean;
  className?: string;
}
