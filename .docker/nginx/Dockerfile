FROM nginx:1.15.0-alpine

RUN apk update && apk add bash

RUN rm /etc/nginx/conf.d/default.conf

#RUN echo "nameserver 8.8.8.8 # Servidor DNS Primário" >> /etc/resolv.conf

COPY ./nginx.conf /etc/nginx/conf.d