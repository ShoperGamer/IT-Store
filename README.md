# IT-Store


### 🇹🇭 ภาษาไทย (Thai)

----------

# Mini Project 3: เว็บไซต์ขายโทรศัพท์มือถือ (Mobile Phone E-commerce Website)

มินิโปรเจกต์ลำดับที่ 3 นี้พัฒนาขึ้นด้วยภาษา PHP และใช้งาน XAMPP เป็นสภาพแวดล้อมสำหรับการพัฒนา โปรเจกต์นี้เป็นเว็บไซต์สำหรับขายโทรศัพท์มือถือ มาพร้อมกับฟังก์ชันการทำงานที่หลากหลายเพื่ออำนวยความสะดวกให้แก่ผู้ใช้งาน

## ✨ คุณสมบัติเด่น (Features)

-   **📱 แคตตาล็อกสินค้า:** แสดงรายการโทรศัพท์มือถือพร้อมรายละเอียด
-   **🌙 โหมดกลางคืน (Dark Mode):** ผู้ใช้สามารถเปิด/ปิดโหมดกลางคืนได้ และการตั้งค่านี้จะถูกจดจำไว้ในทุกหน้าของเว็บไซต์โดยใช้คุกกี้
-   **🔍 การค้นหาและกรองข้อมูล:**
    -   ค้นหาตามชื่อแบรนด์ (Brand Name)
    -   ค้นหาตามชื่อรุ่น (Model Name)
    -   กรองตามช่วงราคา (Price Range): กำหนดราคาต่ำสุดและสูงสุดที่ต้องการ
-   **✏️ การจัดการข้อมูล (ผ่าน XAMPP):** สามารถเพิ่มและแก้ไขข้อมูลสินค้าได้โดยตรงผ่านฐานข้อมูลใน XAMPP
-   **📄 ไฟล์ SQL:** ไฟล์สำหรับโครงสร้างฐานข้อมูลและข้อมูลตัวอย่างจะอยู่ในโฟลเดอร์ `DB`

## 🛠️ เทคโนโลยีที่ใช้ (Technologies Used)

-   **PHP:** ภาษาหลักที่ใช้ในการพัฒนาฝั่งเซิร์ฟเวอร์
-   **XAMPP:** ชุดโปรแกรมสำหรับสร้างเว็บเซิร์ฟเวอร์ ประกอบด้วย Apache, MySQL (MariaDB), PHP, และ Perl
-   **HTML/CSS/JavaScript:** สำหรับโครงสร้าง การออกแบบ และการโต้ตอบกับผู้ใช้งานบนหน้าเว็บ
-   **SQL:** ภาษาสำหรับจัดการฐานข้อมูล
-   **Cookies:** ใช้สำหรับจดจำการตั้งค่าโหมดกลางคืนของผู้ใช้

## 🚀 การติดตั้งและใช้งาน (Setup and Usage)

1.  **ติดตั้ง XAMPP:** หากยังไม่มี ให้ดาวน์โหลดและติดตั้ง XAMPP จาก [เว็บไซต์ Apache Friends](https://www.apachefriends.org/)
2.  **คัดลอกไฟล์โปรเจกต์:** นำไฟล์โปรเจกต์ทั้งหมดไปวางไว้ในโฟลเดอร์ `htdocs` ภายในไดเรกทอรีที่ติดตั้ง XAMPP (ตัวอย่าง: `C:\xampp\htdocs\your_project_name`)
3.  **เริ่มการทำงานของ XAMPP:** เปิด XAMPP Control Panel และเริ่มการทำงานของ Apache และ MySQL
4.  **สร้างฐานข้อมูล:**
    -   เข้าไปที่ `phpMyAdmin` (โดยปกติคือ `http://localhost/phpmyadmin`)
    -   สร้างฐานข้อมูลใหม่ (ตั้งชื่อตามที่ต้องการ)
    -   เลือกฐานข้อมูลที่เพิ่งสร้าง แล้วไปที่แถบ "Import"
    -   คลิก "Choose File" และเลือกไฟล์ `.sql` ที่อยู่ในโฟลเดอร์ `DB` ของโปรเจกต์นี้
    -   คลิก "Go" เพื่อนำเข้าโครงสร้างตารางและข้อมูล
5.  **แก้ไขการตั้งค่าการเชื่อมต่อฐานข้อมูล (ถ้าจำเป็น):** ตรวจสอบไฟล์ PHP ที่มีการเชื่อมต่อกับฐานข้อมูล (เช่น `config.php` หรือไฟล์ที่มีการเรียก `mysqli_connect` หรือ `PDO`) และแก้ไขชื่อฐานข้อมูล, ชื่อผู้ใช้, และรหัสผ่านให้ตรงกับการตั้งค่า MySQL ของคุณ (โดยทั่วไปสำหรับ XAMPP คือ ชื่อผู้ใช้: `root`, รหัสผ่าน: `(เว้นว่าง)`)
6.  **เข้าถึงเว็บไซต์:** เปิดเว็บเบราว์เซอร์แล้วเข้าไปที่ `http://localhost/your_project_name` (แทน `your_project_name` ด้วยชื่อโฟลเดอร์ที่คุณตั้งไว้)

## 📂 โครงสร้างไฟล์ (File Structure)

```

├── DB/
│   └── products.sql              <-- ไฟล์ SQL สำหรับฐานข้อมูล
├── config.php                    <-- สำหรับเชื่อมกับหลังบ้าน
├── detail.js                     <-- ไฟล์ JavaScript ของหน้ารายละเอียดสินค้า 
├── detail.php                    <-- หน้ารายละเอียดสินค้า
├── index.js                      <-- ไฟล์ JavaScript ของหน้าหลักของเว็บไซต์
├── index.php                     <-- หน้าหลักของเว็บไซต์

```


## ✍🏻บทความ


 [คุกกี้ คืออะไร???](https://www.blockdit.com/posts/669f6c6674ec6dffe0f24eea)

## 🙏 ข้อมูลเพิ่มเติม

โปรเจกต์นี้เป็นส่วนหนึ่งของการเรียนรู้ และ พัฒนาทักษะการเขียนโปรแกรมเว็บด้วย PHP และ การจัดการฐานข้อมูลเบื้องต้น

----------

### 🇬🇧 English

----------

# Mini Project 3: Mobile Phone E-commerce Website

This is the third mini-project, developed using PHP and XAMPP as the development environment. This project is a website for selling mobile phones, equipped with various functionalities to enhance user experience.

## ✨ Features

-   **📱 Product Catalog:** Displays a list of mobile phones with their details.
-   **🌙 Dark Mode:** Users can toggle dark mode on/off. This preference is saved across all pages using cookies.
-   **🔍 Search and Filtering:**
    -   Search by Brand Name
    -   Search by Model Name
    -   Filter by Price Range: Specify minimum and maximum desired prices.
-   **✏️ Data Management (via XAMPP):** Product data can be added and modified directly through the database in XAMPP.
-   **📄 SQL File:** The SQL file for the database structure and sample data is located in the `DB` folder.

## 🛠️ Technologies Used

-   **PHP:** The primary server-side scripting language.
-   **XAMPP:** A web server solution stack package, consisting of Apache, MySQL (MariaDB), PHP, and Perl.
-   **HTML/CSS/JavaScript:** For structuring, styling, and client-side interactivity.
-   **SQL:** Language for managing databases.
-   **Cookies:** Used to remember the user's dark mode preference.

## 🚀 Setup and Usage

1.  **Install XAMPP:** If you haven't already, download and install XAMPP from the [Apache Friends website](https://www.apachefriends.org/).
2.  **Copy Project Files:** Place all project files into the `htdocs` folder within your XAMPP installation directory (e.g., `C:\xampp\htdocs\your_project_name`).
3.  **Start XAMPP:** Open the XAMPP Control Panel and start the Apache and MySQL modules.
4.  **Create Database:**
    -   Go to `phpMyAdmin` (usually `http://localhost/phpmyadmin`).
    -   Create a new database (name it as you prefer).
    -   Select the newly created database and go to the "Import" tab.
    -   Click "Choose File" and select the `.sql` file located in the `DB` folder of this project.
    -   Click "Go" to import the table structure and data.
5.  **Configure Database Connection (if necessary):** Check the PHP files that handle database connections (e.g., `config.php` or files with `mysqli_connect` or `PDO` calls) and update the database name, username, and password to match your MySQL setup (typically for XAMPP: Username: `root`, Password: `(empty)`).
6.  **Access the Website:** Open your web browser and navigate to `http://localhost/your_project_name` (replace `your_project_name` with the folder name you used).

## 📂 File Structure

```

├── DB/ 
│ └── products.sql             <-- SQL file for the database 
├── config.php                 <-- For backend connection 
├── detail.js                  <-- JavaScript file for the product detail page ├── detail.php <-- Product detail page 
├── index.js                   <-- JavaScript file for the website's main page 
├── index.php                  <-- Website's main page

```
## ✍🏻ฺBlog


 [What is Cookie ???](https://www.blockdit.com/posts/669f6c6674ec6dffe0f24eea)

## 🙏 Additional Information

This project is part of learning and developing web programming skills with PHP and basic database management.