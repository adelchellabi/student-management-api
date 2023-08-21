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

### Run Laravel Lint:

-   Use the following command to lint your Laravel code: `composer fix path/to/your/code`

-   To lint the entire application, run: `composer fix`

### Contributing

If you would like to contribute to this project, feel free to fork the repository and submit pull requests.

### License

This project is licensed under the MIT License.
