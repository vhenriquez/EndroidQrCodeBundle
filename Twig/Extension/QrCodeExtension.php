<?php

/*
 * (c) Jeroen van den Enden <info@endroid.nl>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Endroid\Bundle\QrCodeBundle\Twig\Extension;

use Twig_Extension;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class QrCodeExtension extends Twig_Extension implements ContainerAwareInterface
{
    /**
     * {@inheritdoc}
     */
    protected $container;

    /**
     * {@inheritdoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return array(
            'qrcode_url' => new \Twig_Function_Method($this, 'qrcodeUrlFunction')
        );
    }

    /**
     * Creates the QR code URL corresponding to the given message and extension.
     *
     * @param $text
     * @param string $extension
     * @param int $size
     * @return mixed
     */
    public function qrcodeUrlFunction($text, $extension = 'png', $size = 200)
    {
        $router = $this->container->get('router');
        $url = $router->generate('endroid_params_qrcode', array(
            'extension' => $extension,
            'size' => $size,
        ));

        return $url . "&text=$text";
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'endroid_qrcode';
    }
}