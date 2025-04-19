# Milestar Landing Page 🚀

This project is a Dockerized Laravel-based landing page for **Milestar Trade and Export Limited**, focused on wheat brokerage operations.

## 🧱 Project Structure

```
.
├── app/                  # Laravel Application (public, routes, etc.)
├── docker-compose.yml   # Docker config for PHP, MySQL, NGINX proxy
├── nginx/               # Custom NGINX config (used in local setup)
├── deploy.sh            # Script to update app directory on the server
└── README.md            # You're here :)
```

## 🐳 Local Development

1. Clone the repo:
   ```bash
   git clone https://github.com/EmmanuelFame/fame-landing-page.git
   cd fame-landing-page
   ```

2. Start the local containers:
   ```bash
   docker compose up --build
   ```

3. Access:
   - Site: [http://localhost](http://localhost)
   - phpMyAdmin: [http://localhost:8082](http://localhost:8082)

## 🚀 Deployment Workflow (to VPS)

This method syncs only the `app/` folder to the server.

### 1. Make local changes

Edit files inside the `app/` directory as needed.

### 2. Commit and push

```bash
git add .
git commit -m "✨ Update something cool"
git push
```

### 3. SSH into your server

```bash
ssh root@vm733063.vps.masterhost.tech
cd fame-dev
./deploy.sh
```

Your changes will instantly reflect live on [https://milestarexim.ru](https://milestarexim.ru)!

## 📂 Git Ignore Strategy

`.gitignore` includes:

- `vendor/`, `node_modules/`, and backup folders
- `.env`, logs, and Docker override files
- DB volumes like `db_data/`

## ✉️ Contact

Built with ❤️ by [Emmanuel Fame](https://github.com/EmmanuelFame)