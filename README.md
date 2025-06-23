# ESYCON Conference Management System

[![HTML5](https://img.shields.io/badge/HTML5-orange?logo=html5&logoColor=white)]()
[![CSS3](https://img.shields.io/badge/CSS3-blue?logo=css3&logoColor=white)]()
[![JavaScript](https://img.shields.io/badge/JavaScript-yellow?logo=javascript&logoColor=black)]()
[![PHP](https://img.shields.io/badge/PHP-7.4+-purple?logo=php&logoColor=white)]()
[![MySQL](https://img.shields.io/badge/Database-MySQL-blue?logo=mysql&logoColor=white)]()
[![License: MIT](https://img.shields.io/badge/License-MIT-green.svg)](LICENSE)

> A modern, user-friendly conference management system for ESYCON, enabling paper submissions, registrations, travel grants, and more.

---

## 📋 Table of Contents
1. [🚀 Features](#-features)  
2. [🛠️ Tech Stack](#️-tech-stack)  
3. [⚙️ Prerequisites](#️-prerequisites)  
4. [📦 Installation & Setup](#-installation--setup)  
5. [🔧 Configuration](#-configuration)  
6. [▶️ Usage](#️-usage)  
7. [📁 Project Structure](#️-project-structure)  
8. [📸 Screenshots](#-screenshots)  
9. [🛣️ Roadmap](#️-roadmap)  
10. [🤝 Contributing](#-contributing)  
11. [📄 License](#-license)  
12. [👤 Author & Contact](#-author--contact)  
13. [🙏 Acknowledgements](#-acknowledgements)  

---

## 🚀 Features
- 🔐 **User Authentication**: Secure login and registration for conference participants.
- 📝 **Paper Submission**: Submit, edit, and track papers with abstracts and keywords.
- 🏷️ **Tracks & Topics**: Categorize submissions into tracks; dynamic track listing.
- 💼 **Registration System**: Register for the conference, choose registration type, and manage payment status.
- 🌍 **Travel Grants**: Apply and review travel grant applications.
- 📬 **Notifications**: Email notifications for submission status, registration confirmation, and updates.
- 📊 **Admin Panel**: Manage users, papers, registrations, and grants with search, filter, and export (CSV/PDF).
- 🎨 **Modern UI/UX**: Responsive design with gradient backgrounds, animations, dark purple navbar, and sleek forms.
- 📄 **Help & Support**: FAQ and help section guiding users through processes.
- 👤 **Profile Management**: Users can update personal details and view submission status.
- 🔒 **Security**: Input validation, prepared statements to prevent SQL injection.

---

## 🛠️ Tech Stack
- **Frontend**: HTML5, CSS3 (with linear-gradient backgrounds and animations), JavaScript (vanilla or with libraries as needed)
- **Backend**: PHP 7.4+ (for form handling, authentication, and business logic)
- **Database**: MySQL
- **Server**: WAMP (Windows) or LAMP stack
- **Email**: PHP mail or SMTP integration for notifications
- **Version Control**: Git & GitHub

---

## ⚙️ Prerequisites
- **PHP** (7.4 or above) installed
- **MySQL** server running
- **Apache** (via WAMP/LAMP) or any PHP-enabled web server
- **MySQL Connector/CLI** or GUI tool to import SQL
- **Git** (optional, for cloning repository)
- **Browser**: Modern browser for frontend

---

## 📦 Installation & Setup

1. **Clone the repository**  
   ```bash
   git clone https://github.com/your-username/esycon-conference.git
   cd esycon-conference
   ```

2. **Copy to Server Directory**  
   - For WAMP: place project folder in `C:/wamp64/www/`  
   - For LAMP: place in `/var/www/html/`

3. **Database Setup**  
   - Create a database, e.g.:  
     ```sql
     CREATE DATABASE esycon_db;
     USE esycon_db;
     ```
   - Import SQL schema (provided in `database/schema.sql`):  
     ```bash
     mysql -u root -p esycon_db < database/schema.sql
     ```
   - Insert initial admin user:
     ```sql
     INSERT INTO admin (username, password) VALUES ('admin', 'admin123');
     ```

4. **Configure Database Connection**  
   - Open the configuration file (e.g., `config/db.php`) and set:
     ```php
     $db_host = 'localhost';
     $db_name = 'esycon_db';
     $db_user = 'your_db_user';
     $db_pass = 'your_db_password';
     ```
   - Ensure correct credentials and host.

5. **Install Dependencies (if any)**  
   - If using Composer for libraries:  
     ```bash
     composer install
     ```
   - Otherwise, ensure necessary PHP extensions (PDO/MySQL) are enabled.

---

## 🔧 Configuration

- **Navbar & Theme**:  
  - Primary navbar color: dark purple `#0d0820`.  
  - Fonts: Arial, sans-serif.  
  - Gradient backgrounds configured in CSS (e.g., `linear-gradient(247deg, rgba(81,45,168,1) 62%, rgba(255,253,253,1) 100%)`).  
  - Animations: loading spinners, button hover effects, paper submission animations.

- **Email Settings**:  
  - Configure SMTP details in `config/email.php` for sending notifications.

- **File Uploads**:  
  - Ensure `uploads/` directory is writable for paper uploads.

- **Environment Variables** (optional):  
  - Use a `.env` file with PHP dotenv to manage sensitive credentials.

---

## ▶️ Usage

1. **Start the Server**  
   - For WAMP: start Apache and MySQL via WAMP control panel.  
   - For LAMP: start Apache/Nginx and MySQL.

2. **Access in Browser**  
   - Navigate to `http://localhost/esycon-conference/`.

3. **Admin Login**  
   - Go to Admin panel: `http://localhost/esycon-conference/admin/` (or appropriate path).  
   - Log in with admin credentials.

4. **User Workflow**  
   - Users can register an account, log in, submit papers, apply for travel grants, and check status in “My Account”.

5. **Admin Workflow**  
   - Manage submissions: view, accept/reject papers.  
   - Manage registrations: approve or mark payment.  
   - Review travel grant applications.  
   - Send notifications and export data as CSV/PDF.

---

## 📁 Project Structure

```
esycon-conference/
├── admin/                    # Admin panel PHP files
│   ├── index.php             # Admin login
│   ├── dashboard.php         # Admin dashboard
│   ├── manage_users.php
│   ├── manage_papers.php
│   ├── manage_registrations.php
│   ├── manage_grants.php
│   └── config/               # Admin-specific configs
├── user/                     # Frontend user pages
│   ├── index.php             # Home page
│   ├── submit_paper.php
│   ├── travel_grant.php
│   ├── register.php
│   ├── login.php
│   ├── my_account.php
│   └── help.php
├── config/                   # Global configs (db.php, email.php)
├── database/                 # SQL schema and sample data
│   └── schema.sql
├── assets/                   # CSS, JS, images, fonts
│   ├── css/
│   │   └── styles.css
│   ├── js/
│   │   └── scripts.js
│   └── images/
├── uploads/                  # Uploaded papers, profile pics
├── vendor/                   # Composer dependencies (if used)
├── README.md
└── LICENSE
```

---

## 📸 Screenshots

> *(Place screenshots under `docs/screenshots/` and update paths)*  
- **Home Page**: `docs/screenshots/home.png`  
- **Paper Submission Form**: `docs/screenshots/submit_paper.png`  
- **Admin Dashboard**: `docs/screenshots/admin_dashboard.png`  
- **Manage Papers**: `docs/screenshots/manage_papers.png`  

---

## 🛣️ Roadmap

- 🔒 **Password Hashing**: Use bcrypt or Argon2 for storing passwords securely.  
- 🔍 **Search & Filter**: Advanced search for papers, users, and registrations.  
- 📊 **Analytics**: Dashboard stats (number of submissions, registrations, grants).  
- 📨 **Email Templates**: Enhanced notification templates with HTML/CSS.  
- 📄 **PDF Generation**: Generate acceptance letters, invoices, etc.  
- 🌗 **Dark Mode**: Optional theme toggle for users/admin.  
- 📱 **Responsive Enhancements**: Further mobile optimization.  
- 🌐 **API Endpoints**: Provide REST API for integration.  
- ⚙️ **CI/CD**: Automated testing and deployment pipelines.  

---

## 🤝 Contributing

1. Fork the repo  
2. Create branch:  
   ```bash
   git checkout -b feat/YourFeature
   ```  
3. Make changes, document code, and commit.  
4. Push:  
   ```bash
   git push origin feat/YourFeature
   ```  
5. Open a Pull Request with a clear description of changes.

---

## 📄 License

This project is licensed under the MIT License. See `LICENSE` file for details.

---

## 👤 Author & Contact

Priyanshu Chaturvedi  
- GitHub: https://github.com/priyanshuunfer 
- Email: iampriyanshu1102@gmail.com 

---

## 🙏 Acknowledgements

- Inspiration from academic conference management platforms.  
- Tutorials and libraries for PHP, MySQL, and JavaScript UI.  
- CSS gradient and animation resources.  
- Feedback from ESYCON participants.

---

[Back to Top](#esycon-conference-management-system)
