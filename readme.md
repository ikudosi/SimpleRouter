## Simple Routing Test

This repo is a simple and light weight mini routing framework. 
It is not production ready so please do not use this as it's missing 
a lot of things other frameworks have. 

### Requirements
- PHP 7.1 (or higher)
- composer

### Installation
- Checkout repo
- Run ```composer install```
- Run ```vendor/bin/phpunit```

### Test Routes
- `GET` /patients
- `GET` /patients/{id}
- `POST` /patients
- `PATCH` /patients/{id}
- `DELETE` /patients/{id}
- `GET` /patients/{id}/metrics
- `GET` /patients/{id}/metrics/{metricId}
- `POST` /patients/{id}/metrics
- `PATCH` /patients/{id}/metrics/{metricId}
- `DELETE` /patients/{id}/metrics/{metricId}