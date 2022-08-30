server {
	listen 80;
	server_name _;

	root /var/www/public/;
	index index.php;

	gzip on;
	gzip_types text/css application/javascript;

	error_log /var/log/nginx/error.log;
    access_log /var/log/nginx/access.log;

    charset utf-8;

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ ^/.+\.php(/|$) {
        fastcgi_pass fpm:9000;
        fastcgi_index index.php;
        fastcgi_split_path_info ^(.+\.php)(/.*)$;
        include fastcgi_params;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        fastcgi_param HTTPS off;
        fastcgi_param APPLICATION_ENV local;
    }

    location ~* \.(txt|js|css|gif|jpg|jpeg|png|svg|ttf|zip|pdf|ico|xml|html|woff|woff2|csv|xls?x)(\?(.*))?$ {
        expires 3d;
        if ($http_user_agent ~* "(Yandexbot|Googlebot)") {
            error_page 418 = @bots;
            return 418;
        }
        root /var/www/public/;
    }



}
