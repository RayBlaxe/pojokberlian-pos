<!-- Use this file to provide workspace-specific custom instructions to Copilot. For more details, visit https://code.visualstudio.com/docs/copilot/copilot-customization#_use-a-githubcopilotinstructionsmd-file -->

# POS System - Custom Instructions for GitHub Copilot

This is a Laravel-based Point of Sales (POS) system with the following features:

## Project Structure
- **Laravel Framework**: Latest version with MVC architecture
- **Database**: MySQL with migrations for items, sales, and sale_items tables
- **Frontend**: Bootstrap 5 with responsive design and thermal receipt printing

## Key Features
1. **Item Management**: Full CRUD operations for products/items
2. **POS Interface**: Interactive sales interface with search and cart functionality
3. **Thermal Receipt Printing**: Formatted receipts optimized for thermal printers (58mm width)
4. **Real-time Search**: AJAX-powered item search by name or barcode
5. **Sales Tracking**: Complete transaction recording with detailed line items

## Models and Relationships
- `Item`: Product information with stock tracking
- `Sale`: Transaction header with totals and payment info
- `SaleItem`: Line items linking sales to products with quantities and prices

## Controllers
- `POSController`: Handles POS operations, search, sales processing, and receipt generation
- `ItemController`: Standard resource controller for item management

## Frontend Components
- Bootstrap 5 responsive UI
- jQuery for AJAX interactions
- Thermal receipt CSS for proper printing
- FontAwesome icons for enhanced UI

## Database Configuration
- Uses MySQL database named 'pos_system'
- Migrations include proper foreign key constraints
- Seeders provide sample data for testing

## Printing
The system includes thermal receipt formatting optimized for 58mm thermal printers commonly used in retail environments.

When working on this project, prioritize:
1. Maintaining the existing MVC structure
2. Following Laravel best practices
3. Ensuring proper validation and error handling
4. Keeping the thermal receipt formatting intact
5. Maintaining responsive design across all views
