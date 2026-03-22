# UrPocketDigicam - Hybrid Rental & Sales Platform
**Status:** Independent (No Hub Dependency)
**Last Update:** March 22, 2026

## New Features
1. **Hybrid Model:** Supports `Sale`, `Rental`, or `Both` for each camera product.
2. **Rental Management:** New `rentals` table and `RentalController` for booking management.
3. **Availability Tracking:** `is_available` flag to track real-time rental status.
4. **Clean Architecture:** Purged all legacy "API Dosen" (Hub UMKM) dependencies.
5. **UI Updates:** 
   - Sidebar: Added "Rentals" menu.
   - Frontend: Displaying Sale/Rental badges and prices.

## Development Status
- **Models:** Updated `Product`, Created `Rental`.
- **Migrations:** Implemented `add_rental_fields` and `create_rentals_table`.
- **API:** Switched to Standalone API (`/api/products`, `/api/categories`).
- **Storage:** Integrated with Cloudinary for image hosting.

*Prepared for future integration with the PBaaS (Photo Booth as a Service) ecosystem.*
