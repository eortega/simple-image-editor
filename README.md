### Pre-Requisites
- Docker

### Execute Test Suite
To run test suite execute the command shown below: 

```bash
$ docker-compose run composer install
$ docker-compose run phpunit --colors=always --testdox
```


### Execute the Application
To run the application execute the command shown below: 

```bash
$ docker-compose run composer install
$ docker-compose run php -f src/SimpleImageEditor.php
```