# AI Agent Instructions for Web Catering Project

## Project Overview
This is a Laravel-based catering website that allows customers to order various food packages including buffet, tumpeng, nasi box, and snacks. The project uses Laravel for backend, Alpine.js for frontend state management, and Tailwind CSS for styling.

## Key Architecture Patterns

### Backend Structure
- **Models**: Located in `app/Models/` - follow Laravel Eloquent patterns with defined `$fillable` and `$casts` properties
  - Example: `Order.php` uses array casting for `items` field to handle cart data
- **Routes**: Organized in `routes/web.php` by feature (orders, menu, profile)
  - Public routes for menu display
  - Protected routes under `auth` middleware for user dashboard/profile

### Frontend Architecture
- **Cart Management**: Uses Alpine.js store pattern (`resources/js/cart-store.js`)
  - Persistent cart storage in localStorage
  - Standard methods: `add()`, `remove()`, `updateQuantity()`, `getTotal()`
- **Views**: Blade templates in `resources/views/` organized by feature
  - Components in `resources/views/components/`
  - Layouts in `resources/views/layouts/`

## Development Workflow

### Local Development Setup
```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate
npm run dev
```

### Database
- Migrations in `database/migrations/`
- Key tables: users, orders, menus
- Use `php artisan migrate:fresh --seed` to reset with sample data

### Testing
- Uses Pest PHP testing framework
- Tests located in `tests/Feature` and `tests/Unit`
- Run tests with `php artisan test`

## Common Patterns & Conventions

### Order Flow
1. Users browse menu categories (buffet/tumpeng/nasibox/snack)
2. Add items to cart (managed by Alpine.js store)
3. Proceed to checkout (`/checkout`)
4. Order creation handled by `OrderController@store`

### Data Validation
- Form requests in `app/Http/Requests/`
- Use Laravel validation rules
- Client-side validation with Alpine.js

### Authentication
- Uses Laravel Breeze with Google OAuth integration
- Social auth handled by `SocialController`
- Protected routes use `auth` middleware

## Integration Points
- Google OAuth for social login
- Local file storage for menu images (`public/foto/`)
- Cart data persisted in localStorage
- Laravel session for user authentication

## Key Files to Review
- `routes/web.php` - All route definitions
- `app/Models/Order.php` - Core order logic
- `resources/js/cart-store.js` - Shopping cart implementation
- `resources/views/checkout.blade.php` - Checkout process
- `app/Http/Controllers/OrderController.php` - Order handling

## Gotchas & Project-Specific Notes
- Menu items require minimum order quantities (usually 50)
- Cart calculations must match between frontend and backend
- Order dates must be validated for future dates only
- Image paths are hardcoded in menu views