<?php

namespace App\Entity;

use App\Entity\Locale\MovieLocale;
use App\Entity\Torrent\MovieTorrent;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MovieRepository")
 */
class Movie extends BaseMedia
{
    /**
     * @var MovieTorrent[]
     * @ORM\OneToMany(targetEntity="App\Entity\Torrent\MovieTorrent", fetch="LAZY", mappedBy="movie")
     * @ORM\OrderBy({"peer" = "DESC"})
     */
    protected $torrents;
    /**
     * @var MovieLocale[]
     * @ORM\OneToMany(targetEntity="App\Entity\Locale\MovieLocale", fetch="LAZY", mappedBy="movie")
     */
    protected $locales;
    /**
     * @var string
     * @ORM\Column(type="string", unique=true)
     */
    protected $imdb;
    /**
     * @var integer
     * @ORM\Column(type="integer")
     */
    protected $tmdb;
    /**
     * @var \DateTime
     * @ORM\Column(type="datetime")
     */
    protected $released;

    //<editor-fold desc="Movie Api Data">
    /**
     * @var string
     * @ORM\Column(type="string")
     */
    protected $trailer;
    /**
     * @var string
     * @ORM\Column(type="string")
     */
    protected $certification;

    public function __construct()
    {
        parent::__construct();
        $this->torrents = new ArrayCollection();
    }

    public function getTorrents()
    {
        return $this->torrents;
    }

    public function getLocales()
    {
        return $this->locales;
    }

    public function getImdb()
    {
        return $this->imdb;
    }

    public function setImdb($imdb)
    {
        $this->imdb = $imdb;
        return $this;
    }

    public function getTmdb()
    {
        return $this->tmdb;
    }

    public function setTmdb($tmdb)
    {
        $this->tmdb = $tmdb;
        return $this;
    }

    public function getReleased()
    {
        return $this->released;
    }

    public function setReleased($released)
    {
        $this->released = $released;
        return $this;
    }

    public function getTrailer()
    {
        return $this->trailer;
    }

    public function setTrailer($trailer)
    {
        $this->trailer = $trailer;
        return $this;
    }

    public function getCertification()
    {
        return $this->certification;
    }

    public function setCertification($certification)
    {
        $this->certification = $certification;
        return $this;
    }
    //</editor-fold>
}
