# SchoolProject - School Sponsorship & Educational Funding Platform

A comprehensive full-stack web application that facilitates connections between schools, students in need of financial support, and sponsors/donors willing to fund their education. The platform enables systematic tracking of sponsorships, student performance, and fund management.

## 📋 Table of Contents

- [Project Purpose](#project-purpose)
- [Business Model & Workflows](#business-model--workflows)
- [Technical Architecture](#technical-architecture)
- [Key Features](#key-features)
- [Project Structure](#project-structure)
- [Getting Started](#getting-started)
- [Security](#security)

## 🎯 Project Purpose

This platform connects three key stakeholders:

1. **Schools** - Institutions that register students needing financial support
2. **Students** - Individuals seeking educational sponsorship
3. **Sponsors/Donors** - Individuals or organizations willing to fund students' education

The system automates sponsorship matching, performance tracking, and fund management across all stakeholders.

## 💼 Business Model & Workflows

### Schools
- Register and manage their institution
- Upload student data via CSV for bulk registration
- Track student marks and academic performance
- Create and manage sponsorship requests for individual students
- Monitor which students have active sponsors and funding status
- Access comprehensive school dashboard with student management

### Students
- Register with their school
- Receive and accept sponsorship offers from donors
- View sponsorship information and funded status
- Track personal academic performance
- Mandatory password reset on first login for security
- Access personal student dashboard

### Sponsors/Donors
- Browse and select students to sponsor
- Monitor real-time performance of sponsored students
- View wallet balance and transaction history
- Manage multiple student sponsorships simultaneously
- Access comprehensive sponsor portal featuring:
  - **My Students**: View all currently sponsored students
  - **Performance View**: Track academic progress and reports
  - **Wallet View**: Manage funds and review transaction history

## 🏗️ Technical Architecture

### Frontend (Vue 3 + TypeScript + Vite)

**Authentication & Security:**
- JWT-based authentication system
- Multi-role access control (Schools, Students, Sponsors)
- Route guards that prevent unauthorized access
- Role-based route redirects
- First-login password reset requirement for students

**State Management:**
- Pinia stores for:
  - Authentication state (`auth.ts`)
  - School data (`school.ts`)
  - Sponsor data (`sponsor.ts`)
  - Application counter (`counter.ts`)

**API Integration:**
- Axios-based HTTP client with centralized configuration
- JWT token management
- Error handling

**Testing:**
- Cypress for end-to-end testing
- Vitest for unit testing

**Project Structure:**
```
client/
├── src/
│   ├── components/        # Reusable Vue components
│   ├── layouts/          # Page layouts (School, Sponsor, Student)
│   ├── views/            # Page components for different user types
│   ├── router/           # Vue Router configuration with guards
│   ├── stores/           # Pinia state management
│   ├── api/              # Axios configuration
│   ├── assets/           # CSS and static assets
│   └── types/            # TypeScript type definitions
├── cypress/              # E2E tests
└── package.json          # Frontend dependencies
```

### Backend (Laravel with JWT)

**Authentication & Multi-User Support:**
- JWT token-based authentication
- Separate authentication tables for each user type (schools, students, sponsors)
- Email-based password reset with token verification
- Session management

**Core Features:**
- RESTful API endpoints for all entities
- Email notifications (first-login password reset)
- File upload support for CSV bulk operations
- CORS configuration for client communication

**Database Models:**
- **Schools**: Institution information and metadata
- **Students**: Personal information, academic records, sponsorship status
- **Sponsors**: Donor profiles and sponsorship history
- **Sponsorship Requests**: Funding requests from schools for specific students
- **Performance Data**: Student marks and academic tracking
- **Password Reset Tokens**: Email-verified password resets
- **Sessions**: User session management

**Project Structure:**
```
server/
├── app/
│   ├── Http/Controllers/     # API endpoints
│   ├── Models/               # Database models
│   └── Notifications/        # Email notifications
├── config/                   # Laravel configuration
├── database/
│   ├── migrations/           # Database schema
│   ├── factories/            # Data factories for testing
│   └── seeders/              # Database seeders
├── routes/
│   ├── api.php              # API routes
│   ├── web.php              # Web routes
│   └── console.php          # Console commands
├── resources/               # Email templates, views
└── tests/                   # Feature and unit tests
```

## 🔑 Key Features

### Authentication & Authorization
| Route | User Type | Purpose |
|-------|-----------|---------|
| `/school-auth` | School | School login |
| `/donor-auth` | Sponsor | Sponsor/Donor login |
| `/student-auth` | Student | Student login |
| `/reset-password/:token` | Student | Email-verified password reset |

### School Portal
| Route | Purpose |
|-------|---------|
| `/school-dashboard` | Main school dashboard |
| `/school-dashboard/students` | Manage and view registered students |
| `/school-dashboard/uploads` | Upload student data (CSV bulk import) |

### Student Portal
| Route | Purpose |
|-------|---------|
| `/student-dashboard` | Personal student dashboard |

### Sponsor Portal
| Route | Purpose |
|-------|---------|
| `/sponsor-portal` | Main sponsor dashboard |
| `/my-students` | View all sponsored students |
| `/performance` | Track student academic performance |
| `/my-wallet` | Manage sponsorship funds |

### Bulk Operations
- **CSV Import**: Schools can upload student registrations in bulk
- **Performance Data**: Upload student marks and academic records in bulk

## 🔐 Security Implementation

- **JWT Authentication**: Secure token-based authentication
- **Role-Based Access Control**: Route guards enforce user role permissions
- **Email Verification**: Password resets require email verification
- **Multi-Auth Tables**: Separate authentication systems for different user types
- **Session Management**: Secure session handling
- **CORS Protection**: Configured CORS for safe client-server communication

## 🚀 Getting Started

### Prerequisites
- Node.js (v16+)
- PHP 8.1+
- Composer
- MySQL/MariaDB

### Frontend Setup
```bash
cd client
npm install
npm run dev
```

### Backend Setup
```bash
cd server
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
```

## 📊 Data Models

- **Schools**: Institution details and configuration
- **Students**: Personal info, grades, sponsorship status
- **Sponsors**: Donor profiles and preferences
- **Sponsorship Requests**: Matching between students and available sponsorships
- **Performance Records**: Academic marks and progress tracking

## 📝 CSV Data Formats

### Student Registration
```csv
name,email,registration_number,school_id
John Doe,john@example.com,REG001,1
Jane Smith,jane@example.com,REG002,1
```

### Student Marks
```csv
registration_number,subject,marks,term
REG001,Mathematics,85,1
REG001,English,90,1
```

## 📄 License

[Add your license information here]

## 👥 Contributors

[Add contributor information here]
