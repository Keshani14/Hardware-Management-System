# ABC Builders Material Management System

A comprehensive web-based inventory and order management system for construction material suppliers.

## Overview

The ABC Builders Material Management System is a PHP-based web application designed to streamline material inventory management, order processing, and delivery tracking for construction material suppliers. It features role-based access control, material categorization, order management, and administrative reporting tools.

## Features

### Core Functionality
- **User Management**: User registration, login, and profile management with role-based access control
- **Material Management**: Add, view, update, and delete building materials with categories and images
- **Order Management**: Place orders, view order status, and complete orders
- **Delivery Tracking**: Manage deliveries and mark them as complete
- **Messaging System**: Customer contact forms with admin messaging and response handling
- **Reporting**: Generate and view system reports
- **Admin Panel**: Administrative tools for user management and system operations

### User Roles
- **Admin**: Full system access including user and material management
- **Regular Users**: Can browse materials, place orders, and manage their profile

## Technology Stack

- **Backend**: PHP
- **Frontend**: HTML, CSS, JavaScript
- **Database**: MySQL
- **Server**: Apache (XAMPP)

## Project Structure

```
├── admin_panel.php          # Admin dashboard
├── manage_users.php         # User management interface
├── materials.php            # Material catalog
├── order.php                # Order placement
├── deliveries.php           # Delivery management
├── view_reports.php         # Reporting interface
├── login.php / sign-up.php  # Authentication
├── process/                 # Business logic handlers
├── styles/                  # CSS stylesheets
├── material_images/         # Uploaded material images
├── category_images/         # Category images
├── dependency/              # Database schema and scripts
└── example_imgs/            # Sample images
```

## Setup Instructions

1. **Database Setup**:
   - Import the SQL schema from `dependency/umms.sql` or `dependency/queries.sql`
   - Configure database connection in `connect.php`

2. **Configuration**:
   - Update database credentials in `connect.php`
   - Ensure proper permissions for image upload directories

3. **Access**:
   - Navigate to `index.php` to access the application
   - Use admin credentials to access admin panel

## Database

The system uses MySQL with tables for:
- Users (with role management)
- Materials (with categories)
- Orders
- Deliveries
- Messages
- Reports

Migration scripts are available in `dependency/migrations/`

## File Organization

- **Root Level**: Main application pages (index.php, login.php, etc.)
- **process/**: Server-side handlers for forms and operations
- **styles/**: CSS styling
- **dependency/**: Database scripts and data population tools
- **images/**: Image storage directories" 
