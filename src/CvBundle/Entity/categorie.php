<?php

namespace CvBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use CvBundle\Entity\texte;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * categorie
 *
 * @ORM\Table(name="categorie")
 * @ORM\Entity(repositoryClass="CvBundle\Repository\categorieRepository")
 */
class categorie {

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
     * @ORM\Column(name="nom", type="string", length=255, unique=true)
     */
    private $nom;


    ////  extern

    /**
     * 
     * 
     * @ORM\ManyToMany(targetEntity="CvBundle\Entity\texte", mappedBy="cat", cascade={"persist"})
     * 
     */
    private $textes;

    public function getTextes() {
        return $this->textes;
    }

    public function setTextes($textes) {
        $this->textes = $textes;
        return $this;
    }

    ////  extern fin

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
     * @return categorie
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

    /**
     * Constructor
     */
    public function __construct() {
        $this->textes = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add texte
     *
     * @param \CvBundle\Entity\texte $texte
     *
     * @return categorie
     */
    public function addTexte(\CvBundle\Entity\texte $texte) {
        $this->textes[] = $texte;

        return $this;
    }

    /**
     * Remove texte
     *
     * @param \CvBundle\Entity\texte $texte
     */
    public function removeTexte(\CvBundle\Entity\texte $texte) {
        $this->textes->removeElement($texte);
    }

}
