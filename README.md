<p align="center">
    <a href="https://laravel.com" target="_blank">
        <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
    </a>
</p>

<h1 align="center">QuoteStack 📚</h1>
<p align="center">A personal quote management app built with Laravel</p>

---

## ✨ Features

### 📌 Quote Management
- Add/Edit/Delete quotes
- Tag quotes with multiple tags
- Favorite quotes functionality
- “Quote of the Day” display (random daily quote)

### 🔍 Search & Filter
- Search quotes by author, content, or tag
- Filter quotes based on user-specific data

### 👤 User Profiles
- Secure user authentication (login/register)
- Profile edit with bio, username, and profile picture
- Password update and account deletion options

### 🧰 Admin & Dashboard
- View all quotes you've added
- Interactive UI with Bootstrap 5 styling
- Responsive across devices

---

## 🛠️ Technology Stack

- **Backend**: Laravel 10+
- **Frontend**: Blade + Bootstrap 5
- **Database**: MySQL (via XAMPP)
- **Authentication**: Laravel Custom Auth (no Breeze/Jetstream)
- **File Storage**: Laravel Storage (public disk)

---

## 📋 Requirements

- PHP >= 8.1
- Composer
- MySQL (via XAMPP or other)
- Node.js & NPM (for frontend assets if needed)

---

## 🚀 Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/mustakintopu/QuoteStack.git
   cd QuoteStack
2. Install PHP dependencies
     ```bash
    composer install
3. Set up environment file
    ```bash
    cp .env.example .env
    php artisan key:generate

4. Configure your .env for MySQL
    ```bash
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=quotestack
    DB_USERNAME=root
    DB_PASSWORD=
5. Run migrations
    ```bash

    php artisan migrate
6. Serve the application

    ```bash
    php artisan serve

7. Visit http://localhost:8000

📖 Usage
1. Register a new user account.
2. Add quotes and tag them as needed.
3. Edit your profile with bio and image.
4. Search/filter quotes.
5. View your “Quote of the Day.”

🗂️ Project Structure
    QuoteStack/
    ├── app/
    │   ├── Http/Controllers/
    │   └── Models/
    ├── database/
    │   ├── migrations/
    │   └── seeders/
    ├── resources/
    │   ├── views/
    │   ├── css/
    │   └── js/
    └── routes/
        └── web.php

🤝 Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Steps:

1. Fork the repo
2. Create a new branch (git checkout -b feature/yourFeature)
3. Commit your changes (git commit -m 'Add some feature')
4. Push to the branch (git push origin feature/yourFeature)
5. Open a Pull Request

📄 License
This project is open-sourced software licensed under the MIT license.

🙏 Acknowledgements
-Laravel Team
-Bootstrap Icons
-Font Awesome
-Open-source community

📞 Contact
Email: mustakinrahman598@gmail.com

GitHub: https://github.com/mustakintopu

✨ QuoteStack – Organize and reflect on your favorite quotes in one place!
