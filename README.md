<div align="center">
    <img src="public/images/favicon.png" alt="Project Logo" width="250">
</div>

# Restaurant Reservation System

Restaurant reservation system. Create an account, reserve a table at your favorite restaurants and write reviews.

## Installation and Setup

### Prerequisites

- **Docker** (for Laravel Sail setup)
- **PHP** ^8.2 (for local setup)
- **Composer** (for local setup)
- **Node.js** and **npm** (for local setup)
- **MySQL** (for local setup)

### Docker Setup with Laravel Sail

1. **Clone the repository**:
    ```bash
    git clone https://github.com/Vencelg/Reservoo.git
    cd reservoo
    ```

2. **Copy the `.env.example` file to `.env`**:
    ```bash
    cp .env.example .env
    ```

3. **Install dependencies**:
    ```bash
    ./vendor/bin/sail composer install
    ```

4. **Generate an application key**:
    ```bash
    ./vendor/bin/sail artisan key:generate
    ```

5. **Run database migrations and seeders**:
    ```bash
    ./vendor/bin/sail artisan migrate:fresh --seed
    ```

6. **Start the development server**:
    ```bash
    ./vendor/bin/sail up -d
    ```

7. **Compile the assets**:
    ```bash
    ./vendor/bin/sail npm run dev
    ```

8. **Access the application**:
    - Visit `http://localhost` in your browser.

### Local Setup

1. **Clone the repository**:
    ```bash
    git clone https://github.com/Vencelg/Reservoo.git
    cd reservoo
    ```

2. **Copy the `.env.example` file to `.env`**:
    ```bash
    cp .env.example .env
    ```

3. **Install PHP dependencies**:
    ```bash
    composer install
    ```

4. **Install JavaScript dependencies**:
    ```bash
    npm install
    ```

5. **Generate an application key**:
    ```bash
    php artisan key:generate
    ```

6. **Set up the database**:
    - Update the `.env` file with your database connection details:
        ```env
        DB_CONNECTION=mysql
        DB_HOST=127.0.0.1
        DB_PORT=3306
        DB_DATABASE=your-database-name
        DB_USERNAME=your-database-username
        DB_PASSWORD=your-database-password
        ```

7. **Run database migrations and seeders**:
    ```bash
    php artisan migrate --seed
    ```

8. **Compile the assets**:
    ```bash
    npm run dev
    ```

9. **Start the development server**:
    ```bash
    php artisan serve
    ```

10. **Access the application**:
    - Visit `http://localhost:8000` in your browser.

### User Accounts

- **Register your own user account**.
- **Use a premade user**:
    - **Email**: `jdoe@email.com`
    - **Password**: `password`

## Testing

To run tests, use the following commands:

### Using Laravel Sail

```bash
./vendor/bin/sail artisan test
```

### Locally

```bash
php artisan test
```
