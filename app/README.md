# Campaigns Backend APIs

This php application is build to provide APIs for marketing campaign and APIs for all the other features associated with marketing campaigns, e.g. dashboard, campaign stats, reports, campaign preview.

## What's being installed
* included
 a) swagger api doc
 b) php-fpm
 c) nginx server
 

step to run this application
1. download docker
2. in symfony_assignment, run `docker-compose up -d -build`
3. execute `docker-compose exec php /bin/bash`
4. run `composer update`
5. run `symfony console doctrine:migrations:migrate`
6. run `symfony console doctrine:fixtures:load`
7. navigate to `http://localhost:8080/api/doc`
