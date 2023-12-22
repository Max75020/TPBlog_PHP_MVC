<?php

class Autoloader
{
    public static function register()
    {
        spl_autoload_register([__CLASS__, 'autoload']);
    }

    public static function autoload($className)
    {
        $baseDir = dirname(__DIR__);

        // Remplace les antislashs des espaces de noms par des slashs pour correspondre à la structure des dossiers
        $path = str_replace('\\', DIRECTORY_SEPARATOR, $className);

        // Ajoute le suffixe .php pour obtenir le nom du fichier
        $file = $baseDir . DIRECTORY_SEPARATOR . $path . '.php';

        // Vérifie si le fichier existe et est lisible
        if (file_exists($file) && is_readable($file)) {
            require_once $file;
        } else {
            // Gère l'erreur si le fichier de classe n'est pas trouvé
            // Vous pouvez personnaliser cette partie pour afficher un message d'erreur personnalisé ou enregistrer l'erreur dans un fichier de log
            header("HTTP/1.1 500 Internal Server Error");
            echo "Erreur : impossible de charger la classe '$className'. Fichier '$file' introuvable.";
            exit(); // bloque le code
        }
    }
}