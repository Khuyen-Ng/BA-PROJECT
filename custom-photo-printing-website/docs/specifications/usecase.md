# Use Case Specifications - ArtPrintStudio

---

## UC-01

| Field | Detail |
|---|---|
| **Use Case ID** | UC-01 |
| **Use Case Name** | Upload and View Photos |
| **Description** | As a customer, I want to upload photos and view them in my personal photo library so that I can manage and revisit my images before ordering prints. |
| **Actors** | Customer |
| **Trigger** | The customer accesses the "Upload Photo" function to upload an image, or the "Gallery / Photo Library" function to view photos. |
| **Preconditions** | Pre-1: The customer is logged into the system with a valid account.<br>Pre-2: The system and database are operating normally. |
| **Postconditions** | Post-1: Valid photos are successfully stored and recorded in the system.<br>Post-2: The customer's photo library is updated and viewable. |
| **Main Flow** | 1. The customer accesses the Upload Photo function.<br>2. The system displays the upload form, allowing the customer to select an image file, with an Upload button.<br>3. The customer selects a file from their device and clicks Upload.<br>4. The system receives the file and customer information, and validates the file format and size.<br>5. If the file is valid, the system saves the photo to storage.<br>6. The system records the corresponding photo information in the database.<br>7. The system confirms a successful upload and updates/displays the new photo in the gallery.<br>8. The customer accesses the Gallery / Photo Library function to view their library.<br>9. The system retrieves the customer's photo list from the database.<br>10. The system displays the photo list as a gallery; the customer selects a photo to view in detail.<br>11. The system displays the selected photo in detail. |
| **Alternate Flow** | **A1 – Customer cancels upload before submitting:**<br>- The customer clicks Cancel or closes the upload screen.<br>- The system stops the upload process, resets the form (if needed), and does not send the file to the server. |
| **Exception Flow** | **E1 – Invalid photo file:**<br>- The system detects an invalid file format or a file exceeding the size limit.<br>- The system does not save or record the file's information.<br>- The system displays an error message and asks the customer to select another file.<br><br>**E2 – System error during upload:**<br>- After the file passes validation, an error occurs while saving the photo or recording its information.<br>- The system stops processing the upload for that file and does not add it to the library.<br>- The system displays a system error message to the customer.<br><br>**E3 – No photos in the library:**<br>- The photo list query returns empty (the customer has not uploaded any photos).<br>- The system does not display a gallery and instead shows the message "No photos found." |

---

## UC-02

| Field | Detail |
|---|---|
| **Use Case ID** | UC-02 |
| **Use Case Name** | Customize and Preview Print |
| **Description** | As a customer, I want to customize a photo by selecting a print size and frame/template and generate a preview so that I can see how the final product will look before placing an order. |
| **Actors** | Customer |
| **Trigger** | The customer clicks the "Customize" button after uploading a photo. |
| **Preconditions** | Pre-1: The customer has uploaded at least one photo to the system.<br>Pre-2: A list of available sizes and frames/templates exists in the system.<br>Pre-3: The pricing service and preview-generation service are operating normally. |
| **Postconditions** | Post-1: A preview image is successfully generated and displayed to the customer.<br>Post-2: The selected configuration (size, frame, material, quantity, price) is saved on screen. |
| **Main Flow** | 1. The customer accesses the website.<br>2. The customer selects a photo and clicks Customize.<br>3. The system loads the list of available sizes and frames/templates.<br>4. The customer selects size, material, frame, and quantity.<br>5. The system processes the image: adjusts the aspect ratio and applies the frame/template.<br>6. The system calculates a temporary price.<br>7. The system displays a preview image for the customer to review.<br>8. The customer may change their selections. |
| **Alternate Flow** | **A1 – Customer changes selection after previewing:**<br>- A1.1: The customer changes the size or frame.<br>- A1.2: The customer requests a new preview.<br>- A1.3: The system generates a new preview.<br><br>**A2 – Photo does not match frame aspect ratio:**<br>- A2.1: The system detects a mismatch between the photo and frame ratio.<br>- A2.2: The system suggests valid options, such as Auto-fit (scale to fit) or Auto-crop (crop to fit).<br>- A2.3: The customer selects an option.<br>- A2.4: The flow returns to the Preview step. |
| **Exception Flow** | **E1 – Corrupted or invalid photo:**<br>- E1.1: The photo file is corrupted or invalid.<br>- E1.2: The system asks the customer to select another photo.<br>- E1.3: The use case ends unsuccessfully.<br><br>**E2 – Database retrieval error:**<br>- E2.1: The system fails to load size or frame data due to a database error (connection loss, missing data).<br>- E2.2: The system displays an appropriate error message.<br>- E2.3: The use case stops, or the customer returns to the customization step. |

---

## UC-03

| Field | Detail |
|---|---|
| **Use Case ID** | UC-03 |
| **Use Case Name** | Complete Checkout |
| **Description** | As a customer, I want to review my print cart, enter shipping information, and select a payment method so that I can place my photo print order and have it recorded in the system. |
| **Actors** | Customer |
| **Trigger** | The customer clicks "Proceed to Checkout" on the cart page. |
| **Preconditions** | Pre-1: The customer has uploaded a photo and created at least one print configuration (size, frame, material, quantity).<br>Pre-2: At least one print product has been added to the cart.<br>Pre-3: The system and database are operating normally.<br>Pre-4: The customer has opened the cart page and is ready to proceed to checkout and provide shipping information. |
| **Postconditions** | Post-1: An order and its associated order-item list are created in the database.<br>Post-2: The order status is initialized as Pending; the payment status is Paid or Unpaid depending on the payment method.<br>Post-3: The customer's cart is cleared after a successful order. |
| **Main Flow** | 1. From the product detail page, the customer clicks "Add to Cart" to add a print configuration (size, frame, material, quantity) to the cart.<br>2. The customer accesses the cart page.<br>3. The system displays the list of print products in the cart along with the estimated total.<br>4. The customer reviews and adjusts the cart, then clicks "Proceed to Checkout."<br>5. The system navigates to the checkout page, displaying an order summary and a shipping information form.<br>6. The customer enters shipping information and confirms it.<br>7. The system validates the data, then allows the customer to select a payment method.<br>8. The customer selects a payment method and clicks "Place Order."<br>9. The system calculates the final total, creates the order record in the database, and sets the initial order status (Pending, Paid/Unpaid).<br>10. The system displays the "Order Placed Successfully" page and clears the cart. |
| **Alternate Flow** | **A1 – Empty cart:**<br>- When the customer opens the cart page, the system detects no products in the cart.<br>- The system displays "Your cart is empty" and a "Continue Shopping" button.<br><br>**A2 – Customer edits cart before checkout:**<br>- During cart review, the customer changes quantities or removes items.<br>- The system recalculates the total.<br>- The customer can still click "Proceed to Checkout" and continue the normal flow.<br><br>**A3 – Customer changes payment method:**<br>- After selecting a payment method, the customer decides to switch to another one.<br>- The system re-displays the list of payment methods.<br>- The customer selects a new method and returns to the order confirmation step. |
| **Exception Flow** | **E1 – Invalid shipping information:**<br>- The customer enters incomplete or incorrectly formatted data (email, phone number, address, etc.).<br>- The system flags the invalid fields and asks the customer to re-enter them.<br>- After correction, the flow returns to the information review step.<br><br>**E2 – Online payment failure:**<br>- The payment gateway returns a failure result or a technical error.<br>- The system does not create the order and keeps the cart intact.<br>- The system displays an error message and allows the customer to retry payment, choose another payment method, or cancel the purchase.<br><br>**E3 – System error while creating the order:**<br>- An error occurs while writing the Order/OrderItems records to the database.<br>- The system does not create the order; the cart remains unchanged.<br>- The system displays: "An error occurred while placing your order. Please try again later." |

---

## UC-04

| Field | Detail |
|---|---|
| **Use Case ID** | UC-04 |
| **Use Case Name** | Track Order Status |
| **Description** | As a customer, I want to view my order history and check the processing status of each order so that I can monitor my photo printing progress. |
| **Actors** | Customer |
| **Trigger** | The customer selects the "My Orders" function in the system. |
| **Preconditions** | Pre-1: The customer has a valid account in the system.<br>Pre-2: The customer may or may not currently be logged in. |
| **Postconditions** | Post-1: The customer's list of print orders is displayed, or the system shows a message indicating no orders exist.<br>Post-2: If the customer selects a specific order, its full processing status is displayed. |
| **Main Flow** | 1. The customer accesses the "My Orders" function.<br>2. The system checks the customer's login status to determine access permission.<br>3. Once access is confirmed, the system displays the list of print orders previously placed by the customer.<br>4. For each order in the list, the system displays basic information such as order ID, order date, and current processing status.<br>5. The customer views the order list and selects a specific order to see details.<br>6. The system displays the selected order's details, including: print photo information; print configuration (size, frame type, material); order processing status (Pending, Printing, Shipping, Completed). |
| **Alternate Flow** | **A1 – Customer is not logged in:**<br>- The system prompts the customer to log in to continue using this function.<br><br>**A2 – Customer has no orders:**<br>- The system displays the message "You have no orders yet." |
| **Exception Flow** | **E1 – Customer accesses the function while not logged in:**<br>- The system requires the customer to log in.<br><br>**E2 – Order data query error:**<br>- The system displays an error message and asks the customer to try again later. |

---

## UC-05

| Field | Detail |
|---|---|
| **Use Case ID** | UC-05 |
| **Use Case Name** | Update Order Status |
| **Description** | As an admin, I want to view order details and update the order processing status so that customer orders progress correctly through the fulfillment pipeline (or are cancelled when necessary). |
| **Actors** | Admin |
| **Trigger** | The admin selects an order in the admin panel and clicks "Update Status." |
| **Preconditions** | Pre-1: The admin is logged into the system with valid admin permissions.<br>Pre-2: The order exists in the system.<br>Pre-3: The system/database is operating normally. |
| **Postconditions** | Post-1: The order status is updated and saved to the database.<br>Post-2: (Optional) The system sends an email/notification to the customer when the status changes. |
| **Main Flow** | 1. The admin logs in and navigates to the Orders Dashboard.<br>2. The system displays the order list with a status filter.<br>3. The admin filters/selects an order and opens Order Details.<br>4. The admin selects a New Status (Printing/Shipping/Completed/Cancelled) and enters an admin note (if applicable).<br>5. The system validates the status transition (e.g., Pending → Printing is valid; Completed → Printing is invalid).<br>6. The system updates Orders.status (and timestamps such as printed_at/shipped_at/completed_at, if applicable).<br>7. (Optional) The system sends an email/notification to the customer.<br>8. The system displays a success message with the new status. |
| **Alternate Flow** | **A1 – Admin cancels the order:**<br>- A1.1: The admin selects Cancelled and enters a cancellation reason.<br>- A1.2: The system saves the Cancelled status along with the reason/admin note.<br>- A1.3: (Optional) The system notifies the customer.<br><br>**A2 – Admin only views without updating:**<br>- A2.1: The admin exits Order Details without writing any changes to the database. |
| **Exception Flow** | **E1 – Insufficient permissions / expired session:** The system requires the admin to log in again.<br>**E2 – Order not found:** The system displays "Order not found."<br>**E3 – Database error / connection loss:** The system displays a system error message; no update is made.<br>**E4 – Invalid status transition:** The system displays "Invalid status transition." |

---

## UC-06

| Field | Detail |
|---|---|
| **Use Case ID** | UC-06 |
| **Use Case Name** | Submit Review |
| **Description** | As a customer, I want to submit a rating and comment after my order is completed so that I can share feedback on the product and service quality. |
| **Actors** | Customer |
| **Trigger** | The customer clicks the "Review" button on the order detail page. |
| **Preconditions** | Pre-1: The customer is logged in.<br>Pre-2: The order belongs to the customer.<br>Pre-3: The order status is Completed (or the system otherwise permits a review). |
| **Postconditions** | Post-1: The review is saved in the Reviews table (order_id, rating, comment, created_at).<br>Post-2: The overall rating score may be updated and displayed. |
| **Main Flow** | 1. The customer goes to "My Orders" and opens a Completed order.<br>2. The system displays the "Review" button.<br>3. The customer selects a rating (1–5) and enters a comment.<br>4. The customer clicks "Submit Review."<br>5. The system validates the data (valid rating, required fields not empty).<br>6. The system saves the review to the database (Reviews table).<br>7. The system displays the message "Review submitted successfully." |
| **Alternate Flow** | **A1 – Customer edits an existing review (if allowed):** The system updates the existing review.<br>**A2 – Customer skips reviewing:** No review is created. |
| **Exception Flow** | **E1 – Order not yet Completed:** The Review button is hidden, or the system displays a message that the order is not eligible for review.<br>**E2 – Review already exists (if resubmission is not allowed):** The system displays "You have already reviewed this order."<br>**E3 – Database error:** The system displays a system error message; the review is not saved. |

