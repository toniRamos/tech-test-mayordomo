#!/bin/sh
docker rm -f test-mayordomo
docker run -ti --name test-mayordomo -p 8000:8000 -v /Users/antonio/Desktop/prueba-tecnica-mayordomo/tech-test-mayordomo:/app test-mayordomo ./start.sh