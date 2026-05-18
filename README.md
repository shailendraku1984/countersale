# Laravel 12 + React Ecommerce Application

## Project Overview

This project is a full-stack ecommerce application developed using Laravel 12 API backend and React frontend architecture.

The application was built from a real-world ecommerce workflow perspective with focus on:

* Scalable architecture
* Security best practices
* Maintainability
* Reusability
* Extendability
* RBAC (Role Based Access Control)
* RESTful API development
* Modern frontend integration

The objective of this project was not only feature implementation but also understanding modern software engineering practices and enterprise-level application structure.

---

# Tech Stack

## Backend

* PHP 8+
* Laravel 12
* MySQL
* REST APIs
* RBAC Permission System
* Laravel Validation
* Eloquent ORM
* Middleware Authorization
* File Upload Management

## Frontend

* React
* Vite
* React Router DOM
* Axios
* Tailwind CSS
* React Helmet Async
* DOMPurify

---

# Core Features

## Authentication & Authorization

* User Login
* User Registration
* Protected Routes
* Token Based Authentication
* Role Based Access Control (RBAC)
* Permission Based Modules & Actions

---

# Admin Panel Features

## User Management

* Create User
* Update User
* Delete User
* User Listing

## Role & Permission Management

* Role Creation
* Permission Assignment
* Dynamic Access Control
* Module Action Permissions

## Category Management

* Create Category
* Update Category
* Delete Category

## Product Management

* Product CRUD
* Product Image Upload
* Product Status Management
* Product Listing

## CMS Management

* Dynamic CMS Pages
* SEO Meta Fields
* Slug Based Pages

## Order Management

* Order Listing
* Order Status Management
* Customer Order Tracking

---

# Frontend Features

## Ecommerce Features

* Product Listing
* Product Detail Page
* Add To Cart
* Quantity Management
* Guest Cart Support
* User Cart Support
* Checkout Flow
* Order Placement

## CMS Integration

* Dynamic CMS Routing
* SEO Friendly Pages
* Dynamic Meta Tags
* Sanitized HTML Rendering

---

# Security Considerations

The application was developed with focus on secure coding practices including:

* Request Validation
* RBAC Authorization
* Middleware Protection
* Sanitized CMS Rendering using DOMPurify
* Protected Admin Routes
* Controlled File Upload Handling
* Secure API Structure

---

# Architecture Highlights

* RESTful API architecture
* Headless backend approach
* Reusable React components
* Modular backend structure
* Dynamic CMS implementation
* Service-oriented frontend API integration
* Maintainable folder structure
* Separation of concerns

---

# Folder Structure

## Backend

```text
app/
routes/
database/
resources/
```

## Frontend

```text
resources/js/
├── admin/
├── components/
├── context/
├── layouts/
├── pages/
├── services/
├── routes/
```

---

# Installation Steps

## Backend Setup

### Clone Repository

```bash
git clone <repository-url>
```

### Install Dependencies

```bash
composer install
```

### Environment Setup

```bash
cp .env.example .env
```

### Generate Application Key

```bash
php artisan key:generate
```

### Run Migration

```bash
php artisan migrate
```

### Create Storage Link

```bash
php artisan storage:link
```

### Start Laravel Server

```bash
php artisan serve
```

---

# Frontend Setup

## Install Node Modules

```bash
npm install
```

## Start Vite Development Server

```bash
npm run dev
```

---

# Application Goals

This project was developed as a practical architecture modernization exercise by rebuilding a real-world ecommerce workflow using Laravel 12 and React while focusing on:

* Modern API architecture
* Secure application development
* Scalable frontend/backend separation
* Maintainable code structure
* Enterprise-level RBAC implementation

---

# Future Improvements

* Payment Gateway Integration
* Invoice Generation
* Order Email Notifications
* Queue & Job Processing
* Advanced Product Filters
* Wishlist Module
* Unit & Feature Testing
* API Versioning
* Performance Optimization
* Caching Layer

---

# Learning Outcome

This project significantly improved practical understanding of:

* Laravel API architecture
* React frontend integration
* RBAC implementation
* Secure coding practices
* Modular application structure
* Ecommerce workflow design
* Frontend/backend communication
* CMS driven content rendering

---

# Author

Developed as a self-initiated full-stack ecommerce architecture project using Laravel 12 and React.
