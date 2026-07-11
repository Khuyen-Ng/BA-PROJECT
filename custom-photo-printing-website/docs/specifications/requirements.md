# Requirements Specification

---

## Functional Requirements (FR)

| ID | Requirement Name | Description |
|---|---|---|
| **FR01** | User Account & Authentication | The system shall allow users to register, log in, log out, and manage their personal account information. |
| **FR02** | Photo Upload & Library | The system shall allow customers to upload photo files and manage a personal photo library for later use. |
| **FR03** | Customize & Preview Print Accuracy | The system shall allow customers to customize print configurations (size, material, frame, etc.) and view a live preview of the final printed product. |
| **FR04** | Checkout & Payment | The system shall allow customers to add customized print products to the cart, enter shipping information, select a payment method, and place an order. |
| **FR05** | Order Management & Feedback | The system shall allow customers to view order history and submit feedback, and allow administrators to manage and update order status. |
| **FR06** | Order Tracking | The system shall provide detailed order tracking with defined statuses including Pending, Printing, Shipping, and Completed. |
| **FR07** | Order Processing | The system shall allow staff to process orders, approve print requests, generate print files, and update order status. |
| **FR08** | Frame & Template Management | The system shall allow administrators to create, update, and delete frame types, print sizes, and layout templates. |
| **FR09** | Notification & Email | The system shall send notifications and emails to customers for registration, order confirmation, and order status updates. |
| **FR10** | Customer Review & Rating | The system shall allow customers to submit reviews and ratings for completed orders and display overall ratings. |
| **FR11** | Print Specification Definition | The system shall define and store print specifications for each order. |
| **FR12** | Print-Ready File Generation | The system shall generate print-ready files based on the defined print specifications. |

---

## Non-Functional Requirements (NFR)

| ID | Requirement | Description |
|---|---|---|
| **NFR01** | Performance | The system shall load the live preview page within 3 seconds for image files smaller than 10MB. |
| **NFR02** | Security | The system must store user passwords in hashed form and use HTTPS for all data transmission. |
| **NFR03** | Availability | The system shall be available 24/7 with a maximum downtime of 0.1% per month. |
| **NFR04** | Usability | The system shall allow customers to complete the photo printing order process in no more than five steps and support mobile-friendly interfaces. |
| **NFR05** | Scalability | The system shall support processing at least 100 orders per day and allow scalable image storage using cloud services. |
| **NFR06** | Maintainability | The system shall allow administrators to update pricing rules, print sizes, and frame options without modifying source code. |
| **NFR07** | Compatibility | The system shall operate correctly on modern web browsers including Chrome, Edge, and Safari, and provide a responsive interface for mobile and tablet devices. |
| **NFR08** | Data Privacy | The system shall restrict access to uploaded photos so that only the owner and authorized administrators can view them. |
| **NFR09** | Print Turnaround Time | The system shall ensure that photo printing is completed within 48 hours for orders containing up to 10 photos after order confirmation. |
| **NFR10** | Reprint Rate | The system shall maintain a technical reprint rate of no more than 2% of total orders per month. |
| **NFR11** | Print Quality Consistency | The system shall ensure that color and size deviations of printed photos do not exceed ±5% compared to the print-ready file. |
| **NFR12** | Delivery Time Commitment | The system shall ensure domestic delivery is completed within 3–5 working days after printing is completed. |
