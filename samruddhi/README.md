# Samruddhi - Asset Management

## Overview
Samruddhi is a Laravel-based asset management platform developed for the Art of Living organization, designed to streamline the tracking, organization, and reporting of assets. The system supports dynamic categorization, secure file uploads, role-based permissions, and comprehensive reporting, ensuring efficient resource management. This project highlights my expertise in building scalable Laravel applications with a focus on security and user experience, making it a key addition to my portfolio alongside projects like SecretHairCare and LandVault.

## Features
- **Asset Tracking**: Manage assets with metadata such as type, location, and status.
- **Dynamic Categories**: Create custom categories for organizing assets (e.g., equipment, documents).
- **File Uploads**: Securely upload PDFs and images for asset documentation.
- **User Management**: Role-based permissions to restrict access (e.g., admin, viewer).
- **Reporting**: Generate detailed reports on asset inventory and usage.
- **Responsive UI**: User-friendly interface built with Laravel Blade templates.

## Tech Stack
- **Backend**: Laravel (PHP MVC framework)
- **Frontend**: HTML, CSS, JavaScript, Blade templates
- **Database**: MySQL
- **File Storage**: Laravel Filesystem for asset uploads
- **Server**: Apache/Nginx

## Prerequisites
- PHP >= 8.0
- Composer
- MySQL
- Node.js & NPM

## Installation
1. **Clone the Repository**:
   ```bash
   git clone https://github.com/ravirajladha/Samruddhi---Art-of-Living.git
   cd Samruddhi---Art-of-Living
   ```
2. **Install Dependencies**:
   ```bash
   composer install
   npm install
   ```
3. **Configure Environment**:
   - Copy `.env.example` to `.env`:
     ```bash
     cp .env.example .env
     ```
   - Update `.env` with database settings:
     ```
     DB_CONNECTION=mysql
     DB_HOST=127.0.0.1
     DB_PORT=3306
     DB_DATABASE=samruddhi
     DB_USERNAME=root
     DB_PASSWORD=
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
   Populates sample assets and users for testing.
7. **Link Storage**:
   ```bash
   php artisan storage:link
   ```
   Enables access to uploaded files.
8. **Compile Frontend Assets**:
   ```bash
   npm run dev
   ```
9. **Start the Development Server**:
   ```bash
   php artisan serve
   ```
   Access at `http://localhost:8000`.

## Using .gitignore
- The `.gitignore` file excludes sensitive files (e.g., `.env`, logs, asset uploads).
- Apply it:
  ```bash
  git add .gitignore
  git commit -m "Add .gitignore"
  ```
- Remove tracked sensitive files:
  ```bash
  git rm --cached .env
  git rm --cached storage/app/public/assets/*.pdf
  git commit -m "Remove sensitive files"
  ```

## Demo
Explore Samruddhi’s features through a demo series with a custom thumbnail: [Samruddhi Demo Series](https://www.youtube.com/playlist?list=YOUR_PLAYLIST_ID)  
Videos cover:
1. Creating asset categories
2. Uploading asset documents
3. Managing user permissions
4. Generating asset reports

## Testing
- Run Laravel tests:
  ```bash
  php artisan test
  ```
- Manually test asset tracking, file uploads, and reporting.

## Contributions
- **Asset Management**: Developed dynamic category and field creation for flexible asset tracking.
- **File Uploads**: Implemented secure PDF and image uploads with server-side validation.
- **Security**: Added role-based permissions to restrict access.
- **UI/UX**: Designed responsive interface for seamless navigation.

## Security Notes
- Ensure `.env` is in `.gitignore` to avoid exposing credentials.
- Sanitize code and videos for sensitive data (e.g., no real asset data).
- Scan for secrets before pushing:
  ```bash
  docker run -it --rm -v "$(pwd):/pwd" trufflesecurity/trufflehog git file:///pwd
  ```
- Validate file uploads:
  ```php
  $request->validate(['asset' => 'required|file|mimes:pdf,jpg,png|max:10240']);
  ```

## License
This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.

## Contact
For questions or feedback, reach out to [Ravi Raj Ladha](mailto:ravirajladha@gmail.com).