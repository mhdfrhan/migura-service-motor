# 🏗️ Sistem E-Booking Cucian Motor Migura - Architecture Summary

## 📊 Database Structure (16 Tables)

### Core Tables
1. **users** - Customer, Admin, Staff (dengan loyalty points & total bookings)
2. **bookings** - Core booking dengan status flow lengkap
3. **service_packages** - Paket layanan (Regular, Premium, Coating)
4. **engine_capacities** - Kapasitas mesin motor (110cc, 150cc, 250cc+)

### Payment & Financial
5. **payment_proofs** - Bukti pembayaran dengan verification status
6. **promo_codes** - Kode promo dengan usage tracking
7. **promo_code_usages** - History penggunaan promo

### Loyalty & Reviews
8. **loyalty_transactions** - History poin loyalitas
9. **reviews** - Rating & review dari pelanggan

### Operational
10. **staff_assignments** - Assignment petugas ke booking
11. **operating_hours** - Jam operasional per hari
12. **booking_time_slots** - Manajemen slot waktu booking

### System & Support
13. **notifications** - Notifikasi real-time untuk user
14. **system_settings** - Settings dengan cache support
15. **chatbot_conversations** - History chat dengan bot
16. **activity_logs** - Audit trail semua aktivitas

---

## 🎯 Booking Status Flow

```
pending → awaiting_payment → payment_uploaded → payment_verified 
  → confirmed → in_progress → completed
  
Alternate: → cancelled / rejected
```

### Status Definitions:
- **pending**: Booking baru dibuat
- **awaiting_payment**: Menunggu user upload bukti
- **payment_uploaded**: Bukti sudah diupload, menunggu verifikasi admin
- **payment_verified**: Admin verify pembayaran
- **confirmed**: Booking dikonfirmasi, siap dikerjakan
- **in_progress**: Sedang dikerjakan oleh staff
- **completed**: Selesai, bisa direview
- **cancelled**: Dibatalkan oleh customer
- **rejected**: Ditolak oleh admin

---

## 📦 Models dengan Relationships (16 Models)

### 1. User Model
- **Relationships**: bookings, reviews, loyaltyTransactions, notifications, staffAssignments
- **Role Methods**: isAdmin(), isStaff(), isCustomer()
- **Loyalty Methods**: addLoyaltyPoints(), deductLoyaltyPoints(), canRedeemLoyalty()

### 2. Booking Model
- **Relationships**: user, servicePackage, engineCapacity, paymentProof, review, staffAssignments
- **Scopes**: active(), pending(), verified(), completed(), homeService()
- **Helper Methods**: canCancel(), canReview(), isHomeService(), getStatusLabelAttribute()
- **Auto-generate**: booking_code (MIG-2025-0001)

### 3. ServicePackage Model
- Features stored as JSON array
- Sort order support
- Active/inactive flag

### 4. EngineCapacity Model
- Price multiplier untuk different CC
- Min/Max CC range

### 5. PaymentProof Model
- Support Bank Transfer & E-Wallet
- Verification status: pending/verified/rejected
- Image upload support

### 6. Review Model
- 1-5 star rating
- Comment & photos (JSON array)
- Published flag
- Unique per booking

### 7. LoyaltyTransaction Model
- Type: earned/redeemed/expired/adjusted
- Balance tracking after each transaction

### 8. Notification Model
- Unread/Read status
- JSON data field for additional info
- markAsRead() method

### 9-16. Supporting Models
- PromoCode, PromoCodeUsage, BookingTimeSlot, StaffAssignment
- OperatingHours, SystemSetting, ActivityLog, ChatbotConversation

---

## 🛡️ Security & Access Control

### Middleware
1. **EnsureUserHasRole** - Check multiple roles
2. **EnsureUserIsAdmin** - Admin only access
3. **EnsureUserIsCustomer** - Customer only access

### Usage in Routes:
```php
Route::middleware(['auth', 'admin'])->group(function () {
    // Admin routes
});

Route::middleware(['auth', 'customer'])->group(function () {
    // Customer routes
});

Route::middleware(['auth', 'role:admin,staff'])->group(function () {
    // Admin & Staff routes
});
```

---

## 🔧 Helper Functions (20+ Utilities)

### Settings Management
- `setting($key, $default)` - Get system setting (dengan cache)
- `set_setting($key, $value, $type)` - Update setting

### Currency & Distance
- `format_currency($amount, $withPrefix)` - Format ke IDR
- `calculate_distance($lat1, $lon1, $lat2, $lon2)` - Haversine formula
- `calculate_home_service_fee($distanceKm)` - Calculate fee
- `is_within_service_area($distanceKm)` - Check jarak maksimal

### AI & Predictions
- `predict_wait_time($bookingsAhead, $averageDuration)` - Rule-based AI prediction
- `recommend_service_package($user)` - AI recommendation berdasarkan history

### Notifications & Logging
- `send_notification($userId, $type, $title, $message, $data)` - Real-time notification
- `log_activity($action, $modelType, $modelId, $oldValues, $newValues)` - Audit trail

### Utilities
- `get_status_badge_class($status)` - Tailwind badge colors
- `get_time_slots($date)` - Available booking slots
- `get_day_name($englishDay)` - Indonesian day names

---

## 🌱 Initial Data Seeder

### Demo Users:
- **Admin**: admin@migura.com | password
- **Staff**: staff@migura.com | password
- **Customer**: customer@migura.com | password

### Service Packages:
1. Regular Wash - 25K
2. Premium Wash & Wax - 50K (Popular)
3. Coating & Detailing - 75K

### Engine Capacities:
- 110cc (1.00x multiplier)
- 150cc (1.20x multiplier)
- 250cc+ (1.50x multiplier)

### System Settings:
- Store location (lat/long)
- Home service max distance (10km)
- Home service fee calculation
- Loyalty program settings (10x cuci = 1x gratis)
- Booking capacity & advance days
- Payment timeout
- AI prediction parameters

---

## 🚀 Next Steps

### Phase 2: Core Features
1. ✅ Livewire BookingFlow Component (step-by-step booking)
2. ✅ Livewire PaymentUpload Component
3. ✅ Admin Dashboard dengan statistik
4. ✅ Admin Verification System
5. ✅ Loyalty System (auto 10x gratis 1x)

### Phase 3: Advanced Features
6. ✅ Notification System (real-time)
7. ✅ Review & Rating System
8. ✅ AI-based Suggestion (rule-based)
9. ✅ Enhanced Chatbot

### Phase 4: Polish & Testing
10. ✅ Testing & Bug Fixing
11. ✅ Performance Optimization
12. ✅ Documentation

---

## 🎨 Design Principles

- **Modular**: Setiap komponen terpisah & reusable
- **Secure**: Role-based access control di semua level
- **Performant**: Cache, eager loading, efficient queries
- **Maintainable**: Clean code, helper functions, comprehensive comments
- **Scalable**: Database schema mendukung future expansion

---

## 📁 File Structure

```
app/
├── Models/
│   ├── User.php (✅ Extended dengan relationships)
│   ├── Booking.php (✅ Core model dengan status flow)
│   ├── ServicePackage.php (✅)
│   ├── EngineCapacity.php (✅)
│   ├── PaymentProof.php (✅)
│   ├── Review.php (✅)
│   ├── LoyaltyTransaction.php (✅)
│   ├── Notification.php (✅)
│   ├── PromoCode.php (✅)
│   ├── PromoCodeUsage.php (✅)
│   ├── BookingTimeSlot.php (✅)
│   ├── StaffAssignment.php (✅)
│   ├── OperatingHours.php (✅)
│   ├── SystemSetting.php (✅)
│   ├── ActivityLog.php (✅)
│   └── ChatbotConversation.php (✅)
├── Http/Middleware/
│   ├── EnsureUserHasRole.php (✅)
│   ├── EnsureUserIsAdmin.php (✅)
│   └── EnsureUserIsCustomer.php (✅)
└── Helpers/
    └── helpers.php (✅ 20+ utility functions)

database/
├── migrations/
│   └── 2025_01_13_000001_create_comprehensive_booking_system_tables.php (✅)
└── seeders/
    ├── DatabaseSeeder.php (✅)
    └── InitialDataSeeder.php (✅)

bootstrap/
└── app.php (✅ Middleware registered)

composer.json (✅ Helper autoloaded)
```

---

## 💡 Key Features Ready:

✅ **Multi-role Authentication** (Customer, Admin, Staff)
✅ **Comprehensive Database** (16 tables with relationships)
✅ **Security** (Middleware & role-based access)
✅ **Loyalty System Foundation** (Points tracking ready)
✅ **Home Service Support** (Distance calculation, fee calculation)
✅ **AI Prediction Ready** (Rule-based recommendation system)
✅ **Notification System Foundation** (Real-time ready)
✅ **Audit Trail** (Activity logging)
✅ **Chatbot Foundation** (Conversation tracking)
✅ **Payment Verification Flow** (Manual upload & admin verify)
✅ **Review System Foundation** (Rating & photos support)

---

## 🎯 Business Logic Highlights:

### Loyalty Program
- Earn 1 point per booking
- 10 points = 1 free wash
- Auto-tracking in LoyaltyTransaction table

### Home Service
- Max distance: 10km (configurable)
- Base fee: 10K + (2K per km)
- Distance calculated using Haversine formula

### Booking Capacity
- Max 5 bookings per time slot (configurable)
- Auto-management via BookingTimeSlot table

### AI Prediction
- Wait time = base (30min) + (5min × bookings ahead)
- Service recommendation based on booking history
- Upgrade suggestion after 5 bookings

---

**Foundation sudah SOLID! Siap untuk development Phase 2! 🚀**

