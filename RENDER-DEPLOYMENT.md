# 🚀 Deploy Daily~Track to Render.com

Complete guide to deploying your Laravel application on Render.com

---

## 📌 Important Note

**Laravel is a monolithic framework** - your frontend (Blade templates) and backend (PHP/Laravel) are **ONE application**, not separate services. You'll deploy everything as a single **Web Service** on Render.

---

## ✨ What You'll Get

- ✅ Free tier available (with limitations)
- ✅ Automatic HTTPS/SSL
- ✅ Auto-deploy from GitHub
- ✅ PostgreSQL database (free for 90 days, then $7/month)
- ✅ Environment variable management
- ⚠️ Free tier spins down after 15 minutes of inactivity (cold starts can be slow)

**Cost:** 
- Web Service: **Free** (or $7/month for always-on)
- PostgreSQL: **Free for 90 days**, then $7/month

---

## 📋 Prerequisites

1. GitHub account
2. Render.com account (sign up at https://render.com)
3. Your code on GitHub

---

## 🔧 Step 1: Prepare Your Project

### 1.1 Create Build Script

Create a file named `render-build.sh` in your project root:

```bash
#!/usr/bin/env bash
# exit on error
set -o errexit

# Install dependencies
composer install --no-dev --working-dir=$RENDER_APP_PATH
npm install --prefix $RENDER_APP_PATH
npm run build --prefix $RENDER_APP_PATH

# Clear and cache config
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear

# Cache production config
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Run migrations
php artisan migrate --force --no-interaction
```

Make it executable (run in terminal):
```bash
chmod +x render-build.sh
```

### 1.2 Create Start Script

Create a file named `render-start.sh` in your project root:

```bash
#!/usr/bin/env bash

# Start PHP built-in server
php artisan serve --host=0.0.0.0 --port=$PORT
```

Make it executable:
```bash
chmod +x render-start.sh
```

### 1.3 Create `render.yaml` (Optional but Recommended)

Create `render.yaml` in your project root for infrastructure-as-code:

```yaml
services:
  - type: web
    name: daily-track
    env: php
    plan: free  # or 'starter' for $7/month (always-on)
    buildCommand: "./render-build.sh"
    startCommand: "./render-start.sh"
    envVars:
      - key: APP_DEBUG
        value: false
      - key: APP_ENV
        value: production
      - key: APP_NAME
        value: Daily~Track
      - key: APP_KEY
        generateValue: true
      - key: LOG_CHANNEL
        value: errorlog
      - key: SESSION_DRIVER
        value: database
      - key: CACHE_DRIVER
        value: database

databases:
  - name: daily-track-db
    plan: free  # Free for 90 days
    databaseName: dailytrack
    user: dailytrack
```

### 1.4 Update `.env.example`

Make sure your `.env.example` has all variables:

```env
APP_NAME="Daily~Track"
APP_ENV=production
APP_KEY=
APP_DEBUG=false
APP_URL=

LOG_CHANNEL=errorlog
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=pgsql
DB_HOST=
DB_PORT=5432
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=

BROADCAST_DRIVER=log
CACHE_DRIVER=database
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=database
SESSION_LIFETIME=120

MAIL_MAILER=log
```

---

## 🚀 Step 2: Push to GitHub

```bash
# Add all files
git add .

# Commit
git commit -m "Prepare for Render deployment"

# Create repository on GitHub, then push
git remote add origin https://github.com/YOUR_USERNAME/activity-tracker.git
git branch -M main
git push -u origin main
```

---

## 🌐 Step 3: Deploy on Render.com

### 3.1 Create Database First

1. Go to https://dashboard.render.com
2. Click **"New +"** → **"PostgreSQL"**
3. Fill in the details:
   - **Name:** `daily-track-db`
   - **Database:** `dailytrack`
   - **User:** `dailytrack`
   - **Region:** Choose closest to you
   - **Plan:** Free (90 days free, then $7/month)
4. Click **"Create Database"**
5. **Save these credentials** (you'll need them):
   - Internal Database URL
   - External Database URL
   - PSQL Command
   - Host
   - Port
   - Database
   - Username
   - Password

### 3.2 Create Web Service

1. Click **"New +"** → **"Web Service"**
2. **Connect your GitHub repository:**
   - Click "Connect account" if needed
   - Select your `activity-tracker` repository
3. **Configure the service:**
   - **Name:** `daily-track`
   - **Region:** Same as database
   - **Branch:** `main`
   - **Root Directory:** (leave empty)
   - **Runtime:** `PHP`
   - **Build Command:**
     ```bash
     ./render-build.sh
     ```
   - **Start Command:**
     ```bash
     ./render-start.sh
     ```
   - **Plan:** Free (or Starter $7/month for no spin-down)

4. Click **"Advanced"** to add environment variables

---

## 🔐 Step 4: Configure Environment Variables

In the "Environment Variables" section, add these:

### Required Variables:

```bash
# Application
APP_NAME=Daily~Track
APP_ENV=production
APP_DEBUG=false
APP_KEY=  # Will generate in next step
APP_URL=  # Will be: https://daily-track.onrender.com (Render will provide)

# Logging
LOG_CHANNEL=errorlog

# Database (PostgreSQL from Render)
DB_CONNECTION=pgsql
DB_HOST=  # Copy from your database's "Internal Database URL" (hostname part)
DB_PORT=5432
DB_DATABASE=dailytrack
DB_USERNAME=  # Copy from database credentials
DB_PASSWORD=  # Copy from database credentials

# Or use the full internal connection string:
# DATABASE_URL=  # Copy "Internal Database URL" from your database

# Session & Cache
SESSION_DRIVER=database
CACHE_DRIVER=database
QUEUE_CONNECTION=sync

# Mail
MAIL_MAILER=log
```

### Easy Way to Get Database Credentials:

1. Go to your PostgreSQL database in Render dashboard
2. Click on **"Info"** tab
3. Copy the **"Internal Database URL"** - it looks like:
   ```
   postgresql://username:password@hostname:5432/database
   ```
4. Parse it:
   - **DB_HOST:** The hostname part
   - **DB_USERNAME:** The username part
   - **DB_PASSWORD:** The password part
   - **DB_DATABASE:** The database name
   - **DB_PORT:** 5432

**OR** you can just use the full URL:
```bash
DATABASE_URL=postgresql://username:password@hostname:5432/database
```

---

## 🔑 Step 5: Generate APP_KEY

### Option 1: Generate Locally

Run in your terminal:
```bash
php artisan key:generate --show
```

Copy the output (e.g., `base64:abc123...`) and paste it in Render's `APP_KEY` environment variable.

### Option 2: Use Render Shell (After first deployment)

1. Wait for initial deployment
2. Go to your web service
3. Click **"Shell"** tab
4. Run:
   ```bash
   php artisan key:generate --show
   ```
5. Copy the key and add it to environment variables
6. Trigger a manual redeploy

---

## 🎯 Step 6: Configure Database Connection (Important!)

### Update config/database.php

Since Render provides a full `DATABASE_URL`, make sure Laravel can parse it. 

The default Laravel config already supports this, but verify:

```php
'pgsql' => [
    'driver' => 'pgsql',
    'url' => env('DATABASE_URL'),  // This line is important
    'host' => env('DB_HOST', '127.0.0.1'),
    'port' => env('DB_PORT', '5432'),
    'database' => env('DB_DATABASE', 'forge'),
    'username' => env('DB_USERNAME', 'forge'),
    'password' => env('DB_PASSWORD', ''),
    // ... rest of config
],
```

---

## 📦 Step 7: Deploy!

1. After adding all environment variables, click **"Create Web Service"**
2. Render will:
   - Clone your repository
   - Run `render-build.sh` (install dependencies, build assets, run migrations)
   - Start your app with `render-start.sh`
3. Watch the deployment logs
4. After 5-10 minutes, your app will be live!

**Your URL will be:** `https://daily-track.onrender.com` (or your custom name)

---

## 🧪 Step 8: Test Your Deployment

1. Visit your Render URL
2. You should see the onboarding modal
3. Test registration:
   - Create a test account
   - Verify login works
4. Test all features:
   - Create an activity
   - Update activity status
   - View daily activities
   - Generate reports

---

## 🔧 Step 9: Run Migrations (If Not Auto-Run)

If migrations didn't run during build:

1. Go to your web service dashboard
2. Click **"Shell"** tab
3. Run:
   ```bash
   php artisan migrate --force
   ```

---

## ⚠️ Important Notes for Free Tier

### Spin-Down Behavior:
- **Free tier apps spin down after 15 minutes of inactivity**
- First request after spin-down takes **30-90 seconds** (cold start)
- This is normal for Render's free tier

### Solutions:
1. **Upgrade to Starter plan** ($7/month) for always-on
2. **Use a ping service** (not recommended, may violate ToS):
   - UptimeRobot
   - Cron-job.org
3. **Accept cold starts** for student projects (usually fine)

---

## 🔄 Automatic Deployments

Every time you push to GitHub `main` branch:
- Render automatically rebuilds and redeploys
- Zero configuration needed!

```bash
git add .
git commit -m "Update feature"
git push origin main
# Render deploys automatically! 🎉
```

---

## 🐛 Troubleshooting

### Issue: "500 Internal Server Error"

**Check logs:**
1. Go to your web service
2. Click **"Logs"** tab
3. Look for errors

**Common fixes:**
```bash
# Enable debug temporarily (in environment variables)
APP_DEBUG=true

# Check storage permissions (usually auto-fixed)
chmod -R 755 storage bootstrap/cache
```

### Issue: "Database connection failed"

**Solutions:**
- Verify database is running (green status)
- Use **Internal Database URL** (not External)
- Check credentials match exactly
- Try using full `DATABASE_URL` instead of separate vars

### Issue: "APP_KEY missing"

**Solution:**
```bash
# Generate key
php artisan key:generate --show

# Add to environment variables
# Redeploy
```

### Issue: "Class not found"

**Solution:**
Add to `render-build.sh`:
```bash
composer dump-autoload --optimize
php artisan optimize:clear
```

### Issue: "Assets not loading (404)"

**Solution:**
```bash
# Make sure render-build.sh has:
npm install --prefix $RENDER_APP_PATH
npm run build --prefix $RENDER_APP_PATH

# Update APP_URL in environment variables to your Render URL
APP_URL=https://daily-track.onrender.com
```

---

## 💡 Production Optimizations

### 1. Enable OPcache

Add to environment variables:
```bash
PHP_OPCACHE_ENABLE=1
```

### 2. Use Better Cache Driver

For better performance on paid plans, use Redis:
```bash
CACHE_DRIVER=redis
SESSION_DRIVER=redis
REDIS_URL=  # Render provides Redis addon
```

### 3. Set Timezone

```bash
TZ=America/New_York  # Your timezone
```

---

## 📊 Cost Breakdown

| Service | Free Tier | Paid |
|---------|-----------|------|
| Web Service | Free (spins down) | $7/month (always-on) |
| PostgreSQL | Free 90 days | $7/month |
| **Total** | **$0 (90 days)** | **$14/month** |

**For student project:** Free tier is perfect! Just warn users about cold starts.

---

## 📝 Example Environment Variables (Complete List)

```bash
# Application
APP_NAME=Daily~Track
APP_ENV=production
APP_DEBUG=false
APP_KEY=base64:YOUR_GENERATED_KEY_HERE
APP_URL=https://daily-track.onrender.com

# Logging
LOG_CHANNEL=errorlog
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=error

# Database - Use Internal Database URL for better performance
DATABASE_URL=postgresql://user:password@host:5432/database
# OR separate variables:
DB_CONNECTION=pgsql
DB_HOST=dpg-xxx-a.oregon-postgres.render.com
DB_PORT=5432
DB_DATABASE=dailytrack
DB_USERNAME=dailytrack_user
DB_PASSWORD=your_password_here

# Cache & Session
SESSION_DRIVER=database
SESSION_LIFETIME=120
CACHE_DRIVER=database

# Queue
QUEUE_CONNECTION=sync

# Mail
MAIL_MAILER=log
MAIL_FROM_ADDRESS=noreply@dailytrack.com
MAIL_FROM_NAME="${APP_NAME}"

# Filesystem
FILESYSTEM_DISK=local

# Broadcasting
BROADCAST_DRIVER=log
```

---

## ✅ Deployment Checklist

- [ ] `render-build.sh` created and executable
- [ ] `render-start.sh` created and executable
- [ ] Code pushed to GitHub
- [ ] PostgreSQL database created on Render
- [ ] Web service created and connected to GitHub
- [ ] All environment variables configured
- [ ] `APP_KEY` generated and added
- [ ] `DATABASE_URL` or DB credentials added
- [ ] `APP_URL` set to your Render URL
- [ ] Build successful (check logs)
- [ ] Migrations ran successfully
- [ ] Can visit site and see UI
- [ ] Registration works
- [ ] Login works
- [ ] All CRUD operations work
- [ ] Assets loading correctly

---

## 🎓 For Student Submission

Include in your submission:

```
Live URL: https://daily-track.onrender.com
GitHub: https://github.com/YOUR_USERNAME/activity-tracker

Test Account:
Email: demo@example.com
Password: Demo123456

Note: App uses Render's free tier and may take 30-60 seconds 
to load on first request due to cold start. This is expected 
behavior for free tier hosting.

All features working:
✅ User authentication
✅ Activity CRUD operations
✅ Status updates with remarks
✅ Daily activity view
✅ Comprehensive reports
✅ Responsive design (mobile & desktop)
✅ Interactive onboarding guide
```

---

## 🆘 Getting Help

- **Render Docs:** https://render.com/docs
- **Laravel Deployment:** https://laravel.com/docs/deployment
- **Render Community:** https://community.render.com
- **Render Status:** https://status.render.com

---

## 🚀 You're Ready to Deploy!

Follow the steps above, and your Laravel app will be live on Render in about 15-20 minutes!

**Good luck with your deployment!** 🎉
