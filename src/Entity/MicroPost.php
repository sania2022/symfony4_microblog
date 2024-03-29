<?php

namespace App\Entity;

use App\Repository\MicroPostRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MicroPostRepository::class)
 */
class MicroPost
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string",length=280)
     */
    private $text;
    /**
     * @ORM\Column(type="datetime")
     */
    private $time;
   //
   public function getId(){
        return $this->id;
   }
    public function getText(){
            return $this->text;
    }
    public function setText($text):void{
            $this->text=$text;
    }

    public function getTime(){
        return $this->time;
    }
    public function setTime($time):void{
        $this->time=$time;
    }
}
