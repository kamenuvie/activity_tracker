# 🎯 RENDER DEPLOYMENT - QUICK REFERENCE

## ⚡ TL;DR - Deploy in 10 Minutes

### 1️⃣ Commit & Push
```bash
git add .
git commit -m "Prepare for Render deployment"
git push origin main
```

### 2️⃣ Go to Render.com
1. Sign up at https://render.com (use GitHub)
2. Create **PostgreSQL** database (90 days free)
3. Create **Web Service** from GitHub repo

### 3️⃣ Configure Web Service
**Build Command:**
```bash
./render-build.sh
```

**Start Command:**
```bash
./render-start.sh
```

### 4️⃣ Add Environment Variables
**Required:**
```bash
APP_KEY=          # Generate with: php artisan key:generate --show
APP_URL=          # Will be: https://your-app.onrender.com
DATABASE_URL=     # Copy from PostgreSQL "Internal Database URL"
```

**That's it!** Your app will be live in 10-15 minutes.

---

## 📦 What's Included

You now have these files ready:

| File | Purpose |
|------|---------|
| `render-build.sh` | Installs dependencies, builds assets, runs migrations |
| `render-start.sh` | Starts PHP server on Render |
| `render.yaml` | Infrastructure configuration (optional) |
| `RENDER-DEPLOYMENT.md` | Complete deployment guide |

---

## 🎨 Frontend vs Backend (Your Question)

**Important:** Laravel is NOT separated into frontend/backend like React + Node.js

### Your Application Structure:
```
Daily~Track (ONE application)
├── Backend: PHP/Laravel controllers, models, routes
├── Frontend: Blade templates, Tailwind CSS, Alpine.js
└── Database: PostgreSQL (on Render)
```

**You deploy it as ONE web service** - Render handles everything together!

---

## 🌍 Environment Variables by Stage

### Local Development (.env)
```bash
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000
DB_CONNECTION=sqlite  # or mysql for XAMPP
```

### Production on Render (Render Dashboard)
```bash
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-app.onrender.com
DB_CONNECTION=pgsql
DATABASE_URL=postgresql://user:pass@host:5432/db  # From Render
```

---

## 🔑 Critical Environment Variables

**Generate APP_KEY locally:**
```bash
php artisan key:generate --show
# Copy output: base64:xxxxx
```

**Get DATABASE_URL from Render:**
1. Go to your PostgreSQL database
2. Click "Info" tab
3. Copy "Internal Database URL"
4. Paste in `DATABASE_URL` environment variable

---

## 🚀 Deployment Steps (Detailed)

### Step 1: Prepare Code
```bash
# Make sure you're on latest
git pull origin main

# Stage all files
git add .

# Commit
git commit -m "Add Render deployment config"

# Push to GitHub
git push origin main
```

### Step 2: Create Database on Render

1. Go to https://dashboard.render.com
2. Click "New +" → "PostgreSQL"
3. Settings:
   - **Name:** `daily-track-db`
   - **Database:** `dailytrack`
   - **Region:** Oregon (or closest to you)
   - **Plan:** Free
4. Click "Create Database"
5. **Wait 2-3 minutes** for database to be ready
6. **Copy "Internal Database URL"** - you'll need it!

### Step 3: Create Web Service

1. Click "New +" → "Web Service"
2. Connect your GitHub repository
3. Select `activity-tracker` repository
4. Configure:
   - **Name:** `daily-track`
   - **Region:** Oregon (same as database!)
   - **Branch:** `main`
   - **Runtime:** PHP
   - **Build Command:** `./render-build.sh`
   - **Start Command:** `./render-start.sh`
   - **Plan:** Free

### Step 4: Add Environment Variables

Click "Advanced" and add:

```bash
# Application
APP_NAME=Daily~Track
APP_ENV=production
APP_DEBUG=false
APP_KEY=base64:YOUR_KEY_FROM_ARTISAN_COMMAND
APP_URL=https://daily-track.onrender.com

# Database
DATABASE_URL=postgresql://user:pass@host:5432/dailytrack
# (Copy from your PostgreSQL "Internal Database URL")

# Or use separate vars:
DB_CONNECTION=pgsql
DB_HOST=dpg-xxx.oregon-postgres.render.com
DB_PORT=5432
DB_DATABASE=dailytrack
DB_USERNAME=dailytrack_user
DB_PASSWORD=your_password_here

# Cache & Session
SESSION_DRIVER=database
CACHE_DRIVER=database
LOG_CHANNEL=errorlog
```

### Step 5: Deploy!

1. Click "Create Web Service"
2. Watch the build logs
3. Wait 10-15 minutes
4. Your app is live! 🎉

---

## 🧪 Testing Your Deployment

Visit: `https://your-app.onrender.com`

**First visit on free tier will take 30-60 seconds** (cold start)

Test these:
- [ ] Onboarding modal appears
- [ ] Can register new account
- [ ] Can login
- [ ] Can create activity
- [ ] Can update activity status
- [ ] Can view daily activities
- [ ] Can generate reports
- [ ] Mobile view works
- [ ] All icons and images load

---

## ⚠️ Common Issues & Fixes

### Issue: "APP_KEY missing"
**Fix:**
```bash
php artisan key:generate --show
# Add output to environment variables
```

### Issue: "Database connection failed"
**Fix:**
- Use **Internal Database URL** (not External)
- Make sure database is "Available" (green status)
- Check region matches (both Oregon or both Frankfurt, etc.)

### Issue: "500 Error"
**Fix:**
1. Check Render logs (Logs tab)
2. Temporarily enable debug: `APP_DEBUG=true`
3. Check storage permissions in build script
4. Verify migrations ran successfully

### Issue: "Spinning Forever / App Down"
**Fix:**
- Free tier spins down after 15 min inactivity
- First request takes 30-90 sec (this is normal!)
- Upgrade to Starter ($7/month) for always-on

### Issue: "Assets not loading (CSS/JS 404)"
**Fix:**
- Verify `npm run build` ran in build logs
- Check `APP_URL` matches your Render domain
- Run manual deploy to rebuild

---

## 💰 Cost Summary

| Item | Free Tier | Always-On |
|------|-----------|-----------|
| Web Service | Free (spins down) | $7/month |
| PostgreSQL | 90 days free | $7/month |
| **Total** | **$0 (3 months)** | **$14/month** |

**For student demo:** Free tier is perfect! ✅

---

## 🔄 Update After Changes

Every time you update code:

```bash
git add .
git commit -m "Your changes"
git push origin main
```

**Render auto-deploys!** No manual steps needed. 🎉

---

## 📱 Share Your Project

```
Live Demo: https://daily-track.onrender.com

Test Account:
Email: demo@example.com
Password: Demo123456

GitHub: https://github.com/YOUR_USERNAME/activity-tracker

Note: Free tier may have 30-60 second initial load time due to cold start.
This is standard for Render's free hosting.
```

---

## ✅ Pre-Deployment Checklist

Before you deploy, make sure:

- [ ] Code pushed to GitHub
- [ ] `render-build.sh` and `render-start.sh` are executable
- [ ] `.env.example` updated with PostgreSQL config
- [ ] All features tested locally
- [ ] Database migrations tested
- [ ] Assets build successfully (`npm run build`)

---

## 🆘 Need Help?

1. **Check build logs** on Render dashboard
2. **Read RENDER-DEPLOYMENT.md** for detailed guide
3. **Render Docs:** https://render.com/docs
4. **Render Community:** https://community.render.com

---

## 🎉 You're All Set!

Your application is ready to deploy to Render.com!

**Next steps:**
1. Push code to GitHub
2. Follow steps above
3. Share your live URL!

Good luck! 🚀
