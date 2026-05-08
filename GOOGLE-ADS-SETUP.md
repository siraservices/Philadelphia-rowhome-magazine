# Google Ads Integration Setup Guide

This theme now includes Google AdSense integration. All "Web Banner" placeholders throughout the site have been replaced with Google AdSense ad units.

## Quick Setup

### Step 1: Get Your Google AdSense Publisher ID

1. Sign up for Google AdSense at https://www.google.com/adsense/
2. Once approved, you'll receive your Publisher ID (format: `ca-pub-XXXXXXXXXX`)

### Step 2: Add Your Publisher ID

You have two options:

#### Option A: Add to wp-config.php (Recommended)
Add this line to your `wp-config.php` file (before the "That's all, stop editing!" line):

```php
define('GOOGLE_ADSENSE_PUBLISHER_ID', 'ca-pub-XXXXXXXXXX');
```

Replace `ca-pub-XXXXXXXXXX` with your actual Publisher ID.

#### Option B: Use Theme Customizer
1. Go to **Appearance > Customize** in WordPress admin
2. Look for "Google AdSense Settings" section
3. Enter your Publisher ID

### Step 3: Create Ad Units in Google AdSense

1. Log into your Google AdSense account
2. Go to **Ads > By ad unit**
3. Create ad units for each placement:
   - **Top Banner** (horizontal, responsive)
   - **Sidebar Ads** (vertical, responsive) - You'll need multiple for different sections
   - **Below Content Ads** (horizontal, responsive)

4. For each ad unit, note the **Ad unit ID** (format: `1234567890`)

### Step 4: Update Ad Slots in front-page.php

Once you have your ad unit IDs, you can update the `rowhome_magazine_display_adsense_ad()` function calls in `front-page.php`:

**Current placeholder format:**
```php
<?php rowhome_magazine_display_adsense_ad('', 'auto', 'responsive', '', true); ?>
```

**Updated with your ad slot ID:**
```php
<?php rowhome_magazine_display_adsense_ad('1234567890', 'auto', 'responsive', '', true); ?>
```

## Ad Placement Locations

The following locations have been set up for ads:

1. **Top Banner** (Line ~13 in front-page.php)
   - Horizontal banner above hero carousel
   - Format: Responsive horizontal

2. **Shared Sidebar Ad** (Line ~187 in front-page.php)
   - Vertical sidebar ad for LIFE & HOTSPOTS sections
   - Format: Responsive vertical

3. **Below Real Estate** (Line ~395 in front-page.php)
   - Horizontal banner after Real Estate section
   - Format: Responsive horizontal

4. **Brides Sidebar Banner** (Line ~544 in front-page.php)
   - Vertical sidebar ad in Brides Guide section
   - Format: Responsive vertical

5. **Music & Art Left Banner** (Line ~560 in front-page.php)
   - Vertical sidebar ad in Music & Art section
   - Format: Responsive vertical

6. **Below Music & Art** (Line ~643 in front-page.php)
   - Horizontal banner after Music & Art section
   - Format: Responsive horizontal

## Function Parameters

The `rowhome_magazine_display_adsense_ad()` function accepts these parameters:

```php
rowhome_magazine_display_adsense_ad($ad_slot, $ad_format, $ad_size, $ad_style, $show_label)
```

- **$ad_slot** (string): Your AdSense ad unit ID (e.g., '1234567890')
- **$ad_format** (string): Ad format - 'auto', 'horizontal', 'vertical', 'rectangle', 'square'
- **$ad_size** (string): Ad size - 'responsive' or specific size like '728x90', '300x250', '300x600'
- **$ad_style** (string): Additional CSS classes (e.g., 'vertical-ad')
- **$show_label** (bool): Whether to show "Advertisement" label (true/false)

## Example Usage

### Responsive Horizontal Banner
```php
<?php rowhome_magazine_display_adsense_ad('1234567890', 'auto', 'responsive', '', true); ?>
```

### Responsive Vertical Sidebar Ad
```php
<?php rowhome_magazine_display_adsense_ad('1234567890', 'auto', 'responsive', 'vertical-ad', true); ?>
```

### Fixed Size Banner (728x90)
```php
<?php rowhome_magazine_display_adsense_ad('1234567890', 'horizontal', '728x90', '', false); ?>
```

### Fixed Size Vertical Ad (300x600)
```php
<?php rowhome_magazine_display_adsense_ad('1234567890', 'vertical', '300x600', 'vertical-ad', false); ?>
```

## Testing

- If no Publisher ID is set, the placeholders will show "Web Banner" text
- Once you add your Publisher ID, ads will automatically load
- Use Google AdSense's preview tool to test ad display
- Make sure your site is approved by Google AdSense before ads will show to visitors

## Important Notes

1. **AdSense Approval**: Your site must be approved by Google AdSense before ads will display to visitors
2. **Ad Blockers**: Some users may have ad blockers that prevent ads from showing
3. **Multiple Ad Units**: You can use the same ad unit ID in multiple locations, or create separate ad units for better tracking
4. **Responsive Ads**: The default setup uses responsive ads that automatically adjust to screen size
5. **Performance**: Ads are loaded asynchronously to avoid slowing down your site

## Troubleshooting

- **Ads not showing**: Check that your Publisher ID is correct and your site is approved
- **Wrong ad sizes**: Verify your ad unit settings in Google AdSense match the function parameters
- **Layout issues**: Check that the CSS classes match your design (especially for vertical ads)

## Support

For Google AdSense specific issues, visit: https://support.google.com/adsense

