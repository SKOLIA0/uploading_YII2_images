# uploading_YII2_images


git clone https://github.com/SKOLIA0/uploading_YII2_images.git

cd uploading_YII2_images

docker-compose build --no-cache


docker-compose up -d


docker exec -it yii2_app bash


php yii migrate


chmod -R 777 /var/www/html/web/assets /var/www/html/runtime


exit


postman


get

http://213.171.9.80:8080/api/parameters
