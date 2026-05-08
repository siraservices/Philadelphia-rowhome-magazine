# RowHome Magazine - Quick Setup Guide

## Step 1: Activate the Theme

1. Log into your WordPress admin panel
2. Navigate to **Appearance > Themes**
3. Find "RowHome Magazine" and click **Activate**

## Step 2: Configure Menus

### Create Department Menu (Optional)
The theme auto-generates a department navigation menu, but you can customize it:

1. Go to **Appearance > Menus**
2. Create a new menu called "Department Menu"
3. Add custom links for each department:
   - Example: `/department/life` with link text "PRH LIFE"
4. Assign to "Department Menu" location

### Top Bar Menu
1. Go to **Appearance > Menus**
2. Create a new menu called "Top Bar"
3. Add links:
   - Events
   - In the Magazine
   - Neighborhood
4. Assign to "Top Bar Menu" location

## Step 3: Create Content

### Add Articles with Departments

1. Go to **Posts > Add New** or **Departments > Add New**
2. Write your article content
3. Add a **Featured Image** (required for best display)
4. Assign a **Department Category**:
   - Go to the right sidebar
   - Under "Department Category" select or create:
     - life
     - business
     - health
     - real-estate
     - menu
     - 2025-hotspots
     - brides-guide
     - music-art
     - writers-block
     - etc.

### Department Category Slugs
Make sure to use these exact slugs when creating department categories:
- `life`
- `business`
- `health`
- `real-estate`
- `menu`
- `2025-hotspots`
- `flashback`
- `brides-guide`
- `music-art`
- `writers-block`
- `film`
- `sports`
- `fashion`
- `travel`
- `tech`
- `education`
- `community`
- `events`
- `history`
- `politics`
- `environment`

## Step 4: Homepage Setup

The homepage (`front-page.php`) will automatically display content based on department categories:

- **Hero Carousel**: Edit the carousel slides in `front-page.php` or replace with dynamic content
- **LIFE Section**: Automatically pulls from 'life' category
- **2025 HOTSPOTS**: Pulls from '2025-hotspots' category
- **Business, Health, Real Estate, Menu**: Pull from respective categories

## Step 5: Widget Areas (Optional)

Configure widget areas at **Appearance > Widgets**:

1. **Sidebar**: General sidebar widgets
2. **Footer 1-4**: Four footer columns for custom content

## Step 6: Settings

### Reading Settings
1. Go to **Settings > Reading**
2. Set "Your homepage displays" to "A static page"
3. Select "Homepage" for the front page (if you created one)
   - OR leave as "Your latest posts" to use `front-page.php` automatically

### Permalink Settings
1. Go to **Settings > Permalinks**
2. Choose "Post name" structure for clean URLs
3. Save changes

## Step 7: Create Essential Pages

Create these pages for footer links:
- About Us
- Contact Us
- Editorial Guidelines
- Privacy Notice
- Cookie Policy
- Terms of Use
- Advertising

## Step 8: Newsletter Integration

The newsletter form is ready to use. By default, it saves emails to WordPress options.

### To integrate with an email service:

1. Open `functions.php`
2. Find the `rowhome_magazine_newsletter_subscribe()` function (line ~282)
3. Replace the default code with your email service API integration:

```php
// Example for Mailchimp
$api_key = 'your-api-key';
$list_id = 'your-list-id';
// Add your integration code here
```

## Step 9: Add Real Images

Replace placeholder images with real photos:

1. Upload images to **Media > Add New**
2. Set as Featured Images on posts
3. Recommended sizes:
   - Featured/Hero: 1200x600px
   - Article Cards: 800x500px
   - Small Cards: 400x300px

## Step 10: Advertisement Integration

Replace ad banner placeholders:

1. Install an ad management plugin (like Ad Inserter or Advanced Ads)
2. Edit `front-page.php`
3. Replace `<section class="ad-banner">` code with your ad plugin shortcodes

## Customization Tips

### Change Colors
Edit `style.css` and update these CSS variables:
- Primary Red: `#FF0000`
- Black Header: `#000000`
- Yellow Hotspots: `#FFD700`
- Pink Brides: `#FF69B4`
- Teal Music: `#5f8a8b`

### Modify Carousel
Edit carousel slides in `front-page.php` (lines ~18-48)

### Adjust Layout
Article grid classes in templates:
- `grid-1-3`: 2-column layout (1 large + 1 small)
- `grid-4`: 4-column grid
- `grid-3`: 3-column grid
- `grid-2`: 2-column grid

### Add More Departments
Edit `header.php` (line ~76) to add/remove departments from the navigation menu

## Testing Checklist

- [ ] Homepage displays correctly
- [ ] Department navigation is scrollable
- [ ] Carousel auto-rotates every 5 seconds
- [ ] Search overlay opens and closes
- [ ] Newsletter form submits (check console for errors)
- [ ] Article cards have hover effects
- [ ] Mobile responsive design works
- [ ] Footer displays social icons
- [ ] Single post pages display correctly
- [ ] Comments work (if enabled)

## Troubleshooting

### Carousel Not Working
- Check browser console for JavaScript errors
- Ensure jQuery is loaded
- Verify `main.js` is enqueued in `functions.php`

### Department Articles Not Showing
- Verify you've created the department category with exact slug
- Ensure posts are assigned to that category
- Check that posts are published (not drafts)

### Newsletter Form Not Working
- Check AJAX URL in browser console
- Verify nonce is being generated
- Check `rowhome_magazine_newsletter_subscribe()` function

### Images Not Loading
- Verify featured images are set on posts
- Check image uploads in Media Library
- Ensure WordPress has correct file permissions

## Performance Optimization

1. **Install a caching plugin**: WP Super Cache or W3 Total Cache
2. **Image optimization**: Install Smush or ShortPixel
3. **CDN**: Consider using Cloudflare
4. **Database optimization**: WP-Optimize plugin

## Support Resources

- WordPress Codex: https://codex.wordpress.org/
- Theme Documentation: See README.md
- Contact: support@rowhomemagazine.com

## What's Next?

1. Add at least 10-15 articles in various departments
2. Customize colors to match your brand
3. Set up Google Analytics
4. Configure SEO plugin (Yoast or Rank Math)
5. Test across different browsers and devices
6. Launch and share your magazine!

---

**Version**: 1.0.0  
**Last Updated**: November 20, 2025  
**Theme**: RowHome Magazine by RowHome Magazine LLC

