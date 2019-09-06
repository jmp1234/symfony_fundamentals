<?php
namespace App\Controller; //Symfony takes advantage of PHP's namespace functionality to namespace the entire controller class

use Symfony\Component\Routing\Annotation\Route; //Symfony again takes advantage of PHP's namespace functionality: the use keyword imports the Response class, which the controller must return.
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;

class DuckyController extends AbstractController{ //The class can technically be called anything, but it's suffixed with Controller by convention.

  /**
   * @Route("/ducky/number/{max}", name="app_ducky_number")
   */
    public function number($max) { //The action method is allowed to have a $max argument thanks to the {max} wildcard in the route.
        $number = random_int(0, 100);

        return new Response(
            '<html><body>Lucky number: '.$number.'</body></html>'
        );

    }

    public function index() {

    //The generateUrl() method is just a helper method that generates the URL for a given route:
    $url = $this->generateUrl('app_lucky_number', ['max' => 10]);


    // redirects to the "homepage" route
    return $this->redirectToRoute('homepage');

    // redirectToRoute is a shortcut for:
    // return new RedirectResponse($this->generateUrl('homepage'));

    // does a permanent - 301 redirect
    return $this->redirectToRoute('homepage', [], 301);

    // redirect to a route with parameters
    return $this->redirectToRoute('app_lucky_number', ['max' => 10]);

    // redirects to a route and maintains the original query string parameters
    return $this->redirectToRoute('blog_show', $request->query->all());

    // redirects externally
    return $this->redirect('http://symfony.com/doc');
  }
}
