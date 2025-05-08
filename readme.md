# Art of Living - Project Suite

## Overview
The Art of Living Project Suite is a collection of Laravel-based applications developed for the Art of Living organization, designed to streamline organizational management, asset tracking, and ticket purchase distribution. This repository contains three projects in dedicated subfolders: **Samruddhi** (asset management), **Pragati** (organizational management), and **Sanidhya** (ticket purchase and distribution with WhatsApp integration). Each project showcases my expertise in building scalable, secure Laravel applications with third-party integrations, complementing my portfolio projects like SecretHairCare, TagNCash, and LandVault.

## Projects

### Samruddhi (samruddhi/)
**Samruddhi** is a Laravel-based asset management platform designed to streamline resource tracking, management, and reporting for the Art of Living organization. It supports dynamic categorization, secure file uploads, role-based permissions, and comprehensive reporting, ensuring efficient asset management.

- **Features**:
  - Asset tracking with metadata (e.g., type, location, status).
  - Dynamic categories for organizing assets.
  - Secure PDF and image uploads.
  - Role-based permissions (e.g., admin, viewer).
  - Reporting on asset status and usage.
- **Tech Stack**: Laravel, MySQL, Blade templates, Bootstrap.

### Pragati (pragati/)
**Pragati** is a Laravel-based organizational management system for the Art of Living, handling user management, apex bodies, projects, bank accounts, document requests, and notifications. It integrates SMSCountry for SMS OTP verification and supports role-based access for trustees, apex members, and accountants.

- **Features**:
  - User management with roles (e.g., trustee, apex, DDC, VDC, TDC).
  - Apex body administration linked to states.
  - Project and bank account tracking.
  - Document request workflows.
  - SMS OTP verification via SMSCountry.
- **Tech Stack**: Laravel, MySQL, Blade templates, Bootstrap, SMSCountry API.

### Sanidhya (sanidhya/)
**Sanidhya** is a Laravel-based ticket purchase distribution and creation system for the Art of Living, integrated with WhatsApp and messaging for seamless customer communication. It enables ticket creation from WhatsApp messages, manages purchase and distribution workflows, and sends real-time updates via WhatsApp and SMS, enhancing event and service management.

- **Features**:
  - **Ticket Creation**: Converts WhatsApp messages into support tickets for ticket purchases or inquiries.
  - **Purchase and Distribution**: Manages ticket sales and distribution for events or services, with automated assignment to agents.
  - **WhatsApp Integration**: Handles customer inquiries, sends purchase confirmations, and provides real-time updates via WhatsApp Business API.
  - **Messaging**: Sends SMS notifications for ticket status, payment confirmations, or event reminders.
  - **Analytics**: Tracks ticket sales, customer interaction metrics, and response times.
  - **Security**: Validates WhatsApp message sources and ensures secure transaction processing.
- **Tech Stack**: Laravel, MySQL, Blade templates, Bootstrap, WhatsApp Business API (e.g., Twilio), SMS provider (e.g., SMSCountry).

## Repository Structure
```
artofliving/
├── samruddhi/          # Asset management system
├── pragati/            # Organizational management system
├── sanidhya/           # Ticket purchase and distribution system
├── images/             # Screenshots for README
├── prjectwise/.env        # Environment configuration template
└── README.md           # This file
```

<!-- ## Screenshots
Below are snapshots of the projects’ key features:

<div style="display: flex; flex-wrap: wrap; gap: 10px;">
  <img src="images/samruddhi-asset-tracking.png" alt="Samruddhi Asset Tracking" width="300" />
  <img src="images/pragati-user-management.png" alt="Pragati User Management" width="300" />
  <img src="images/sanidhya-ticket-creation.png" alt="Sanidhya Ticket Creation" width="300" />
</div> -->

- **Samruddhi Asset Tracking**: Manage assets with metadata and categories.
- **Pragati User Management**: Administer users with role-based permissions.
- **Sanidhya Ticket Creation**: Convert WhatsApp messages into tickets for purchases.

## Prerequisites
- PHP >= 8.0
- Composer
- MySQL
- Node.js & NPM
- WhatsApp Business API credentials (e.g., Twilio, 360dialog)
- Sendgrid, Razorpay, and SMSCountry API keys

## Installation
Each project (`samruddhi/`, `pragati/`, `sanidhya/`) has its own setup. Below is a general guide for **Sanidhya**; adapt for others.

1. **Clone the Repository**:
   ```bash
   git clone https://github.com/ravirajladha/artofliving.git
   cd artofliving/sanidhya
   ```
   On Windows:
   ```powershell
   git clone https://github.com/ravirajladha/artofliving.git
   cd artofliving\sanidhya
   ```
2. **Install Dependencies**:
   ```bash
   composer install
   npm install
   ```
3. **Configure Environment**:
   - Copy `.env.example` to `.env`:
     ```bash
     copy .env.example .env
     ```
   - Update `.env` with database, WhatsApp, Sendgrid, and other settings:
     ```
     DB_CONNECTION=mysql
     DB_HOST=127.0.0.1
     DB_PORT=3306
     DB_DATABASE=sanidhya
     DB_USERNAME=root
     DB_PASSWORD=
     WHATSAPP_API_KEY=your_whatsapp_key
     SENDGRID_API_KEY=your_sendgrid_key
     RAZORPAY_KEY=your_key
     RAZORPAY_SECRET=your_secret
     SMSCOUNTRY_USER=your_username
     SMSCOUNTRY_PASSWORD=your_password
     ```
4. **Generate Application Key**:
   ```bash
   php artisan key:generate
   ```
5. **Run Migrations**:
   ```bash
   php artisan migrate
   ```
6. **Seed the Database** (optional):
   ```bash
   php artisan db:seed
   ```
   Populates sample tickets and users.
7. **Link Storage**:
   ```bash
   php artisan storage:link
   ```
8. **Compile Frontend Assets**:
   ```bash
   npm run dev
   ```
9. **Start the Server**:
   ```bash
   php artisan serve
   ```
   Access at `http://localhost:8000`.

## Using .gitignore
- The `.gitignore` file excludes sensitive files (e.g., `.env`, logs, uploads).
- Apply it:
  ```bash
  git add .gitignore
  git commit -m "Add .gitignore"
  ```
  On Windows:
  ```powershell
  git add .gitignore
  git commit -m "Add .gitignore"
  ```
- Remove tracked sensitive files:
  ```bash
  git rm --cached .env
  git rm --cached storage/app/public/*.jpg
  git commit -m "Remove sensitive files"
  ```

<!-- ## Demo
Explore the Art of Living projects through demo series:
- [Samruddhi Demo Series](https://www.youtube.com/playlist?list=YOUR_PLAYLIST_ID)
- [Pragati Demo Series](https://www.youtube.com/playlist?list=YOUR_PLAYLIST_ID)
- [Sanidhya Demo Series](https://www.youtube.com/playlist?list=YOUR_PLAYLIST_ID)  
Videos cover:
1. Samruddhi: Asset tracking and reporting.
2. Pragati: User and apex body management.
3. Sanidhya: Ticket creation and WhatsApp integration. -->

## Testing
- Run Laravel tests for each project:
  ```bash
  cd sanidhya
  php artisan test
  ```
- Manually test ticket creation, WhatsApp messaging, and analytics.

## Contributions
- **Samruddhi**: Developed dynamic asset tracking with secure file uploads.
- **Pragati**: Built role-based user management and SMS OTP verification.
- **Sanidhya**: Implemented ticket purchase system with WhatsApp and SMS integration.
- **Security**: Secured API keys in `.env` and validated data inputs.

## Security Notes
- Ensure `.env` is in `.gitignore` to avoid exposing credentials (e.g., WhatsApp, Sendgrid, Razorpay keys).
- Sanitize code for sensitive data (e.g., no real customer data).
- Scan for secrets before pushing:
  ```bash
  docker run -it --rm -v "$(pwd):/pwd" trufflesecurity/trufflehog git file:///pwd
  ```
  On Windows:
  ```powershell
  docker run -it --rm -v "$($PWD.Path):/pwd" trufflesecurity/trufflehog git file:///pwd
  ```
- Validate file uploads:
  ```php
  $request->validate(['image' => 'required|image|mimes:jpg,png,jpeg|max:2048']);
  ```
- Rotate exposed API keys (e.g., Sendgrid key from prior projects).

## License
This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.

## Contact
For questions or feedback, reach out to [Ravi Raj Ladha](mailto:ravirajladha@gmail.com).