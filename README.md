# Rest-Api-With-JWT-Auth
 This is a simple rest api development project. In this project here i developed & show that how to make rest api using laravel 8 and jwt use for authentication.

### Module Overview <hr>
* Registration
* Login
* Profile
* Logout
* Department
    * Add new department
    * All department Details
    * Individual department Details
    * Department edit & update
    * Department delete


## How to Install and Run the Project

1. ```git clone https://github.com/mamunurrashid1010/Rest-Api-With-JWT-Auth.git RestApi-With-JWT-Auth```
2. ```cd RestApi-With-JWT-Auth```
3. ```composer install```
3. Copy ```.env.example``` to ```.env```
4. ```php artisan serve```
5. You can see the project on ```127.0.0.1:8000```

##### Create a Database:
Create a database, here I'm using my XAMPP PHPMyAdmin Database to create a database.<br>
* Open ``` .env ``` file and add your database credentials.
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=rest_api_db
DB_USERNAME=root
DB_PASSWORD=
```

## Usage

##### POST: Registration
```
http://127.0.0.1:8000/api/auth/register
```
###### Request Body:form-data
```
name     :  Mamunur Rashid
email    :  mamun@gmail.com
password :  12345
```
###### Response samples
```
{
    "message": "User Create Successfully",
    "user": {
        "name": "Mamunur Rashid",
        "email": "mamun@gmail.com",
        "updated_at": "2022-11-02T04:05:24.000000Z",
        "created_at": "2022-11-02T04:05:24.000000Z",
        "id": 1
    }
}
```

##### POST: Login
```
http://127.0.0.1:8000/api/auth/login
```

###### Request Body:form-data
```
email    :  mamun@gmail.com
password :  12345
```

###### Response samples
```
{
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLj...",
    "token_type": "bearer",
    "user": {
        "id": 1,
        "name": "Mamunur Rashid",
        "email": "mamun@gmail.com",
        "email_verified_at": null,
        "created_at": "2022-11-02T04:05:24.000000Z",
        "updated_at": "2022-11-02T04:05:24.000000Z"
    }
}
```

##### GET: Profile Details
```
http://127.0.0.1:8000/api/auth/profile
```
###### Request Authorization 
```
Type    : Bearer Token
Token   : eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9....
```
###### Response samples
```
{
    "id": 1,
    "name": "Mamunur Rashid",
    "email": "mamun@gmail.com",
    "email_verified_at": null,
    "created_at": "2022-11-02T04:05:24.000000Z",
    "updated_at": "2022-11-02T04:05:24.000000Z"
}
```

##### POST: Logout
```
http://127.0.0.1:8000/api/auth/logout
```
###### Request Authorization 
```
Type    : Bearer Token
Token   : eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9....
```
###### Response samples
```
{
    "message": "User logged out"
}
```

### Department Module<hr>

##### POST: Insert Department Info
```
http://127.0.0.1:8000/api/department/store
```
###### Request Authorization 
```
Type    : Bearer Token
Token   : eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9....
```
###### Request Body:form-data
```
name     :  Accounts
```
###### Response samples
```
{
    "message": "Department added successfully"
}
```

##### GET: All Department List
```
http://127.0.0.1:8000/api/department/getDepartmentList
```
###### Request Authorization 
```
Type    : Bearer Token
Token   : eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9....
```
###### Response samples
```
{
    "departments": [
        {
            "id": 1,
            "name": "Software Dev"
        },
        {
            "id": 3,
            "name": "HR"
        },
        {
            "id": 4,
            "name": "Marketing"
        }
    ]
}
```

##### GET: Department Details
```
http://127.0.0.1:8000/api/department/details/2
```
###### Request Authorization 
```
Type    : Bearer Token
Token   : eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9....
```
###### Response samples
```
{
    "department": {
        "id": 2,
        "name": "Accounts"
    }
}
```

##### GET: Edit 
```
http://127.0.0.1:8000/api/department/edit/2
```
###### Request Authorization 
```
Type    : Bearer Token
Token   : eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9....
```
###### Response samples
```
{
    "department": {
        "id": 2,
        "name": "Accounts"
    }
}
```

##### POST: Update Department Info
```
http://127.0.0.1:8000/api/department/update
```
###### Request Authorization 
```
Type    : Bearer Token
Token   : eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9....
```
###### Request Body:form-data
```
edit_id  :  2
name     :  HRMS
```
###### Response samples
```
{
    "message": "Updated Successfully."
}
```

##### POST: Delete Department
```
http://127.0.0.1:8000/api/department/delete/5
```
###### Request Authorization 
```
Type    : Bearer Token
Token   : eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9....
```
###### Response samples
```
{
    "message": "Delete Successfully"
}
```
