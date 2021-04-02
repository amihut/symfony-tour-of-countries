# Symfony & React Tour Of Countries

# Start the application

## Install all the dependencies listed within composer.json & package.json
composer install

yarn install

## Compile js and listen for changes
yarn watch

## Start the server
sudo symfony serve

## Access the site on
http://127.0.0.1:8000

# Overview

This is an example of Symfony, Webpack & React Hooks, Tour Of Countries, Application in that:
- Each Country has an id, name, code, prefix
- You can get, update Countries
- You can search for a Country by code

# WEB API

| Methods   |      Urls      |  Actions |
|----------|:-------------:|------:|
| GET |  /api/locations/countries | fetch all countries |
| GET |    api/locations/countries/id/:id  |   fetch a country by id |
| GET | api/locations/countries/code/:code |    fetch a country by code |
| PUT | api/locations/countries/id/:id |    update a country by code |

# Technology

- React 17
- axios 0.21.1
- bootstrap 4.6.0
- fontawesome 4.7.0
- symfony 5
- symfony/webpack-encore 1

