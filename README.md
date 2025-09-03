# Bookstore System

A full-stack bookstore management system built with PHP, MySQL, HTML, CSS, and JavaScript, containerized with Docker.
ITE 314 Project

First time using Docker hehe

## 🚀 Quick Start

### Prerequisites
- Docker and Docker Compose installed on your system

### Setup Instructions

1. **Clone the repository**
   ```bash
   git clone https://github.com/Soljira/Bookstore-System.git
   cd bookstore-system
   ```

2. **Create environment file**
   ```bash
   cp .env.example .env
   ```

3. **Configure your environment**
   
   Edit `.env` and set your database password:
   ```env
   DB_PASSWORD=your_secure_password_here
   ```

4. **Start the application**
    
    Make sure your terminal is in the same directory as the repo folder, otherwise it'll just
    say `no configuration file provided: not found`
   ```bash
   docker-compose up -d
   ```

5. **Access the application**
   - **Website**: http://localhost:8080
      - Username: root
      - Password: password
   - **Adminer (Database Admin; phpmyadmin alternative)**: http://localhost:8081
     - Server: `mysql`
     - Username: `root`
     - Password: `<your DB_PASSWORD from .env>`
     - Database: `bookstoreDB`