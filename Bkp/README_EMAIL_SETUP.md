# Email Setup Instructions

This guide will help you set up the contact form email functionality using PHPMailer.

## Step 1: Install PHPMailer via Composer

1. Make sure you have Composer installed on your server. If not, download it from https://getcomposer.org/

2. Open terminal/command prompt in your project root directory and run:
   ```bash
   composer install
   ```

   This will install PHPMailer and its dependencies in the `vendor` folder.

## Step 2: Configure Email Settings

1. Open `config.php` file

2. Update the following settings with your email credentials:

   ```php
   // For Gmail users:
   define('SMTP_HOST', 'smtp.gmail.com');
   define('SMTP_USERNAME', 'your-email@gmail.com');
   define('SMTP_PASSWORD', 'your-app-password'); // Use App Password, not regular password
   define('SMTP_PORT', 587);
   define('SMTP_SECURE', 'tls');
   
   // Your email address
   define('TO_EMAIL', 'bhavyababariya007@gmail.com');
   ```

### Gmail Setup (Recommended)

1. **Enable 2-Step Verification** on your Google Account:
   - Go to https://myaccount.google.com/security
   - Enable 2-Step Verification

2. **Generate App Password**:
   - Go to https://myaccount.google.com/apppasswords
   - Select "Mail" and "Other (Custom name)"
   - Enter "Portfolio Contact Form"
   - Copy the generated 16-character password
   - Use this password in `config.php` as `SMTP_PASSWORD`

### Other Email Providers

**Outlook/Hotmail:**
```php
define('SMTP_HOST', 'smtp-mail.outlook.com');
define('SMTP_PORT', 587);
define('SMTP_SECURE', 'tls');
```

**Yahoo:**
```php
define('SMTP_HOST', 'smtp.mail.yahoo.com');
define('SMTP_PORT', 587);
define('SMTP_SECURE', 'tls');
```

**Custom SMTP:**
- Contact your hosting provider for SMTP settings
- Update the values in `config.php` accordingly

## Step 3: Update Domain Settings

In `config.php`, update the `ALLOWED_ORIGINS` array with your actual domain:
```php
define('ALLOWED_ORIGINS', ['https://yourdomain.com', 'https://www.yourdomain.com']);
```

## Step 4: Test the Form

1. Upload all files to your web server
2. Make sure PHP is enabled on your server
3. Test the contact form by submitting a message
4. Check your email inbox for the message

## Troubleshooting

### Email not sending?

1. **Check PHP error logs** on your server
2. **Enable debug mode** in `send-email.php`:
   - Uncomment: `$mail->SMTPDebug = 2;`
   - This will show detailed error messages
3. **Check firewall settings** - Port 587 (TLS) or 465 (SSL) should be open
4. **Verify credentials** - Make sure email and password are correct
5. **Check spam folder** - Sometimes emails go to spam

### Common Issues:

- **"SMTP connect() failed"**: Check SMTP host, port, and credentials
- **"Authentication failed"**: Use App Password for Gmail, check username/password
- **"Could not instantiate mail function"**: PHP mail() function not configured (use SMTP instead)

## Security Notes

1. **Never commit `config.php` with real credentials to public repositories**
2. **Use environment variables** in production for sensitive data
3. **Enable HTTPS** on your website
4. **Add CAPTCHA** to prevent spam (optional but recommended)

## File Structure

```
your-project/
├── index.html
├── send-email.php
├── config.php
├── composer.json
├── vendor/ (created after composer install)
│   └── phpmailer/
└── README_EMAIL_SETUP.md
```

## Support

If you encounter any issues, check:
- PHP version (should be 7.4 or higher)
- Composer is installed correctly
- All files are uploaded to the server
- File permissions are correct (PHP should be able to read all files)

