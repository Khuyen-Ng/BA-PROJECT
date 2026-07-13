# ART PRINT STUDIO – Custom Photo Printing E-commerce Website

A web-based e-commerce application that allows customers to order custom photo printing products, customize product options, and preview the final result before placing an order.

---

# Introduction

Many photo printing stores still receive orders through Facebook or Zalo. Customers have to send photos via chat, discuss product size, frame type, printing material, and confirm the design before the store starts printing.

This process causes several problems:

* It takes a lot of time for customers and store owners to communicate.
* Product specifications such as size or configuration can easily be misunderstood.
* Customers cannot preview how the final printed product will look.
* Store owners have difficulty managing orders and tracking their processing status.

**ART PRINT STUDIO** was developed to digitize the entire photo printing process. It allows customers to customize products, preview the final result, and place orders online while helping store owners manage orders more efficiently.

---

# Project Objectives

* Build a complete online photo printing workflow.
* Allow customers to preview products before placing an order.
* Standardize product options such as size, frame type, and printing material.
* Reduce errors during the order process.
* Support order tracking from submission to completion.

---

# Main Features

## Customer

* Register and log in.
* Browse product categories.
* Upload photos for printing.
* Select:

  * Product size
  * Frame type
  * Printing material
  * Quantity
* Preview the product (Live Preview).
* Add products to the shopping cart.
* Place orders.
* Track order status.
* View order history.

## Administrator

* Manage products.
* Manage sizes, frame types, and printing materials.
* Manage customers.
* Manage orders.
* Update order status.
* Manage website content.

---

# System Architecture

The system is built using:

* WordPress
* WooCommerce
* MySQL

It follows:

* Monolithic Architecture
* Layered Architecture

  * Presentation Layer
  * Business Logic Layer
  * Data Layer

---

# Technologies

* WordPress
* WooCommerce
* PHP
* MySQL
* JavaScript
* HTML
* CSS
* Figma
* Draw.io
* Git & GitHub

---

# Knowledge Applied

The following knowledge and techniques were applied during the project:

* Business Analysis
* Requirements Gathering
* Functional Requirements (FR)
* Non-functional Requirements (NFR)
* Use Case Modeling
* Use Case Specification
* UML
* BPMN
* Database Design (ERD)
* UI/UX Design
* E-commerce Website Development
* WordPress & WooCommerce Customization

---

# My Role

**Business Analyst & Developer**

## Business Analysis

* Gathered and analyzed business requirements.
* Defined Functional Requirements and Non-functional Requirements.
* Designed the Use Case Diagram.
* Wrote Use Case Specifications.
* Designed the Sequence Diagram.
* Designed the Entity Relationship Diagram (ERD).
* Created UI designs using Figma.

## System Development

* Assisted in developing the image upload feature.
* Customized the photo printing workflow.
* Supported the implementation of the product preview feature.
* Assisted in developing the order processing workflow.

---

# Repository Structure

```text
docs/
├── diagrams/                     # UML diagrams
├── specifications/               # Use Case, Database, Requirement

src/
└── WordPress + WooCommerce Source Code
```

---

# Installation & Setup

## Prerequisites

Before running the project, make sure the following software is installed:

* PHP >= 8.x
* MySQL
* WordPress
* WooCommerce
* Composer (if custom plugins are used)
* Git
* A web server (Apache or Nginx)

---

## 1. Clone the Repository

```bash
git clone https://github.com/your-username/ArtPrintStudio.git
```

---

## 2. Set Up WordPress

* Install WordPress on your local machine.
* Create a MySQL database.
* Configure the database connection in the `wp-config.php` file.

---

## 3. Install WooCommerce

* Log in to the WordPress Admin Dashboard.
* Install and activate the WooCommerce plugin.
* Complete the initial WooCommerce setup.

---

## 4. Import the Database

If the repository includes a SQL file:

* Create a new database.
* Import the `.sql` file using phpMyAdmin or MySQL Workbench.

---

## 5. Install the Theme and Plugins

Copy the theme to:

```text
wp-content/themes/
```

Copy any custom plugins to:

```text
wp-content/plugins/
```

Then activate the theme and plugins from the WordPress Admin Dashboard.

---

## 6. Access the Website

Example:

```text
http://localhost/art-print-studio
```

---

# Contact

If you have any questions about this project, feel free to connect with me through GitHub or LinkedIn.
