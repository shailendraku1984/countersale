# Laravel 12 Project Rules

## 🧠 Architecture

- Follow Service + Repository pattern
- Controllers must remain thin (only handle request/response)
- Business logic must be in Service layer
- Data access must be in Repository layer

---

## 📦 Code Structure

- Use PSR-4 autoloading
- Follow PSR-12 coding standards
- Use dependency injection (no static calls where avoidable)

---

## 🧩 Controllers

- Do NOT write business logic in controllers
- Always use Form Request for validation
- Return API responses using Resources

---

## 🔐 Authentication & Security

- Do NOT modify existing authentication logic unless explicitly asked
- Always validate input data
- Escape output where necessary
- Follow secure coding practices (XSS, CSRF, SQL Injection prevention)

---

## 🗄️ Database

- Do NOT modify database schema unless explicitly instructed
- Use migrations for schema changes
- Avoid raw queries unless necessary

---

## ⚙️ Services

- Services should contain business logic only
- Keep methods small and testable
- Use clear naming conventions

---

## 📁 Repositories

- Use interfaces for repositories
- Keep database queries inside repositories only

---

## 🚀 API Design

- Follow RESTful principles
- Use proper HTTP status codes
- Use pagination for listing endpoints
- Do NOT expose sensitive fields

---

## ⚡ Performance

- Avoid N+1 queries (use eager loading)
- Use caching where necessary
- Optimize database queries

---

## 🧪 Testing

- Write testable code
- Do not break existing functionality
- Prefer unit-test-friendly design

---

## 🚫 Restrictions

- Do NOT modify unrelated files
- Do NOT rename existing classes/files without instruction
- Do NOT change API response structure
- Do NOT introduce breaking changes

---

## 🎯 Output Expectations

When generating code:
- Provide complete working implementation
- Follow project structure
- Add brief explanation if needed