# Database Design – INTROWEAR

This document describes the database structure of the INTROWEAR system, including the Entity Relationship Diagram (ERD) and detailed table specifications.

---

## Entity Relationship Diagram (ERD)

```mermaid
erDiagram
    users ||--o{ orders : "places"
    users ||--o{ transactions : "makes"
    orders ||--o{ order_items : "contains"
    orders ||--o{ transactions : "has"
    products ||--o{ order_items : "included in"

    users {
        bigInteger id PK
        string name
        string phone
        string email
        string email_verified_at
        string password
        string utype
        boolean status
        string rememberToken
        timestamp created_at
        timestamp updated_at
        string google_id
    }

    products {
        bigInteger id PK
        string product_name
        string category_id
        string size
        bigInteger price
        bigInteger price_sale
        string description
        integer stock_quantity
        string status_product
        string image
        timestamp created_at
        timestamp updated_at
        string supplier_id
    }

    orders {
        bigInteger id PK
        bigInteger user_id FK
        string name
        string phone
        text address
        string payment_method
        string status
        date delivered_date
        date canceled_date
        timestamp created_at
        timestamp updated_at
        bigInteger total
    }

    order_items {
        bigInteger id PK
        bigInteger product_id FK
        bigInteger order_id FK
        decimal price
        integer quantity
        timestamp created_at
        timestamp updated_at
    }

    transactions {
        bigInteger id PK
        bigInteger user_id FK
        bigInteger order_id FK
        string mode
        timestamp created_at
        timestamp updated_at
    }

    coupons {
        bigInteger id PK
        string coupon_code
        decimal discount_percentage
        string description
        timestamp created_at
        timestamp updated_at
        date start_date
        date end_date
    }
```

---

## Table Specifications

### 1. `users`

| Field | Type | Constraint | Description |
|---|---|---|---|
| id | bigInteger | Primary Key | Auto-increment user ID |
| phone | string | Not null - Unique | User's phone number (unique) |
| name | string | Not null | User's full name |
| email | string | Not null - Unique | User's email address (unique) |
| google_id | string | Unique | Google account ID |
| email_verified_at | timestamp | – | Time when the email address was verified |
| password | string | Not null | User password |
| status | boolean | Default(1) | Account status: 1 (active), 0 (inactive/disabled) |
| utype | string | Default(USR) | User type: USR (customer), ADM (administrator) |
| rememberToken | string | – | Token used for the "Remember Me" feature |
| created_at | timestamp | Not null | Record creation timestamp |
| updated_at | timestamp | Not null | Last update timestamp |

### 2. `products`

| Field | Type | Constraint | Description |
|---|---|---|---|
| id | bigInteger | Primary Key | Unique product ID |
| product_name | string | Not null | Product name |
| category_id | string | Not null | Product category ID |
| size | string | Not null | Product size |
| price | bigInteger | Not null | Original price |
| price_sale | bigInteger | – | Discounted price |
| description | string | Not null | Product description |
| stock_quantity | integer | Not null | Available stock quantity |
| status_product | enum ('In Stock','Out of Stock') | Not null | Product availability status |
| supplier_id | string | – | Supplier ID |
| image | string | Not null | Product image filename |
| created_at | timestamp | Not null | Record creation timestamp |
| updated_at | timestamp | Not null | Last update timestamp |

### 3. `orders`

| Field | Type | Constraint | Description |
|---|---|---|---|
| id | bigInteger | Primary Key | Unique order ID |
| user_id | bigInteger | Foreign Key | Reference to the user who placed the order |
| total | bigInteger | Not null | Total order amount |
| name | string | Not null | Recipient's name |
| phone | string | Not null | Recipient's phone number |
| address | text | Not null | Shipping address |
| payment_method | enum('cod','card','paypal') | Not null | Payment method |
| status | enum('ordered','delivered','canceled') | Default('ordered') | Order status |
| delivered_date | date | – | Delivery date (if delivered) |
| canceled_date | date | – | Cancellation date (if canceled) |
| created_at | timestamp | Not null | Record creation timestamp |
| updated_at | timestamp | Not null | Last update timestamp |

### 4. `order_items`

| Field | Type | Constraint | Description |
|---|---|---|---|
| id | bigInteger | Primary Key | Unique order item ID |
| product_id | bigInteger | Foreign Key | Reference to the product |
| order_id | bigInteger | Foreign Key | Reference to the order |
| price | decimal | Not null | Product price at the time of purchase |
| quantity | integer | Not null | Quantity ordered |
| created_at | timestamp | Not null | Record creation timestamp |
| updated_at | timestamp | Not null | Last update timestamp |

### 5. `transactions`

| Field | Type | Constraint | Description |
|---|---|---|---|
| id | bigInteger | Primary Key | Unique transaction ID |
| user_id | bigInteger | Foreign Key | Reference to the user who made the transaction |
| order_id | bigInteger | Foreign Key | Reference to the related order |
| mode | enum('cod','card','paypal') | Not null | Payment method |
| created_at | timestamp | Not null | Record creation timestamp |
| updated_at | timestamp | Not null | Last update timestamp |

### 6. `coupons`

| Field | Type | Constraint | Description |
|---|---|---|---|
| id | bigInteger | Primary Key | Unique coupon ID |
| coupon_code | string | Not null | Coupon code |
| discount_percentage | decimal(5,2) | – | Discount percentage |
| start_date | date | Not null | Start date |
| end_date | date | Not null | Expiration date |
| description | string | Not null | Coupon description |
| created_at | timestamp | Not null | Record creation timestamp |
| updated_at | timestamp | Not null | Last update timestamp |

---

## Table Relationships

- One **user** can place multiple **orders** (1-to-many).
- One **order** can contain multiple **order_items** (1-to-many).
- One **product** can appear in multiple **order_items** (1-to-many).
- One **order** can have multiple **transactions** (1-to-many).
- One **user** can make multiple **transactions** (1-to-many).
