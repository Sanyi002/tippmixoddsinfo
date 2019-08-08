# Version: 1.0.1
# Author: Sandor Szabo (sanyi002)
# Created: 2018.07.00
# This Dockerfile will handle all the task that handle the data scraping.

FROM alpine:latest

# Install Python3, pip and PyMySQL
RUN echo "**** install Python ****" && \
    apk add --no-cache python3 && \
    if [ ! -e /usr/bin/python ]; then ln -sf python3 /usr/bin/python ; fi && \
    \
    echo "**** install pip ****" && \
    python3 -m ensurepip && \
    rm -r /usr/lib/python*/ensurepip && \
    pip3 install --no-cache --upgrade pip setuptools wheel && \
    if [ ! -e /usr/bin/pip ]; then ln -s pip3 /usr/bin/pip ; fi && \
    pip3 install peewee PyMySQL

COPY ./src /home/scraper
