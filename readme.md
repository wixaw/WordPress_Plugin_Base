# Squelette de plugin WordPress
Fonctionne avec WordPress 5 

## Configuration
### nom du plugin
- Remplacer plugin-name, pluginName, plugin_name 
- Renommer le dossier plugin-name/ et le fichier plugin-name.php

### autoupdate
- Mettre le update.php dans un dossier hors WP  + generer un .zip

### Appel via bloc gutenberg 
- Active la fonctionnalité Expérimentale : ( elle devrait arrivé bientôt en stable ) 
- Gutenberg -> Expérimentaux -> Widgets
- Edit Page -> ajouter un bloc -> Widget hérité -> plugin-name

## Autres
### i18n et problème 
- Je suis obligé d'init les traduction avec la CLI de WP, de modifier ceci avec poedit, et de mettre le contenu dans wp-content/languages/plugins/*
- Si quelqu'un à une autre solution, ne serait-ce que pour avoir le répertoire de langue au sein du répertoire du plugin. Ceci facilitera les autoupdates
