<?php
namespace Cognito\PayumLaybuy;

use Cognito\PayumLaybuy\Action\ConvertPaymentAction;
use Cognito\PayumLaybuy\Action\CaptureAction;
use Cognito\PayumLaybuy\Action\StatusAction;
use Payum\Core\Bridge\Spl\ArrayObject;
use Payum\Core\GatewayFactory;

class LaybuyGatewayFactory extends GatewayFactory
{
    /**
     * {@inheritDoc}
     */
    protected function populateConfig(ArrayObject $config)
    {
        $config->defaults([
            'payum.factory_name' => 'laybuy',
            'payum.factory_title' => 'laybuy',

            'payum.action.capture' => function (ArrayObject $config) {
                return new CaptureAction($config);
            },
            'payum.action.status' => new StatusAction(),
            'payum.action.convert_payment' => new ConvertPaymentAction(),
        ]);

        $payumPaths = $config['payum.paths'];
        $payumPaths['PayumLaybuy'] = __DIR__ . '/Resources/views';
        $config['payum.paths'] = $payumPaths;
    }
}
