<?php
/**
 * Created by PhpStorm.
 * User: samue
 * Date: 22/04/2018
 * Time: 14:38
 */

namespace App\Controller;

use App\Entity\NewOrder;
use App\Entity\User;
use App\Form\NewOrderType;
use App\Form\UserType;
use App\Form\UserTypeCollection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\ExpressionLanguage\Tests\Node\Obj;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Common\Collections\ArrayCollection;

class LlouvrreController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function homepageAction()
    {
        return $this->render('homepage.html.twig');
    }

    /**
     * @Route("/reservation", name="formBillet")
     */
    public function addBilletFormAction(Request $request)
    {
        $newOrder = new NewOrder();

        $form = $this->get('form.factory')->create(NewOrderType::class, $newOrder);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($newOrder);
            $em->flush();

            $id = $newOrder->getId();
            $numberId = 'co' . $id;
            $newOrder->setOrderNumber($numberId);

            $em->persist($newOrder);
            $em->flush();

                return $this->redirectToRoute('formInfos', array(
                    'id' => $newOrder->getId(),
                    ));
        }

        return $this->render('form_billet.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/reservation/form/{id}", name="formInfos")
     */
    public function addInfosFormsAction($id,Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $newOrder = $em->getRepository(NewOrder::class)->find($id);

        //retrieve nbTicket
        $nbTicket = $newOrder->getNbTicket();
        $ticket = $newOrder->getTicket();

        $users = new ArrayCollection();
        $user = new User();

        for ($i = 0; $i < $nbTicket; $i++)
        {
            $users->add(new User);
        }

            $form = $this->get('form.factory')->create(UserTypeCollection::class, $users);

            if ($request->isMethod('POST') && $form->handleRequest($request)->isValid())
            {
                //Create many to one relation link
                $user->setNewOrder($newOrder);

                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->persist($newOrder);
                $em->flush();

                //retrieve boolean discount
                $discount = $user->getDiscount();

                //check ticket
                if ($ticket == "journée")
                {
                    //check is there an application for discount
                    if ($discount == 0)
                    {
                        $birthdate = $user->getBirthDate();
                        $typePrice = $user->differenceBetweenBirthdateAndNow($birthdate);
                    } else {
                        $typePrice = "Tarif réduit";
                    }
                }
                else
                {
                    $typePrice = "Tarif demi-journée";
                }

                //set price field
                $price = $user->typeOfPriceToPrice($typePrice);

                //add typePrice and price for User table
                $user->setTypePrice($typePrice);
                $user->setPrice($price);
                $em->persist($user);
                $em->flush();

                return $this->redirectToRoute('formPayment', array(
                    'id' => $user->getId(),
                    'nbTicket' => $nbTicket,

                ));
            }

            return $this->render('form_infos.html.twig', array(
                'form' => $form->createView(),
            ));
    }

    /**
     * @Route("/reservation/payment/{id}/{nbTicket}", name="formPayment")
     */
    public function paymentAction($id, $nbTicket)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository(User::class)->find($id);

        $em->flush();

        return $this->render('form_payment.html.twig', array(
            'id' => $id,
            'nbTicket' => $nbTicket,
        ));
    }
}