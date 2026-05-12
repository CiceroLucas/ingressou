<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# 🎫 Ingressou

A complete event management and digital ticketing system focused on delivering the best user experience, built with high performance, clean design, and premium corporate interfaces.

## Technologies and Architecture

**Ingressou** was designed with a clear separation of backend and frontend responsibilities within the modern Laravel ecosystem, enabling scalability and robustness.

### Integrated Backend — Modern Monolith
- **Framework:** [Laravel 13](https://laravel.com/)
- **Language:** PHP 8.5
- **Database:** MySQL via Eloquent ORM
- **Ticket Generation:** [Simple QrCode](https://www.simplesoftware.io/docs/simple-qrcode) for instant and secure generation of unique keys for each participant.

### Premium Frontend UI/UX
- **Styling:** [Tailwind CSS](https://tailwindcss.com/)
- **Templates:** Laravel Blade Components with modular state.
- **Design System:** Minimalist design focused on high readability. The color palette is based on the *Neutral* spectrum, using shades of graphite, dark graphite, and off-white tones, completely avoiding bright colors to deliver a professional and corporate immersive look.
- **Frontend Gate Validation:** Native QR Code scanner using the [html5-qrcode](https://github.com/mebjas/html5-qrcode) library, optimized to capture readings from both mobile cameras and webcams for real-time check-in.

---

## Main Features

1. **Event Showcase and Calendar:** Open event catalog displayed in high-class card format without visual distractions.
2. **Account System:** User profiles optimized for quick registration.
3. **PDF/Web Ticket Issuance:** Each registration generates a secure ticket page and local print version containing a unique Hash/QR Code.
4. **Administrative Dashboard:** Data control, event listing, and real-time registration management.
5. **Gate Scanner:** Physical validation and entry approval via camera/QR Code.

---

## How to Install and Run the Project

Follow the steps below to set up the local development environment.

### Prerequisites
- **PHP** >= 8.2 — 8.5 recommended according to the stack
- **Composer** installed globally
- **Node.js** & **NPM**
- **MySQL** or MariaDB running locally, such as XAMPP, Laragon, or Docker.

### Step by Step

**1. Clone the repository**
```bash
git clone https://github.com/CiceroLucas/ingressou.git
cd ingressou
