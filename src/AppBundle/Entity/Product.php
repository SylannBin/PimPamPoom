<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Product
 *
 * @ORM\Table(name="product")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProductRepository")
 */
class Product
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
     * @var Category
     *
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="products")
     * @ORM\JoinColumn(name="category", referencedColumnName="id")
     */
    private $category;

    /**
     * @var string
     *
     * @ORM\Column(name="label_en", type="string", length=50, nullable=true)
     */
    private $labelEn;

    /**
     * @var string
     *
     * @ORM\Column(name="label_fr", type="string", length=50, nullable=true)
     */
    private $labelFr;

    /**
     * @var string
     *
     * @ORM\Column(name="label_de", type="string", length=50, nullable=true)
     */
    private $labelDe;

    /**
     * @var string
     *
     * @ORM\Column(name="description_en", type="text", nullable=true)
     */
    private $descriptionEn;

    /**
     * @var string
     *
     * @ORM\Column(name="description_fr", type="text", nullable=true)
     */
    private $descriptionFr;

    /**
     * @var string
     *
     * @ORM\Column(name="description_de", type="text", nullable=true)
     */
    private $descriptionDe;

    /**
     * @var string
     *
     * @ORM\Column(name="technical_en", type="text", nullable=true)
     */
    private $technicalEn;

    /**
     * @var string
     *
     * @ORM\Column(name="technical_fr", type="text", nullable=true)
     */
    private $technicalFr;

    /**
     * @var string
     *
     * @ORM\Column(name="technical_de", type="text", nullable=true)
     */
    private $technicalDe;

    /**
     * @var string
     *
     * @ORM\Column(name="price", type="decimal", precision=8, scale=2)
     */
    private $price =0.0;


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
     * Set category
     *
     * @param integer $category
     *
     * @return Product
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return int
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set labelEn
     *
     * @param string $labelEn
     *
     * @return Product
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
     * @return Product
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
     * @return Product
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

    /**
     * Set descriptionEn
     *
     * @param string $descriptionEn
     *
     * @return Product
     */
    public function setDescriptionEn($descriptionEn)
    {
        $this->descriptionEn = $descriptionEn;

        return $this;
    }

    /**
     * Get descriptionEn
     *
     * @return string
     */
    public function getDescriptionEn()
    {
        return $this->descriptionEn;
    }

    /**
     * Set descriptionFr
     *
     * @param string $descriptionFr
     *
     * @return Product
     */
    public function setDescriptionFr($descriptionFr)
    {
        $this->descriptionFr = $descriptionFr;

        return $this;
    }

    /**
     * Get descriptionFr
     *
     * @return string
     */
    public function getDescriptionFr()
    {
        return $this->descriptionFr;
    }

    /**
     * Set descriptionDe
     *
     * @param string $descriptionDe
     *
     * @return Product
     */
    public function setDescriptionDe($descriptionDe)
    {
        $this->descriptionDe = $descriptionDe;

        return $this;
    }

    /**
     * Get descriptionDe
     *
     * @return string
     */
    public function getDescriptionDe()
    {
        return $this->descriptionDe;
    }

    /**
     * Set technicalEn
     *
     * @param string $technicalEn
     *
     * @return Product
     */
    public function setTechnicalEn($technicalEn)
    {
        $this->technicalEn = $technicalEn;

        return $this;
    }

    /**
     * Get technicalEn
     *
     * @return string
     */
    public function getTechnicalEn()
    {
        return $this->technicalEn;
    }

    /**
     * Set technicalFr
     *
     * @param string $technicalFr
     *
     * @return Product
     */
    public function setTechnicalFr($technicalFr)
    {
        $this->technicalFr = $technicalFr;

        return $this;
    }

    /**
     * Get technicalFr
     *
     * @return string
     */
    public function getTechnicalFr()
    {
        return $this->technicalFr;
    }

    /**
     * Set technicalDe
     *
     * @param string $technicalDe
     *
     * @return Product
     */
    public function setTechnicalDe($technicalDe)
    {
        $this->technicalDe = $technicalDe;

        return $this;
    }

    /**
     * Get technicalDe
     *
     * @return string
     */
    public function getTechnicalDe()
    {
        return $this->technicalDe;
    }

    /**
     * Set price
     *
     * @param string $price
     *
     * @return Product
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }
}
