# Triển khai Odoo ERP cho Công ty TNHH 123CORP

## 1. Cấu hình Hệ thống Cơ bản

Đã thực hiện các công việc cấu hình nền tảng trên Odoo:

- Thiết lập thông tin công ty, logo, địa chỉ và thông tin thuế.
- Cấu hình đơn vị tiền tệ chính: **VND**.
- Cấu hình đa ngôn ngữ (**Tiếng Việt** và **English**).
- Thiết lập người dùng, phòng ban và phân quyền chi tiết theo vai trò (Admin, Salesperson, Purchase Manager, Inventory Manager, HR…).
- Cấu hình **SMTP Gmail** để gửi email tự động (báo giá, hóa đơn, thông báo).
- Tùy chỉnh layout tài liệu (báo giá, hóa đơn, Purchase Order) theo thương hiệu 123CORP.
- Thiết lập kho hàng và chính sách theo dõi **Serial Number**.

## 2. Triển khai Các Quy trình Chính

### 2.1. Quy trình Bán hàng (Sales - Order to Cash)
Hiện thực đầy đủ quy trình theo thiết kế BPMN trong tài liệu:

- Tiếp nhận Lead từ website/form → Convert to Opportunity.
- Lập & gửi báo giá (Quotation) nhiều vòng thương lượng.
- Chốt đơn → Sales Order → Tạo hóa đơn.
- Theo dõi serial number trên đơn hàng.

### 2.2. Quy trình Mua hàng (Purchase - Procure to Pay)
- Tạo RFQ → Nhận báo giá nhà cung cấp → Phê duyệt Purchase Order.
- Nhận hàng tại kho (kiểm tra serial) → Xác nhận hóa đơn → Thanh toán.

### 2.3. Quy trình Quản lý Kho (Inventory)
- Nhập/xuất kho theo serial number.
- Kiểm kê, điều chuyển kho, cảnh báo tồn kho thấp.
- Tích hợp chặt chẽ với Sales và Purchase.

### 2.4. Quy trình Nhân sự (HRM - Cơ bản)
- Quản lý nhân viên, phòng ban.
- Hợp đồng lao động, nghỉ phép (theo yêu cầu dự án).

## 3. Xây dựng Module API Chuẩn hóa (`123corp.api`)

**Đây là một trong những phần quan trọng nhất của dự án**, nhằm “kéo ERP ra ngoài” phục vụ tích hợp hệ thống bên ngoài.

### Mục tiêu module
- Xây dựng **API RESTful chuẩn hóa** (theo kiểu shop/best practices).
- Cho phép các hệ thống bên ngoài (Website, Mobile App, Google Sheets, Power BI, phần mềm khác…) dễ dàng truy vấn và tương tác dữ liệu thời gian thực.
- Đảm bảo bảo mật, dễ mở rộng và tuân thủ cấu trúc Odoo.

### Các tính năng chính đã thực hiện
- Xác thực qua **API Key**.
- Cung cấp các endpoint chuẩn hóa cho toàn bộ quy trình kinh doanh.
- Hỗ trợ đầy đủ các nghiệp vụ cốt lõi của 123CORP:
  - Quản lý Sản phẩm (có lọc theo serial, tồn kho).
  - Khách hàng & Lead.
  - Báo giá (Quotation) và Đơn bán hàng.
  - Đơn mua hàng (Purchase Order).
  - Kiểm tra tồn kho & Serial Number.
  - Nhân sự cơ bản.

## 4. Quản lý Dữ liệu

- Nhập liệu danh mục sản phẩm, khách hàng, nhà cung cấp.
- Import/Export Excel/CSV.
- Làm sạch dữ liệu và thiết lập reordering rules.

## 5. Báo cáo & Phân tích

- Báo cáo Pipeline bán hàng, Purchase Analysis, Inventory Valuation.
- Dashboard theo dõi tồn kho, doanh số, tỷ lệ chuyển đổi Lead → Won.
- Báo cáo phễu bán hàng (Sales Funnel).

## 6. Tự động hóa (Automation)

- Automation Rules: Follow-up khách hàng, cảnh báo tồn kho thấp.
- Scheduled Actions: Báo cáo định kỳ.
- Email & Notification tự động.


## 7. Tùy chỉnh Hệ thống

- Tùy chỉnh views, fields, workflow.
- Thêm trường tùy chỉnh cho sản phẩm (serial, cấu hình).
- Điều chỉnh approval workflow cho báo giá & đơn mua.

## 8. Kết quả Đạt được

- Hệ thống ERP quản lý tập trung toàn bộ quy trình: Bán hàng, Mua hàng, Kho, Nhân sự.
- Chuẩn hóa hoạt động, giảm sai sót thủ công đáng kể.
- Kiểm soát chặt chẽ tồn kho và serial number.
- **Module API** mạnh mẽ giúp dễ dàng mở rộng tích hợp với website và các hệ thống bên ngoài.
- Nâng cao hiệu quả phối hợp giữa các bộ phận.
- Nền tảng sẵn sàng scale lên cho giai đoạn tiếp theo (Accounting đầy đủ, HRM nâng cao, Mobile App…).