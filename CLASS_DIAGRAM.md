# Class Diagram

```mermaid
classDiagram
direction LR

class User {
  +id
  +name
  +email
  +password
  +is_admin
  +phone
  +address
  +orders()
}

class Cart {
  +id
  +user_id
  +items[]
  +user()
}

class Order {
  +id
  +user_id
  +customer_name
  +email
  +package_name
  +total_price
  +payment_status
  +status
  +items[]
  +user()
  +customer()
  +paymentVerifications()
  +latestPaymentVerification()
}

class PaymentVerification {
  +id
  +order_id
  +payment_type
  +amount
  +status
  +verified_by
  +verified_at
  +order()
  +verifyPayment()
  +rejectPayment()
}

class Category {
  +id
  +nama
  +slug
  +deskripsi
  +gambar_url
  +harga_mulai
  +is_active
  +menus()
}

class Menu {
  +id
  +order
  +nama
  +kategori
  +deskripsi
  +harga
  +min_order
  +gambar
  +is_custom
}

class Gallery {
  +id
  +category
  +path
  +caption
  +imageUrl
  +categoryName
}

class BankAccount {
  +id
  +bank_name
  +account_number
  +account_holder
  +is_active
}

class HasOrderStatus <<trait>>

User "1" --> "0..*" Order : owns
User "1" --> "0..1" Cart : has
Cart "1" --> "1" User : belongsTo
Order "1" --> "0..*" PaymentVerification : payment checks
PaymentVerification "1" --> "1" Order : belongsTo
Category "1" --> "0..*" Menu : slug/kategori
Order ..> User : customer() by email
Order ..> HasOrderStatus : uses
```

Notes:
- `Category.menus()` links `categories.slug` to `menus.kategori`.
- `Order.customer()` matches `orders.email` to `users.email`.
- `Gallery` and `BankAccount` are standalone models in this diagram.