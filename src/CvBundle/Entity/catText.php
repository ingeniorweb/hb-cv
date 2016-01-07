<?php

namespace CvBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use CvBundle\Entity\txt;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * catText
 *
 * @ORM\Table(name="cat_text")
 * @ORM\Entity(repositoryClass="CvBundle\Repository\catTextRepository")
 */
class catText {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;


    ////  extern

    /**
     * 
     * 
     * @ORM\OneToOne(targetEntity="CvBundle\Entity\txt", cascade={"persist"})
     * 
     */
    private $text;

    public function getText() {
        return $this->text;
    }

    public function setText($text) {
        $this->text = $text;
        return $this;
    }

    /// fin extern

    /**
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return catText
     */
    public function setNom($nom) {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom() {
        return $this->nom;
    }

    public function __construct() {
        $this->text = new txt;
    }

}
