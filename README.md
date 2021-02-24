#Ma superagence  - Projet de test

## Installation
git clone .... 
cd portfolio
composer install
npm install
composer prepare

## Configuration
Créer un fichier `.env.local` :
    dotenv
DATABASE_URL="mysql://DB_USER:DB_PASSWORD@127.0.0.1:3306/portfolio_dev?serverVersion=5.7"

##Démarrer le serveur
symfony serve -d
npm run dev