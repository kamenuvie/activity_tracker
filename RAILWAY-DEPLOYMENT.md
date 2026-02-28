# 🚀 Deploy Laravel to Railway.app (EASIEST for PHP)

**Railway has native PHP support - no Docker needed!**

---

## ✨ Why Railway > Render for Laravel

| Feature | Railway | Render |
|---------|---------|--------|
| PHP Support | ✅ Native | ⚠️ Requires Docker |
| Database | ✅ MySQL/PostgreSQL built-in | ✅ PostgreSQL only |
| Free Tier | ✅ $5 credit/month | ✅ Free (but spins down) |
| Cold Starts | ❌ None | ✅ Yes (15 min) |
| Setup | ⭐ Super Easy | ⭐⭐⭐ Complex (Docker) |

**For Laravel, Railway is MUCH easier!**

---

## 🚀 Deploy to Railway in 5 Minutes

### Step 1: Create Railway Files

Create **`Procfile`** in project root:
```
web: php artisan serve --host=0.0.0.0 --port=$PORT
```

Create **`nixpacks.toml`** in project root:
```toml
[phases.setup]
nixPkgs = ['php82', 'php82Packages.composer', 'nodejs']

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
cmd = 'php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=$PORT'
```

### Step 2: Push to GitHub

```bash
git add .
git commit -m "Prepare for Railway deployment"
git push origin main
```

### Step 3: Deploy on Railway

1. Go to **https://railway.app**
2. **Sign up with GitHub** (free)
3. Click **"New Project"**
4. Choose **"Deploy from GitHub repo"**
5. Select your **`activity-tracker`** repository
6. Railway automatically detects Laravel! 🎉

### Step 4: Add MySQL Database

1. In your project, click **"+ New"**
2. Select **"Database"** → **"Add MySQL"**
3. Railway automatically connects it to your app!

### Step 5: Configure Environment Variables

1. Click on your **Laravel service** (not the database)
2. Go to **"Variables"** tab
3. Add these:

```bash
APP_NAME=Daily~Track
APP_ENV=production
APP_DEBUG=false
APP_KEY=base64:YOUR_KEY_HERE
APP_URL=https://${{RAILWAY_PUBLIC_DOMAIN}}

# Database (Railway auto-configures these references!)
DB_CONNECTION=mysql
DB_HOST=${{MYSQL.MYSQLHOST}}
DB_PORT=${{MYSQL.MYSQLPORT}}
DB_DATABASE=${{MYSQL.MYSQLDATABASE}}
DB_USERNAME=${{MYSQL.MYSQLUSER}}
DB_PASSWORD=${{MYSQL.MYSQLPASSWORD}}

# Cache & Session
SESSION_DRIVER=database
CACHE_DRIVER=database
LOG_CHANNEL=errorlog
```

**Notice:** Railway's `${{MYSQL.MYSQLHOST}}` syntax auto-references your database!

### Step 6: Generate APP_KEY

Run locally:
```bash
php artisan key:generate --show
```

Copy the output and paste in Railway's `APP_KEY` variable.

### Step 7: Enable Public Domain

1. Go to your **Laravel service** → **"Settings"** tab
2. Scroll to **"Networking"**
3. Click **"Generate Domain"**
4. Your app will be live at: `https://your-app.up.railway.app`

### Step 8: Deploy!

Railway automatically deploys when you add the domain. Watch the logs in the **"Deployments"** tab.

**That's it!** Your app is live! 🎉

---

## 🔑 Environment Variables Reference

Here are ALL the variables you need on Railway:

```bash
# Application
APP_NAME=Daily~Track
APP_ENV=production
APP_DEBUG=false
APP_KEY=base64:NynJ1GlKYIT5EQ0PskEVmubgFwUbyLw786tzwMNDLvc=
APP_URL=https://${{RAILWAY_PUBLIC_DOMAIN}}

# Database - Railway auto-configures these!
DB_CONNECTION=mysql
DB_HOST=${{MYSQL.MYSQLHOST}}
DB_PORT=${{MYSQL.MYSQLPORT}}
DB_DATABASE=${{MYSQL.MYSQLDATABASE}}
DB_USERNAME=${{MYSQL.MYSQLUSER}}
DB_PASSWORD=${{MYSQL.MYSQLPASSWORD}}

# Session & Cache
SESSION_DRIVER=database
SESSION_LIFETIME=120
CACHE_DRIVER=database

# Mail
MAIL_MAILER=log

# Queue
QUEUE_CONNECTION=sync

# Logging
LOG_CHANNEL=errorlog
```

**Note:** The `${{MYSQL.XXX}}` variables automatically reference your MySQL database service!

---

## 🔄 Auto-Deploy on Git Push

Every time you push to GitHub:
```bash
git add .
git commit -m "Update feature"
git push origin main
```

**Railway automatically rebuilds and redeploys!** 🚀

---

## 💰 Cost

- **Free tier:** $5 credit/month (enough for student projects!)
- **Usage-based:** Only pay for what you use
- **Typical student project:** ~$3-5/month (covered by free credit)

---

## 🐛 Troubleshooting

### Build fails:

Check the deployment logs in Railway dashboard. Common fixes:

```bash
# Make sure Procfile exists
ls -la Procfile

# Make sure nixpacks.toml exists
ls -la nixpacks.toml

# Rebuild
git commit --allow-empty -m "Trigger rebuild"
git push origin main
```

### Database connection fails:

Make sure you're using Railway's variable syntax:
```bash
DB_HOST=${{MYSQL.MYSQLHOST}}  # ✅ Correct
DB_HOST=localhost              # ❌ Wrong
```

### APP_KEY missing:

```bash
php artisan key:generate --show
# Add to environment variables
```

---

## ✅ Deployment Checklist

- [ ] `Procfile` created
- [ ] `nixpacks.toml` created
- [ ] Code pushed to GitHub
- [ ] Railway project created
- [ ] MySQL database added
- [ ] Environment variables configured
- [ ] APP_KEY generated and added
- [ ] Public domain generated
- [ ] Deployment successful
- [ ] Can visit site and register
- [ ] All features working

---

## 🎓 For Student Submission

```
Live URL: https://daily-track.up.railway.app
GitHub: https://github.com/YOUR_USERNAME/activity-tracker

Test Account:
Email: demo@example.com
Password: Demo123456

Platform: Railway.app (Free tier with $5/month credit)
Database: MySQL (included)

All features implemented:
✅ User authentication
✅ Activity CRUD
✅ Status updates
✅ Daily view
✅ Reports
✅ Responsive design
✅ Onboarding guide
```

---

## 📚 Additional Resources

- **Railway Docs:** https://docs.railway.app
- **Railway Templates:** https://railway.app/templates
- **Railway Discord:** https://discord.gg/railway

---

## 🚀 You're Ready!

Railway is the easiest way to deploy your Laravel app. No Docker required! 🎉
