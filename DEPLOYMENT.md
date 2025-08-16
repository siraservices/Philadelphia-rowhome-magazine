# 🚀 Netlify Deployment Guide

This guide will help you deploy the Philadelphia RowHome Magazine website to Netlify.

## 📋 Prerequisites

- [Git](https://git-scm.com/) installed on your computer
- A [GitHub](https://github.com/) account
- A [Netlify](https://www.netlify.com/) account (free)

## 🔧 Pre-Deployment Setup (Already Complete)

✅ **Next.js Configuration**: Updated `next.config.js` for Netlify compatibility  
✅ **Netlify Configuration**: Created `netlify.toml` with build settings  
✅ **Build Scripts**: Updated `package.json` with deployment scripts  
✅ **Dependencies**: Added Netlify Next.js plugin  
✅ **Redirects**: Created `public/_redirects` for proper routing  
✅ **Production Build**: Tested and verified working

## 🚀 Deployment Steps

### Step 1: Initialize Git Repository

```bash
git init
git add .
git commit -m "Initial commit - Philadelphia RowHome Magazine"
```

### Step 2: Create GitHub Repository

1. Go to [GitHub.com](https://github.com)
2. Click the "+" icon → "New repository"
3. Name it: `philadelphia-rowhome-magazine`
4. Leave it **public** (or private if you prefer)
5. **Don't** initialize with README (we already have files)
6. Click "Create repository"

### Step 3: Push to GitHub

Replace `YOUR_USERNAME` with your GitHub username:

```bash
git remote add origin https://github.com/YOUR_USERNAME/philadelphia-rowhome-magazine.git
git branch -M main
git push -u origin main
```

### Step 4: Deploy to Netlify

#### Option A: GitHub Integration (Recommended)

1. Go to [Netlify.com](https://www.netlify.com/)
2. Click "Add new site" → "Import an existing project"
3. Choose "Deploy with GitHub"
4. Authorize Netlify to access your GitHub account
5. Select your `philadelphia-rowhome-magazine` repository
6. Netlify will automatically detect the settings:
   - **Build command**: `npm run build`
   - **Publish directory**: `.next`
   - **Node version**: 18
7. Click "Deploy site"

#### Option B: Manual Deploy

1. Run the build command:
   ```bash
   npm run build
   ```
2. Go to [Netlify.com](https://www.netlify.com/)
3. Drag and drop the `.next` folder to the deploy area

### Step 5: Configure Custom Domain (Optional)

1. In your Netlify dashboard, go to "Site settings"
2. Click "Domain management"
3. Click "Add custom domain"
4. Enter your domain (e.g., `philadelphiarowhome.com`)
5. Follow the DNS configuration instructions

## 🔧 Environment Variables (If Needed)

For future integrations, you can add environment variables in Netlify:

1. Go to Site settings → Environment variables
2. Add any required variables:
   - `NEXT_PUBLIC_SITE_URL`: Your site URL
   - `MAILCHIMP_API_KEY`: For newsletter integration
   - `WORDPRESS_API_URL`: If connecting to WordPress

## 📱 Build Settings

The following settings are automatically configured:

| Setting | Value |
|---------|-------|
| Build Command | `npm run build` |
| Publish Directory | `.next` |
| Node Version | 18 |
| Functions Directory | `netlify/functions` |

## 🌐 Post-Deployment

### Verify Deployment

1. Check all pages load correctly:
   - Homepage: `/`
   - Articles: `/articles/skinny-cheesesteaks-healthier-philly-classic`
   - Categories: `/category/menu`
   - Subscribe: `/subscribe`

2. Test responsive design on mobile devices

3. Verify images load properly

### Performance Optimization

1. Enable Netlify's asset optimization:
   - Go to Site settings → Build & deploy → Post processing
   - Enable "Bundle CSS" and "Minify CSS"
   - Enable "Minify JS"
   - Enable "Image optimization"

2. Set up Netlify Analytics (optional):
   - Go to Site overview → Analytics
   - Enable Netlify Analytics

## 🔄 Continuous Deployment

Once connected to GitHub, Netlify will automatically:
- Deploy when you push to the `main` branch
- Generate deploy previews for pull requests
- Run build checks on all commits

### Making Updates

1. Make changes to your code
2. Commit and push to GitHub:
   ```bash
   git add .
   git commit -m "Update: description of changes"
   git push
   ```
3. Netlify will automatically rebuild and deploy

## 🔧 Troubleshooting

### Common Issues

**Build Fails:**
- Check the build log in Netlify dashboard
- Ensure all dependencies are in `package.json`
- Verify Node version compatibility

**Images Not Loading:**
- Check image URLs in the browser console
- Verify image domains in `next.config.js`

**Routing Issues:**
- Check the `_redirects` file is in the publish directory
- Verify `netlify.toml` configuration

**Slow Loading:**
- Enable Netlify optimizations
- Check image sizes and formats
- Review bundle size in build output

### Getting Help

- [Netlify Documentation](https://docs.netlify.com/)
- [Next.js on Netlify](https://docs.netlify.com/integrations/frameworks/next-js/)
- [Netlify Community Forum](https://community.netlify.com/)

## 🎉 Success!

Your Philadelphia RowHome Magazine website is now live! 

**Next Steps:**
- Set up Google Analytics
- Configure newsletter integration
- Add a CMS for content management
- Set up form handling for contact forms
- Implement search functionality

---

**Deployment URL**: Your Netlify site will be available at `https://[random-name].netlify.app`  
**Custom Domain**: Configure a custom domain for a professional URL

Happy publishing! 📰✨
