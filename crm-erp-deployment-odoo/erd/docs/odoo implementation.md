# Odoo ERP Implementation for 123CORP Co., Ltd.

## 1. Basic System Configuration

Completed the platform configuration in Odoo:

- Set up company information, logo, address, and tax details.
- Configured the main currency: **VND**.
- Configured multiple languages (**Vietnamese** and **English**).
- Set up users, departments, and detailed role-based permissions (Admin, Salesperson, Purchase Manager, Inventory Manager, HR…).
- Configured **SMTP Gmail** for automated email sending (quotations, invoices, notifications).
- Customized document layouts (quotations, invoices, Purchase Orders) to match the 123CORP brand.
- Set up warehouses and serial number tracking policies.

## 2. Core Process Deployment

### 2.1. Sales Process (Sales - Order to Cash)
Implemented the full process according to the BPMN design in the documentation:

- Receive leads from website/forms → convert to Opportunity.
- Create and send quotations with multiple negotiation rounds.
- Confirm orders → Sales Order → Create invoices.
- Track serial numbers on orders.

### 2.2. Purchase Process (Purchase - Procure to Pay)
- Create RFQs → receive supplier quotes → approve Purchase Orders.
- Receive goods in warehouse (check serials) → confirm invoices → make payments.

### 2.3. Inventory Management Process
- Inbound/outbound warehouse movements with serial number tracking.
- Stocktaking, internal transfers, low stock alerts.
- Tight integration with Sales and Purchase.

### 2.4. HRM Process (Basic)
- Manage employees and departments.
- Manage labor contracts and leave requests (per project needs).

## 3. Built Standardized API Module (`123corp.api`)

**This is one of the most important parts of the project**, designed to expose ERP capabilities for external system integration.

### Module objectives
- Build a standardized **RESTful API** (following shop/best practices).
- Allow external systems (Website, Mobile App, Google Sheets, Power BI, other software…) to query and interact with real-time data.
- Ensure security, scalability, and Odoo structure compliance.

### Key features implemented
- Authentication via **API Key**.
- Standardized endpoints for the full business process.
- Supported core 123CORP operations:
  - Product management (with filters by serial, stock availability).
  - Customer & Lead management.
  - Quotations and Sales Orders.
  - Purchase Orders.
  - Inventory and Serial Number checks.
  - Basic HR management.

## 4. Data Management

- Imported product catalogs, customers, and suppliers.
- Imported/Exported data via Excel/CSV.
- Cleaned data and set up reordering rules.

## 5. Reporting & Analysis

- Sales pipeline reports, purchase analysis, inventory valuation.
- Dashboards for stock, revenue, and lead-to-won conversion rates.
- Sales funnel reporting.

## 6. Automation

- Automation Rules: customer follow-up, low stock alerts.
- Scheduled Actions: periodic reports.
- Automated email and notifications.

## 7. System Customization

- Customized views, fields, and workflows.
- Added custom product fields (serial, configuration).
- Adjusted approval workflows for quotations and purchase orders.

## 8. Achievements

- A centralized ERP system managing Sales, Purchase, Inventory, and HR.
- Standardized operations and significantly reduced manual errors.
- Tight control of inventory and serial number tracking.
- A powerful **API module** that enables easy integration with website and external systems.
- Improved collaboration between departments.
