# Philadelphia RowHome Magazine

A modern, responsive magazine website built with Next.js, TypeScript, and Tailwind CSS. This application recreates the professional design and functionality of Philadelphia RowHome Magazine with a focus on local stories, culture, and community.

## 🚀 Features

### Core Functionality
- **Responsive Design**: Mobile-first approach with elegant desktop layouts
- **Dynamic Content**: Article management system with categories and tags
- **Hero Carousel**: Featured articles with automatic rotation
- **Multiple Article Layouts**: Grid, list, featured, and minimal card designs
- **Category Filtering**: Browse articles by topic (Food, Real Estate, Arts, etc.)
- **Search Functionality**: Find articles, events, and content
- **Newsletter Signup**: Multiple subscription points throughout the site
- **Social Sharing**: Share articles across social media platforms
- **Event Listings**: Showcase upcoming Philadelphia events

### Design System
- **Typography**: Custom serif and sans-serif font combinations
- **Color Palette**: Black, red, and teal accent colors matching the brand
- **Navigation**: Multi-level menu with responsive mobile navigation
- **Components**: Reusable, modular component library
- **Accessibility**: WCAG 2.1 AA compliant design patterns

### Technical Features
- **Next.js 14**: Latest App Router with server components
- **TypeScript**: Full type safety throughout the application
- **Tailwind CSS**: Utility-first styling with custom design tokens
- **Image Optimization**: Next.js Image component with lazy loading
- **SEO Optimized**: Meta tags, OpenGraph, and structured data
- **Performance**: Optimized for Core Web Vitals

## 🛠️ Tech Stack

- **Framework**: Next.js 14 with App Router
- **Language**: TypeScript
- **Styling**: Tailwind CSS with custom design system
- **Icons**: Heroicons & Lucide React
- **Date Handling**: date-fns
- **Image Optimization**: Next.js Image component
- **Deployment Ready**: Vercel, Netlify, or any hosting platform

## 📁 Project Structure

```
PRH/
├── src/
│   ├── app/                    # Next.js App Router
│   │   ├── articles/[slug]/    # Article detail pages
│   │   ├── category/[slug]/    # Category pages
│   │   ├── layout.tsx          # Root layout
│   │   ├── page.tsx            # Homepage
│   │   └── not-found.tsx       # 404 page
│   ├── components/             # Reusable components
│   │   ├── Header.tsx          # Main navigation
│   │   ├── Footer.tsx          # Site footer
│   │   ├── HeroSection.tsx     # Featured article carousel
│   │   └── ArticleCard.tsx     # Article display component
│   ├── lib/                    # Utilities and data
│   │   ├── utils.ts            # Helper functions
│   │   └── mockData.ts         # Sample content
│   ├── styles/                 # Global styles
│   │   └── globals.css         # Tailwind and custom CSS
│   └── types/                  # TypeScript definitions
│       └── index.ts            # Type definitions
├── public/                     # Static assets
├── package.json               # Dependencies
├── tailwind.config.js         # Tailwind configuration
├── tsconfig.json              # TypeScript configuration
└── next.config.js             # Next.js configuration
```

## 🚀 Getting Started

### Prerequisites
- Node.js 18+ 
- npm or yarn

### Installation

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd PRH
   ```

2. **Install dependencies**
   ```bash
   npm install
   ```

3. **Start the development server**
   ```bash
   npm run dev
   ```

4. **Open your browser**
   Navigate to [http://localhost:3000](http://localhost:3000)

### Available Scripts

- `npm run dev` - Start development server
- `npm run build` - Build for production
- `npm run start` - Start production server
- `npm run lint` - Run ESLint
- `npm run type-check` - Run TypeScript checks

## 🎨 Design System

### Typography
- **Headlines**: Playfair Display (serif)
- **Body Text**: Inter (sans-serif)
- **Navigation**: Montserrat (display)

### Colors
- **Primary Black**: #000000
- **Accent Red**: #FF0000
- **Background Teal**: #7FADA9
- **Text Dark**: #333333
- **Text Light**: #666666

### Components
- **Article Cards**: Multiple layout options (grid, list, featured, minimal)
- **Category Badges**: Consistent styling across the site
- **Buttons**: Primary (red) and secondary (white) variants
- **Navigation**: Responsive with mobile hamburger menu

## 📝 Content Management

The application currently uses mock data for demonstration. In production, you can integrate with:

### CMS Options
- **WordPress**: Headless WordPress with REST API
- **Strapi**: Self-hosted headless CMS
- **Contentful**: Cloud-based CMS
- **Sanity**: Real-time collaborative CMS

### Content Types
- **Articles**: Title, content, author, category, tags, featured image
- **Authors**: Profile information and social links
- **Categories**: Organized content taxonomy
- **Events**: Community event listings
- **Newsletter**: Subscription management

## 🚀 Deployment

### Vercel (Recommended)
```bash
npm run build
vercel deploy
```

### Netlify
```bash
npm run build
netlify deploy --prod
```

### Self-Hosted
```bash
npm run build
npm run start
```

## 📱 Mobile Optimization

- **Responsive Images**: Optimized for all screen sizes
- **Touch-Friendly**: Appropriate touch targets
- **Performance**: Lazy loading and image optimization
- **Navigation**: Collapsible mobile menu
- **Typography**: Responsive font sizing

## 🔧 Customization

### Adding New Categories
1. Update the `categories` array in `src/lib/mockData.ts`
2. Add navigation links in `src/components/Header.tsx`
3. Create category pages if needed

### Styling Changes
1. Modify `tailwind.config.js` for design tokens
2. Update `src/styles/globals.css` for custom styles
3. Edit component classes for specific changes

### Adding Features
- Search functionality
- Comment system
- User authentication
- Admin dashboard
- Newsletter integration
- Advertisement management

## 🔗 Integration Ready

This application is designed to be integrated with:
- **WordPress**: For content management
- **Mailchimp/ConvertKit**: For newsletter management
- **Google Analytics**: For tracking
- **Social Media APIs**: For sharing
- **Payment Systems**: For subscriptions

## 📞 Support

For questions or customization needs, please refer to the documentation or create an issue in the repository.

## 📄 License

This project is created for educational and demonstration purposes. Please ensure you have appropriate licenses for any fonts, images, or content used in production.

---

Built with ❤️ for Philadelphia's vibrant community.
