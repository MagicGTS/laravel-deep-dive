FROM localhost/lnmp:latest

LABEL org.opencontainers.image.title="GekBrains Laravel Deep Dive (Nginx, PHP-FPM, MySQL)" \
    org.opencontainers.image.authors="Andrey Leshkevich <magicgts@gmail.com>" \
    org.opencontainers.image.description="Web appliance for learning Laravel Framework" \
    org.opencontainers.image.version="0.8"

RUN set -eux && \
    touch /var/log/php-fpm.log && \
    chown --quiet -R nginx:root /etc/nginx/ /etc/php-fpm.d/ /etc/php-fpm.conf /var/log/php-fpm /var/log/php-fpm.log /var/log/nginx && \
    chgrp -R 0 /etc/nginx/ /etc/php-fpm.d/ /etc/php-fpm.conf && \
    chmod -R g=u /etc/nginx/ /etc/php-fpm.d/ /etc/php-fpm.conf && \
    mkdir -p /var/lib/php/{session,wsdlcache} && \    
    mkdir -p /var/lib/php/session /opt/framework /var/cache/nginx && \
    composer create-project laravel/laravel /opt/framework && \
    cd /opt/framework && \
    composer require laravel/jetstream symfony/yaml franzose/closure-table laravel/socialite orchestra/parser predis/predis fruitcake/laravel-cors && \
	composer require barryvdh/laravel-debugbar --dev && \
    php artisan jetstream:install inertia && \
    npm install && \
    npm install vuex@next @vueblocks/vue-use-core @vueup/vue-quill@beta axios @jambonn/vue-lazyload less less-loader laravel-mix-alias @vueblocks/vue-use-vuex --save-prod && \
    npm install browser-sync browser-sync-webpack-plugin@^2.3.0 --save-dev --legacy-peer-deps && \
	sed -i "s/logfile \/var\/log\/redis\/redis\.log/logfile \/dev\/stdout/g" /etc/redis.conf && \
    touch /opt/framework/.firstrun && \
    chown --quiet -R nginx:root /var/lib/php/{session,wsdlcache}/ /opt/framework /opt/framework/.firstrun /var/cache/nginx /var/lib/redis && \
    rm -rf /var/lib/mysql/* && \
    chgrp -R 0 /var/lib/php/{session,wsdlcache}/ && \
    chmod -R g=u /var/lib/php/{session,wsdlcache}/ && \    
    rm -f /etc/nginx/conf.d/php-fpm.conf /etc/nginx/default.d/php.conf /etc/nginx/nginx.conf && \
    rm -f /etc/php-fpm.d/www.conf && \
    rm -f /etc/opt/remi/php81/php-fpm.d/www.conf /etc/opt/remi/php81/{php.ini,php-fpm.conf} /etc/opt/remi/php81/php.d/15-xdebug.ini && \
    rm -f /etc/php-fpm.conf && \
    rm -rf /var/lib/mysql/* && \
    chown --quiet -R nginx. /var/lib/mysql

COPY --chown=1000:0 ["conf/etc/", "/etc/"]

COPY --chown=1000:0 ["framework/", "/opt/framework/"]

COPY --chown=1000:0 ["db/gb1.sql", "/var/lib/mysql/"]

EXPOSE 8080/TCP
EXPOSE 3306/TCP
EXPOSE 3000/TCP
EXPOSE 3001/TCP

ENV CLIENT_HOST=localhost
ENV CONTAINER_HOST=localhost

WORKDIR /opt/framework

COPY --chmod=755 ["docker-entrypoint.sh", "/usr/bin/"]

USER 1000

VOLUME ["/opt/framework", "/var/lib/mysql"]

ENTRYPOINT ["docker-entrypoint.sh"]