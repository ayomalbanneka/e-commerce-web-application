# Database schema overview

This project uses a MySQL database named `shop` by default (see `connection.php`). There is no migration tool in the repository; create the schema manually or import an SQL dump (if available).

Below is a high‑level map of the entities referenced in the code to guide manual creation.

## Core entities

- users
  - email (PK)
  - fname, lname, password (hashed), mobile, joined_date
  - gender_id (FK -> gender table if present), status_status_id (FK -> status)
- admin
  - email (PK), fname, lname, password (hashed), mobile, joined_date
  - role (e.g., Admin, Moderator), status
  - vcode, l_vcode (verification codes)
- profile_img
  - users_email (FK -> users.email), img_path
- users_has_address
  - users_email (FK -> users.email)
  - address_line_1, address_line_2 (as needed)
  - city_city_id (FK -> city.city_id)
- district
  - district_id (PK), district_name
- city
  - city_id (PK), city_name, district_district_id (FK -> district)

## Catalog

- category
  - cat_id (PK), cat_name
- sub_category
  - sub_cat_id (PK), sub_cat_name
- category_has_sub_category
  - category_cat_id (FK -> category.cat_id)
  - sub_category_sub_cat_id (FK -> sub_category.sub_cat_id)
- brand
  - brand_id (PK), brand_name
- sizes
  - sizes_id (PK), size_name
- color
  - color_id (PK), color_name
- product_collection
  - collection_id (PK), collection_name
- products
  - id (PK), title, price, qty, datetime_added
  - status_status_id (FK -> status), category_cat_id (FK -> category)
  - brand_brand_id (FK -> brand), material_material_id (optional)
- product_img
  - id (PK), img_path, products_id (FK -> products.id)
- products_has_sizes (link)
  - products_id (FK -> products.id), sizes_sizes_id (FK -> sizes)
- products_has_colors (link)
  - products_id (FK -> products.id), color_color_id (FK -> color)

## Commerce

- cart
  - cart_id (PK)
  - cart_users_email (FK -> users.email)
  - cart_products_id (FK -> products.id)
  - cart_qty
- watchlist
  - w_id (PK)
  - users_email (FK -> users.email)
  - products_id (FK -> products.id)
- invoice
  - invoice_id (PK)
  - order_id (unique), date, total, invoice_qty
  - status (enum/int), size, color
  - users_email (FK -> users.email)
  - products_id (FK -> products.id)

## Supporting / lookup

- status (implied by `status_status_id` fields)
  - status_id (PK), status_name (e.g., Active, Inactive, Blocked)
- gender (optional)
  - gender_id (PK), gender_name
- material (optional)
  - material_id (PK), material_name

## Indexing and constraints

- Add indexes on all FK columns (e.g., `cart(cart_users_email)`, `product_img(products_id)`).
- Ensure cascading deletes where appropriate (e.g., deleting a product removes `product_img`, `products_has_*`, `cart` lines).
- Use appropriate numeric types for prices and quantities (`DECIMAL(10,2)` for money; `INT` for counts).

## Notes

- The application code currently builds SQL using string concatenation; prefer prepared statements if you refactor.
- `invoice.status` appears to be an integer lifecycle value (e.g., 1=processing, 2=shipped, 3=delivered, 4=cancelled). Align to your needs.
- Address fields can be adjusted to your locale; only `city` and `district` are referenced explicitly in the code.
