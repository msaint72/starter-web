<?php

namespace App\DataFixtures;

use App\Entity\MicroPost;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder){

        $this->passwordEncoder = $passwordEncoder;
    }
    public function load(ObjectManager $manager)
    {
        $this->loadMicroPosts($manager);
        $this->loadUsers($manager);
    }
    private function loadMicroPosts(ObjectManager  $manager){
        // $product = new Product();
        // $manager->persist($product);
        for($i=0;$i<10;$i++){
            $micropost=new MicroPost();
            $micropost->setText('Some random text' . rand(0,100));
            $micropost->setTime(new \DateTime('1018-03-15'));
            $manager->persist($micropost);
        }
        $manager->flush();
    }
    private function loadUsers(ObjectManager  $manager){
        $user=new User();
        $user->setUsername('john_doe');
        $user->setFullname('john doe');
        $user->setEmail('john@doe.com');
        $user->setPassword($this->passwordEncoder->encodePassword($user,'john12'));
        $manager->persist($user);
        $manager->flush();

        $user=new User();
        $user->setUsername('maho');
        $user->setFullname('mahmut eren');
        $user->setEmail('mah@yah.com');
        $user->setPassword($this->passwordEncoder->encodePassword($user,'maho'));
        $manager->persist($user);
        $manager->flush();

    }
}
