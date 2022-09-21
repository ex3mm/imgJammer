FROM nginx:latest

COPY ./conf.d/vhost.conf /etc/nginx/conf.d/
COPY ./conf.d/nginx.conf /etc/nginx/

RUN usermod -u 1000 www-data
CMD ["nginx"]
EXPOSE 80 443