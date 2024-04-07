# Project Setup and Execution Guide
This guide provides step-by-step instructions for setting up and running the Laravel project
for mortgage loan calculator web application.
## Prerequisites

Before running the project, ensure you have the following installed:
- PHP (>= 8.1)
- Composer
- MySQL database management system

## Installation

1. Clone the repository:
   ```bash
   git clone <repository-url>


2. Change your directory :
   ```bash
    cd <project-directory>

3. install your vendor packages :
   ```bash
    composer install

4. Set and update your configuration file :
   ```bash
    cp .env.example .env

5. Generate your laravel project key :
   ```bash
    php artisan key:generate
   
6. Run migration files to set your database tables structure :
   ```bash
    php artisan migrate

6. Finally run the project :
   ```bash
    php artisan serve

6. Open the browser and use this link :
   ```bash
    http://localhost:3000
Additional Information
For production deployment, configure your web server (e.g., Apache or Nginx) to serve the Laravel application.
If you encounter any issues during setup or execution, refer to the Laravel documentation or seek assistance from the Laravel community.




   
