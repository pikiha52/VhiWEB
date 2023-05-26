# Fisrt Clone
> Use docker
- clone repository
- settings env
- download vendor ```
    docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php81-composer:latest \
    composer install --ignore-platform-reqs``` 
- ```sail up -d```
- buat key ``` sail artisan key:generate ```
- ```sail artisan jwt:secret```
- migrate database ``` sail artisan migrate ```
- run. seeder users ```sail artisan db:seed --class=UserSeeder ```
- download npm ``` sail npm install ``` 
- run npm ``` sail npm run dev ```
##

# API
REST API response

## Rest API Popular Endpoint Formats

- backend base_url
> http://localhost/api

- frontend base_url
> http://localhost

## Rest API Success Responses & Request
2- GET - Get photos - HTTP Response Code: **200**
- /api/photos
```javascript
    HTTP/1.1 200
    "requests" => {
      "email": "example@dev.com",
      "password": "example"
    },
    "responses" => {
      "success": true,
      "user": {
          "id": 1,
          "name": "Example name",
          "email": "example@dev.com",
          "email_verified_at": null,
          "created_at": "2023-05-25T05:02:09.000000Z",
          "updated_at": "2023-05-25T05:02:09.000000Z"
      },
      "token": "example"
  } 
```

2- GET - Get photos - HTTP Response Code: **200**
- /api/photos
```javascript
    HTTP/1.1 200
    "requests" => {

    },
    "responses" => {
    "code": 200,
    "data": [
        {
            "id": 1,
            "title": "Message queue",
            "slug": "message-queue",
            "image": "EAFL3ZJK81EIZg7O0gQ23Y2zVbNVDktkXC9eRugC.png",
            "caption": "Ini library untuk message queue di express js, karna saya seorang backend developer",
            "tags": [
                {
                    "tag": "#developer"
                },
                {
                    "tag": "  #backend"
                }
            ],
            "likes": 2,
            "user_likes": [
                {
                    "id": 1,
                    "user_id": 1,
                    "status": "like"
                },
                {
                    "id": 2,
                    "user_id": 2,
                    "status": "like"
                }
            ],
            "users": {
                "id": 1,
                "name": "John does"
            }
        },
        {
            "id": 2,
            "title": "EJP Logo",
            "slug": "ejp-logo",
            "image": "sroplEa5RXpRa5wT1dQS65DKBozvOHKYhST7x11L.jpg",
            "caption": "Ini adalah logo dari sebuah perusahaan",
            "tags": [
                {
                    "tag": "#design"
                },
                {
                    "tag": "#logo"
                },
                {
                    "tag": "#ui"
                }
            ],
            "likes": 2,
            "user_likes": [
                {
                    "id": 3,
                    "user_id": 1,
                    "status": "like"
                },
                {
                    "id": 4,
                    "user_id": 2,
                    "status": "like"
                }
            ],
            "users": {
                "id": 2,
                "name": "Ayam jago"
            }
        }
    ]
}
```

3- GET - Get single photos - HTTP Response Code: **200**
- /api/photos/{id}
```javascript
    HTTP/1.1 200
    Content-Type: application/json

    {
        "code": 200,
        "data": {
            "id": 2,
            "title": "EJP Logo",
            "slug": "ejp-logo",
            "image": "sroplEa5RXpRa5wT1dQS65DKBozvOHKYhST7x11L.jpg",
            "caption": "Ini adalah logo dari sebuah perusahaan",
            "tags": [
                {
                    "tag": "#design"
                },
                {
                    "tag": "#logo"
                },
                {
                    "tag": "#ui"
                }
            ],
            "likes": 2,
            "user_likes": [
                {
                    "id": 3,
                    "user_id": 1,
                    "status": "like"
                },
                {
                    "id": 4,
                    "user_id": 2,
                    "status": "like"
                }
            ],
            "users": {
                "name": "Ayam jago"
            }
        }
    }
```

4- POST - Create a new photos - HTTP Response Code: **201**
- /api/photos
```javascript
    HTTP/1.1  201 
    "requests" => {
      "title": "Example",
      "image": "example.png",
      "caption": "example caption",
      "tags": "#example,#example2"
    },
    "responses" => {
        "code": 200,
        "message": "Success!"
    }
```
5- PUT - Update an photos - HTTP Response Code: **200/204** 
- /api/photos/{id}

```javascript
    HTTP/1.1  200
    {
        "code": 200,
        "message": "Post was successfully update"
    }
```

6- DELETE - Delete an photos - HTTP Response Code: **200**
- /api/photos/{id}
```javascript
    HTTP/1.1  200
    {
      "code": 200,
      "message": "Success"
    }
```

7- LIKE - Like an photos - HTTP Response Code: **200**
- /api/photos/{id}/like
```javascript
    HTTP/1.1  200
    {
      "code": 200,
      "message": "Success"
    }
```

8- UNLIKE - Unlike an photos - HTTP Response Code: **200**
- /api/photos/{id}/unlike
```javascript
    HTTP/1.1  200
    {
      "code": 200,
      "message": "Success"
    }
```
