<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Category;
use App\Entity\User;
use Faker;
use DateTime;
use \joshtronic\LoremIpsum;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create();
        $lipsum = new \joshtronic\LoremIpsum();
        $users = [];

        for($i=0; $i < 50;$i++){
            $user = new User();
            $user->setUsername($faker->name);
            $user->setFirstName($faker->firstName());
            $user->setLastName($faker->lastName());
            $user->setEmail($faker->email);
            $user->setPassword($faker->password());
            $user->setCreatAt(new DateTime());
            $manager->persist($user);
            $users[] = $user;
        }

        $categories = [];

        for($i=0; $i < 15;$i++){
            $category = new Category();
            $category->setTitle($lipsum->words(10));
            $category->setDescription($lipsum->paragraphs(2));
            $category->setCreatAt(new DateTime());

            $manager->persist($category);
            $categories[] = $category;
        }

        $articles = [];

        for($i=0; $i < 15;$i++){
            $article = new Article();
            $article->setTitle($lipsum->words(10));
            $article->setDescription($lipsum->paragraphs(5));
            $article->setCreateAT(new DateTime());
            $article->setAuthor($users[$faker->numberBetween(0,49)]);
            $article->addCategory($categories[$faker->numberBetween(0,14)]);
            $manager->persist($article);
            $articles[] = $article;
        }
        $manager->flush();
    }
}
