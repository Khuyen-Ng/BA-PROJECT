# Triển khai Hệ thống ERP Odoo cho Công ty TNHH 123CORP

Dự án **Triển khai Hệ thống ERP** sử dụng **Odoo Community** nhằm chuẩn hóa quy trình kinh doanh cho Công ty TNHH 123CORP – doanh nghiệp chuyên phân phối thiết bị công nghệ, tin học và văn phòng.

Dự án tập trung vào việc giải quyết các vấn đề quản lý khách hàng rời rạc, quy trình bán hàng chưa chuẩn hóa, kiểm soát tồn kho và serial number, đồng thời xây dựng nền tảng tích hợp qua **API**.

## Tổng quan Dự án

- **Tên doanh nghiệp**: Công ty TNHH 123CORP (Thương hiệu: ThietBiVanPhong123.com)
- **Lĩnh vực**: Phân phối thiết bị tin học, mạng, lưu trữ NAS, văn phòng
- **Nền tảng**: Odoo Community
- **Cơ sở dữ liệu**: PostgreSQL
- **Môi trường**: Localhost / Development
- **Mục tiêu chính**: Chuẩn hóa quy trình Bán hàng, Mua hàng, Kho hàng và hỗ trợ tích hợp hệ thống bên ngoài

## Các Chức năng Chính Đã Triển Khai

### 1. Quy trình Bán hàng (Sales - Order to Cash)
### 2. Quy trình Mua hàng (Purchase - Procure to Pay)
### 3. Quản lý Kho & Tồn kho (Inventory)
### 4. Quản lý Khách hàng & CRM
### 6. Quản lý nhân sự

## Trách nhiệm của tôi

- Phân tích yêu cầu kinh doanh và vấn đề hiện tại của công ty.
- Thiết kế các quy trình chính (Bán hàng, Mua hàng, Kho) bằng BPMN.
- Cài đặt, cấu hình và tùy chỉnh Odoo.
- Xây dựng **Module API** chuẩn hóa để tích hợp hệ thống bên ngoài.
- Thiết lập automation.

## Công nghệ & Công cụ sử dụng

- **Odoo**
- **Python** (Odoo Framework)
- **PostgreSQL**
- **Camunda** (BPMN)
- **Postman** (Test API)
- **Google Sheets + Apps Script** (Tích hợp)

## Cấu trúc Repository

```text
├── docs/
│   ├── analysis.md                 # Phân tích yêu cầu & vấn đề
│   ├── odoo_implementation.md      # Báo cáo triển khai chi tiết
│   └── bpmn/                       # Các file BPMN
└── README.md