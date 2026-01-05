# Netlify Forms Setup Guide

## ✅ What I Changed

I've converted your contact form to use **Netlify Forms**, which is the built-in form handling service for Netlify. This works perfectly on Netlify without needing PHP or a backend server.

## 📋 Setup Steps

### 1. Deploy to Netlify

1. Push your code to GitHub/GitLab/Bitbucket
2. Connect your repository to Netlify
3. Deploy your site

### 2. Configure Email Notifications

After deployment:

1. Go to your Netlify dashboard
2. Navigate to **Forms** in the left sidebar
3. You'll see your form listed (named "contact")
4. Click on **Settings** or **Notifications**
5. Set up email notifications:
   - Click **Add notification**
   - Select **Email notifications**
   - Enter your email: `bhavyababariya007@gmail.com`
   - Save

### 3. Test the Form

1. Visit your deployed site
2. Fill out and submit the contact form
3. Check your email inbox - you'll receive the form submission

## 📧 Email Configuration

Netlify will send you an email with:
- Form submission details
- All field values (name, email, subject, message)
- Timestamp
- Submission ID

## 🔔 Alternative: Use Netlify Functions + Email Service

If you want more control over email formatting, you can:

1. Use Netlify Functions (serverless functions)
2. Integrate with services like:
   - SendGrid
   - Mailgun
   - AWS SES
   - Or keep using PHPMailer via a separate backend

## 📊 View Submissions

You can view all form submissions in:
- **Netlify Dashboard** → **Forms** → **contact** → **Submissions**

## 🎯 Benefits of Netlify Forms

✅ No backend server needed  
✅ Built-in spam protection  
✅ Free tier includes 100 submissions/month  
✅ Automatic email notifications  
✅ Submission management dashboard  
✅ Works with static sites  

## 🔒 Spam Protection

The form includes:
- Honeypot field (hidden bot trap)
- Netlify's built-in spam filtering
- Rate limiting

## 📝 Form Fields

Your form collects:
- **name** - User's name
- **email** - User's email
- **subject** - Message subject
- **message** - Message content

## 🚀 Next Steps

1. Deploy to Netlify
2. Set up email notifications in Netlify dashboard
3. Test the form
4. Check your email!

## ❓ Troubleshooting

**Form not submitting?**
- Check browser console (F12) for errors
- Verify `netlify` attribute is on the form
- Make sure form has `name="contact"`

**Not receiving emails?**
- Check Netlify dashboard → Forms → Settings
- Verify email address in notifications
- Check spam folder
- Check Netlify plan limits (free tier: 100 submissions/month)

**Need custom email formatting?**
- Use Netlify Functions
- Integrate with EmailJS or similar service
- Use a separate backend API

