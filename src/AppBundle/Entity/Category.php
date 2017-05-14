<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Category
 *
 * @ORM\Table(name="category")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CategoryRepository")
 */
class Category
{
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
     * @ORM\Column(name="label_en", type="string", length=50)
     */
    private $labelEn;

    /**
     * @var string
     *
     * @ORM\Column(name="label_fr", type="string", length=50)
     */
    private $labelFr;

    /**
     * @var string
     *
     * @ORM\Column(name="label_de", type="string", length=50)
     */
    private $labelDe;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set labelEn
     *
     * @param string $labelEn
     *
     * @return Category
     */
    public function setLabelEn($labelEn)
    {
        $this->labelEn = $labelEn;

        return $this;
    }

    /**
     * Get labelEn
     *
     * @return string
     */
    public function getLabelEn()
    {
        return $this->labelEn;
    }

    /**
     * Set labelFr
     *
     * @param string $labelFr
     *
     * @return Category
     */
    public function setLabelFr($labelFr)
    {
        $this->labelFr = $labelFr;

        return $this;
    }

    /**
     * Get labelFr
     *
     * @return string
     */
    public function getLabelFr()
    {
        return $this->labelFr;
    }

    /**
     * Set labelDe
     *
     * @param string $labelDe
     *
     * @return Category
     */
    public function setLabelDe($labelDe)
    {
        $this->labelDe = $labelDe;

        return $this;
    }

    /**
     * Get labelDe
     *
     * @return string
     */
    public function getLabelDe()
    {
        return $this->labelDe;
    }
}

