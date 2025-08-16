# POS System - Laravel Based Point of Sales (IDR Currency)

A modern, responsive Point of Sales (POS) system built with Laravel and Bootstrap 5, featuring thermal receipt printing functionality and Indonesian Rupiah (IDR) currency support.

## Features

- **🛍️ Point of Sales Interface**: Interactive POS with real-time item search and cart management
- **📦 Item Management**: Complete CRUD operations for products with stock tracking
- **🧾 Thermal Receipt Printing**: Optimized for 58mm thermal printers
- **🔍 Smart Search**: Search items by name or barcode with AJAX
- **💰 Sales Tracking**: Complete transaction recording with detailed line items
- **� IDR Currency**: Full support for Indonesian Rupiah with proper formatting
- **�📱 Responsive Design**: Works perfectly on desktop, tablet, and mobile devices

## Tech Stack

- **Backend**: Laravel 12.x
- **Frontend**: Bootstrap 5, jQuery, Font Awesome
- **Database**: MySQL
- **Development**: Laragon (XAMPP alternative)

## Quick Start

### Prerequisites
- PHP 8.1 or higher
- Composer
- MySQL
- Laragon or XAMPP

### Installation

1. **Clone or download the project**
   ```bash
   # If cloning from repository
   git clone <repository-url>
   cd pos-system
   ```

2. **Install dependencies**
   ```bash
   composer install
   ```

3. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Database configuration**
   - Create a MySQL database named `pos_system`
   - Update your `.env` file:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=pos_system
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. **Run migrations and seed data**
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

6. **Start the development server**
   ```bash
   php artisan serve
   ```

7. **Access the application**
   - Open your browser and go to `http://127.0.0.1:8000`

## Usage

### POS Interface
1. Navigate to the main POS interface at `/`
2. Search for items using the search bar (by name or barcode)
3. Click on items to add them to the cart
4. Adjust quantities as needed
5. Process the sale and print thermal receipts

### Item Management
1. Go to `/items` to manage your inventory
2. Add new items with details like name, price, barcode, and stock
3. Edit existing items or deactivate them
4. Track stock quantities

### Thermal Printing
- The system generates thermal receipt format optimized for 58mm thermal printers
- Print receipts directly from the browser
- CSS is optimized for thermal printer specifications

## Database Schema

### Items Table
- `id` - Primary key
- `name` - Item name
- `description` - Item description
- `price` - Item price (decimal)
- `barcode` - Unique barcode (optional)
- `stock_quantity` - Current stock level
- `is_active` - Status flag

### Sales Table
- `id` - Primary key
- `receipt_number` - Unique receipt identifier
- `total_amount` - Total sale amount
- `tax_amount` - Tax amount
- `discount_amount` - Discount amount
- `payment_method` - Payment method used
- `cashier` - Cashier name

### Sale Items Table
- `id` - Primary key
- `sale_id` - Foreign key to sales
- `item_id` - Foreign key to items
- `quantity` - Quantity sold
- `unit_price` - Price per unit at time of sale
- `total_price` - Total for this line item

## Development

The application follows Laravel best practices:
- **MVC Architecture**: Clean separation of concerns
- **Eloquent ORM**: Database relationships and queries
- **Migration System**: Version-controlled database schema
- **Blade Templates**: Reusable view components
- **Validation**: Request validation for all forms
- **CSRF Protection**: Built-in security features

## Contributing

1. Fork the project
2. Create your feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
