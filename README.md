
## 🧩 learning materials and Installation
- Backpack Documentation for Admin Panel – ⏱️ 2 hours
- Docker Documentation – ⏱️ 2 hours
- Nginx Documentation – ⏱️ 2 hours 30 mins
- Installing Docker and nginx – ⏱️ 1 hour

## 📞 Contact Manager (Laravel + Backpack)

`git -m “Initial commit -  fresh Laravel Project/spend 10mins”`  
`git -m “Install Backpack for Laravel  /spend 40 mins”`  
`git -m “Initial Backpack installation with admin user  /spend 30 mins”`  
`git -m “Fixed image Error  /spend 45 mins”`  
`git -m “Fixed image name  /spend 30 mins”`  
`git -m “Added and created at 10 mins”`  
`git -m “Changed Route  /spend 10 mins”`

## 📞 Deployment of Contact Manager
`sudo apt update`  🕒 30s  
`sudo apt install -y ca-certificates curl gnupg lsb-release`  🕒 15s  

`sudo mkdir -m 0755 -p /etc/apt/keyrings`  🕒 1s  
`curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo gpg --dearmor -o /etc/apt/keyrings/docker.gpg`  🕒 5s  

`echo "deb [arch=$(dpkg --print-architecture) signed-by=/etc/apt/keyrings/docker.gpg] https://download.docker.com/linux/ubuntu $(lsb_release -cs) stable" | sudo tee /etc/apt/sources.list.d/docker.list > /dev/null`  🕒 1s  

`sudo apt update`  🕒 20s  
`sudo apt install -y docker-ce docker-ce-cli containerd.io docker-compose-plugin`  🕒 2 mins  
`docker --version`  🕒 1s  
`docker compose version`  🕒 1s  
`cd /opt`  🕒 1s  
`sudo git clone https://github.com/Snoopy1132/contact-manager.git`  🕒 15–25s  
`cd contact-manager`  🕒 1s  
`sudo nano docker-compose.yml`  🕒 30 mins  

`nano Dockerfile`  🕒 2 hours 30 mins  
`sudo nano nginx.conf`  🕒 3 hours  
`sudo docker exec -it contact-manager-app bash`  🕒 1s  
`composer install`  🕒 3 mins  
`cp .env.example .env`  🕒 1s  
`sed -i 's|APP_URL=.*|APP_URL=http://localhost|' .env`  🕒 1s  
`sed -i 's|DB_HOST=.*|DB_HOST=db|' .env`  🕒 1s  
`sed -i 's|DB_DATABASE=.*|DB_DATABASE=contact_manager|' .env`  🕒 1s  
`sed -i 's|DB_USERNAME=.*|DB_USERNAME=contact|' .env`  🕒 1s  
`sed -i 's|DB_PASSWORD=.*|DB_PASSWORD=contactpass|' .env`  🕒 1s  
`php artisan key:generate`  🕒 1s  
`php artisan migrate --seed`  🕒 1s  
`php artisan storage:link`  🕒 1s  
`chmod -R 775 storage bootstrap/cache`  🕒 1s  
`chown -R www-data:www-data storage bootstrap/cache`  🕒 1s  
`nano .env`  🕒 1 hour  
`sudo docker compose up -d --build`  🕒 1s
`exit`

## 📄 Created files

### Dockerfile
```bash
FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    git curl zip unzip libpng-dev libonig-dev libxml2-dev libzip-dev && \
    docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www
COPY . .

RUN composer install && \
    php artisan key:generate && \
    chmod -R 777 storage bootstrap/cache
```

### docker-compose.yml
```bash
version: "3.8"

services:
  app:
    build:
      context: .
      dockerfile: Dockerfile
    container_name: contact-manager-app
    restart: unless-stopped
    working_dir: /var/www
    volumes:
      - ./:/var/www
    depends_on:
      - db
    networks:
      - contactnet

  db:
    image: mysql:8
    container_name: contact-manager-db
    restart: unless-stopped
    environment:
      MYSQL_DATABASE: contact_manager
      MYSQL_USER: contact
      MYSQL_PASSWORD: contactpass
      MYSQL_ROOT_PASSWORD: rootpass
    volumes:
      - dbdata:/var/lib/mysql
    networks:
      - contactnet

  nginx:
    image: nginx:latest
    container_name: contact-manager-nginx
    restart: unless-stopped
    ports:
      - "80:80"
    volumes:
      - ./:/var/www
      - ./nginx.conf:/etc/nginx/conf.d/default.conf
    depends_on:
      - app
    networks:
      - contactnet

networks:
  contactnet:

volumes:
  dbdata:
    driver: local
```

### nginx.conf
```bash
server {
    listen 80;
    server_name _;

    root /var/www/public;
    index index.php index.html;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location /storage/ {
        alias /var/www/storage/;
        access_log off;
        expires 1M;
        add_header Cache-Control "public";
    }

    location ~ \.php$ {
        include fastcgi_params;
        fastcgi_pass contact-manager-app:9000;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        fastcgi_param PATH_INFO $fastcgi_path_info;
        fastcgi_param HTTPS $https if_not_empty;
    }

    location ~ /\.ht {
        deny all;
    }
}
```

## 🌐 Link to Contact Manager
http://37.221.194.51/admin

## 👩‍💼 Admin Details
<p>Email: Admin@example.com</p>
<p>Password: password</p>

