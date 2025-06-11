# Workout Manager

A Laravel-based application for managing gym workouts, featuring:
- Laravel API (with Sanctum for API auth, soft deletes, validation, filtering, sorting, user-scoped data)
- Filament Admin Panel (admin CRUD, filters, restore soft-deleted, admin by email)
- Livewire Frontend (register/login/logout, view/create/edit/delete workouts, search/filter, validation feedback, Tailwind UI)
- Docker Compose support for local development (MySQL or SQLite)

---

## Prerequisites
- PHP 8.2+
- Composer
- Node.js & npm (for asset compilation, if needed)
- MySQL or SQLite
- [Optional] Docker & Docker Compose (for containerized setup)

---

## Setup Instructions

### 1. Local Setup (Without Docker)

1. **Clone the repository:**
   ```sh
   git clone https://github.com/Detuli83/laravel-workout-management-livewire
   cd laravel-workout-management-livewire
   ```

2. **Install dependencies:**
   ```sh
   composer install
   ```

3. **Copy and configure your `.env` file:**
   ```sh
   cp .env.example .env
   ```
   - Set your `APP_URL` (e.g., http://localhost:8000)
   - Choose your database:
     - For SQLite:
       ```
       DB_CONNECTION=sqlite
       DB_DATABASE=./database/database.sqlite
       ```
       - Create the SQLite file:
         ```sh
         touch database/database.sqlite
         ```
     - For MySQL: update `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`

4. **Generate app key:**
   ```sh
   php artisan key:generate
   ```

5. **Run migrations and seeders:**
   ```sh
   php artisan migrate --seed
   ```

6. **Serve the application:**
   ```sh
   php artisan serve
   ```
   - Visit [http://localhost:8000](http://localhost:8000)

---

### 2. Docker Setup

1. **Clone the repository:**
   ```sh
   git clone https://github.com/Detuli83/laravel-workout-management-livewire
   cd laravel-workout-management-livewire
   ```

2. **Set up your `.env` file:**
   - Copy `.env.example` to `.env` (Docker will do this automatically if missing)
   - For custom domain, set:
     ```
     APP_URL=http://workout.local
     SESSION_DOMAIN=workout.local
     SANCTUM_STATEFUL_DOMAINS=workout.local
     ```
   - For SQLite (default):
     ```
     DB_CONNECTION=sqlite
     DB_DATABASE=/var/www/database/database.sqlite
     ```
   - For MySQL, update DB settings as needed.

3. **Add to your `/etc/hosts` (on your host):**
   ```
   127.0.0.1 workout.local
   ```

4. **Build and start the containers:**
   ```sh
   docker compose up --build
   ```

5. **Access the app:**
   - Visit [http://workout.local](http://workout.local) in your browser.

---

## Features
- **Authentication:** Register, login, logout (Livewire, session-based)
- **Workouts:** CRUD, search, filter, user-scoped
- **Admin Panel:** Filament for admin/user/workout management
- **Validation:** Frontend and backend, with error/success feedback
- **Soft Deletes:** Restore deleted workouts (admin)
- **Dockerized:** Works with SQLite or MySQL, auto-migrates and seeds
- **Modern UI:** Tailwind CSS, responsive, clean UX

---

## Development Workflow

- **Livewire Components:**
  - Auth (register, login, logout) use Laravel Auth directly (no API calls)
  - Workouts (index, create, edit) use Eloquent models for the logged-in user
  - All pages redirect unauthenticated users to login

- **Filament Admin:**
  - Access at `/admin` (if configured)
  - Admin user seeded by default (see seeder for credentials)

- **Database:**
  - By default, uses SQLite (`database/database.sqlite`)
  - To use MySQL, update `.env` and `docker-compose.yml` accordingly

- **Migrations & Seeders:**
  - Run automatically on container start (see `docker/entrypoint.sh`)
  - Admin user seeded for Filament access

- **Assets:**
  - Tailwind via CDN (no build step required for basic UI)

---

## Common Issues & Fixes

- **Login/Session Issues:**
  - Ensure `.env` and `/etc/hosts` match your access domain
  - Clear Laravel cache: `php artisan config:clear` (or `docker compose exec app php artisan config:clear`)
  - For Docker API calls to host, use `host.docker.internal` (Mac/Win only)

- **Permissions:**
  - SQLite file and `storage/` must be writable by the web server/container

- **Port Conflicts:**
  - If port 80 is in use, change the Nginx port mapping in `docker-compose.yml`

---

## Customization
- Update `.env` for your environment

---
