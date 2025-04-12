<img src="(https://github.com/user-attachments/assets/d2540c90-bc14-4d40-a1f3-39375c4c2019)" width="300"/>

# 📚 BooksLoaf

BooksLoaf is a smart, user-friendly online bookstore system designed to make book discovery and shopping seamless. It leverages AI for personalized recommendations, keeps stock updated in real time, and sends alerts for new arrivals and discounts — all wrapped in a modern, clean interface.

---

## 📋 Table of Contents

- [Features](#-features)
- [Tech Stack](#-tech-stack)
- [Installation](#-installation)
- [Usage](#-usage)
- [Deployment](#-deployment)
- [AI Integration](#-ai-integration)
- [Screenshots](#-screenshots)
- [Contributing](#-contributing)
- [License](#-license)
- [Contact](#-contact)

---

## 🚀 Features

- 🔍 AI-powered book recommendations (via DeepSeek API)
- 🛒 Shopping cart and smooth checkout flow
- 📦 Real-time stock updates
- 📬 Auto alerts for new arrivals and discounts
- 📱 Fully responsive (mobile-friendly)
- 🔐 Secure login and payment gateway support
- 🧾 Order history and tracking
- 🌐 Domain-ready setup (tested with Exabytes)

---

## 🛠️ Tech Stack

- **Framework:** Laravel (PHP)
- **Database:** MySQL
- **Frontend:** Blade, HTML5, Bootstrap
- **AI:** DeepSeek API
- **Environment:** XAMPP (for local dev)
- **Hosting Ready:** Works with Exabytes or any domain provider

---

## 📦 Installation

1. **Clone the repository**
   
   ```bash
   git clone https://github.com/yourusername/booksloaf.git
   cd booksloaf
   ```

2. **Install PHP and JavaScript dependencies**
   
   ```bash
   composer install
   npm install && npm run dev
   ```

3. **Create the environment file**
   
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Configure `.env` settings**
   
   Open the `.env` file and set your database, app name, and DeepSeek API:

   ```env
   APP_NAME=BooksLoaf
   APP_URL=http://localhost

   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=booksloaf
   DB_USERNAME=root
   DB_PASSWORD=

   DEEPSEEK_API_KEY=your_deepseek_api_key
   ```

5. **Run database migrations and seeders**

   ```bash
   php artisan migrate
   php artisan db:seed
   ```

6. **Serve the application**

   ```bash
   php artisan serve
   ```

   Then visit [http://localhost:8000](http://localhost:8000) in your browser.

---

## ▶️ Usage

Run the migration and start the app:

```bash
php artisan migrate
php artisan db:seed
php artisan serve
```

Visit: `http://localhost:8000`

---

## 🚢 Deployment

To go live:

1. Point your Exabytes domain to your public IP or server.
2. Set up port forwarding and DNS if hosting from XAMPP.
3. Use services like **Ngrok**, **Cloudflare Tunnel**, or move to a VPS (like DigitalOcean) for persistent hosting.
4. Ensure `.env` is updated with your live DB and URL.

---

## 🤖 AI Integration

BooksLoaf uses the **DeepSeek API** to offer smart book suggestions based on:

- Search keywords
- Reading history
- Genre preferences

Integration is handled via a Laravel service and can be easily extended or replaced.

---

## 📸 Screenshots

- 🖼️ Homepage
- 🛒 Cart & Checkout
- 📚 Recommendation Results
- ⚙️ Admin Dashboard

---

## 🤝 Contributing

Want to contribute? Awesome! Here's how:

1. Fork the repo
2. Create your feature branch: `git checkout -b feature/YourFeature`
3. Commit your changes: `git commit -m 'Add your feature'`
4. Push to the branch: `git push origin feature/YourFeature`
5. Open a pull request

---

## 📄 License

This project is licensed under the **MIT License**. See [`LICENSE`](LICENSE) for details.

---

## 📬 Contact

Built with ❤️ by the BooksLoaf team.

- 🌐 Website: [https://booksloaf.com](https://booksloaf.com)
- ✉️ Email: admin@booksloaf.com
