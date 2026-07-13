# INTROWEAR – Fashion E-commerce Website

A web-based e-commerce application developed to provide an online fashion shopping platform, allowing customers to browse, purchase, and manage orders while helping store owners manage their business through a centralized system.

---

# Introduction

The rapid growth of e-commerce marketplaces has helped fashion stores reach more customers. However, many businesses still rely on third-party platforms, making them dependent on platform policies, search algorithms, and service fees. This creates challenges in building their own brand, managing customer data, and maintaining stable business growth.

**INTROWEAR** was developed as an independent fashion e-commerce website that enables store owners to manage products, customers, and orders while providing customers with a convenient online shopping experience—from browsing products to placing orders, making payments, and tracking deliveries.

---

# Project Objectives

* Build an online fashion shopping website.
* Provide a convenient shopping experience for customers.
* Standardize the order placement and order processing workflow.
* Support efficient management of products, customers, and orders.
* Apply Business Analysis, system design, and web application development knowledge.

---

# Main Features

## Customer

* Register and log in.
* Browse products.
* Search and filter products by category.
* View product details.
* Manage the shopping cart.
* Place orders.
* Make payments.
* Track order status.
* View order history.
* Manage personal profile.

## Administrator

* Manage products.
* Manage categories.
* Manage customers.
* Manage orders.
* Update order status.
* View sales reports and revenue statistics.
* Search and filter system data.

---

# System Architecture

The system is built using a **Monolithic Architecture** and follows a **Layered Architecture**, including:

* Presentation Layer
* Business Logic Layer
* Data Layer

The **Laravel** framework is used to implement business logic, manage routing, authentication, ORM (Eloquent), database migrations, and interaction with the MySQL database.

---

# Technologies

* Laravel
* PHP
* MySQL
* HTML
* CSS
* JavaScript
* Bootstrap
* Figma
* Draw.io
* Git & GitHub

---

# Knowledge Applied

The following knowledge and techniques were applied during the project:

* Business Analysis
* Requirements Gathering and Analysis
* Use Case Diagram
* Use Case Specification
* Entity Relationship Diagram (ERD)
* UI/UX Design
* Database Design
* Web Application Development with Laravel
* Git Version Control

---

# My Role

**Business Analyst & Developer**

## Business Analysis

* Gathered and analyzed business requirements.
* Designed the Use Case Diagram.
* Wrote Use Case Specifications.
* Designed the Entity Relationship Diagram (ERD).
* Created UI wireframes and prototypes using Figma.

## System Development

* Developed the order creation feature.
* Developed the order confirmation feature.
* Built the order management module.
* Developed the administration dashboard for order management and sales statistics.

---

# Repository Structure

```text
docs/
├── diagrams/                        # UML diagrams
├── specifications/                  # Use Case, Database

src/
└── Laravel Source Code
```

---

# Installation & Setup

## Prerequisites

Before running the project, make sure the following software is installed:

* PHP >= 8.2
* Composer
* Node.js & npm
* MySQL
* Git

---

## 1. Clone the Repository

```bash
git clone https://github.com/your-username/INTROWEAR.git
cd INTROWEAR
```

---

## 2. Install Dependencies

```bash
composer install
```

```bash
npm install
```

---

## 3. Create the Environment File

For Linux/macOS:

```bash
cp .env.example .env
```

For Windows:

```bash
copy .env.example .env
```

---

## 4. Generate the Application Key

```bash
php artisan key:generate
```

---

## 5. Configure the Database

Update the `.env` file with your database information:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=introwear
DB_USERNAME=root
DB_PASSWORD=your_password
```

---

## 6. Run Database Migrations

```bash
php artisan migrate
```

If sample data is available:

```bash
php artisan migrate --seed
```

---

## 7. Build Frontend Assets

```bash
npm run dev
```

or

```bash
npm run build
```

---

## 8. Run the Application

```bash
php artisan serve
```

The application will be available at:

```
http://127.0.0.1:8000
```

---

# Project Outcomes

The project successfully delivered a complete fashion e-commerce system that supports the entire online shopping process, from product browsing to order management.

Through this project, the team improved skills in business analysis, system modeling, database design, and web application development using Laravel.

---

# Contact

If you have any questions about this project, feel free to connect with me through GitHub or LinkedIn.
