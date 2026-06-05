# NaviCargo — Global Cargo Shipping Management System

A full-stack maritime logistics management system built with Laravel and PHP.

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=flat&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-777BB4?style=flat&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=flat&logo=mysql&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-7952B3?style=flat&logo=bootstrap&logoColor=white)

---

## About

NaviCargo is a comprehensive maritime logistics platform built to facilitate, track, and optimize cargo shipping across continents. Developed during an internship at the **ICT Authority of Kenya (ICTA)** as part of the government's digital skills program.

The system integrates all key components of maritime cargo logistics into one platform — ships, crew, ports, cargo, clients, and shipments.

**Modules:**
- **Ship Management** — register ships, track location, manage fleet status
- **Crew Management** — assign crew members to ships, manage roles and activity
- **Port Management** — register ports with coordinates, capacity, and customs status
- **Cargo Management** — create and track cargo records linked to clients
- **Shipment Management** — schedule shipments, track status (Pending, In Transit, Delivered, Delayed)
- **Client Management** — manage client companies and their cargo history

---

## Preview

<img width="1916" height="809" alt="image" src="https://github.com/user-attachments/assets/7c506c22-882a-4a78-a2fe-2bc27c428d91" />

<img width="1920" height="840" alt="image" src="https://github.com/user-attachments/assets/f202f5d3-0ecb-4790-8a19-f1bf5de965ed" />

<img width="1920" height="839" alt="image" src="https://github.com/user-attachments/assets/c99e1411-d9fc-443b-ad88-9f33030c61d4" />

<img width="1920" height="813" alt="image" src="https://github.com/user-attachments/assets/860c1154-5f97-46ea-b6cb-ceda506ec31d" />

<img width="1918" height="841" alt="image" src="https://github.com/user-attachments/assets/a191235a-4fbf-4ee0-9da3-6a1b6809d5db" />


---

## Getting started

```bash
git clone https://github.com/Emmy788/NaviCargo.git
cd NaviCargo
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
```

Then open `http://localhost:8000` in your browser.

---

## Tech stack

- **Backend** — Laravel (PHP)
- **Frontend** — Blade templates, Bootstrap
- **Database** — MySQL

---

## What I learned

- Building a full MVC application with Laravel
- Designing and implementing relational database schemas
- Managing complex model relationships (ships, crew, cargo, shipments)
- Working with Laravel migrations, routes, and controllers
- Developing real-world software under professional supervision

---

## Built at

This project was built as **Internship Project No. 3** during an attachment at the **ICT Authority of Kenya (ICTA)** 🇰🇪

---

## Author

**Emmy** · [GitHub](https://github.com/Emmy788) · [emeraldmwaniga80@gmail.com](mailto:emeraldmwaniga80@gmail.com)
