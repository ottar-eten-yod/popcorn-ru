<?php

namespace App\Entity\Locale;

use App\Entity\BaseMedia;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Movie;

/**
 * @ORM\Entity()
 */
class MovieLocale extends BaseLocale
{
    /**
     * @var Movie
     * @ORM\ManyToOne(targetEntity="App\Entity\Movie", inversedBy="locales")
     * @ORM\JoinColumn(name="media_id")
     */
    protected $media;
    public function getMedia(): BaseMedia { return $this->media; }
    public function setMedia(BaseMedia $media): self { $this->media = $media; return $this; }
}
