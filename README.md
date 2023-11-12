# Student Management API

Welcome to the Student Management API project. This project provides an API for managing students, teachers, and administrators.

## Getting Started

To get started with this project, you'll need to have Docker and Docker Compose installed on your machine.

### Installation

1. Clone this repository to your local machine:

    ```
    git clone https://github.com/adelchellabi/student-management-api.git
    cd student-management-api
    ```

2. Create a copy of the .env.example file and name it .env:
   `cp .env.example .env`

3. Open the .env file and configure the environment variables according to your preferences, including the database credentials and other settings.

#### Running the Application

1. Start and build containers: `docker-compose up -d --build`
2. Install the Composer dependencies: `docker-compose exec app composer install`
3. Generate the application key: `docker-compose exec app php artisan key:generate`
4. Run the database migrations: `docker-compose exec app php artisan migrate`

### Access the application

Open your web browser and navigate to `http://localhost:8080`. You should see the Student Management API home page.

### Stopping the Application

To stop the application and shut down the Docker containers, run: `docker-compose down`

### Create new user

To create a new user, use the following Artisan command:

`docker-compose exec app php artisan user:create {username} {email} --password={password}`

Replace {username}, {email}, and {password} with the desired values.

Example:

`docker-compose exec app php artisan user:create john_doe john@example.com --password=secret`

or you can choose to use the interactive prompt. If you run the command without providing arguments, it will prompt you to enter the following details:

-   **Username**: Enter the desired username.
-   **Email**: Enter the email address.
-   **Password**: Enter the password.

Example:
`docker-compose exec app php artisan user:create`

### Run Laravel Lint

-   Use the following command to lint your Laravel code: `composer fix path/to/your/code`

-   To lint the entire application, run: `composer fix`

### Running Tests

To run the test suite for this project, you can use the following command within your Docker container:

`docker-compose exec app php artisan test`

You can also run specific tests by using the --filter option with the above command. This allows you to selectively execute tests based on their names or descriptions. Here are some examples:

#### Running Tests by Class Name:

To run tests from a specific test class, use the class name as the filter:

`docker-compose exec app php artisan test --filter ClassName`

for example :
`docker-compose exec app php artisan test --filter HealthCheck`

#### Running Tests by Test Method

You can also run tests by specifying the test method's name as the filter:

`docker-compose exec app php artisan test --filter testMethodName`

for example :
`docker-compose exec app php artisan test --filter test_health_check_success`

### Contributing

If you would like to contribute to this project, feel free to fork the repository and submit pull requests.

### License

This project is licensed under the MIT License.
