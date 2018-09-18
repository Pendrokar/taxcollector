# CakePHP Prototype Application

## Installation

1. Run the following while also saying 'Y' to setting folder permissions when prompted: composer install
2. Create databases named: 'taxcollector' and 'taxcollector_test'
3. Import tables from config/schema/tables.sql file with phpMyAdmin or the following mysql command within the project: mysql -u<username> -p taxcollector < config/schema/tables.sql
4. Configure MySQL setttings on lines at ~258 and ~300(my_app & secret) of config/app.php

## Running tests

Run: vendor/bin/phpunit tests/

## Import fake data

200 rows of fake data is prepared under tests/Fixtures/sql/fakedata.sql
Import them through phpMyAdmin or the following mysql command within the project: mysql -u<username> -p taxcollector < tests/Fixture/sql/fakedata.sql


You can now either use your machine's webserver to view the default home page, or start
up the built-in webserver with:

```bash
bin/cake server -p 8243
```

Then visit `http://localhost:8243` to see the welcome page.
