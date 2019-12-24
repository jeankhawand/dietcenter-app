FROM nginx:alpine

RUN apk --update add supervisor
#addgroup -g 1000 -S www-data \
 #    &&
RUN  adduser -u 1000 -D -S -G www-data www-data

RUN rm /var/cache/apk/*

COPY certs/* /etc/ssl/certs/
COPY supervisord-web.conf /etc/supervisord.conf

ENTRYPOINT ["/usr/bin/supervisord", "-n", "-c", "/etc/supervisord.conf"]
