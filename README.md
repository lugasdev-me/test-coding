TEST CODING DOCKER - LIVEWIRE - OAUTH2

DOCKER -- Error Guzzle for Laradock (currently still error)
Livewire -- nothing actions, only get orders
OAUTH2 -- Error Guzzle in docker lokal laradock.

Untuk bisa menjalankan program ada beberapa container/image yang dibutuhkan:
1. php-fpm8.2
2. nginx
3. redis
4. php-worker (supervisord untuk menjalankan horizon queue)

Beberapa konfigurasi nginx; Jika anda pengguna windows, ubah hosts sesuai domain custom (coding-collective.test)

server {

    listen 80;
    listen [::]:80;

    # For https
    # listen 443 ssl default_server;
    # listen [::]:443 ssl default_server ipv6only=on;
    # ssl_certificate /etc/nginx/ssl/default.crt;
    # ssl_certificate_key /etc/nginx/ssl/default.key;

    server_name coding-collective.test;
    root /var/www/coding-collective/public;
    index index.php index.html index.htm;

    location / {
         try_files $uri $uri/ /index.php$is_args$args;
    }

    
    location ~ \.php$ {
        try_files $uri /index.php =404;
        fastcgi_pass php-upstream;
        fastcgi_index index.php;
        fastcgi_buffers 16 16k;
        fastcgi_buffer_size 32k;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        #fixes timeouts
        fastcgi_read_timeout 600;
        include fastcgi_params;
    }

    location ~ /\.ht {
        deny all;
    }

    location /.well-known/acme-challenge/ {
        root /var/www/letsencrypt/;
        log_not_found off;
    }
}

Beberapa konfigurasi supervisord horizon; Jalankan di php-worker;

[program:laravel-horizon]
process_name=%(program_name)s_%(process_num)02d
command=php /var/www/coding-collective/artisan horizon
directory=/var/www/coding-collective
autostart=true
autorestart=true
numprocs=8
user=laradock
redirect_stderr=true
stdout_logfile=/var/www/coding-collective/storage/logs/horizon.log





PROSES ~
1. install laradock~ didalam project (single) atau sejajar dengan project (multi project). Dan jgn lupa copy .env
2. docker-compose up -d nginx workspace mysql redis php-worker
3. tunggu...
4. masuk ke bash untuk menjalankan artisan,
5. ketik -> docker-compose exec --user=laradock workspace bash
6. masuk ke folder project (jika multi project)
7. composer update, dan perintah perintah lainnya seperti artisan laravel.
8. Thankyou, project ini akan diperbaruhi sebagai bahan ajar.

Lugas.
