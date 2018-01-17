<?php

namespace OC\PlatformBundle\Controller;

use OC\PlatformBundle\Entity\Affectation;
use OC\PlatformBundle\Entity\Categorie;
use OC\PlatformBundle\Entity\Commercial;
use OC\PlatformBundle\Entity\Places;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use OC\PlatformBundle\Entity\Zone;
use OC\PlatformBundle\Entity\Limite;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;



class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('OCPlatformBundle:Default:index.html.twig', array('name' => $name));
    }

    public function carteAction()
    {
        //on récupére la requete
        $request = $this->get('request');
        $em = $this->getDoctrine()->getManager();

        // Lister le nom des zones dans la balise select
        $listeZones = $em->getRepository('OCPlatformBundle:Zone')->findAll();
        foreach ($listeZones as $zone) {
            $zone->getNom().'<br/>';
        }

        $listeCategorie = $em->getRepository('OCPlatformBundle:Categorie')->findAll();
        foreach ($listeCategorie as $categorie) {
            $categorie->getNomc().'<br/>';
        }

        $listeCommercial = $em->getRepository('OCPlatformBundle:Commercial')->findAll();
        foreach ($listeCommercial as $commercial) {
            $commercial->getNom().' '.$commercial->getPrenom().'<br/>';
        }

        // Lister la liste des Evenements
        $listeEvenement = $em->getRepository('OCPlatformBundle:Affectation')->findAll();
        foreach ($listeEvenement as $evenement){
            $evenement->getEvent().'<br/>';
        }

        if($request->getMethod() == 'POST'){
            // Partie Zone
            $zone = new Zone();
            $nom = $request->get('nom');
            $zone->setNom($nom);

            // Partie Limite
            $strzonelimites = $request->get('strzonelimites');
            $points = split("###",$strzonelimites);
            //var_dump($points);
            foreach ($points as $key => $point) {
                $tab = split("_",$point);
                $latitude = $tab[0];
                $longitude = $tab[1];

                $limite = new Limite();
                $limite->setLatitude($latitude);
                $limite->setLongitude($longitude);
                $limite->setZone($zone);
                $em->persist($limite);
            }

            $em->persist($zone);
            $em->flush();
        }

        return $this->render('OCPlatformBundle:Default:carte.html.twig',
            array(
                'listeZones'=>$listeZones,
                'listeCategorie'=>$listeCategorie,
                'listeCommercial'=>$listeCommercial,
                'listeEvenement'=>$listeEvenement)
        );
    }

    public function limitezoneAction(){

        $request = $this->getRequest();
        $em = $this->getDoctrine()->getManager();
        $id = $request->get('id');

        $zone = $em->getRepository('OCPlatformBundle:Zone')->find($id);

        if($zone==null){
            $response = new Response();
            $response->headers->set('Content-Type','application/json');
            $response->setContent(json_encode($zone->getNom()));
            return $response;
        }

        $elem = $zone->getLimite();
        $tabElem = array();
        $i=0;
        foreach($elem as $elements){
            $tabElem[$i]['latitude'] = $elements->getLatitude();
            $tabElem[$i]['longitude'] = $elements->getLongitude();
            $i++;
        }

        $response = new Response();
        $donnees = json_encode($tabElem);
        $response->headers->set('Content-Type','application/json');
        $response->setContent($donnees);

        return $response;
    }

    // Ajouter une Catégorie
    public function addCategorieAction()
    {
        $request = $this->get('request');
        $em = $this->getDoctrine()->getManager();

        // Lister le nom des Catégories dans le select
        $listeCategorie = $em->getRepository('OCPlatformBundle:Categorie')->findAll();
        foreach ($listeCategorie as $categorie) {
            $categorie->getNomc().'<br/>';
        }
        // Lister le nom des zones dans la balise select
        $listeZones = $em->getRepository('OCPlatformBundle:Zone')->findAll();
        foreach ($listeZones as $zone) {
            $zone->getNom().'<br/>';
        }

        $listeCommercial = $em->getRepository('OCPlatformBundle:Commercial')->findAll();
        foreach ($listeCommercial as $commercial) {
            $commercial->getNom().' '.$commercial->getPrenom().'<br/>';
        }

        // Lister la liste des Evenements
        $listeEvenement = $em->getRepository('OCPlatformBundle:Affectation')->findAll();
        foreach ($listeEvenement as $evenement){
            $evenement->getEvent().'<br/>';
        }

            //$request->getMethod() == 'POST'
        if($request->getMethod() == 'POST'){
            //Partie Categorie
            $categorie = new Categorie();
            $nomc = $request->get('nomc');
            $categorie->setNomc($nomc);
            $em->persist($categorie);
        }
        $em->flush();

        return $this->render('OCPlatformBundle:Default:carte.html.twig',
            array(
                'listeZones'=>$listeZones,
                'listeCategorie'=>$listeCategorie,
                'listeCommercial'=>$listeCommercial,
                'listeEvenement'=>$listeEvenement)
        );
    }

    // Ajouter un MarKeur
    public function addMarkeurAction()
    {
        $request = $this->get('request');
        $em = $this->getDoctrine()->getManager();

        $listeCategorie = $em->getRepository('OCPlatformBundle:Categorie')->findAll();
        foreach ($listeCategorie as $categories) {
            $categories->getNomc().'<br/>';
        }

        // Lister le nom des zones dans la balise select
        $listeZones = $em->getRepository('OCPlatformBundle:Zone')->findAll();
        foreach ($listeZones as $zone) {
            $zone->getNom().'<br/>';
        }

        $listeCommercial = $em->getRepository('OCPlatformBundle:Commercial')->findAll();
        foreach ($listeCommercial as $commercial) {
            $commercial->getNom().' '.$commercial->getPrenom().'<br/>';
        }

        // Lister la liste des Evenements
        $listeEvenement = $em->getRepository('OCPlatformBundle:Affectation')->findAll();
        foreach ($listeEvenement as $evenement){
            $evenement->getEvent().'<br/>';
        }

        if($request->getMethod() == 'POST'){

            $nomp = $request->get('nomp');

            // Partie Places;
            $places = new Places();

            // Récupère le id de la catégorie

            $catego = $request->get('listeCategories');
            $categorie = $this->getDoctrine()->getManager()->getRepository('OCPlatformBundle:Categorie')->find($catego);

            $strCategoriePlaces = $request->get('strCategoriePlaces');

            $points = split("_",$strCategoriePlaces);
            $latitude = $points[0];
            $longitude = $points[1];
            $places->setLatitude($latitude);
            $places->setLongitude($longitude);
            $places->setNomp($nomp);
            $places->setCategorie($categorie);

            $em->persist($places);
        }
        $em->flush();
        return $this->render('OCPlatformBundle:Default:carte.html.twig',
            array(
                'listeZones'=>$listeZones,
                'listeCategorie'=>$listeCategorie,
                'listeCommercial'=>$listeCommercial,
                'listeEvenement'=>$listeEvenement)
        );

    }

    public function categoriePlacesAction(){

        $request = $this->getRequest();
        $em = $this->getDoctrine()->getManager();
        $id = $request->get('id');

        $categorie = $em->getRepository('OCPlatformBundle:Categorie')->find($id);

        if($categorie==null){

            $response = new Response();
            $response->headers->set('Content-Type','application/json');
            $response->setContent(json_encode($categorie->getNomc()));
            $response->setContent(json_encode($categorie->getNomc()));

            return $response;
        }

        $elem = $categorie->getPlaces();

        $tabElem = array();
        $i=0;
        foreach($elem as $elements){

            $tabElem[$i]['latitude'] = $elements->getLatitude();
            $tabElem[$i]['longitude'] = $elements->getLongitude();
            $i++;
        }

        $response = new Response();
        $donnees = json_encode($tabElem);
        $response->headers->set('Content-Type','application/json');
        $response->setContent($donnees);

        return $response;
    }

    public function addCommercialAction()
    {
        $em = $this->getDoctrine()->getManager();


        $listeCategorie = $em->getRepository('OCPlatformBundle:Categorie')->findAll();
        foreach ($listeCategorie as $categories) {
            $categories->getNomc().'<br/>';
        }

        // Lister le nom des zones dans la balise select
        $listeZones = $em->getRepository('OCPlatformBundle:Zone')->findAll();
        foreach ($listeZones as $zone) {
            $zone->getNom().'<br/>';
        }

        $listeCommercial = $em->getRepository('OCPlatformBundle:Commercial')->findAll();
        foreach ($listeCommercial as $commercial) {
            $commercial->getNom().' '.$commercial->getPrenom().'<br/>';
        }

        // Lister la liste des Evenements
        $listeEvenement = $em->getRepository('OCPlatformBundle:Affectation')->findAll();
        foreach ($listeEvenement as $evenement){
            $evenement->getEvent().'<br/>';
        }

        $request = $this->getRequest();

        if($request->getMethod() == 'POST'){

            $commercial = new Commercial();
            $nom = $request->get('nomcom');
            $prenom = $request->get('prenomcom');
            $commercial->setNom($nom);
            $commercial->setPrenom($prenom);
            $em->persist($commercial);
        }
        $em->flush();

        return $this->render('OCPlatformBundle:Default:carte.html.twig',
            array(
                'listeZones'=>$listeZones,
                'listeCategorie'=>$listeCategorie,
                'listeCommercial'=>$listeCommercial,
                'listeEvenement'=>$listeEvenement)
        );
    }

    public function formulaireCompletAction(){

        $em = $this->getDoctrine()->getManager();

        $listeCategorie = $em->getRepository('OCPlatformBundle:Categorie')->findAll();
        foreach ($listeCategorie as $categories) {
            $categories->getNomc().'<br/>';
        }

        // Lister le nom des zones dans la balise select
        $listeZones = $em->getRepository('OCPlatformBundle:Zone')->findAll();
        foreach ($listeZones as $zone) {
            $zone->getNom().'<br/>';
        }

        $listeCommercial = $em->getRepository('OCPlatformBundle:Commercial')->findAll();
        foreach ($listeCommercial as $commercial) {
            $commercial->getNom().' '.$commercial->getPrenom().'<br/>';
        }

        // Lister la liste des Evenements
        $listeEvenement = $em->getRepository('OCPlatformBundle:Affectation')->findAll();
        foreach ($listeEvenement as $evenement){
            $evenement->getEvent().'<br/>';
        }

        $request = $this->getRequest();

        if($request->getMethod() == "POST" ){

            $affectation = new Affectation();

            $event = $request->get('event');
            $id_zone = $request->get('zone');
            $id_commercial = $request->get('commercial');

            $zone = $this->getDoctrine()->getManager()->getRepository('OCPlatformBundle:Zone')->find($id_zone);
            $commercial = $this->getDoctrine()->getManager()->getRepository('OCPlatformBundle:Commercial')->find($id_commercial);

            $affectation->setEvent($event);
            $affectation->setZone($zone);
            $affectation->setCommercial($commercial);

            $em->persist($affectation);
        }
            $em->flush();

        return $this->render('OCPlatformBundle:Default:carte.html.twig',
            array(
                'listeZones'=>$listeZones,
                'listeCategorie'=>$listeCategorie,
                'listeCommercial'=>$listeCommercial,
                'listeEvenement'=>$listeEvenement)
        );
    }

    public function aff_commercialAction()
    {
        $em = $this->getDoctrine()->getManager();

        $listeCategorie = $em->getRepository('OCPlatformBundle:Categorie')->findAll();
        foreach ($listeCategorie as $categories) {
            $categories->getNomc().'<br/>';
        }

        // Lister le nom des zones dans la balise select
        $listeZones = $em->getRepository('OCPlatformBundle:Zone')->findAll();
        foreach ($listeZones as $zone) {
            $zone->getNom().'<br/>';
        }

        $listeCommercial = $em->getRepository('OCPlatformBundle:Commercial')->findAll();
        foreach ($listeCommercial as $commercial) {
            $commercial->getNom().' '.$commercial->getPrenom().'<br/>';
        }

        // Lister la liste des Evenements
        $listeEvenement = $em->getRepository('OCPlatformBundle:Affectation')->findAll();
        foreach ($listeEvenement as $evenement){
            $evenement->getEvent().'<br/>';
        }


        return $this->render('OCPlatformBundle:Default:carte.html.twig',
            array(
                'listeZones'=>$listeZones,
                'listeCategorie'=>$listeCategorie,
                'listeCommercial'=>$listeCommercial,
                'listeEvenement'=>$listeEvenement)
        );
    }


    // Evenement
    public function aff_EvenementAction(){

        $em = $this->getDoctrine()->getManager();
        $zones = $em->getRepository('OCPlatformBundle:Zone')->getZoneAffectation();

        $tabElem = array();
        $i=0;
        foreach($zones as $zone){
            $elem = $zone->getLimite();

            foreach($elem as $elements){
                $tabElem[$zone->getID()][$i]['latitude'] = $elements->getLatitude();
                $tabElem[$zone->getID()][$i]['longitude'] = $elements->getLongitude();
                $i++;
            }
        }

        $response = new Response();
        $donnees = json_encode($tabElem);
        $response->headers->set('Content-Type','application/json');
        $response->setContent($donnees);

        return $response;
    }

    public function aff_EventCommercialAction(){

        $em = $this->getDoctrine()->getManager();
        $commercials = $em->getRepository('OCPlatformBundle:Commercial');
        $tabElem = array();

        $i=0;
        foreach($commercials as $elem){
            //$tabElem[$i]['id'] = $elem->getID();
            $tabElem = $commercials->getID();
            $i++;
        }

        $response = new Response();
        $donnees = json_encode($tabElem);
        $response->headers->set('Content-Type','application/json');
        $response->setContent($donnees);

        return $response;
    }
}