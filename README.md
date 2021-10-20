## 1. Clone this repo and cd to project root dir

```bash
git clone https://github.com/Nataset/SA-backend.git
```

```bash
cd SA-backend
```

## 2. Install package

> composer and laravel 8 require

```bash
composer install
```

## 3. Create .env file

```bash
cp .env.example .env
```

## 4. Edit .env file with text editer

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE= {your database name }
DB_USERNAME= {your database username }
DB_PASSWORD= {your database password }
```

### 4.1 if you are not using http://localhost:8000/ at your host url, change this valuable (last line)

```bash
MIX_LARAVEL_END_POINT="http://localhost:8000/"
```

## 5. Generate app key

```bash
php artisan key:generate
php artisan jwt:secret
```

### 5.1 Create database with same name as 'DB_DATABASE' in .env

### 5.2 Create symbolic link from storage/app/public/ to public/storage/

```bash
php artisan storage:link
```

## 6. Migrate table and seed record

```bash
php artisan migrate --seed
```

## 7. Complie

```bash
php artisan serve
```

