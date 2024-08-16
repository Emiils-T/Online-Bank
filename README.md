
# Online Bank/Crypto Exchange

[//]: # ([![forthebadge]&#40;data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyMDIuMDMxMjUiIGhlaWdodD0iMzUiIHZpZXdCb3g9IjAgMCAyMDIuMDMxMjUgMzUiPjxyZWN0IHdpZHRoPSIxMDYuNjcxODc1IiBoZWlnaHQ9IjM1IiBmaWxsPSIjYzMyNzI3Ii8+PHJlY3QgeD0iMTA2LjY3MTg3NSIgd2lkdGg9Ijk1LjM1OTM3NSIgaGVpZ2h0PSIzNSIgZmlsbD0iI2E0MGQwZCIvPjx0ZXh0IHg9IjUzLjMzNTkzNzUiIHk9IjIxLjUiIGZvbnQtc2l6ZT0iMTIiIGZvbnQtZmFtaWx5PSInUm9ib3RvJywgc2Fucy1zZXJpZiIgZmlsbD0iI0ZGRkZGRiIgdGV4dC1hbmNob3I9Im1pZGRsZSIgbGV0dGVyLXNwYWNpbmc9IjIiPk1BREUgV0lUSDwvdGV4dD48dGV4dCB4PSIxNTQuMzUxNTYyNSIgeT0iMjEuNSIgZm9udC1zaXplPSIxMiIgZm9udC1mYW1pbHk9IidNb250c2VycmF0Jywgc2Fucy1zZXJpZiIgZmlsbD0iI2Y3ZTllOSIgdGV4dC1hbmNob3I9Im1pZGRsZSIgZm9udC13ZWlnaHQ9IjkwMCIgbGV0dGVyLXNwYWNpbmc9IjIiPkxBUkFWRUw8L3RleHQ+PC9zdmc+&#41;]&#40;https://forthebadge.com&#41;)

[//]: # ([![forthebadge]&#40;data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxNDUuMzc1IiBoZWlnaHQ9IjM1IiB2aWV3Qm94PSIwIDAgMTQ1LjM3NSAzNSI+PHJlY3Qgd2lkdGg9IjEwNi44OTA2MjUiIGhlaWdodD0iMzUiIGZpbGw9IiNkYTJmMmYiLz48cmVjdCB4PSIxMDYuODkwNjI1IiB3aWR0aD0iMzguNDg0Mzc1IiBoZWlnaHQ9IjM1IiBmaWxsPSIjYmEyMTE5Ii8+PHRleHQgeD0iNTMuNDQ1MzEyNSIgeT0iMjEuNSIgZm9udC1zaXplPSIxMiIgZm9udC1mYW1pbHk9IidSb2JvdG8nLCBzYW5zLXNlcmlmIiBmaWxsPSIjRkZGRkZGIiB0ZXh0LWFuY2hvcj0ibWlkZGxlIiBsZXR0ZXItc3BhY2luZz0iMiI+QlVJTFQgV0lUSCA8L3RleHQ+PHRleHQgeD0iMTI2LjEzMjgxMjUiIHk9IjIxLjUiIGZvbnQtc2l6ZT0iMTIiIGZvbnQtZmFtaWx5PSInTW9udHNlcnJhdCcsIHNhbnMtc2VyaWYiIGZpbGw9IiNGRkZGRkYiIHRleHQtYW5jaG9yPSJtaWRkbGUiIGZvbnQtd2VpZ2h0PSI5MDAiIGxldHRlci1zcGFjaW5nPSIyIj7wn6SNPC90ZXh0Pjwvc3ZnPg==&#41;]&#40;https://forthebadge.com&#41;)

This is an online bank/cryptocurrency exchange project built using PHP, Laravel framework, Tailwind CSS, and JavaScript.

## Features
- User Registration & Authentication:

  - Users can register and log in to their accounts securely. 
- Account Management:

  - Create and manage investment and checking accounts.
  - Checking accounts support multiple currencies.
  - Transfer money between accounts, with automatic currency conversion if needed.
  
- Cryptocurrency Trading:

  - Create and manage crypto accounts.
  - Buy and sell cryptocurrencies.
  - Real-time cryptocurrency data from the Coinpaprika API.
Installation
To get started with this project, follow the instructions below.

![Project Demo](public/images/demo.gif)

## Prerequisites
- PHP 8.2
- Composer
- NPM
## 🚀 Getting started

Clone the project

```bash
  git clone https://github.com/Emiils-T/Online-Bank.git
```

Go to the project directory

```bash
  cd path/to/project
  cp .env.example .env
```

Install dependencies

```bash
  composer install
  npm install 
```
Generate application key and migrate the database
```bash
  php artisan key:generate
  php artisan migrate
```

## Deployment

To deploy this project, open up three seperate terminal windows and type in:

- 1
```bash
  php artisan serv
```
- 2
```bash
  npm run dev
```
- 3
```bash
  php artisan schedule:work 
```
Then type http://localhost:8000/ into your broswer. 

## Usage
Once the application is running, you can:

- Register a new account.
- Log in with your credentials.
- Create investment or checking accounts.
- Transfer money between accounts, with automatic currency conversion if applicable.
- Create crypto accounts and trade cryptocurrencies with real-time data from Coinpaprika.

    
