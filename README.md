# Football Team Management API
Simple laravel api for football team management

### Features

- Based On Laravel 5.6 
- CRUD for Teams
- CRUD for Players
- Authentication Methods with [laravel Passport](https://laravel.com/docs/5.6/passport)

### Query Parameters

- **limit** = limit results to this number, default = 10
- **order_by** = order results to this field, default = created_at
  - example for players endpoint: market_value, height, age ...
- **sort** = set direction of sort, default = desc
- **page** = set page for pagination system, default = 1


### How To Run

1. Download or Pull project
2. go to project folder and run: ``` composer install ```
3. set your database info in **.env** file
4. to seed sample data run: ``` php artisan migration:refresh --seed ```
5. to create passport keys run: ``` php artisan passport:install --force```
5. to up project run: ``` php artisan serve ```

### How to Authenticate

To access api endpoints you should login first to get an **access_token** with login route. then you should send this token as header parameter with every request.
##### jQuery example:
  ```
  var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://your-api.com/api-endpoint",
    "method": "GET",
    "headers": {
      "Content-Type": "application/json",
      "Auth": "Bearer {{access_token}}"
    },
    "data": {}
  }
  $.ajax(settings).done(function (response) {
    console.log(response);
  });
  ```

### Example User Info for Authentication

> username: admin@example.com - password: secret

### TODO

- [ ] Add Nationality to Players.
- [ ] Add Ability Model for Players.
- [ ] Add Managers for Teams.
- [ ] Add Leages and Championship Endpoints.