# 🌐 Deployment & Hosting Guide for Daily~Track

This guide covers multiple deployment options for your Laravel application, ranging from free to paid solutions.

---

## 🆓 FREE Hosting Options (Recommended for Students/Projects)

### 1. **InfinityFree** (✨ Best for Beginners)
**Perfect for student projects and demonstrations**

**Features:**
- ✅ Free forever
- ✅ Unlimited disk space and bandwidth
- ✅ PHP 8.x support
- ✅ MySQL databases
- ✅ Free subdomain or custom domain
- ✅ cPanel included
- ❌ No command line access (Laravel deployment requires workaround)

**Steps to Deploy:**

1. **Sign up at** https://infinityfree.net
2. **Create a new account** and choose a subdomain (e.g., `yourproject.infinityfreeapp.com`)
3. **Prepare your Laravel app:**
   ```bash
   # Clear all caches
   php artisan cache:clear
   php artisan config:clear
   php artisan route:clear
   php artisan view:clear
   
   # Build production assets
   npm run build
   
   # Create deployment package
   composer install --optimize-autoloader --no-dev
   ```

4. **Modify `public/index.php`** (for shared hosting):
   ```php
   // Change from:
   require __DIR__.'/../vendor/autoload.php';
   // To:
   require __DIR__.'/vendor/autoload.php';
   
   // Change from:
   $app = require_once __DIR__.'/../bootstrap/app.php';
   // To:
   $app = require_once __DIR__.'/bootstrap/app.php';
   ```

5. **Upload files:**
   - Upload all files EXCEPT `public` folder contents to your root directory
   - Upload `public` folder contents to `htdocs` folder
   - Your structure should be:
     ```
     htdocs/
       ├── index.php (from public/)
       ├── .htaccess (from public/)
       └── build/ (from public/)
     root/
       ├── app/
       ├── bootstrap/
       ├── config/
       ├── database/
       ├── vendor/
       └── etc.
     ```

6. **Create database** in cPanel → MySQL Databases
7. **Update `.env`** file with your database credentials
8. **Run migrations** (use phpMyAdmin to import SQL)

**Limitations:**
- No SSH access (can't run artisan commands)
- May have performance limitations

---

### 2. **Railway.app** (⭐ HIGHLY RECOMMENDED for Laravel)
**Modern, developer-friendly platform with free tier**

**Features:**
- ✅ $5 free credit monthly (enough for small projects)
- ✅ Full SSH and command line access
- ✅ GitHub integration (auto-deploy)
- ✅ MySQL/PostgreSQL databases
- ✅ Environment variables management
- ✅ HTTPS included
- ✅ Perfect for Laravel

**Steps to Deploy:**

1. **Prepare your project:**
   ```bash
   # Create a Procfile in your project root
   echo "web: php artisan serve --host=0.0.0.0 --port=$PORT" > Procfile
   ```

2. **Create `nixpacks.toml`** in project root:
   ```toml
   [phases.setup]
   nixPkgs = ['...', 'nodejs', 'php82', 'php82Packages.composer']
   
   [phases.install]
   cmds = [
     'composer install --no-dev --optimize-autoloader',
     'npm ci',
     'npm run build'
   ]
   
   [phases.build]
   cmds = [
     'php artisan config:cache',
     'php artisan route:cache',
     'php artisan view:cache'
   ]
   
   [start]
   cmd = 'php artisan serve --host=0.0.0.0 --port=$PORT'
   ```

3. **Push to GitHub:**
   ```bash
   git add .
   git commit -m "Prepare for Railway deployment"
   git push origin main
   ```

4. **Deploy on Railway:**
   - Go to https://railway.app
   - Sign up with GitHub
   - Click "New Project" → "Deploy from GitHub repo"
   - Select your repository
   - Add MySQL database from Railway marketplace
   - Set environment variables in Railway dashboard:
     ```
     APP_ENV=production
     APP_DEBUG=false
     APP_KEY=base64:... (generate with: php artisan key:generate --show)
     APP_URL=https://your-app.up.railway.app
     
     DB_CONNECTION=mysql
     DB_HOST=${{MYSQL.MYSQL_HOST}}
     DB_PORT=${{MYSQL.MYSQL_PORT}}
     DB_DATABASE=${{MYSQL.MYSQL_DATABASE}}
     DB_USERNAME=${{MYSQL.MYSQL_USER}}
     DB_PASSWORD=${{MYSQL.MYSQL_PASSWORD}}
     ```
   - Deploy!

5. **Run migrations:**
   ```bash
   # In Railway's project terminal
   php artisan migrate --force
   ```

**Cost:** Free tier with $5/month credit (usually enough for student projects)

---

### 3. **Render.com** (Good Alternative)
**Modern platform with free tier**

**Features:**
- ✅ Free tier available
- ✅ Auto-deploy from GitHub
- ✅ PostgreSQL database (free 90 days)
- ✅ HTTPS included
- ❌ Spins down after 15 min of inactivity (free tier)

**Quick Setup:**
1. Push code to GitHub
2. Connect Render.com to GitHub
3. Create Web Service and PostgreSQL database
4. Set environment variables
5. Deploy!

**Website:** https://render.com

---

### 4. **Heroku** (Classic Option)
**Note: Free tier discontinued, but still popular**

**Features:**
- ⚠️ No longer free (starts at $5/month)
- ✅ Easy deployment
- ✅ PostgreSQL addon
- ✅ CLI tools
- ✅ Extensive documentation

**Website:** https://heroku.com

---

## 💰 PAID Hosting Options (Production Ready)

### 1. **Hostinger** (Budget-Friendly)
**Cost:** $2-4/month

**Features:**
- Full cPanel access
- SSH access
- Automatic backups
- Free SSL
- 24/7 support

**Website:** https://hostinger.com

---

### 2. **DigitalOcean** (Recommended for Serious Projects)
**Cost:** $6/month (basic droplet)

**Features:**
- Full VPS control
- Root SSH access
- Scalable resources
- Great documentation
- Laravel deployment tutorials

**Quick Setup:**
1. Create Droplet (Ubuntu 22.04)
2. Install LAMP stack
3. Install Composer
4. Clone your repository
5. Configure Nginx/Apache
6. Set up SSL with Let's Encrypt

**Website:** https://digitalocean.com

---

### 3. **Laravel Forge + DigitalOcean** (Professional)
**Cost:** $12/month (Forge) + $6/month (Server)

**Features:**
- ✅ One-click Laravel deployment
- ✅ Automatic SSL
- ✅ Queue management
- ✅ Scheduled tasks
- ✅ Database backups
- ✅ Zero-downtime deployment

**Website:** https://forge.laravel.com

---

### 4. **Cloudways** (Managed Hosting)
**Cost:** $11/month

**Features:**
- Managed cloud hosting
- Multiple cloud providers
- Automatic backups
- Free SSL
- 24/7 support
- Easy Laravel deployment

**Website:** https://cloudways.com

---

## 📋 Deployment Checklist

Before deploying to any platform:

```bash
# 1. Optimize for production
composer install --optimize-autoloader --no-dev

# 2. Build assets
npm run build

# 3. Cache configuration
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 4. Update .env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com

# 5. Set proper permissions
chmod -R 755 storage bootstrap/cache

# 6. Create .htaccess (if not exists)
# Copy from public/.htaccess to root if needed
```

---

## 🎯 RECOMMENDED PLATFORMS BY USE CASE

### For Student Projects / Demos:
1. **Railway.app** ⭐ (Best overall, free tier)
2. **Render.com** (Good alternative)
3. **InfinityFree** (Easiest, but limited)

### For Portfolio Projects:
1. **Railway.app** ($5/month)
2. **Hostinger** ($2-4/month)
3. **DigitalOcean** ($6/month)

### For Production Applications:
1. **Laravel Forge + DigitalOcean** (Professional)
2. **Cloudways** (Managed)
3. **AWS/Azure** (Enterprise)

---

## 🚀 STEP-BY-STEP: Deploy to Railway.app (RECOMMENDED)

### Prerequisites:
- GitHub account
- Railway account (free)
- Your Laravel project

### Step 1: Prepare Your Project

1. **Create `Procfile`** in project root:
   ```
   web: php artisan serve --host=0.0.0.0 --port=$PORT
   ```

2. **Update `.env.example`** with all required variables:
   ```env
   APP_NAME="Daily~Track"
   APP_ENV=production
   APP_KEY=
   APP_DEBUG=false
   APP_URL=
   
   DB_CONNECTION=mysql
   DB_HOST=
   DB_PORT=3306
   DB_DATABASE=
   DB_USERNAME=
   DB_PASSWORD=
   ```

3. **Create `railway.json`** (optional):
   ```json
   {
     "$schema": "https://railway.app/railway.schema.json",
     "build": {
       "builder": "NIXPACKS"
     },
     "deploy": {
       "startCommand": "php artisan serve --host=0.0.0.0 --port=$PORT",
       "restartPolicyType": "ON_FAILURE",
       "restartPolicyMaxRetries": 10
     }
   }
   ```

### Step 2: Push to GitHub

```bash
# Initialize git (if not already done)
git init
git add .
git commit -m "Prepare for deployment"

# Create repository on GitHub
# Then push
git remote add origin https://github.com/yourusername/activity-tracker.git
git branch -M main
git push -u origin main
```

### Step 3: Deploy on Railway

1. **Go to** https://railway.app
2. **Sign up** with GitHub
3. **New Project** → **Deploy from GitHub repo**
4. **Select your repository**
5. Railway will automatically detect Laravel and start deploying

### Step 4: Add MySQL Database

1. In your project, click **"+ New"**
2. Select **"Database"** → **"Add MySQL"**
3. Railway will create database and provide credentials

### Step 5: Configure Environment Variables

1. Go to your Laravel service → **"Variables"**
2. Add these variables:
   ```
   APP_NAME=Daily~Track
   APP_ENV=production
   APP_DEBUG=false
   APP_KEY=base64:YOUR_KEY_HERE
   APP_URL=https://${{RAILWAY_PUBLIC_DOMAIN}}
   
   DB_CONNECTION=mysql
   DB_HOST=${{MYSQL.MYSQLHOST}}
   DB_PORT=${{MYSQL.MYSQLPORT}}
   DB_DATABASE=${{MYSQL.MYSQLDATABASE}}
   DB_USERNAME=${{MYSQL.MYSQLUSER}}
   DB_PASSWORD=${{MYSQL.MYSQLPASSWORD}}
   ```

### Step 6: Generate APP_KEY

```bash
# Run locally
php artisan key:generate --show

# Copy the output and paste in Railway's APP_KEY variable
```

### Step 7: Run Migrations

1. Open Railway's project
2. Click on your Laravel service
3. Go to **"CLI"** or **"Shell"**
4. Run:
   ```bash
   php artisan migrate --force
   ```

### Step 8: Enable Public URL

1. Go to **Settings** tab
2. Scroll to **Networking**
3. Click **"Generate Domain"**
4. Your app will be live at the generated URL!

### Step 9: Test Your Deployment

1. Visit your Railway URL
2. Test registration
3. Test login
4. Test all features
5. Check onboarding modal appears

---

## 🔧 Troubleshooting Deployment Issues

### Issue: "500 Internal Server Error"

**Solution:**
```bash
# Enable debug mode temporarily
APP_DEBUG=true

# Check logs
php artisan log:clear
tail -f storage/logs/laravel.log

# Common fixes:
chmod -R 755 storage bootstrap/cache
php artisan config:clear
php artisan cache:clear
```

### Issue: "Database connection failed"

**Solution:**
- Verify database credentials in `.env`
- Check if database service is running
- Ensure host/port are correct
- Test connection with MySQL client

### Issue: "Assets not loading (404)"

**Solution:**
```bash
# Rebuild assets
npm run build

# Update asset URL in .env
ASSET_URL=https://yourdomain.com

# Clear cache
php artisan view:clear
```

### Issue: "Class not found"

**Solution:**
```bash
composer dump-autoload
php artisan optimize:clear
```

---

## 📊 Cost Comparison

| Platform | Monthly Cost | Best For | Difficulty |
|----------|-------------|----------|-----------|
| Railway.app | $0-5 | Student projects | ⭐⭐ Easy |
| InfinityFree | $0 | Demos | ⭐ Easiest |
| Render.com | $0-7 | Small apps | ⭐⭐ Easy |
| Hostinger | $2-4 | Portfolio | ⭐⭐ Easy |
| DigitalOcean | $6+ | Production | ⭐⭐⭐⭐ Hard |
| Laravel Forge | $18+ | Professional | ⭐⭐ Easy |

---

## 🎓 For Student Submission

**Recommended Approach:**

1. **Deploy to Railway.app** (easiest, free tier)
2. **Share live URL** with your instructor
3. **Include credentials** in submission:
   ```
   Live URL: https://your-app.up.railway.app
   Test Account:
   Email: demo@example.com
   Password: DemoPassword123
   ```
4. **Keep GitHub repository** as backup
5. **Provide README.md** with setup instructions

---

## 📞 Support Resources

- **Railway Docs:** https://docs.railway.app
- **Laravel Deployment:** https://laravel.com/docs/deployment
- **DigitalOcean Tutorials:** https://www.digitalocean.com/community/tags/laravel
- **Laracasts (Video Tutorials):** https://laracasts.com

---

## ✅ Final Deployment Checklist

- [ ] Code pushed to GitHub
- [ ] Environment variables configured
- [ ] Database created and connected
- [ ] Migrations run successfully
- [ ] Assets built and loading
- [ ] APP_KEY generated
- [ ] SSL/HTTPS enabled
- [ ] Test account created
- [ ] All features tested on live site
- [ ] Error tracking configured
- [ ] Backup strategy in place

---

**Your application is ready to deploy! Choose the platform that best fits your needs and follow the guide above.** 🚀

**For student projects, Railway.app is the recommended choice - it's free, easy, and professional!**
