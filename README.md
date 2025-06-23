<p align="center">
  <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
</p>

<h1 align="center">QuoteStack 📚</h1>

<p align="center">
  A personal quote collector web app built using Laravel where users can save, tag, search, and manage quotes. Features include user profiles, quote of the day, and secure authentication.
</p>

---

## 🔥 Features

- ✅ Register/Login with authentication
- ✍️ Add/Edit/Delete your own quotes
- 🏷️ Add built-in and custom tags to quotes
- 🔍 Search quotes by content, author, or tag
- 🌟 Quote of the Day (random daily quote)
- 👤 User profile with bio, username, profile picture
- 🔒 Change password and delete account
- 🎨 Dark theme layout with responsive UI

---

## 🖥️ Demo

> Coming Soon — (You can deploy on [Render](https://render.com), [Vercel](https://vercel.com), or your own server)

```bash
# Step 1: Clone the repository
git clone https://github.com/mustakintopu/QuoteStack.git
cd QuoteStack

# Step 2: Install dependencies
composer install

# Step 3: Copy .env file and set your database config
cp .env.example .env

# Step 4: Generate application key
php artisan key:generate

# Step 5: Set database info in `.env` then run migrations
php artisan migrate

# Step 6: Start the development server
php artisan serve

🛠️ Tech Stack
Laravel 10 (PHP Framework)

Blade Templating Engine

Bootstrap 5 (for UI)

MySQL (or any Laravel-supported DB)

Font Awesome Icons

📁 Project Structure
Folder	Description
app/Http/Controllers/	Contains controller logic like QuoteController & ProfileController
resources/views/	Blade templates for UI
routes/web.php	Web routes for the app
app/Models/Quote.php	Quote model using Eloquent
public/	Publicly accessible files (images, assets)

📄 License
This project is licensed under the MIT License.
Feel free to use, improve, or contribute!

🙋‍♂️ Author
Mustakin Rahman
🔗 GitHub: @mustakintopu

🙌 Acknowledgements
Laravel for the amazing framework

FontAwesome for icons

Bootstrap for styling


