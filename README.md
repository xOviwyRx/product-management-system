# Product Management System

A full-stack web application for managing products with mass operations and dynamic product types.

## 🚀 Live Demo

🚧 The live demo is temporarily offline.  
🛠 I'm currently migrating it to a new host — code and screenshots are fully available below.

## 🛠️ Tech Stack

- **Backend**: PHP, MySQL
- **Frontend**: HTML5, CSS3, JavaScript, Bootstrap
- **Features**: AJAX, Responsive Design

## ✨ Features

- Product listing with mass delete functionality
- Dynamic product types (DVD, Book, Furniture) with specific attributes
- Form validation and SKU uniqueness checking
- Responsive design for all devices
- AJAX-powered smooth user experience

## 🔧 Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/xOviwyRx/product-management-system.git
   ```
2. **Database Setup**
    ```sql
    CREATE DATABASE product_management;
    USE product_management;
    SOURCE sql/schema.sql;
    ```

3. **Configuration**
   Update database credentials in config/database.php

4. **Run**
    ```bash
   php -S localhost:8000 -t public
   ```
   Then access via http://localhost:8000

## 📊 Database Schema
The application uses a normalized database structure with separate tables for each product type. Complete schema is available in ``sql/schema.sql``.

## 💡 Usage
- **Add Products**: Click "ADD" button, fill form with product details
- **Mass Delete**: Select products via checkboxes, click "MASS DELETE"
- **Product Types**: DVD (size), Book (weight), Furniture (dimensions)

## 🎯 Key Implementations
- **Normalized Database Design**: Separate tables for each product type with foreign key relationships
- **Object-oriented PHP Architecture**: Clean separation of concerns
- **JavaScript Form Validation**: Client-side validation with AJAX requests
- **Bootstrap Responsive Grid**: Mobile-first responsive design
- **Database Integrity**: CASCADE DELETE and unique constraints for data consistency
    
