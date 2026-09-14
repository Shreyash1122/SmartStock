# SMARTSTOCK

SMARTSTOCK is an enterprise-style inventory and warehouse management system for a multi-location electronics business. It demonstrates inventory visibility, warehouse operations, stock transfers, purchase flows, and order fulfilment in a Java full-stack architecture.

## Architecture

```text
React + JavaScript
        ↓
Spring Boot REST API
        ↓
MongoDB
```

The current UI is a responsive React dashboard. The `smartstock-api` folder provides the Spring Boot and MongoDB foundation, including a product resource with validation and CRUD endpoints.

## Core features

- Enterprise dashboard with sales, stock health, low-stock, activity, and transfer summaries.
- Multi-warehouse inventory for Mumbai, Pune, Bangalore, and Delhi.
- Low-stock and reorder-level visibility.
- Stock receipt and inter-warehouse transfer workflows.
- Product catalog search and stock availability snapshots.
- Foundation for suppliers, purchase orders, customer orders, shipments, returns, audit logs, and role-based access control.

## Project structure

```text
frontend/          React + Vite SMARTSTOCK dashboard
smartstock-api/    Spring Boot + MongoDB REST API foundation
```

Older folders at the repository root are retained from previous experiments and are not part of the SMARTSTOCK application.

## Run the frontend

```bash
cd frontend
npm install
npm run dev
```

Open the local URL printed by Vite, normally `http://localhost:5173`.

## Run the API

Requirements: Java 19+ and Maven, plus a local MongoDB instance (or a MongoDB Atlas connection string).

```bash
cd smartstock-api
mvn spring-boot:run
```

The API runs at `http://localhost:8080`. Configure a hosted database by setting `MONGODB_URI`:

```bash
MONGODB_URI=mongodb+srv://<user>:<password>@<cluster>/smartstock
```

## API currently available

| Method | Endpoint | Purpose |
| --- | --- | --- |
| `GET` | `/api/products` | List products |
| `GET` | `/api/products/{id}` | Get one product |
| `POST` | `/api/products` | Create a product |
| `PUT` | `/api/products/{id}` | Update a product |

## Next additions

- JWT authentication and role-based authorization
- Warehouse, supplier, purchase order, and inventory APIs
- Atomic inventory reservations and transaction history
- Stock-transfer lifecycle: requested → approved → in transit → received
- Order, shipment, return, reporting, and low-stock notification modules
