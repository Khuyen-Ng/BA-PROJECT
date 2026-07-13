# Triển khai Odoo (Odoo Implementation)

## 1. Cấu hình Hệ thống Cơ bản

Đã thực hiện các công việc cấu hình nền tảng trên Odoo:

- Thiết lập thông tin công ty, logo và địa chỉ.
- Cấu hình đa ngôn ngữ (Tiếng Việt và English).
- Thiết lập người dùng, phòng ban và phân quyền chi tiết theo vai trò.
- Cấu hình SMTP để gửi email tự động (báo giá, thông báo, nhắc lịch).
- Thiết lập CRM Pipeline và các Stage theo quy trình tuyển sinh.
- Cấu hình Lost Reasons, Activities và các trường tùy chỉnh.

## 2. Triển khai Quy trình CRM

Hiện thực quy trình tuyển sinh trên Odoo theo thiết kế BPMN:

| Stage                    | Mô tả |
|--------------------------|------|
| **New**                  | Tiếp nhận Lead mới từ các kênh. |
| **First Contact**        | Liên hệ ban đầu, ghi nhận nhu cầu. |
| **Schedule Test**        | Lên lịch kiểm tra đầu vào. |
| **Tested**               | Học viên đã hoàn thành bài test. |
| **Counselling**          | Tư vấn khóa học phù hợp. |
| **Paid**                 | Hoàn tất thanh toán học phí. |
| **Won**                  | Hoàn tất quy trình, chuyển thành học viên chính thức. |

## 3. Tạo Module Mới - Admission Funnel Report

**Đây là một trong những phần tùy chỉnh quan trọng nhất của dự án.**

- Tạo module mới mang tên **`admission.funnel.report`**.
- Mục đích: Xây dựng báo cáo phễu tuyển sinh (Admission Funnel) để phân tích hiệu quả quy trình từ Lead → Test → Đăng ký → Thanh toán.
- Model chính: `admission.funnel.report`
- Các chức năng chính đã thực hiện:
  - Thiết kế bộ lọc linh hoạt (thời gian, kênh marketing, nhân viên, hình thức test, khóa học, trạng thái thanh toán…).
  - Tính toán tự động số lượng và **tỷ lệ chuyển đổi** ở từng giai đoạn funnel.
  - Hỗ trợ 3 loại view: List View, Form View và Graph View (biểu đồ cột).
  - Logic tính toán phức tạp sử dụng `domain` động và hàm `_compute_funnel_values()`.

Module này giúp Ban quản lý dễ dàng đánh giá hiệu quả quy trình tuyển sinh và ra quyết định dựa trên dữ liệu thực tế.

## 4. Quản lý Dữ liệu

- Nhập liệu danh mục khóa học, Lead và khách hàng mẫu.
- Sử dụng Import/Export Excel/CSV.
- Áp dụng Filter, Group By và Saved Search.

## 5. Báo cáo & Phân tích

- Sử dụng các báo cáo có sẵn: Pipeline Analysis, Lead Analysis, Pivot, Graph, Dashboard.
- Triển khai module **Admission Funnel Report** tùy chỉnh.

## 6. Tự động hóa

- Automation Rules
- Scheduled Activities
- Email & SMS Notification

## 7. API & Tích hợp

- Tìm hiểu và thử nghiệm XML-RPC API của Odoo.
- Khảo sát tích hợp Lead Form từ website qua API.

## 8. Tùy chỉnh Hệ thống

- Tùy chỉnh Pipeline, Stage và các trường dữ liệu.
- Điều chỉnh form view và quyền truy cập.

## 9. Kết quả Đạt được

- Hệ thống CRM hoạt động ổn định và quản lý tập trung dữ liệu.
- Theo dõi rõ ràng toàn bộ quy trình tuyển sinh.
- Có công cụ báo cáo mạnh mẽ (đặc biệt là Admission Funnel Report).
- Nâng cao hiệu quả phối hợp giữa các bộ phận.
- Nền tảng sẵn sàng mở rộng cho doanh nghiệp.
