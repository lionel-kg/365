<?php 

namespace App\Manager;
use App\Entity\Adresse;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;

class AdresseManager{

    private $AdresseRepository;
    private $em;

    public function __construct(UserRepository $AdresseRepository, EntityManagerInterface $em)
    {
        $this->AdresseRepository = $AdresseRepository;
        $this->em = $em;
    }

    public function createAdresse($data,$user){
        $adresse = new Adresse();
        $adresse->setRue($data['rue']);
        $adresse->setCodePostale($data['cp']);
        $adresse->setVille($data['ville']);
        $adresse->setUser($user);
        $this->em->persist($adresse);
        $this->em->flush();

        return $adresse;
    }
}