<?php

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 * @ORM\Table(name="product")
 */
class Product
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $name;

    /**
     * @ORM\Column(type="integer")
     */
    protected $quantity;

    /**
     * @ORM\Column(type="decimal", scale=2)
     */
    protected $base_price;

    /**
     * @ORM\Column(type="decimal", scale=2)
     */
    protected $price;

    /**
     * @ORM\Column(type="text")
     */
    protected $description;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $avaliable;

    /**
     * @ORM\Column(type="date")
     */
    protected $avaliable_from;

    /**
     * @ORM\Column(type="date")
     */
    protected $avaliable_until;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $photo;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $external_url;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Product
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set quantity
     *
     * @param integer $quantity
     *
     * @return Product
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return integer
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set basePrice
     *
     * @param string $basePrice
     *
     * @return Product
     */
    public function setBasePrice($basePrice)
    {
        $this->base_price = $basePrice;

        return $this;
    }

    /**
     * Get basePrice
     *
     * @return string
     */
    public function getBasePrice()
    {
        return $this->base_price;
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

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Product
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set avaliable
     *
     * @param boolean $avaliable
     *
     * @return Product
     */
    public function setAvaliable($avaliable)
    {
        $this->avaliable = $avaliable;

        return $this;
    }

    /**
     * Get avaliable
     *
     * @return boolean
     */
    public function getAvaliable()
    {
        return $this->avaliable;
    }

    /**
     * Set avaliableFrom
     *
     * @param \DateTime $avaliableFrom
     *
     * @return Product
     */
    public function setAvaliableFrom($avaliableFrom)
    {
        $this->avaliable_from = $avaliableFrom;

        return $this;
    }

    /**
     * Get avaliableFrom
     *
     * @return \DateTime
     */
    public function getAvaliableFrom()
    {
        return $this->avaliable_from;
    }

    /**
     * Set avaliableUntil
     *
     * @param \DateTime $avaliableUntil
     *
     * @return Product
     */
    public function setAvaliableUntil($avaliableUntil)
    {
        $this->avaliable_until = $avaliableUntil;

        return $this;
    }

    /**
     * Get avaliableUntil
     *
     * @return \DateTime
     */
    public function getAvaliableUntil()
    {
        return $this->avaliable_until;
    }

    /**
     * Set photo
     *
     * @param string $photo
     *
     * @return Product
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get photo
     *
     * @return string
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set externalUrl
     *
     * @param string $externalUrl
     *
     * @return Product
     */
    public function setExternalUrl($externalUrl)
    {
        $this->external_url = $externalUrl;

        return $this;
    }

    /**
     * Get externalUrl
     *
     * @return string
     */
    public function getExternalUrl()
    {
        return $this->external_url;
    }
}
