"# 365" 

1. Git clone

   		$ git clone https://github.com/lionel-kg/365.git

2. installer les dépendances si besoin
   
		$ composer install
     
3. créer la BD

  - Dupliquer le fichier .env et le renommer en .env.local
  
  - modifier la ligne DATABASE_URL
  
  - créer la bd a l'aide de la commande
      
		$ bin/console doctrine:schema:create



