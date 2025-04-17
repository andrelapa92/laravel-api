#!/bin/bash

set -e  # Para o script se qualquer comando falhar

echo "🔧 Instalando dependências PHP com Composer..."
composer install --no-interaction --prefer-dist --optimize-autoloader

echo "🔧 Rodando migrations..."
php artisan migrate --force

echo "📦 Instalando dependências JS com npm..."
npm install

echo "⚡ Iniciando o Vite em modo desenvolvimento..."
# Rodar o Vite em background e redirecionar logs
npm run dev > /dev/null 2>&1 &

echo "🚀 Iniciando o servidor Laravel..."
php artisan serve --host=0.0.0.0 --port=8000
