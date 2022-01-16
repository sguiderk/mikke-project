## Background

PHP application using design pattern mvc,solid principles,composer for dependencies
and docker-compose for setting up the environment with Apache2 and PHP8
and it provides a clean code with PSR0 and PSR4 for autoload,also the
PSR1,PSR2,PSR3 ,

## Run the project
### Setup
- `docker-compose up -d`

## Import the database
### Setup
- `the table to import is in the folder db_to_import\table_to_import.sql`

## Execute the script 

php source/app/bootstrap.php > file.csv


## Tests
this application contains a 5 test cases with phpunit
- `docker-compose exec php vendor/bin/phpunit`

Happy reading!
