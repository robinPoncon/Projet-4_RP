<?php

//use \RobinP\model\CommentManager;
//use \RobinP\model\PostManager;
//use \RobinP\model\Manager;

	class Autoloader
	{
		/*

		* Fonction qui sert à charger automatiquement les classes de la méthode autoload,
		  pour éviter de mettre require à chaque classe que l'on souhaite utiliser

		*/

		static function register()
		{
			spl_autoload_register(array(__CLASS__, "autoload"));
		}

		/*

		* @param $class_name String - Fonction qui sert à appeler n'importe quelle classe du projet

		*/

		static function autoload($class_name)
		{
			if (file_exists("model/" . $class_name . ".class.php"))
			{
				require "model/" . $class_name . ".class.php";
			}

			else if (file_exists("classes/" . $class_name . ".class.php"))
			{
				require "classes/" . $class_name . ".class.php";
			}

			else
			{
				throw new Exception("Aucune classe trouvée sous ce nom de fichier, vérifier le nom de la classe");
			}
		}
	}

?>