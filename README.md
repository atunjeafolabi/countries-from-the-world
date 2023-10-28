# Countries

## Overview

This solution implements an application which retrieves world countries list with details and displays them on a datatable. The application has a backend built with Laravel which connects to an external countries API while the frontend is built with VueJS.

## Installation:

- Clone the project: `git clone git@github.com:atunjeafolabi/countries-from-the-world.git`

#### Backend

- `cd` into the `backend` directory
- Run `composer install`
- Run local dev server: `php artisan serve`

#### Frontend

- `cd` into the `frontend` directory
- Run `npm install`
- Run local server `npm run dev`

### Folder Structure

    .
    ├── backend
    ├── frontend
    └── .gitignore

## Usage

- Visit `localhost:3000`
- Each table row is clcikable to view the details of an individual country.

### Tech Stack

- PHP 8.2
- Laravel 10
- VueJS
- Typescript

---

### Todo

- Add Tests
- Refactor
