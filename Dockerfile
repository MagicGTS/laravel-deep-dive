FROM library/rockylinux:latest

LABEL org.opencontainers.image.title="GekBrains Laravel Deep Dive (Nginx, PHP-FPM, MySQL)" \
    org.opencontainers.image.authors="Andrey Leshkevich <magicgts@gmail.com>" \
    org.opencontainers.image.description="Web appliance for learning Laravel Framework" \
    org.opencontainers.image.version="0.8"


RUN set -eux && \
    dnf update -y && \
    dnf -y install epel-release && \
    REPOLIST="baseos,appstream,epel,extras" && \
    INSTALL_PKGS="curl \
    bash-completion \
    nano \
    less \
    python3 \
    supervisor \
    findutils \
    glibc-locale-source \
    curl \
    unzip \
    boost-program-options \
    yum-utils" && \
    dnf -y install \
    --disablerepo "*" \
    --enablerepo "${REPOLIST}" \
    --setopt=tsflags=nodocs \
    --setopt=install_weak_deps=False \
    --best \
    ${INSTALL_PKGS} && \
    dnf -y clean all && \
    rm -rf /var/cache/yum /var/lib/yum/yumdb/* /usr/lib/udev/hwdb.d/* && \
    rm -rf /var/cache/dnf /etc/udev/hwdb.bin /root/.pki

RUN set -eux && \
    dnf install https://rpms.remirepo.net/enterprise/remi-release-8.rpm -y && \
    curl -LsS https://downloads.mariadb.com/MariaDB/mariadb_repo_setup | bash && \
    dnf upgrade -y && \
    dnf update -y && \
    groupadd -g 1000 -r nginx && \
    useradd -u 1000 -r -g nginx -G root -s /sbin/nologin -d /var/cache/nginx -c "nginx user"  nginx && \
    dnf module reset php nodejs && \
    dnf module install php:remi-8.1 nginx:1.20 nodejs:12 -y && \
    REPOLIST="baseos,appstream,epel,mariadb-main,extras,remi-modular,remi-safe" && \
    INSTALL_PKGS="nginx \
    php81-php-bcmath \
    php81-php-cli \
    php81-php-dba \
    php81-php-fpm \
    php81-php-gd \
    php81-php-imap \
    php81-php-intl \
    php81-php-json \
    php81-php-ldap \
    php81-php-mbstring \
    php81-php-mysqlnd \
    php81-php-pdo \
    php81-php-pear \
    php81-php-pecl-apcu \
    php81-php-pecl-mcrypt \
    php81-php-pecl-memcached \
    php81-php-xml \
    php81-php-xmlrpc \
    php81-php-opcache \
    php81-php-pecl-xdebug3 \
    composer \
    php-mysqlnd \
    boost-program-options \
    MariaDB-server \
    MariaDB-client" && \
    dnf -y install \
    --disablerepo "*" \
    --enablerepo "${REPOLIST}" \
    --setopt=tsflags=nodocs \
    --setopt=install_weak_deps=False \
    --best \
    ${INSTALL_PKGS} && \
    dnf -y clean all && \
    rm -rf /var/cache/yum /var/lib/yum/yumdb/* /usr/lib/udev/hwdb.d/* && \
    rm -rf /var/cache/dnf /etc/udev/hwdb.bin /root/.pki && \
    touch /var/log/php-fpm.log && \
    chown --quiet -R nginx:root /etc/nginx/ /etc/php-fpm.d/ /etc/php-fpm.conf /var/log/php-fpm /var/log/php-fpm.log /var/log/nginx && \
    chgrp -R 0 /etc/nginx/ /etc/php-fpm.d/ /etc/php-fpm.conf && \
    chmod -R g=u /etc/nginx/ /etc/php-fpm.d/ /etc/php-fpm.conf && \
    mkdir -p /var/lib/php/{session,wsdlcache} && \    
    mkdir -p /var/lib/php/session /opt/framework /var/cache/nginx && \
    composer create-project laravel/laravel /opt/framework && \
    cd /opt/framework && \
    composer require laravel/jetstream symfony/yaml franzose/closure-table laravel/socialite && \
	composer require barryvdh/laravel-debugbar --dev && \
    php artisan jetstream:install inertia && \
    npm install && \
    npm install vuex@next --save && \
    npm install axios @jambonn/vue-lazyload && \
    npm install -D less less-loader laravel-mix-alias && \
    npm install browser-sync browser-sync-webpack-plugin@^2.3.0 --save-dev --legacy-peer-deps && \
    touch /opt/framework/.firstrun && \
    chown --quiet -R nginx:root /var/lib/php/{session,wsdlcache}/ /opt/framework /opt/framework/.firstrun /var/cache/nginx && \
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