#!/usr/bin/env bash

docker build -t apache2 .

if [[ $(docker ps -f name=tuto-apache2 -aq ) ]]; then
    echo 'Starting Apache2 container ...'
    docker start tuto-apache2 && docker exec -it tuto-apache2 /bin/bash
else
    echo 'Running Apache2 container ...'
    docker run -it -p 8080:80 --name tuto-apache2 \
        -v $(pwd)/apache2:/etc/apache2 \
        -v $(pwd)/html:/var/www/html \
        apache2
fi
