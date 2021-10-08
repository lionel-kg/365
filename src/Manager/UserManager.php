<?php 

namespace App\Manager;
use App\Entity\User;
use App\Entity\Adresse;
use App\Manager\AdresseManager;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\UserRepository;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserManager{
    private $passwordEncoder;
    private $userRepository;
    private $adresseManager;
    private $em;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder, UserRepository $userRepository, AdresseManager $adresseManager,EntityManagerInterface $em){
        $this->passwordEncoder = $passwordEncoder;
        $this->UserRepository = $userRepository;
        $this->adresseManager = $adresseManager;
        $this->em = $em;
    }

    public function prepareForCreate($user, $data){
        $user->setUsername($data['username']);
        $user->setNom($data['nom']);
        $user->setPrenom($data['prenom']);
        $user->setPays($data['pays']);
        $adresse = $this->adresseManager->createAdresse($data['adresse'],$user);
        $user->addAdresse($adresse); 
    }
    public function prepareForEdit($user, $data){
        $user->setNom($data['nom']);
        $user->setPrenom($data['prenom']);
        if(isset($data['adresse'])){
            $adresse = $this->adresseManager->createAdresse($data['adresse'],$user);
            $user->addAdresse($adresse); 
        }
        
    }

    public function createUser($data){
        $user = new User();
        $user->setPassword($this->passwordEncoder->encodePassword($user,$data['password']));
        $this->prepareForCreateAndEdit($user,$data);
        $this->em->persist($user);
        $this->em->flush();
    }

    public function editUser($user, $data){
        $this->prepareForEdit($user,$data);
        $this->em->persist($user);
        $this->em->flush();
    }
}