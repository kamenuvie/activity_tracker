# Performance Optimization Guide

This document outlines all performance optimizations implemented in the Daily~Track application.

## Implemented Optimizations

### 1. Frontend Performance

#### Resource Hints
- **DNS Prefetch**: Resolves DNS for external resources before they're needed
- **Preconnect**: Establishes early connections to fonts.bunny.net with CORS
- **Display Swap**: Fonts use `display=swap` to prevent render-blocking

#### Asset Loading
- **Vite Build Tool**: Fast, modern build tool for optimal bundling
- **CSS Purging**: Tailwind CSS automatically purges unused styles in production
- **Minification**: Assets are automatically minified in production builds

### 2. Backend Performance

#### Database Optimizations
- **Lazy Loading Prevention**: Prevents N+1 query problems in development
  - Configured in `AppServiceProvider.php`
  - Throws exceptions when lazy loading is detected
  - Only enabled in non-production environments

#### Query Optimization
- **Eager Loading**: Use `with()` to load relationships efficiently
  ```php
  $activities = Activity::with(['latestUpdate.user'])->get();
  ```

### 3. Caching Strategies

#### Route Caching (Production)
```bash
php artisan route:cache
php artisan config:cache
php artisan view:cache
```

#### View Compilation
- Views are compiled and cached automatically
- Clear cache during development: `php artisan view:clear`

### 4. Design Performance

#### Optimized Animations
- **CSS Transform**: Uses GPU-accelerated transforms
- **Will-Change**: Applied to animated elements for better performance
- **Reduced Motion**: Respects user's motion preferences

#### Responsive Images
- SVG icons used instead of images where possible
- Inline SVG for critical icons to reduce HTTP requests

## Production Deployment Checklist

### Before Deploy

```bash
# 1. Optimize Composer autoloader
composer install --optimize-autoloader --no-dev

# 2. Cache configuration
php artisan config:cache

# 3. Cache routes
php artisan route:cache

# 4. Cache views
php artisan view:cache

# 5. Build assets for production
npm run build

# 6. Optimize database (optional)
php artisan optimize
```

### Environment Settings

```env
APP_ENV=production
APP_DEBUG=false

# Session & Cache
SESSION_DRIVER=redis  # or memcached
CACHE_DRIVER=redis    # or memcached
QUEUE_CONNECTION=redis

# Database
DB_CONNECTION=mysql
```

## Performance Monitoring

### Key Metrics to Track

1. **Page Load Time**: Target < 2 seconds
2. **Time to First Byte (TTFB)**: Target < 600ms
3. **First Contentful Paint (FCP)**: Target < 1.8s
4. **Largest Contentful Paint (LCP)**: Target < 2.5s

### Tools

- Chrome DevTools Lighthouse
- Laravel Telescope (development)
- Laravel Debugbar (development)

## Advanced Optimizations (Optional)

### CDN Integration
- Serve static assets from CDN
- Configure in `filesystems.php`

### Database Indexing
```sql
-- Add indexes to frequently queried columns
ALTER TABLE activities ADD INDEX idx_created_at (created_at);
ALTER TABLE activity_updates ADD INDEX idx_activity_id (activity_id);
ALTER TABLE activity_updates ADD INDEX idx_user_id (user_id);
```

### Redis Caching
```php
// Cache expensive queries
$activities = Cache::remember('activities.all', 3600, function () {
    return Activity::with('latestUpdate.user')->get();
});
```

### Queue Jobs
- Move heavy tasks to background jobs
- Use queue workers for email notifications
- Process reports asynchronously

## Browser Caching

### NGINX Configuration (if using NGINX)
```nginx
location ~* \.(js|css|png|jpg|jpeg|gif|svg|ico)$ {
    expires 1y;
    add_header Cache-Control "public, immutable";
}
```

### Apache Configuration (if using Apache)
```apache
<FilesMatch "\.(js|css|png|jpg|jpeg|gif|svg|ico)$">
    Header set Cache-Control "max-age=31536000, public"
</FilesMatch>
```

## Best Practices

### Database Queries
✅ **DO**: Use eager loading
```php
Activity::with(['latestUpdate.user'])->get();
```

❌ **DON'T**: Use lazy loading in loops
```php
foreach ($activities as $activity) {
    echo $activity->latestUpdate->user->name; // N+1 problem!
}
```

### Asset Loading
✅ **DO**: Use Vite's code splitting
```php
@vite(['resources/css/app.css', 'resources/js/app.js'])
```

❌ **DON'T**: Load unnecessary assets
```html
<!-- Avoid loading large libraries if not needed -->
```

### Tailwind CSS
✅ **DO**: Use Tailwind's JIT mode (already enabled)
✅ **DO**: Purge unused styles in production (automatic)
❌ **DON'T**: Add custom CSS files unless necessary

## Monitoring Performance

### Development
```bash
# Enable query logging
DB::enableQueryLog();

# View queries
dd(DB::getQueryLog());
```

### Production
- Use Laravel Horizon for queue monitoring
- Use New Relic or similar APM tools
- Set up error logging with Sentry

## Current Performance Status

✅ DNS Prefetch configured
✅ Preconnect to font provider
✅ Font display swap enabled
✅ Lazy loading prevention in dev
✅ Tailwind JIT mode active
✅ CSS purging enabled
✅ Vite for fast builds
✅ Optimized animations
✅ SVG icons for performance
✅ Responsive design
✅ Minimal HTTP requests

## Maintenance

### Weekly
- Clear old cache files
- Review slow query logs

### Monthly
- Update dependencies
- Run `composer update`
- Review and optimize database indexes

### Quarterly
- Performance audit with Lighthouse
- Review and update this guide
- Test on slow connections

---

**Last Updated**: February 28, 2026
**Application Version**: 1.0.0
