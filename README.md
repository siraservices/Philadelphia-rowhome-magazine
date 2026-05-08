# RowHome Magazine WordPress Theme

A modern, magazine-style WordPress theme for Philadelphia RowHome Magazine featuring department-based navigation, article grids, and responsive design.

## Features

- **Department-Based Navigation**: 21 customizable department sections
- **Hero Carousel**: Auto-rotating featured stories with smooth transitions
- **Responsive Grid Layouts**: Article cards with hover effects and animations
- **Newsletter Integration**: Built-in AJAX newsletter subscription
- **Custom Post Types**: Department custom post type for organized content
- **Magazine Ads Directory**: Dedicated section for partner advertisements
- **SEO Optimized**: Schema markup for articles and proper semantic HTML
- **Performance Focused**: Lazy loading images, optimized queries, and minimal dependencies
- **Accessibility**: WCAG 2.1 AA compliant with keyboard navigation support
- **Social Sharing**: Built-in social media sharing functionality

## Installation

1. Download the theme files
2. Upload to `wp-content/themes/rowhome-magazine/`
3. Activate the theme in WordPress admin
4. Go to Appearance > Customize to configure settings

## Theme Setup

### Menus
Navigate to **Appearance > Menus** to set up:
- **Primary Menu**: Main navigation (optional)
- **Department Menu**: 21 department sections (auto-generated if not set)
- **Top Bar Menu**: Quick links (Events, In the Magazine, Neighborhood)
- **Footer Menu**: Footer navigation links

### Widget Areas
The theme includes 5 widget areas:
- Sidebar (general sidebar)
- Footer 1-4 (four footer columns)

### Custom Post Types
- **Department**: Articles organized by magazine departments
- **Department Category**: Taxonomy for categorizing articles

### Image Sizes
The theme uses three custom image sizes:
- **rowhome-featured**: 1200x600px (hero/featured images)
- **rowhome-article-card**: 800x500px (article cards)
- **rowhome-small-card**: 400x300px (small cards in columns)

## Department Sections

The theme supports 21 department sections:
1. LIFE
2. BUSINESS
3. HEALTH
4. REAL ESTATE
5. MENU
6. 2025 HOTSPOTS
7. FLASHBACK
8. BRIDES GUIDE
9. MUSIC & ART
10. WRITERS BLOCK
11. FILM
12. SPORTS
13. FASHION
14. TRAVEL
15. TECH
16. EDUCATION
17. COMMUNITY
18. EVENTS
19. HISTORY
20. POLITICS
21. ENVIRONMENT

## Color Palette

- **Primary**: Black (#000000)
- **Accent**: Red (#FF0000)
- **Secondary Accents**: 
  - Yellow (#FFD700) - Hotspots section
  - Pink (#FF69B4) - Brides Guide section
  - Teal (#5f8a8b) - Music & Art section
- **Background**: White (#FFFFFF)
- **Text**: Dark Gray (#333333)

## Typography

- **Headers**: Montserrat (Bold, sans-serif)
- **Body**: Georgia (Serif)
- **Department Names**: Montserrat (All caps, condensed)

## Browser Support

- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)
- Mobile browsers (iOS Safari, Chrome Mobile)

## Performance

- Lazy loading images
- Optimized WordPress queries
- Minimal external dependencies
- Defer JavaScript loading
- Preconnect for Google Fonts

## Customization

### Adding Content

1. **Create Articles**: Use the WordPress post editor or the Department custom post type
2. **Assign Departments**: Use the Department Category taxonomy to organize content
3. **Featured Images**: Always add a featured image for best display
4. **Excerpts**: Write custom excerpts for better article preview text

### Newsletter Integration

The theme includes a built-in newsletter subscription form. Subscribers are stored in WordPress options by default. For email service provider integration (Mailchimp, ConvertKit, etc.), modify the `rowhome_magazine_newsletter_subscribe()` function in `functions.php`.

### Advertisement Banners

Ad banner placeholders are included throughout the homepage. Replace these with your ad management plugin shortcodes or custom HTML.

## Developer Notes

### Template Hierarchy

- `front-page.php`: Homepage template
- `index.php`: Archive/blog listing template
- `single.php`: Single post template
- `page.php`: Page template
- `header.php`: Header template
- `footer.php`: Footer template

### Template Parts

- `template-parts/content-card.php`: Standard article card
- `template-parts/content-card-small.php`: Small article card for columns
- `template-parts/content.php`: Single post content

### JavaScript

All JavaScript functionality is in `assets/js/main.js`:
- Hero carousel with autoplay
- Search overlay
- Newsletter form submission
- Sticky header
- Smooth scrolling
- Lazy loading
- Article card animations

### AJAX Endpoints

- `newsletter_subscribe`: Newsletter subscription handler
- `load_more_posts`: Infinite scroll/load more posts

### Filters & Actions

Available filters for customization:
- `rowhome_magazine_excerpt_length`: Modify excerpt length (default: 25 words)
- `rowhome_magazine_excerpt_more`: Modify excerpt more text (default: '...')

## Support

For theme support and documentation, visit [rowhomemagazine.com](https://rowhomemagazine.com)

## Credits

- Theme Design: RowHome Magazine LLC
- Development: Custom WordPress Theme
- Fonts: Google Fonts (Montserrat)
- Icons: SVG icons

## License

This theme is licensed under the GNU General Public License v2 or later.
See [LICENSE](http://www.gnu.org/licenses/gpl-2.0.html) for more details.

## Changelog

### Version 1.0.0
- Initial release
- Homepage layout with 21 department sections
- Hero carousel with autoplay
- Newsletter subscription
- Custom post types and taxonomies
- Responsive design
- Accessibility features
- Performance optimizations

