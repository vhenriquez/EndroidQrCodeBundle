<?php

/*
 * (c) Jeroen van den Enden <info@endroid.nl>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Endroid\Bundle\QrCodeBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Endroid\QrCode\QrCode;

/**
 * QR code controller.
 */
class QrCodeController extends Controller
{
    /**
     *
     * @Route("/{text}.{extension}", name="endroid_qrcode", requirements={"text"="[\w\W]+", "extension"="jpg|png|gif"})
     *
     */
    public function generateAction($text, $extension)
    {
        $qrCode = new QrCode();
        if($size = $this->getRequest()->get('size')) $qrCode->setSize($size);
        $qrCode->setText($text);
        $qrCode = $qrCode->get($extension);

        $mime_type = 'image/'.$extension;
        if ($extension == 'jpg') {
            $mime_type = 'image/jpeg';
        }

        return new Response($qrCode, 200, array('Content-Type' => $mime_type));
    }
    
    /**
     *
     * @Route("/param/{extension}", name="endroid_params_qrcode", requirements={"extension"="jpg|png|gif"})
     *
     */
    public function generateUsingParamsAction(Request $request, $extension)
    {
        $text = $request->get('text');
        $qrCode = new QrCode();
        if($size = $this->getRequest()->get('size')) $qrCode->setSize($size);
        $qrCode->setText($text);
        $qrCode = $qrCode->get($extension);

        $mime_type = 'image/'.$extension;
        if ($extension == 'jpg') {
            $mime_type = 'image/jpeg';
        }

        return new Response($qrCode, 200, array('Content-Type' => $mime_type));
    }    
}
