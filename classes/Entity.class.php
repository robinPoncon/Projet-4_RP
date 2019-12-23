<?php
	
namespace RobinP\classes;

class Entity
{
	public function __construct(array $donnees)
	{
		$this->hydrate($donnees);
	}

	protected function hydrate(array $donnees)
	{
		foreach ($donnees as $key => $value) 
		{
			// On récupère le nom de setter correspondant à l'attribut (key).

			$method = "set" . ucfirst($key);

			// On vérifie si la méthode existe.

			if (method_exists($this, $method))
			{
				// Si c'est le cas, on appelle le setter.

				$this->$method($value);
			}
		}
	}
}