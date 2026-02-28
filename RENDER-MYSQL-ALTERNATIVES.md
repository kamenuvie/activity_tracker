# 🚀 Deploy to Render with External MySQL

If Render's PostgreSQL isn't available, use external MySQL database.

---

## Option A: Planet Scale (Free MySQL)

### 1. Create Database on PlanetScale

1. Go to https://planetscale.com (free tier available)
2. Sign up and create new database: `daily-track-db`
3. Create production branch
4. Get connection string

### 2. Update render-build.sh

No changes needed - same script works!

### 3. Environment Variables on Render

```bash
# Application
APP_NAME=Daily~Track
APP_ENV=production
APP_DEBUG=false
APP_KEY=base64:YOUR_KEY_HERE
APP_URL=https://your-app.onrender.com

# Database - MySQL (PlanetScale)
DATABASE_URL=mysql://user:pass@host/database?sslmode=require

# Or separate variables:
DB_CONNECTION=mysql
DB_HOST=your-db.us-east-3.psdb.cloud
DB_PORT=3306
DB_DATABASE=daily-track-db
DB_USERNAME=your_username
DB_PASSWORD=your_password
MYSQL_ATTR_SSL_CA=/etc/ssl/certs/ca-certificates.crt

# Cache & Session
SESSION_DRIVER=database
CACHE_DRIVER=database
LOG_CHANNEL=errorlog
```

**Cost:** Free tier available (5GB storage)

---

## Option B: Railway.app (Easiest Alternative)

Railway has both MySQL AND PostgreSQL built-in!

### Quick Setup:

1. Go to https://railway.app (free $5 credit/month)
2. Sign up with GitHub
3. New Project → Deploy from GitHub
4. Add MySQL database (or PostgreSQL)
5. Environment variables auto-configured!

### Why Railway is Better:

- ✅ Built-in MySQL/PostgreSQL
- ✅ $5 free credit monthly
- ✅ Auto-deploy from GitHub
- ✅ No cold starts (vs Render free tier)
- ✅ Easier database setup

### Railway Environment Variables:

```bash
APP_KEY=base64:YOUR_KEY_HERE
APP_URL=https://${{RAILWAY_PUBLIC_DOMAIN}}

# Database auto-configured by Railway:
DB_CONNECTION=mysql
DB_HOST=${{MYSQL.MYSQLHOST}}
DB_PORT=${{MYSQL.MYSQLPORT}}
DB_DATABASE=${{MYSQL.MYSQLDATABASE}}
DB_USERNAME=${{MYSQL.MYSQLUSER}}
DB_PASSWORD=${{MYSQL.MYSQLPASSWORD}}
```

**See HOSTING-GUIDE.md for full Railway instructions!**

---

## Option C: FreeSQLDatabase.com (Free MySQL)

### 1. Get Free MySQL Database

1. Go to https://www.freesqldatabase.com
2. Sign up for free MySQL database
3. Get credentials

### 2. Use on Render

Same as Option A - just use their MySQL credentials in environment variables.

**Limitations:**
- 5MB storage on free tier
- May have reliability issues
- Not recommended for production

---

## Option D: Use SQLite (Simplest)

For student demos, you can use SQLite even in production!

### Update render-build.sh:

```bash
#!/usr/bin/env bash
set -o errexit

echo "🚀 Starting Render build process..."

# Install dependencies
composer install --no-dev --optimize-autoloader --no-interaction
npm ci
npm run build

# Create SQLite database
touch database/database.sqlite
chmod 664 database/database.sqlite

# Clear caches
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear

# Cache config
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Set permissions
chmod -R 755 storage bootstrap/cache

# Run migrations
php artisan migrate --force --no-interaction

echo "✅ Build complete!"
```

### Environment Variables on Render:

```bash
APP_NAME=Daily~Track
APP_ENV=production
APP_DEBUG=false
APP_KEY=base64:YOUR_KEY_HERE
APP_URL=https://your-app.onrender.com

DB_CONNECTION=sqlite
DB_DATABASE=/opt/render/project/src/database/database.sqlite

SESSION_DRIVER=database
CACHE_DRIVER=database
LOG_CHANNEL=errorlog
```

**Pros:**
- ✅ No external database needed
- ✅ Simple setup
- ✅ Works on Render

**Cons:**
- ⚠️ May lose data on redeploys
- ⚠️ Not for production apps
- ⚠️ OK for student demos

---

## 🎯 RECOMMENDATION

**Best option: Railway.app**

Render is good, but Railway is easier for Laravel:
- Built-in MySQL/PostgreSQL (no external services)
- Better free tier ($5 credit)
- No cold starts
- Auto-configuration

**Already have the Railway setup guide in HOSTING-GUIDE.md!**

---

## 📝 Quick Comparison

| Platform | Database | Free Tier | Ease | Cold Starts |
|----------|----------|-----------|------|-------------|
| **Railway** | ✅ MySQL/PostgreSQL | $5/month | ⭐⭐⭐⭐⭐ | ❌ None |
| Render | ⚠️ PostgreSQL only | Yes | ⭐⭐⭐ | ✅ Yes (15min) |
| Render + PlanetScale | ✅ MySQL | Yes | ⭐⭐⭐ | ✅ Yes |

---

## 🚀 Switch to Railway?

If you want to use Railway instead (recommended):

1. Open **HOSTING-GUIDE.md** in your project
2. Scroll to **"Railway.app"** section
3. Follow the Railway deployment guide
4. Much easier than Render!

**Railway gives you:**
- MySQL or PostgreSQL (your choice!)
- No database setup hassle
- $5 free credit monthly
- Auto-deploy from GitHub

Let me know if you want to switch to Railway instead!
