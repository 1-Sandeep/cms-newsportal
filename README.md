<h1 align="center"> CMS - NewsPortal </h1>
Welcome to the News Portal Project! This project is a CMS specifically designed for managing a news portal site. The backend is powered by Laravel and the AdminLTE dashboard template, while the frontend utilizes the MAGNEWS news template for a modern and responsive design.

## Table of Contents

-   [Features](#features)
-   [Technologies Used](#technologies-used)
-   [Installation](#installation)
-   [Usage](#usage)
-   [Modules](#modules)
    -   [Posts](#posts)
    -   [Authors](#authors)
    -   [Categories](#categories)
    -   [Tags](#tags)
-   [Authentication and Authorization](#authentication-and-authorization)
-   [Interactive UI Elements](#interactive-ui-elements)

## Features

-   Add, update, delete, and manage posts, authors, categories, and tags.
-   Assign multiple authors, categories, and tags to posts.
-   Move posts, authors, and categories to the trash.
-   Items in the trash and unpublished items are not visible on the frontend.
-   Prevent deletion of authors and categories that have assigned posts.

<strong>To be added</strong>
-    User Module, Roles and Permission Module
-    Static page module
-    Dynamic Footer Content

## Technologies Used

-   **Backend**: Laravel
-   **Frontend**: MAGNEWS template
-   **Admin Dashboard**: AdminLTE template
-   **Authentication**: Laravel Bootstrap UI
-   **Forms**: Laravel Collective HTML package
-   **Alert Messages**: SweetAlert
-   **Select Option**: Select2 JavaScript library

## Installation

1. **Clone the repository:**

    ```bash
    git clone https://github.com/yourusername/news-portal.git
    cd news-portal
    ```

2. **Install dependencies:**

    ```bash
    composer install
    npm install
    npm run dev
    ```

3. **Set up environment variables:**

    Copy `.env.example` to `.env` and update your database and other configurations.

4. **Run migrations:**

    ```bash
    php artisan migrate
    ```

5. **Seed the database (optional):**

    ```bash
    php artisan db:seed
    ```

6. **Start the development server:**

    ```bash
    php artisan serve
    ```

## Usage

After setting up the project, you can access the backend dashboard at `/admin` and the frontend at the root URL of your application.

## Modules

### Posts

-   **CRUD Operations**: Create, Read, Update, and Delete posts.
-   **Assign Multiple Authors, Categories, and Tags**: Enhance the versatility of your posts by assigning multiple authors, categories, and tags.

### Authors

-   **CRUD Operations**: Manage author profiles with ease.
-   **Restrictions**: Authors with assigned posts cannot be deleted.

### Categories

-   **CRUD Operations**: Create and manage news categories.
-   **Restrictions**: Categories with assigned posts cannot be deleted.

### Tags

-   **CRUD Operations**: Create and manage tags for your posts.

## Authentication and Authorization

-   **User Authentication**: Handled by Laravel Bootstrap UI.
-   **Authorization**: Gates and policies will be used to authorize user's actions within the site.

## Interactive UI Elements

-   **Forms**: Managed using Laravel Collective HTML package for easy and efficient form handling.
-   **Alert Messages**: SweetAlert is used for attractive and user-friendly alert messages.
-   **Select Option**: Select2 JavaScript library is used for interactive and searchable select options.

---

Thank you for using the News Portal Project! If you encounter any issues or have any questions, please feel free to open an issue on the GitHub repository.

---

**Maintained by:** [iamsandeep](https://github.com/1-Sandeep)
