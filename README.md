# BW-Laravel
 
admin sidebar code van: https://codepen.io/t7team/pen/bGBzQZZ

vuilbak cart: https://codepen.io/LocalPCGuy/pen/bvVgQJ


Initialiseren
env.text -> copy/paste in nieuw bestand -> .env
key generaten = 'php artisan key:generate'
storage linken aan public = 'php artisan storage:link'

Een database "chiro-webshop" aanmaken
migreren = 'php artisan migrate'
seeders initialiseren = 'php artisan db:seed'

alle gebruikers hebben als wachtwoord: "wachtwoord"

1-to-many relatie: 1 faq categorie kan meedere faq's hebben, maar 1 faq behoort maar tot 1 categorie
many-to-many: 1 product kan meerdere sizes hebben, en een size kan ook meerdere producten hebben