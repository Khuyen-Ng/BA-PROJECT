# Use Case Specifications — Introwear E-Commerce System

> Each use case follows a standard specification template: **ID, Name (Verb + Noun), Actor(s), Description (user story format), Priority, Trigger, Preconditions, Postconditions (Success/Failure), Basic Flow, Alternative Flow, Exception Flow, Business Rules.** Flows use the common numbering convention: Basic Flow = `1, 2, 3…`; each Alternative/Exception Flow is labeled `A1, A2…` / `E1, E2…` with sub-steps `A1.1, A1.2…` / `E1.1, E1.2…`, and each branch states where it splits from and rejoins the Basic Flow.

## Table of Contents

| # | ID | Use Case Name |
|---|----|----------------|
| 1 | UC-01 | Register Account |
| 2 | UC-02 | Log In to System |
| 3 | UC-03 | Log Out of System |
| 4 | UC-04 | View Product List |
| 5 | UC-05 | View Product Details |
| 6 | UC-06 | Search Product |
| 7 | UC-07 | Filter Product List |
| 8 | UC-08 | Add Product to Cart |
| 9 | UC-09 | Update Cart Quantity |
| 10 | UC-10 | Remove Cart Item |
| 11 | UC-11 | Apply Coupon Code |
| 12 | UC-12 | Process Online Payment |
| 13 | UC-13 | View Order Confirmation |
| 14 | UC-14 | Update Account Information |
| 15 | UC-15 | Assign User Role |
| 16 | UC-16 | Check User Role |
| 17 | UC-17 | Add Product |
| 18 | UC-18 | Update or Delete Product |
| 19 | UC-19 | Search Order |
| 20 | UC-20 | View Order Details |
| 21 | UC-21 | Create Coupon Code |
| 22 | UC-22 | View Statistics Dashboard |

---

## UC-01: Register Account

| Field | Content |
|---|---|
| **Use Case ID** | UC-01 |
| **Use Case Name** | Register Account |
| **Actor(s)** | User, System Administrator |
| **Description** | As a **user**, I want to **create a new account** so that **I can log in and use the personalized features of the website**. |
| **Priority** | High |
| **Trigger** | The user clicks the "Sign Up" button. |
| **Preconditions** | PRE-1: The email address has not been previously registered in the system. |
| **Postconditions (Success)** | POST-1: The account is created and saved in the system; the user is redirected to the login page. |
| **Postconditions (Failure)** | The system state is unchanged; no account is created. |
| **Basic Flow** | 1. The user selects "Sign Up" on the screen.<br>2. The system displays the registration page.<br>3. The user enters: name, email, phone number, password, and password confirmation.<br>4. The user confirms the registration information.<br>5. The system validates that all fields are filled in and that the password is at least 8 characters and matches the confirmation.<br>6. The system creates the account and saves it.<br>7. The user is redirected to the login page. |
| **Alternative Flow** | **A1** (branches from step 1) — Register via Google/Facebook:<br>A1.1 The user selects "Sign up with Google" or "Sign up with Facebook."<br>A1.2 The system redirects to the third-party authentication interface.<br>A1.3 After successful authentication, the system saves the account and logs the user in automatically.<br>A1.4 The user can use the system. *(Use case ends)* |
| **Exception Flow** | **E1** (branches from step 5) — Email already exists: displays "The email has already been taken." → returns to step 3.<br>**E2** (branches from step 5) — Phone already exists: displays "The phone has already been taken." → returns to step 3.<br>**E3** (branches from step 5) — Password under 8 characters: displays "The password field must be at least 8 characters." → returns to step 3.<br>**E4** (branches from step 5) — Password confirmation mismatch: displays "The password field confirmation does not match." → returns to step 3.<br>**E5** (branches from step 3) — User exits the registration page: the system cancels the process and discards the entered data. *(Use case ends)* |
| **Business Rules** | BR-1: Email and phone number must be unique across all accounts.<br>BR-2: Password must be ≥ 8 characters. |

---

## UC-02: Log In to System

| Field | Content |
|---|---|
| **Use Case ID** | UC-02 |
| **Use Case Name** | Log In to System |
| **Actor(s)** | User, System Administrator |
| **Description** | As a **registered user**, I want to **log in with my email and password** so that **I can access personalized features of the system**. |
| **Priority** | High |
| **Trigger** | The user clicks the "Log In" button. |
| **Preconditions** | PRE-1: The user already has a valid account in the system. |
| **Postconditions (Success)** | POST-1: The user is authenticated and redirected to the homepage in a logged-in state. |
| **Postconditions (Failure)** | The user remains unauthenticated; login state is unchanged. |
| **Basic Flow** | 1. The user clicks "Log In."<br>2. The system displays the login page.<br>3. The user enters email and password.<br>4. The user confirms the login.<br>5. The system validates the credentials.<br>6. The system logs the user in and redirects to the homepage.<br>7. The user accesses logged-in features. |
| **Alternative Flow** | **A1** (branches from step 2) — Log in via Google/Facebook:<br>A1.1 The user selects "Log in with Google" or "Log in with Facebook."<br>A1.2 The system redirects to the third-party authentication interface.<br>A1.3 After successful authentication, the system logs the user in and redirects to the homepage. *(Rejoins at step 6)* |
| **Exception Flow** | **E1** (branches from step 5) — Incorrect credentials: displays "These credentials do not match our records." → returns to step 3.<br>**E2** (branches from step 4) — Required field left empty: displays a message requesting email/phone and password. → returns to step 3.<br>**E3** (branches from step 2) — User leaves the login page: the system cancels the login process without altering login state. *(Use case ends)* |
| **Business Rules** | BR-1: Account must be locked or throttled after repeated failed login attempts (recommended). |

---

## UC-03: Log Out of System

| Field | Content |
|---|---|
| **Use Case ID** | UC-03 |
| **Use Case Name** | Log Out of System |
| **Actor(s)** | User, System Administrator |
| **Description** | As a **logged-in user**, I want to **log out of my account** so that **my session is closed and my account stays secure on shared devices**. |
| **Priority** | Medium |
| **Trigger** | The user clicks the "Logout" button. |
| **Preconditions** | PRE-1: The user is currently logged in. |
| **Postconditions (Success)** | POST-1: The session is terminated; the user is redirected to the homepage in a guest state. |
| **Postconditions (Failure)** | The user remains logged in. |
| **Basic Flow** | 1. The logged-in user clicks the user icon (top-right corner).<br>2. The system navigates to "My Account."<br>3. The user clicks "Logout."<br>4. The system clears the session.<br>5. The system redirects to the homepage; the user's status becomes guest. |
| **Alternative Flow** | **A1** (branches from step 1) — Logout directly from the account dropdown menu without opening "My Account": the user selects "Logout" from the dropdown. *(Rejoins at step 4)* |
| **Exception Flow** | **E1** (branches from step 2) — The user returns to the homepage without clicking "Logout": the login state remains unchanged. *(Use case ends)* |
| **Business Rules** | BR-1: All session tokens/cookies must be invalidated upon logout. |

---

## UC-04: View Product List

| Field | Content |
|---|---|
| **Use Case ID** | UC-04 |
| **Use Case Name** | View Product List |
| **Actor(s)** | User |
| **Description** | As a **user**, I want to **view the list of all available products** so that **I can browse and choose items to purchase**. |
| **Priority** | High |
| **Trigger** | The user clicks "SHOP" on the navigation bar. |
| **Preconditions** | PRE-1: At least one product has been posted by an administrator. |
| **Postconditions (Success)** | POST-1: The product list is displayed on the "Shop" page. |
| **Postconditions (Failure)** | No product list is displayed; an error or empty state is shown. |
| **Basic Flow** | 1. The user accesses the website.<br>2. The user clicks "Shop" on the navigation bar.<br>3. The system retrieves all products from the database.<br>4. The system displays the product list: name, image, price, "View Details," and "Add to Cart." |
| **Alternative Flow** | **A1** (branches from step 1) — User reaches the product list via a category banner or promotional link on the homepage instead of the "Shop" nav link. *(Rejoins at step 3)* |
| **Exception Flow** | **E1** (branches from step 3) — No products available: the system displays a blank page.<br>**E2** (branches from step 3) — Database connection error: displays "Unable to load product, please try again." |
| **Business Rules** | BR-1: Only products marked as active/in-stock or available for sale are shown. |

---

## UC-05: View Product Details

| Field | Content |
|---|---|
| **Use Case ID** | UC-05 |
| **Use Case Name** | View Product Details |
| **Actor(s)** | User |
| **Description** | As a **user**, I want to **view the detailed information of a specific product** so that **I can decide whether to purchase it**. |
| **Priority** | High |
| **Trigger** | The user clicks "Quick View" on a product in the list. |
| **Preconditions** | PRE-1: The product list has already been displayed. |
| **Postconditions (Success)** | POST-1: The product detail page is displayed with full information. |
| **Postconditions (Failure)** | The product detail page is not shown; an error message is displayed. |
| **Basic Flow** | 1. The user is on the product list page.<br>2. The user clicks "Quick View" for a product.<br>3. The system navigates to the "Product Detail" page.<br>4. The system displays: name, images, price, quantity selector, "Add to Cart," "Buy Now," description, size, shipping policy, return policy. |
| **Alternative Flow** | **A1** (branches from step 2) — User opens the product detail page directly via a shared link or search result instead of clicking "Quick View." *(Rejoins at step 3)* |
| **Exception Flow** | **E1** (branches from step 3) — Product no longer exists (deleted): displays a message stating the product does not exist.<br>**E2** (branches from step 3) — Database connection error: displays "Unable to load product, please try again." |
| **Business Rules** | BR-1: Deleted or out-of-stock products must not be accessible via direct link. |

---

## UC-06: Search Product

| Field | Content |
|---|---|
| **Use Case ID** | UC-06 |
| **Use Case Name** | Search Product |
| **Actor(s)** | User |
| **Description** | As a **user**, I want to **search for a product by name or keyword** so that **I can quickly find the item I am looking for**. |
| **Priority** | High |
| **Trigger** | The user enters a keyword in the search box and clicks "Search." |
| **Preconditions** | PRE-1: The system has at least one product in the database. |
| **Postconditions (Success)** | POST-1: The list of matching products is displayed. |
| **Postconditions (Failure)** | No results are displayed. |
| **Basic Flow** | 1. The user accesses the "Search" box on the navigation bar.<br>2. The user enters a product name or keyword.<br>3. The system queries products by name.<br>4. The system displays the list of matching products.<br>5. The user clicks a product to view its details. |
| **Alternative Flow** | **A1** (branches from step 2) — Auto-suggestion while typing:<br>A1.1 As the user types each character, the system displays products whose names start with or contain the keyword.<br>A1.2 The user selects a suggested product directly to go to its detail page. *(Use case ends)* |
| **Exception Flow** | **E1** (branches from step 3) — No matching product found: the system displays no results.<br>**E2** (branches from step 3) — Database connection error: displays "Unable to load product, please try again." |
| **Business Rules** | BR-1: Search should be case-insensitive and accent-insensitive (for Vietnamese product names). |

---

## UC-07: Filter Product List

| Field | Content |
|---|---|
| **Use Case ID** | UC-07 |
| **Use Case Name** | Filter Product List |
| **Actor(s)** | User |
| **Description** | As a **user**, I want to **sort or filter the product list** (best-selling, price, newest) so that **I can find products that match my preferences more easily**. |
| **Priority** | Medium |
| **Trigger** | The user selects an option on the filter/sort bar on the product list page. |
| **Preconditions** | PRE-1: The product list has already been fully displayed. |
| **Postconditions (Success)** | POST-1: The product list is refreshed according to the selected criteria. |
| **Postconditions (Failure)** | The product list remains unchanged. |
| **Basic Flow** | 1. The user accesses the product list page.<br>2. The system displays the product list and the filter/sort bar.<br>3. The user selects a sorting criterion: best-selling / price low-to-high / price high-to-low / newest.<br>4. The system refreshes the product list according to the selected criterion.<br>5. The user views the updated product list. |
| **Alternative Flow** | **A1** (branches from step 3) — User changes filter criteria repeatedly: the system updates the list immediately after each change and returns to step 3. |
| **Exception Flow** | **E1** (branches from step 4) — No matching products after filtering: the system displays a blank page.<br>**E2** (branches from step 4) — Database connection error: displays "Unable to load product, please try again." |
| **Business Rules** | BR-1: "Best-selling" ranking is based on total units sold across delivered orders. |

---

## UC-08: Add Product to Cart

| Field | Content |
|---|---|
| **Use Case ID** | UC-08 |
| **Use Case Name** | Add Product to Cart |
| **Actor(s)** | User |
| **Description** | As a **user**, I want to **add a product to my shopping cart** so that **I can purchase it later at checkout**. |
| **Priority** | High |
| **Trigger** | The user clicks "Add to Cart" (product list) or "Add to Cart"/"Buy Now" (product detail). |
| **Preconditions** | PRE-1: The product is in stock.<br>PRE-2: The user has selected quantity and, if applicable, size/color. |
| **Postconditions (Success)** | POST-1: The product is added to the cart, and the cart is updated. |
| **Postconditions (Failure)** | The cart remains unchanged. |
| **Basic Flow** | 1. The user is on the product list page or the product detail page.<br>2. The user selects quantity and options (color, size) if on the detail page.<br>3. The user clicks "Add to Cart."<br>4. The system validates stock and required options.<br>5. The system adds the product to the cart.<br>6. The system displays the notification "Added to cart." |
| **Alternative Flow** | **A1** (branches from step 3) — Add via "Buy Now" on the detail page: the system adds the product to the cart and proceeds directly to the checkout page. *(Use case ends)*<br>**A2** (branches from step 5) — Product already in the cart: the system increases the existing line item's quantity instead of creating a new one. → resumes at step 6. |
| **Exception Flow** | **E1** (branches from step 4) — Product out of stock: the system displays an out-of-stock notification.<br>**E2** (branches from step 4) — Required options not selected: the system requests the user to complete the product options.<br>**E3** (branches from step 5) — Error adding to cart: the system displays a message stating the product could not be added; please try again. |
| **Business Rules** | BR-1: Cart quantity for a product cannot exceed available stock. |

---

## UC-09: Update Cart Quantity

| Field | Content |
|---|---|
| **Use Case ID** | UC-09 |
| **Use Case Name** | Update Cart Quantity |
| **Actor(s)** | User |
| **Description** | As a **user**, I want to **increase or decrease the quantity of a product in my cart** so that **my order reflects the amount I actually want to buy**. |
| **Priority** | High |
| **Trigger** | The user interacts with the "Quantity" column on the cart page. |
| **Preconditions** | PRE-1: The cart contains at least one product. |
| **Postconditions (Success)** | POST-1: The quantity is updated, and the subtotal/total are recalculated and displayed. |
| **Postconditions (Failure)** | The quantity remains unchanged. |
| **Basic Flow** | 1. The user accesses the cart page.<br>2. The user clicks "+" / "–" or enters a quantity in the "Quantity" column.<br>3. The system validates the new quantity against available stock.<br>4. The system updates the quantity.<br>5. The system recalculates each item's subtotal and the cart's total.<br>6. The user clicks "Proceed to Checkout" and is navigated to the checkout page. |
| **Alternative Flow** | **A1** (branches from step 2) — Decreasing quantity to 1 and clicking "–" again: the system removes the product from the cart. *(Continues at UC-10)* |
| **Exception Flow** | **E1** (branches from step 3) — Quantity exceeds available stock: the system notifies the user that the requested quantity exceeds stock. → returns to step 2.<br>**E2** (branches from step 3) — Quantity entered or set to a negative number: the system does not allow the change and retains the previous quantity. → returns to step 2. |
| **Business Rules** | BR-1: Minimum allowed quantity per item is 1 (below that, the item is removed, see UC-10). |

---

## UC-10: Remove Cart Item

| Field | Content |
|---|---|
| **Use Case ID** | UC-10 |
| **Use Case Name** | Remove Cart Item |
| **Actor(s)** | User |
| **Description** | As a **user**, I want to **remove a product from my cart** so that **I only pay for items I intend to purchase**. |
| **Priority** | Medium |
| **Trigger** | The user clicks the "X" button on a product row in the cart. |
| **Preconditions** | PRE-1: The cart contains at least one product. |
| **Postconditions (Success)** | POST-1: The product is removed from the cart, and the total is recalculated. |
| **Postconditions (Failure)** | The product remains in the cart. |
| **Basic Flow** | 1. The user accesses the cart page.<br>2. The user clicks "X" on a product row.<br>3. The system removes the product from the cart.<br>4. The system recalculates the total and displays "Product removed from cart!" |
| **Alternative Flow** | **A1** (branches from step 2) — User decreases the item's quantity below 1 instead of clicking "X" (see UC-09), which also removes it. *(Rejoins at step 3)* |
| **Exception Flow** | **E1** (branches from step 3) — Cart is empty after removal: the system displays "Your cart is currently empty. Add products to your cart to start shopping!" |
| **Business Rules** | BR-1: Removing the last remaining item empties the cart entirely and resets the cart total to 0. |

---

## UC-11: Apply Coupon Code

| Field | Content |
|---|---|
| **Use Case ID** | UC-11 |
| **Use Case Name** | Apply Coupon Code |
| **Actor(s)** | User |
| **Description** | As a **user**, I want to **apply a discount coupon code at checkout** so that **I can reduce my total payment amount**. |
| **Priority** | Medium |
| **Trigger** | The user enters a code in "Coupon code" and clicks "Apply Coupon." |
| **Preconditions** | PRE-1: The user is on the checkout page with items in the cart.<br>PRE-2: The system has valid coupon codes configured.<br>PRE-3: The coupon code is valid and correctly formatted. |
| **Postconditions (Success)** | POST-1: The coupon is applied, and the total payment amount is updated. |
| **Postconditions (Failure)** | No discount is applied; the total remains unchanged. |
| **Basic Flow** | 1. The user accesses the checkout page.<br>2. The user enters a discount code in "Coupon code."<br>3. The user clicks "Apply Coupon."<br>4. The system validates the code (validity period, format).<br>5. The system applies the discount and updates the total.<br>6. The system displays "Coupon 'xxx' applied!" |
| **Alternative Flow** | **A1** (branches from step 2) — User enters a different code: the system allows the code to be changed and updates the discount accordingly if the new code is valid and active. → returns to step 3. |
| **Exception Flow** | **E1** (branches from step 4) — Invalid or expired code: the system does not apply the code and displays no discount. |
| **Business Rules** | BR-1: Only one coupon code may be applied per order.<br>BR-2: A coupon is valid only within its configured start/end date range. |

---

## UC-12: Process Online Payment

| Field | Content |
|---|---|
| **Use Case ID** | UC-12 |
| **Use Case Name** | Process Online Payment |
| **Actor(s)** | User |
| **Description** | As a **user**, I want to **choose a payment method and complete my order** so that **I can finish my purchase and receive my products**. |
| **Priority** | High |
| **Trigger** | The user clicks "Place Order" on the Checkout page after selecting a payment method. |
| **Preconditions** | PRE-1: Shipping information has been fully entered.<br>PRE-2: The cart is not empty.<br>PRE-3: An internet connection is available for the payment API (if applicable). |
| **Postconditions (Success)** | POST-1: The order is confirmed, or the user is redirected to the VNPAY payment gateway and the order is confirmed after successful payment. |
| **Postconditions (Failure)** | The order remains unconfirmed/unpaid. |
| **Basic Flow** | 1. The user accesses the "Checkout" page.<br>2. The user enters shipping information: name, address, phone number.<br>3. The user selects a payment method: Credit Card / Cash on Delivery / VNPAY.<br>4. The user clicks "Place Order."<br>5. The system processes the order per the selected method and, for Credit Card/Cash on Delivery, confirms the order immediately.<br>6. The system redirects the user to the Order Confirmation page, displaying "Your order is completed!" |
| **Alternative Flow** | **A1** (branches from step 3, when VNPAY is selected) — Pay via VNPAY:<br>A1.1 The system creates a temporary order.<br>A1.2 The user is redirected to the VNPAY payment gateway.<br>A1.3 After successful payment, the user is redirected back to the Order Confirmation page. *(Rejoins at step 6)*<br>**A2** (branches from step 3) — User changes the payment method before placing the order: the system re-displays the applicable fees and payment information. → returns to step 3.<br>**A3** (branches from A1.2) — User navigates back after entering the VNPAY page: the system retains the temporary order to continue processing once the VNPAY callback is received. |
| **Exception Flow** | **E1** (branches from A1.2) — VNPAY payment fails or is canceled: the system displays a payment failure notification.<br>**E2** (branches from step 4) — No payment method selected: the system prompts the user to select one. → returns to step 3.<br>**E3** (branches from A1.2) — VNPAY connection error (timeout/API failure): the system displays a message stating it could not connect to the payment gateway. |
| **Business Rules** | BR-1: An order must not be finalized as "completed" until payment is confirmed (for VNPAY) or the method guarantees payment (Cash on Delivery). |

---

## UC-13: View Order Confirmation

| Field | Content |
|---|---|
| **Use Case ID** | UC-13 |
| **Use Case Name** | View Order Confirmation |
| **Actor(s)** | User |
| **Description** | As a **user**, I want to **see a confirmation of my completed order** so that **I know my purchase was successful and can review its details**. |
| **Priority** | Medium |
| **Trigger** | The system automatically redirects the user after a successful order (any payment method). |
| **Preconditions** | PRE-1: The order has been successfully created in the system. |
| **Postconditions (Success)** | POST-1: The order confirmation page displays complete order details. |
| **Postconditions (Failure)** | The confirmation page fails to load. |
| **Basic Flow** | 1. The user completes the order placement (UC-12).<br>2. The system redirects the user to the Order Confirmation page.<br>3. The system displays the success message and order details: product name and quantity, shipping fee, and total. |
| **Alternative Flow** | **A1** (branches from step 2) — User revisits the confirmation page later via a link in the order-confirmation email instead of the automatic redirect. *(Rejoins at step 3)* |
| **Exception Flow** | **E1** (branches from step 2) — Error displaying the confirmation page (timeout or lost session): the system displays a message stating the page could not be loaded.<br>**E2** (branches from step 2) — Order not found in the database: the system displays a message stating the order information could not be found. |
| **Business Rules** | BR-1: The details shown on the confirmation page must exactly match the amounts and items recorded for the order at checkout. |

---

## UC-14: Update Account Information

| Field | Content |
|---|---|
| **Use Case ID** | UC-14 |
| **Use Case Name** | Update Account Information |
| **Actor(s)** | User |
| **Description** | As a **logged-in user**, I want to **view and edit my personal information or password** so that **my account details stay accurate and secure**. |
| **Priority** | Medium |
| **Trigger** | The user clicks the user icon (top-right corner). |
| **Preconditions** | PRE-1: The user has successfully logged in. |
| **Postconditions (Success)** | POST-1: The information is updated and saved to the database. |
| **Postconditions (Failure)** | The account information remains unchanged. |
| **Basic Flow** | 1. The user clicks the user icon (top-right corner).<br>2. The system navigates to "My Account," displaying full name, phone number, email, and password-change option.<br>3. The user edits the desired information.<br>4. The user clicks "Save Changes."<br>5. The system validates the input (including current password verification if changing password).<br>6. The system saves the data.<br>7. The system displays "Information updated successfully!" |
| **Alternative Flow** | **A1** (branches from step 3) — User cancels the edit before saving: the system discards the changes and keeps the previous account information. *(Use case ends)* |
| **Exception Flow** | **E1** (branches from step 5) — Password confirmation mismatch: displays "The password field confirmation does not match." → returns to step 3.<br>**E2** (branches from step 5) — Required information left blank: the system retains the previous information unchanged. → returns to step 3. |
| **Business Rules** | BR-1: Changing the password requires re-entering and verifying the current password. |

---

## UC-15: Assign User Role

| Field | Content |
|---|---|
| **Use Case ID** | UC-15 |
| **Use Case Name** | Assign User Role |
| **Actor(s)** | System Administrator |
| **Description** | As an **administrator**, I want to **assign an access role (Admin/User) to an account** so that **each account only has access to the functions appropriate to its role**. |
| **Priority** | High |
| **Trigger** | The admin accesses the database after a user account has been created. |
| **Preconditions** | PRE-1: The user account has already been registered.<br>PRE-2: The admin has access to phpMyAdmin and the database. |
| **Postconditions (Success)** | POST-1: The account's role is successfully updated in the system. |
| **Postconditions (Failure)** | The account's role remains unchanged or invalid. |
| **Basic Flow** | 1. The admin logs into phpMyAdmin.<br>2. The admin accesses the "Introwear" database.<br>3. The admin opens the "Users" table.<br>4. The admin locates the target account.<br>5. The admin sets the "Utype" column to `ADM` (Administrator) or `USR` (regular User).<br>6. The system confirms "1 row affected." |
| **Alternative Flow** | **A1** (branches from step 1) — Create and assign a role directly via SQL: `INSERT INTO users (...) VALUES (..., 'ADM', ...);` or `INSERT INTO users (...) VALUES (..., 'USR', ...);`. *(Rejoins at step 6)* |
| **Exception Flow** | **E1** (branches from step 5) — Incorrect "Utype" value entered: the system does not recognize the role, and the account cannot log in.<br>**E2** (branches from step 6) — Role updated but the user has not re-logged in: the system automatically logs the user out and redirects to the login page. |
| **Business Rules** | BR-1: "Utype" must be restricted to the enumerated values `ADM` and `USR` only. |

---

## UC-16: Check User Role

| Field | Content |
|---|---|
| **Use Case ID** | UC-16 |
| **Use Case Name** | Check User Role |
| **Actor(s)** | System Administrator |
| **Description** | As an **administrator**, I want to **check the current access role of an account** so that **I can confirm it has the correct permissions**. |
| **Priority** | Low |
| **Trigger** | The admin wants to determine the current role of an account. |
| **Preconditions** | PRE-1: The account already exists in the system.<br>PRE-2: The admin has access to phpMyAdmin and the database. |
| **Postconditions (Success)** | POST-1: The system displays the account's current role (`ADM`/`USR`). |
| **Postconditions (Failure)** | The role cannot be determined. |
| **Basic Flow** | 1. The admin logs into phpMyAdmin.<br>2. The admin accesses the "Introwear" database.<br>3. The admin opens the "Users" table.<br>4. The admin locates the account to check.<br>5. The admin inspects the "Utype" column value (`ADM` or `USR`). |
| **Alternative Flow** | **A1** (branches from step 3) — Filter the list by role using phpMyAdmin's filter or an SQL query, e.g. `SELECT * FROM users WHERE utype = 'ADM';` or `... = 'USR';`. *(Rejoins at step 5)* |
| **Exception Flow** | **E1** (branches from step 3) — No accounts in the "Users" table: the system displays no results.<br>**E2** (branches from step 5) — "Utype" column has an invalid or empty value: the role cannot be determined. |
| **Business Rules** | BR-1: Only administrators with database access may view or verify another account's role. |

---

## UC-17: Add Product

| Field | Content |
|---|---|
| **Use Case ID** | UC-17 |
| **Use Case Name** | Add Product |
| **Actor(s)** | System Administrator |
| **Description** | As an **administrator**, I want to **add a new product to the catalog** so that **customers can view and purchase it on the website**. |
| **Priority** | High |
| **Trigger** | The admin accesses the "Add Product" page from the admin dashboard or from "Manage Product." |
| **Preconditions** | PRE-1: The Admin account is logged in.<br>PRE-2: The admin has access to the Add Product page. |
| **Postconditions (Success)** | POST-1: The new product is saved to the database and appears in "Manage Product." |
| **Postconditions (Failure)** | The product is not created. |
| **Basic Flow** | 1. The admin logs in and clicks the user icon (top-right corner).<br>2. The system navigates to the admin dashboard.<br>3. The admin clicks "Add Product" in the left navigation.<br>4. The system displays the Add Product page.<br>5. The admin enters: product name, category, supplier, size, color, description, original price, discounted price, stock quantity, and main image (uploaded from the local device).<br>6. The admin clicks "Submit."<br>7. The system validates the input and saves the product.<br>8. The system displays "Product added successfully!" and redirects to "Manage Product." |
| **Alternative Flow** | **A1** (branches from step 1) — Start from the Manage Product page: A1.1 The admin accesses Manage Product. A1.2 The admin clicks "Add Product." *(Rejoins at step 4)* |
| **Exception Flow** | **E1** (branches from step 7) — Required field left blank: the system requests complete product information. → returns to step 5.<br>**E2** (branches from step 7) — Invalid image format or file size exceeded: the system displays an error and blocks submission. → returns to step 5.<br>**E3** (branches from step 7) — Server or database error: the system displays a message stating the product could not be added; please try again later. |
| **Business Rules** | BR-1: Product name and SKU/category combination should be unique where applicable.<br>BR-2: Discounted price must not exceed the original price. |

---

## UC-18: Update or Delete Product

| Field | Content |
|---|---|
| **Use Case ID** | UC-18 |
| **Use Case Name** | Update or Delete Product |
| **Actor(s)** | System Administrator |
| **Description** | As an **administrator**, I want to **edit a product's information or remove it from the catalog** so that **the product listing stays accurate and up to date**. |
| **Priority** | High |
| **Trigger** | The admin clicks the "Edit" or "Delete" icon in the "Action" column on the Manage Product page. |
| **Preconditions** | PRE-1: The admin is logged in.<br>PRE-2: At least one product exists in the system. |
| **Postconditions (Success)** | POST-1: The product is updated or deleted, and the list is refreshed. |
| **Postconditions (Failure)** | The product remains unchanged. |
| **Basic Flow** | *(Delete)*<br>1. The admin accesses Manage Product.<br>2. The admin clicks "Delete" in the "Action" column of a product row.<br>3. The admin confirms the deletion.<br>4. The system deletes the product from the database and refreshes the list.<br>5. The system displays "Product deleted successfully!" |
| **Alternative Flow** | **A1** (branches from step 2) — Edit product instead of delete:<br>A1.1 The admin clicks "Edit" on a product row.<br>A1.2 The system navigates to the Update Product page.<br>A1.3 The admin edits: name, description, prices, category, color, size, stock quantity, main image, status (in stock/out of stock).<br>A1.4 The admin clicks "Save Changes."<br>A1.5 The system updates the database and redirects to Manage Product, displaying "Product updated successfully!" *(Use case ends)* |
| **Exception Flow** | **E1** (branches from step 4) — Deletion unsuccessful (database connection error): the system displays a message stating the product could not be deleted.<br>**E2** (branches from A1.4) — New image upload fails: the system displays a message stating the file format is invalid or the image could not be uploaded. → returns to A1.3. |
| **Business Rules** | BR-1: A product that has existing (historical) orders should be soft-deleted (deactivated) rather than hard-deleted, to preserve order history. |

---

## UC-19: Search Order

| Field | Content |
|---|---|
| **Use Case ID** | UC-19 |
| **Use Case Name** | Search Order |
| **Actor(s)** | System Administrator |
| **Description** | As an **administrator**, I want to **look up and search the list of orders** so that **I can find and review a specific customer order**. |
| **Priority** | High |
| **Trigger** | The admin clicks "Orders" in the admin interface. |
| **Preconditions** | PRE-1: The admin is logged into the system.<br>PRE-2: The system has recorded at least one order. |
| **Postconditions (Success)** | POST-1: The system displays the order list, and the admin can search and open order details. |
| **Postconditions (Failure)** | The order list fails to load. |
| **Basic Flow** | 1. The admin logs in and accesses the Orders page.<br>2. The system displays all orders (most recent first), showing Order No., Name, Phone, Total, Status, Order Date, Total Items, Delivered On, Canceled On.<br>3. The admin enters a keyword (order number, customer name, order date, etc.) in the search box.<br>4. The system filters and displays matching orders. |
| **Alternative Flow** | **A1** (branches from step 2) — View order details directly: the admin clicks "View Details" on a row instead of searching. *(Continues at UC-20)* |
| **Exception Flow** | **E1** (branches from step 4) — No orders match the search criteria: the system displays no results.<br>**E2** (branches from step 2) — Database connection error: the system displays a message stating the order list could not be loaded; please try again. |
| **Business Rules** | BR-1: Only administrators may access the order list and search feature; customer-facing accounts have no access. |

---

## UC-20: View Order Details

| Field | Content |
|---|---|
| **Use Case ID** | UC-20 |
| **Use Case Name** | View Order Details |
| **Actor(s)** | System Administrator |
| **Description** | As an **administrator**, I want to **view an order's full details and update its status** so that **I can process and track the order through fulfillment**. |
| **Priority** | High |
| **Trigger** | The admin clicks "View Details" on an order row on the Orders page. |
| **Preconditions** | PRE-1: The admin is logged into the system.<br>PRE-2: At least one order exists in the system. |
| **Postconditions (Success)** | POST-1: The admin views the order details and successfully updates its status. |
| **Postconditions (Failure)** | The order status remains unchanged. |
| **Basic Flow** | 1. The admin clicks "View Details" for an order.<br>2. The system displays the order detail page, including "Ordered Items" (Name, Price, Quantity, Action) and "Update Order Status" (current status).<br>3. The admin selects a new status from the dropdown: Ordered / Delivered / Canceled.<br>4. The admin clicks "Update Status."<br>5. The system updates the order status and redirects to the "Orders" page. |
| **Alternative Flow** | **A1** (branches from step 2) — Admin returns to the Orders page without changing the status. *(Use case ends)* |
| **Exception Flow** | **E1** (branches from step 5) — Status update fails (database or connection error): the system displays a message stating the status could not be updated and retains the previous status. |
| **Business Rules** | BR-1: An order already marked "Delivered" or "Canceled" should require confirmation before its status can be changed again. |

---

## UC-21: Create Coupon Code

| Field | Content |
|---|---|
| **Use Case ID** | UC-21 |
| **Use Case Name** | Create Coupon Code |
| **Actor(s)** | System Administrator |
| **Description** | As an **administrator**, I want to **create a new discount coupon** so that **customers can use it to receive a discount during checkout**. |
| **Priority** | Medium |
| **Trigger** | The admin accesses "Coupon" in the admin page and clicks "Add New." |
| **Preconditions** | PRE-1: The admin is logged in.<br>PRE-2: The admin has permission to access the coupon creation feature. |
| **Postconditions (Success)** | POST-1: The coupon is created and displayed in the coupon list. |
| **Postconditions (Failure)** | No coupon is created. |
| **Basic Flow** | 1. The admin logs in and clicks "Coupon" in the navigation bar.<br>2. The system displays the list of existing coupons.<br>3. The admin clicks "Add New."<br>4. The system displays the Create Coupon page.<br>5. The admin enters: Coupon Code, Discount Percentage, Description, Start Date, End Date.<br>6. The admin clicks "Create."<br>7. The system validates and saves the coupon.<br>8. The system redirects to the "Coupon" page, showing the new coupon in the list. |
| **Alternative Flow** | **A1** (branches from step 2) — Admin edits or deletes an existing coupon instead of creating a new one. *(Use case ends)* |
| **Exception Flow** | **E1** (branches from step 7) — Required field missing: the system prompts the admin to complete all required information. → returns to step 5.<br>**E2** (branches from step 7) — End date earlier than start date: the system reloads the page so the admin can re-enter valid dates. → returns to step 5. |
| **Business Rules** | BR-1: Coupon codes must be unique across the system.<br>BR-2: Discount percentage must be between 0% and 100%. |

---

## UC-22: View Statistics Dashboard

| Field | Content |
|---|---|
| **Use Case ID** | UC-22 |
| **Use Case Name** | View Statistics Dashboard |
| **Actor(s)** | System Administrator |
| **Description** | As an **administrator**, I want to **view an overview dashboard of orders and revenue** so that **I can monitor the store's business performance**. |
| **Priority** | Medium |
| **Trigger** | The admin clicks "Dashboard" in the admin interface. |
| **Preconditions** | PRE-1: The admin is logged into the system. |
| **Postconditions (Success)** | POST-1: The system displays accurate statistical figures. |
| **Postconditions (Failure)** | The dashboard fails to load or shows incomplete data. |
| **Basic Flow** | 1. The admin logs into the admin page.<br>2. The admin clicks "Dashboard" in the navigation bar.<br>3. The system navigates to the statistics overview page.<br>4. The system displays: Total Orders, Ordered Orders Amount, Delivered Orders, Delivered Orders Amount, Canceled Orders, Canceled Orders Amount, Total Amount. |
| **Alternative Flow** | **A1** (branches from step 3) — Admin filters the dashboard by a specific date range instead of viewing all-time totals. *(Rejoins at step 4)* |
| **Exception Flow** | **E1** (branches from step 4) — Database connection error: the system displays a message stating the statistics could not be loaded. |
| **Business Rules** | BR-1: Canceled orders must be excluded from the "Total Amount" revenue figure. |

---

## Revision Notes

- **Naming convention:** All use case names were rewritten in **Verb + Noun** form (e.g., "Register Account," "Add Product to Cart") instead of noun-phrase titles.
- **Description format:** Every description now follows the user-story format: *"As a [actor], I want to [goal] so that [benefit]."*
- **Flow numbering:** Standardized to the common convention — Basic Flow: `1, 2, 3…`; Alternative Flow: `A1, A2…` with sub-steps `A1.1, A1.2…`; Exception Flow: `E1, E2…` with sub-steps `E1.1, E1.2…`. Each branch states which step it splits from and, where applicable, which step it rejoins.
- **Missing sections added:** Priority, Postconditions split into Success/Failure, and Business Rules were added to every use case, since the original document only contained Actor, Description, Trigger, Preconditions, single Postcondition, Main Flow, Alternative Flow, and Exceptions.
- **Single-table format:** Each use case is now presented as one self-contained table rather than a table plus separate bullet sections.
- **Special Requirements, Frequency of Use, and Assumptions/Notes rows removed:** These three fields were dropped from every table per project request.
- **"None" values filled in:** Any Alternative Flow, Exception Flow, or Business Rules cell that previously read "None" was filled in with a reasonable, clearly inferential addition consistent with the rest of the use case (e.g., a plausible alternate path or a data-integrity rule), so no table is left with an empty-looking cell. These additions should still be reviewed by the project team.
- **UC-19 correction (carried over):** Exceptions that were mistakenly duplicated from UC-18 in the original source have been replaced with exceptions appropriate to order search.
