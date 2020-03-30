<?php
	
namespace RobinP\classes;

/**
* La classe Entity permet d'hydrater un objet. Cette hydratation va nous permettre de récupérer 
  les données qu'on assignera aux attributs correspondants
* @Author Robin Ponçon
*/

class Entity
{
	// Le constructeur permet de lancer automatiquement des méthodes lors de la création d'un nouvel objet d'une classe
	
	public function __construct(array $donnees)
	{
		$this->hydrate($donnees);
	}

	protected function hydrate(array $donnees)
	{
		foreach ($donnees as $key => $value) 
		{
			// On récupère le nom de setter correspondant à l'attribut (key) + on remplace les "_" par rien.

			$method = "set" . str_replace('_', '', ucwords($key, "_"));

			// On vérifie si la méthode existe.

			if (method_exists($this, $method))
			{
				// Si c'est le cas, on appelle le setter.

				$this->$method($value);
			}
		}
	}
}