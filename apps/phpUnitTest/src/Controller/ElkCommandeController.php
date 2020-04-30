<?php


namespace App\Controller;


use App\Entity\LigneCommande;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use FOS\ElasticaBundle\Manager\RepositoryManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
/**
 * @Route("/api/elk/commande")
 */
class ElkCommandeController extends AbstractController
{
    /*
     * @var FOS\ElasticaBundle\Manager\RepositoryManagerInterface
     */
    protected $finder;

    public function __construct(RepositoryManagerInterface $finder)
    {
        $this->finder = $finder;
    }


    /**
     * @Route("/search", name="commande_search")
     */
    public function search(Request $request, PaginatorInterface $paginator)
    {
        //$finder = $this->container->get('fos_elastica.finder.inoubli_elastic.commande');      //in old versions of sf

        // Option 1. Returns all commandes who have 'newProject00event' in any of their mapped fields
        $result1 = $this->finder->getRepository(LigneCommande::class)->find('70');  //where ligneCommande->quantite = 70
        //dd($result1);

        // Option 2. Returns a set of hybrid results that contain all Elasticsearch results
        // and their transformed counterparts. Each result is an instance of a HybridResult
        $result2 = $this->finder->getRepository(LigneCommande::class)->findHybrid('70');
        dd($result2);

        // Option 3b. KnpPaginator resultset
        $result3 = $this->finder->getRepository(LigneCommande::class)->createPaginatorAdapter('70');
        $pagination = $paginator->paginate($result3, $page = 1, 2);
        // dd($result3);
        // dd($pagination);



        $data = json_encode($result2);
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;


    }

//    protected function addFlash()
//    {
//        // Option 3b. KnpPaginator resultset
//        $paginator = $this->get('knp_paginator');
//        $results = $this->finder->getRepository(Commande::class)->createPaginatorAdapter('newProject00event');
//        $pagination = $paginator->paginate($results, $page, 10);
//
//        // You can specify additional options as the fourth parameter of Knp Paginator
//        // paginate method to nested_filter and nested_sort
//
//        $options = [
//            'sortNestedPath' => 'owner',
//            'sortNestedFilter' => new Query\Term(['enabled' => ['value' => true]]),
//        ];
//
//        // sortNestedPath and sortNestedFilter also accepts a callable
//        // which takes the current sort field to get the correct sort path/filter
//
//        $pagination = $paginator->paginate($results, $page, 10, $options);
//
//    }

}