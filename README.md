 
- `docker-compose up -d`

- `docker container ls`

Then enter into matchbox_app container via 
- `docker exec -it <container-id> bash`

- `composer install`

- `bin/console doctrine:database:create`

- `bin/console doctrine:migrations:migrate`
 
- `bin/console doctrine:fixtures:load`

Import/export commands

- `bin/console app:converter export json`

- `bin/console app:converter export xml`

- `bin/console app:converter import json`

- `bin/console app:converter import xml`
