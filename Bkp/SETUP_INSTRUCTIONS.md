# Setup Instructions - Fix "Failed to fetch" Error

## The Problem
The "Failed to fetch" error occurs when you open `index.html` directly in the browser (using `file://` protocol). PHP files cannot run this way - you need a web server.

## Solution: Run a Local PHP Server

### Option 1: Use the Provided Script (Easiest)

**Windows:**
1. Double-click `start-server.bat`
2. A window will open showing the server is running
3. Open your browser and go to: `http://localhost:8000`

**Mac/Linux:**
1. Open Terminal in your project folder
2. Run: `chmod +x start-server.sh`
3. Run: `./start-server.sh`
4. Open your browser and go to: `http://localhost:8000`

### Option 2: Manual Command

1. Open Terminal/Command Prompt in your project folder
2. Run this command:
   ```bash
   php -S localhost:8000
   ```
3. Open your browser and go to: `http://localhost:8000`

### Option 3: Use XAMPP/WAMP/MAMP

1. Install XAMPP (Windows), WAMP (Windows), or MAMP (Mac)
2. Copy your project folder to the `htdocs` folder (XAMPP/WAMP) or `htdocs` folder (MAMP)
3. Access via: `http://localhost/Portfolio-main` (adjust path as needed)

## Important Notes

1. **Keep the server running** - Don't close the terminal/command window while testing
2. **Use http://localhost:8000** - Not the file:// path
3. **Install PHPMailer first** - Run `composer install` before testing the form

## Testing Steps

1. Start the PHP server (Option 1, 2, or 3 above)
2. Open `http://localhost:8000` in your browser
3. Navigate to the contact form
4. Fill out and submit the form
5. Check your email inbox

## If You Still Get Errors

1. **Check if PHP is installed:**
   ```bash
   php -v
   ```
   If not installed, download from: https://www.php.net/downloads

2. **Check if Composer is installed:**
   ```bash
   composer --version
   ```
   If not installed, download from: https://getcomposer.org/

3. **Install PHPMailer:**
   ```bash
   composer install
   ```

4. **Check browser console (F12)** for detailed error messages

5. **Verify files exist:**
   - `send-email.php` ✓
   - `config.php` ✓
   - `vendor/autoload.php` ✓ (after composer install)

## For Production (Live Website)

When you upload to a live server:
- The server already has PHP running
- Just make sure `composer install` is run on the server
- Update `config.php` with production email settings
- The form will work automatically

