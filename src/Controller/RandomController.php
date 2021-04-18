<?php

namespace App\Controller;

use App\Repository\MovieRepository;
use App\Repository\ShowRepository;
use App\Request\LocaleRequest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncode;
use Symfony\Component\Serializer\SerializerInterface;

class RandomController extends AbstractController
{
    /** @var MovieRepository */
    private $movieRepo;

    /** @var ShowRepository */
    private $showRepo;

    /** @var SerializerInterface */
    private $serializer;

    public function __construct(MovieRepository $movieRepo, ShowRepository $showRepo, SerializerInterface $serializer)
    {
        $this->movieRepo = $movieRepo;
        $this->showRepo = $showRepo;
        $this->serializer = $serializer;
    }

    /**
     * @Route("/random/movie", name="random_movie")
     * @ParamConverter(name="localeParams", converter="locale_params")
     */
    public function movie(LocaleRequest $localeParams)
    {
        $movie = $this->movieRepo->getRandom();

        $context = [
            JsonEncode::OPTIONS => JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE,
            'mode' => 'list',
            'localeParams' => $localeParams,
        ];
        $data = $this->serializer->serialize($movie, 'json', $context);

        return new Response($data, 200, ['Content-Type' => 'application/json']);
    }

    /**
     * @Route("/random/show", name="random_show")
     * @ParamConverter(name="localeParams", converter="locale_params")
     */
    public function show(LocaleRequest $localeParams)
    {
        $show = $this->showRepo->getRandom();

        $context = [
            JsonEncode::OPTIONS => JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE,
            'mode' => 'list',
            'localeParams' => $localeParams,
        ];
        $data = $this->serializer->serialize($show, 'json', $context);

        return new Response($data, 200, ['Content-Type' => 'application/json']);
    }

}
