#!/bin/bash

USUARIO="u113268863"
SERVIDOR="92.113.18.199"
PUERTO="65002"
CARPETA_REMOTA="/home/u113268863/domains/inpro.es/public_html/inpro_main/"

echo "Iniciando despliegue de INPRO Landing..."

rsync -avz -e "ssh -p $PUERTO" --exclude '.git/' --exclude '.gitignore' --exclude '.env' --exclude '.env.example' --exclude '.deploy-config' --exclude '.deploy-config.example' --exclude '.vscode/' --exclude '.idea/' --exclude '.cursor/' --exclude 'deploy.sh' --exclude 'inpro/' --exclude 'TODO.md' --exclude 'README.md' --exclude 'vendor/' --exclude 'storage/logs/*.log' --exclude 'node_modules/' ./ $USUARIO@$SERVIDOR:$CARPETA_REMOTA

echo "Despliegue finalizado correctamente."