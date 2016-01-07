<?php

namespace CvBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use CvBundle\Entity\skill;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * experience
 *
 * @ORM\Table(name="experience")
 * @ORM\Entity(repositoryClass="CvBundle\Repository\experienceRepository")
 */
class experience {

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
     * @ORM\Column(name="entreprise", type="string", length=255)
     */
    private $entreprise;

    /**
     * @var \DateTime
     * @Assert\DateTime()
     * @ORM\Column(name="date", type="date")
     */
    private $date;

    /**
     * @var \DateTime
     * @Assert\DateTime()
     * @ORM\Column(name="debut", type="date")
     */
    private $debut;

    /**
     * @var \DateTime
     * @Assert\DateTime()
     * @ORM\Column(name="fin", type="date")
     */
    private $fin;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @var boolean
     *
     * @ORM\Column(name="active", type="boolean")
     */
    private $active;




    //// extern

    /**
     * 
     * 
     * @ORM\ManyToMany(targetEntity="CvBundle\Entity\skill", cascade={"persist"}, inversedBy="experiences")
     * 
     */
    private $skills;

    public function getSkills() {
        return $this->skills;
    }

    public function setSkills($skills) {
        $this->skills = $skills;
        return $this;
    }

    //// fin extern

    /**
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set entreprise
     *
     * @param string $entreprise
     *
     * @return experience
     */
    public function setEntreprise($entreprise) {
        $this->entreprise = $entreprise;

        return $this;
    }

    /**
     * Get entreprise
     *
     * @return string
     */
    public function getEntreprise() {
        return $this->entreprise;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return experience
     */
    public function setDate($date) {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate() {
        return $this->date;
    }

    /**
     * Set debut
     *
     * @param \DateTime $debut
     *
     * @return experience
     */
    public function setDebut($debut) {
        $this->debut = $debut;

        return $this;
    }

    /**
     * Get debut
     *
     * @return \DateTime
     */
    public function getDebut() {
        return $this->debut;
    }

    /**
     * Set fin
     *
     * @param \DateTime $fin
     *
     * @return experience
     */
    public function setFin($fin) {
        $this->fin = $fin;

        return $this;
    }

    /**
     * Get fin
     *
     * @return \DateTime
     */
    public function getFin() {
        return $this->fin;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return experience
     */
    public function setDescription($description) {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return experience
     */
    public function setImage($image) {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage() {
        return $this->image;
    }

    /**
     * Set active
     *
     * @param boolean $active
     *
     * @return experience
     */
    public function setActive($active) {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return bool
     */
    public function getActive() {
        return $this->active;
    }

    /**
     * Constructor
     */
    public function __construct() {
        $this->skills = new \Doctrine\Common\Collections\ArrayCollection();
        $this->date = new \DateTime();
//        $this->debut = new \DateTime();
//        $this->fin = new \DateTime();
        $this->active = TRUE;
    }

    /**
     * Add skill
     *
     * @param \CvBundle\Entity\skill $skill
     *
     * @return experience
     */
    public function addSkill(\CvBundle\Entity\skill $skill) {
        $this->skills[] = $skill;

        return $this;
    }

    /**
     * Remove skill
     *
     * @param \CvBundle\Entity\skill $skill
     */
    public function removeSkill(\CvBundle\Entity\skill $skill) {
        $this->skills->removeElement($skill);
    }

}
