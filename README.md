# php-Cube
php framework

/**
 * @framework phpCube (Cube)
 * @version 1.0
 * @author Le Ngoc Doan
 * @copyright 2017
 */

###### Huong dan su dung php Cube #######
I. Các folder:
 - app: folder làm việc với php
 - public: folder chứa các file tĩnh như hình ảnh, css, js, v.v..

II. Các file: 
 - index.php: file để thực thi trang web
 - config.php: chứ các biến, các hằng để thiết lập và thực thi trang web
 - .htaccess: tìm hiểu trên google =)))))))

III. làm quen với cấu trúc thư mục và file của Cube
 - Các thư mục hệ thống bao gồm: 
   + lib: thư viện gồm hầu hết các function và class đã dượng khai báo khi chương trình khởi chạy
   + system: chứa các file hệ thống
   + Các thư mục như config, datas, ext, contents hiện tại chưa dùng để làm gì, nhưng nó sẽ dc sử dụng trong tương lai ở các phiên bả cao hơn
   + Có 3 thư mục dành cho ltv đó là:
     - cubes: (controller) thư mục chứ các file xử lý các yêu cầu của người dùng
     - models: chứ các file xử lý csdl
     - Themes: (ở một vài framework khác) có thể coi là views, chứ các file dùng để hiển thị ra trình duyệt

   * chú ý với cube bạn có thể thay đổi giao diện một cacg1 dễ dàng nên css, js đi chung với một giao diện phải dược đat trong thư mục của giao diện đó. Còn các file css, images, js của trang web nên được đặt trong một thư mục khác
  - Cách sử dụng controller:
   + thạo một file có tên trùng với path trên url bạn muốn xử lý
   ví dụ: localhost/path1 hoặc localhost/path1/path2 hoặc localhost/path1/path2/path3
   thì sẽ được trỏ vào file path1 trong thư mục cubes/path1.php
   nhóm path: cubes/[pathgroup]/pathname.php

ví dụ bạn có mục sản phẩm, bên trong lại có các mục như thêm, sửa, xóa
bạn có thể tạo một thư mục là san-phâm
bên trong gồm các file add.php, edit.php, delete.php

